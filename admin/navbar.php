<?php
// navbar.php

// Cek session untuk menentukan menu yang ditampilkan
$isLoggedIn = isset($_SESSION['admin_id']);
$isDeveloper = $isLoggedIn && $_SESSION['admin_role'] === 'admin';
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - Teluk Kiluan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    :root {
      --primary: #4361ee;
      --secondary: #3f37c9;
      --accent: #4895ef;
      --dark: #1b263b;
      --light: #f8f9fa;
    }

    .navbar {
      background: linear-gradient(to right, var(--primary), var(--secondary));
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      padding: 0.75rem 1rem;
    }

    .navbar-brand {
      font-weight: 700;
      letter-spacing: 0.5px;
      display: flex;
      align-items: center;
    }

    .navbar-brand img {
      height: 30px;
      margin-right: 10px;
    }

    .nav-link {
      color: rgba(255, 255, 255, 0.85) !important;
      font-weight: 500;
      padding: 0.5rem 1rem;
      margin: 0 0.1rem;
      border-radius: 5px;
      transition: all 0.3s;
    }

    .nav-link:hover, .nav-link.active {
      color: white !important;
      background-color: rgba(255, 255, 255, 0.15);
    }

    .nav-link i {
      margin-right: 6px;
      width: 20px;
      text-align: center;
    }

    .dropdown-menu {
      border: none;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
      padding: 0.5rem 0;
    }

    .dropdown-item {
      padding: 0.5rem 1.5rem;
      font-weight: 500;
      color: var(--dark);
      transition: all 0.2s;
    }

    .dropdown-item:hover {
      background-color: var(--primary);
      color: white;
    }

    .dropdown-divider {
      border-color: #eee;
    }

    .user-avatar {
      width: 35px;
      height: 35px;
      border-radius: 50%;
      object-fit: cover;
      border: 2px solid rgba(255, 255, 255, 0.5);
    }

    .badge-notification {
      position: absolute;
      top: -5px;
      right: -5px;
      font-size: 0.6rem;
      padding: 3px 6px;
    }

    @media (max-width: 991.98px) {
      .navbar-collapse {
        padding: 1rem 0;
      }

      .nav-link {
        margin: 0.2rem 0;
        padding: 0.5rem 1rem;
      }

      .dropdown-menu {
        box-shadow: none;
        border-radius: 0;
        border: none;
      }
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">
        <img src="../assets/images/kiluan.png" alt="Logo">
        Kiluan Negeri
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarContent">
        <?php if ($isLoggedIn): ?>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link <?= $currentPage === 'index.php' ? 'active' : '' ?>" href="index.php">
              <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>
          </li>

          <?php if ($isDeveloper): ?>
          <li class="nav-item">
            <a class="nav-link <?= $currentPage === 'create_account.php' ? 'active' : '' ?>" href="create_account.php">
              <i class="fas fa-user-plus"></i> Buat Akun
            </a>
          </li>
          <?php endif; ?>
        </ul>
        <?php endif; ?>

        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <?php if ($isLoggedIn): ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="https://ui-avatars.com/api/?name=<?= urlencode($_SESSION['admin_fullname'] ?? 'Admin') ?>&background=random" class="user-avatar me-1" alt="User">
              <?= htmlspecialchars($_SESSION['admin_fullname'] ?? 'Admin') ?>
              <span class="badge bg-success badge-notification"><?= $_SESSION['admin_role'] === 'developer' ? 'Dev' : 'Admin' ?></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
              <li>
                <a class="dropdown-item" href="change_password.php">
                  <i class="fas fa-key me-2"></i>Ganti Password
                </a>
              </li>
              <li><hr class="dropdown-divider"></li>
              <li>
                <a class="dropdown-item text-danger" href="logout.php">
                  <i class="fas fa-sign-out-alt me-2"></i>Logout
                </a>
              </li>
            </ul>
          </li>
          <?php else: ?>
          <li class="nav-item">
            <a class="nav-link <?= $currentPage === 'login.php' ? 'active' : '' ?>" href="login.php">
              <i class="fas fa-sign-in-alt"></i> Login
            </a>
          </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    document.querySelectorAll('.nav-link').forEach(link => {
      if (link.href === window.location.href) {
        link.classList.add('active');
        let parentDropdown = link.closest('.dropdown-menu');
        if (parentDropdown) {
          parentDropdown.previousElementSibling.classList.add('active');
        }
      }
    });
  </script>
</body>
</html>