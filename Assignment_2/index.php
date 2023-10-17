<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

if (isset($_SESSION['user'])) {
    header("Location: admin_menu.php");
    exit();
}

$error_message = isset($_SESSION['error']) ? $_SESSION['error'] : '';
unset($_SESSION['error']);  // Clear the error message
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CS5130 Online Shop Manager</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex justify-center items-center min-h-screen bg-gray-100">
    <div class="bg-white p-8 rounded shadow-lg">
        <?php if ($error_message): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong>Error:</strong> <?php echo $error_message; ?>
            </div>
        <?php endif; ?>

        <h2 class="text-2xl mb-4">Login</h2>
        <!-- <form action="authenticate.php" method="post">
            <div class="mb-4">
                <label for="email" class="block">Email:</label>
                <input type="text" id="email" name="email" class="w-full p-2 border rounded">
            </div>
            <div class="mb-4">
                <label for="password" class="block">Password:</label>
                <input type="password" id="password" name="password" class="w-full p-2 border rounded">
            </div>
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Login</button>
        </form> -->

        <p class="mt-4">
            <a href="login.php" class="text-blue-500">Try again</a>
        </p>
    </div>
</body>

</html>
