<?php
declare(strict_types=1);
require 'koneksi.php';

// Disable error display in production
ini_set('display_errors', '0');
error_reporting(E_ALL);

/**
 * Product Management System
 * 
 * This script handles the addition of new products with facilities and images.
 * It includes robust validation, CSRF protection, and secure file uploads.
 */

class ProductManager {
    private $conn;
    private $uploadPath = '../assets/images/';
    private $allowedImageTypes = [
        'image/jpeg' => 'jpg',
        'image/png' => 'png',
        'image/webp' => 'webp'
    ];
    private $maxFileSize = 5 * 1024 * 1024; // 5MB

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
        $this->initSession();
    }

    /**
     * Initialize secure session with strict settings
     */
    private function initSession(): void {
        if (session_status() === PHP_SESSION_NONE) {
            session_set_cookie_params([
                'lifetime' => 86400,
                'path' => '/',
                'domain' => $_SERVER['HTTP_HOST'],
                'secure' => true,
                'httponly' => true,
                'samesite' => 'Strict'
            ]);
            session_start();
            
            if (!isset($_SESSION['initiated'])) {
                session_regenerate_id(true);
                $_SESSION['initiated'] = true;
            }
            
            if (empty($_SESSION['csrf_token'])) {
                $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
            }
        }
    }

    /**
     * Main request handler
     */
    public function handleRequest(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_product'])) {
            $this->processFormSubmission();
        }
    }

    /**
     * Process form submission with validation
     */
    private function processFormSubmission(): void {
        header('Content-Type: application/json');
        
        // CSRF validation
        if (!$this->validateCsrfToken($_POST['csrf_token'] ?? '')) {
            $this->sendErrorResponse('Invalid CSRF token', 403);
        }

        // Input validation
        $errors = $this->validateInputs();
        if (!empty($errors)) {
            $this->sendErrorResponse($errors, 400);
        }

        // Process data
        try {
            $data = $this->sanitizeInputs();
            $featuredImage = $this->processImageUpload($_FILES['featured_image'], 'featured_');
            
            $this->conn->begin_transaction();
            $productId = $this->insertProduct($data, $featuredImage);
            $this->processFacilities($productId);
            $this->conn->commit();
            
            $this->sendSuccessResponse($productId);
        } catch (Exception $e) {
            $this->conn->rollback();
            $this->sendErrorResponse($e->getMessage(), 500);
        }
    }

    /**
     * Validate CSRF token
     */
    private function validateCsrfToken(string $token): bool {
        return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
    }

    /**
     * Validate all form inputs
     */
    private function validateInputs(): array {
        $errors = [];
        
        // Required fields
        $requiredFields = [
            'name' => 'Product name',
            'description' => 'Description',
            'price' => 'Price',
            'type' => 'Product type'
        ];
        
        foreach ($requiredFields as $field => $name) {
            if (empty(trim($_POST[$field] ?? ''))) {
                $errors[] = "$name is required";
            }
        }
        
        // Price validation
        if (isset($_POST['price']) && (!is_numeric($_POST['price']) || $_POST['price'] <= 0)) {
            $errors[] = "Price must be a positive number";
        }
        
        // File validation
        if (empty($_FILES['featured_image']['name'])) {
            $errors[] = "Featured image is required";
        } elseif ($_FILES['featured_image']['error'] !== UPLOAD_ERR_OK) {
            $errors[] = "File upload error: " . $this->getUploadError($_FILES['featured_image']['error']);
        }
        
        return $errors;
    }

    /**
     * Sanitize all input data
     */
    private function sanitizeInputs(): array {
        return [
            'name' => $this->sanitizeInput($_POST['name']),
            'description' => $this->sanitizeInput($_POST['description']),
            'price' => (float)$_POST['price'],
            'type' => $this->sanitizeInput($_POST['type']),
            'owner' => isset($_POST['owner']) ? $this->sanitizeInput($_POST['owner']) : null,
            'location' => isset($_POST['location']) ? $this->sanitizeInput($_POST['location']) : null,
            'phone' => isset($_POST['phone']) ? $this->sanitizeInput($_POST['phone']) : null
        ];
    }

    /**
     * Process and validate image upload
     */
    private function processImageUpload(array $file, string $prefix): string {
        // Basic validation
        if (!is_uploaded_file($file['tmp_name'])) {
            throw new Exception("Invalid file upload");
        }
        
        // MIME type validation
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);
        
        if (!array_key_exists($mime, $this->allowedImageTypes)) {
            throw new Exception("Invalid image format. Only JPEG, PNG, and WebP are allowed.");
        }
        
        // File size validation
        if ($file['size'] > $this->maxFileSize) {
            throw new Exception("Image size exceeds maximum limit of 5MB");
        }
        
        // Generate unique filename
        $ext = $this->allowedImageTypes[$mime];
        $filename = $prefix . time() . '_' . bin2hex(random_bytes(8)) . '.' . $ext;
        $uploadPath = $this->uploadPath . $filename;
        
        // Ensure directory exists
        if (!file_exists($this->uploadPath)) {
            mkdir($this->uploadPath, 0755, true);
        }
        
        // Move uploaded file
        if (!move_uploaded_file($file['tmp_name'], $uploadPath)) {
            throw new Exception("Failed to move uploaded file");
        }
        
        return $filename;
    }

    /**
     * Insert product into database
     */
    private function insertProduct(array $data, string $featuredImage): int {
    $stmt = $this->conn->prepare("INSERT INTO products 
        (type, name, description, price, owner, location, phone, featured_image) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    
    $stmt->bind_param("sssdssss", 
        $data['type'], 
        $data['name'], 
        $data['description'], 
        $data['price'], 
        $data['owner'], 
        $data['location'], 
        $data['phone'], 
        $featuredImage
    );
    
    if (!$stmt->execute()) {
        throw new Exception("Database error: " . $this->conn->error);
    }
    
    $productId = $this->conn->insert_id;
    $stmt->close();
    
    return $productId;
}

private function processFacilities(int $productId): void {
    if (empty($_POST['facilities'])) return;
    
    $stmt = $this->conn->prepare("INSERT INTO product_facilities 
        (product_id, facility, icon, image) 
        VALUES (?, ?, ?, ?)");
    
    foreach ($_POST['facilities'] as $index => $facility) {
        if (empty($facility['name'])) continue;
        
        $facilityName = $this->sanitizeInput($facility['name']);
        $icon = $this->sanitizeInput($facility['icon'] ?? 'fa-check');
        $facilityImage = null;
        
        if (!empty($_FILES['facilities_images']['name'][$index])) {
            try {
                $facilityImage = $this->processImageUpload([
                    'name' => $_FILES['facilities_images']['name'][$index],
                    'type' => $_FILES['facilities_images']['type'][$index],
                    'tmp_name' => $_FILES['facilities_images']['tmp_name'][$index],
                    'error' => $_FILES['facilities_images']['error'][$index],
                    'size' => $_FILES['facilities_images']['size'][$index]
                ], 'facility_');
            } catch (Exception $e) {
                continue;
            }
        }
        
        $stmt->bind_param("isss", $productId, $facilityName, $icon, $facilityImage);
        $stmt->execute();
    }
    
    $stmt->close();
}

    /**
     * Send JSON error response
     */
    private function sendErrorResponse($message, int $code = 400): void {
        http_response_code($code);
        die(json_encode([
            'status' => 'error',
            'message' => is_array($message) ? $message : [$message]
        ]));
    }

    /**
     * Send JSON success response
     */
    private function sendSuccessResponse(int $productId): void {
        $_SESSION['flash_message'] = [
            'type' => 'success',
            'message' => 'Product successfully added!'
        ];
        
        echo json_encode([
            'status' => 'success',
            'message' => 'Product added successfully',
            'redirect' => 'index.php'
        ]);
        exit();
    }

    /**
     * Sanitize input string
     */
    public function sanitizeInput(string $input): string {
        return htmlspecialchars($this->conn->real_escape_string(trim($input)), ENT_QUOTES, 'UTF-8');
    }

    /**
     * Get upload error message
     */
    public function getUploadError(int $errorCode): string {
        $errors = [
            UPLOAD_ERR_INI_SIZE => 'File exceeds upload_max_filesize directive in php.ini',
            UPLOAD_ERR_FORM_SIZE => 'File exceeds MAX_FILE_SIZE directive in HTML form',
            UPLOAD_ERR_PARTIAL => 'File was only partially uploaded',
            UPLOAD_ERR_NO_FILE => 'No file was uploaded',
            UPLOAD_ERR_NO_TMP_DIR => 'Missing temporary folder',
            UPLOAD_ERR_CANT_WRITE => 'Failed to write file to disk',
            UPLOAD_ERR_EXTENSION => 'File upload stopped by extension'
        ];
        
        return $errors[$errorCode] ?? 'Unknown upload error';
    }
}

// Initialize and run the application
try {
    $productManager = new ProductManager($conn);
    $productManager->handleRequest();
} catch (Exception $e) {
    header('Content-Type: application/json');
    http_response_code(500);
    die(json_encode(['status' => 'error', 'message' => 'An unexpected error occurred']));
}
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Product Management System">
    <meta name="author" content="Your Company">
    <title>Add New Product | Admin Dashboard</title>
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="../assets/favicon.ico" type="image/x-icon">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/favicon-16x16.png">
    <link rel="apple-touch-icon" sizes="180x180" href="../assets/apple-touch-icon.png">
    
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" 
          integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" 
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- Bootstrap 5.3 + Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" 
          integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" 
          crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <!-- Custom CSS -->
    <style>
        :root {
            --primary: #4e73df;
            --primary-dark: #2e59d9;
            --primary-light: #e2e6f9;
            --secondary: #858796;
            --success: #1cc88a;
            --success-dark: #17a673;
            --info: #36b9cc;
            --warning: #f6c23e;
            --danger: #e74a3b;
            --danger-dark: #be2617;
            --light: #f8f9fc;
            --dark: #5a5c69;
            --gray-100: #f8f9fc;
            --gray-200: #e3e6f0;
            --gray-300: #d1d3e2;
            --gray-600: #858796;
            --gray-800: #5a5c69;
        }
        
        body {
            font-family: 'Nunito', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 
                         'Helvetica Neue', Arial, sans-serif;
            background-color: var(--light);
            color: var(--dark);
            line-height: 1.6;
        }
        
        /* Main container */
        .admin-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }
        
        /* Form styling */
        .form-card {
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 0.5rem 1.5rem rgba(58, 59, 69, 0.1);
            padding: 2.5rem;
            margin-bottom: 2rem;
            border: 1px solid var(--gray-200);
        }
        
        .form-title {
            color: var(--primary);
            font-weight: 700;
            margin-bottom: 2rem;
            text-align: center;
            position: relative;
            padding-bottom: 1rem;
        }
        
        .form-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 120px;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--success));
            border-radius: 2px;
        }
        
        /* Form elements */
        .form-label {
            font-weight: 600;
            color: var(--gray-800);
            margin-bottom: 0.5rem;
            display: block;
        }
        
        .form-label.required::after {
            content: " *";
            color: var(--danger);
        }
        
        .form-control, .form-select {
            border-radius: 0.375rem;
            padding: 0.75rem 1rem;
            border: 1px solid var(--gray-300);
            transition: all 0.2s ease-in-out;
            font-size: 0.925rem;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.25);
            outline: 0;
        }
        
        .input-group-text {
            background-color: var(--gray-100);
            color: var(--gray-800);
            font-weight: 600;
        }
        
        /* Buttons */
        .btn {
            font-weight: 600;
            border-radius: 0.375rem;
            padding: 0.75rem 1.5rem;
            transition: all 0.2s ease-in-out;
            letter-spacing: 0.5px;
        }
        
        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
        }
        
        .btn-primary:hover, .btn-primary:focus {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
            transform: translateY(-1px);
            box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.1);
        }
        
        .btn-secondary {
            background-color: var(--secondary);
            border-color: var(--secondary);
        }
        
        .btn-success {
            background-color: var(--success);
            border-color: var(--success);
        }
        
        .btn-success:hover, .btn-success:focus {
            background-color: var(--success-dark);
            border-color: var(--success-dark);
        }
        
        .btn-danger {
            background-color: var(--danger);
            border-color: var(--danger);
        }
        
        .btn-danger:hover, .btn-danger:focus {
            background-color: var(--danger-dark);
            border-color: var(--danger-dark);
        }
        
        /* Facility management */
        .facility-section {
            margin-top: 2rem;
            border-top: 1px solid var(--gray-200);
            padding-top: 1.5rem;
        }
        
        .facility-container {
            border: 1px solid var(--gray-200);
            border-radius: 0.5rem;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            background-color: var(--light);
            position: relative;
            transition: all 0.2s ease-in-out;
        }
        
        .facility-container:hover {
            box-shadow: 0 0.25rem 0.75rem rgba(0, 0, 0, 0.05);
        }
        
        .facility-item {
            margin-bottom: 1.25rem;
        }
        
        .btn-add-facility {
            margin-bottom: 1.5rem;
        }
        
        .btn-remove-facility {
            position: absolute;
            top: 1rem;
            right: 1rem;
            width: 2.25rem;
            height: 2.25rem;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
            border-radius: 50%;
        }
        
        /* Image upload */
        .image-upload-container {
            border: 2px dashed var(--gray-300);
            border-radius: 0.5rem;
            padding: 2rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s ease-in-out;
            background-color: var(--light);
            margin-bottom: 1rem;
        }
        
        .image-upload-container:hover {
            border-color: var(--primary);
            background-color: rgba(78, 115, 223, 0.05);
        }
        
        .image-upload-container.dragover {
            border-color: var(--success);
            background-color: rgba(28, 200, 138, 0.1);
        }
        
        .image-upload-icon {
            font-size: 2.5rem;
            color: var(--gray-600);
            margin-bottom: 1rem;
        }
        
        .image-preview {
            max-width: 100%;
            max-height: 200px;
            border-radius: 0.375rem;
            object-fit: cover;
            display: none;
            margin: 0 auto;
            border: 2px solid var(--gray-200);
        }
        
        .thumbnail-preview {
            max-width: 120px;
            max-height: 120px;
            border-radius: 0.25rem;
            object-fit: cover;
            border: 1px solid var(--gray-200);
        }
        
        /* Progress bar */
        .upload-progress {
            height: 0.5rem;
            border-radius: 0.25rem;
            background-color: var(--gray-200);
            margin-top: 1rem;
            overflow: hidden;
            display: none;
        }
        
        .upload-progress-bar {
            height: 100%;
            background-color: var(--primary);
            width: 0;
            transition: width 0.3s ease;
        }
        
        /* Toast notification */
        .toast-container {
            position: fixed;
            bottom: 1.5rem;
            right: 1.5rem;
            z-index: 1100;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .form-card {
                padding: 1.5rem;
            }
            
            .facility-container {
                padding: 1rem;
            }
            
            .image-upload-container {
                padding: 1.5rem;
            }
        }
        
        /* Animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .animate-fade-in {
            animation: fadeIn 0.3s ease-out forwards;
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <div class="form-card animate-fade-in">
            <h1 class="form-title">Add New Product</h1>
            
            <form id="productForm" method="post" enctype="multipart/form-data" novalidate>
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '') ?>">
                <input type="hidden" name="add_product" value="1">
                
                <div class="row g-4">
                    <!-- Basic Information -->
                    <div class="col-md-6">
                        <div class="mb-4">
                            <label for="name" class="form-label required">Product Name</label>
                            <input type="text" class="form-control" id="name" name="name" 
                                   placeholder="e.g., Luxury Villa" required>
                            <div class="invalid-feedback">Please provide a product name.</div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="description" class="form-label required">Description</label>
                            <textarea class="form-control" id="description" name="description" 
                                      rows="5" placeholder="Detailed product description..." required></textarea>
                            <div class="invalid-feedback">Please provide a description.</div>
                        </div>
                    </div>
                    
                    <!-- Pricing & Details -->
                    <div class="col-md-6">
                        <div class="mb-4">
                            <label for="price" class="form-label required">Price</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" class="form-control" id="price" name="price" 
                                       placeholder="150000" min="0" step="1000" required>
                                <div class="invalid-feedback">Please enter a valid price.</div>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="type" class="form-label required">Product Type</label>
                            <select class="form-select" id="type" name="type" required>
                                <option value="" disabled selected>Select product type</option>
                                <option value="UMKM">UMKM</option>
                                <option value="Pariwisata">Tourism</option>
                                <option value="Property">Property</option>
                                <option value="Service">Service</option>
                            </select>
                            <div class="invalid-feedback">Please select a product type.</div>
                        </div>
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="owner" class="form-label">Owner</label>
                                    <input type="text" class="form-control" id="owner" name="owner" 
                                           placeholder="Product owner name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" 
                                           placeholder="Contact number">
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" class="form-control" id="location" name="location" 
                                   placeholder="Product location">
                        </div>
                    </div>
                </div>
                
                <!-- Featured Image -->
                <div class="mb-5">
                    <label class="form-label required">Featured Image</label>
                    <div class="image-upload-container" id="featuredImageContainer">
                        <div id="featuredImageUpload">
                            <i class="bi bi-cloud-arrow-up image-upload-icon"></i>
                            <h5 class="mb-1">Drag & drop your image here</h5>
                            <p class="text-muted small mb-0">or click to browse your files</p>
                            <p class="text-muted small">Supports: JPG, PNG, WebP (Max 5MB)</p>
                        </div>
                        <img id="featuredImagePreview" class="image-preview" alt="Featured image preview">
                        <div class="upload-progress" id="uploadProgress">
                            <div class="upload-progress-bar" id="uploadProgressBar"></div>
                        </div>
                    </div>
                    <input type="file" id="featured_image" name="featured_image" 
                           accept="image/jpeg, image/png, image/webp" required class="d-none">
                    <div class="invalid-feedback">Please upload a featured image.</div>
                </div>
                
                <!-- Facilities Section -->
                <div class="facility-section">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0">Facilities</h5>
                        <button type="button" class="btn btn-success btn-add-facility" id="addFacilityBtn">
                            <i class="fas fa-plus me-2"></i>Add Facility
                        </button>
                    </div>
                    
                    <div id="facilitiesContainer">
                        <!-- Initial facility item -->
                        <div class="facility-container animate-fade-in">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="facility-item">
                                        <label class="form-label">Facility Name</label>
                                        <input type="text" class="form-control" name="facilities[0][name]" 
                                               placeholder="e.g., Swimming Pool" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="facility-item">
                                        <label class="form-label">Icon</label>
                                        <select class="form-select" name="facilities[0][icon]">
                                            <option value="fa-swimming-pool">Swimming Pool</option>
                                            <option value="fa-wifi">Wi-Fi</option>
                                            <option value="fa-parking">Parking</option>
                                            <option value="fa-utensils">Restaurant</option>
                                            <option value="fa-tv">TV</option>
                                            <option value="fa-snowflake">Air Conditioning</option>
                                            <option value="fa-check" selected>Check Mark</option>
                                            <option value="fa-bath">Bath</option>
                                            <option value="fa-bed">Bed</option>
                                            <option value="fa-coffee">Coffee</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="facility-item">
                                <label class="form-label">Facility Image (Optional)</label>
                                <input type="file" class="form-control facility-image-input" name="facilities_images[0]" 
                                       accept="image/jpeg, image/png, image/webp" data-preview-target="facilityPreview0">
                                <div class="mt-2 text-center" id="facilityPreview0" style="display: none;">
                                    <img class="thumbnail-preview">
                                    <div class="small text-muted mt-1">Image preview</div>
                                </div>
                            </div>
                            
                            <button type="button" class="btn btn-danger btn-remove-facility" 
                                    title="Remove facility">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Form Actions -->
                <div class="d-flex justify-content-between align-items-center mt-5 pt-4 border-top">
                    <a href="index.php" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Back to List
                    </a>
                    <button type="submit" class="btn btn-primary" id="submitBtn">
                        <i class="fas fa-save me-2"></i>Save Product
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Toast Notification -->
    <div class="toast-container">
        <div id="toast" class="toast align-items-center text-white border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body" id="toastMessage"></div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" 
            crossorigin="anonymous"></script>
    
    <!-- Custom JavaScript -->
    <script>
        // Document ready
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Bootstrap components
            const toastEl = document.getElementById('toast');
            const toastMessage = document.getElementById('toastMessage');
            const toast = new bootstrap.Toast(toastEl, {
                autohide: true,
                delay: 5000
            });
            
            // Check for flash messages
            <?php if (isset($_SESSION['flash_message'])): ?>
                showToast('<?= $_SESSION['flash_message']['type'] ?>', '<?= $_SESSION['flash_message']['message'] ?>');
                <?php unset($_SESSION['flash_message']); ?>
            <?php endif; ?>
            
            // Initialize form validation
            initFormValidation();
            
            // Initialize image upload functionality
            initImageUpload();
            
            // Initialize facility management
            initFacilityManagement();
            
            // Initialize form submission
            initFormSubmission();
        });
        
        // Form validation
        function initFormValidation() {
            const form = document.getElementById('productForm');
            
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                
                form.classList.add('was-validated');
            }, false);
        }
        
        // Image upload functionality
        function initImageUpload() {
            const featuredImageContainer = document.getElementById('featuredImageContainer');
            const featuredImageInput = document.getElementById('featured_image');
            const featuredImagePreview = document.getElementById('featuredImagePreview');
            const featuredImageUpload = document.getElementById('featuredImageUpload');
            
            // Click handler
            featuredImageContainer.addEventListener('click', () => {
                featuredImageInput.click();
            });
            
            // Drag and drop handlers
            featuredImageContainer.addEventListener('dragover', (e) => {
                e.preventDefault();
                featuredImageContainer.classList.add('dragover');
            });
            
            ['dragleave', 'dragend'].forEach(type => {
                featuredImageContainer.addEventListener(type, () => {
                    featuredImageContainer.classList.remove('dragover');
                });
            });
            
            featuredImageContainer.addEventListener('drop', (e) => {
                e.preventDefault();
                featuredImageContainer.classList.remove('dragover');
                
                if (e.dataTransfer.files.length) {
                    featuredImageInput.files = e.dataTransfer.files;
                    updateFeaturedImagePreview();
                }
            });
            
            // File input change handler
            featuredImageInput.addEventListener('change', updateFeaturedImagePreview);
            
            function updateFeaturedImagePreview() {
                const file = featuredImageInput.files[0];
                
                if (file) {
                    // Validate file type
                    const validTypes = ['image/jpeg', 'image/png', 'image/webp'];
                    if (!validTypes.includes(file.type)) {
                        showToast('error', 'Invalid file type. Please upload an image (JPEG, PNG, or WebP).');
                        return;
                    }
                    
                    // Validate file size (5MB max)
                    if (file.size > 5 * 1024 * 1024) {
                        showToast('error', 'Image size exceeds maximum limit of 5MB.');
                        return;
                    }
                    
                    const reader = new FileReader();
                    
                    reader.onload = function(e) {
                        featuredImagePreview.src = e.target.result;
                        featuredImagePreview.style.display = 'block';
                        featuredImageUpload.style.display = 'none';
                    }
                    
                    reader.readAsDataURL(file);
                } else {
                    featuredImagePreview.style.display = 'none';
                    featuredImageUpload.style.display = 'block';
                }
            }
        }
        
        // Facility management
        function initFacilityManagement() {
            let facilityCount = 1;
            const addFacilityBtn = document.getElementById('addFacilityBtn');
            const facilitiesContainer = document.getElementById('facilitiesContainer');
            
            // Add facility
            addFacilityBtn.addEventListener('click', () => {
                const newFacility = document.createElement('div');
                newFacility.className = 'facility-container animate-fade-in';
                newFacility.innerHTML = `
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="facility-item">
                                <label class="form-label">Facility Name</label>
                                <input type="text" class="form-control" name="facilities[${facilityCount}][name]" 
                                       placeholder="e.g., Swimming Pool" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="facility-item">
                                <label class="form-label">Icon</label>
                                <select class="form-select" name="facilities[${facilityCount}][icon]">
                                    <option value="fa-swimming-pool">Swimming Pool</option>
                                    <option value="fa-wifi">Wi-Fi</option>
                                    <option value="fa-parking">Parking</option>
                                    <option value="fa-utensils">Restaurant</option>
                                    <option value="fa-tv">TV</option>
                                    <option value="fa-snowflake">Air Conditioning</option>
                                    <option value="fa-check" selected>Check Mark</option>
                                    <option value="fa-bath">Bath</option>
                                    <option value="fa-bed">Bed</option>
                                    <option value="fa-coffee">Coffee</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="facility-item">
                        <label class="form-label">Facility Image (Optional)</label>
                        <input type="file" class="form-control facility-image-input" 
                               name="facilities_images[${facilityCount}]" 
                               accept="image/jpeg, image/png, image/webp"
                               data-preview-target="facilityPreview${facilityCount}">
                        <div class="mt-2 text-center" id="facilityPreview${facilityCount}" style="display: none;">
                            <img class="thumbnail-preview">
                            <div class="small text-muted mt-1">Image preview</div>
                        </div>
                    </div>
                    
                    <button type="button" class="btn btn-danger btn-remove-facility" 
                            title="Remove facility">
                        <i class="fas fa-trash"></i>
                    </button>
                `;
                
                facilitiesContainer.appendChild(newFacility);
                
                // Add event listener for the new facility image preview
                const fileInput = newFacility.querySelector('.facility-image-input');
                fileInput.addEventListener('change', function() {
                    const previewTarget = this.dataset.previewTarget;
                    previewImage(this, previewTarget);
                });
                
                // Add remove facility handler
                const removeBtn = newFacility.querySelector('.btn-remove-facility');
                removeBtn.addEventListener('click', function() {
                    removeFacility(this);
                });
                
                facilityCount++;
                
                // Scroll to the new facility
                newFacility.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            });
            
            // Add event listeners to existing facility image inputs
            document.querySelectorAll('.facility-image-input').forEach(input => {
                input.addEventListener('change', function() {
                    const previewTarget = this.dataset.previewTarget;
                    previewImage(this, previewTarget);
                });
            });
            
            // Add event listeners to existing remove buttons
            document.querySelectorAll('.btn-remove-facility').forEach(btn => {
                btn.addEventListener('click', function() {
                    removeFacility(this);
                });
            });
        }
        
        // Remove facility
        function removeFacility(button) {
            const facilityContainer = button.closest('.facility-container');
            
            // Add fade-out animation before removal
            facilityContainer.style.opacity = '0';
            facilityContainer.style.transition = 'opacity 0.3s ease';
            
            setTimeout(() => {
                facilityContainer.remove();
            }, 300);
        }
        
        // Image preview function
        function previewImage(input, previewId) {
            const previewContainer = document.getElementById(previewId);
            
            if (!previewContainer) {
                console.error('Preview container not found:', previewId);
                return;
            }
            
            const previewImg = previewContainer.querySelector('img');
            
            if (input.files && input.files[0]) {
                const file = input.files[0];
                
                // Validate file type
                const validTypes = ['image/jpeg', 'image/png', 'image/webp'];
                if (!validTypes.includes(file.type)) {
                    showToast('error', 'Invalid file type for facility image. Please upload an image (JPEG, PNG, or WebP).');
                    input.value = '';
                    return;
                }
                
                // Validate file size (5MB max)
                if (file.size > 5 * 1024 * 1024) {
                    showToast('error', 'Facility image size exceeds maximum limit of 5MB.');
                    input.value = '';
                    return;
                }
                
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    previewContainer.style.display = 'block';
                }
                
                reader.readAsDataURL(file);
            } else {
                previewContainer.style.display = 'none';
            }
        }
        
        // Form submission
        // Form submission
function initFormSubmission() {
    const form = document.getElementById('productForm');
    const submitBtn = document.getElementById('submitBtn');
    
    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        if (!form.checkValidity()) {
            e.stopPropagation();
            form.classList.add('was-validated');
            return;
        }
        
        const originalBtnText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Saving...';
        submitBtn.disabled = true;
        
        const formData = new FormData(form);
        
        try {
            // Show upload progress if there's a featured image
            const featuredImageInput = document.getElementById('featured_image');
            if (featuredImageInput.files[0]) {
                const uploadProgress = document.getElementById('uploadProgress');
                const uploadProgressBar = document.getElementById('uploadProgressBar');
                
                uploadProgress.style.display = 'block';
                
                const xhr = new XMLHttpRequest();
                xhr.upload.onprogress = function(e) {
                    if (e.lengthComputable) {
                        const percentComplete = (e.loaded / e.total) * 100;
                        uploadProgressBar.style.width = percentComplete + '%';
                    }
                };
            }
            
            const response = await fetch('tambah.php', {
                method: 'POST',
                body: formData
            });
            
            // Check if the response is OK (status 200-299)
            if (!response.ok) {
                // Try to get the error message from the response
                let errorMsg = 'Network response was not ok';
                try {
                    const errorData = await response.json();
                    errorMsg = errorData.message || errorMsg;
                } catch (e) {
                    // If we can't parse JSON, use the status text
                    errorMsg = response.statusText || errorMsg;
                }
                throw new Error(`Server error: ${response.status} - ${errorMsg}`);
            }
            
            const data = await response.json();
            
            if (data.status === 'success') {
                showToast('success', data.message || 'Product successfully added!');
                
                if (data.redirect) {
                    setTimeout(() => {
                        window.location.href = data.redirect;
                    }, 1500);
                }
            } else {
                throw new Error(data.message || 'An error occurred while saving the product');
            }
        } catch (error) {
            console.error('Form submission error:', error);
            
            // More detailed error messages based on error type
            let userMessage = error.message;
            if (error instanceof TypeError && error.message.includes('Failed to fetch')) {
                userMessage = 'Network error: Could not connect to the server. Please check your internet connection.';
            } else if (error.message.includes('Server error')) {
                // Already has detailed message from above
            } else {
                userMessage = 'An unexpected error occurred. Please try again.';
            }
            
            showToast('danger', userMessage);
        } finally {
            submitBtn.innerHTML = originalBtnText;
            submitBtn.disabled = false;
            
            const uploadProgress = document.getElementById('uploadProgress');
            if (uploadProgress) {
                uploadProgress.style.display = 'none';
            }
        }
    });
}
        
        // Toast notification
        function showToast(type, message) {
            const toastEl = document.getElementById('toast');
            const toastMessage = document.getElementById('toastMessage');
            const toast = bootstrap.Toast.getInstance(toastEl) || new bootstrap.Toast(toastEl);
            
            // Set toast style based on type
            toastEl.className = `toast align-items-center text-white bg-${type} border-0`;
            toastMessage.textContent = message;
            
            toast.show();
        }
    </script>
</body>
</html>