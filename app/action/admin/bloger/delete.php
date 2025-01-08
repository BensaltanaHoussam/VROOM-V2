<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../../../database/Database.php';
require_once '../../../class/bloger.php';

if (isset($_GET['id'])) {
    $database = new Database();
    $db = $database->connect();

    $id = htmlspecialchars($_GET['id']);

    $bloger = new Bloger($db);
    if ($bloger->deleteBlog($id)) {
        header('Location: ../../../../Dashboard/page/bloger.php');
    } else {
        echo "Failed to delete blog.";
    }

    $database->disconnect();
}
?>
