<?php
if(!isset($pageTitle)) {
  $pageTitle = "Desa Kiluan Negeri";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo htmlspecialchars($pageTitle); ?> | Desa Kiluan Negeri</title>
  <link rel="shortcut icon" href="../assets/favicon.png">
  
  <!-- CSS -->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/css/style.css" rel="stylesheet">

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

  <style>
/*============= NAVIGATION =============*/
.navbar, footer {
    background-color: #005f73 !important;
    padding: 0.5rem 1rem;
}

.navbar-brand {
    display: flex;
    align-items: center;
    gap: 10px;
}

/* Logo container for proper alignment */
.logo-combo {
    display: flex;
    align-items: center;
    gap: 8px;
}

/* Kiluan logo styling */
.logo-kiluan {
    height: 50px;
    width: auto;
    object-fit: contain;
    transform: scale(1.15);
    transform-origin: left center;
    transition: transform 0.3s ease;
}

/* Unila logo styling - slightly smaller */
.logo-unila {
    height: 45px;
    width: auto;
    object-fit: contain;
    transform: scale(1.1);
    transform-origin: left center;
    transition: transform 0.3s ease;
}

.navbar-title {
    font-family: 'Great Vibes', cursive;
    color: #f3efe9;
    font-weight: 600; /* Reduced for better script font rendering */
    font-size: 25px; /* Using rem for better responsiveness */
    letter-spacing: 2px;
    margin: 0;
    line-height: 1;
    transform: translateY(2px); /* Better vertical alignment */
    text-shadow: 1px 1px 2px rgba(0,0,0,0.2);
}

.navbar-title {
  font-family: 'Great Vibes', cursive;
  color: #f3efe9;
    font-weight: 600;
    font-size: 25px;
    letter-spacing: 2px;
    margin: 0;
    line-height: 1;
}

.footer-logo img {
    height: 100px;
    width: auto;
    object-fit: contain;
    padding: 5px 0;
    transition: 0.5s ease;
}

.navbar-toggler,
.navbar-toggler:focus {
    outline: none;
    box-shadow: none;
    border: none;
}

.navbar-toggler-icon {
    color: #f3efe9;
}

.nav-link, .footer-link {
    font-size: 1.1rem;
    font-weight: 500;
    color: #f3efe9 !important;
    letter-spacing: 0.5px;
    transition: 0.3s ease;
    font-family: 'Belleza', sans-serif;
    padding: 0.5rem 1rem;
    position: relative;
}

.nav-link:hover, 
.nav-link.active,
.footer-link:hover {
    color: #f3efe9 !important;
    transform: translateY(-2px);
}

.nav-link::after {
    content: '';
    position: absolute;
    width: 0;
    height: 2px;
    bottom: 5px;
    left: 1rem;
    background-color: #f3efe9;
    transition: width 0.3s ease;
}

.nav-link:hover::after,
.nav-link.active::after {
    width: calc(100% - 2rem);
}

.navbar-collapse .form-control {
    outline: 1px solid #f3efe9;
    font-family: 'Belleza', sans-serif;
}

.navbar-collapse .btn {
    background: #f3efe9;
    color: #005f73;
    border-radius: 5px;
    font-family: 'Belleza', sans-serif;
    transition: all 0.3s ease;
}

.navbar-collapse .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
}

.collapse.navbar-collapse {
    justify-content: flex-end;
}

/* Responsive adjustments */
@media (max-width: 992px) {
    .navbar-title {
        font-size: 1.5rem;
    }
    
    .logo-kiluan {
        height: 45px;
        transform: scale(1.1);
    }
    
    .logo-unila {
        height: 40px;
        transform: scale(1.05);
    }
    
    .nav-link {
        font-size: 1rem;
        padding: 0.5rem;
    }
}  </style>
</head>
<body>

<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid px-0">
    <a class="navbar-brand d-flex align-items-center" href="../index.php">
      <div class="logo-combo">
        <img src="../assets/images/kiluan.png" alt="Logo Kiluan Negeri" class="logo-img">
        <img src="../assets/images/unila.png" alt="Logo Universitas Lampung" class="logo-img unila-logo">
        <span class="navbar-title">Umkm & Pariwisata</span>
      </div>
    </a>  

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span><i class="fa-solid fa-bars"></i></span>
    </button>
  </div>
</nav>
<!-- Navbar End -->


<main class="main-content">

<!-- Rest of your content -->

</main>

<!-- Bootstrap JS -->
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<!-- AOS JS -->
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
  AOS.init();
</script>
</body>
</html>