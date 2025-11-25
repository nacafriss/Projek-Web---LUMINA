<?php
require("../components/session_protect.php");
require "../config/koneksi.php";

if ($_SESSION['role'] !== "admin") {
    header("location: ../auth.php?action=login&status=forbidden");
    exit;
}

$id = mysqli_real_escape_string($koneksi, $_POST['id']);
$status = mysqli_real_escape_string($koneksi, $_POST['status']);

$sql = "UPDATE bookings SET status = '$status' WHERE id = '$id'";

if (mysqli_query($koneksi, $sql)) {
    header("location: ../admin/bookings.php?status=updated");
} else {
    header("location: ../admin/bookings.php?status=error");
}
?>
