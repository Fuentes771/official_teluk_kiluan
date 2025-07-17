<form action="process-product.php" method="POST" enctype="multipart/form-data">
  <div class="mb-3">
    <label>Nama Produk</label>
    <input type="text" name="name" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Gambar</label>
    <input type="file" name="image" accept="image/*" required>
  </div>
  <button type="submit" class="btn" id="btn-new">Simpan</button>
</form>