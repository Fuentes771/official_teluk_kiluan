<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Admin - Teluk Kiluan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

  <div class="container mt-5 mb-5">
    <h1 class="text-center mb-4">Dashboard Admin</h1>
    <div class="d-flex justify-content-end mb-3">
      <a href="tambah-produk.php" class="btn btn-success">+ Tambah Produk Baru</a>
    </div>

    <!-- Bagian 1: Produk Pariwisata -->
    <h3 class="mb-3 mt-4">Produk Pariwisata</h3>
    <div class="row">
      <?php
      $produk_pariwisata = [
        [
          "nama" => "CHECHE GUESTHOUSE",
          "deskripsi" => "Penginapan nyaman di tepi pantai Kiluan",
          "harga" => "Rp 300.000/malam",
          "gambar" => "../assets/images/Villa-1.png"
        ],
        [
          "nama" => "CHECHE GUESTHOUSE",
          "deskripsi" => "Penginapan nyaman di tepi pantai Kiluan",
          "harga" => "Rp 300.000/malam",
          "gambar" => "../assets/images/Villa-2.png"
        ],
        [
          "nama" => "CHECHE GUESTHOUSE",
          "deskripsi" => "Penginapan nyaman di tepi pantai Kiluan",
          "harga" => "Rp 300.000/malam",
          "gambar" => "../assets/images/Villa-3.png"
        ]
      ];

      foreach ($produk_pariwisata as $p) {
        echo '
        <div class="col-md-4 mb-4">
          <div class="card shadow h-100">
            <img src="'.$p["gambar"].'" class="card-img-top" style="height: 250px; object-fit: cover;">
            <div class="card-body text-center">
              <h5 class="card-title fw-bold">'.$p["nama"].'</h5>
              <p class="card-text">'.$p["deskripsi"].'</p>
              <h6 class="text-muted">'.$p["harga"].'</h6>
            </div>
          </div>
        </div>';
      }
      ?>
    </div>

    <!-- Bagian 2: Produk UMKM -->
    <h3 class="mb-3 mt-5">Produk UMKM</h3>
    <div class="row">
      <?php
      $produk_umkm = [
        [
          "nama" => "Otak-otak Kiluan",
          "deskripsi" => "Makanan khas dari ikan segar laut Kiluan",
          "harga" => "Rp 20.000/pack",
          "gambar" => "../assets/images/Otak-Otak(1).png"
        ],
        [
          "nama" => "Ikan Asap Tradisional",
          "deskripsi" => "Olahan ikan asap khas Desa Kiluan Negeri",
          "harga" => "Rp 25.000/ekor",
          "gambar" => "../assets/images/Ikan-Asap.png"
        ],
        [
          "nama" => "Nugget Khas Kiluan",
          "deskripsi" => "Olahan daging khas Desa Kiluan",
          "harga" => "Rp 25.000/ekor",
          "gambar" => "../assets/images/Nugget.png"
        ]
      ];

      foreach ($produk_umkm as $p) {
        echo '
        <div class="col-md-4 mb-4">
          <div class="card shadow h-100">
            <img src="'.$p["gambar"].'" class="card-img-top" style="height: 250px; object-fit: cover;">
            <div class="card-body text-center">
              <h5 class="card-title fw-bold">'.$p["nama"].'</h5>
              <p class="card-text">'.$p["deskripsi"].'</p>
              <h6 class="text-muted">'.$p["harga"].'</h6>
            </div>
          </div>
        </div>';
      }
      ?>
    </div>
  </div>

</body>
</html>
