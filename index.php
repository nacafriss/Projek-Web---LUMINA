<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/contact.css">
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
            <div class="kiri"><a class="book" href="login.php">Book Now</a></div>
        </header>
        <div class="slide">
            <div class="item" style="background-image: url(https://plus.unsplash.com/premium_photo-1668883189682-7212bebf2f5b?q=80&w=1374&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D);">
                <div class="content">
                    <div class="name">Switzerland</div>
                    <div class="des">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ab, eum!</div>
                    <button>Explore</button>
                </div>
            </div>
            <div class="item" style="background-image: url(https://images.unsplash.com/photo-1650621886779-19747038a1f7?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D);">
                <div class="content">
                    <div class="name">Finland</div>
                    <div class="des">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ab, eum!</div>
                    <button>Explore</button>
                </div>
            </div>
            <div class="item" style="background-image: url(https://images.unsplash.com/photo-1724258258886-b852fdbab36d?q=80&w=1740&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D);">
                <div class="content">
                    <div class="name">Iceland</div>
                    <div class="des">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ab, eum!</div>
                    <button>Explore</button>
                </div>
            </div>
            <div class="item" style="background-image: url(https://images.unsplash.com/photo-1724258339562-47eb9814cb73?q=80&w=1740&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D);">
                <div class="content">
                    <div class="name">Australia</div>
                    <div class="des">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ab, eum!</div>
                    <button>Explore</button>
                </div>
            </div>
            <div class="item" style="background-image: url(https://images.unsplash.com/photo-1695575128673-e5817ec9d3a2?q=80&w=1374&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D);">
                <div class="content">
                    <div class="name">Netherland</div>
                    <div class="des">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ab, eum!</div>
                    <button>Explore</button>
                </div>
            </div>
            <div class="item" style="background-image: url(https://images.unsplash.com/photo-1695575129235-925ea380434f?q=80&w=1374&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D);">
                <div class="content">
                    <div class="name">Ireland</div>
                    <div class="des">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ab, eum!</div>
                    <button>Explore</button>
                </div>
            </div>

        </div>

        <div class="button">
            <button class="prev"><i class="fa-solid fa-arrow-left"></i></button>
            <button class="next"><i class="fa-solid fa-arrow-right"></i></button>
        </div>
    </div>

    <!-- Top destination -->

    <!-- Contact us -->
    <section class="contact-section">
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
    <div class="footer">


    </div>
    <script src="js/main.js"></script>
    <script src="js/contact.js"></script>
</body>

</html>