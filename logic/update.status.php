<?php
session_start();
require "../config/koneksi.php";

if (!isset($_SESSION['logined']) || $_SESSION['role'] !== "admin") {
    header("location: ../auth.php?action=login&status=forbidden");
    exit;
}

if (isset($_POST['booking_id']) && isset($_POST['status'])) {
    $id = intval($_POST['booking_id']);
    $status = $_POST['status'];

    $allowed = ['pending', 'approved', 'declined'];

    if (!in_array($status, $allowed)) {
        die("Status tidak valid.");
    }

    $sql = "UPDATE bookings SET status='$status' WHERE id=$id";
    mysqli_query($koneksi, $sql);

    header("location: ../admin/usersbook.php?status_updated=1");
    exit;
} else {
    header("location: ../admin/usersbook.php?error=invalid_form");
    exit;
}
