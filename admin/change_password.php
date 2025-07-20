<?php
session_start();
include 'koneksi.php'; // Sesuaikan dengan file koneksi ke database

// Pastikan user sudah login
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

$admin_id = $_SESSION['admin_id'];
$msg = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $current_password = $_POST['current_password'];
    $new_password     = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Ambil password lama dari database
    $query = "SELECT password FROM admin_users WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $admin_id);
    $stmt->execute();
    $stmt->bind_result($db_password);
    $stmt->fetch();
    $stmt->close();

    // Verifikasi password lama
    if (!password_verify($current_password, $db_password)) {
        $msg = "Password lama tidak sesuai!";
    } elseif ($new_password !== $confirm_password) {
        $msg = "Konfirmasi password tidak cocok!";
    } else {
        // Hash password baru
        $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Update password di database
        $update = "UPDATE admin_users SET password = ? WHERE id = ?";
        $stmt2 = $conn->prepare($update);
        $stmt2->bind_param("si", $hashed_new_password, $admin_id);
        if ($stmt2->execute()) {
            $msg = "Password berhasil diubah.";
        } else {
            $msg = "Gagal mengubah password.";
        }
        $stmt2->close();
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Ganti Password</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
  <div class="card col-md-6 offset-md-3 shadow-lg">
    <div class="card-header bg-primary text-white">
      <h5 class="mb-0">Ganti Password</h5>
    </div>
    <div class="card-body">
      <?php if ($msg): ?>
        <div class="alert alert-info"><?= $msg ?></div>
      <?php endif; ?>
      <form method="POST">
        <div class="mb-3">
          <label>Password Lama</label>
          <input type="password" name="current_password" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Password Baru</label>
          <input type="password" name="new_password" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Konfirmasi Password Baru</label>
          <input type="password" name="confirm_password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Ubah Password</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
      </form>
    </div>
  </div>
</div>
</body>
</html>
