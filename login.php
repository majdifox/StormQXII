<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection debug
try {
    require_once "./config/dbconfig.php";
    require_once "./models/users.php";
    require_once "./models/member.php";
    
    $database = new Database();
    $db = $database->getConnection();
    echo "DB Connection OK\n";
} catch (Exception $e) {
    die("Error loading required files or DB connection: " . $e->getMessage());
}

if(isset($_POST['submit'])) {
    try {
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        $user = new users($db);
        $user->setEmail($email);
        $user->setPassword($password);
        
        // Single login attempt
        $role = $user->login($email, $password);
        
        if($role) {
            setcookie("user_logged", "true", time() + (86400 * 30), "/");
            
            // Redirect based on role
            switch($role) {
                case 'author':
                    header("Location: authordash.php?id=" . $_SESSION['user_id']);
                    break;
                case 'member':
                    header("Location: pages/index.php?id=" . $_SESSION['user_id']);
                    break;
                case 'admin':
                    header("Location: admindash.php?id=" . $_SESSION['user_id']);
                    break;
                default:
                    throw new Exception("Invalid role");
            }
            exit();
        } else {
            $error = "Invalid credentials";
        }
    } catch (Exception $e) {
        echo "Login process error: " . $e->getMessage();
    }






    if($user->login($email, $password)) {
        echo "hhhh";
        $_SESSION['id'] = $user->getId();
        $_SESSION['role'] = $user->getRole();
        $_SESSION['firstname'] = $user->getFirstname();
        $_SESSION['lastname'] = $user->getLastname();
        setcookie("user_logged", "true", time() + (86400 * 30), "/");
        if ($user->getRole() == 'author') {
            header("Location: authordash.php?id=" . $user->getId());
        } elseif($user->getRole() == 'member') {
            header("Location: pages/index.php?id=" . $user->getId());
        }
        else{
            header("Location: admindash.php?id=" . $user->getId());
        }
        exit();
    } else {
        $error = "Identifiants invalides";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StormQ - Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="max-w-md w-full space-y-8 p-8 bg-white rounded-lg shadow-lg">
            <div>
                <h1 class="text-4xl font-bold text-center text-indigo-600">StormQ</h1>
                <h2 class="mt-6 text-center text-2xl font-semibold text-gray-900">Sign in to your account</h2>
            </div>


            
            <form action="login.php" method="post" class="mt-8 space-y-6">
                <div class="rounded-md shadow-sm space-y-4">
                    <div>
                        <label for="email" class="sr-only">Email address</label>
                        <input id="email" name="email" type="email" required 
                            class="appearance-none rounded-lg relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10"
                            placeholder="Email address">
                    </div>
                    <div>
                        <label for="password" class="sr-only">Password</label>
                        <input id="password" name="password" type="password" required 
                            class="appearance-none rounded-lg relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10"
                            placeholder="Password">
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember-me" name="remember-me" type="checkbox" 
                            class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="remember-me" class="ml-2 block text-sm text-gray-900">Remember me</label>
                    </div>
                    <div class="text-sm">
                        <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">Forgot password?</a>
                    </div>
                </div>

                <div>
                    <button type="submit" name="submit"
                        class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Sign in
                    </button>
                </div>
            </form>
            <div class="text-center">
                <p class="text-sm text-gray-600">Don't have an account? 
                    <a href="register.php" class="font-medium text-indigo-600 hover:text-indigo-500">Sign up</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>