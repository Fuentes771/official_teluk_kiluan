<?php
session_start();
require 'koneksi.php';

header('Content-Type: application/json');

function response($success, $message) {
    echo json_encode(['success' => $success, 'message' => $message]);
    exit;
}

// Validasi CSRF
if (!isset($_POST['csrf_token'], $_SESSION['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    response(false, "Invalid CSRF token.");
}

// Ambil data
$nama      = trim($_POST['nama'] ?? '');
$deskripsi = trim($_POST['deskripsi'] ?? '');
$harga     = floatval($_POST['harga'] ?? 0);
$gambar    = $_FILES['gambar'] ?? null;

// Validasi data
if (!$nama || !$deskripsi || $harga <= 0 || !$gambar) {
    response(false, "Data tidak lengkap atau tidak valid.");
}

// Validasi file gambar
$allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];
$max_size = 2 * 1024 * 1024; // 2MB

$ext = strtolower(pathinfo($gambar['name'], PATHINFO_EXTENSION));
if (!in_array($ext, $allowed_ext)) {
    response(false, "File harus berupa gambar (jpg, png, gif).");
}

if ($gambar['size'] > $max_size) {
    response(false, "Ukuran gambar maksimal 2MB.");
}

// Upload gambar
$upload_dir = 'uploads/';
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0755, true);
}

$nama_file = uniqid('img_') . '.' . $ext;
$path_file = $upload_dir . $nama_file;

if (!move_uploaded_file($gambar['tmp_name'], $path_file)) {
    response(false, "Gagal mengupload gambar.");
}

// Simpan ke database
$stmt = $conn->prepare("INSERT INTO products (nama, deskripsi, harga, gambar) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssds", $nama, $deskripsi, $harga, $nama_file);

if ($stmt->execute()) {
    response(true, "Produk berhasil ditambahkan.");
} else {
    response(false, "Gagal menyimpan ke database.");
}
