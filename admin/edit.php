<?php
include('koneksi.php');

// Ambil data produk berdasarkan ID
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $result = $conn->query("SELECT * FROM products WHERE id = $id");

    if ($result->num_rows === 0) {
        die("Produk tidak ditemukan.");
    }

    $product = $result->fetch_assoc();
} else {
    die("ID produk tidak diberikan.");
}

// Proses saat form dikirim
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['name'];
    $deskripsi = $_POST['description'];
    $harga = $_POST['price'];

    // Jika ada gambar baru diunggah
    if ($_FILES['featured_image']['name']) {
        $gambar = $_FILES['featured_image']['name'];
        move_uploaded_file($_FILES['featured_image']['tmp_name'], "../assets/images/" . $gambar);
        $query = "UPDATE products SET name='$nama', description='$deskripsi', price='$harga', featured_image='$gambar' WHERE id=$id";
    } else {
        $query = "UPDATE products SET name='$nama', description='$deskripsi', price='$harga' WHERE id=$id";
    }

    if ($conn->query($query)) {
        header("Location: index.php?edit=berhasil");
        exit();
    } else {
        echo "Gagal mengupdate: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Produk</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f5f7fa;
      margin: 0;
      padding: 0;
    }
    .container {
      max-width: 700px;
      margin: 50px auto;
      background: white;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
    }
    h2 {
      text-align: center;
      margin-bottom: 30px;
      color: #333;
    }
    label {
      font-weight: bold;
      margin-bottom: 5px;
      display: block;
    }
    input[type="text"], input[type="number"], textarea, input[type="file"] {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 8px;
      margin-bottom: 20px;
    }
    button, a.btn {
      padding: 10px 20px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      text-decoration: none;
      font-weight: bold;
    }
    button.btn-primary {
      background-color: #007bff;
      color: white;
    }
    a.btn-secondary {
      background-color: #6c757d;
      color: white;
      margin-left: 10px;
    }
    img.img-thumbnail {
      margin-top: 10px;
      max-height: 150px;
      border-radius: 8px;
    }
  </style>
</head>
<body>

<div class="container">
  <h2>Edit Produk</h2>
  <form method="POST" enctype="multipart/form-data">
    <label>Nama Produk</label>
    <input type="text" name="name" value="<?= htmlspecialchars($product['name']) ?>" required>

    <label>Deskripsi</label>
    <textarea name="description" required><?= htmlspecialchars($product['description']) ?></textarea>

    <label>Harga</label>
    <input type="number" name="price" value="<?= htmlspecialchars($product['price']) ?>" required>

    <label>Gambar Produk (biarkan kosong jika tidak diganti)</label>
    <input type="file" name="featured_image">
    <img src="../assets/images/<?= $product['featured_image'] ?>" class="img-thumbnail">

    <div>
      <button type="submit" class="btn btn-primary">Update Produk</button>
      <a href="index.php" class="btn btn-secondary">Kembali</a>
    </div>
  </form>
</div>

</body>
</html>
