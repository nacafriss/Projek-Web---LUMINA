<?php
include("config/koneksi.php");
include("components/components.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php head("Destination") ?>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/card.css">
    <link rel="stylesheet" href="css/destinations.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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
        <div class="kiri">
            <a class="book" href="logic/redirect.dashboard.php">Book Now</a>
        </div>
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
        <section class="menu-grid">
            <?php
            $sql = "SELECT * FROM destinations";
            $result = mysqli_query($koneksi, $sql);

            if (mysqli_num_rows($result) == 0) {
                echo "<p style='grid-column: 1 / -1; text-align: center; color: white; font-size: 1.3rem; margin-top: 50px;'>Belum ada destinasi</p>";
            } else {
                while ($row = mysqli_fetch_assoc($result)) {
                    cardDestination($row);
                }
            }
            ?>
        </section>

        <p id="noResult" style="grid-column: 1 / -1;">
            Tidak ada destinasi yang cocok dengan pencarian.
        </p>
    </main>

    <?php footer() ?>

    <script src="js/search.js"></script>
</body>

</html>