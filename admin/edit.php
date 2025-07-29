<?php
// Secure initialization
declare(strict_types=1);
require '../includes/config.php';

// Enhanced session management with strict security headers
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
    
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
}

// Validate product ID
if (!isset($_GET['id']) || !ctype_digit($_GET['id'])) {
    die(json_encode(['status' => 'error', 'message' => 'Invalid product ID']));
}

$productId = (int)$_GET['id'];

// Fetch product data with prepared statement
$product = [];
$stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
$stmt->bind_param("i", $productId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die(json_encode(['status' => 'error', 'message' => 'Product not found']));
}

$product = $result->fetch_assoc();
$stmt->close();

// Fetch product facilities
$facilities = [];
$stmt = $conn->prepare("SELECT * FROM product_facilities WHERE product_id = ?");
$stmt->bind_param("i", $productId);
$stmt->execute();
$facilitiesResult = $stmt->get_result();

while ($row = $facilitiesResult->fetch_assoc()) {
    $facilities[] = $row;
}
$stmt->close();

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    
    // Validate CSRF token
    if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        http_response_code(403);
        die(json_encode(['status' => 'error', 'message' => 'Invalid CSRF token']));
    }

    // Input validation
    $errors = [];
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
    
    if (!empty($errors)) {
        http_response_code(400);
        die(json_encode(['status' => 'error', 'messages' => $errors]));
    }
    
    // Sanitize and prepare data
    $data = [
        'name' => sanitizeInput($_POST['name']),
        'description' => sanitizeInput($_POST['description']),
        'price' => (float)$_POST['price'],
        'type' => sanitizeInput($_POST['type']),
        'owner' => isset($_POST['owner']) ? sanitizeInput($_POST['owner']) : null,
        'location' => isset($_POST['location']) ? sanitizeInput($_POST['location']) : null,
        'phone' => isset($_POST['phone']) ? sanitizeInput($_POST['phone']) : null
    ];
    
    // Process featured image upload if changed
    $featuredImage = $product['featured_image'];
    if (!empty($_FILES['featured_image']['name'])) {
        try {
            // Delete old image if exists
            if (!empty($product['featured_image'])) {
                @unlink("../assets/images/" . $product['featured_image']);
            }
            
            $featuredImage = processImageUpload($_FILES['featured_image'], 'featured_');
        } catch (Exception $e) {
            http_response_code(400);
            die(json_encode(['status' => 'error', 'message' => $e->getMessage()]));
        }
    }
    
    // Database transaction for atomic operations
    $conn->begin_transaction();
    
    try {
        // Update product
        $stmt = $conn->prepare("UPDATE products SET 
            name = ?, 
            description = ?, 
            price = ?, 
            type = ?, 
            owner = ?, 
            location = ?, 
            phone = ?, 
            featured_image = ?,
            updated_at = NOW()
            WHERE id = ?");
        
        $stmt->bind_param("ssdsssssi", 
            $data['name'], 
            $data['description'], 
            $data['price'], 
            $data['type'], 
            $data['owner'], 
            $data['location'], 
            $data['phone'], 
            $featuredImage,
            $productId
        );
        
        if (!$stmt->execute()) {
            throw new Exception("Database error: " . $conn->error);
        }
        $stmt->close();
        
        // Delete old facilities
        $conn->query("DELETE FROM product_facilities WHERE product_id = $productId");
        
        // Process facilities if provided
        if (!empty($_POST['facilities'])) {
            $facilityStmt = $conn->prepare("INSERT INTO product_facilities 
                (product_id, facility, icon, image) 
                VALUES (?, ?, ?, ?)");
            
            foreach ($_POST['facilities'] as $index => $facility) {
                if (empty($facility['name'])) continue;
                
                $facilityName = sanitizeInput($facility['name']);
                $icon = sanitizeInput($facility['icon'] ?? 'fa-check');
                $facilityImage = null;
                
                // Process new facility image upload
                if (!empty($_FILES['facilities_images']['name'][$index])) {
                    try {
                        $facilityImage = processImageUpload([
                            'name' => $_FILES['facilities_images']['name'][$index],
                            'type' => $_FILES['facilities_images']['type'][$index],
                            'tmp_name' => $_FILES['facilities_images']['tmp_name'][$index],
                            'error' => $_FILES['facilities_images']['error'][$index],
                            'size' => $_FILES['facilities_images']['size'][$index]
                        ], 'facility_');
                    } catch (Exception $e) {
                        // Skip this facility image but continue with the facility
                        continue;
                    }
                }
                // Keep existing image if not deleted
                elseif (!empty($facility['old_image']) && empty($facility['image_deleted'])) {
                    $facilityImage = $facility['old_image'];
                }
                // Delete old image if marked for deletion
                elseif (!empty($facility['old_image']) && !empty($facility['image_deleted'])) {
                    @unlink("../assets/images/" . $facility['old_image']);
                    $facilityImage = '';
                }
                
                $facilityStmt->bind_param("isss", $productId, $facilityName, $icon, $facilityImage);
                $facilityStmt->execute();
            }
            
            $facilityStmt->close();
        }
        
        $conn->commit();
        
        // Success response
        $_SESSION['flash_message'] = [
            'type' => 'success',
            'message' => 'Product successfully updated!'
        ];
        
        echo json_encode([
            'status' => 'success', 
            'redirect' => 'index.php'
        ]);
        exit();
        
    } catch (Exception $e) {
        $conn->rollback();
        http_response_code(500);
        die(json_encode(['status' => 'error', 'message' => $e->getMessage()]));
    }
}

// Helper methods
function sanitizeInput(string $input): string {
    global $conn;
    return htmlspecialchars($conn->real_escape_string(trim($input)), ENT_QUOTES, 'UTF-8');
}

function processImageUpload(array $file, string $prefix): string {
    $allowedTypes = [
        'image/jpeg' => 'jpg',
        'image/png' => 'png',
        'image/webp' => 'webp'
    ];
    
    if (!is_uploaded_file($file['tmp_name'])) {
        throw new Exception("Invalid file upload");
    }
    
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);
    
    if (!array_key_exists($mime, $allowedTypes)) {
        throw new Exception("Invalid image format. Only JPEG, PNG, and WebP are allowed.");
    }
    
    if ($file['size'] > 5 * 1024 * 1024) {
        throw new Exception("Image size exceeds maximum limit of 5MB");
    }
    
    $ext = $allowedTypes[$mime];
    $filename = $prefix . time() . '_' . bin2hex(random_bytes(8)) . '.' . $ext;
    $uploadPath = '../assets/images/' . $filename;
    
    if (!file_exists('../assets/images')) {
        mkdir('../assets/images', 0755, true);
    }
    
    if (!move_uploaded_file($file['tmp_name'], $uploadPath)) {
        throw new Exception("Failed to move uploaded file");
    }
    
    return $filename;
}
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Edit Product">
    <meta name="author" content="Your Company">
    
    <title>Edit Product | Admin Dashboard</title>
    
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
        
        .admin-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }
        
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
        
        .current-image {
            max-width: 100%;
            max-height: 300px;
            border-radius: 0.375rem;
            object-fit: contain;
            border: 2px solid var(--gray-200);
            margin-bottom: 1rem;
        }
        
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
        
        .toast-container {
            position: fixed;
            bottom: 1.5rem;
            right: 1.5rem;
            z-index: 1100;
        }
        
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
            <h1 class="form-title">Edit Product</h1>
            
            <form id="productForm" method="post" enctype="multipart/form-data" novalidate>
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '') ?>">
                
                <div class="row g-4">
                    <!-- Basic Information -->
                    <div class="col-md-6">
                        <div class="mb-4">
                            <label for="name" class="form-label required">Product Name</label>
                            <input type="text" class="form-control" id="name" name="name" 
                                   value="<?= htmlspecialchars($product['name']) ?>" required>
                            <div class="invalid-feedback">Please provide a product name.</div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="description" class="form-label required">Description</label>
                            <textarea class="form-control" id="description" name="description" 
                                      rows="5" required><?= htmlspecialchars($product['description']) ?></textarea>
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
                                       value="<?= htmlspecialchars($product['price']) ?>" min="0" step="1000" required>
                                <div class="invalid-feedback">Please enter a valid price.</div>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="type" class="form-label required">Product Type</label>
                            <select class="form-select" id="type" name="type" required>
                                <option value="UMKM" <?= $product['type'] === 'UMKM' ? 'selected' : '' ?>>UMKM</option>
                                <option value="Pariwisata" <?= $product['type'] === 'Pariwisata' ? 'selected' : '' ?>>Tourism</option>
                                <option value="Property" <?= $product['type'] === 'Property' ? 'selected' : '' ?>>Property</option>
                                <option value="Service" <?= $product['type'] === 'Service' ? 'selected' : '' ?>>Service</option>
                            </select>
                            <div class="invalid-feedback">Please select a product type.</div>
                        </div>
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="owner" class="form-label">Owner</label>
                                    <input type="text" class="form-control" id="owner" name="owner" 
                                           value="<?= htmlspecialchars($product['owner']) ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" 
                                           value="<?= htmlspecialchars($product['phone']) ?>">
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" class="form-control" id="location" name="location" 
                                   value="<?= htmlspecialchars($product['location']) ?>">
                        </div>
                    </div>
                </div>
                
                <!-- Featured Image -->
                <div class="mb-5">
                    <label class="form-label">Featured Image</label>
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
                           accept="image/jpeg, image/png, image/webp" class="d-none">
                    
                    <?php if (!empty($product['featured_image'])): ?>
                        <div class="mt-3">
                            <p class="mb-2"><strong>Current Image:</strong></p>
                            <img src="../assets/images/<?= htmlspecialchars($product['featured_image']) ?>" 
                                 class="current-image" alt="Current featured image">
                            <input type="hidden" name="old_featured_image" 
                                   value="<?= htmlspecialchars($product['featured_image']) ?>">
                            <div class="form-text">Upload a new image to replace the current one.</div>
                        </div>
                    <?php endif; ?>
                </div>
                
                <!-- Facilities Section -->
                <div class="facility-section">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0">Facilities</h5>
                        <button type="button" class="btn btn-success btn-add-facility" onclick="addFacility()">
                            <i class="fas fa-plus me-2"></i>Add Facility
                        </button>
                    </div>
                    
                    <div id="facilitiesContainer">
                        <?php if (!empty($facilities)): ?>
                            <?php foreach ($facilities as $index => $facility): ?>
                                <div class="facility-container animate-fade-in">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="facility-item">
                                                <label class="form-label">Facility Name</label>
                                                <input type="text" class="form-control" 
                                                       name="facilities[<?= $index ?>][name]" 
                                                       value="<?= htmlspecialchars($facility['facility']) ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="facility-item">
                                                <label class="form-label">Icon</label>
                                                <select class="form-select" name="facilities[<?= $index ?>][icon]">
                                                    <option value="fa-swimming-pool" <?= $facility['icon'] === 'fa-swimming-pool' ? 'selected' : '' ?>>Swimming Pool</option>
                                                    <option value="fa-wifi" <?= $facility['icon'] === 'fa-wifi' ? 'selected' : '' ?>>Wi-Fi</option>
                                                    <option value="fa-parking" <?= $facility['icon'] === 'fa-parking' ? 'selected' : '' ?>>Parking</option>
                                                    <option value="fa-utensils" <?= $facility['icon'] === 'fa-utensils' ? 'selected' : '' ?>>Restaurant</option>
                                                    <option value="fa-tv" <?= $facility['icon'] === 'fa-tv' ? 'selected' : '' ?>>TV</option>
                                                    <option value="fa-snowflake" <?= $facility['icon'] === 'fa-snowflake' ? 'selected' : '' ?>>Air Conditioning</option>
                                                    <option value="fa-check" <?= $facility['icon'] === 'fa-check' || empty($facility['icon']) ? 'selected' : '' ?>>Check Mark</option>
                                                    <option value="fa-bath" <?= $facility['icon'] === 'fa-bath' ? 'selected' : '' ?>>Bath</option>
                                                    <option value="fa-bed" <?= $facility['icon'] === 'fa-bed' ? 'selected' : '' ?>>Bed</option>
                                                    <option value="fa-coffee" <?= $facility['icon'] === 'fa-coffee' ? 'selected' : '' ?>>Coffee</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="facility-item">
                                        <label class="form-label">Facility Image (Optional)</label>
                                        <input type="file" class="form-control" 
                                               name="facilities_images[<?= $index ?>]" 
                                               id="facility_image_<?= $index ?>" 
                                               accept="image/jpeg, image/png, image/webp">
                                        
                                        <?php if (!empty($facility['image'])): ?>
                                            <div class="mt-2" id="facilityPreview<?= $index ?>">
                                                <img src="../assets/images/<?= htmlspecialchars($facility['image']) ?>" 
                                                     class="thumbnail-preview" alt="Facility image">
                                                <div class="image-actions mt-2">
                                                    <input type="hidden" 
                                                           name="facilities[<?= $index ?>][old_image]" 
                                                           value="<?= htmlspecialchars($facility['image']) ?>">
                                                    <input type="hidden" 
                                                           name="facilities[<?= $index ?>][image_deleted]" 
                                                           value="0" id="image_deleted_<?= $index ?>">
                                                    <button type="button" class="btn btn-sm btn-danger" 
                                                            onclick="removeImage(<?= $index ?>)">
                                                        <i class="fas fa-trash me-1"></i>Remove Image
                                                    </button>
                                                </div>
                                            </div>
                                        <?php else: ?>
                                            <div class="mt-2" id="facilityPreview<?= $index ?>" style="display: none;">
                                                <img class="thumbnail-preview" alt="Preview">
                                                <div class="small text-muted mt-1">Image preview</div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <button type="button" class="btn btn-danger btn-remove-facility" 
                                            onclick="removeFacility(this)" title="Remove facility">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <!-- Default facility if none exist -->
                            <div class="facility-container animate-fade-in">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="facility-item">
                                            <label class="form-label">Facility Name</label>
                                            <input type="text" class="form-control" 
                                                   name="facilities[0][name]" 
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
                                    <input type="file" class="form-control" 
                                           name="facilities_images[0]" 
                                           id="facility_image_0" 
                                           accept="image/jpeg, image/png, image/webp">
                                    <div class="mt-2" id="facilityPreview0" style="display: none;">
                                        <img class="thumbnail-preview" alt="Preview">
                                        <div class="small text-muted mt-1">Image preview</div>
                                    </div>
                                </div>
                                
                                <button type="button" class="btn btn-danger btn-remove-facility" 
                                        onclick="removeFacility(this)" title="Remove facility">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Form Actions -->
                <div class="d-flex justify-content-between align-items-center mt-5 pt-4 border-top">
                    <a href="index.php" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Back to List
                    </a>
                    <button type="submit" class="btn btn-primary" id="submitBtn">
                        <i class="fas fa-save me-2"></i>Update Product
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
            
            // Initialize facility image previews for existing items
            document.querySelectorAll('.facility-container input[type="file"]').forEach(input => {
                const containerId = input.id.replace('facility_image_', 'facilityPreview');
                input.addEventListener('change', function() {
                    previewImage(this, containerId);
                });
            });
            
            // Show current featured image in the upload container if exists
            <?php if (!empty($product['featured_image'])): ?>
                const featuredImagePreview = document.getElementById('featuredImagePreview');
                const featuredImageUpload = document.getElementById('featuredImageUpload');
                
                featuredImagePreview.src = '../assets/images/<?= htmlspecialchars($product['featured_image']) ?>';
                featuredImagePreview.style.display = 'block';
                featuredImageUpload.style.display = 'none';
            <?php endif; ?>
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
            const uploadProgress = document.getElementById('uploadProgress');
            const uploadProgressBar = document.getElementById('uploadProgressBar');
            
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
        let facilityCount = <?= !empty($facilities) ? count($facilities) : 1 ?>;
        
        function addFacility() {
            const container = document.getElementById('facilitiesContainer');
            const newFacility = document.createElement('div');
            newFacility.className = 'facility-container animate-fade-in';
            newFacility.innerHTML = `
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="facility-item">
                            <label class="form-label">Facility Name</label>
                            <input type="text" class="form-control" 
                                   name="facilities[${facilityCount}][name]" 
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
                    <input type="file" class="form-control" 
                           name="facilities_images[${facilityCount}]" 
                           id="facility_image_${facilityCount}" 
                           accept="image/jpeg, image/png, image/webp">
                    <div class="mt-2" id="facilityPreview${facilityCount}" style="display: none;">
                        <img class="thumbnail-preview" alt="Preview">
                        <div class="small text-muted mt-1">Image preview</div>
                    </div>
                </div>
                
                <button type="button" class="btn btn-danger btn-remove-facility" 
                        onclick="removeFacility(this)" title="Remove facility">
                    <i class="fas fa-trash"></i>
                </button>
            `;
            
            container.appendChild(newFacility);
            
            // Add event listener for the new facility image preview
            const fileInput = newFacility.querySelector('input[type="file"]');
            fileInput.addEventListener('change', function() {
                const containerId = `facilityPreview${facilityCount}`;
                previewImage(this, containerId);
            });
            
            facilityCount++;
            
            // Scroll to the new facility
            newFacility.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }
        
        function removeFacility(button) {
            const facilityContainer = button.closest('.facility-container');
            
            // Add fade-out animation before removal
            facilityContainer.style.opacity = '0';
            facilityContainer.style.transition = 'opacity 0.3s ease';
            
            setTimeout(() => {
                facilityContainer.remove();
            }, 300);
        }
        
        function removeImage(index) {
            const imageDeletedInput = document.getElementById(`image_deleted_${index}`);
            if (imageDeletedInput) {
                imageDeletedInput.value = '1';
            }
            
            const fileInput = document.getElementById(`facility_image_${index}`);
            if (fileInput) {
                fileInput.value = '';
            }
            
            const previewContainer = document.getElementById(`facilityPreview${index}`);
            if (previewContainer) {
                previewContainer.innerHTML = `
                    <div class="alert alert-warning p-2 mb-2">
                        <i class="fas fa-exclamation-circle me-1"></i>
                        Image will be removed when saved
                    </div>
                `;
            }
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
        
        // Form submission with AJAX
        document.getElementById('productForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (!this.checkValidity()) {
                return;
            }
            
            const submitBtn = document.getElementById('submitBtn');
            const originalBtnText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Saving...';
            submitBtn.disabled = true;
            
            const formData = new FormData(this);
            
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
            
            fetch(window.location.href, {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.status === 'success') {
                    showToast('success', data.message || 'Product successfully updated!');
                    
                    if (data.redirect) {
                        setTimeout(() => {
                            window.location.href = data.redirect;
                        }, 1500);
                    }
                } else {
                    throw new Error(data.message || 'An error occurred while updating the product');
                }
            })
            .catch(error => {
                showToast('danger', error.message);
            })
            .finally(() => {
                submitBtn.innerHTML = originalBtnText;
                submitBtn.disabled = false;
                
                const uploadProgress = document.getElementById('uploadProgress');
                if (uploadProgress) {
                    uploadProgress.style.display = 'none';
                }
            });
        });
        
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