<?php
require '../includes/config.php';
require '../includes/header.php';?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Galeri - Gapura Teluk Kiluan</title>
    
    <!-- Menghubungkan file CSS eksternal -->
    <link href="../assets/css/detail.css?v=2" rel="stylesheet">
    
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
    <section class="hero-section text-center gapura-hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <h1 class="gallery-title display-4 mb-3">Gapura Teluk Kiluan</h1>
                    <p class="lead mb-4">Pintu Gerbang Menuju Keindahan Alam Teluk Kiluan</p>
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
                    <p class="lead">Gapura Teluk Kiluan merupakan ikon pariwisata yang menjadi simbol penyambutan bagi para wisatawan yang datang menikmati keindahan alam Teluk Kiluan.</p>
                    
                    <p>Gapura ini dibangun dengan arsitektur tradisional Lampung yang khas, menggambarkan kekayaan budaya dan keindahan alam daerah ini. Dengan tinggi 8 meter dan lebar 12 meter, gapura ini menjadi spot foto favorit para pengunjung.</p>
                    
                    <p>Lokasi gapura yang strategis di pintu masuk kawasan wisata Teluk Kiluan membuatnya menjadi landmark yang mudah dikenali. Di sekitar gapura terdapat taman yang tertata rapi dengan berbagai tanaman khas daerah yang menambah keindahan tempat ini.</p>
                    
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="info-card h-100">
                                <div class="card-body text-center">
                                    <i class="fas fa-calendar-alt card-icon"></i>
                                    <h5>Waktu Terbaik Berkunjung</h5>
                                    <p class="mb-0">Pagi hari (06.00-09.00) atau sore hari (15.00-18.00) untuk pencahayaan foto terbaik</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-card h-100">
                                <div class="card-body text-center">
                                    <i class="fas fa-users card-icon"></i>
                                    <h5>Pengunjung</h5>
                                    <p class="mb-0">Rata-rata 500-1000 pengunjung per hari di akhir pekan</p>
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
                                <img src="./assets/images/gapura1.jpg" class="d-block w-100" alt="Gapura Teluk Kiluan">
                                <div class="carousel-caption d-none d-md-block">
                                    <p>Gapura Teluk Kiluan di pagi hari</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="./assets/images/gapura2.jpg" class="d-block w-100" alt="Gapura dengan latar laut">
                                <div class="carousel-caption d-none d-md-block">
                                    <p>Gapura dengan latar belakang laut</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="./assets/images/gapura3.jpg" class="d-block w-100" alt="Detail arsitektur gapura">
                                <div class="carousel-caption d-none d-md-block">
                                    <p>Detail arsitektur tradisional gapura</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="./assets/images/gapura4.jpg" class="d-block w-100" alt="Gapura di malam hari">
                                <div class="carousel-caption d-none d-md-block">
                                    <p>Gapura dengan pencahayaan malam</p>
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
                            <a href="./assets/images/gapura1.jpg" data-lightbox="gallery" data-title="Gapura Teluk Kiluan">
                                <img src="./assets/images/gapura1-thumb.jpg" class="img-fluid gallery-thumbnail" alt="Thumbnail 1">
                            </a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="./assets/images/gapura2.jpg" data-lightbox="gallery" data-title="Gapura dengan latar laut">
                                <img src="./assets/images/gapura2-thumb.jpg" class="img-fluid gallery-thumbnail" alt="Thumbnail 2">
                            </a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="./assets/images/gapura3.jpg" data-lightbox="gallery" data-title="Detail arsitektur">
                                <img src="./assets/images/gapura3-thumb.jpg" class="img-fluid gallery-thumbnail" alt="Thumbnail 3">
                            </a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="./assets/images/gapura4.jpg" data-lightbox="gallery" data-title="Gapura malam hari">
                                <img src="./assets/images/gapura4-thumb.jpg" class="img-fluid gallery-thumbnail" alt="Thumbnail 4">
                            </a>
                        </div>
                    </div>
                </section>

                <!-- Video Section -->
                <section class="mb-5">
                    <h2 class="section-title">Video Dokumentasi</h2>
                    <div class="video-container">
                        <iframe src="https://www.youtube.com/embed/example-gapura" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    <p class="text-muted">Video sejarah pembangunan Gapura Teluk Kiluan dan keindahan sekitarnya.</p>
                </section>

                <!-- Landscape Photo -->
                <section class="mb-5">
                    <h2 class="section-title">Pemandangan Sekitar</h2>
                    <div class="landscape-photo">
                        <img src="./assets/images/gapura-panorama.jpg" class="img-fluid w-100" alt="Panorama Gapura Teluk Kiluan">
                    </div>
                    <p>Pemandangan panorama sekitar Gapura Teluk Kiluan yang menakjubkan dengan latar belakang perbukitan dan laut biru yang memesona. Area ini sering menjadi latar foto pre-wedding dan foto keluarga karena pemandangannya yang instagramable.</p>
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
                                    <strong><i class="fas fa-calendar-day me-2 text-secondary"></i> Dibangun:</strong>
                                    <span class="float-end">Tahun 2018</span>
                                </li>
                                <li class="mb-3">
                                    <strong><i class="fas fa-ruler-combined me-2 text-secondary"></i> Ukuran:</strong>
                                    <span class="float-end">Tinggi 8m, Lebar 12m</span>
                                </li>
                                <li class="mb-3">
                                    <strong><i class="fas fa-archway me-2 text-secondary"></i> Gaya Arsitektur:</strong>
                                    <span class="float-end">Tradisional Lampung</span>
                                </li>
                                <li class="mb-3">
                                    <strong><i class="fas fa-camera me-2 text-secondary"></i> Spot Foto:</strong>
                                    <span class="float-end">Favorit Wisatawan</span>
                                </li>
                                <li class="mb-3">
                                    <strong><i class="fas fa-sign me-2 text-secondary"></i> Fungsi:</strong>
                                    <span class="float-end">Pintu Masuk Wisata</span>
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
                            <p class="mb-1"><strong>Jarak dari Bandara:</strong> 45 km</p>
                            <p><strong>Akses:</strong> 1.5 jam perjalanan dari Bandar Lampung</p>
                        </div>
                    </div>

                    <!-- Contact/Partners -->
                    <div class="info-card">
                        <div class="card-body">
                            <h4 class="mb-4 text-center"><i class="fas fa-handshake me-2 text-primary"></i> Pengelola</h4>
                            <div class="text-center mb-3">
                                <img src="./assets/images/dispar-lampung.png" alt="Dinas Pariwisata" class="img-fluid mb-2" style="max-height: 50px;">
                                <img src="./assets/images/pemda-lampung.png" alt="Pemda Lampung" class="img-fluid mb-2" style="max-height: 50px;">
                            </div>
                            <p>Gapura Teluk Kiluan dikelola oleh:</p>
                            <ul>
                                <li>Dinas Pariwisata Lampung Selatan</li>
                                <li>Pemerintah Desa Kiluan</li>
                                <li>Komunitas Sadar Wisata Kiluan</li>
                            </ul>
                            <div class="d-grid gap-2">
                                <a href="#" class="btn btn-primary"><i class="fas fa-info-circle me-2"></i> Info Wisata</a>
                                <a href="#" class="btn btn-outline-secondary"><i class="fas fa-route me-2"></i> Panduan Rute</a>
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