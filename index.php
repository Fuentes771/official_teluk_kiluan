<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Official Teluk Kiluan</title>
  <link rel="shortcut icon" href="assets/images/kiluan.png">

  <!-- css Link -->
  <link href="assets/css/bootstrap.min.css?v=2" rel="stylesheet">
  <link href="assets/css/style.css?v=2" rel="stylesheet">

  <!-- AOS Library -->
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css?v=2" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js?v=2"></script>

  <!-- Font Awesome Cdn -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css?v=2" rel="stylesheet">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap?v=2" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Belleza&display=swap?v=2" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Lora&family=Playfair+Display:wght@600&display=swap?v=2" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap?v=2" rel="stylesheet">

  <!-- Bootstrap Icons CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css?v=2">
</head>

<body>

<?php
require 'includes/config.php';
?>

<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid px-0">
    <a class="navbar-brand d-flex align-items-center gap-2" href="#">
      <img src="assets/images/kiluan.png" alt="logo" class="logo-img">
      <img src="assets/images/unila.png" alt="logo" class="logo-img">
      <span class="navbar-title">Umkm & Pariwisata</span>
    </a>  

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span><i class="fa-solid fa-bars"></i></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
      <ul class="navbar-nav mb-2 mb-lg-0">
        <li class="nav-item mx-1"><a class="nav-link active" aria-current="page" href="index.php">Beranda</a></li>
        <li class="nav-item mx-1"><a class="nav-link" href="#about">Informasi</a></li>
        <li class="nav-item mx-1"><a class="nav-link" href="#services">Pelayanan</a></li>
        <li class="nav-item mx-1"><a class="nav-link" href="#gallery">Galeri foto</a></li>
        <li class="nav-item mx-1"><a class="nav-link" href="#packages">Produk</a></li>
        <li class="nav-item mx-1"><a class="nav-link" href="#location">Lokasi</a></li>
      </ul>
    </div>
  </div>
