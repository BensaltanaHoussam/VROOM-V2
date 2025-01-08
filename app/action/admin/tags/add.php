<?php
require_once '../../../database/Database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tagName = htmlspecialchars($_POST['tag_name']);

    $database = new Database();
    $db = $database->connect();

    $query = "INSERT INTO tags (nom_tag) VALUES (:tag_name)";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':tag_name', $tagName);

    if ($stmt->execute()) {
        header('Location: ../../../../Dashboard/page/dashboard.php');
    } else {
        echo "Failed to add tag.";
    }

    $database->disconnect();
}
?>
