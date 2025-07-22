<?php
session_start();
include 'koneksi.php';

// Jika sudah login, redirect ke index
if (isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit();
}

// Generate CSRF token jika belum ada
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// PROSES LOGIN
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validasi CSRF token
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        header("Location: login.php?error=csrf_invalid");
        exit();
    }

    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $remember = isset($_POST['remember']);

    // Cari user di database
    $stmt = $conn->prepare("SELECT * FROM admin_users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            // Set session
            $_SESSION['admin_id'] = $user['id'];
            $_SESSION['admin_username'] = $user['username'];

            // Remember me
            if ($remember) {
                $token = bin2hex(random_bytes(32));
                $expiry = date('Y-m-d H:i:s', strtotime('+7 days'));

                // Update database
                $stmt = $conn->prepare("UPDATE admin_users SET remember_token = ?, token_expiry = ? WHERE id = ?");
                $stmt->bind_param("ssi", $token, $expiry, $user['id']);
                $stmt->execute();

                // Set cookie
                setcookie('remember_token', $token, time() + (86400 * 7), "/", "", true, true);
            }

            // Redirect ke index
            header("Location: index.php");
            exit();
        } else {
            $error = "invalid_credentials";
        }
    } else {
        $error = "user_not_found";
    }

    // Jika ada error, redirect dengan parameter error
    if (isset($error)) {
        header("Location: login.php?error=" . $error);
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login Admin - Kiluan Negeri</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
  <style>
    :root {
  --primary: #4361ee;
  --secondary: #3f37c9;
  --accent: #4895ef;
  --dark: #1b263b;
  --light: #ffffff;
  --success: #4cc9f0;
  --danger: #f72585;
  --border-radius: 12px;
    }

    body {
      background: linear-gradient(135deg, var(--primary), var(--secondary));
      font-family: 'Poppins', sans-serif;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 20px;
      margin: 0;
    }

    .login-card {
      width: 100%;
      max-width: 430px;
      background-color: var(--light);
      border-radius: var(--border-radius);
      box-shadow: 0 20px 45px rgba(0, 0, 0, 0.15);
      overflow: hidden;
      animation: fadeIn 0.7s ease-in-out;
    }

    .card-header {
      background: linear-gradient(to right, var(--primary), var(--accent));
      padding: 30px 20px;
      color: white;
      text-align: center;
    }

    .card-header img {
      width: 60px;
      margin-bottom: 10px;
      filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.15));
    }

    .card-body {
      padding: 30px 25px;
      background-color: white;
    }

    .alert {
      font-size: 0.95rem;
      padding: 12px 15px;
      border-radius: 8px;
    }

    .form-label {
      font-weight: 600;
      margin-bottom: 6px;
    }

    .form-control {
      height: 45px;
      padding-left: 2.5rem; /* cukup untuk icon */
      padding-right: 2.5rem; /* agar tidak numpuk toggle mata password */
      border-radius: 10px;
      font-size: 0.95rem;
    }

    .input-icon {
      position: absolute;
      left: 15px;
      top: 50%;
      transform: translateY(-50%);
      color: var(--primary);
      font-size: 1rem;
      z-index: 3;
      pointer-events: none;
    }

    .password-toggle {
      position: absolute;
      right: 15px;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
      color: #6c757d;
      font-size: 1rem;
      z-index: 3;
    }

    .btn-login {
      background: linear-gradient(to right, var(--primary), var(--accent));
      color: white;
      height: 45px;
      border-radius: 10px;
      font-weight: 600;
      font-size: 0.95rem;
      border: none;
      transition: all 0.3s;
    }

    .btn-login:hover {
      background: linear-gradient(to right, var(--secondary), var(--primary));
    }

    .form-footer {
      margin-top: 20px;
      font-size: 0.85rem;
      color: #6c757d;
      text-align: center;
    }

    .form-footer a {
      color: var(--primary);
      font-weight: 600;
      text-decoration: none;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body>
  <div class="login-card">
    <div class="card-header">
      <img src="../assets/images/kiluan.png" alt="Logo" class="img-fluid">
      <h4 class="mb-1">Admin Portal</h4>
      <p class="mb-0">Kiluan Negeri Management System</p>
    </div>

    <div class="card-body">
      <!-- ALERT ERROR / SUCCESS -->
      <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <i class="fas fa-exclamation-circle me-2"></i>
          <?php
            $errors = [
              'invalid_credentials' => 'Username atau password salah!',
              'user_not_found' => 'Akun tidak ditemukan!',
              'login_required' => 'Silakan login terlebih dahulu!',
              'session_expired' => 'Sesi telah berakhir!',
              'access_denied' => 'Akses ditolak!'
            ];
            echo $errors[$_GET['error']] ?? 'Terjadi kesalahan saat login!';
          ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      <?php endif; ?>

      <!-- FORM -->
      <form action="login_process.php" method="POST" id="loginForm">
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <div class="position-relative">
            <i class="fas fa-user input-icon"></i>
            <input type="text" class="form-control ps-5" id="username" name="username" placeholder="Masukkan username" required>
          </div>
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <div class="position-relative">
            <i class="fas fa-lock input-icon"></i>
            <input type="password" class="form-control ps-5" id="password" name="password" placeholder="Masukkan password" required>
            <i class="fas fa-eye password-toggle" id="togglePassword"></i>
          </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-4">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="remember" name="remember">
            <label class="form-check-label" for="remember">Ingat saya</label>
          </div>
          <a href="forgot_password.php" class="text-decoration-none">Lupa password?</a>
        </div>

        <button type="submit" class="btn btn-login w-100">
          <span id="loginText"><i class="fas fa-sign-in-alt me-2"></i>Masuk</span>
          <span id="loginSpinner" class="d-none"><i class="fas fa-spinner fa-spin me-2"></i>Memproses...</span>
        </button>

        <div class="form-footer mt-3">
          © <?php echo date('Y'); ?> Kiluan Negeri. All rights reserved.
        </div>
      </form>
    </div>
  </div>

  <script>
    document.getElementById('togglePassword').addEventListener('click', function () {
      const password = document.getElementById('password');
      this.classList.toggle('fa-eye');
      this.classList.toggle('fa-eye-slash');
      password.type = password.type === 'password' ? 'text' : 'password';
    });

    document.getElementById('loginForm').addEventListener('submit', function () {
      document.getElementById('loginText').classList.add('d-none');
      document.getElementById('loginSpinner').classList.remove('d-none');
    });
  </script>
</body>