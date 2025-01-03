

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StormQ - Member Feed</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg fixed w-full top-0 z-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <h1 class="text-2xl font-bold text-indigo-600">StormQ</h1>
                    </div>
                    <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                        <a href="#" class="border-indigo-500 text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Feed
                        </a>
                        <a href="#" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Bookmarks
                        </a>
                        <a href="#" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Trending
                        </a>
                    </div>
                </div>
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="relative">
                            <input type="text" class="bg-gray-100 rounded-full py-2 px-4 pl-10 text-sm w-64 focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Search posts...">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        </div>
                    </div>
                    <div class="ml-4 flex items-center">
                        <img class="h-8 w-8 rounded-full" src="/api/placeholder/32/32" alt="User profile">
                        <button class="ml-3 text-gray-500 hover:text-gray-700">Logout</button>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-20">
        <div class="py-6">
            <!-- Categories Section -->
            <div class="mb-8">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Categories</h2>
                <div class="flex flex-wrap gap-2">
                    <button class="px-4 py-2 bg-indigo-600 text-white rounded-full text-sm font-medium">All</button>
                    <button class="px-4 py-2 bg-white hover:bg-gray-50 text-gray-700 rounded-full text-sm font-medium border">Technology</button>
                    <button class="px-4 py-2 bg-white hover:bg-gray-50 text-gray-700 rounded-full text-sm font-medium border">Design</button>
                    <button class="px-4 py-2 bg-white hover:bg-gray-50 text-gray-700 rounded-full text-sm font-medium border">Business</button>
                    <button class="px-4 py-2 bg-white hover:bg-gray-50 text-gray-700 rounded-full text-sm font-medium border">Science</button>
                    <button class="px-4 py-2 bg-white hover:bg-gray-50 text-gray-700 rounded-full text-sm font-medium border">Health</button>
                </div>
            </div>

            <!-- Sort Options -->
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-900">Latest Posts</h2>
                <div class="flex items-center space-x-2">
                    <span class="text-sm text-gray-500">Sort by:</span>
                    <select class="border-gray-300 rounded-md text-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        <option>Most Recent</option>
                        <option>Most Popular</option>
                        <option>Most Discussed</option>
                    </select>
                </div>
            </div>

            <!-- Feed Posts -->
            <div class="space-y-6">
                <!-- Post 1 -->
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center mb-4">
                        <img class="h-10 w-10 rounded-full" src="/api/placeholder/40/40" alt="Author profile">
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-900">John Doe</p>
                            <p class="text-sm text-gray-500">Posted on Jan 1, 2025</p>
                        </div>
                        <span class="ml-auto px-3 py-1 bg-indigo-100 text-indigo-800 rounded-full text-sm">Technology</span>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">The Future of AI Development</h3>
                    <p class="text-gray-600 mb-4">An exploration of how artificial intelligence is shaping our future and transforming industries...</p>
                    <div class="flex items-center justify-between">
                        <div class="flex space-x-4">
                            <button class="flex items-center space-x-1 text-gray-500 hover:text-indigo-600">
                                <i class="far fa-heart"></i>
                                <span>24</span>
                            </button>
                            <button class="flex items-center space-x-1 text-gray-500 hover:text-indigo-600">
                                <i class="far fa-comment"></i>
                                <span>12</span>
                            </button>
                        </div>
                        <button class="text-indigo-600 hover:text-indigo-700 font-medium">Read More</button>
                    </div>
                </div>

                <!-- Post 2 -->
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center mb-4">
                        <img class="h-10 w-10 rounded-full" src="/api/placeholder/40/40" alt="Author profile">
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-900">Jane Smith</p>
                            <p class="text-sm text-gray-500">Posted on Dec 31, 2024</p>
                        </div>
                        <span class="ml-auto px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm">Design</span>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">UI Design Trends for 2025</h3>
                    <p class="text-gray-600 mb-4">Discover the latest trends in user interface design that will dominate the upcoming year...</p>
                    <div class="flex items-center justify-between">
                        <div class="flex space-x-4">
                            <button class="flex items-center space-x-1 text-gray-500 hover:text-indigo-600">
                                <i class="far fa-heart"></i>
                                <span>18</span>
                            </button>
                            <button class="flex items-center space-x-1 text-gray-500 hover:text-indigo-600">
                                <i class="far fa-comment"></i>
                                <span>8</span>
                            </button>
                        </div>
                        <button class="text-indigo-600 hover:text-indigo-700 font-medium">Read More</button>
                    </div>
                </div>
            </div>

            <!-- Load More -->
            <div class="text-center mt-8">
                <button class="px-6 py-3 bg-white border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                    Load More Posts
                </button>
            </div>
        </div>
    </div>
</body>
</html>