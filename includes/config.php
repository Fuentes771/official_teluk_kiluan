<?php
$host = "localhost";
$user = "u855675680_rinovajaya";
$password = "Generazberbaktijaya123!";
$dbname = "u855675680_pekonkiluan";

try {
  $conn = new mysqli($host, $user, $password, $dbname);
  
  if ($conn->connect_error) {
    throw new Exception("Koneksi gagal: " . $conn->connect_error);
  }
  
  // Set charset
  $conn->set_charset("utf8mb4");
  
} catch (Exception $e) {
  die("Error: " . $e->getMessage());
}
?>