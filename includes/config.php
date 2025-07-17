<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "kiluan";

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