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

    $id_blog_fk = isset($_POST['id_blog_fk']) ? htmlspecialchars($_POST['id_blog_fk']) : null;
    $id_user_fk = isset($_POST['id_user_fk']) ? htmlspecialchars($_POST['id_user_fk']) : null;
    $titre = htmlspecialchars($_POST['titre']);
    $contenu = htmlspecialchars($_POST['contenu']);
    $images = htmlspecialchars($_POST['images']);
    $videos = htmlspecialchars($_POST['videos']);
    $article_tag = htmlspecialchars($_POST['article_tag']);
    $g_img1 = htmlspecialchars($_POST['g_img1']);
    $g_img2 = htmlspecialchars($_POST['g_img2']);
    $g_img3 = htmlspecialchars($_POST['g_img3']);

    if ($id_blog_fk === null || $id_user_fk === null) {
        echo "Blog ID and User ID are required.";
        exit();
    }

    // Ensure the foreign key values exist
    $userQuery = "SELECT id_user FROM users WHERE id_user = :id_user_fk";
    $userStmt = $db->prepare($userQuery);
    $userStmt->bindParam(':id_user_fk', $id_user_fk);
    $userStmt->execute();

    if ($userStmt->rowCount() == 0) {
        echo "User ID does not exist.";
        exit();
    }

    $article = new Articles($db);
    if ($article->addArticle($id_blog_fk, $id_user_fk, $titre, $contenu, $images, $videos, $article_tag, $g_img1, $g_img2, $g_img3)) {
        header('Location: ../../../../../public/page/articles.php');
    } else {
        echo "Failed to add article.";
    }

    $database->disconnect();
}
?>
