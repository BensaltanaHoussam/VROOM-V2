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

    if ($categoryId) {
        $vehicles = $category->getVehiclesByCategory($categoryId);
        echo json_encode($vehicles);
    } else {
        echo json_encode([]);
    }
}
?>
