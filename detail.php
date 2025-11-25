<?php
require "config/koneksi.php";
require "components/components.php";

$id = $_GET['id'];

// Ambil data utama destinasi
$sql = "SELECT id, title, description, location, maps_embed, cover_image 
        FROM destinations WHERE id = '$id'";
$result = mysqli_query($koneksi, $sql);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    die("Data tidak ditemukan di database.");
}

// Ambil gallery
$sql_gallery = "SELECT image_path FROM destination_images WHERE destination_id = '$id'";
$gallery = mysqli_query($koneksi, $sql_gallery);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($data['title']) ?> - Detail</title>

    <link rel="stylesheet" href="css/detail.css">
    <link rel="stylesheet" href="css/style.css">

</head>

<body class="body-detail">

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


    <div class="dt-container">
        <div class="full-size-wrapper">
  <section class="full-size-hero">
        <div class="dt-hero">
            <img src="<?= $data['cover_image'] ?>" class="dt-cover">
            <div class="dt-info">
                <h1 class="dt-title"><?= htmlspecialchars($data['title']) ?></h1>
                <div class="dt-location"><i class="fa-solid fa-location-dot"></i><?= $data['location'] ?></div>
                <p class="dt-description"><?= nl2br(htmlspecialchars($data['description'])) ?></p>

            </div>
        </div>

        <h2 class="dt-section-title">Gallery</h2>

        <?php if (mysqli_num_rows($gallery) == 0): ?>
            <div class="no-gallery">Belum ada foto.</div>

        <?php else: ?>
            <div class="stage">
                <div class="ring">
                    <?php
                    // Loop gambar gallery
                    mysqli_data_seek($gallery, 0);
                    while ($g = mysqli_fetch_assoc($gallery)): ?>
                        <div class="img" data-img="<?= $g['image_path'] ?>">
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        <?php endif; ?>


        <h2 class="dt-section-title">Maps</h2>
        <div class="dt-maps">
            <?=$data['maps_embed']?>
        </div>


    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="js/gallery.js"></script>
</body>

</html>