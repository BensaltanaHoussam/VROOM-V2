<?php
require_once '../../../database/Database.php';

if (isset($_GET['id'])) {
    $database = new Database();
    $db = $database->connect();

    $id = htmlspecialchars($_GET['id']);

    $query = "DELETE FROM tags WHERE id_tag = :id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        header('Location: ../../../../Dashboard/page/dashboard.php');
    } else {
        echo "Failed to delete tag.";
    }

    $database->disconnect();
} else {
    echo "No ID provided.";
}
?>
