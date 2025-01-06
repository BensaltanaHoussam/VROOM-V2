<?php
require_once __DIR__ . '/../database/Database.php'; // Adjust the path as necessary

class Category {
    private $conn; 

    public function __construct($db) {
        $this->conn = $db;
    }

    public function addCategory($name, $description, $categorie_img) {
        $query = "INSERT INTO categories (nom, description, categorie_img) VALUES (:name, :description, :categorie_img)";
        $stmt = $this->conn->prepare($query);

        // Bind parameters to protect against SQL injection
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':categorie_img', $categorie_img);

        if ($stmt->execute()) {
            return true; // Success
        }
        return false; // Failure
    }

    public function getAllCategories() {
        $query = "SELECT * FROM categories";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function delete($id) {
        $database = new Database();
        $db = $database->connect();
        $sql = "DELETE FROM categories WHERE id_categorie = ?";
        $stmt = $db->prepare($sql);
        $result = $stmt->execute([$id]);
        $database->disconnect();
        return $result;
    }

    public function editCategory($id, $name, $description, $categorie_img) {
        $query = "UPDATE categories SET nom = :name, description = :description, categorie_img = :categorie_img WHERE id_categorie = :id";
        $stmt = $this->conn->prepare($query);

        // Bind parameters to protect against SQL injection
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':categorie_img', $categorie_img);

        if ($stmt->execute()) {
            return true; // Success
        }
        return false; // Failure
    }

    public function getVehiclesByCategory($categoryId) {
        $query = "SELECT * FROM vehicules WHERE id_categorie_fk = :category_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':category_id', $categoryId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
