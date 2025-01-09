<?php
require_once "./config/dbconfig.php";
require_once "./models/users.php";
require_once "./models/member.php";

$database = new Database();
$db = $database->getConnection();

$newuser = null; // Initialize the variable

if (isset($_POST['submit'])) {
    try {
        // Get input fields
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $phone = $_POST['phone'];
        $role = $_POST['role'];

        // File upload handling
        $targetDir = "uploads/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true); // Create directory if it doesn't exist
        }

        if (isset($_FILES['picture']) && $_FILES['picture']['error'] === UPLOAD_ERR_OK) {
            $fileName = basename($_FILES["picture"]["name"]);
            $targetFilePath = $targetDir . $fileName;

            // Validate file type
            $allowedTypes = ['jpg', 'jpeg', 'png'];
            $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

            if (!in_array($fileType, $allowedTypes)) {
                throw new Exception("Only JPG, JPEG, and PNG files are allowed.");
            }

            // Move the file to the server
            if (!move_uploaded_file($_FILES["picture"]["tmp_name"], $targetFilePath)) {
                throw new Exception("Failed to upload the picture.");
            }

            // Save the file path
            $picture = $targetFilePath;
        } else {
            throw new Exception("Picture upload is required.");
        }

        // Create a new member
        $newuser = new Member($db);
        $newuser->setFirstname($firstname);
        $newuser->setLastname($lastname);
        $newuser->setEmail($email);
        $newuser->setPassword($password);
        $newuser->setRole($role);
        $newuser->setPhone($phone);
        $newuser->setPicture($picture);

        // Register the user
        if ($newuser->register()) {
            // Set session variables
            session_start();
            $_SESSION['id'] = $newuser->getId();
            $_SESSION['role'] = $newuser->getRole();
            $_SESSION['firstname'] = $newuser->getFirstname();
            $_SESSION['lastname'] = $newuser->getLastname();
            $_SESSION['email'] = $newuser->getEmail();
            $_SESSION['password'] = $newuser->getPassword();
            $_SESSION['phone'] = $newuser->getPhone();
            $_SESSION['picture'] = $newuser->getPicture();

            setcookie("user_logged", "true", time() + (86400 * 30), "/");

            // Redirect based on role
            if ($newuser->getRole() == 'author') {
                header("Location: create.php?id=" . $newuser->getId());
            } elseif ($newuser->getRole() == 'member') {
                header("Location: index.php?id=" . $newuser->getId());
            }
            exit();
        } else {
            $error = "Registration failed.";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StormQ - Sign Up</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 p-8 bg-white rounded-lg shadow-lg">
            <div>
                <h1 class="text-4xl font-bold text-center text-indigo-600">StormQ</h1>
                <h2 class="mt-6 text-center text-2xl font-semibold text-gray-900">Create your account</h2>
            </div>
            <!-- ="../includes/register.inc.php" -->

            <form action="" method="post" class="mt-8 space-y-6" enctype="multipart/form-data">
                <div class="rounded-md shadow-sm space-y-4">
                    <div>
                        <label for="firstName" class="sr-only">First Name</label>
                        <input id="firstName" name="firstname" type="text" required 
                            class="appearance-none rounded-lg relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="First Name">
                    </div>
                    <div>
                        <label for="lastName" class="sr-only">Last Name</label>
                        <input id="lastName" name="lastname" type="text" required 
                            class="appearance-none rounded-lg relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="Last Name">
                    </div>
                    <div>
                        <label for="email" class="sr-only">Email address</label>
                        <input id="email" name="email" type="email" required 
                            class="appearance-none rounded-lg relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="Email address">
                    </div>
                    <div>
                        <label for="password" class="sr-only">Password</label>
                        <input id="password" name="password" type="password" required 
                            class="appearance-none rounded-lg relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="Password">
                    </div>
                    <div>
                        <label for="phone" class="sr-only">phone</label>
                        <input id="phone" name="phone" type="text" required 
                            class="appearance-none rounded-lg relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="Phone Number">
                    </div>
                    <div>
                        <label for="role" class="block text-sm font-medium text-gray-700">Select Role</label>
                        <select id="role" name="role" required 
                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 rounded-lg">
                            <option value="member">Member</option>
                            <option value="author">Author</option>
                        </select>
                    </div>   
                    <div>
                    <label for="picture">Upload Picture:</label>
                    <input type="file" name="picture" accept="image/*" required><br>
                    </div>
                </div>

                <div>
                    <button type="submit" name="submit"
                        class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Sign up
                    </button>
                </div>
            </form>
            <div class="text-center">
                <p class="text-sm text-gray-600">Already have an account? 
                    <a href="login.php" class="font-medium text-indigo-600 hover:text-indigo-500">Sign in</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>