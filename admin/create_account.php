<?php
require 'koneksi.php';

// Only allow developers to access this page
if (!isset($_SESSION['admin_id']) || $_SESSION['admin_role'] !== 'developer') {
    header("Location: login.php?error=access_denied");
    exit();
}

// Initialize variables
$username = $full_name = $email = '';
$errors = [];

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate CSRF token
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $errors[] = "Invalid CSRF token!";
    }

    // Sanitize and validate inputs
    $username = trim($conn->real_escape_string($_POST['username'] ?? ''));
    $password = $_POST['password'] ?? '';
    $password_confirm = $_POST['password_confirm'] ?? '';
    $full_name = trim($conn->real_escape_string($_POST['full_name'] ?? ''));
    $email = trim($conn->real_escape_string($_POST['email'] ?? ''));
    $role = 'admin'; // Default role

    // Validate username
    if (empty($username)) {
        $errors[] = "Username harus diisi!";
    } elseif (!preg_match('/^[a-zA-Z0-9_]{4,20}$/', $username)) {
        $errors[] = "Username hanya boleh mengandung huruf, angka, dan underscore (4-20 karakter)!";
    } else {
        // Check if username exists
        $check = $conn->prepare("SELECT id FROM admin_users WHERE username = ?");
        $check->bind_param("s", $username);
        $check->execute();
        if ($check->get_result()->num_rows > 0) {
            $errors[] = "Username sudah digunakan!";
        }
        $check->close();
    }

    // Validate password
    if (empty($password)) {
        $errors[] = "Password harus diisi!";
    } elseif (strlen($password) < 8) {
        $errors[] = "Password minimal 8 karakter!";
    } elseif ($password !== $password_confirm) {
        $errors[] = "Konfirmasi password tidak cocok!";
    }

    // Validate full name
    if (empty($full_name)) {
        $errors[] = "Nama lengkap harus diisi!";
    }

    // Validate email
    if (empty($email)) {
        $errors[] = "Email harus diisi!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Format email tidak valid!";
    } else {
        // Check if email exists
        $check = $conn->prepare("SELECT id FROM admin_users WHERE email = ?");
        $check->bind_param("s", $email);
        $check->execute();
        if ($check->get_result()->num_rows > 0) {
            $errors[] = "Email sudah digunakan!";
        }
        $check->close();
    }

    // If no errors, create account
    if (empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
        
        $stmt = $conn->prepare("INSERT INTO admin_users (username, password, full_name, email, role, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
        $stmt->bind_param("sssss", $username, $hashed_password, $full_name, $email, $role);
        
        if ($stmt->execute()) {
            $_SESSION['success'] = "Akun admin berhasil dibuat!";
            header("Location: create_account.php");
            exit();
        } else {
            $errors[] = "Gagal membuat akun: " . $conn->error;
        }
        
        $stmt->close();
    }
}

