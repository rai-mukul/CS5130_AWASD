<?php
session_start();

// Check if the user is logged in, redirect to login if not
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

//  database connection
require_once 'pdo.php';

// Fetch product data from the database
$stmt = $conn->prepare("SELECT * FROM products");
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management - CS5130 Online Shop Manager</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex justify-center items-center min-h-screen bg-gray-100">
    <div class="bg-white p-8 rounded shadow-lg">
        <h2 class="text-2xl mb-4">Product Management</h2>
        <!-- I created a sample table for product using this querry to make this code work

             CREATE TABLE `products` (
              `product_id` INT PRIMARY KEY AUTO_INCREMENT,
             `product_name` VARCHAR(255) NOT NULL,
              `price` DECIMAL(10, 2) NOT NULL
              );

         -->
        <?php if (count($products) > 0): ?>
            <table class="w-full border">
                <thead>
                    <tr>
                        <th class="border px-4 py-2">Product ID</th>
                        <th class="border px-4 py-2">Product Name</th>
                        <th class="border px-4 py-2">Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td class="border px-4 py-2">
                                <?php echo htmlspecialchars($product['product_id']); ?>
                            </td>
                            <td class="border px-4 py-2">
                                <?php echo htmlspecialchars($product['product_name']); ?>
                            </td>
                            <td class="border px-4 py-2">$
                                <?php echo htmlspecialchars($product['price']); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No data found.</p>
        <?php endif; ?>
        <h4 class="text-xl mb-4 pt-10">Admin Menu:</h4>
            <!-- Admin menu with links -->
            
            <div class="mb-4">
                <a href="Admin_Menu.php" class="block text-blue-500">Admin View</a>
            </div>
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
</body>

</html>