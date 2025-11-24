<?php 
session_start();
if (!isset($_SESSION['logined']) || $_SESSION['role'] !== "user") {
    header("location: ../auth.php?action=login&status=forbidden");
    exit;
}

?>