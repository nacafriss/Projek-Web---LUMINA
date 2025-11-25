<?php
require "../config/koneksi.php";
session_start();

if (!isset($_SESSION['logined']) || $_SESSION['role'] !== "admin") {
    header("location: ../auth.php?action=login");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $destination_id = intval($_POST['destination_id']);
    $image_path = mysqli_real_escape_string($koneksi, $_POST['image_path']);
    $caption = isset($_POST['caption']) ? mysqli_real_escape_string($koneksi, $_POST['caption']) : '';
    
    $sql = "INSERT INTO destination_images (destination_id, image_path, caption, created_at) 
            VALUES ($destination_id, '$image_path', '$caption', NOW())";
    
    if (mysqli_query($koneksi, $sql)) {
        header("location: ../admin/dashboard.php?id=$destination_id&status=success&message=Gambar berhasil ditambahkan");
    } else {
        header("location: ../admin/update.destination.php?id=$destination_id&status=error&message=Gagal menambahkan gambar");
    }
    exit;
}
?>