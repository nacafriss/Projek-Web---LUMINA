<?php 
include "../config/koneksi.php";

$id = $_GET['id'];

mysqli_query($koneksi, "DELETE FROM destinations WHERE id=$id");

header("Location: ../dashboard.php");

?>