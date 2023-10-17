<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assuming you have a function to delete a user by ID
    if (isset($_POST['user_id']) && is_numeric($_POST['user_id'])) {
        $userId = $_POST['user_id'];

        // database connection
        require_once 'pdo.php';

        // Prepare the SQL statement to delete the user
        $stmt = $conn->prepare("DELETE FROM users WHERE userID = :userId");
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);

        try {
            // Execute the SQL statement
            $stmt->execute();
            $_SESSION['success'] = 'User deleted successfully.';
        } catch (PDOException $e) {
            $_SESSION['error'] = 'Error deleting user: ' . $e->getMessage();
        }
    } else {
        $_SESSION['error'] = 'Invalid user ID.';
    }
}

header("Location: user_management.php");
exit();
?>
