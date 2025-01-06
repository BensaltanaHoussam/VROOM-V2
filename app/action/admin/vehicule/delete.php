<?php


require_once __DIR__ . '/../../../database/Database.php';
require_once __DIR__ . '/../../../class/categorie.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? $_POST['id'] : null;

    if ($id) {
        if (Category::delete($id)) {
            header('Location: ../../../Dashboard/page/vehicles.php');
            exit();
        } else {
            echo "Error deleting category.";
        }
    } else {
        echo "Category ID is missing.";
    }
}
?>
