<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../../../database/Database.php';
require_once '../../../class/articles.php';

session_start(); // Ensure the session is started

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $database = new Database();
    $db = $database->connect();

    $id_article = isset($_POST['id_article']) ? htmlspecialchars($_POST['id_article']) : null;
    $statut = isset($_POST['statut']) ? htmlspecialchars($_POST['statut']) : null;

    if (empty($id_article) || empty($statut)) {
        echo "Article ID and status are required.";
        exit();
    }

    $article = new Articles($db);
    if ($article->updateStatus($id_article, $statut)) {
        header('Location: ../../../../Dashboard/page/dashboard.php');
    } else {
        echo "Failed to update article status.";
    }

    $database->disconnect();
}
?>
