<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../../../database/Database.php';
require_once '../../../class/articles.php';

session_start(); // Ensure the session is started

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_blog_fk = isset($_POST['id_blog']) ? htmlspecialchars($_POST['id_blog']) : null;
    $database = new Database();
    $db = $database->connect();

    $id_article = isset($_POST['id_article']) ? htmlspecialchars($_POST['id_article']) : null;

    if (empty($id_article)) {
        echo "Article ID is required.";
        exit();
    }

    $article = new Articles($db);
    if ($article->deleteArticle($id_article)) {
        header('Location: ../../../../public/articles.php?id='. $id_blog_fk);
    } else {
        echo "Failed to delete article.";
    }

    $database->disconnect();
}
?>
