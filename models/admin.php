<?php

require_once "users.php";

class admin extends users{
    private $categories = "categories";

    private $name;
    private $description;
    private $created_at;
    private $updated_at;
    private $created_by;

    public function __construct($db){

        parent::__construct($db);

    }

    public function createCategory($name,$description){
        $created_at = date("Y-m-d");
        $updated_at = date("Y-m-d");
        $created_by = isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : NULL;

        $query = "INSERT INTO categories SET  name=:name, description=:description, created_at=:created_at, updated_at=:updated_at, created_by=:created_by";
        $stmt = $this->conn->prepare($query);
        // $stmt->bindParam(":id",$id);
        $stmt->bindParam(":name",$name);
        $stmt->bindParam(":description",$description);
        $stmt->bindParam(":created_at",$created_at);
        $stmt->bindParam(":updated_at",$updated_at);
        $stmt->bindParam(":created_by",$created_by);

        $stmt->execute();

        return $stmt;

    }       

    public function modifyCategory($name, $description){
        $updated_at = date("Y-m-d");
        $created_by = isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : NULL;
        $query = "UPDATE categories SET name=:name, description=:description,  updated_at=:updated_at, created_by=:created_by where id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":name",$name);
        $stmt->bindParam(":description",$description);
        $stmt->bindParam(":updated_at",$updated_at);
        $stmt->bindParam(":created_by",$created_by);
        $stmt->bindParam(":id", $_GET['id']);

        $stmt->execute();

        return $stmt;

    }

    public function deleteCategory($id){

        $query = "DELETE  FROM categories where id = :id ";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id",$id);

        $stmt->execute();



    }


    public function displayCategory(){

        $query = "SELECT * FROM categories";
        $stmt = $this->conn->query($query);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    public function validateArticle($id, $isApproved){

        if($isApproved){
            $validationStatus = 'confirme';

        }
        else{
            $validationStatus = 'non confirme';
        }

        $query = "UPDATE articles SET validation_admin = :validationStatus WHERE id= :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":validationStatus",$validationStatus);
        $stmt->bindParam(":id",$id);

        $stmt->execute();

        return $stmt;
        

    }

    public function displayArticles() {
        $query = "SELECT * , a.id as article_id 
                 FROM articles a 
                 LEFT JOIN categories c ON a.category_id = c.id 
                 LEFT JOIN users u ON a.author_id = u.id  where validation_admin = 'non confirme'
                 ORDER BY a.created_at DESC";
        
        $stmt = $this->conn->query($query);
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function displayArticlesforMembers() {
        $query = "SELECT * , a.id as article_id 
                 FROM articles a 
                 LEFT JOIN categories c ON a.category_id = c.id 
                 LEFT JOIN users u ON a.author_id = u.id  where validation_admin = 'confirme'
                 ORDER BY a.created_at DESC";
        
        $stmt = $this->conn->query($query);
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function confirmArticle($id){
        echo 'mcha liha';
        $validation_admin = "confirme";
        $query = "UPDATE articles SET  validation_admin = :validation_admin where id = :id ";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id",$id);
        $stmt->bindParam(":validation_admin",$validation_admin);
        echo 'mcha liha';

        $stmt->execute();
        echo 'mcha liha';

    }

    public function rejectArticle($id){
        echo 'mcha liha';
        $query = "DELETE  FROM articles where id = :id ";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id",$id);
        echo 'mcha liha';

        $stmt->execute();
        echo 'mcha liha';

        


    }
}
    

?>