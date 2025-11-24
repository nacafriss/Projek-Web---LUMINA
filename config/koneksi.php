<?php 

$host = "localhost";
$username = "root";
$password = "";
$db = "wisata_db";

$koneksi = mysqli_connect($host, $username, $password, $db);
if(!$koneksi){
    die("Koneksi gagal!");
}

?>