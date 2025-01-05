<?php
require_once "./models/admin.php";
require_once "./config/dbconfig.php";



if(isset($_GET["id"])){

    $categoryId = $_GET["id"];
    $name = $_POST['categoryName'];
    $description = $_POST['categoryDescription'];
    $db = new Database();
    $admin = new admin($db->getConnection());
    $result = $admin->modifyCategory($name, $description);
    header("Location: admindash.php?id=" . $admin->getId());

}else{
    echo "<h4>id not recognized</h4>";
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
</head>
<body>
<form method = "post">
<div class="p-6 space-y-6">
    <div>
        <label class="block mb-2 text-sm font-medium text-gray-900">Edit Category Name</label>
        <input type="text" name="categoryName" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
    </div>
    <div>
        <label class="block mb-2 text-sm font-medium text-gray-900">Edit Description</label>
        <textarea name="categoryDescription" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" rows="4"></textarea>
    </div>
</div>
<div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b">
    <button type="submit" class="text-white bg-indigo-600 hover:bg-indigo-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Edit Category</button>
    <button type="button" class="text-gray-500 bg-white hover:bg-gray-100 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5" data-modal-hide="categoryModal">Cancel</button>
</div>
</form>
</body>
</html>


