<?php 

$localhost = "";
$username = "";
$password = "";
$db = "";

$koneksi = mysqli_connect($db, $username, $password, $db);
if(!$koneksi){
    die("Koneksi gagal!");
}

?>