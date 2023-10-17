<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

require_once 'pdo.php';

// Function to get users from the database
function getUsers()
{
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM users");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$users = getUsers();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management - CS5130 Online Shop Manager</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex justify-center items-center min-h-screen bg-gray-100">
    <div class="bg-white p-8 rounded shadow-lg">
        <h2 class="text-2xl mb-4">User Management</h2>
        <!-- Display success message -->
        <?php if (isset($_SESSION['success'])): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <?php echo $_SESSION['success']; ?>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <!-- Display error message -->
        <?php if (isset($_SESSION['error'])): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <?php echo $_SESSION['error']; ?>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <h3 class="text-xl mb-2">Users:</h3>
        <table class="min-w-full">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">First Name</th>
                    <th class="py-2 px-4 border-b">Last Name</th>
                    <th class="py-2 px-4 border-b">Email</th>
                    <th class="py-2 px-4 border-b">Password (Hashed)</th>
                    <th class="py-2 px-4 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td class="py-2 px-4 border-b">
                            <?php echo htmlspecialchars($user['firstname']); ?>
                        </td>
                        <td class="py-2 px-4 border-b">
                            <?php echo htmlspecialchars($user['lastname']); ?>
                        </td>
                        <td class="py-2 px-4 border-b">
                            <?php echo htmlspecialchars($user['email']); ?>
                        </td>
                        <td class="py-2 px-4 border-b">
                            <?php echo htmlspecialchars($user['password']); ?>
                        </td>
                        <td class="py-2 px-4 border-b">
                            <form action="delete_user.php" method="post">
                                <input type="hidden" name="user_id" value="<?php echo $user['userID']; ?>">
                                <button type="submit"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <!-- Form to add a new user -->
        <h3 class="text-xl mt-4 mb-2">Add a User:</h3>
        <form action="add_user.php" method="post">
            <div class="flex flex-wrap w-full">
                <div class="flex flex-col mb-4 mr-4">
                    <label for="firstname" class="block">First Name:</label>
                    <input type="text" id="firstname" name="firstname" class="w-full p-2 border rounded">
                </div>
                <div class="flex flex-col mb-4">
                    <label for="lastname" class="block">Last Name:</label>
                    <input type="text" id="lastname" name="lastname" class="w-full p-2 border rounded">
                </div>
            </div>
            <div class="flex flex-wrap w-full">
                <div class="flex flex-col mb-4 mr-4">
                    <label for="email" class="block">Email:</label>
                    <input type="text" id="email" name="email" class="w-full p-2 border rounded">
                </div>
                <div class="flex flex-col mb-4">
                    <label for="password" class="block">Password:</label>
                    <input type="password" id="password" name="password" class="w-full p-2 border rounded">
                </div>
            </div>
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Add User</button>
        </form>
        <h4 class="text-xl mb-4 pt-10">Admin Menu:</h4>
            <!-- Admin menu with links -->
            
            <div class="mb-4">
                <a href="Admin_Menu.php" class="block text-blue-500">Admin View</a>
            </div>
            <div class="mb-4">
                <a href="product_management.php" class="block text-blue-500">Product View</a>
            </div>
            <div class="mb-4">
                <a href="logout.php" class="block text-red-500">Logout</a>
            </div>
    </div>
</body>

</html>