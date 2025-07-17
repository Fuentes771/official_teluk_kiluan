<?php
session_start();
require '../includes/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $product_id = $_POST['product_id'];
  $checkin = $_POST['checkin'];
  $checkout = $_POST['checkout'];
  $rooms = $_POST['rooms'];
  
  // Simpan ke session atau database
  $_SESSION['booking'] = [
    'product_id' => $product_id,
    'checkin' => $checkin,
    'checkout' => $checkout,
    'rooms' => $rooms
  ];
  
  header('Location: booking-confirmation.php');
  exit;
} else {
  header('Location: ../index.php');
  exit;
}