<?php
session_start();

// Unset all of the session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the login page with a success message
header("Location: login.php?logout=success");
exit();
?>