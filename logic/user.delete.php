<?php
include "../config/koneksi.php";

$id = $_GET['id'];

// hapus booking user dulu biar FK aman
mysqli_query($koneksi, "DELETE FROM bookings WHERE user_id=$id");

// hapus user
mysqli_query($koneksi, "DELETE FROM users WHERE id=$id");

header("Location: ../admin/users.php");
exit;
