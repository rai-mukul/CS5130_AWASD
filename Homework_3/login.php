<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@^2.0/dist/tailwind.min.css">
    <title>Login Page</title>
</head>

<body class="bg-gray-50 p-10">

    <?php
    include 'pdo.php';

    $errorMessage = '';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $row = $stmt->fetch();
            if (password_verify($password, $row['password'])) {
                $successMessage = "Password matches!";
            } else {
                $errorMessage = "Username or password is not correct!";
            }
        } else {
            $errorMessage = "Username or password is not correct!";
        }
    }
    ?>
    
        <h2 class="text-2xl text-center my-5 font-bold tracking-tight sm:text-3xl">User Login</h2>
    
    <div
        class="max-w-xl p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 mx-auto">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Login to Your Account</h5>  
        <!-- HTML form for login -->
        <form action="login.php" method="POST" class="mb-4">
            <label for="username" class="block mb-2">Username (email):</label>
            <input type="text" name="username" id="username"
                class="border border-gray-300 rounded px-2 py-1 w-full mb-2" required>
            <label for="password" class="block mb-2">Password:</label>
            <input type="password" name="password" id="password"
                class="border border-gray-300 rounded px-2 py-1 w-full mb-2" required>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Login</button>
        </form>

        <!-- Display success and error messages -->
        <?php if (!empty($errorMessage)): ?>
            <div class="text-red-500 mb-4">
                <?php echo $errorMessage; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($successMessage)): ?>
            <div class="text-green-500 mb-4">
                <?php echo $successMessage; ?>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>