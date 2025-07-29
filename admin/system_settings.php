<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Pengaturan Sistem</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css?v=2" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css?v=2" rel="stylesheet">
  <style>
    body {
      background-color: #f4f6f9;
      font-family: 'Segoe UI', sans-serif;
    }

    .settings-container {
      max-width: 800px;
      margin: 50px auto;
    }

    .card {
      border-radius: 15px;
      box-shadow: 0 8px 16px rgba(0,0,0,0.05);
    }

    .card-header {
      background-color: #007bff;
      color: white;
      border-radius: 15px 15px 0 0;
      padding: 20px 25px;
      font-size: 1.4rem;
      font-weight: 600;
    }

    .form-section-title {
      font-size: 1.1rem;
      font-weight: 500;
      margin-bottom: 10px;
      color: #495057;
    }

    .form-label i {
      margin-right: 6px;
      color: #007bff;
    }

    .divider {
      height: 1px;
      background: #dee2e6;
      margin: 25px 0;
    }

    .btn-primary {
      border-radius: 10px;
      padding: 10px 25px;
      font-weight: 500;
    }
  </style>
</head>
<body>

<div class="container settings-container">
  <div class="card">
    <div class="card-header">
      <i class="bi bi-gear-fill me-2"></i>Pengaturan Sistem
    </div>
    <div class="card-body">
      <form method="POST" action="save_settings.php">
        
        <div class="form-section">
          <label class="form-label"><i class="bi bi-globe2"></i>Nama Website</label>
          <input type="text" name="site_name" class="form-control" placeholder="Contoh: TSUNAMIALERT" value="TSUNAMIALERT">
        </div>

        <div class="divider"></div>

        <div class="form-section">
          <label class="form-label"><i class="bi bi-palette-fill"></i>Warna Tema</label>
          <input type="color" name="theme_color" class="form-control form-control-color" value="#0d6efd" title="Pilih warna tema">
        </div>

        <div class="divider"></div>

        <div class="form-section">
          <label class="form-label"><i class="bi bi-clock-fill"></i>Jam Operasional</label>
          <input type="text" name="operation_hours" class="form-control" placeholder="Contoh: 24 Jam" value="24 Jam">
        </div>

        <div class="divider"></div>

        <div class="text-end">
          <button type="submit" class="btn btn-primary"><i class="bi bi-save2"></i> Simpan Pengaturan</button>
        </div>

      </form>
    </div>
  </div>
</div>

</body>
</html>
