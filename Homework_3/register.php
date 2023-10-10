<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@^2.0/dist/tailwind.min.css">
    <title>User Registration</title>
</head>

<body class="bg-gray-50 p-10">

    <?php
    include 'pdo.php';

    function sanitizeInput($input)
    {
        return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
    }

    $successAlert = $errorAlert = '';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = filter_var($_POST['username'], FILTER_VALIDATE_EMAIL);
        $password = $_POST['password'];

        if (!$username || !$password) {
            $errorAlert = "Invalid input. Please provide a valid username (email) and password.";
        } else {
            $username = sanitizeInput($username);
            $password = sanitizeInput($password);

            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            $stmt = $conn->prepare("SELECT * FROM accounts WHERE username = :username");
            $stmt->bindParam(':username', $username);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $errorAlert = "Username already exists, please choose another!";
            } else {
                $stmt = $conn->prepare("INSERT INTO accounts (username, password) VALUES (:username, :password)");
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':password', $hashed_password);
                $stmt->execute();
                $successAlert = "Registration successful!";
            }
        }
    }
    ?>

<h2 class="text-2xl text-center my-5 font-bold tracking-tight sm:text-3xl">User Registration</h2>
    <div class="max-w-lg p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 mx-auto">
    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Create Your Account</h5>  
    <!-- HTML form for user registration -->
        <form action="register.php" method="POST" class="mb-4">
            <label for="username" class="block mb-2">Username (email):</label>
            <input type="text" name="username" id="username" class="border border-gray-300 rounded px-2 py-1 w-full mb-2" required>
            <label for="password" class="block mb-2">Password:</label>
            <input type="password" name="password" id="password" class="border border-gray-300 rounded px-2 py-1 w-full mb-2" required>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Register</button>
        </form>

        <!--html code to show the  success and error messages -->
        <?php
        if (!empty($successAlert)) {
            echo '<div class="text-green-500">' . $successAlert . '</div>';
        }
        if (!empty($errorAlert)) {
            echo '<div class="text-red-500">' . $errorAlert . '</div>';
        }
        ?>
    </div>

</body>

</html>
