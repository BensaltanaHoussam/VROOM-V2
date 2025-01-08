<?php
require_once '../../../database/Database.php';
require_once '../../../class/bloger.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $database = new Database();
    $db = $database->connect();

    $name = htmlspecialchars($_POST['name']);
    $tags = htmlspecialchars($_POST['tags']);
    $description = htmlspecialchars($_POST['description']);
    $blogImgURL = htmlspecialchars($_POST['blog_img']);
    $date_creation = date('Y-m-d H:i:s'); // Current timestamp

    $bloger = new Bloger($db);
    if ($bloger->addBlog($name, $tags, $description, $date_creation, $blogImgURL)) {
        header('Location: ../../../../Dashboard/page/bloger.php');
    } else {
        echo "Failed to add blog.";
    }

    $database->disconnect();
}
?>
