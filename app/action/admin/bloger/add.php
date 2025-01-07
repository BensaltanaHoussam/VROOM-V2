<?php
require_once '../../../database/Database.php'; // Adjust the path as necessary
require_once '../../../class/categorie.php'; // Adjust the path as necessary



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Initialize database connection
    $database = new Database();
    $db = $database->connect();

    // Get form data
    $categoryName = htmlspecialchars($_POST['categoryName']);
    $categoryDesc = htmlspecialchars($_POST['categoryDesc']);
    $categoryImgURL = htmlspecialchars($_POST['categorie_img']); // URL of the category image

    // Save the category with the provided image URL
    $blogs = new bloger($db);
    if ($category->addCategory($categoryName, $categoryDesc, $categoryImgURL)) {
        echo "Category added successfully!";
    } else {
        echo "Failed to add category.";
    }

    // Disconnect from the database
    $database->disconnect();
}
?>
