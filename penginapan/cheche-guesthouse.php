<?php  
$pageTitle = "Cheche Guesthouse";
require '../includes/header.php'; 
?>

<!-- Hero Section -->
<section class="hero-guesthouse text-white py-5 position-relative mb-0">
  <div class="overlay position-absolute top-0 start-0 w-100 h-100" style="background-color: rgba(0,0,0,0.5); z-index: 1;"></div>
  <div class="container position-relative z-2 text-center">
    <h1 class="display-5 fw-bold">Cheche Guesthouse</h1>
    <p class="lead">Penginapan Nyaman di Desa Kiluan Negeri</p>
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
          <strong>Bapak Cheche</strong>
        </div>
      </div>
      <div class="col-md-3">
        <div class="info-box bg-light shadow-sm p-3 rounded">
          <i class="fas fa-map-marker-alt text-success fa-2x mb-2"></i>
          <p class="small text-muted mb-1">Lokasi</p>
          <strong>Desa Kiluan Negeri</strong>
        </div>
      </div>
      <div class="col-md-3">
        <div class="info-box bg-light shadow-sm p-3 rounded">
          <i class="fas fa-phone text-info fa-2x mb-2"></i>
          <p class="small text-muted mb-1">Telepon</p>
          <strong>+62 853-7951-9990</strong>
        </div>
      </div>
      <div class="col-md-3">
        <div class="info-box bg-light shadow-sm p-3 rounded">
          <i class="fas fa-money-bill-wave text-warning fa-2x mb-2"></i>
          <p class="small text-muted mb-1">Harga</p>
          <strong>Rp 300.000/malam</strong>
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
      <li class="breadcrumb-item active">Cheche Guesthouse</li>
    </ol>
  </div>
</nav>

<!-- Konten Utama -->
<div class="container">
  <div class="row">
    <!-- Detail -->
    <div class="col-lg-8">
      <div class="card shadow-sm mb-4">
        <img src="../assets/images/cheche-guesthouse-large.jpg" class="card-img-top" alt="Cheche Guesthouse">
      </div>

      <div class="card shadow-sm mb-4">
        <div class="card-body">
          <h2 class="fw-bold mb-3">Cheche Guesthouse</h2>
          <p class="lead text-muted">Penginapan Nyaman di Desa Kiluan Negeri</p>

          <h4 class="border-bottom pb-2 mb-3">Deskripsi</h4>
          <p>Cheche Guesthouse adalah penginapan yang terletak di Desa Kiluan Negeri, menawarkan pengalaman menginap yang nyaman dengan suasana alam yang menenangkan. Penginapan ini cocok untuk wisatawan yang ingin menikmati keindahan alam Kiluan.</p>

          <h4 class="border-bottom pb-2 mb-3 mt-4">Fasilitas</h4>
          <div class="row">
            <div class="col-md-6">
              <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex align-items-center">
                  <i class="fas fa-bed text-primary me-3"></i> Kasur nyaman
                </li>
                <li class="list-group-item d-flex align-items-center">
                  <i class="fas fa-bath text-primary me-3"></i> Toilet bersih
                </li>
              </ul>
            </div>
            <div class="col-md-6">
              <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex align-items-center">
                  <i class="fas fa-umbrella-beach text-primary me-3"></i> Area santai
                </li>
                <li class="list-group-item d-flex align-items-center">
                  <i class="fas fa-concierge-bell text-primary me-3"></i> Pelayanan ramah
                </li>
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
          <form action="process-booking.php" method="POST">
            <input type="hidden" name="product_id" value="cheche-guesthouse">

            <div class="mb-3">
              <label class="form-label">Tanggal Check-in</label>
              <input type="date" name="checkin" class="form-control" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Tanggal Check-out</label>
              <input type="date" name="checkout" class="form-control" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Jumlah Kamar</label>
              <select name="rooms" class="form-select" required>
                <option value="1">1 Kamar</option>
                <option value="2">2 Kamar</option>
                <option value="3">3 Kamar</option>
              </select>
            </div>

            <button type="submit" class="btn btn-primary w-100">Pesan Sekarang</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require '../includes/footer.php'; ?>