</nav>
<!-- Navbar End -->

  <!-- Home Section Start -->
  <section class="home">
    <div class="container">
      <h5>Selamat Datang di Teluk Kiluan</h5>
      <p>"Surga tersembunyi dengan pantai berpasir putih dan bukit hijau yang memukau.
          Temukan pengalaman wisata alam yang tak terlupakan di salah satu destinasi terbaik Lampung."</p>
      <a href="#about" class="btn" id="btn-new">Selengkapnya</a>
    </div>
  </section>
  <!-- Home Section End -->

  <!-- About Start -->
  <section id="about" class="kiluan-about">
    <!-- Animated Background Elements -->
    <div class="ocean-animation">
      <div class="wave wave-1"></div>
      <div class="wave wave-2"></div>
      <div class="wave wave-3"></div>
    </div>

    <div class="container position-relative">
      <!-- Judul with Animation -->
      <div class="text-center mb-5">
        <h1 class="display-4 fw-bold kiluan-title">
          <span class="title-char">I</span>
          <span class="title-char">n</span>
          <span class="title-char">f</span>
          <span class="title-char">o</span>
          <span class="title-char">r</span>
          <span class="title-char">m</span>
          <span class="title-char">a</span>
          <span class="title-char">s</span>
          <span class="title-char">i</span>
          <span class="title-char"> </span>
          <span class="title-char">U</span>
          <span class="title-char">m</span>
          <span class="title-char">u</span>
          <span class="title-char">m</span>
        </h1>
        <div class="title-underline mx-auto"></div>
      </div>

      <!-- Main Content -->
      <div class="row justify-content-center">
        <div class="col-lg-10">
          <!-- First Info Box -->
          <div class="info-box primary-box">
            <div class="box-content">
              <h2 class="box-title">Teluk Kiluan, Surga Tersembunyi di Lampung</h2>
              <p class="box-description">
                Teluk Kiluan merupakan salah satu surga tersembunyi di ujung selatan Lampung yang menawarkan pesona alam luar biasa.
                Dikelilingi oleh bukit hijau yang asri dan laut biru yang jernih, tempat ini menjadi destinasi favorit untuk menyaksikan
                atraksi lumba-lumba liar langsung di habitatnya.
              </p>
              <div class="button-group">
                <button class="kiluan-btn" onclick="window.open('http://monitoring.pekontelukkiluan.com', '_blank')">
                  <span>Monitoring Teluk Kiluan</span>
                  <svg viewBox="0 0 13 10" height="10px" width="15px">
                    <path d="M1,5 L11,5"></path>
                    <polyline points="8 1 12 5 8 9"></polyline>
                  </svg>
                </button>
               <a href="info-selengkapnya.php" class="kiluan-btn" style="text-decoration: none;">
                  <span>Lihat Profil Lengkap</span>
                  <svg viewBox="0 0 13 10" height="10px" width="15px">
                    <path d="M1,5 L11,5"></path>
                    <polyline points="8 1 12 5 8 9"></polyline>
                  </svg>
                </a>
                <button class="kiluan-btn" onclick="window.open('https://www.instagram.com/kiluan_negeri/', '_blank')">
                  <span>Instagram</span>
                  <svg viewBox="0 0 13 10" height="10px" width="15px">
                    <path d="M1,5 L11,5"></path>
              </div>
            </div>
            <div class="box-image">
              <img src="assets/images/dolphin.png" alt="Teluk Kiluan">
              <div class="image-tag">
                <i class="bi bi-star-fill"></i> Spot Lumba-Lumba
              </div>
            </div>
          </div>

          <!-- Second Info Box (Statistics) -->
          <div class="info-box stats-box">
            <div class="stat-item">
              <div class="stat-icon">
                <i class="bi bi-pin-map-fill"></i>
              </div>
              <div class="stat-value">2.066,20 Ha</div>
              <div class="stat-label">Luas Wilayah</div>
            </div>
            <div class="stat-item">
              <div class="stat-icon">
                <i class="bi bi-people-fill"></i>
              </div>
              <div class="stat-value">1.619</div>
              <div class="stat-label">Populasi</div>
            </div>
            <div class="stat-item">
              <div class="stat-icon">
                <i class="bi bi-calendar2-month"></i>
              </div>
              <div class="stat-value">Mei-Sep</div>
              <div class="stat-label">Waktu Terbaik</div>
            </div>
            <div class="stat-item">
              <div class="stat-icon">
                <i class="bi bi-geo-alt-fill"></i>
              </div>
              <div class="stat-value">Tanggamus</div>
              <div class="stat-label">Lokasi</div>
            </div>
          </div>

          <!-- Third Info Box (Details) -->
          <div class="info-box details-box">
            <h3 class="details-title">Fakta Menarik Teluk Kiluan</h3>
            <div class="details-grid">
              <div class="detail-card">
                <div class="card-icon">
                <i class="bi bi-fish" style="display: inline-block; transform: rotate(30deg); font-size: 24px;"></i>
                </div>
                <h4>Lumba-Lumba</h4>
                <p>Habitat alami ratusan lumba-lumba yang bisa dilihat langsung di alam bebas</p>
              </div>
              <div class="detail-card">
                <div class="card-icon">
                  <i class="bi bi-umbrella-fill"></i>
                </div>
                <h4>Pantai Eksotis</h4>
                <p>Pasir putih dan air jernih dengan pemandangan bukit hijau mengelilingi</p>
              </div>
              <div class="detail-card">
                <div class="card-icon">
                  <i class="bi bi-water"></i>
                </div>
                <h4>Snorkeling</h4>
                <p>Spot snorkeling dengan terumbu karang yang masih alami dan ikan warna-warni</p>
              </div>
              <div class="detail-card">
                <div class="card-icon">
                  <i class="bi bi-sunrise"></i>
                </div>
                <h4>Sunrise Indah</h4>
                <p>Salah satu spot terbaik untuk melihat sunrise di Lampung Selatan</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      
        <!-- Floating Icons -->
        <div class="floating-icons">
          <i class="bi bi-fish"></i>
          <i class="bi bi-water"></i>
          <i class="bi bi-tree-fill"></i>
        </div>
      </div>
    </section>
    <!-- About End -->

    <!-- Section Services Start -->
    <section class="services" id="services" style="background: white; padding: 100px 0; position: relative;">
      <div class="container position-relative">
        <!-- Judul with Animation -->
        <div class="text-center mb-5">
          <h1 class="display-4 fw-bold kiluan-title">
            <span class="title-char">P</span>
            <span class="title-char">e</span>
            <span class="title-char">l</span>
            <span class="title-char">a</span>
            <span class="title-char">y</span>
            <span class="title-char">a</span>
            <span class="title-char">n</span>
            <span class="title-char">a</span>
            <span class="title-char">n</span>
          </h1>
          <div class="title-underline mx-auto"></div>
        </div>

        <div class="row text-center">
          <!-- Transport -->
          <div class="col-md-4 mb-4">
            <div class="card service-card shadow-sm p-4 h-100 border-0 rounded-3">
              <div class="card-icon-wrapper mb-3">
                <i class="bi bi-bus-front fa-3x" style="color: #005f73;"></i>
              </div>
              <h4 class="fw-bold mb-2" style="color: #005f73;">Transport</h4>
              <p style="color: #5a7a8c;">Layanan antar jemput bandara, stasiun, dan pelabuhan.</p>
            </div>
          </div>

          <!-- Accommodation -->
          <div class="col-md-4 mb-4">
            <div class="card service-card shadow-sm p-4 h-100 border-0 rounded-3">
              <div class="card-icon-wrapper mb-3">
                <i class="bi bi-house-door fa-3x" style="color: #005f73;"></i>
              </div>
              <h4 class="fw-bold mb-2" style="color: #005f73;">Penginapan</h4>
              <p style="color: #5a7a8c;">Hotel, homestay, dan penginapan lokal yang nyaman.</p>
            </div>
          </div>

          <!-- Culinary -->
           <div class="col-md-4 mb-4">
            <div class="card service-card shadow-sm p-4 h-100 border-0 rounded-3">
              <div class="card-icon-wrapper mb-3">
                <i class="fas fa-utensils fa-3x" style="color: #005f73;"></i>
              </div>
              <h4 class="fw-bold mb-2" style="color: #005f73;">Kuliner</h4>
              <p style="color: #5a7a8c;">Paket makanan lokal khas Teluk Kiluan.</p>
            </div>
          </div>
    </section>
    <!-- Section Services End -->

    <!-- Section Gallery Start -->
