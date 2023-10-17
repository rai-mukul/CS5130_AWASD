<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

require_once 'pdo.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $firstName = $_POST['firstname']; 
    $lastName = $_POST['lastname']; 

    // Sanitize and validate input (you should add more validation as needed)
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert the user into the database
    $stmt = $conn->prepare("INSERT INTO users (email, password, firstname, lastname) VALUES (:email, :password, :firstname, :lastname)");
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $hashedPassword);
    $stmt->bindParam(':firstname', $firstName);
    $stmt->bindParam(':lastname', $lastName);

    if ($stmt->execute()) {
        $_SESSION['success'] = "User added successfully.";
    } else {
        $_SESSION['error'] = "Error adding the user.";
    }

    header("Location: user_management.php"); // Redirect to user management page
    exit();
}
?>
