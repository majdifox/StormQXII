<?php

require_once "users.php";

class member extends users {

public function register(){


    $query = "INSERT INTO " . $this->$table_name . "SET firstname=:firstname, lastname=:lastname, email=:email, password=:password, phone=:phone, role=:role";
    $stmt = $this->conn->prepare($query);


    $this->firstname = htmlspecialchars(strip_tags($this->firstname));
    $this->lastname = htmlspecialchars(strip_tags($this->lastname));
    $this->email = htmlspecialchars(strip_tags($this->email));
    $this->phone = htmlspecialchars(strip_tags($this->phone));
    $this->role = htmlspecialchars(strip_tags($this->role));

    $this->password = password_hash($this->password, PASSWORD_BCRYPT);

    $stmt-> bindParam(":firstname", $this->firstname);
    $stmt-> bindParam(":lastname", $this->lastname);
    $stmt-> bindParam(":email", $this->email);
    $stmt-> bindParam(":password", $this->password);
    $stmt-> bindParam(":phone", $this->phone);
    $stmt-> bindParam(":role", $this->role);

    if($stmt->execute()){

        return true;
    }

    return false;

}

public function articlesfeed(){

    $query = "SELECT id, title, 'description', content, category_id, author_id, created_at FROM articles";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt;


}

public function sortbycategory(){

    $query = "SELECT id, title, 'description', content, category_id, author_id, created_at FROM articles ORDER BY created_at DESC;"; 
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt;
}







}




?>