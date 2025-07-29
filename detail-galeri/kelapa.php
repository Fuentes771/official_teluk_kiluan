<?php
require '../includes/config.php';
require '../includes/header.php';?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Galeri - Pulau Kelapa Teluk Kiluan</title>
    
    <!-- Menghubungkan file CSS eksternal -->
    <link href="../assets/css/detail.css?v=2" rel="stylesheet">
    
    <!-- Tambahkan juga library eksternal yang diperlukan -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">

    <!-- css Link -->
    <link href="../assets/css/bootstrap.min.css?v=2" rel="stylesheet">
    <link href="../assets/css/style.css?v=2" rel="stylesheet">

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
        .pulaukelapa-hero {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), 
                        url('../assets/images/pulaukelapa-hero.jpg');
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
    <section class="hero-section text-center pulaukelapa-hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <h1 class="gallery-title display-4 mb-3">Pulau Kelapa Teluk Kiluan</h1>
                    <p class="lead mb-4">Surga Tersembunyi dengan Pantai Eksotis dan Alam yang Masih Alami</p>
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
                    <p class="lead">Pulau Kelapa adalah salah satu pulau kecil nan eksotis di Teluk Kiluan yang menawarkan pesona pantai berpasir putih, air laut jernih kebiruan, dan pepohonan kelapa yang melambai.</p>
                    
                    <p>Pulau ini memiliki luas sekitar 5 hektar dengan garis pantai yang indah dan air laut yang tenang. Nama "Pulau Kelapa" berasal dari banyaknya pohon kelapa yang tumbuh subur di pulau ini. Keindahan alamnya yang masih sangat alami membuat pulau ini menjadi destinasi favorit untuk snorkeling, berenang, atau sekadar bersantai menikmati suasana pantai.</p>
                    
                    <p>Pulau Kelapa juga dikenal dengan biota lautnya yang beragam, termasuk terumbu karang yang masih terjaga dan berbagai jenis ikan hias. Pada saat air surut, Anda bisa berjalan kaki menyusuri pantai yang menghubungkan pulau ini dengan pulau-pulau kecil di sekitarnya.</p>
                    
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="info-card h-100">
                                <div class="card-body text-center">
                                    <i class="fas fa-sun card-icon"></i>
                                    <h5>Waktu Terbaik Berkunjung</h5>
                                    <p class="mb-0">Mei - September saat cuaca cerah dan ombak tenang</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-card h-100">
                                <div class="card-body text-center">
                                    <i class="fas fa-tide card-icon"></i>
                                    <h5>Kondisi Pasang Surut</h5>
                                    <p class="mb-0">Saat surut, bisa berjalan ke pulau tetangga</p>
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
                                <img src="./assets/images/pulaukelapa1.jpg" class="d-block w-100" alt="Pemandangan Pulau Kelapa">
                                <div class="carousel-caption d-none d-md-block">
                                    <p>Pemandangan Pulau Kelapa dari udara</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="./assets/images/pulaukelapa2.jpg" class="d-block w-100" alt="Pantai Pasir Putih">
                                <div class="carousel-caption d-none d-md-block">
                                    <p>Pantai berpasir putih yang indah</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="./assets/images/pulaukelapa3.jpg" class="d-block w-100" alt="Pohon Kelapa">
                                <div class="carousel-caption d-none d-md-block">
                                    <p>Pohon kelapa yang melambai</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="./assets/images/pulaukelapa4.jpg" class="d-block w-100" alt="Aktivitas Snorkeling">
                                <div class="carousel-caption d-none d-md-block">
                                    <p>Snorkeling melihat terumbu karang</p>
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
                            <a href="./assets/images/pulaukelapa1.jpg" data-lightbox="gallery" data-title="Pemandangan Pulau Kelapa">
                                <img src="./assets/images/pulaukelapa1-thumb.jpg" class="img-fluid gallery-thumbnail" alt="Thumbnail 1">
                            </a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="./assets/images/pulaukelapa2.jpg" data-lightbox="gallery" data-title="Pantai Pasir Putih">
                                <img src="./assets/images/pulaukelapa2-thumb.jpg" class="img-fluid gallery-thumbnail" alt="Thumbnail 2">
                            </a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="./assets/images/pulaukelapa3.jpg" data-lightbox="gallery" data-title="Pohon Kelapa">
                                <img src="./assets/images/pulaukelapa3-thumb.jpg" class="img-fluid gallery-thumbnail" alt="Thumbnail 3">
                            </a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="./assets/images/pulaukelapa4.jpg" data-lightbox="gallery" data-title="Aktivitas Snorkeling">
                                <img src="./assets/images/pulaukelapa4-thumb.jpg" class="img-fluid gallery-thumbnail" alt="Thumbnail 4">
                            </a>
                        </div>
                    </div>
                </section>

                <!-- Video Section -->
                <section class="mb-5">
                    <h2 class="section-title">Video Dokumentasi</h2>
                    <div class="video-container">
                        <iframe src="https://www.youtube.com/embed/example-pulaukelapa" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    <p class="text-muted">Video keindahan Pulau Kelapa dari berbagai sudut pandang.</p>
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
                                    <strong><i class="fas fa-ruler-combined me-2 text-secondary"></i> Luas Pulau:</strong>
                                    <span class="float-end">± 5 hektar</span>
                                </li>
                                <li class="mb-3">
                                    <strong><i class="fas fa-ship me-2 text-secondary"></i> Jarak dari Dermaga:</strong>
                                    <span class="float-end">± 15 menit</span>
                                </li>
                                <li class="mb-3">
                                    <strong><i class="fas fa-clock me-2 text-secondary"></i> Waktu Tempuh:</strong>
                                    <span class="float-end">2.5-3 jam dari Bandar Lampung</span>
                                </li>
                                <li class="mb-3">
                                    <strong><i class="fas fa-ticket-alt me-2 text-secondary"></i> Tiket Masuk:</strong>
                                    <span class="float-end">Rp 10.000/orang</span>
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
                            <p class="mb-1"><strong>Akses:</strong> Perahu dari Dermaga Kiluan</p>
                            <p><strong>Waktu Operasional:</strong> 07.00 - 16.00 WIB</p>
                        </div>
                    </div>

                    <!-- Tips for Visitors -->
                    <div class="info-card">
                        <div class="card-body">
                            <h4 class="mb-4 text-center"><i class="fas fa-lightbulb me-2 text-primary"></i> Tips untuk Pengunjung</h4>
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Bawa perlengkapan renang/snorkeling</li>
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Gunakan tabir surya tahan air</li>
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Bawa kamera waterproof</li>
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Pakai alas kaki air</li>
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Bawa uang tunai (tidak ada ATM)</li>
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Jaga kebersihan pulau</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Conservation Info -->
                    <div class="info-card mt-4">
                        <div class="card-body">
                            <h4 class="mb-4 text-center"><i class="fas fa-hands-helping me-2 text-primary"></i> Konservasi</h4>
                            <p>Pulau Kelapa merupakan kawasan konservasi dengan:</p>
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="fas fa-shield-alt text-info me-2"></i> Terumbu karang yang dilindungi</li>
                                <li class="mb-2"><i class="fas fa-shield-alt text-info me-2"></i> Larangan merusak ekosistem</li>
                            </ul>
                            <div class="alert alert-warning mt-3">
                                <i class="fas fa-exclamation-triangle me-2"></i> Dilarang mengambil karang atau biota laut lainnya
                            </div>
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