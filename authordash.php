<?php

    require_once "./config/dbconfig.php";
    require_once "./models/users.php";
    require_once "./models/author.php";
    require_once "./models/member.php";
    
    session_start();

    $database = new Database();

    $id =  $_SESSION['id'];
    $author = new author($database->getConnection(),$id);
    
    // Handle article creation
    if(isset($_POST["title"], $_POST["category_id"], $_POST["description"], $_POST["content"])) {
        $author->createArticle(
            $_POST["title"],
            $_POST["category_id"],
            $_POST["description"],
            $_POST["content"],
            $_POST["status"] ?? 0
        );
    }
    
    $articles = $author->displayArticles();
    $categories = $author->getCategories();

    if(isset($_GET["modify"])) {
        echo "jhjh";
        $db = new Database();
        $id =$_GET["modify"];
        
        $admin = new admin($db->getConnection());
        $result = $admin-modifyArticle($title, $category_id, $description,  $content, $status);
        header("Location: authordash.php?id_article=" . $author->getId());

    }

    if(isset($_GET["delete"])) {
        echo "jhjh";
        $db = new Database();
        $id =$_GET["delete"];
        
        $author = new author($db->getConnection());
        $result = $author->deleteArticle($id);
        
    }



    // if(isset($_POST["title"],$_POST["category"],$_POST["description"],$_POST["content"])){
    // $database = new Database();
    // $db = $database->getConnection();   
    // $id = $_GET['id'] ?? null;
    // $author = new author($db,$id);

    // $title= $_POST["title"] ;
    // $category = $_POST["category"] ;
    // $description = $_POST["description"] ;
    // $content = $_POST["content"] ;
    // $status = $_POST["status"];

    //  $author->createArticle($title, $category, $description, $content, $status);


    // }

    // $db = new Database();
    // $author = new author($db->getConnection());

    // $display = $author->displayArticles();
    // var_dump($display);
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StormQ - Author Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
    <script>
        tinymce.init({
            selector: '#content',
            plugins: 'image media link code',
            toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright | image media link | code',
            height: 400,
            images_upload_url: 'upload.php',
            automatic_uploads: true
        });
    </script>
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
                    <span class="text-gray-700 px-3">Welcome, Author</span>
                    <button class="text-gray-500 hover:text-gray-700">Logout</button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
            <!-- Create Article Button -->
            <div class="mb-6">
                <button data-modal-target="articleModal" data-modal-toggle="articleModal" 
                        class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Create New Article
                </button>
            </div>
    
            <!-- Article Feed -->
             <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
            <!-- Article Feed -->
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                <?php foreach($articles as $article): ?>
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <div class="p-6">
                            <div class="flex justify-between items-start">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    <?php echo htmlspecialchars($article['category_name']); ?>
                                </span>
                                <div class="flex space-x-2">
                                    <span class="text-gray-500 text-sm">
                                        Status: <?php echo htmlspecialchars($article['validation_admin']); ?>
                                    </span>
                                </div>
                            </div>
                            <h3 class="mt-2 text-xl font-semibold text-gray-900">
                                <?php echo htmlspecialchars($article['title']); ?>
                            </h3>
                            <p class="mt-2 text-gray-600 text-sm">
                                <?php echo htmlspecialchars($article['description']); ?>
                            </p>
                            <div class="mt-4 prose max-w-none">
                                <?php echo $article['content']; ?>
                            </div>
                            <div class="mt-4 flex justify-between items-center">
                                <span class="text-sm text-gray-500">
                                    <?php echo $article['formatted_date']; ?>
                                </span>
                                <span class="text-sm text-gray-500">
                                    By: <?php echo htmlspecialchars($article['firstname'] . ' ' . $article['lastname']); ?>
                                </span>
                            </div>
                            <div class="flex space-x-2">
                                    <a href='articleEdit.php?id_article=<?=$article['id']?>' class="px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700">
                                        Modify
                    </a>
                                    <a href='authordash.php?delete=<?=$article['id']?>' class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                                        Delete
                    </a>
                                </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

                       
    <!-- Article Creation/Edit Modal -->
    <div id="articleModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow">
                <!-- Modal header -->
                <div class="flex items-start justify-between p-4 border-b rounded-t">
                    <h3 class="text-xl font-semibold text-gray-900" id="modalTitle">
                        Create New Article
                    </h3>
                    
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center" data-modal-hide="articleModal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                    </button>
                </div>
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

    <script>
        // function editArticle(articleId) {
        //     // Set modal title
        //     document.getElementById('modalTitle').textContent = 'Edit Article';
        //     document.getElementById('articleId').value = articleId;
            
        //     // Open modal
        //     const modal = document.getElementById('articleModal');
        //     modal.classList.remove('hidden');
        // }

        // function deleteArticle(articleId) {
        //     if (confirm('Are you sure you want to delete this article?')) {
        //         // Here you would typically submit to your deleteArticle PHP endpoint
        //         console.log('Deleting article:', articleId);
        //     }
        // }

        // function saveArticle() {
        //     const form = document.getElementById('articleForm');
        //     const articleId = document.getElementById('articleId').value;
            
        //     // If articleId exists, it's an edit operation
        //     if (articleId) {
        //         form.action = 'modify_article.php';
        //     } else {
        //         form.action = 'create_article.php';
        //     }
            
        //     form.submit();
        // }

        // Clear form when opening create new article
        document.querySelector('[data-modal-target="articleModal"]').addEventListener('click', function() {
            document.getElementById('modalTitle').textContent = 'Create New Article';
            document.getElementById('articleForm').reset();
            document.getElementById('articleId').value = '';
        });
    </script>
</body>
</html>