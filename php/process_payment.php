<?php
session_start();

// Assuming $conn is the database connection

// Corrected Database connection parameters
$db_host = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "sports_ms";

// Create a database connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Escape and sanitize the data to prevent SQL injection
    $card_number = $conn->real_escape_string($_POST['card_number']);
    $card_expiry = $conn->real_escape_string($_POST['expiry']);
    $card_cvv = $conn->real_escape_string($_POST['cvv']);
    $amount = $conn->real_escape_string($_POST['amount']);

    // Validate the data
    if (empty($card_number) || empty($card_expiry) || empty($card_cvv) || empty($amount)) {
        echo '<script>alert("Please fill in all the required fields."); </script>';
        exit();
    }

    // Save payment details to the database
    $sql = "INSERT INTO payments (card_number, card_expiry, card_cvv, amount) VALUES 
    ('$card_number', '$card_expiry', '$card_cvv', '$amount')";

    if ($conn->query($sql) === TRUE) {
        // Fetching name from Students table for the current logged in student id
    
        echo "<script>alert('Payment successful!\\nAmount: $amount');</script>";
    } else {
        echo '<script>alert("Error: ' . $sql . '<br>' . $conn->error . '"); window.location.href="payment.html";</script>';
        exit();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Payment Details</title>
    <link rel="stylesheet" type="text/css" href="">
    <style>
        body {
    font-family: Arial, sans-serif;
}

#payment-table {
    width: 50%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

#payment-table th, #payment-table td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

#payment-table th {
    background-color: #f2f2f2;
}

#print-button {
    padding: 10px 20px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

#print-button:hover {
    background-color: #45a049;
}

        </style>
</head>
<body>
    
<h1>Payment Successfull!!</h1>
        <p>Your payment has been successfully processed.</p>
<?php
echo "<h2>Payment Details</h2>";
echo "<table id='payment-table'>
        <tr>
            <th>Payment Information</th>
            <th>Details</th>
        </tr>
        <tr>
            <td>Amount</td>
            <td>$amount</td>
        </tr>
        <tr>
            <td>Card Number</td>
            <td>$card_number</td>
        </tr>
        <tr>
            <td>Card Expiry</td>
            <td>$card_expiry</td>
        </tr>
        <tr>
            <td>Card CVV</td>
            <td>$card_cvv</td>
        </tr>
    </table>";
?>

<button id="print-button" onclick="printTable()">Print</button>

<div class="confirmation">
        <p>Thank you for your payment!</p>
        <a href="index.php" class="back-link">Back to Home Page</a>
    </div>

<script>
function printTable() {
    var printContents = document.getElementById('payment-table').outerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}
</script>

</body>
</html>