<section class="gallery" id="services" style="background: white; padding: 100px 0; position: relative;">
  <div class="container position-relative">
    <!-- Judul with Animation -->
    <div class="text-center mb-5">
      <h1 class="display-4 fw-bold kiluan-title">
        <span class="title-char">G</span>
        <span class="title-char">a</span>
        <span class="title-char">l</span>
        <span class="title-char">e</span>
        <span class="title-char">r</span>
        <span class="title-char">i</span>
        <span class="title-char"> </span>
        <span class="title-char">F</span>
        <span class="title-char">o</span>
        <span class="title-char">t</span>
        <span class="title-char">o</span>
      </h1>
      <div class="title-underline mx-auto" style="width: 80px;"></div>
    </div>

    <div class="row">
      <!-- Item Galeri 1 -->
      <div class="col-md-4 mb-4">
        <div class="card shadow-sm gallery-card">
          <div class="card-img-container">
            <img src="./assets/images/Pantai3.png" class="card-img-top" alt="Transpalansi Terubu Karang">
            <div class="img-overlay">
               <a href="detail-galeri/gigihiu.php?id=1" class="btn btn-sm btn-outline-light view-btn">Lihat Detail</a>
            </div>
          </div>
          <div class="card-body">
            <small class="text-muted date-text">29/06/2024</small>
            <h6 class="card-title fw-bold mt-2">Transpalansi Terubu Karang</h6>
            <div class="card-footer-underline"></div>
          </div>
        </div>
      </div>

      <!-- Item Galeri 2 -->
      <div class="col-md-4 mb-4">
        <div class="card shadow-sm gallery-card">
          <div class="card-img-container">
            <img src="./assets/images/Pantai2.png" class="card-img-top" alt="Edukasi Penanaman Mangrove">
            <div class="img-overlay">
              <button class="btn btn-sm btn-outline-light view-btn">Lihat Detail</button>
            </div>
          </div>
          <div class="card-body">
            <small class="text-muted date-text">30/05/2017</small>
            <h6 class="card-title fw-bold mt-2">Edukasi Penanaman Mangrove</h6>
            <div class="card-footer-underline"></div>
          </div>
        </div>
      </div>

      <!-- Item Galeri 3 -->
      <div class="col-md-4 mb-4">
        <div class="card shadow-sm gallery-card">
          <div class="card-img-container">
            <img src="./assets/images/Pantai1.jpg" class="card-img-top" alt="Pendidikan dan Pelatihan">
            <div class="img-overlay">
              <button class="btn btn-sm btn-outline-light view-btn">Lihat Detail</button>
            </div>
          </div>
          <div class="card-body">
            <small class="text-muted date-text">30/05/2017</small>
            <h6 class="card-title fw-bold mt-2">Pendidikan dan Pelatihan</h6>
            <div class="card-footer-underline"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Section Produk Start -->
