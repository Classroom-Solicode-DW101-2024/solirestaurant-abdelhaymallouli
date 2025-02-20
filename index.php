<?php
require 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
          integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <link rel="stylesheet" href="frontend/css/style.css">
    <title>M2l Restaurant</title>
</head>
<body>
    <!-- header -->
    <header>
        <a href="#" class="logo"><i class="fas fa-utensils"></i>M2l Restaurant</a>
        <nav class="navbar">
            <a href="#order"><button class="btn0">Order Now</button></a>
        </nav>
    </header>

    <!-- hero section -->
    <section class="home" id="home">
        <div class="content">
            <h3>Tasty Bites</h3>
            <p>Welcome to Tasty Bites, where every meal is a culinary masterpiece delivered straight to your door.</p>
            <a href="/#order" class="btn">order now</a>
        </div>
        <div class="image">
            <img src="img/home-img.png" alt="">
        </div>
    </section>

    <!-- section of product -->
    <section class="Plats" id="popular">
        <h1 class="heading">Our <span>Popular</span> Foods</h1>

        <ul class="list-type">
    <a href="?TypeCuisine=ALL">ALL</a>
    <a href="?TypeCuisine=Chinoise">Chinoise</a>
    <a href="?TypeCuisine=Espagnole">Espagnole</a>
    <a href="?TypeCuisine=Francaise">Francaise</a>
    <a href="?TypeCuisine=Italienne">Italienne</a>
    <a href="?TypeCuisine=Marocaine">Marocaine</a>
    </ul>

    <div class="box-container">
    <?php foreach ($plats as $plat): ?>
        <div class="box">
            <span class="price"> <?= htmlspecialchars($plat['prix']) ?> DH </span>
            <img src="<?= isset($plat['image']) ? htmlspecialchars($plat['image']) : 'img/placeholder.jpg' ?>" 
                 alt="<?= htmlspecialchars($plat['nomPlat']) ?>">
            <h3><?= htmlspecialchars($plat['nomPlat']) ?></h3>
            <div class="stars">
                <p>Categorie : <?= htmlspecialchars($plat['categoriePlat']) ?></p>
            </div>
            <a href="/#order" class="btn">order now</a>
        </div>
    <?php endforeach; ?>
</div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <h3>Contact Us</h3>
                <ul>
                    <li>Email: M2lRestaurant@gmail.com</li>
                    <li>Phone: +212 6243567</li>
                    <li>Address: Tangier, Morocco</li>
                </ul>
            </div>
            <div class="footer-content">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="#home">Home</a></li>
                    <li><a href="#speciality">Our Specials</a></li>
                    <li><a href="#popular">Popular Foods</a></li>
                    <li><a href="#review">Customer Reviews</a></li>
                </ul>
            </div>
            <div class="footer-content">
                <h3>Follow Us</h3>
                <ul class="social-icons">
                    <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                    <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                    <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                    <li><a href="#"><i class="fab fa-whatsapp"></i></a></li>
                    <li><a href="#"><i class="fab fa-github"></i></a></li>
                    <li><a href="#"><i class="fab fa-pinterest"></i></a></li>
                </ul>
            </div>
        </div>
        <h1 class="credit">
            created by <span id="year"></span> | all rights are reserved
        </h1>
        <script>
            document.getElementById("year").textContent = new Date().getFullYear();
        </script>
    </footer>

    <a href="#home" class="fas fa-angle-up" id="scroll-top"></a>

</body>
<script src="frontend/js/script.js"></script>
</html>
