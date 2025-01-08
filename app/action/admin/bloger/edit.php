<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../../../database/Database.php';
require_once '../../../class/bloger.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $database = new Database();
    $db = $database->connect();

    $id = htmlspecialchars($_POST['id']);
    $name = htmlspecialchars($_POST['name']);
    $tags = htmlspecialchars($_POST['tags']);
    $description = htmlspecialchars($_POST['description']);
    $blogImgURL = htmlspecialchars($_POST['blog_img']);

    $bloger = new Bloger($db);
    if ($bloger->editBlog($id, $name, $tags, $description, $blogImgURL)) {
        header('Location: ../../../../Dashboard/page/bloger.php');
    } else {
        echo "Failed to edit blog.";
    }

    $database->disconnect();
}
?>
