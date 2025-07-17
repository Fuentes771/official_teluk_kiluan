<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Travel</title>
  <link rel="shortcut icon" href="assets/favicon.png">

  <!-- css Link -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- AOS Library -->
<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

  <!-- Font Awesome Cdn -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" rel="stylesheet">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Belleza&display=swap" rel="stylesheet">
  <!-- Google Font: Great Vibes -->
<link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">

</head>

<body>

<?php
// navbar.php
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
        <li class="nav-item mx-1"><a class="nav-link" href="#gallary">Galeri foto</a></li>
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
      <h5>Selamat Datang di Pekon Kiluan Negeri</h5>
      <p>"Surga tersembunyi dengan pantai berpasir putih dan bukit hijau yang memukau.
          Temukan pengalaman wisata alam yang tak terlupakan di salah satu destinasi terbaik Lampung."</p>
      <a href="#about" class="btn" id="btn-new">Selengkapnya</a>
    </div>
  </section>
  <!-- Home Section End -->

  <!-- About Start -->
  <section class="about" id="about" style="background: linear-gradient(135deg, #e0f7fa, #ffffff); padding: 60px 0;">
      <div class="container mt-5 pb-5">
        <h1 class="text-center mt-5 mb-2 mb-lg-4" id="page-suptitel"><span>I</span>nformasi Umum</h1>
        <div class="row align-items-center">
          <!-- Left: Text and General Info -->
          <div class="col-md-7 mb-4 mb-md-0">
            <h1 class="fw-bold mb-3" style="color: #000000;">
              Teluk Kiluan, Surga Tersembunyi di Lampung
            </h1>
            
            <p class="fs-5 text-muted mb-4">
              Teluk Kiluan merupakan salah satu surga tersembunyi di ujung selatan Lampung yang menawarkan pesona alam
              luar biasa. Dikelilingi oleh bukit hijau yang asri dan laut biru yang jernih, tempat ini menjadi destinasi
              favorit untuk menyaksikan atraksi lumba-lumba liar langsung di habitatnya. Selain keindahan alamnya yang
              memukau, Teluk Kiluan juga menyuguhkan suasana tenang dan udara segar yang menyegarkan.
            </p>
            
            <a href="#" class="btn" id="btn-new">Profil Lengkap</a>
          </div>
          
          <!-- Right: Data Box -->
          <div class="col-md-5">
            <div class="info-box p-4 rounded-3 shadow" style="background-color: #f8f9fa; border-left: 4px solid #005f73;">
              <div class="row">
                <!-- Original Data -->
                <div class="col-12 mb-3">
                  <div class="d-flex align-items-center">
                    <div class="icon-box me-3" style="color: #005f73;">
                      <i class="fas fa-map-marked-alt fa-2x"></i>
                    </div>
                    <div>
                      <h5 class="mb-0 fw-bold">Luas Wilayah</h5>
                      <p class="mb-0 fs-5">2.066,20 Ha</p>
                    </div>
                  </div>
                </div>
                
                <div class="col-12 mb-3">
                  <div class="d-flex align-items-center">
                    <div class="icon-box me-3" style="color: #005f73;">
                      <i class="fas fa-users fa-2x"></i>
                    </div>
                    <div>
                      <h5 class="mb-0 fw-bold">Populasi</h5>
                      <p class="mb-0 fs-5">1.619 Jiwa</p>
                    </div>
                  </div>
                </div>
                
                <div class="col-12 mb-3">
                  <div class="d-flex align-items-center">
                    <div class="icon-box me-3" style="color: #005f73;">
                      <i class="fas fa-chart-area fa-2x"></i>
                    </div>
                    <div>
                      <h5 class="mb-0 fw-bold">Kepadatan</h5>
                      <p class="mb-0 fs-5">12.36%</p>
                    </div>
                  </div>
                </div>
                
                <!-- Additional Data -->
                <div class="col-12 mb-3">
                  <div class="d-flex align-items-center">
                    <div class="icon-box me-3" style="color: #005f73;">
                      <i class="fas fa-water fa-2x"></i>
                    </div>
                    <div>
                      <h5 class="mb-0 fw-bold">Panjang Pantai</h5>
                      <p class="mb-0 fs-5">1,619 Meter</p>
                    </div>
                  </div>
                </div>
                
                <div class="col-12">
                  <div class="d-flex align-items-center">
                    <div class="icon-box me-3" style="color: #005f73;">
                      <i class="fas fa-dolphin fa-2x"></i>
                    </div>
                    <div>
                      <h5 class="mb-0 fw-bold">Populasi Lumba-lumba</h5>
                      <p class="mb-0 fs-5">100+ Ekor</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </section>
  <!-- About End -->

