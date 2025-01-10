<?php

require_once "./config/dbconfig.php";
require_once "./models/users.php";
require_once "./models/author.php";
require_once "./models/member.php";
session_start();
$database = new Database();
    $id = $_GET["id_article"];
    $id_author = $_SESSION['id'];
echo $_SESSION['id'];
    $author = new author($database->getConnection(),$id_author);

if(isset($_POST["title"],$_POST["description"], $_POST["content"], $_POST["category_id"]  )){

    $author->modifyArticle(
        $_POST["title"],
        $_POST["category_id"],
        $_POST["description"],
        $_POST["content"],
        $_POST["status"] ?? 0,
        $id
    );
    header("Location: authordash.php?id=" . $author->getId());

    
    // $db = new Database();
    // $admin = new admin($db->getConnection());

    // $name= $_POST["categoryName"] ;
    // $description = $_POST["categoryDescription"] ;

    // $admin->createCategory($name,$description);

}
    $articles = $author->displayArticles();
    $categories = $author->getCategories();

// $database = new Database();
// $id = $_GET["id"];
// $author = new author($database->getConnection(),$id);

// // Handle article creation
// if(isset($_POST["title"], $_POST["category_id"], $_POST["description"], $_POST["content"])) {

//     $author->createArticle(
//         $_POST["title"],
//         $_POST["category_id"],
//         $_POST["description"],
//         $_POST["content"],
//         // $_POST["status"] ?? 0
//     );
// }

// $articles = $author->displayArticles();
// $categories = $author->getCategories();




// var_dump($_POST);
// if(isset($_POST['submit'])) {
// if(isset($_GET["id"])){

//     $categoryId = $_GET["id"];
//     $name = $_POST['name'];
//     $description = $_POST['description'];
// var_dump($_POST);

//     $db = new Database();
//     $admin = new admin($db->getConnection());
//     $result = $admin->modifyCategory($name, $description);
//     header("Location: admindash.php?id=" . $admin->getId());

// }else{
//     echo "<h4>id not recognized</h4>";
// }



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


<br><br><br>


                <!-- Modal body -->
                <div class="p-6 space-y-6">
                    <form method="POST" id="articleForm" class="space-y-4">
                        <input type="hidden" id="articleId" name="articleId">
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                            <input type="text" name="title" id="title" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                        
                        <div>
                        <label for="category_id">Category</label>
                    <select name="category_id" id="category_id" required>
                        <?php foreach($categories as $category): ?>
                            <option value="<?php echo $category['id']; ?>">
                                <?php echo htmlspecialchars($category['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea id="description" name="description" rows="3" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                        </div>

                        <div>
                            <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                            <textarea id="content" name="content" rows="6" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                        </div>

                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                            <select id="status" name="status" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="draft">Draft</option>
                                <option value="pending">Submit for Review</option>
                            </select>
                        </div>
                    
                </div>
                <!-- Modal footer -->
                <div class="flex items-center justify-end p-6 space-x-2 border-t border-gray-200 rounded-b">
                    <button data-modal-hide="articleModal" type="button" 
                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">
                        Cancel
                    </button>
                    <button name="save" type="submit" 
                            class="text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Save Article
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>


