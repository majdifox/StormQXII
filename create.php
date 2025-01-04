<?php


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StormQ - Create Article</title>
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
                    <span class="text-gray-700 px-3">Welcome, Creator</span>
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
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3" id="articleFeed">
                <!-- Sample Article Card (will be dynamically created) -->
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="p-6">
                        <div class="flex justify-between items-start">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                Technology
                            </span>
                            <span class="text-sm text-gray-500">Jan 3, 2025</span>
                        </div>
                        <h3 class="mt-2 text-xl font-semibold text-gray-900">Sample Article Title</h3>
                        <p class="mt-2 text-gray-600 text-sm line-clamp-3">This is a sample description for the article. It will be truncated after three lines to maintain consistent card heights.</p>
                        <div class="mt-4 flex items-center">
                            <div class="flex-shrink-0">
                                <img class="h-10 w-10 rounded-full" src="/api/placeholder/40/40" alt="Author avatar">
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">John Doe</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Article Creation Modal -->
    <div id="articleModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow">
                <!-- Modal header -->
                <div class="flex items-start justify-between p-4 border-b rounded-t">
                    <h3 class="text-xl font-semibold text-gray-900">
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
                    <form id="articleForm" class="space-y-4">
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                            <input type="text" name="title" id="title" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                        
                        <div>
                            <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                            <select id="category" name="category" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Select a category</option>
                                <option value="technology">Technology</option>
                                <option value="science">Science</option>
                                <option value="health">Health</option>
                                <option value="business">Business</option>
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
                    </form>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center justify-end p-6 space-x-2 border-t border-gray-200 rounded-b">
                    <button data-modal-hide="articleModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">Cancel</button>
                    <button type="button" onclick="createArticle()" class="text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Create Article</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function createArticle() {
            // Get form data
            const title = document.getElementById('title').value;
            const category = document.getElementById('category').value;
            const description = document.getElementById('description').value;
            const content = document.getElementById('content').value;
            
            // Create new article card
            const articleCard = document.createElement('div');
            articleCard.className = 'bg-white rounded-lg shadow overflow-hidden';
            articleCard.innerHTML = `
                <div class="p-6">
                    <div class="flex justify-between items-start">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            ${category}
                        </span>
                        <span class="text-sm text-gray-500">${new Date().toLocaleDateString()}</span>
                    </div>
                    <h3 class="mt-2 text-xl font-semibold text-gray-900">${title}</h3>
                    <p class="mt-2 text-gray-600 text-sm line-clamp-3">${description}</p>
                    <div class="mt-4 flex items-center">
                        <div class="flex-shrink-0">
                            <img class="h-10 w-10 rounded-full" src="/api/placeholder/40/40" alt="Author avatar">
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-900">Creator</p>
                        </div>
                    </div>
                </div>
            `;

            // Add the new card to the feed
            document.getElementById('articleFeed').prepend(articleCard);

            // Reset form and close modal
            document.getElementById('articleForm').reset();
            document.querySelector('[data-modal-hide="articleModal"]').click();
        }
    </script>
</body>
</html>