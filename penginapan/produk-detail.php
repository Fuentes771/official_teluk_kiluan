<?php
$id = $_GET['id'];
$product = $conn->query("SELECT * FROM products WHERE id = $id")->fetch_assoc();
?>
<section class="container py-5">
  <div class="row">
    <div class="col-md-6">
      <img src="assets/uploads/<?= $product['image_path'] ?>" class="img-fluid">
    </div>
    <div class="col-md-6">
      <h1><?= $product['name'] ?></h1>
      <p><?= $product['description'] ?></p>
      <!-- ... -->
    </div>
  </div>
</section>


<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cheche Guesthouse - Penginapan Nyaman di Kiluan</title>
  
  <!-- Fonts & Icons -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  
  <!-- Animate.css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
</head>

<body>

  < class="product-card">
    <div class="product-header">
      <h1 class="product-title">Cheche Guesthouse</h1>
      <p class="product-subtitle">Penginapan Nyaman di Desa Kiluan Negeri</p>
    </div>
    
    <table class="contact-table">
      <tbody>
        <tr class="contact-row">
          <td class="contact-icon"><i class="fas fa-user"></i></td>
          <td class="contact-label">Pemilik</td>
          <td class="contact-value">Cheche Guesthouse</td>
        </tr>
        <tr class="contact-row">
          <td class="contact-icon"><i class="fas fa-map-marker-alt"></i></td>
          <td class="contact-label">Alamat</td>
          <td class="contact-value">Desa Kiluan Negeri, Lampung</td>
        </tr>
        <tr class="contact-row">
          <td class="contact-icon"><i class="fas fa-phone-alt"></i></td>
          <td class="contact-label">Telepon</td>
          <td class="contact-value"><a href="https://wa.me/6285379519990">+62 853-7951-9990</a></td>
        </tr>
      </tbody>
    </table>
    
    <div class="divider"></div>
    
    <div class="social-buttons">
      <a href="#" class="social-btn facebook-btn" title="Facebook"><i class="fab fa-facebook-f"></i></a>
      <a href="#" class="social-btn instagram-btn" title="Instagram"><i class="fab fa-instagram"></i></a>
      <a href="https://wa.me/6285379519990" class="social-btn whatsapp-btn" title="WhatsApp"><i class="fab fa-whatsapp"></i></a>
    </div>
    
    <!-- Description -->
    <div class="info-card animate__animated animate__fadeInUp">
      <h3><i class="fas fa-align-left"></i> Deskripsi</h3>
      <p>Cheche Guesthouse adalah penginapan yang terletak di Desa Kiluan Negeri, menawarkan pengalaman menginap yang nyaman dengan suasana alam yang menenangkan. Penginapan ini cocok untuk wisatawan yang ingin menikmati keindahan alam Kiluan.</p>
    </div>
    
    <!-- Facilities -->
    <div class="info-card animate__animated animate__fadeInUp">
      <h3><i class="fas fa-concierge-bell"></i> Fasilitas</h3>
      <div class="facilities">
        <div class="facility-item">
          <i class="fas fa-bed"></i>
          <span>Kamar tidur nyaman</span>
        </div>
        <div class="facility-item">
          <i class="fas fa-bath"></i>
          <span>Toilet bersih</span>
        </div>
        <div class="facility-item">
          <i class="fas fa-umbrella-beach"></i>
          <span>Area santai</span>
        </div>
        <div class="facility-item">
          <i class="fas fa-smile"></i>
          <span>Pelayanan ramah</span>
        </div>
      </div>
    </div>
    
    <!-- Price -->
    <div class="info-card animate__animated animate__fadeInUp" style="text-align: center;">
      <h3><i class="fas fa-tag"></i> Harga</h3>
      <div class="price-tag animate__animated animate__pulse animate__infinite">
        Rp 300.000 / malam
      </div>
      <p>Harga khusus untuk pemesanan mingguan atau bulanan</p>
    </div>
    
    <!-- Back Button -->
    <a href="../index.html#packages" class="btn animate__animated animate__fadeInUp">
      <i class="fas fa-arrow-left"></i> Kembali ke Produk
    </a>
  </div>
  
  <script>
    // Simple animation trigger
    document.addEventListener('DOMContentLoaded', function() {
      const animatedElements = document.querySelectorAll('.animate__animated');
      
      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.style.opacity = 1;
          }
        });
      }, {threshold: 0.1});
      
      animatedElements.forEach(el => {
        el.style.opacity = 0;
        observer.observe(el);
      });
    });
  </script>
</body>
</html>