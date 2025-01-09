<?php
require_once __DIR__ . '/../database/Database.php';

class User {
    private $conn;
    private $table = 'users';

    public $id_user;
    public $fullname;
    public $email;
    public $mot_de_passe;
    public $id_role_fk;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function signup() {
        // Create the user
        $query = "INSERT INTO " . $this->table . " 
                 (fullname, email, mot_de_passe, id_role_fk) 
                 VALUES 
                 (:fullname, :email, :mot_de_passe, :id_role_fk)";

        $stmt = $this->conn->prepare($query);
        // Clean and bind data
        $this->fullname = htmlspecialchars(strip_tags($this->fullname));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->mot_de_passe = htmlspecialchars(strip_tags($this->mot_de_passe));

        $stmt->bindParam(':fullname', $this->fullname);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':mot_de_passe', $this->mot_de_passe);
        $stmt->bindParam(':id_role_fk', $this->id_role_fk);
        $stmt->execute();
    }

    public function login($email, $password) {
        $query = "SELECT u.*, r.role 
                 FROM " . $this->table . " u
                 JOIN roles r ON u.id_role_fk = r.id_role
                 WHERE u.email = :email";

        $stmt = $this->conn->prepare($query);

        $email = htmlspecialchars(strip_tags($email));
        $stmt->bindParam(':email', $email);

        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if (password_verify($password, $row['mot_de_passe'])) {
                // Set object properties
                $this->id_user = $row['id_user'];
                $this->fullname = $row['fullname'];
                $this->email = $row['email'];
                $this->id_role_fk = $row['id_role_fk'];
                return true;
            }
        }

        return false;
    }

    private function emailExists() {
        $query = "SELECT id_user FROM " . $this->table . " WHERE email = :email";
        $stmt = $this->conn->prepare($query);

        $this->email = htmlspecialchars(strip_tags($this->email));
        $stmt->bindParam(':email', $this->email);

        $stmt->execute();

        return $stmt->rowCount() > 0;
    }

    // Keeping your existing static methods
    public static function getAll() {
        $database = new Database();
        $db = $database->connect();
        $sql = "SELECT * FROM users";
        $stmt = $db->query($sql);
        $database->disconnect();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getByEmail($email) {
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