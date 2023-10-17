<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Menu - CS5130 Online Shop Manager</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex justify-center items-center min-h-screen bg-gray-100">
    <div class="bg-gray-500 p-8 rounded shadow-lg w-3/4">
    <div class="flex justify-center items-center">
        <div class="bg-gray-50 p-8 rounded shadow-lg  w-full">
        <h3 class="text-2xl font-bold tracking-tight text-gray-900">CS5130 Online Shop Manager</h3>
        <hr/>
            <h4 class="text-xl mb-4 pt-5">Admin Menu:</h4>
            <!-- Admin menu with links -->
            <div class="mb-4">
                <a href="user_management.php" class="block text-blue-500">User View</a>
            </div>
            <div class="mb-4">
                <a href="product_management.php" class="block text-blue-500">Product View</a>
            </div>
            <div class="mb-4">
                <a href="logout.php" class="block text-red-500">Logout</a>
            </div>
        </div>
    </div>
    </div>
</body>