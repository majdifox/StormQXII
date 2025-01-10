<?php
require_once "users.php";
require_once "member.php";

class author extends member {
    protected $id;
    protected $table = "articles";

    public function __construct($db, $id = null) {
        parent::__construct($db);
            $this->id = $id;        
        
    
    }

    public function createArticle($title, $category_id, $description, $content, $status) {
        $query = "INSERT INTO " . $this->table . " 
                 (title, category_id, description, content, status, author_id, created_at) 
                 VALUES (:title, :category_id, :description, :content, :status, :author_id, NOW())";
        
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":category_id", $category_id);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":content", $content);
        $stmt->bindParam(":status", $status);
        $stmt->bindParam(":author_id", $this->id);
        
        return $stmt->execute();
    }

    public function modifyArticle($title, $category_id, $description,  $content, $status,$id_article){
        // $updated_at = date("Y-m-d");
        $created_by = isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : NULL;

        $query = "UPDATE articles SET title = :title, category_id = :category_id, description = :description , content = :content , status = :status
                  where id = :id_article";

   

// $query = "UPDATE  " . $this->table . " SET
// (title, category_id, description, content, status, author_id, created_at) 
// VALUES (:title, :category_id, :description, :content, :status, :author_id" where id = :id ;

        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":category_id", $category_id);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":content", $content);
        $stmt->bindParam(":status", $status);
        $stmt->bindParam(":id_article", $id_article);
        $stmt->execute();

        return $stmt->execute();

    }

    public function displayArticles() {
        $query = "SELECT a.*, c.name as category_name, u.firstname, u.lastname, 
                        DATE_FORMAT(a.created_at, '%M %d, %Y') as formatted_date 
                 FROM " . $this->table . " a 
                 LEFT JOIN categories c ON a.category_id = c.id 
                 LEFT JOIN users u ON a.author_id = u.id  
                 WHERE u.id=:id
                 ORDER BY a.created_at DESC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam("id",$this->id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCategories() {
        $query = "SELECT id, name FROM categories ORDER BY name";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteArticle($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}
?>