<?php
require_once "../config/dbconfig.php";
require_once "../models/users.php";
require_once "../models/member.php";

if

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


            <form action="../includes/register.inc.php" method="post" class="mt-8 space-y-6" action="#" method="POST">
                <div class="rounded-md shadow-sm space-y-4">
                    <div>
                        <label for="firstName" class="sr-only">First Name</label>
                        <input id="firstName" name="firstName" type="text" required 
                            class="appearance-none rounded-lg relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="First Name">
                    </div>
                    <div>
                        <label for="lastName" class="sr-only">Last Name</label>
                        <input id="lastName" name="lastName" type="text" required 
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
                        <label for="role" class="block text-sm font-medium text-gray-700">Select Role</label>
                        <select id="role" name="role" required 
                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 rounded-lg">
                            <option value="member">Member</option>
                            <option value="creator">Creator</option>
                        </select>
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