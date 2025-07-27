<?php
require 'includes/header.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Lengkap Desa Teluk Kiluan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
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

    <!-- Header Section -->
    <div class="profile-header">
        <div class="container">
            <h1 class="display-4 fw-bold">Desa Teluk Kiluan</h1>
            <p class="lead">Kecamatan Kelumbayan, Kabupaten Tanggamus, Lampung</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container">
        <!-- Overview Section -->
        <section class="mb-5">
            <h2 class="section-title">Profil Desa Teluk Kiluan</h2>
            <div class="row">
                <div class="col-md-6">
                    <p class="lead">Desa Teluk Kiluan merupakan desa pesisir yang terletak di ujung selatan Lampung dengan potensi wisata bahari yang sangat besar, terutama sebagai habitat lumba-lumba dan destinasi wisata alam.</p>
                </div>
                <div class="col-md-6">
                    <p>Desa ini memiliki luas wilayah 2.066,20 Ha dengan jumlah penduduk 1.619 jiwa (data 2023). Sebagian besar masyarakat bekerja sebagai nelayan, petani, dan bergerak di sektor pariwisata.</p>
                </div>
            </div>
        </section>

        <!-- RT/RW Section -->
        <section class="mb-5">
            <h2 class="section-title">Struktur RT/RW Desa Teluk Kiluan</h2>
            <div class="fact-box">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Wilayah</th>
                                <th>Nama Ketua</th>
                                <th>Jumlah KK</th>
                                <th>Kontak</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>RW 01</td>
                                <td>Sugianto</td>
                                <td>78 KK</td>
                                <td>0821-XXXX-XXXX</td>
                            </tr>
                            <tr>
                                <td>RT 01 RW 01</td>
                                <td>Budi Santoso</td>
                                <td>25 KK</td>
                                <td>0822-XXXX-XXXX</td>
                            </tr>
                            <tr>
                                <td>RT 02 RW 01</td>
                                <td>Mulyadi</td>
                                <td>28 KK</td>
                                <td>0823-XXXX-XXXX</td>
                            </tr>
                            <tr>
                                <td>RT 03 RW 01</td>
                                <td>Rahmat Hidayat</td>
                                <td>25 KK</td>
                                <td>0824-XXXX-XXXX</td>
                            </tr>
                            <tr>
                                <td>RW 02</td>
                                <td>H. Sutrisno</td>
                                <td>85 KK</td>
                                <td>0825-XXXX-XXXX</td>
                            </tr>
                            <tr>
                                <td>RT 01 RW 02</td>
                                <td>Agus Salim</td>
                                <td>30 KK</td>
                                <td>0826-XXXX-XXXX</td>
                            </tr>
                            <tr>
                                <td>RT 02 RW 02</td>
                                <td>Firman Syah</td>
                                <td>28 KK</td>
                                <td>0827-XXXX-XXXX</td>
                            </tr>
                            <tr>
                                <td>RT 03 RW 02</td>
                                <td>Rudi Hartono</td>
                                <td>27 KK</td>
                                <td>0828-XXXX-XXXX</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <!-- Lembaga Desa Section -->
        <section class="mb-5">
            <h2 class="section-title">Lembaga Kemasyarakatan Desa</h2>
            <div class="row">
                <div class="col-md-6">
                    <div class="fact-box">
                        <h4><i class="bi bi-people"></i> Lembaga Pemberdayaan Masyarakat (LPM)</h4>
                        <p>Ketua: Suparman, S.Pd.</p>
                        <p>Visi: "Mendorong partisipasi masyarakat dalam pembangunan desa"</p>
                        <p>Program Unggulan: Pelatihan pengelolaan homestay dan usaha kuliner untuk masyarakat</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="fact-box">
                        <h4><i class="bi bi-tree"></i> Kelompok Sadar Wisata (Pokdarwis)</h4>
                        <p>Ketua: Andi Setiawan</p>
                        <p>Anggota: 35 orang</p>
                        <p>Kegiatan: Pengelolaan wisata lumba-lumba, pemandu wisata, dan kebersihan destinasi</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="fact-box">
                        <h4><i class="bi bi-droplet"></i> Kelompok Nelayan</h4>
                        <p>Ketua: M. Yasin</p>
                        <p>Anggota: 72 orang</p>
                        <p>Alat Tangkap: 45 unit perahu tradisional, 12 unit kapal motor</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="fact-box">
                        <h4><i class="bi bi-flower2"></i> PKK Desa</h4>
                        <p>Ketua: Hj. Aminah Fauzi</p>
                        <p>Program: Posyandu, pelatihan kerajinan tangan dari bahan laut, bank sampah</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section class="mb-5">
            <h2 class="section-title">Potensi Desa</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card feature-card">
                        <img src="https://images.unsplash.com/photo-1552410260-0fd9b577afa6?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" class="card-img-top" alt="Lumba-lumba">
                        <div class="card-body">
                            <h5 class="card-title">Wisata Lumba-Lumba</h5>
                            <p class="card-text">Setiap tahunnya sekitar 25.000 wisatawan mengunjungi Teluk Kiluan untuk melihat atraksi lumba-lumba di habitat alaminya.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card feature-card">
                        <img src="https://images.unsplash.com/photo-1506929562872-bb421503ef21?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" class="card-img-top" alt="Pantai">
                        <div class="card-body">
                            <h5 class="card-title">Pantai Pasir Putih</h5>
                            <p class="card-text">Pantai dengan pasir putih sepanjang 1,5 km yang menjadi tempat peneluran penyu setiap tahunnya.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card feature-card">
                        <img src="https://images.unsplash.com/photo-1520454974749-611b7248ffdb?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" class="card-img-top" alt="Sunrise">
                        <div class="card-body">
                            <h5 class="card-title">Perikanan Tangkap</h5>
                            <p class="card-text">Hasil tangkapan utama berupa ikan tongkol, cakalang, dan cumi-cumi dengan produksi rata-rata 15 ton/bulan.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Back Button -->
        <div class="text-center">
            <button class="back-btn" onclick="window.history.back()">
                <i class="bi bi-arrow-left"></i> Kembali ke Halaman Utama
            </button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>