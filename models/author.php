<?php

require_once "users.php";
require_once "member.php";


class author extends member{

    private $articles = "articles";

    private $title;
    private $status;
    private $description;
    private $content;
    private $category_id;
    private $author_id;
    private $created_at;
    private $updated_at;
    private $publication_date;





public function createArticle(){

    $query = "INSERT INTO ". $this->$articles . "SET title=:title, status=:status, description=:description, content=:content, category_id=:category_id, author_id=:author_id, created_at=:created_at, updated_at=:updated_at, publication_date=:publication_date ";
    $stmt= $this->conn->prepare($query);

    $this->$title = htmlspecialchars(strip_tags($this->title));
    $this->$title = htmlspecialchars(strip_tags($this->$status));
    $this->$description = htmlspecialchars(strip_tags($this->$description));
    $this->$content = htmlspecialchars(strip_tags($this->$content));
    $this->$category_id = htmlspecialchars(strip_tags($this->category_id));
    $this->$author_id = htmlspecialchars(strip_tags($this->$author_id));
    $this->$created_at= htmlspecialchars(strip_tags($this->$created_at));
    $this->$updated_at= htmlspecialchars(strip_tags($this->$updated_at));

    $stmt = bindParam(":title", $this->title);
    $stmt = bindParam(":status", $this->status);
    $stmt = bindParam(":description", $this->description);
    $stmt = bindParam(":content", $this->content);
    $stmt = bindParam(":category_at", $this->category_at);
    $stmt = bindParam(":updated_at", $this->updated_at);
    $stmt = bindParam(":publication_date", $this->publication_date);

    if($stmt->execute){
        return true;
    }
    
        return false;
    
    
}







public function modifyArticle(){

    $query = "UPDATE articles SET title=:title, status=:status, description=:description, content=:content, category_id=:category_id, author_id=:author_id, created_at=:created_at, updated_at=:updated_at, publication_date=:publication_date ";
    $stmt = $this->conn->prepare($query);
   
    $stmt = bindParam(":title", $this->title);
    $stmt = bindParam(":status", $this->status);
    $stmt = bindParam(":description", $this->description);
    $stmt = bindParam(":content", $this->content);
    $stmt = bindParam(":category_at", $this->category_at);
    $stmt = bindParam(":updated_at", $this->updated_at);
    $stmt = bindParam(":publication_date", $this->publication_date);

    $stmt->execute();
    return $stmt;
}


public function deleteArticle(){

    $query = "DELETE "
}

}  


?>