// Generate new CSRF token
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Buat Akun Admin - Teluk Kiluan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
  <style>
    :root {
      --primary: #4361ee;
      --secondary: #3f37c9;
      --accent: #4895ef;
      --dark: #1b263b;
      --light: #f8f9fa;
    }
    
    body {
      background-color: #f5f7fa;
      font-family: 'Poppins', sans-serif;
    }
    
    .developer-card {
      max-width: 650px;
      margin: 30px auto;
      border-radius: 15px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
      border: none;
      overflow: hidden;
    }
    
    .card-header {
      background: linear-gradient(to right, var(--primary), var(--secondary));
      color: white;
      padding: 20px;
      border-bottom: none;
    }
    
    .card-body {
      padding: 30px;
    }
    
    .form-label {
      font-weight: 600;
      color: var(--dark);
    }
    
    .form-control {
      border-radius: 8px;
      padding: 12px 15px;
      border: 1px solid #e0e0e0;
    }
    
    .form-control:focus {
      border-color: var(--accent);
      box-shadow: 0 0 0 0.25rem rgba(67, 97, 238, 0.25);
    }
    
    .btn-primary {
      background: linear-gradient(to right, var(--primary), var(--accent));
      border: none;
      padding: 12px;
      font-weight: 600;
      letter-spacing: 0.5px;
      text-transform: uppercase;
    }
    
    .btn-primary:hover {
      background: linear-gradient(to right, var(--secondary), var(--primary));
    }
    
    .password-strength {
      height: 5px;
      background-color: #e9ecef;
      margin-top: 5px;
      border-radius: 5px;
      overflow: hidden;
    }
    
    .strength-0 { width: 0%; background-color: #dc3545; }
    .strength-1 { width: 25%; background-color: #dc3545; }
    .strength-2 { width: 50%; background-color: #fd7e14; }
    .strength-3 { width: 75%; background-color: #ffc107; }
    .strength-4 { width: 100%; background-color: #28a745; }
    
    .password-hints {
      font-size: 0.8rem;
      color: #6c757d;
      margin-top: 5px;
    }
    
    @media (max-width: 768px) {
      .developer-card {
        margin: 15px;
      }
      
      .card-body {
        padding: 20px;
      }
    }
  </style>
</head>
<body>
  <?php include 'navbar.php'; ?>
  
  <div class="container py-4">
    <div class="card developer-card animate__animated animate__fadeIn">
      <div class="card-header text-center">
        <h4><i class="fas fa-user-shield me-2"></i> Buat Akun Admin Baru</h4>
        <p class="mb-0">Halaman ini hanya dapat diakses oleh Developer</p>
      </div>
      
      <div class="card-body">
        <?php if (isset($_SESSION['success'])): ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i> <?php echo $_SESSION['success']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          <?php unset($_SESSION['success']); ?>
        <?php endif; ?>
        
        <?php if (!empty($errors)): ?>
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>
            <?php foreach ($errors as $error): ?>
              <div><?php echo $error; ?></div>
            <?php endforeach; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php endif; ?>
        
        <form method="POST" id="accountForm">
          <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
          
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
              <small class="text-muted">4-20 karakter (huruf, angka, underscore)</small>
            </div>
            
            <div class="col-md-6 mb-3">
              <label for="full_name" class="form-label">Nama Lengkap</label>
              <input type="text" class="form-control" id="full_name" name="full_name" value="<?php echo htmlspecialchars($full_name); ?>" required>
            </div>
          </div>
          
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
          </div>
          
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password" required>
              <div class="password-strength" id="passwordStrength"></div>
              <div class="password-hints">
                Password harus mengandung:
                <ul class="mb-0">
                  <li id="lengthHint">Minimal 8 karakter</li>
                  <li id="uppercaseHint">Huruf besar</li>
                  <li id="numberHint">Angka</li>
                  <li id="specialHint">Karakter khusus</li>
                </ul>
              </div>
            </div>
            
            <div class="col-md-6 mb-3">
              <label for="password_confirm" class="form-label">Konfirmasi Password</label>
              <input type="password" class="form-control" id="password_confirm" name="password_confirm" required>
              <div id="passwordMatch" class="mt-1"></div>
            </div>
          </div>
          
          <div class="d-grid">
            <button type="submit" class="btn btn-primary btn-lg">
              <i class="fas fa-user-plus me-2"></i> Buat Akun Admin
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Password strength checker
    document.getElementById('password').addEventListener('input', function() {
      const password = this.value;
      const strengthBar = document.getElementById('passwordStrength');
      const hints = {
        length: document.getElementById('lengthHint'),
        uppercase: document.getElementById('uppercaseHint'),
        number: document.getElementById('numberHint'),
        special: document.getElementById('specialHint')
      };
      
      let strength = 0;
      
      // Check password length
      if (password.length >= 8) {
        strength++;
        hints.length.style.color = '#28a745';
        hints.length.innerHTML = '<i class="fas fa-check"></i> Minimal 8 karakter';
      } else {
        hints.length.style.color = '#dc3545';
        hints.length.innerHTML = '<i class="fas fa-times"></i> Minimal 8 karakter';
      }
      
      // Check for uppercase letters
      if (/[A-Z]/.test(password)) {
        strength++;
        hints.uppercase.style.color = '#28a745';
        hints.uppercase.innerHTML = '<i class="fas fa-check"></i> Huruf besar';
      } else {
        hints.uppercase.style.color = '#dc3545';
        hints.uppercase.innerHTML = '<i class="fas fa-times"></i> Huruf besar';
      }
      
      // Check for numbers
      if (/[0-9]/.test(password)) {
        strength++;
        hints.number.style.color = '#28a745';
        hints.number.innerHTML = '<i class="fas fa-check"></i> Angka';
      } else {
        hints.number.style.color = '#dc3545';
        hints.number.innerHTML = '<i class="fas fa-times"></i> Angka';
      }
      
      // Check for special characters
      if (/[^A-Za-z0-9]/.test(password)) {
        strength++;
        hints.special.style.color = '#28a745';
        hints.special.innerHTML = '<i class="fas fa-check"></i> Karakter khusus';
      } else {
        hints.special.style.color = '#dc3545';
        hints.special.innerHTML = '<i class="fas fa-times"></i> Karakter khusus';
      }
      
      // Update strength bar
      strengthBar.className = 'strength-' + strength;
    });
    
    // Password match checker
    document.getElementById('password_confirm').addEventListener('input', function() {
      const password = document.getElementById('password').value;
      const confirmPassword = this.value;
      const matchIndicator = document.getElementById('passwordMatch');
      
      if (confirmPassword.length === 0) {
        matchIndicator.innerHTML = '';
      } else if (password === confirmPassword) {
        matchIndicator.innerHTML = '<span style="color:#28a745;"><i class="fas fa-check-circle"></i> Password cocok</span>';
      } else {
        matchIndicator.innerHTML = '<span style="color:#dc3545;"><i class="fas fa-times-circle"></i> Password tidak cocok</span>';
      }
    });
    
    // Form submission handler
    document.getElementById('accountForm').addEventListener('submit', function(e) {
      const password = document.getElementById('password').value;
      const confirmPassword = document.getElementById('password_confirm').value;
      
      if (password !== confirmPassword) {
        e.preventDefault();
        alert('Password dan konfirmasi password tidak cocok!');
      }
    });
  </script>
</body>
</html>