<section class="packages" id="services" style="background: white; padding: 100px 0; position: relative;">
      <div class="container position-relative">
   <!-- Judul with Animation -->
        <div class="text-center mb-4">
          <h1 class="display-4 fw-bold kiluan-title">
            <span class="title-char">P</span>
            <span class="title-char">r</span>
            <span class="title-char">o</span>
            <span class="title-char">d</span>
            <span class="title-char">u</span>
            <span class="title-char">k</span>
          </h1>
          <div class="title-underline mx-auto" style="width: 80px;"></div>
        </div>

<!-- Produk Unggulan -->
<section id="packages" class="py-5 bg-light">
  <div class="container">
    <div class="section-title text-center mb-5">
      <h2 class="fw-normal">Produk Unggulan</h2>
      <p class="text-muted">Temukan berbagai produk dan penginapan menarik di Kiluan</p>
    </div>

    <div class="row g-4">
      <?php
      $productsQuery = "SELECT * FROM products ORDER BY created_at DESC LIMIT 6";
      $productsResult = $conn->query($productsQuery);
      
      while($product = $productsResult->fetch_assoc()):
      ?>
      <div class="col-md-4 mb-4" data-aos="fade-up">
        <div class="card shadow package-card h-100">
          <img src="assets/images/<?= htmlspecialchars($product['featured_image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($product['name']) ?>" style="height: 250px; object-fit: cover;">
          <div class="card-body text-center">
            <h5 class="card-title fw-bold"><?= htmlspecialchars($product['name']) ?></h5>
            <p class="card-text"><?= htmlspecialchars(substr($product['description'], 0, 100)) ?>...</p>
            <h6 class="text-muted">Rp <?= number_format($product['price'], 0, ',', '.') ?></h6>
            <a href="penginapan/produk.php?id=<?= $product['id'] ?>" class="btn btn-order btn-sm my-1">
              <i class="fas fa-shopping-cart me-1"></i> ORDER
            </a>
          </div>
        </div>
      </div>
      <?php endwhile; ?>
    </div>

    <div class="text-center mt-4">
      <a href="penginapan/semua-produk.php" class="btn btn-order">Lihat Semua Produk</a>
    </div>
  </div>
</section>

    </div>
  </div>
</section>
<!-- Section Produk End -->

  <!-- Section Location Start -->
