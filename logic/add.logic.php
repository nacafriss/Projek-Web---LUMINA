<?php
include "../config/koneksi.php";
include "../components/components.php";
if (!isset($_GET['action']) || $_GET['action'] != "add") {
    header("location: ../tambah.php?status=gagal");
}
$title = $_POST['title'];
$location = $_POST['location'];
$price = $_POST['price'];
$description = $_POST['description'];
$maps_embed = $_POST['maps_embed'];
$cover_image = $_POST['cover_image'];
$category = $_POST['category'];
$default_image = "https://placehold.co/600x400?text=Gambar+Kosong";


$sql = "INSERT INTO destinations (title, location, price, description, maps_embed, cover_image, category) 
        VALUES ('$title', '$location', '$price', '$description', '$maps_embed', '$cover_image', '$category')";

if (mysqli_query($koneksi, $sql)) {
    header("Location: ../admin/dashboard.php?status=berhasil_tambah");
    exit;
} else {
    header("Location: ../index.php?status=gagal_tambah");
}

mysqli_close($koneksi);
