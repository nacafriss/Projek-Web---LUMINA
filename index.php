<?php
require "components/components.php";
require "config/koneksi.php";

$stmt = $koneksi->prepare("SELECT * FROM Destinations");
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/contact.css">
        <link rel="stylesheet" href="css/top.destination.css">
    <link rel="stylesheet" href="css/about.css">
    <link rel="stylesheet" href="css/features.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300..700;1,300..700&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container">
        <header class="header">
            <div class="logo">LUMINA</div>
            <nav class="navbar">
                <a href="index.php">Home</a>
                <a href="destination.php">Destination</a>
                <a href="#about">About</a>
                <a href="contact.php">Contact</a>
            </nav>
            <div class="kiri"><a class="book" href="logic/redirect.dashboard.php">Book Now</a></div>
        </header>
        <div class="slide">
            <?php while ($data = $result->fetch_assoc()):?>
            <div class="item" style="background-image: url(<?= $data['cover_image'] ?>);">
                <div class="content">
                    <div class="name"><?= $data['title'] ?></div>
                    <div class="des"><?= $data['description'] ?></div>
                    <button>Explore</button>
                </div>
            </div>

            <?php endwhile;?>
        </div>

        <div class="button">
            <button class="prev"><i class="fa-solid fa-arrow-left"></i></button>
            <button class="next"><i class="fa-solid fa-arrow-right"></i></button>
        </div>
    </div>

<!-- Features -->
<section class="features-section">
    <h2 class="features-title">Why Choose Lumina?</h2>

    <div class="features-container">
        <div class="feature-box">
            <i class="fa-solid fa-map-location-dot"></i>
            <h3>Smart Destination Finder</h3>
            <p>Find the perfect place instantly with filters for budget, mood, and activities.</p>
        </div>

        <div class="feature-box">
            <i class="fa-solid fa-star"></i>
            <h3>Real Trusted Reviews</h3>
            <p>Every review comes from real travelers to help you decide confidently.</p>
        </div>

        <div class="feature-box">
            <i class="fa-solid fa-calendar-check"></i>
            <h3>Instant Booking</h3>
            <p>Book attractions, tours, and stays in just one click—no hassle.</p>
        </div>

        <div class="feature-box">
            <i class="fa-solid fa-headset"></i>
            <h3>24/7 Support</h3>
            <p>Our team is ready anytime to assist your travel needs.</p>
        </div>
    </div>
</section>

    <!-- About us -->
<section class="about-section" id="about">
    <div class="bg-about"></div>

    <div class="about-container">
        
        <div class="about-left">
            <h1 class="headline">Feel the <span>Soul</span> of the <span>Islands</span></h1>

            <p>We help travelers discover the heart of every destination through curated attractions, real reviews, maps, galleries, and a smooth booking experience.
            <br>Our goal is simple: to make your journey effortless, inspiring, and truly unforgettable.</p>

            <button>All Destinations</button>
        </div>

        <div class="about-right">
            <div class="about-stats">
                <div class="stat-box">
                    <h2>50K+</h2>
                    <p>Monthly Visitors</p>
                </div>
                <div class="stat-box">
                    <h2>120+</h2>
                    <p>Curated Destinations</p>
                </div>
                <div class="stat-box">
                    <h2>300+</h2>
                    <p>Local Partners</p>
                </div>
            </div>
        </div>

    </div>
</section>



    <!-- Contact us -->
    <section class="contact-section" id="contact">
        <h1 class="contact-us">CONTACT US</h1>
        <div class="bg" style="background-image: url(https://images.unsplash.com/photo-1558473273-e63fc121aef1?q=80&w=2231&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D);"></div>
        <div class="contact-container">
            <form id="contactForm" class="contact">
                <input type="hidden" name="access_key" value="dafb1272-4e21-4902-b680-fcb1a8dc1279">
                <p>Name</p>
                <input type="text" name="name" placeholder="Name"
                    class="contact-inputs" required>
                <p>Email</p>

                <input type="email" name="email" placeholder="Email"
                    class="contact-inputs" required>
                <p>Message</p>
                <textarea name="message" placeholder="Message"
                    class="contact-inputs" required></textarea>
                <button type="submit" class="submit">Submit</button>
            </form>
        </div>
    </section>
    <!-- Footer -->
        <?php footer() ?>


    <script src="js/main.js"></script>
    <script src="js/contact.js"></script>
     <script src="js/top.destination.js"></script>
</body>

</html>