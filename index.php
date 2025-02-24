<?php
session_start();

require 'config.php'; 

// Get both selected values
$typeCuisine = isset($_GET['typeCuisine']) ? $_GET['typeCuisine'] : 'ALL';
$categoriePlat = isset($_GET['categoriePlat']) ? $_GET['categoriePlat'] : 'ALL';

$sql = "SELECT * FROM plat";
$params = [];
// SQL query based on selections
if ($typeCuisine !== 'ALL' && $categoriePlat !== 'ALL') {
    $sql .= " WHERE typeCuisine = :typeCuisine AND categoriePlat = :categoriePlat";
    $params = ['typeCuisine' => $typeCuisine, 'categoriePlat' => $categoriePlat];
} elseif ($typeCuisine !== 'ALL') {
    $sql .= " WHERE typeCuisine = :typeCuisine";
    $params['typeCuisine'] = $typeCuisine;
} elseif ($categoriePlat !== 'ALL') {
    $sql .= " WHERE categoriePlat = :categoriePlat";
    $params['categoriePlat'] = $categoriePlat;
}

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$plats = $stmt->fetchAll(PDO::FETCH_ASSOC);

$platsByCuisine = [];
foreach ($plats as $plat) {
    $platsByCuisine[$plat['TypeCuisine']][] = $plat;  
}



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
    <a href="index.php" class="logo"><i class="fas fa-utensils"></i>M2l Restaurant</a>
    <nav class="navbar">
        <?php if (isset($_SESSION['client_name'])) { ?>
            <a href="#">Hello, <?= htmlspecialchars($_SESSION['client_name']) ?></a>
            <a href="logout.php"><button class="btn0">Log Out</button></a>
            <a href="order.php"><button class="btn0">Order</button></a> <!-- Order Button -->
        <?php } else { ?>
            <a href="sign-in.php"><button class="btn0">Sign Up</button></a>
        <?php } ?>
    </nav>
</header>


    <!-- hero section -->
    <section class="home" id="home">
        <div class="content">
            <h3>Tasty Bites</h3>
            <p>Welcome to Tasty Bites, where every meal is a culinary masterpiece delivered straight to your door.</p>
            <a href="#PLats" class="btn">order now</a>
        </div>
        <div class="image">
            <img src="frontend/img/home-img.png" alt="">
        </div>
    </section>


    <!-- Select simple dial filters -->
    <section class="Plats" id="PLats">
    <h1 class="heading">Our <span>Popular</span> Foods</h1>
    
    <!-- Form with both selects and buttons -->
    <div class="form-filter">
        <form class="form-select" method="get" action="">
            <select  name="categoriePlat">
                <option value="ALL">All Categories</option>
                <option value="plat principal">Plat Principal</option>
                <option value="entrée">Entrée</option>
                <option value="dessert">Dessert</option>
            </select>

            <select  name="typeCuisine">
                <option value="ALL">All Cuisines</option>
                <option value="Marocaine">Marocaine</option>
                <option value="Chinoise">Chinoise</option>
                <option value="Espagnole">Espagnole</option>
                <option value="Francaise">Francaise</option>
                <option value="Italienne">Italienne</option>
            </select>

            <button class="button-filter" type="submit" style="">Filter</button>
        </form>
    </div>

        <?php foreach ($platsByCuisine as $cuisineType => $cuisinePlats): ?>
            <h2 class="cuisine-heading"><?= htmlspecialchars($cuisineType) ?> Cuisine</h2>
            <div class="box-container">
                <?php foreach ($cuisinePlats as $plat): ?>
                    <div class="box">
                        <span class="price"><?= htmlspecialchars($plat['prix']) ?> DH</span>
                        <img src="<?= isset($plat['image']) ? htmlspecialchars($plat['image']) : "" ?>" 
                             alt="<?= htmlspecialchars($plat['nomPlat']) ?>">
                        <h3><?= htmlspecialchars($plat['nomPlat']) ?></h3>
                        <div class="stars">
                            <p>Categorie : <?= htmlspecialchars($plat['categoriePlat']) ?></p>
                        </div>
                        <a href="order.php?add_to_order=<?= $plat['idPlat'] ?>" class="btn">order now</a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
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
