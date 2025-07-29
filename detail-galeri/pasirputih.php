<?php
require '../includes/config.php';
require '../includes/header.php';?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Galeri - Pantai Pasir Putih Teluk Kiluan</title>
    
    <!-- Menghubungkan file CSS eksternal -->
    <link rel="stylesheet" href="assets/css/gigihiu.css?v=2">
    
    <!-- Tambahkan juga library eksternal yang diperlukan -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">

    <!-- css Link -->
    <link href="../assets/css/bootstrap.min.css?v=2" rel="stylesheet">
    <link href="../assets/css/style.css?v=2" rel="stylesheet">
    <link href="../assets/css/detail.css?v=2" rel="stylesheet">


    <!-- AOS Library -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

    <!-- Font Awesome Cdn -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Belleza&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lora&family=Playfair+Display:wght@600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap?v=2" rel="stylesheet">

    <!-- Bootstrap Icons CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css?v=2">

    <style>
        .pasirputih-hero {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), 
                        url('../assets/images/pasirputih-hero.jpg');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 100px 0;
        }
    </style>
</head>
<body>
    <!-- Navbar Start -->
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
      </ul>
    </div>
  </div>
</nav>
<!-- Navbar End -->
    <!-- Hero Section -->
    <section class="hero-section text-center pasirputih-hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <h1 class="gallery-title display-4 mb-3">Pantai Pasir Putih Teluk Kiluan</h1>
                    <p class="lead mb-4">Keindahan Pantai dengan Pasir Selembut Tepung di Teluk Kiluan</p>
                    <span class="badge location-badge p-2">
                        <i class="fas fa-map-marker-alt me-2"></i> Teluk Kiluan, Lampung Selatan
                    </span>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container mb-5">
        <div class="row">
            <!-- Main Gallery Content -->
            <div class="col-lg-8">
                <!-- Description Section -->
                <section class="mb-5">
                    <h2 class="section-title">Deskripsi</h2>
                    <p class="lead">Pantai Pasir Putih Teluk Kiluan adalah salah satu pantai tercantik di Lampung dengan hamparan pasir putih yang lembut dan air laut yang jernih kebiruan.</p>
                    
                    <p>Pantai ini memiliki garis pantai sepanjang sekitar 1 kilometer dengan pasir putih yang sangat halus, bahkan sering dibandingkan dengan tepung karena kelembutannya. Air lautnya yang tenang dengan gradasi warna dari biru muda hingga toska menciptakan pemandangan yang memesona.</p>
                    
                    <p>Dikelilingi oleh bukit-bukit hijau yang asri, Pantai Pasir Putih menawarkan suasana yang tenang dan alami. Tempat ini sangat cocok untuk berenang, berjemur, atau sekadar bersantai menikmati keindahan alam sambil mendengar deburan ombak yang tenang.</p>
                    
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="info-card h-100">
                                <div class="card-body text-center">
                                    <i class="fas fa-sun card-icon"></i>
                                    <h5>Waktu Terbaik Berkunjung</h5>
                                    <p class="mb-0">April - Oktober saat cuaca cerah dan ombak tenang</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-card h-100">
                                <div class="card-body text-center">
                                    <i class="fas fa-clock card-icon"></i>
                                    <h5>Jam Kunjungan</h5>
                                    <p class="mb-0">07.00 - 18.00 WIB (terbaik pagi atau sore hari)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Photo Gallery Section -->
                <section class="mb-5">
                    <h2 class="section-title">Galeri Foto</h2>
                    
                    <!-- Main Carousel -->
                    <div id="galleryCarousel" class="carousel slide mb-4" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#galleryCarousel" data-bs-slide-to="0" class="active"></button>
                            <button type="button" data-bs-target="#galleryCarousel" data-bs-slide-to="1"></button>
                            <button type="button" data-bs-target="#galleryCarousel" data-bs-slide-to="2"></button>
                            <button type="button" data-bs-target="#galleryCarousel" data-bs-slide-to="3"></button>
                        </div>
                        <div class="carousel-inner rounded">
                            <div class="carousel-item active">
                                <img src="./assets/images/pasirputih1.jpg" class="d-block w-100" alt="Pantai Pasir Putih">
                                <div class="carousel-caption d-none d-md-block">
                                    <p>Pemandangan utama Pantai Pasir Putih</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="./assets/images/pasirputih2.jpg" class="d-block w-100" alt="Pasir Putih Halus">
                                <div class="carousel-caption d-none d-md-block">
                                    <p>Pasir putih yang sangat halus</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="./assets/images/pasirputih3.jpg" class="d-block w-100" alt="Air Laut Jernih">
                                <div class="carousel-caption d-none d-md-block">
                                    <p>Air laut yang jernih kebiruan</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="./assets/images/pasirputih4.jpg" class="d-block w-100" alt="Aktivitas Wisata">
                                <div class="carousel-caption d-none d-md-block">
                                    <p>Aktivitas wisata di pantai</p>
                                </div>
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#galleryCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#galleryCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    
                    <!-- Thumbnail Gallery -->
                    <div class="row">
                        <div class="col-6 col-md-3">
                            <a href="./assets/images/pasirputih1.jpg" data-lightbox="gallery" data-title="Pantai Pasir Putih">
                                <img src="./assets/images/pasirputih1-thumb.jpg" class="img-fluid gallery-thumbnail" alt="Thumbnail 1">
                            </a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="./assets/images/pasirputih2.jpg" data-lightbox="gallery" data-title="Pasir Putih Halus">
                                <img src="./assets/images/pasirputih2-thumb.jpg" class="img-fluid gallery-thumbnail" alt="Thumbnail 2">
                            </a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="./assets/images/pasirputih3.jpg" data-lightbox="gallery" data-title="Air Laut Jernih">
                                <img src="./assets/images/pasirputih3-thumb.jpg" class="img-fluid gallery-thumbnail" alt="Thumbnail 3">
                            </a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="./assets/images/pasirputih4.jpg" data-lightbox="gallery" data-title="Aktivitas Wisata">
                                <img src="./assets/images/pasirputih4-thumb.jpg" class="img-fluid gallery-thumbnail" alt="Thumbnail 4">
                            </a>
                        </div>
                    </div>
                </section>

                <!-- Video Section -->
                <section class="mb-5">
                    <h2 class="section-title">Video Dokumentasi</h2>
                    <div class="video-container">
                        <iframe src="https://www.youtube.com/embed/example-pasirputih" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    <p class="text-muted">Video keindahan Pantai Pasir Putih Teluk Kiluan dari berbagai sudut pandang.</p>
                </section>

                <!-- Facilities Section -->
                <section class="mb-5">
                    <h2 class="section-title">Fasilitas Wisata</h2>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="card h-100">
                                <div class="card-body text-center">
                                    <i class="fas fa-umbrella-beach fa-3x mb-3 text-primary"></i>
                                    <h5>Gazebo & Payung Pantai</h5>
                                    <p>Tersedia gazebo dan payung pantai untuk bersantai</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card h-100">
                                <div class="card-body text-center">
                                    <i class="fas fa-utensils fa-3x mb-3 text-primary"></i>
                                    <h5>Warung Makan</h5>
                                    <p>Berbagai warung makan dengan menu seafood segar</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card h-100">
                                <div class="card-body text-center">
                                    <i class="fas fa-shower fa-3x mb-3 text-primary"></i>
                                    <h5>Toilet & Bilas</h5>
                                    <p>Fasilitas toilet dan bilas yang bersih</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <!-- Sidebar Information -->
            <div class="col-lg-4">
                <div class="sticky-top" style="top: 20px;">
                    <!-- Quick Facts -->
                    <div class="info-card mb-4">
                        <div class="card-body">
                            <h4 class="mb-4 text-center"><i class="fas fa-info-circle me-2 text-primary"></i> Fakta Cepat</h4>
                            <ul class="list-unstyled">
                                <li class="mb-3">
                                    <strong><i class="fas fa-map-marked-alt me-2 text-secondary"></i> Lokasi:</strong>
                                    <span class="float-end">Teluk Kiluan, Lampung Selatan</span>
                                </li>
                                <li class="mb-3">
                                    <strong><i class="fas fa-ruler-combined me-2 text-secondary"></i> Panjang Pantai:</strong>
                                    <span class="float-end">± 1 kilometer</span>
                                </li>
                                <li class="mb-3">
                                    <strong><i class="fas fa-route me-2 text-secondary"></i> Jarak dari Bandar Lampung:</strong>
                                    <span class="float-end">± 60 km</span>
                                </li>
                                <li class="mb-3">
                                    <strong><i class="fas fa-clock me-2 text-secondary"></i> Waktu Tempuh:</strong>
                                    <span class="float-end">2-3 jam perjalanan</span>
                                </li>
                                <li class="mb-3">
                                    <strong><i class="fas fa-ticket-alt me-2 text-secondary"></i> Tiket Masuk:</strong>
                                    <span class="float-end">Rp 15.000/orang</span>
                                </li>
                                <li class="mb-3">
                                    <strong><i class="fas fa-water me-2 text-secondary"></i> Kondisi Ombak:</strong>
                                    <span class="float-end">Tenang (cocok untuk anak-anak)</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Location Map -->
                    <div class="info-card mb-4">
                        <div class="card-body">
                            <h4 class="mb-4 text-center"><i class="fas fa-map-marked-alt me-2 text-primary"></i> Lokasi</h4>
                            <div class="ratio ratio-16x9 mb-3">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3972.1234567890!2d105.1234567!3d-5.1234567" allowfullscreen="" loading="lazy"></iframe>
                            </div>
                            <p class="mb-1"><strong>Koordinat:</strong> -5.1234° LS, 105.5678° BT</p>
                            <p class="mb-1"><strong>Akses:</strong> Jalan darat + parkir di area khusus</p>
                            <p><strong>Fasilitas:</strong> Area parkir, warung makan, toilet, gazebo, penyewaan alat snorkeling</p>
                        </div>
                    </div>

                    <!-- Tips for Visitors -->
                    <div class="info-card">
                        <div class="card-body">
                            <h4 class="mb-4 text-center"><i class="fas fa-lightbulb me-2 text-primary"></i> Tips untuk Pengunjung</h4>
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Bawa sunscreen dengan SPF tinggi</li>
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Gunakan topi dan kacamata hitam</li>
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Bawa kamera waterproof</li>
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Siapkan uang tunai (tidak ada ATM)</li>
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Bawa handuk dan pakaian ganti</li>
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Jaga kebersihan pantai</li>
                            </ul>
                            <div class="d-grid gap-2 mt-3">
                                <a href="#" class="btn btn-primary"><i class="fas fa-route me-2"></i> Panduan Rute</a>
                                <a href="#" class="btn btn-outline-secondary"><i class="fas fa-swimmer me-2"></i> Spot Renang Terbaik</a>
                            </div>
                        </div>
                    </div>

                    <!-- Activities Card -->
                    <div class="info-card mt-4">
                        <div class="card-body">
                            <h4 class="mb-4 text-center"><i class="fas fa-sun me-2 text-primary"></i> Aktivitas Wisata</h4>
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="fas fa-swimmer text-info me-2"></i> Berenang & Bermain Air</li>
                                <li class="mb-2"><i class="fas fa-camera text-info me-2"></i> Fotografi Pantai</li>
                                <li class="mb-2"><i class="fas fa-binoculars text-info me-2"></i> Snorkeling</li>
                                <li class="mb-2"><i class="fas fa-fish text-info me-2"></i> Memancing</li>
                                <li class="mb-2"><i class="fas fa-campground text-info me-2"></i> Camping</li>
                                <li class="mb-2"><i class="fas fa-sunset text-info me-2"></i> Menikmati Sunset</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Premium Bottom Left Back Button -->
<div class="back-to-home-bottom">
    <a href="../index.php#gallery" class="btn-back-bottom">
        <i class="fas fa-home me-2"></i>
        <span class="btn-text">Kembali ke Beranda</span>
    </a>
</div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Lightbox JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
    <script>
        // Lightbox options
        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true,
            'albumLabel': "Gambar %1 dari %2"
        });
        
        // Initialize carousel
        var myCarousel = document.querySelector('#galleryCarousel')
        var carousel = new bootstrap.Carousel(myCarousel, {
            interval: 5000,
            ride: 'carousel'
        })
    </script>
</body>
</html>

<?php require '../includes/footer.php'; ?>