<!-- Section Services Start -->
<section class="services" id="services">
  <div class="container mt-5 pb-3">
    <h1 class="text-center mt-5 mb-4 fw-bold" id="page-suptitel">
      <span>P</span>elayanan
    </h1>

    <div class="row text-center">
      <!-- Transport -->
      <div class="col-md-4 mb-4">
        <div class="card service-card shadow-sm p-4 h-100">
          <i class="fas fa-bus-alt fa-3x mb-3 service-icon"></i>
          <h4 class="fw-bold mb-2">Transport</h4>
          <p class="text-muted">Layanan antar jemput bandara, stasiun, dan pelabuhan.</p>
        </div>
      </div>

      <!-- Accommodation -->
      <div class="col-md-4 mb-4">
        <div class="card service-card shadow-sm p-4 h-100">
          <i class="fas fa-hotel fa-3x mb-3 service-icon"></i>
          <h4 class="fw-bold mb-2">Accommodation</h4>
          <p class="text-muted">Hotel, homestay, dan penginapan lokal yang nyaman.</p>
        </div>
      </div>

      <!-- Culinary -->
      <div class="col-md-4 mb-4">
        <div class="card service-card shadow-sm p-4 h-100">
          <i class="fas fa-utensils fa-3x mb-3 service-icon"></i>
          <h4 class="fw-bold mb-2">Culinary</h4>
          <p class="text-muted">Paket makanan lokal khas Teluk Kiluan.</p>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Section Services End -->

  <!-- Section Gallery Start -->
  <section class="gallary" id="gallary" style="background: linear-gradient(135deg, #e0f7fa, #ffffff); padding: 60px 0;">
    <div class="container mt-5 pb-3">
      <h1 class="text-center mt-5 mb-2 mb-lg-4" id="page-suptitel"><span>G</span>aleri Foto</h1>
      <div class="row">

        <!-- Item Galeri -->
        <div class="col-md-4 mb-4">
          <div class="card shadow-sm">
            <img src="./assets/images/YouTube (1).png" class="card-img-top" alt="Transpalansi Terubu Karang" height="230px">
            <div class="card-body">
              <small class="text-muted">29/06/2024</small>
              <h6 class="card-title fw-bold mt-2">Transpalansi Terubu Karang</h6>
            </div>
          </div>
        </div>

        <!-- Copy item ini untuk setiap gambar -->
        <div class="col-md-4 mb-4">
          <div class="card shadow-sm">
            <img src="./assets/images/YouTube.png" class="card-img-top" alt="Edukasi Penanaman Mangrove" height="230px">
            <div class="card-body">
              <small class="text-muted">30/05/2017</small>
              <h6 class="card-title fw-bold mt-2">Edukasi Penanaman Mangrove</h6>
            </div>
          </div>
        </div>

        <div class="col-md-4 mb-4">
          <div class="card shadow-sm">
            <img src="./assets/images/Cette île bretonne est un avant-goût des îles Fidji -.png" class="card-img-top" alt="Pendidikan dan Pelatihan" height="230px">
            <div class="card-body">
              <small class="text-muted">30/05/2017</small>
              <h6 class="card-title fw-bold mt-2">Pendidikan dan Pelatihan</h6>
            </div>
          </div>
        </div>

        <!-- Tambahkan item berikutnya sesuai dengan kebutuhan -->
        <!-- ... -->

      </div>
    </div>
  </section>
  <!-- Section Gallery End -->

