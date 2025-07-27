<?php
// Start session securely
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
}

// Cek apakah admin sudah login
if (!isset($_SESSION['admin_id'])) {
    // Jika belum login, redirect ke halaman login
    header("Location: login.php");
    exit(); // Pastikan tidak ada kode yang dieksekusi setelah redirect
}

$isLoggedIn = true; // Karena sudah dipastikan login di atas
include 'koneksi.php';

$productsQuery = "SELECT * FROM products ORDER BY created_at DESC";
$productsResult = $conn->query($productsQuery);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Adin - Kiluan Negeri</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://kit.fontawesome.com/yourkit.js" crossorigin="anonymous"></script>
</head>
  <?php include 'navbar.php'; ?>
<body class="bg-light">

  <div class="container mt-5 mb-5">
    <h1 class="text-center mb-4">Dashboard Admin</h1>
    <div class="d-flex justify-content-end mb-3">
      <a href="tambah.php" class="btn btn-success">+ Tambah Produk Baru</a>
    </div>

    <h3 class="mb-3">Daftar Produk</h3>
    <div class="row">
      <?php while ($product = $productsResult->fetch_assoc()): ?>
      <div class="col-md-4 mb-4">
        <div class="card shadow h-100">
          <img src="../assets/images/<?= htmlspecialchars($product['featured_image']) ?>" 
               class="card-img-top" 
               style="height: 250px; object-fit: cover;" 
               alt="<?= htmlspecialchars($product['name']) ?>">
          <div class="card-body text-center">
            <h5 class="card-title fw-bold"><?= htmlspecialchars($product['name']) ?></h5>
            <p class="card-text"><?= htmlspecialchars(substr($product['description'], 0, 100)) ?>...</p>
            <h6 class="text-muted">Rp <?= number_format($product['price'], 0, ',', '.') ?></h6>
          </div>
          <div class="card-footer text-center bg-white border-0 pb-3">
            <a href="edit.php?id=<?= $product['id'] ?>" class="btn btn-sm btn-warning me-2">
              <i class="fas fa-edit"></i> Edit
            </a>
            <a href="hapus.php?id=<?= $product['id'] ?>" 
               class="btn btn-sm btn-danger" 
               onclick="return confirm('Yakin ingin menghapus produk ini?')">
              <i class="fas fa-trash"></i> Hapus
            </a>
          </div>
        </div>
      </div>
      <?php endwhile; ?>
    </div>
  </div>

</body>
</html>