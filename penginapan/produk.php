<?php  
$pageTitle = "Detail Produk";
require '../includes/config.php';
require '../includes/header.php';

// Ambil ID produk dari URL
$productId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Query untuk mendapatkan data produk
$productQuery = "SELECT * FROM products WHERE id = ?";
$stmt = $conn->prepare($productQuery);
$stmt->bind_param("i", $productId);
$stmt->execute();
$product = $stmt->get_result()->fetch_assoc();

if (!$product) {
    // Redirect jika produk tidak ditemukan
    header("Location: ../index.php");
    exit();
}

// Query untuk fasilitas
$facilitiesQuery = "SELECT * FROM product_facilities WHERE product_id = ?";
$stmt = $conn->prepare($facilitiesQuery);
$stmt->bind_param("i", $productId);
$stmt->execute();
$facilities = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

// Query untuk gambar tambahan
$imagesQuery = "SELECT * FROM product_images WHERE product_id = ?";
$stmt = $conn->prepare($imagesQuery);
$stmt->bind_param("i", $productId);
$stmt->execute();
$images = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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

    <title><?= htmlspecialchars($pageTitle) ?> - <?= htmlspecialchars($product['name']) ?></title>
</head>

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
        <li class="nav-item mx-1"><a class="nav-link active" aria-current="page" href="../index.php">Beranda</a></li>
        <li class="nav-item mx-1"><a class="nav-link" href="../index.php#about">Informasi</a></li>
        <li class="nav-item mx-1"><a class="nav-link" href="../index.php#services">Pelayanan</a></li>
        <li class="nav-item mx-1"><a class="nav-link" href="../index.php#gallery">Galeri foto</a></li>
        <li class="nav-item mx-1"><a class="nav-link" href="../index.php#packages">Produk</a></li>
        <li class="nav-item mx-1"><a class="nav-link" href="../index.php#location">Lokasi</a></li>
      </ul>
    </div>
  </div>
</nav>
<!-- Navbar End -->

<!-- Hero Section -->
<section class="hero-guesthouse text-white py-5 position-relative mb-0">
  <div class="overlay position-absolute top-0 start-0 w-100 h-100" style="background-color: rgba(0,0,0,0.5); z-index: 1;"></div>
  <div class="container position-relative z-2 text-center">
    <h1 class="display-5 fw-bold"><?= htmlspecialchars($product['name']) ?></h1>
    <p class="lead"><?= htmlspecialchars($product['description']) ?></p>
  </div>
</section>

<!-- Highlight Info Box -->
<section class="bg-white py-4">
  <div class="container">
    <div class="row text-center g-3">
      <div class="col-md-3">
        <div class="info-box bg-light shadow-sm p-3 rounded">
          <i class="fas fa-user text-primary fa-2x mb-2"></i>
          <p class="small text-muted mb-1">Pemilik</p>
          <strong><?= htmlspecialchars($product['owner']) ?></strong>
        </div>
      </div>
      <div class="col-md-3">
        <div class="info-box bg-light shadow-sm p-3 rounded">
          <i class="fas fa-map-marker-alt text-success fa-2x mb-2"></i>
          <p class="small text-muted mb-1">Lokasi</p>
          <strong><?= htmlspecialchars($product['location']) ?></strong>
        </div>
      </div>
      <div class="col-md-3">
        <div class="info-box bg-light shadow-sm p-3 rounded">
          <i class="fas fa-phone text-info fa-2x mb-2"></i>
          <p class="small text-muted mb-1">Telepon</p>
          <strong><?= htmlspecialchars($product['phone']) ?></strong>
        </div>
      </div>
      <div class="col-md-3">
        <div class="info-box bg-light shadow-sm p-3 rounded">
          <i class="fas fa-money-bill-wave text-warning fa-2x mb-2"></i>
          <p class="small text-muted mb-1">Harga</p>
          <strong>Rp <?= number_format($product['price'], 0, ',', '.') ?>/malam</strong>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="my-4">
  <div class="container">
    <ol class="breadcrumb mb-0">
      <li class="breadcrumb-item"><a href="../index.php">Beranda</a></li>
      <li class="breadcrumb-item"><a href="../index.php#packages">Produk</a></li>
      <li class="breadcrumb-item active"><?= htmlspecialchars($product['name']) ?></li>
    </ol>
  </div>
</nav>

<!-- Konten Utama -->
<div class="container">
  <div class="row">
    <!-- Detail -->
    <div class="col-lg-8">
      <div class="card shadow-sm mb-4">
        <img src="../assets/images/<?= htmlspecialchars($product['featured_image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($product['name']) ?>">
      </div>

      <?php if (!empty($images)): ?>