<!-- Section Produk Start -->
<section id="packages" class="mt-5 pb-5">
  <div class="container">

    <!-- Judul Halaman -->
    <h1 class="text-center mb-4" id="page-suptitel"><span>P</span>roduk Desa</h1>

    <!-- Bagian 1: Penginapan dan Villa -->
    <h3 class="mb-4 mt-5 judul-section fw-bold">Penginapan & Villa</h3>
    <div class="row">
      <!-- Cheche Guesthouse -->
      <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="100">
        <div class="card shadow package-card h-100">
          <img src="assets/images/Villa-1.png" class="card-img-top" alt="Cheche Guesthouse" style="height: 250px; object-fit: cover;">
          <div class="card-body text-center">
            <h5 class="card-title fw-bold">CHECHE GUESTHOUSE</h5>
            <p class="card-text">Penginapan nyaman di tepi pantai Kiluan</p>
            <h6 class="text-muted">Rp 300.000/malam</h6>
            <a href="penginapan/cheche-guesthouse.php" class="btn btn-booknow btn-sm my-1">
              <i class="fas fa-calendar-check me-1"></i> BOOK NOW
            </a>
          </div>
        </div>
      </div>
      <!-- Cheche Guesthouse -->
      <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="100">
        <div class="card shadow package-card h-100">
          <img src="assets/images/Villa-2.png" class="card-img-top" alt="Cheche Guesthouse" style="height: 250px; object-fit: cover;">
          <div class="card-body text-center">
            <h5 class="card-title fw-bold">CHECHE GUESTHOUSE</h5>
            <p class="card-text">Penginapan nyaman di tepi pantai Kiluan</p>
            <h6 class="text-muted">Rp 300.000/malam</h6>
            <a href="penginapan/cheche-guesthouse.php" class="btn btn-booknow btn-sm my-1">
              <i class="fas fa-calendar-check me-1"></i> BOOK NOW
            </a>
          </div>
        </div>
      </div>
      <!-- Cheche Guesthouse -->
      <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="100">
        <div class="card shadow package-card h-100">
          <img src="assets/images/Villa-3.png" class="card-img-top" alt="Cheche Guesthouse" style="height: 250px; object-fit: cover;">
          <div class="card-body text-center">
            <h5 class="card-title fw-bold">CHECHE GUESTHOUSE</h5>
            <p class="card-text">Penginapan nyaman di tepi pantai Kiluan</p>
            <h6 class="text-muted">Rp 300.000/malam</h6>
            <a href="penginapan/cheche-guesthouse.php" class="btn btn-booknow btn-sm my-1">
              <i class="fas fa-calendar-check me-1"></i> BOOK NOW
            </a>
          </div>
        </div>
      </div>

    </div>

    <!-- Bagian 2: Produk UMKM -->
    <h3 class="mb-4 mt-5 judul-section fw-bold">Produk UMKM</h3>
    <div class="row">
      <!-- Otak-otak -->
      <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="200">
        <div class="card shadow package-card h-100">
          <img src="assets/images/Otak-Otak(1).png" class="card-img-top" alt="Otak-otak" style="height: 250px; object-fit: cover;">
          <div class="card-body text-center">
            <h5 class="card-title fw-bold">Otak-otak Kiluan</h5>
            <p class="card-text">Makanan khas dari ikan segar laut Kiluan</p>
            <h6 class="text-muted">Rp 20.000/pack</h6>
            <a href="penginapan/cheche-guesthouse.php" class="btn btn-order btn-sm my-1">
              <i class="fas fa-shopping-cart me-1"></i> ORDER
            </a>
          </div>
        </div>
      </div>
      <!-- Ikan Asap -->
      <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="300">
        <div class="card shadow package-card h-100">
          <img src="assets/images/Ikan-Asap.png" class="card-img-top" alt="Ikan Asap" style="height: 250px; object-fit: cover;">
          <div class="card-body text-center">
            <h5 class="card-title fw-bold">Ikan Asap Tradisional</h5>
            <p class="card-text">Olahan ikan asap khas Desa Kiluan Negeri</p>
            <h6 class="text-muted">Rp 25.000/ekor</h6>
            <a href="penginapan/cheche-guesthouse.php" class="btn btn-order btn-sm my-1">
              <i class="fas fa-shopping-cart me-1"></i> ORDER
            </a>
          </div>
        </div>
      </div>
      <!-- Ikan Asap -->
      <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="300">
        <div class="card shadow package-card h-100">
          <img src="assets/images/Nugget.png" class="card-img-top" alt="Ikan Asap" style="height: 250px; object-fit: cover;">
          <div class="card-body text-center">
            <h5 class="card-title fw-bold">Nugget Khas Kiluan</h5>
            <p class="card-text">Olahan daging khas Desa Kiluan</p>
            <h6 class="text-muted">Rp 25.000/ekor</h6>
            <a href="penginapan/cheche-guesthouse.php" class="btn btn-order btn-sm my-1">
              <i class="fas fa-shopping-cart me-1"></i> ORDER
            </a>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>
<!-- Section Produk End -->

<!-- Section Location Start -->
<section class="location" id="location" style="background: linear-gradient(135deg, #e0f7fa, #ffffff); padding: 60px 0;">
  <div class="container">
    <h1 class="text-center mb-5 fw-bold" id="page-suptitel">
      <span>Lokasi Desa Kiluan Negeri
    </h1>

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

  <!-- Start Footer -->
  <footer class="footer-clean">
    <div class="container py-4">
      <div class="row align-items-start">
        <div class="col-md-4 text-start mb-3 mb-md-0">
          <div class="footer-logo">
            <img src="assets/images/logo.png" alt="logo-footer">
          </div>
        </div>
        <div class="col-md-8 text-md-start text-center">
          <p class="footer-text mb-3">
            Teluk Kiluan adalah surga tersembunyi di Lampung dengan keindahan alam yang memukau. Temukan pengalaman
            wisata yang tak terlupakan bersama kami!
          </p>
          <div class="social-contact d-flex flex-wrap align-items-center gap-3">
            <div class="d-flex align-items-center gap-2">
              <ion-icon name="logo-instagram"></ion-icon><span>@telukkiluan</span>
            </div>
            <div class="d-flex align-items-center gap-2">
              <ion-icon name="logo-facebook"></ion-icon><span>Teluk Kiluan Official</span>
            </div>
            <div class="d-flex align-items-center gap-2">
              <ion-icon name="logo-youtube"></ion-icon><span>Kiluan Channel</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- End Footer -->

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

</body>

</html>