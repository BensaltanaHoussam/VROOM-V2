    <?php
class articles {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function addArticle($id_blog_fk,$id_user_fk,$titre, $contenu, $image, $videos, $article_tag, $g_img1, $g_img2, $g_img3) {
        // Adjusting the query to include placeholders for all 9 values (including statut)
        $query = "INSERT INTO articles (id_blog_fk,id_user_fk,titre, contenu, images, videos, article_tag, g_img1, g_img2, g_img3) 
                  VALUES (?,?, ?, ?, ?, ?, ?, ?, ?,?)";
        
        // Prepare and execute the statement
        $stmt = $this->conn->prepare($query);
        
        // Execute the statement with all 9 values
        if ($stmt->execute([$id_blog_fk,$id_user_fk,$titre, $contenu, $image, $videos, $article_tag, $g_img1, $g_img2, $g_img3])) {
            return true;
        } else {
            return false;
        }
    }


    public function deleteArticle($id) {
        $query = "DELETE FROM articles WHERE id_article = :id";
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
