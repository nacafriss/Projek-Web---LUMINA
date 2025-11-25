<?php
require "../config/koneksi.php";
session_start();

if (!isset($_SESSION['logined']) || $_SESSION['role'] !== "admin") {
    header("location: ../auth.php?action=login");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id          = intval($_POST['id']);
    $title       = mysqli_real_escape_string($koneksi, $_POST['title']);
    $location    = mysqli_real_escape_string($koneksi, $_POST['location']);
    $description = mysqli_real_escape_string($koneksi, $_POST['description']);
    $category    = mysqli_real_escape_string($koneksi, $_POST['category']);
    $price       = intval($_POST['price']);
    $maps_embed  = mysqli_real_escape_string($koneksi, $_POST['maps_embed']);
    $cover_image = mysqli_real_escape_string($koneksi, $_POST['cover_image']);

    $sql = "UPDATE destinations SET 
                title='$title',
                location='$location',
                description='$description',
                category='$category',
                price='$price',
                maps_embed='$maps_embed',
                cover_image='$cover_image'
            WHERE id=$id";

    if (mysqli_query($koneksi, $sql)) {
        header("location: ../admin/dashboard.php?status=success&message=Perubahan berhasil disimpan");
        exit;
    } else {
        header("location: ../admin/edit.destination.php?id=$id&status=error&message=Gagal update");
        exit;
    }
}