<div class="card shadow-sm mb-4">
  <div class="card-body">
    <h4 class="border-bottom pb-2 mb-3">Galeri Foto Tambahan</h4>
    <div class="row g-3">
      <?php foreach ($images as $img): ?>
      <div class="col-md-4 col-6">
        <img src="../assets/images/<?= htmlspecialchars($img['image_path']) ?>" class="img-fluid rounded" alt="Gambar Tambahan">
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>
<?php endif; ?>


      <div class="card shadow-sm mb-4">
        <div class="card-body">
          <h2 class="fw-bold mb-3"><?= htmlspecialchars($product['name']) ?></h2>
          <p class="lead text-muted"><?= htmlspecialchars($product['description']) ?></p>

          <h4 class="border-bottom pb-2 mb-3">Deskripsi</h4>
          <p><?= nl2br(htmlspecialchars($product['description'])) ?></p>

          <h4 class="border-bottom pb-2 mb-3 mt-4">Fasilitas</h4>
          <div class="row">
            <div class="col-md-6">
              <ul class="list-group list-group-flush">
                <?php foreach(array_chunk($facilities, ceil(count($facilities)/2))[0] as $facility): ?>
                <!-- Di bagian tampilan fasilitas, ubah menjadi: -->
                <li class="list-group-item d-flex align-items-center">
                  <div class="d-flex align-items-center">
                    <i class="fas <?= htmlspecialchars($facility['icon']) ?> text-primary me-3"></i>
                    <div>
                      <?= htmlspecialchars($facility['facility']) ?>
                      <?php if (!empty($facility['image'])): ?>
                        <div class="mt-2">
                          <img src="../assets/images/<?= htmlspecialchars($facility['image']) ?>" class="img-fluid rounded" style="max-height: 100px;" alt="Gambar Fasilitas">
                        </div>
                      <?php endif; ?>
                    </div>
                  </div>
                </li>
                <?php endforeach; ?>
              </ul>
            </div>
            <div class="col-md-6">
              <ul class="list-group list-group-flush">
                <?php if(count($facilities) > 1): ?>
                  <?php foreach(array_chunk($facilities, ceil(count($facilities)/2))[1] as $facility): ?>
                  <li class="list-group-item d-flex align-items-center">
                    <i class="fas <?= htmlspecialchars($facility['icon']) ?> text-primary me-3"></i> 
                    <?= htmlspecialchars($facility['facility']) ?>
                  </li>
                  <?php endforeach; ?>
                <?php endif; ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Form Booking -->
    <div class="col-lg-4">
      <div class="card shadow-sm sticky-top" style="top: 20px;">
        <div class="card-header bg-primary text-white">
          <h5 class="mb-0">Form Pemesanan</h5>
        </div>
        <div class="card-body">
          <form id="bookingForm">
            <input type="hidden" name="product_id" value="<?= $product['id'] ?>">

            <div class="mb-3">
              <label class="form-label">Tanggal Check-in</label>
              <input type="date" name="checkin" id="checkin" class="form-control" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Tanggal Check-out</label>
              <input type="date" name="checkout" id="checkout" class="form-control" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Jumlah Kamar</label>
              <select name="rooms" id="rooms" class="form-select" required>
                <option value="1">1 Kamar</option>
                <option value="2">2 Kamar</option>
                <option value="3">3 Kamar</option>
              </select>
            </div>

            <button type="button" onclick="sendWhatsAppMessage()" class="btn btn-primary w-100">
              <i class="fab fa-whatsapp me-2"></i> Pesan via WhatsApp
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
function sendWhatsAppMessage() {
  const checkin = document.getElementById('checkin').value;
  const checkout = document.getElementById('checkout').value;
  const rooms = document.getElementById('rooms').value;
  
  if (!checkin || !checkout) {
    alert('Harap isi tanggal check-in dan check-out terlebih dahulu');
    return;
  }

  const options = { day: '2-digit', month: '2-digit', year: 'numeric' };
  const formattedCheckin = new Date(checkin).toLocaleDateString('id-ID', options);
  const formattedCheckout = new Date(checkout).toLocaleDateString('id-ID', options);
  
  const message = `Halo <?= $product['owner'] ?> (<?= $product['name'] ?>),

Saya ingin memesan penginapan dengan detail:
• Tanggal Check-in: ${formattedCheckin}
• Tanggal Check-out: ${formattedCheckout}
• Jumlah Kamar: ${rooms}

Apakah tersedia untuk tanggal tersebut?
Terima kasih.`;

  const encodedMessage = encodeURIComponent(message);
  window.open(`https://wa.me/62<?= $product['phone'] ?>?text=${encodedMessage}`, '_blank');
}
</script>

<?php require '../includes/footer.php'; ?>