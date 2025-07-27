<?php
$pageTitle = "Daftar Produk";
require '../includes/config.php';
require '../includes/header.php';

// Query untuk mendapatkan semua produk
$query = "SELECT * FROM products ORDER BY created_at DESC";
$result = $conn->query($query);
$products = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- CSS Links -->
    <link href="../assets/css/bootstrap.min.css?v=2" rel="stylesheet">
    <link href="../assets/css/style.css?v=2" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Belleza&display=swap" rel="stylesheet">
    
    <title><?= htmlspecialchars($pageTitle) ?> - Kiluan Negeri</title>
    
    <style>
        .product-card {
            transition: transform 0.3s, box-shadow 0.3s;
            height: 100%;
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .product-img {
            height: 200px;
            object-fit: cover;
        }
        .price-tag {
            position: absolute;
            top: 10px;
            right: 10px;
            background: rgba(0,0,0,0.7);
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            font-weight: bold;
        }
        .badge-umkm {
            background-color: #28a745;
        }
        .badge-pariwisata {
            background-color: #17a2b8;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid px-0">
    <a class="navbar-brand d-flex align-items-center gap-2" href="#">
      <img src="../assets/images/kiluan.png" alt="logo" class="logo-img">
      <img src="../assets/images/unila.png" alt="logo" class="logo-img">
      <span class="navbar-title">Umkm & Pariwisata</span>
    </a>  

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span><i class="fa-solid fa-bars"></i></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
      <ul class="navbar-nav mb-2 mb-lg-0">
        <li class="nav-item mx-1"><a class="nav-link" href="../index.php">Beranda</a></li>
        <li class="nav-item mx-1"><a class="nav-link active" href="produk.php">Produk</a></li>
        <li class="nav-item mx-1"><a class="nav-link" href="#about">Tentang Kami</a></li>
        <li class="nav-item mx-1"><a class="nav-link" href="#contact">Kontak</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Hero Section -->
<section class="hero-products text-white py-5 position-relative mb-0">
  <div class="overlay position-absolute top-0 start-0 w-100 h-100" style="background-color: rgba(0,0,0,0.5); z-index: 1;"></div>
  <div class="container position-relative z-2 text-center">
    <h1 class="display-5 fw-bold">Daftar Produk Kiluan Negeri</h1>
    <p class="lead">Temukan berbagai produk UMKM dan pariwisata terbaik dari Kiluan</p>
  </div>
</section>

<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="my-4">
  <div class="container">
    <ol class="breadcrumb mb-0">
      <li class="breadcrumb-item"><a href="../index.php">Beranda</a></li>
      <li class="breadcrumb-item active">Produk</li>
    </ol>
  </div>
</nav>

<!-- Filter Section -->
<section class="filter-section py-3 bg-light">
  <div class="container">
    <div class="row g-3">
      <div class="col-md-4">
        <select class="form-select" id="filterType">
          <option value="">Semua Tipe</option>
          <option value="UMKM">UMKM</option>
          <option value="Pariwisata">Pariwisata</option>
        </select>
      </div>
      <div class="col-md-4">
        <select class="form-select" id="filterLocation">
          <option value="">Semua Lokasi</option>
          <option value="Teluk Kiluan">Teluk Kiluan</option>
          <option value="Pantai Kiluan">Pantai Kiluan</option>
          <!-- Tambahkan opsi lokasi lainnya -->
        </select>
      </div>
      <div class="col-md-4">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Cari produk..." id="searchInput">
          <button class="btn btn-primary" type="button" id="searchButton">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Products Section -->
<section class="products-section py-5">
  <div class="container">
    <?php if (count($products) > 0): ?>
      <div class="row g-4" id="productsContainer">
        <?php foreach ($products as $product): ?>
          <div class="col-md-4 col-lg-3">
            <div class="card product-card h-100">
              <div class="position-relative">
                <img src="../assets/images/<?= htmlspecialchars($product['featured_image']) ?>" 
                     class="card-img-top product-img" 
                     alt="<?= htmlspecialchars($product['name']) ?>">
                <div class="price-tag">
                  Rp <?= number_format($product['price'], 0, ',', '.') ?>
                </div>
                <span class="badge position-absolute bottom-0 start-0 m-2 <?= $product['type'] == 'UMKM' ? 'badge-umkm' : 'badge-pariwisata' ?>">
                  <?= htmlspecialchars($product['type']) ?>
                </span>
              </div>
              <div class="card-body">
                <h5 class="card-title"><?= htmlspecialchars($product['name']) ?></h5>
                <p class="card-text text-muted small">
                  <i class="fas fa-map-marker-alt me-1"></i> 
                  <?= htmlspecialchars($product['location']) ?>
                </p>
                <p class="card-text text-truncate"><?= htmlspecialchars($product['description']) ?></p>
              </div>
              <div class="card-footer bg-white border-0">
                <a href="detail_produk.php?id=<?= $product['id'] ?>" class="btn btn-primary w-100">
                  Lihat Detail
                </a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php else: ?>
      <div class="text-center py-5">
        <img src="../assets/images/empty-state.svg" alt="No products" class="img-fluid mb-4" style="max-width: 300px;">
        <h4>Belum ada produk tersedia</h4>
        <p class="text-muted">Silakan kembali lagi nanti</p>
      </div>
    <?php endif; ?>
  </div>
</section>

<!-- Pagination -->
<?php if (count($products) > 0): ?>
<div class="container pb-5">
  <nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">
      <li class="page-item disabled">
        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
      </li>
      <li class="page-item active"><a class="page-link" href="#">1</a></li>
      <li class="page-item"><a class="page-link" href="#">2</a></li>
      <li class="page-item"><a class="page-link" href="#">3</a></li>
      <li class="page-item">
        <a class="page-link" href="#">Next</a>
      </li>
    </ul>
  </nav>
</div>
<?php endif; ?>

<script>
// Filter produk secara client-side
document.addEventListener('DOMContentLoaded', function() {
  const filterType = document.getElementById('filterType');
  const filterLocation = document.getElementById('filterLocation');
  const searchInput = document.getElementById('searchInput');
  const searchButton = document.getElementById('searchButton');
  const productsContainer = document.getElementById('productsContainer');
  
  function filterProducts() {
    const typeValue = filterType.value.toLowerCase();
    const locationValue = filterLocation.value.toLowerCase();
    const searchValue = searchInput.value.toLowerCase();
    
    const productCards = productsContainer.querySelectorAll('.col-md-4.col-lg-3');
    
    productCards.forEach(card => {
      const type = card.querySelector('.badge').textContent.toLowerCase();
      const location = card.querySelector('.card-text.text-muted.small').textContent.toLowerCase();
      const title = card.querySelector('.card-title').textContent.toLowerCase();
      const description = card.querySelector('.card-text:not(.text-muted)').textContent.toLowerCase();
      
      const typeMatch = typeValue === '' || type.includes(typeValue);
      const locationMatch = locationValue === '' || location.includes(locationValue);
      const searchMatch = searchValue === '' || 
                         title.includes(searchValue) || 
                         description.includes(searchValue);
      
      if (typeMatch && locationMatch && searchMatch) {
        card.style.display = 'block';
      } else {
        card.style.display = 'none';
      }
    });
  }
  
  filterType.addEventListener('change', filterProducts);
  filterLocation.addEventListener('change', filterProducts);
  searchButton.addEventListener('click', filterProducts);
  searchInput.addEventListener('keyup', function(e) {
    if (e.key === 'Enter') filterProducts();
  });
});
</script>

<?php require '../includes/footer.php'; ?>