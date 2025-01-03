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

    public function __construct($db){

        $this->conn = $db;

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



    public function login() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE email = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->email);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        error_log("Stored password hash: " . $row['password']);
        error_log("Input password: " . $this->password);
        
        if($row) {
            $passwordMatch = password_verify($this->password, $row['password']);
            error_log("Password match: " . ($passwordMatch ? 'true' : 'false'));
            
            if($passwordMatch) {
                $this->id = $row['id'];
                $this->firstname = $row['firstname'];
                $this->lastname = $row['lastname'];
                $this->role = $row['role'];
                return true;
            }
        }
        return false;
        error_log("Query: " . $query);
error_log("Email: " . $this->email);
error_log("Row data: " . print_r($row, true));

    }




//  public function check(){



//     if(isset($_POST["submit"])){
    
//         $email = $_POST["email"];
//         $password = $_POST["password"];
    
//         echo "yes sir ";
    
//     }
    
//     else{
//     echo "not working";
//     }

// }
// public function prevent(){

//     if (!isset($_COOKIE['user_logged']) || $_COOKIE['user_logged'] !== 'true') {
//         header("Location: ../login.php");
//         exit();
//     }
    
//     if (!isset($_SESSION['user_type'])) {
//         $database = new Database();
//         $db = $database->getConnection();
        
//         $user = new User($db);
//         $user->matricule = $_COOKIE['matricule'];
//         $userInfo = $user->getUserByMatricule();
//         if ($userInfo) {
//             $_SESSION['user_type'] = $userInfo['post'];
//             $_SESSION['matricule'] = $userInfo['matricule'];
//         } else {
            
//             header("Location: ../login.php");
//             exit();
//         }
//     }
    
    
//     if ($_SESSION['user_type'] === 'administration') {
//         header("Location: index.php");
//         exit();
//     }
// }
    
  

}



?>