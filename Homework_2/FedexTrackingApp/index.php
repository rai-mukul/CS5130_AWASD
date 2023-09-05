<!DOCTYPE html>
<html>

<head>
    <title>FedEx Tracking App</title>
</head>

<body>
    <h1>FedEx Tracking App</h1>
    <form action="" method="GET">
        Enter the tracking number: <input type="text" name="tracking_number">
        <input type="submit" value="Track">
    </form>

    <?php
    // Define the constant tracking number
    define('FED_EX_TRACKING_NUMBER', 582734098);

    // Check if the tracking number input is provided
    if (isset($_GET['tracking_number'])) {
        // Get the input value from the form
        $inputTrackingNumber = $_GET['tracking_number'];

        // Check if the input is a valid number
        if (is_numeric($inputTrackingNumber)) {
            // Compare the input tracking number to the constant
            $resultMessage = ($inputTrackingNumber == FED_EX_TRACKING_NUMBER) ?
                'Tracking Successful. Your package is on the way.' :
                'Invalid tracking number. Please try again.';

            echo '<p>' . $resultMessage . '</p>';
        } else {
            echo '<p>Error: Input must be a valid number.</p>';
        }
    }
    ?>

</body>

</html>