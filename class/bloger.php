<?php
class Bloger {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function addblog($name, $tags, $description, $date_creation, $blog_img) {
        $query = "INSERT INTO blogs (name, tags, description, date_creation, blog_img) VALUES (:name, :tags, :description, :date_creation, :blog_img)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':tags', $tags);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':date_creation', $date_creation);
        $stmt->bindParam(':blog_img', $blog_img);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
?>
