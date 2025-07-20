<?php
include('koneksi.php'); // atau koneksi.php tergantung file kamu

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Hapus data dari tabel
    $query = "DELETE FROM products WHERE id = $id";
    if ($conn->query($query)) {
        header("Location: index.php?hapus=berhasil");
        exit();
    } else {
        echo "Gagal menghapus produk: " . $conn->error;
    }
} else {
    echo "ID produk tidak ditemukan.";
}
?>
