<?php
session_set_cookie_params(86400); // value to set session cookie to expire in 24 hours (1 day)
session_start();

// Check if the user is already logged in, redirect to admin menu
if (isset($_SESSION['user'])) {
    header("Location: admin_menu.php");
    exit();
}

// To check if the visit count cookie exists
if (!isset($_COOKIE['visit_count'])) {
    $visit_count = 1;
} else {
    $visit_count = $_COOKIE['visit_count'] + 1;
}

// To set the visit count cookie
setcookie('visit_count', $visit_count, time() + 86400, "/"); // 1 day expiration

// To show logout success message below login form.
if (isset($_GET['logout']) && $_GET['logout'] === 'success') {
    $logoutMsg = "Successfully logged out.";
}

// Check if this is a login attempt
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Attempting login, show database connection status messages if available
    $errorMsg = isset($_SESSION['error']) ? $_SESSION['error'] : null;
    $successMsg = isset($_SESSION['success']) ? $_SESSION['success'] : null;
    // Clear the messages from the session
    unset($_SESSION['error']);
    unset($_SESSION['success']);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - CS5130 Online Shop Manager</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex justify-center items-center min-h-screen bg-gray-100">
    <div class="bg-white p-8 rounded shadow-lg">
        <h2 class="text-2xl mb-4">CS5130 Online Shop Manager - Login</h2>

        <!-- Show error message if set -->
        <?php if (isset($errorMsg)): ?>
            <div class="alert alert-error">
                <?php echo $errorMsg; ?>
            </div>
        <?php endif; ?>

        <!-- Show success message if set -->
        <?php if (isset($successMsg)): ?>
            <div class="alert alert-success">
                <?php echo $successMsg; ?>
            </div>
        <?php endif; ?>
        <form action="authenticate.php" method="post">
            <div class="mb-4">
                <label for="email" class="block">Email:</label>
                <input type="text" id="email" name="email" class="w-full p-2 border rounded">
            </div>
            <div class="mb-4">
                <label for="password" class="block">Password:</label>
                <input type="password" id="password" name="password" class="w-full p-2 border rounded">
            </div>
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Login</button>
        </form>
        <!-- Show success message if present -->
        <?php if (isset($logoutMsg)): ?>
            <div class="alert alert-success pt-5">
                <?php echo $logoutMsg; ?>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>