<section class="location" id="services" style="background: white; padding: 100px 0; position: relative;">
      <div class="container position-relative">
   <!-- Judul with Animation -->
        <div class="text-center mb-4">
          <h1 class="display-4 fw-bold kiluan-title">
            <span class="title-char">L</span>
            <span class="title-char">o</span>
            <span class="title-char">k</span>
            <span class="title-char">a</span>
            <span class="title-char">s</span>
            <span class="title-char">i</span>
            <span class="title-char"> </span>
            <span class="title-char">K</span>
            <span class="title-char">i</span>
            <span class="title-char">l</span>
            <span class="title-char">u</span>
            <span class="title-char">a</span>
            <span class="title-char">n</span>
          </h1>
          <div class="title-underline mx-auto" style="width: 80px;"></div>
        </div>

    <div class="row justify-content-center">
      <div class="col-12 col-lg-10">
        <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
          <div class="ratio ratio-16x9">
            <iframe 
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31887.378383019215!2d105.0125033!3d-5.7488326!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e3d4dc23df8e415%3A0x9ef0e20e083bcf2!2sKiluan%20Negeri%2C%20Kelumbayan%2C%20Tanggamus%20Regency%2C%20Lampung!5e0!3m2!1sen!2sid!4v1626258714814!5m2!1sen!2sid" 
              style="border:0;" 
              allowfullscreen="" 
              loading="lazy"
              referrerpolicy="no-referrer-when-downgrade">
            </iframe>
          </div>
          <div class="card-body text-center bg-white">
            <p class="text-muted mb-2">
              Desa Kiluan Negeri, Kecamatan Kelumbayan, Kabupaten Tanggamus, Provinsi Lampung
            </p>
            <a href="https://maps.app.goo.gl/rzCBkqXTezgNp7Kb6" target="_blank" class="btn btn-info btn-sm px-4">
              Buka di Google Maps
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Section Location End -->

<?php include 'includes/footer.php'; ?>

  <!-- Bootstrap JS -->
  <script src="assets/js/bootstrap.min.js"></script>

  <!-- Ionicons -->
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

  <script>
  AOS.init({
    duration: 800,
    once: true
  });
  </script>

  <script>
  // Add some basic interactivity
  document.addEventListener('DOMContentLoaded', function() {
    // Title character animation
    const titleChars = document.querySelectorAll('.title-char');
    titleChars.forEach((char, index) => {
      char.style.transitionDelay = `${index * 0.05}s`;
    });
    
    // Button hover effects
    const buttons = document.querySelectorAll('.kiluan-btn');
    buttons.forEach(button => {
      button.addEventListener('mouseenter', function() {
        this.querySelector('svg').style.transform = 'translateX(5px)';
      });
      
      button.addEventListener('mouseleave', function() {
        this.querySelector('svg').style.transform = 'translateX(0)';
      });
    });
  });
  </script>

  <script>
  // Animasi saat halaman dimuat
  document.addEventListener('DOMContentLoaded', function() {
    // Animasi judul karakter per karakter
    const titleChars = document.querySelectorAll('.title-char');
    titleChars.forEach((char, index) => {
      setTimeout(() => {
        char.style.animation = 'bounceIn 0.5s forwards';
      }, index * 100);
    });

    // Efek hover untuk semua card
    const cards = document.querySelectorAll('.gallery-card');
    cards.forEach(card => {
      card.addEventListener('click', function() {
        // Tambahkan aksi ketika card diklik
        console.log('Card clicked:', this.querySelector('.card-title').textContent);
      });
    });
  });

  // Tambahkan keyframes untuk animasi
  const style = document.createElement('style');
  style.innerHTML = `
    @keyframes bounceIn {
      0% { transform: translateY(20px); opacity: 0; }
      50% { transform: translateY(-10px); }
      100% { transform: translateY(0); opacity: 1; }
    }
  `;
  document.head.appendChild(style);
  </script>
</body>

</html>