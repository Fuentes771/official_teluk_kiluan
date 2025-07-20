<?php
session_start();
include 'koneksi.php';

// Hapus token dari DB
if (isset($_SESSION['admin_id'])) {
  $stmt = $conn->prepare("UPDATE admin_users SET remember_token = NULL, token_expiry = NULL WHERE id = ?");
  $stmt->bind_param("i", $_SESSION['admin_id']);
  $stmt->execute();
}

// Hapus session dan cookie
session_unset();
session_destroy();

setcookie('remember_token', '', time() - 3600, "/");

header("Location: login.php");
exit;
?>
