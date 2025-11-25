<?php

include("config/koneksi.php");
include("components/components.php")
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Destinations</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/card.css">
    <link rel="stylesheet" href="css/destinations.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>

<body>
    <header class="header">
        <div class="logo">LUMINA</div>
        <nav class="navbar">
            <a href="index.php">Home</a>
            <a href="destinations.php">Destinations</a>
            <a href="index.php#about">About</a>
            <a href="index.php#contact">Contact</a>
        </nav>
        <div class="kiri"><a class="book" href="logic/redirect.dashboard.php">Book Now</a></div>
    </header>

    <!-- Search -->
    <div class="search-container">
        <div class="search-box">
            <input type="text" id="searchInput" placeholder="Cari destinasi..." autocomplete="off">
            <button class="search-btn">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </div>
    </div>



    <!-- MAIN CONTENT -->
    <main class="content">
        <div class="d-flex justify-content-between align-items-center">

            <section class="menu-grid">
                <?php
                $sql = "SELECT * FROM destinations";
                $result = mysqli_query($koneksi, $sql);

                if (mysqli_num_rows($result) == 0) {
                    echo "<p>Belum ada destinasi</p>";
                }

                while ($row = mysqli_fetch_assoc($result)) {
                    cardDestination($row);
                }
                ?>
            </section>

            <p id="noResult" style="text-align:center; color:white; display:none; margin-top:20px;">
                Tidak ada destinasi yang cocok dengan pencarian.
            </p>

            <script src="js/search.js"></script>


</body>

</html>