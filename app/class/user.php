<?php
require_once __DIR__ . '/../database/Database.php';
class User
{
    private $conn;
    private $table = 'users';

    public $id;
    public $username;
    public $password;
    public $email;
    public $id_role_fk;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        // Check if the role exists
        $roleQuery = "SELECT id_role FROM roles WHERE id_role = :id_role_fk";
        $roleStmt = $this->conn->prepare($roleQuery);
        $roleStmt->bindParam(':id_role_fk', $this->id_role_fk);
        $roleStmt->execute();

        if ($roleStmt->rowCount() == 0) {
            // Insert the role if it doesn't exist
            $insertRoleQuery = "INSERT INTO roles (id_role) VALUES (:id_role_fk)";
            $insertRoleStmt = $this->conn->prepare($insertRoleQuery);
            $insertRoleStmt->bindParam(':id_role_fk', $this->id_role_fk);
            $insertRoleStmt->execute();
        }

        // Insert the user
        $query = "INSERT INTO " . $this->table . " (username, password, email, id_role_fk) VALUES (:username, :password, :email, :id_role_fk)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':id_role_fk', $this->id_role_fk);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public static function getAll()
    {
        $database = new Database();
        $db = $database->connect();
        $sql = "SELECT * FROM users";
        $stmt = $db->query($sql);
        $database->disconnect();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getByEmail($email)
    {
        $database = new Database();
        $db = $database->connect();
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$email]);
        $database->disconnect();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>