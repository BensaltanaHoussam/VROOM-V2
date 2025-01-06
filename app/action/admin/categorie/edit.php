<?php
require_once __DIR__ . '/../../../database/Database.php';
require_once __DIR__ . '/../../../class/categorie.php';

// Initialize database connection
$database = new Database();
$db = $database->connect();

// Initialize Category class
$category = new Category($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? $_POST['id'] : null;
    $name = isset($_POST['name']) ? $_POST['name'] : null;
    $description = isset($_POST['description']) ? $_POST['description'] : null;
    $categorie_img = isset($_POST['categorie_img']) ? $_POST['categorie_img'] : null;

    if ($id && $name && $description && $categorie_img) {
        if ($category->editCategory($id, $name, $description, $categorie_img)) {
            header('Location: ../../../Dashboard/page/categories.php');
            exit();
        } else {
            echo "Error editing category.";
        }
    } else {
        echo "All fields are required.";
    }
}
?>
