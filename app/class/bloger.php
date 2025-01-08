<?php
class Bloger {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function addBlog($name, $tags, $description, $date_creation, $blog_img) {
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

    public function editBlog($id, $name, $tags, $description, $blog_img) {
        $query = "UPDATE blogs SET name = :name, tags = :tags, description = :description, blog_img = :blog_img WHERE id_blog = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':tags', $tags);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':blog_img', $blog_img);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteBlog($id) {
        $query = "DELETE FROM blogs WHERE id_blog = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
?>
