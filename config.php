<?php
// Paramètres de connexion à la base de données
$host = 'localhost';
$dbname = 'solirestaurant'; // Assurez-vous que cela correspond à votre base de données
$username = 'root';
$password = '';

try {
    
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Échec de la connexion : " . $e->getMessage());
}


$typeCuisine = isset($_GET['TypeCuisine']) ? $_GET['TypeCuisine'] : 'ALL';


if ($typeCuisine === 'ALL') {
    $sql = "SELECT * FROM plat";
    $stmt = $pdo->query($sql);
} else {
    $sql = "SELECT * FROM plat WHERE TypeCuisine = :TypeCuisine";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':TypeCuisine', $typeCuisine, PDO::PARAM_STR);
    $stmt->execute();
}


$plats = $stmt->fetchAll(PDO::FETCH_ASSOC);


$platsByCuisine = [];
foreach ($plats as $plat) {
    $platsByCuisine[$plat['categoriePlat']][] = $plat;
}
?>
