<?php 

$localhost = "localhost";
$username = "root";
$password = "";
$db = "wisata_db";

$koneksi = mysqli_connect($localhost, $username, $password, $db);
if(!$koneksi){
    die("Koneksi gagal!");
}

?>