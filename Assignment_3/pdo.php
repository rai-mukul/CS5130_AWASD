<?php
try {
    $pdo = new PDO('mysql:host=localhost;port=3306;dbname=assgn03', 'raimukul', 'M@xfZ6lr2IYy9[LW');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Function to check if a username exists in the 'accounts' table
    function isUsernameExists($username, $pdo) {
        $query = "SELECT COUNT(*) as count FROM accounts WHERE username = ?";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(1, $username, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result["count"] > 0;
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
