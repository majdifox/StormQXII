<?php

if(isset($_POST["submit"])){

    // grabbing the data from the registration form
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $email = $_POST["email"];
    $role = $_POST["role"];

    if ($user->login()) {
        $message = "Compte créé avec succès. Votre matricule est : " . $user->email;
    } else {
        $message = "Une erreur est survenue lors de la création du compte.";
    }

    echo "yes sir ";

}

else{
    echo "no sir";
}


// if ($_SERVER['REQUEST_METHOD'] == "POST"){

//     echo "okay";
// }


//     else{

//         echo "no";
//     }


?>
