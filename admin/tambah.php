<?php
// admin/products.php
require '../includes/config.php';

// Tambah produk
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_product'])) {
    $name = $conn->real_escape_string($_POST['name']);
    $description = $conn->real_escape_string($_POST['description']);
    $price = floatval($_POST['price']);
    $type = $conn->real_escape_string($_POST['type']);
    $owner = $conn->real_escape_string($_POST['owner']);
    $location = $conn->real_escape_string($_POST['location']);
    $phone = $conn->real_escape_string($_POST['phone']);
    
    // Upload gambar
    $imageName = '';
    if ($_FILES['featured_image']['error'] == 0) {
        $imageName = time() . '_' . basename($_FILES['featured_image']['name']);
        move_uploaded_file($_FILES['featured_image']['tmp_name'], '../assets/images/' . $imageName);
    }
    
    $query = "INSERT INTO products (type, name, description, price, owner, location, phone, featured_image) 
              VALUES ('$type', '$name', '$description', $price, '$owner', '$location', '$phone', '$imageName')";
    $conn->query($query);
    
    $productId = $conn->insert_id;
    
    // Tambah fasilitas
    if (isset($_POST['facilities'])) {
        foreach ($_POST['facilities'] as $facility) {
            $facility = $conn->real_escape_string($facility['name']);
            $conn->query("INSERT INTO product_facilities (product_id, facility) VALUES ($productId, '$facility')");
        }
    }
    
    // Tambah gambar tambahan
    if (!empty($_FILES['additional_images']['name'][0])) {
        foreach ($_FILES['additional_images']['tmp_name'] as $key => $tmpName) {
            $imageName = time() . '_' . $key . '_' . basename($_FILES['additional_images']['name'][$key]);
            move_uploaded_file($tmpName, '../assets/images/' . $imageName);
            $conn->query("INSERT INTO product_images (product_id, image_path) VALUES ($productId, '$imageName')");
        }
    }
    
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Produk Baru</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f5f6fa;
      margin: 0;
      padding: 30px;
    }

    h2 {
      color: #2d3436;
      margin-bottom: 20px;
    }

    form {
      background: #ffffff;
      padding: 25px;
      border-radius: 10px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      max-width: 700px;
      margin: auto;
    }

    label {
      display: block;
      margin-top: 15px;
      margin-bottom: 5px;
      font-weight: bold;
    }

    input[type="text"],
    input[type="number"],
    input[type="file"],
    textarea,
    select {
      width: 100%;
      padding: 10px;
      border: 1px solid #dcdde1;
      border-radius: 5px;
      box-sizing: border-box;
      margin-bottom: 10px;
    }

    button, input[type="submit"] {
      background-color: #0984e3;
      color: #fff;
      border: none;
      padding: 10px 18px;
      border-radius: 5px;
      cursor: pointer;
      font-weight: bold;
      margin-top: 10px;
    }

    button:hover, input[type="submit"]:hover {
      background-color: #74b9ff;
    }

    .note {
      font-size: 0.9em;
      color: #636e72;
    }

    .fasilitas-container {
      display: flex;
      flex-wrap: wrap;
      gap: 5px;
      margin-top: 5px;
    }

    .fasilitas-container input {
      width: 90%;
    }
  </style>
</head>
<body>

<h2>Tambah Produk Baru</h2>

<form action="proses_tambah.php" method="post" enctype="multipart/form-data">
  <label for="nama">Nama Produk</label>
  <input type="text" name="nama" id="nama" placeholder="Contoh: Villa Asri" required>

  <label for="deskripsi">Deskripsi</label>
  <textarea name="deskripsi" id="deskripsi" placeholder="Tuliskan deskripsi produk..." rows="4"></textarea>

  <label for="harga">Harga</label>
  <input type="number" name="harga" id="harga" placeholder="Contoh: 150000" required>

  <label for="tipe">Tipe Produk</label>
  <select name="tipe" id="tipe" required>
    <option value="">Pilih tipe produk</option>
    <option value="UMKM">UMKM</option>
    <option value="Pariwisata">Pariwisata</option>
  </select>

  <label for="pemilik">Pemilik</label>
  <input type="text" name="pemilik" id="pemilik" placeholder="Nama pemilik produk">

  <label for="lokasi">Lokasi</label>
  <input type="text" name="lokasi" id="lokasi" placeholder="Contoh: Teluk Kiluan">

  <label for="telepon">Telepon</label>
  <input type="text" name="telepon" id="telepon" placeholder="08xxxxxxx">

  <label for="gambar_utama">Gambar Utama</label>
  <input type="file" name="gambar_utama" id="gambar_utama" required>

  <label for="fasilitas">Fasilitas</label>
  <div class="fasilitas-container">
    <input type="text" name="fasilitas[]" placeholder="Contoh: Wifi Gratis">
    <button type="button" onclick="tambahFasilitas()">+ Tambah Fasilitas</button>
  </div>

  <label for="gambar_tambahan">Gambar Tambahan</label>
  <input type="file" name="gambar_tambahan[]" id="gambar_tambahan" multiple>
  <span class="note">Bisa pilih beberapa gambar sekaligus</span>

  <br>
  <input type="submit" value="Simpan Produk">
</form>

<script>
  function tambahFasilitas() {
    const container = document.querySelector('.fasilitas-container');
    const input = document.createElement('input');
    input.type = 'text';
    input.name = 'fasilitas[]';
    input.placeholder = 'Contoh: AC, Dapur, dll';
    container.insertBefore(input, container.lastElementChild);
  }
</script>

</body>
</html>
