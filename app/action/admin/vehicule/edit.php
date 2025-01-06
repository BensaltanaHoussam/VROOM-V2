<?php
require_once __DIR__ . '/../../../database/Database.php';
require_once __DIR__ . '/../../../class/vehicule.php';

// Initialize database connection
$database = new Database();
$db = $database->connect();

// Initialize Vehicule class
$vehicule = new Vehicule($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? $_POST['id'] : null;
    $name = isset($_POST['nom_vehicule']) ? $_POST['nom_vehicule'] : null;
    $description = isset($_POST['description']) ? $_POST['description'] : null;
    $fuelEconomy = isset($_POST['fuel_economy']) ? $_POST['fuel_economy'] : null;
    $price = isset($_POST['price']) ? $_POST['price'] : null;
    $features = isset($_POST['features']) ? $_POST['features'] : null;
    $vehicleImage = isset($_POST['vehicule_image']) ? $_POST['vehicule_image'] : null;
    $categoryId = isset($_POST['category_id']) ? $_POST['category_id'] : null;

    if ($id && $name && $description && $fuelEconomy && $price && $vehicleImage && $categoryId) {
        if ($vehicule->editVehicule($id, $name, $description, $fuelEconomy, $price, $features, $vehicleImage, $categoryId)) {
            header('Location: ../../../Dashboard/page/vehicles.php?category_id=' . $categoryId);
            exit();
        } else {
            echo "Error editing vehicle.";
        }
    } else {
        echo "All fields are required.";
    }
}
?>
