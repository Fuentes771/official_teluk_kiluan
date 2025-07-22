<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Folder untuk menyimpan backup
$backupDir = __DIR__ . '/backup_files/';
if (!file_exists($backupDir)) {
    mkdir($backupDir, 0777, true);
}

// Fungsi untuk backup database
function backupDatabase($host, $user, $pass, $db, $backupDir) {
    $date = date("Y-m-d_H-i-s");
    $filename = "backup_{$db}_{$date}.sql";
    $filepath = $backupDir . $filename;

    $command = "mysqldump --user={$user} --password={$pass} --host={$host} {$db} > {$filepath}";
    system($command, $result);

    return $result === 0 ? $filename : false;
}

// Jalankan backup saat tombol ditekan
if (isset($_POST['backup_now'])) {
    $filename = backupDatabase('localhost', 'root', '', 'dbpemweb', $backupDir);
    $status = $filename ? "Backup berhasil: $filename" : "Backup gagal.";
}

// Ambil daftar file backup
$files = array_diff(scandir($backupDir), ['.', '..']);
rsort($files);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Backup Data</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .backup-card {
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      border-radius: 12px;
      padding: 24px;
      background-color: white;
    }
    .backup-table td, .backup-table th {
      vertical-align: middle;
    }
  </style>
</head>
<body>
<div class="container py-5">
  <div class="backup-card">
    <h3 class="mb-4">Backup Data Sistem</h3>
    <?php if (isset($status)): ?>
      <div class="alert alert-info"><?= $status ?></div>
    <?php endif; ?>

    <form method="POST" class="mb-4">
      <button type="submit" name="backup_now" class="btn btn-success">
        <i class="fas fa-database me-2"></i> Backup Sekarang
      </button>
    </form>

    <h5>Daftar File Backup</h5>
    <table class="table table-bordered backup-table">
      <thead class="table-light">
        <tr>
          <th>Nama File</th>
          <th>Waktu Dibuat</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
      <?php if (empty($files)): ?>
        <tr><td colspan="3" class="text-center">Belum ada file backup.</td></tr>
      <?php else: ?>
        <?php foreach ($files as $file): ?>
          <tr>
            <td><?= htmlspecialchars($file) ?></td>
            <td><?= date("d M Y, H:i:s", filemtime($backupDir . $file)) ?></td>
            <td>
              <a href="backup_files/<?= urlencode($file) ?>" class="btn btn-sm btn-primary" download>Download</a>
              <a href="?delete=<?= urlencode($file) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus file ini?')">Hapus</a>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<!-- Hapus file -->
<?php
if (isset($_GET['delete'])) {
    $fileToDelete = basename($_GET['delete']);
    $pathToDelete = $backupDir . $fileToDelete;
    if (file_exists($pathToDelete)) {
        unlink($pathToDelete);
        header("Location: backup.php");
        exit;
    }
}
?>

<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>
