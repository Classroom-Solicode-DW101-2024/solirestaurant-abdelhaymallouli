<?php
session_start();
require 'config.php';

if (!isset($_SESSION['order'])) {
    $_SESSION['order'] = [];
}

if (isset($_GET['add_to_order'])) {
    $platId = $_GET['add_to_order'];
    $stmt = $pdo->prepare("SELECT * FROM plat WHERE idPlat = ?");
    $stmt->execute([$platId]);
    $plat = $stmt->fetch();

    if ($plat) {
        $_SESSION['order'][] = $plat;
    }
}

if (isset($_GET['remove_from_order'])) {
    $platId = $_GET['remove_from_order'];
    foreach ($_SESSION['order'] as $key => $plat) {
        if ($plat['idPlat'] == $platId) {
            unset($_SESSION['order'][$key]);
            break;

        }
    }
}


$totalPrice = 0;
foreach ($_SESSION['order'] as $plat){
    $totalPrice += $plat['prix'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="frontend/css/style.css">
    <title>Your Order</title>
</head>
<body>

<header>
    <a href="index.php" class="logo"><i class="fas fa-utensils"></i>M2l Restaurant</a>
</header>

<section class="order-summary">
    <h1>Your Order Summary</h1>

    <?php if (count($_SESSION['order']) > 0): ?>
        <div class="order-items">
            <?php foreach ($_SESSION['order'] as $plat): ?>
                <div class="order-item">
                    <h3><?= htmlspecialchars($plat['nomPlat']) ?> - <?= htmlspecialchars($plat['prix']) ?> DH</h3>
                    <a href="order.php?remove_from_order=<?= $plat['idPlat'] ?>" class="btn">Remove</a>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="order-total">
            <p>Total: <?= $totalPrice ?> DH</p>
        </div>
        <form method="POST" action="confirm_order.php">
            <button type="submit" class="btn">Confirm Order</button>
        </form>
    <?php else: ?>
        <p>Your cart is empty. Add some items to your order!</p>
    <?php endif; ?>
</section>

</body>
</html>