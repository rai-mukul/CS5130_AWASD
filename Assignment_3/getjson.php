<?php
require_once "pdo.php";

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $username = isset($_GET["username"]) ? $_GET["username"] : null;

    if ($username) {
        // Check if the username exists in the database
        $query = "SELECT COUNT(*) as count FROM accounts WHERE username = ?";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(1, $username, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Return JSON response
        echo json_encode(array("exists" => $result["count"] > 0));
    } else {
        // Handle the case when no username is provided in the request
        echo json_encode(array("error" => "Username not provided"));
    }
} else {
    // Handle the case when the request method is not GET
    echo json_encode(array("error" => "Invalid request method"));
}
?>
