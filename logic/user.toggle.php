<?php
include "../config/koneksi.php";

$id = $_GET['id'];

$q = mysqli_query($koneksi, "SELECT role FROM users WHERE id=$id");
$user = mysqli_fetch_assoc($q);

$newRole = ($user['role'] === 'admin') ? 'user' : 'admin';

mysqli_query($koneksi, "UPDATE users SET role='$newRole' WHERE id=$id");

header("Location: ../admin/users.php");
exit;
