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
    
    header("Location: products.php?success=1");
    exit();
}
?>

<!-- Form untuk menambah produk -->
<form method="POST" enctype="multipart/form-data">
  <div class="mb-3">
    <label>Nama Produk</label>
    <input type="text" name="name" class="form-control" required>
  </div>
  
  <div class="mb-3">
    <label>Deskripsi</label>
    <textarea name="description" class="form-control" required></textarea>
  </div>
  
  <div class="mb-3">
    <label>Harga</label>
    <input type="number" name="price" class="form-control" required>
  </div>
  
  <div class="mb-3">
    <label>Tipe Produk</label>
    <select name="type" class="form-control" required>
      <option value="guesthouse">Penginapan</option>
      <option value="food">Makanan</option>
      <option value="souvenir">Souvenir</option>
    </select>
  </div>
  
  <div class="mb-3">
    <label>Pemilik</label>
    <input type="text" name="owner" class="form-control">
  </div>
  
  <div class="mb-3">
    <label>Lokasi</label>
    <input type="text" name="location" class="form-control">
  </div>
  
  <div class="mb-3">
    <label>Telepon</label>
    <input type="text" name="phone" class="form-control">
  </div>
  
  <div class="mb-3">
    <label>Gambar Utama</label>
    <input type="file" name="featured_image" class="form-control" required>
  </div>
  
  <div class="mb-3">
    <label>Fasilitas</label>
    <div id="facilities-container">
      <div class="facility-item mb-2">
        <input type="text" name="facilities[0][name]" placeholder="Nama fasilitas" class="form-control">
      </div>
    </div>
    <button type="button" class="btn btn-sm btn-secondary" onclick="addFacility()">Tambah Fasilitas</button>
  </div>
  
  <div class="mb-3">
    <label>Gambar Tambahan</label>
    <input type="file" name="additional_images[]" class="form-control" multiple>
  </div>
  
  <button type="submit" name="add_product" class="btn btn-primary">Simpan Produk</button>
</form>

<script>
let facilityCount = 1;
function addFacility() {
    const container = document.getElementById('facilities-container');
    const newFacility = document.createElement('div');
    newFacility.className = 'facility-item mb-2';
    newFacility.innerHTML = `
        <input type="text" name="facilities[${facilityCount}][name]" placeholder="Nama fasilitas" class="form-control">
    `;
    container.appendChild(newFacility);
    facilityCount++;
}
</script>