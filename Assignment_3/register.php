<?php
require('pdo.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$username = isset($_POST["username"]) ? $_POST["username"] : null;
	$password = isset($_POST["password"]) ? $_POST["password"] : null;

	// Validate email format
	if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
		echo "Invalid email address";
		// Handle the error accordingly
		exit;
	}

	if ($username && $password) {
		// Check if the username exists
		$usernameExists = isUsernameExists($username, $pdo);

		if ($usernameExists) {
			echo '<p class="text-red-500 mb-4 pt-">Same Username Exists! Please use another username</p>';
		} else {
			$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

			// Insert new user into the 'accounts' table
			$insertQuery = "INSERT INTO accounts (username, password) VALUES (?, ?)";
			$stmt = $pdo->prepare($insertQuery);
			$stmt->bindParam(1, $username, PDO::PARAM_STR);
			$stmt->bindParam(2, $hashedPassword, PDO::PARAM_STR);
			$stmt->execute();

			echo "Registration successful!";
		}
	} else {
		echo "Please provide both username and password";
	}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Create Your Account</title>
	<script type="text/javascript" src="jquery-3.7.1.js">
	</script>
	<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

</head>

<body class="bg-gray-100">

	<div class="bg-white p-8 rounded shadow-md w-1/4">
		<h1 class="text-2xl font-bold mb-6">Create Your Account</h1>
		<form action="register.php" method="post" id="search">
			<div class="mb-4">
				<label for="username" class="block text-gray-700 text-sm font-bold mb-2">Username:</label>
				<input type="email" name="username" id="username" placeholder="Username" required
					class="w-full border border-gray-300 p-2 rounded">
			</div>
			<div class="mb-4">
				<label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password:</label>
				<input type="password" name="password" id="password" placeholder="Password" required
					class="w-full border border-gray-300 p-2 rounded">
			</div>
			<input type="submit" value="Register" class="bg-blue-500 text-white p-2 rounded cursor-pointer">
		</form>
		<p id='msg' class="text-red-500 mt-4">Please provide username and password</p>
	</div>

	<script>
		$(document).ready(function () {
			$("#username").blur(function () {
				var username = $(this).val();

				$.getJSON("getjson.php", { username: username }, function (data) {
					if (data.exists) {
						$("#msg").text("Same Username Exist! Please use another username").css("color", "red");
					} else {
						$("#msg").text("You can use the username").css("color", "blue");
					}
				});
			});
		});
	</script>
</body>

</html>