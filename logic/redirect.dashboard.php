<?php
session_start();

// Kalau belum login → wajib login dulu
if (!isset($_SESSION['logined'])) {
    header("location: ../auth.php?action=login");
    exit;
}

// Kalau sudah login → arahkan berdasarkan role
if ($_SESSION['role'] === "admin") {
    header("location: ../admin/dashboard.php");
} else {
    header("location: ../user/dashboard.php");
}
exit;
