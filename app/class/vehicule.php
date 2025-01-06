<?php
require_once __DIR__ . '/../database/Database.php'; // Adjust the path as necessary

class Vehicule {
    private $conn; 
    private $table = 'vehicules';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function addVehicule($name, $description, $fuelEconomy, $price, $features, $vehicleImage, $categoryId) {
        $query = "INSERT INTO vehicules (nom_vehicule, description, fuel_economy, price, features, vehicule_image, id_categorie_fk) VALUES (:name, :description, :fuelEconomy, :price, :features, :vehicleImage, :categoryId)";
        $stmt = $this->conn->prepare($query);

        // Bind parameters to protect against SQL injection
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':fuelEconomy', $fuelEconomy);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':features', $features);
        $stmt->bindParam(':vehicleImage', $vehicleImage);
        $stmt->bindParam(':categoryId', $categoryId);

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

    public function getAllVehicles() {
        $query = "SELECT * FROM vehicules";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function editVehicule($id, $name, $description, $fuelEconomy, $price, $features, $vehicleImage, $categoryId) {
        $query = "UPDATE vehicules SET nom_vehicule = :name, description = :description, fuel_economy = :fuelEconomy, price = :price, features = :features, vehicule_image = :vehicleImage, id_categorie_fk = :categoryId WHERE id_vehicule = :id";
        $stmt = $this->conn->prepare($query);

        // Bind parameters to protect against SQL injection
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':fuelEconomy', $fuelEconomy);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':features', $features);
        $stmt->bindParam(':vehicleImage', $vehicleImage);
        $stmt->bindParam(':categoryId', $categoryId);

        if ($stmt->execute()) {
            return true; // Success
        }
        return false; // Failure
    }

    public function deleteVehicule($id) {
        $query = "DELETE FROM vehicules WHERE id_vehicule = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            return true; // Success
        }
        return false; // Failure
    }

    public function getVehicleById($id) {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE id_vehicule = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
