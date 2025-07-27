<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Galeri - Gigihiu</title>
    
    <!-- Menghubungkan file CSS eksternal -->
    <link rel="stylesheet" href="assets/css/gigihiu.css">
    
    <!-- Tambahkan juga library eksternal yang diperlukan -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
</head>
<body>
    <!-- Hero Section -->
    <section class="hero-section text-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <h1 class="gallery-title display-4 mb-3">Transpalansi Terumbu Karang</h1>
                    <p class="lead mb-4">Restorasi Ekosistem Bawah Laut yang Menakjubkan</p>
                    <span class="badge location-badge p-2">
                        <i class="fas fa-map-marker-alt me-2"></i> Pantai Timur, Bali
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
                    <p class="lead">Transpalansi terumbu karang adalah upaya konservasi untuk memulihkan ekosistem bawah laut yang rusak dengan menanam kembali fragmen karang yang sehat.</p>
                    
                    <p>Program ini dilakukan di perairan Pantai Timur Bali yang memiliki kondisi ideal untuk pertumbuhan terumbu karang. Dengan kedalaman antara 3-8 meter, area ini menjadi habitat ideal bagi berbagai spesies karang dan biota laut.</p>
                    
                    <p>Proses transplantasi dimulai dengan pengumpulan fragmen karang sehat dari donor alami, kemudian dipindahkan ke substrat buatan yang telah dipersiapkan. Dalam waktu 6-12 bulan, karang ini akan tumbuh dan membentuk koloni baru yang dapat menarik kembali kehidupan laut ke area tersebut.</p>
                    
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="info-card h-100">
                                <div class="card-body text-center">
                                    <i class="fas fa-calendar-alt card-icon"></i>
                                    <h5>Waktu Terbaik Berkunjung</h5>
                                    <p class="mb-0">April - Oktober ketika kondisi laut tenang dan visibilitas tinggi (15-30 meter)</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-card h-100">
                                <div class="card-body text-center">
                                    <i class="fas fa-water card-icon"></i>
                                    <h5>Kondisi Perairan</h5>
                                    <p class="mb-0">Suhu air 28-30°C, salinitas 32-34 ppt, arus sedang (0.5-1 knot)</p>
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
                                <img src="./assets/images/coral1.jpg" class="d-block w-100" alt="Proses Transplantasi">
                                <div class="carousel-caption d-none d-md-block">
                                    <p>Proses penanaman fragmen karang</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="./assets/images/coral2.jpg" class="d-block w-100" alt="Karang Setelah 6 Bulan">
                                <div class="carousel-caption d-none d-md-block">
                                    <p>Pertumbuhan karang setelah 6 bulan</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="./assets/images/coral3.jpg" class="d-block w-100" alt="Ekosistem yang Pulih">
                                <div class="carousel-caption d-none d-md-block">
                                    <p>Ekosistem yang mulai pulih</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="./assets/images/coral4.jpg" class="d-block w-100" alt="Biota Laut Kembali">
                                <div class="carousel-caption d-none d-md-block">
                                    <p>Biota laut yang kembali</p>
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
                            <a href="./assets/images/coral1.jpg" data-lightbox="gallery" data-title="Proses Transplantasi">
                                <img src="./assets/images/coral1-thumb.jpg" class="img-fluid gallery-thumbnail" alt="Thumbnail 1">
                            </a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="./assets/images/coral2.jpg" data-lightbox="gallery" data-title="Karang Setelah 6 Bulan">
                                <img src="./assets/images/coral2-thumb.jpg" class="img-fluid gallery-thumbnail" alt="Thumbnail 2">
                            </a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="./assets/images/coral3.jpg" data-lightbox="gallery" data-title="Ekosistem yang Pulih">
                                <img src="./assets/images/coral3-thumb.jpg" class="img-fluid gallery-thumbnail" alt="Thumbnail 3">
                            </a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="./assets/images/coral4.jpg" data-lightbox="gallery" data-title="Biota Laut Kembali">
                                <img src="./assets/images/coral4-thumb.jpg" class="img-fluid gallery-thumbnail" alt="Thumbnail 4">
                            </a>
                        </div>
                    </div>
                </section>

                <!-- Video Section -->
                <section class="mb-5">
                    <h2 class="section-title">Video Dokumentasi</h2>
                    <div class="video-container">
                        <iframe src="https://www.youtube.com/embed/example" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    <p class="text-muted">Video dokumentasi proses transplantasi terumbu karang dari awal hingga perkembangan setelah 1 tahun.</p>
                </section>

                <!-- Landscape Photo -->
                <section class="mb-5">
                    <h2 class="section-title">Pemandangan Bawah Laut</h2>
                    <div class="landscape-photo">
                        <img src="./assets/images/coral-landscape.jpg" class="img-fluid w-100" alt="Landscape Terumbu Karang">
                    </div>
                    <p>Pemandangan bawah laut area transplantasi terumbu karang yang telah berusia 2 tahun. Terlihat berbagai jenis karang seperti Acropora, Montipora, dan Porites yang tumbuh subur serta berbagai ikan yang telah menjadikan area ini sebagai habitat mereka.</p>
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
                                    <strong><i class="fas fa-calendar-day me-2 text-secondary"></i> Dimulai:</strong>
                                    <span class="float-end">Juni 2022</span>
                                </li>
                                <li class="mb-3">
                                    <strong><i class="fas fa-ruler-combined me-2 text-secondary"></i> Luas Area:</strong>
                                    <span class="float-end">500 m²</span>
                                </li>
                                <li class="mb-3">
                                    <strong><i class="fas fa-coral me-2 text-secondary"></i> Jenis Karang:</strong>
                                    <span class="float-end">12 Spesies</span>
                                </li>
                                <li class="mb-3">
                                    <strong><i class="fas fa-fish me-2 text-secondary"></i> Biota Terkait:</strong>
                                    <span class="float-end">45+ Spesies</span>
                                </li>
                                <li class="mb-3">
                                    <strong><i class="fas fa-percentage me-2 text-secondary"></i> Tingkat Keberhasilan:</strong>
                                    <span class="float-end">85%</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Location Map -->
                    <div class="info-card mb-4">
                        <div class="card-body">
                            <h4 class="mb-4 text-center"><i class="fas fa-map-marked-alt me-2 text-primary"></i> Lokasi</h4>
                            <div class="ratio ratio-16x9 mb-3">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1dexample" allowfullscreen="" loading="lazy"></iframe>
                            </div>
                            <p class="mb-1"><strong>Koordinat:</strong> 8.1234° S, 115.5678° E</p>
                            <p class="mb-1"><strong>Kedalaman:</strong> 3-8 meter</p>
                            <p><strong>Akses:</strong> 15 menit dengan perahu dari Pantai Timur</p>
                        </div>
                    </div>

                    <!-- Contact/Partners -->
                    <div class="info-card">
                        <div class="card-body">
                            <h4 class="mb-4 text-center"><i class="fas fa-handshake me-2 text-primary"></i> Kolaborasi</h4>
                            <div class="text-center mb-3">
                                <img src="./assets/images/partner1.png" alt="Partner 1" class="img-fluid mb-2" style="max-height: 50px;">
                                <img src="./assets/images/partner2.png" alt="Partner 2" class="img-fluid mb-2" style="max-height: 50px;">
                            </div>
                            <p>Program ini merupakan kolaborasi antara:</p>
                            <ul>
                                <li>Dinas Kelautan dan Perikanan Bali</li>
                                <li>Universitas Udayana</li>
                                <li>Komunitas Pecinta Bahari Lokal</li>
                            </ul>
                            <div class="d-grid gap-2">
                                <a href="#" class="btn btn-primary"><i class="fas fa-envelope me-2"></i> Kontak Kami</a>
                                <a href="#" class="btn btn-outline-secondary"><i class="fas fa-donate me-2"></i> Donasi</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Back Button -->
        <div class="text-center mt-4">
            <button onclick="window.history.back()" class="back-button">
                <i class="fas fa-arrow-left me-2"></i> Kembali ke Galeri
            </button>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>Tentang Program Transplantasi</h5>
                    <p>Program restorasi terumbu karang untuk memulihkan ekosistem bawah laut yang telah rusak akibat aktivitas manusia dan perubahan iklim.</p>
                </div>
                <div class="col-md-3">
                    <h5>Tautan Cepat</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white">Galeri</a></li>
                        <li><a href="#" class="text-white">Artikel</a></li>
                        <li><a href="#" class="text-white">Kegiatan</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Sosial Media</h5>
                    <div class="social-links">
                        <a href="#" class="text-white me-2"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-white me-2"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white me-2"><i class="fab fa-youtube"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
            </div>
            <hr class="my-4 bg-secondary">
            <div class="text-center">
                <p class="mb-0">&copy; 2024 Program Transplantasi Terumbu Karang Bali. Seluruh hak cipta dilindungi.</p>
            </div>
        </div>
    </footer>

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