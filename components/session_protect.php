<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php?status=harus_login");
    exit;
}
?>
