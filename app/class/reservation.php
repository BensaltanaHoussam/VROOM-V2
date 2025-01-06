<?php
class Reservation {
    private $conn;
    private $table = 'reservations';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function addReservation($userId, $vehicleId) {
        $query = 'INSERT INTO ' . $this->table . ' (id_user_fk, id_vehicule_fk) VALUES (:userId, :vehicleId)';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':vehicleId', $vehicleId);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
