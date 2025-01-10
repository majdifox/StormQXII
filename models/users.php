<?php

class users{

    protected $conn;
    protected $table_name ="users" ; 

    protected $id;
    protected $firstname;
    protected $lastname;
    protected $email;
    protected $password;
    protected $phone;
    protected $role;
    protected $picture;

    public function __construct($db){

        $this->conn = $db;

    }

    public function gettable(){
        return $this->table_name;
    }

    public function settable($table_name){
        $this->table_name = $table_name;
    }

    public function getId(){
        return $this->id;
    }
    
    public function setId($id){

        $this->id = $id;
    }



    public function getFirstname(){
        return $this->firstname;
    }
    
    public function setFirstname($firstname){

        $this->firstname = $firstname;
    }



    public function getLastname(){
        return $this->lastname;
    }
    
    public function setLastname($lastname){

        $this->lastname = $lastname;
    }



    public function getEmail(){
        return $this->email;
    }
    
    public function setEmail($email){

        $this->email = $email;
    }



    public function getPassword(){
        return $this->password;
    }
    
    public function setPassword($password){

        $this->password = $password;
    }



    public function getPhone(){
        return $this->phone;
    }
    
    public function setPhone($phone){

        $this->phone = $phone;
    }



    public function getRole(){
        return $this->role;
    }
    
    public function setRole($role){

        $this->role = $role;
    }

    public function getpicture(){
        return $this->picture;
    }

    public function setpicture($picture){
        $this-> picture = $picture;
    }


//     public function login() {
//         $query = "SELECT * FROM " . $this->table_name . " WHERE email = ? LIMIT 0,1";
//         $stmt = $this->conn->prepare($query);
//         $stmt->bindParam(1, $this->email);
//         $stmt->execute();
//         $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
//         error_log("Stored password hash: " . $row['password']);
//         error_log("Input password: " . $this->password);
        
//         if($row) {
//             $passwordMatch = password_verify($this->password, $row['password']);
//             error_log("Password match: " . ($passwordMatch ? 'true' : 'false'));
            
//             if($passwordMatch) {
//                 $this->id = $row['id'];
//                 $this->firstname = $row['firstname'];
//                 $this->lastname = $row['lastname'];
//                 $this->role = $row['role'];
//                 return true;
//             }
//         }
//         return false;


//         error_log("Query: " . $query);
// error_log("Email: " . $this->email);
// error_log("Row data: " . print_r($row, true));

//     }    
public function login($email, $password) {
    try {
        $query = "SELECT id, email, password, role FROM users WHERE email = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user && password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_role'] = $user['role'];
            
            // Send email notification
            require_once __DIR__ . '/EmailNotification.php';
            $emailNotifier = new EmailNotification($this->conn);
            $emailNotifier->sendLoginNotification($user['id']);
            
            return $user['role'];
        }
        return false;
    } catch (PDOException $e) {
        error_log("Login error: " . $e->getMessage());
        return false;
    }
}

}



?>