<?php

require_once "users.php";

class admin extends users{
    private $categories = "categories";

    private $name;
    private $description;
    private $created_at;
    private $updated_at;
    private $created_by;


    public function createCategory(){

        $query = "INSERT INTO " .$this->$categories . "SET name=:name, description=:description, created_at=:created_at, updated_at=:updated_at, created_at=:created_at";
        $stmt = $this->conn->prepare($query);
        $stmt = bindParam(":name",$name);
        $stmt = bindParam(":description",$description);
        $stmt = bindParam(":created_at",$created_at);
        $stmt = bindParam(":updated_at",$updated_at);
        $stmt = bindParam(":created_by",$created_by);

        $stmt->execute();

        return $stmt;

    }

    public function modifyCategory(){

        $query = "UPDATE categories SET name=:name, description=:description, created_at=:created_at, updated_at=:updated_at, created_at=:created_at";
        $stmt = $this->conn->prepare($query);
        $stmt = bindParam(":name",$name);
        $stmt = bindParam(":description",$description);
        $stmt = bindParam(":created_at",$created_at);
        $stmt = bindParam(":updated_at",$updated_at);
        $stmt = bindParam(":created_by",$created_by);

        $stmt->execute();

        return $stmt;

    }

    public function deleteCategory(){


    }



}


?>