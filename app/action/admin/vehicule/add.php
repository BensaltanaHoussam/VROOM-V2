<?php
require_once __DIR__ . '/../../../database/Database.php';
require_once __DIR__ . '/../../../class/categorie.php';

// Initialize database connection
$database = new Database();
$db = $database->connect();

// Initialize Category class
$category = new Category($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $categoryId = isset($_POST['category_id']) ? $_POST['category_id'] : null;
    $name = isset($_POST['nom_vehicule']) ? $_POST['nom_vehicule'] : null;
    $description = isset($_POST['description']) ? $_POST['description'] : null;
    $fuelEconomy = isset($_POST['fuel_economy']) ? $_POST['fuel_economy'] : null;
    $price = isset($_POST['price']) ? $_POST['price'] : null;
    $features = isset($_POST['features']) ? $_POST['features'] : null;
    $vehicleImage = isset($_POST['vehicule_image']) ? $_POST['vehicule_image'] : null;

    if ($categoryId && $name && $description && $fuelEconomy && $price && $vehicleImage) {
        $query = "INSERT INTO vehicules (nom_vehicule, description, fuel_economy, price, features, vehicule_image, id_categorie_fk) VALUES (:name, :description, :fuelEconomy, :price, :features, :vehicleImage, :categoryId)";
        $stmt = $db->prepare($query);

        // Bind parameters to protect against SQL injection
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':fuelEconomy', $fuelEconomy);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':features', $features);
        $stmt->bindParam(':vehicleImage', $vehicleImage);
        $stmt->bindParam(':categoryId', $categoryId);

        if ($stmt->execute()) {
            header('Location: ../../../Dashboard/page/vehicles.php?category_id=' . $categoryId);
            exit();
        } else {
            echo "Error adding vehicle.";
        }
    } else {
        echo "All fields are required.";
    }
}
?>
