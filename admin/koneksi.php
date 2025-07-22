<?php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'u855675680_rinovajaya');
define('DB_PASS', 'Generazberbaktijaya123!');
define('DB_NAME', 'u855675680_pekonkiluan');

// Start session securely
if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params([
        'lifetime' => 86400,
        'path' => '/',
        'domain' => $_SERVER['HTTP_HOST'],
        'secure' => true,
        'httponly' => true,
        'samesite' => 'Strict'
    ]);
    session_start();
}

// Create database connection with error handling
try {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    if ($conn->connect_error) {
        throw new Exception("Database connection failed: " . $conn->connect_error);
    }
    
    // Set charset to utf8mb4 for full Unicode support
    $conn->set_charset("utf8mb4");
} catch (Exception $e) {
    error_log($e->getMessage());
    die("System maintenance in progress. Please try again later.");
}
?>