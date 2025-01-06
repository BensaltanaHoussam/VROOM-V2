<?php
require_once __DIR__ . '/../database/Database.php';
class User
{
    private $id_user;
    private $fullname;
    private $email;
    private $mot_de_passe;
    private $date_creation;
    private $date_modification;
    private $id_role_fk;

    public function __construct(
       $id_user,
       $fullname,
       $email,
       $mot_de_passe,
       $id_role_fk
       
    ) {
        $this->id_user = $id_user;
        $this->fullname = $fullname;
        $this->email = $email;
        $this->mot_de_passe = $mot_de_passe;
        $this->id_role_fk = $id_role_fk;
    }

    public function create()
    {
        $database = new Database();
        $db = $database->connect();
        $sql = "INSERT INTO users (
            fullname, email, mot_de_passe, id_role_fk
        ) VALUES (?, ?, ?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->execute([
            $this->fullname,
            $this->email,
            $this->mot_de_passe,
            $this->id_role_fk
        ]);
        $database->disconnect();
        return $db->lastInsertId();
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