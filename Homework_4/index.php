<?php
// Initialize variables to store form inputs and result message
$ccNumber = $amount = $result = "";

// Start a session
session_start();

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data and sanitize
    $ccNumber = filter_input(INPUT_POST, "ccNumber", FILTER_SANITIZE_NUMBER_INT);
    $amount = filter_input(INPUT_POST, "amount", FILTER_SANITIZE_NUMBER_FLOAT);

    // Store the form data in session variables
    $_SESSION['ccNumber'] = $ccNumber;
    $_SESSION['amount'] = $amount;

    // Validate the credit card number (a simple validation is performed here for demonstration)
    if (strlen($ccNumber) == 16 && is_numeric($ccNumber) && !empty($amount)) {
        // Success message if the validation is passed
        $result = "Transaction successful! Amount: $$amount charged to credit card ending in " . substr($ccNumber, -4);
    } else {
        // Generate an error message if credit card number is invalid or amount is empty
        $result = "Invalid credit card number or amount. Please enter a valid 16-digit number and ensure the amount is valid.";
    }

    // Store the result message in a session variable
    $_SESSION['result'] = $result;

    // Redirect back to the form page
    header("Location: index.php");
    return;
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Credit Card Transaction</title>
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">

    <?php
    // Retrieve form input values from session or initialize to empty strings
    $ccNumber = isset($_SESSION["ccNumber"]) ? $_SESSION["ccNumber"] : "";
    $amount = isset($_SESSION["amount"]) ? $_SESSION["amount"] : "";

    // Check if a result message is available in session
    if (isset($_SESSION['result'])) {
        $result = $_SESSION['result'];
        unset($_SESSION['result']);
    }
    ?>
    <div class="bg-white rounded-lg p-8 shadow-md w-96">
        <h2 class="text-2xl font-semibold mb-6">Credit Card Transaction</h2>

        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="pb-3">
            <div class="mb-4">
                <label for="ccNumber" class="block text-gray-700 pb-2">Credit Card Number (16 digits):</label>
                <input type="number" id="ccNumber" name="ccNumber" autocomplete="cc-number"
                    placeholder="xxxx xxxx xxxx xxxx" maxlength="16" required
                    class="w-full px-4 py-2 rounded border border-gray-300 focus:outline-none focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label for="amount" class="block text-gray-700">Amount ($):</label>
                <input type="number" id="amount" name="amount" required
                    class="w-full px-4 py-2 rounded border border-gray-300 focus:outline-none focus:border-blue-500">
            </div>
            <div class="text-center">
                <input type="submit" value="Submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 cursor-pointer">
            </div>
        </form>

        <?php
        if (!empty($result)) {
            echo "<h3 class='flex items-center p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400' role='alert'>" . htmlspecialchars($result) . "</h3>";
        }
        ?>
    </div>

</body>

</html>