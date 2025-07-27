<?php
// proses_tambah.php
require '../includes/config.php';

// Cek apakah form telah disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validasi dan sanitasi input
    $name = $conn->real_escape_string($_POST['nama'] ?? '');
    $description = $conn->real_escape_string($_POST['deskripsi'] ?? '');
    $price = floatval($_POST['harga'] ?? 0);
    $type = $conn->real_escape_string($_POST['tipe'] ?? '');
    $owner = $conn->real_escape_string($_POST['pemilik'] ?? '');
    $location = $conn->real_escape_string($_POST['lokasi'] ?? '');
    $phone = $conn->real_escape_string($_POST['telepon'] ?? '');

    // Validasi data wajib
    if (empty($name) || empty($price) || empty($type) || empty($_FILES['gambar_utama']['name'])) {
        $_SESSION['error'] = "Harap isi semua field yang wajib diisi!";
        header("Location: tambah_produk.php");
        exit();
    }

    // Proses upload gambar utama
    $featuredImage = '';
    if ($_FILES['gambar_utama']['error'] == 0) {
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
        $fileExtension = strtolower(pathinfo($_FILES['gambar_utama']['name'], PATHINFO_EXTENSION));
        
        if (!in_array($fileExtension, $allowedExtensions)) {
            $_SESSION['error'] = "Format file tidak didukung. Hanya JPG, JPEG, PNG, dan WEBP yang diperbolehkan.";
            header("Location: tambah_produk.php");
            exit();
        }

        // Generate nama file unik
        $featuredImage = 'prod_'.time().'_'.uniqid().'.'.$fileExtension;
        $uploadPath = '../assets/images/'.$featuredImage;
        
        if (!move_uploaded_file($_FILES['gambar_utama']['tmp_name'], $uploadPath)) {
            $_SESSION['error'] = "Gagal mengupload gambar utama.";
            header("Location: tambah_produk.php");
            exit();
        }
    }

    // Insert data produk ke database
    $query = "INSERT INTO products (name, description, price, type, owner, location, phone, featured_image, created_at) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssdsssss", $name, $description, $price, $type, $owner, $location, $phone, $featuredImage);
    
    if (!$stmt->execute()) {
        // Hapus file yang sudah diupload jika query gagal
        if (!empty($featuredImage)) {
            @unlink($uploadPath);
        }
        
        $_SESSION['error'] = "Gagal menambahkan produk: " . $conn->error;
        header("Location: tambah_produk.php");
        exit();
    }
    
    $productId = $conn->insert_id;
    $stmt->close();

    // Proses fasilitas
    if (!empty($_POST['fasilitas'])) {
        foreach ($_POST['fasilitas'] as $facility) {
            $facility = trim($conn->real_escape_string($facility));
            if (!empty($facility)) {
                $conn->query("INSERT INTO product_facilities (product_id, facility) VALUES ($productId, '$facility')");
            }
        }
    }

    // Proses gambar tambahan
    if (!empty($_FILES['gambar_tambahan']['name'][0])) {
        foreach ($_FILES['gambar_tambahan']['tmp_name'] as $key => $tmpName) {
            if ($_FILES['gambar_tambahan']['error'][$key] == 0) {
                $fileExtension = strtolower(pathinfo($_FILES['gambar_tambahan']['name'][$key], PATHINFO_EXTENSION));
                
                if (in_array($fileExtension, $allowedExtensions)) {
                    $additionalImage = 'prod_'.time().'_'.$key.'_'.uniqid().'.'.$fileExtension;
                    $uploadPath = '../assets/images/'.$additionalImage;
                    
                    if (move_uploaded_file($tmpName, $uploadPath)) {
                        $conn->query("INSERT INTO product_images (product_id, image_path) VALUES ($productId, '$additionalImage')");
                    }
                }
            }
        }
    }

    // Redirect dengan pesan sukses
    $_SESSION['success'] = "Produk berhasil ditambahkan!";
    header("Location: index.php");
    exit();
} else {
    // Jika bukan POST request, redirect ke halaman tambah produk
    header("Location: tambah_produk.php");
    exit();
}
?>