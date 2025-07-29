<?php
require '../includes/config.php';
require '../includes/header.php';?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Galeri - Wisata Dolphin Teluk Kiluan</title>
    
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
    <section class="hero-section text-center dolphin-hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <h1 class="gallery-title display-4 mb-3">Wisata Dolphin Teluk Kiluan</h1>
                    <p class="lead mb-4">Pengalaman Tak Terlupakan Melihat Lumba-Lumba di Habitat Alaminya</p>
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
                    <p class="lead">Teluk Kiluan merupakan salah satu tempat terbaik di Indonesia untuk melihat lumba-lumba di habitat alaminya, dengan kemungkinan melihat hingga ratusan ekor lumba-lumba dalam satu waktu.</p>
                    
                    <p>Wisata dolphin di Teluk Kiluan menawarkan pengalaman unik melihat lumba-lumba jenis spinner dolphin (Stenella longirostris) yang terkenal dengan atraksi melompat dan berputar di udara. Aktivitas ini biasanya dilakukan pada pagi hari saat lumba-lumba sedang mencari makan di perairan Teluk Kiluan.</p>
                    
                    <p>Perjalanan menuju spot lumba-lumba menggunakan perahu tradisional ditemani pemandu lokal yang berpengalaman. Selain lumba-lumba, Anda juga mungkin melihat berbagai biota laut lainnya seperti penyu dan berbagai jenis ikan.</p>
                    
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="info-card h-100">
                                <div class="card-body text-center">
                                    <i class="fas fa-clock card-icon"></i>
                                    <h5>Waktu Terbaik</h5>
                                    <p class="mb-0">Pukul 06.00-09.00 pagi saat lumba-lumba aktif</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-card h-100">
                                <div class="card-body text-center">
                                    <i class="fas fa-calendar-alt card-icon"></i>
                                    <h5>Musim Terbaik</h5>
                                    <p class="mb-0">April - November (musim kemarau)</p>
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
                                <img src="./assets/images/dolphin1.jpg" class="d-block w-100" alt="Lumba-lumba melompat">
                                <div class="carousel-caption d-none d-md-block">
                                    <p>Lumba-lumba melompat di Teluk Kiluan</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="./assets/images/dolphin2.jpg" class="d-block w-100" alt="Sekawanan lumba-lumba">
                                <div class="carousel-caption d-none d-md-block">
                                    <p>Sekawanan lumba-lumba di perairan Kiluan</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="./assets/images/dolphin3.jpg" class="d-block w-100" alt="Perahu tradisional">
                                <div class="carousel-caption d-none d-md-block">
                                    <p>Perahu tradisional untuk melihat lumba-lumba</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="./assets/images/dolphin4.jpg" class="d-block w-100" alt="Sunrise di Kiluan">
                                <div class="carousel-caption d-none d-md-block">
                                    <p>Momen sunrise saat berburu foto lumba-lumba</p>
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
                            <a href="./assets/images/dolphin1.jpg" data-lightbox="gallery" data-title="Lumba-lumba melompat">
                                <img src="./assets/images/dolphin1-thumb.jpg" class="img-fluid gallery-thumbnail" alt="Thumbnail 1">
                            </a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="./assets/images/dolphin2.jpg" data-lightbox="gallery" data-title="Sekawanan lumba-lumba">
                                <img src="./assets/images/dolphin2-thumb.jpg" class="img-fluid gallery-thumbnail" alt="Thumbnail 2">
                            </a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="./assets/images/dolphin3.jpg" data-lightbox="gallery" data-title="Perahu tradisional">
                                <img src="./assets/images/dolphin3-thumb.jpg" class="img-fluid gallery-thumbnail" alt="Thumbnail 3">
                            </a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="./assets/images/dolphin4.jpg" data-lightbox="gallery" data-title="Sunrise di Kiluan">
                                <img src="./assets/images/dolphin4-thumb.jpg" class="img-fluid gallery-thumbnail" alt="Thumbnail 4">
                            </a>
                        </div>
                    </div>
                </section>

                <!-- Video Section -->
                <section class="mb-5">
                    <h2 class="section-title">Video Dokumentasi</h2>
                    <div class="video-container">
                        <iframe src="https://www.youtube.com/embed/example-dolphin" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    <p class="text-muted">Video atraksi lumba-lumba di Teluk Kiluan.</p>
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
                                    <strong><i class="fas fa-dolphin me-2 text-secondary"></i> Jenis Lumba-lumba:</strong>
                                    <span class="float-end">Spinner Dolphin</span>
                                </li>
                                <li class="mb-3">
                                    <strong><i class="fas fa-users me-2 text-secondary"></i> Jumlah per perahu:</strong>
                                    <span class="float-end">5-6 orang</span>
                                </li>
                                <li class="mb-3">
                                    <strong><i class="fas fa-clock me-2 text-secondary"></i> Durasi Tour:</strong>
                                    <span class="float-end">2-3 jam</span>
                                </li>
                                <li class="mb-3">
                                    <strong><i class="fas fa-percentage me-2 text-secondary"></i> Tingkat Keberhasilan:</strong>
                                    <span class="float-end">90% di musim kemarau</span>
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
                            <p class="mb-1"><strong>Meeting Point:</strong> Dermaga Kiluan</p>
                            <p><strong>Waktu Keberangkatan:</strong> 05.30 - 06.00 WIB</p>
                        </div>
                    </div>

                    <!-- Tips for Visitors -->
                    <div class="info-card">
                        <div class="card-body">
                            <h4 class="mb-4 text-center"><i class="fas fa-lightbulb me-2 text-primary"></i> Tips untuk Pengunjung</h4>
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Datang lebih awal (sebelum matahari terbit)</li>
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Bawa kamera dengan lensa tele</li>
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Pakai pakaian nyaman dan jaket</li>
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Bawa obat anti mabuk laut jika perlu</li>
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Gunakan sunblock dan topi</li>
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Jaga jarak aman dengan lumba-lumba</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Conservation Info -->
                    <div class="info-card mt-4">
                        <div class="card-body">
                            <h4 class="mb-4 text-center"><i class="fas fa-hands-helping me-2 text-primary"></i> Konservasi</h4>
                            <p>Lumba-lumba di Teluk Kiluan dilindungi oleh:</p>
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="fas fa-shield-alt text-info me-2"></i> UU No. 5 Tahun 1990</li>
                                <li class="mb-2"><i class="fas fa-shield-alt text-info me-2"></i> CITES Appendix II</li>
                            </ul>
                            <div class="alert alert-warning mt-3">
                                <i class="fas fa-exclamation-triangle me-2"></i> Dilarang memberi makan, menyentuh, atau mengganggu lumba-lumba
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