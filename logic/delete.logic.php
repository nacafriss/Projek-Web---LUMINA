<?php 
include "../config/koneksi.php";

$id = $_GET['id'];

// hapus booking user dulu biar FK aman
mysqli_query($koneksi, "DELETE FROM destinations WHERE id=$id");

header("Location: ../admin/dashboard.php");

?>