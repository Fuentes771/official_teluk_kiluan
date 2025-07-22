<?php
include 'koneksi.php';
session_start();
// Ambil data log
$query = mysqli_query($conn, "SELECT * FROM log_aktivitas ORDER BY waktu DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Log Aktivitas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h3>Log Aktivitas</h3>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Waktu</th>
        <th>Pengguna</th>
        <th>Aktivitas</th>
        <th>IP Address</th>
      </tr>
    </thead>
    <tbody>
      <?php while($log = mysqli_fetch_assoc($query)): ?>
        <tr>
          <td><?= $log['waktu'] ?></td>
          <td><?= $log['username'] ?></td>
          <td><?= $log['aktivitas'] ?></td>
          <td><?= $log['ip_address'] ?></td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>
</body>
</html>
