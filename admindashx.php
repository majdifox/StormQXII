<?php
require_once "./models/admin.php";
require_once "./config/dbconfig.php";

if(isset($_POST["categoryName"],$_POST["categoryDescription"])){

    $db = new Database();
    $admin = new admin($db->getConnection());

    $name= $_POST["categoryName"] ;
    $description = $_POST["categoryDescription"] ;

    $admin->createCategory($name,$description);

}

    $db = new Database();
    $admin = new admin($db->getConnection());

    $display = $admin->displayCategory();
    var_dump($display);

    if(isset($_POST["deleteCategory"])){

        $db = new Database();
        $id =$_POST["deleteCategory"];
        
        $admin = new admin($db->getConnection());
        $result = $admin->deleteCategory($id);
        header("Location: admindash.php?id=" . $admin->getId());
        

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StormQ - Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
</head>
<body class="bg-gray-100">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <h1 class="text-2xl font-bold text-indigo-600">StormQ</h1>
                    </div>
                </div>
                <div class="flex items-center">
                    <span class="text-gray-700 px-3">Welcome, Admin</span>
                    <button class="text-gray-500 hover:text-gray-700">Logout</button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
            <!-- Actions Buttons -->
            <div class="mb-6 space-x-4">
                <button data-modal-target="categoryModal" data-modal-toggle="categoryModal" 
                        class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                    Create Category
                </button>
                <button data-modal-target="validationModal" data-modal-toggle="validationModal"
                        class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                    Article Validation
                </button>
            </div>

            <!-- Dashboard Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Categories Section -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-xl font-semibold mb-4">Categories</h2>
                    <div class="space-y-4">
                       <?php
                       foreach($display as $category){


                       
                       ?><!-- Category Card -->
                        <div class="border rounded-lg p-4">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-lg font-medium"><?=$category["name"]?></h3>
                                    <p class="text-gray-600 mt-1"><?=$category["description"]?></p>
                                </div>
                                <div class="flex space-x-2">
                                    
                                    <a href="categoryedit.php?id=<?=$category["id"]?>" class="text-blue-600 hover:text-blue-800">Edit</a>
                                    <form action="" method="POST">
                                    <button type="submit" name="deleteCategory" value="<?=$category["id"]?>" class="text-red-600 hover:text-red-800">Delete</button>
                                    </form>
                                    
                                </div>
                            </div>
                        </div>
                        <?php
}
                        ?>
                    </div>
                </div>

                <!-- Pending Articles Section -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-xl font-semibold mb-4">Pending Articles</h2>
                    <?php foreach($articles as $article): ?>
                    <div class="space-y-4">
                        <!-- Article Card -->
                        <div class="border rounded-lg p-4">
                            <div class="flex justify-between items-start">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                Status: <?php echo htmlspecialchars($article['validation_admin']); ?>
                                </span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    <?php echo htmlspecialchars($article['category_name']); ?>
                                </span>
                                <span class="text-sm text-gray-500"><?php echo $article['created_at']; ?></span>
                            </div>
                            <h3 class="mt-2 text-lg font-medium"><?php echo htmlspecialchars($article['title']); ?></h3>
                            <p class="mt-1 text-gray-600 text-sm"><?php echo htmlspecialchars($article['description']); ?></p>
                            <div class="mt-4 prose max-w-none">
                                <?php echo $article['content']; ?>
                            </div>
                            <div class="mt-4 flex justify-between items-center">
                                <span class="text-sm text-gray-600"><?php echo htmlspecialchars($article['name']); ?></span>
                                <div class="flex space-x-2">
                                    <button class="px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700">
                                        Approve
                                    </button>
                                    <button class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                                        Reject
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- Add more article cards here -->
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Category Modal -->
    <div id="categoryModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow">
                <div class="flex items-start justify-between p-4 border-b rounded-t">
                    <h3 class="text-xl font-semibold text-gray-900">Create New Category</h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center" data-modal-hide="categoryModal">
                        <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                    </button>
                </div>
                <form method = "post">
                    <div class="p-6 space-y-6">
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900">Category Name</label>
                            <input type="text" name="categoryName" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900">Description</label>
                            <textarea name="categoryDescription" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" rows="4"></textarea>
                        </div>
                    </div>
                    <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b">
                        <button type="submit" class="text-white bg-indigo-600 hover:bg-indigo-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Create Category</button>
                        <button type="button" class="text-gray-500 bg-white hover:bg-gray-100 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5" data-modal-hide="categoryModal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
