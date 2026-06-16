<?php
include 'config.php';
// Assuming you have already established a database connection

 session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // If not logged in, redirect to login page
        $student_id = $_SESSION['login_id'];
        echo "Welcome " . $student_id;
    }


$emailid = $_POST["emailid"];
    $password = $_POST["password"];

// Fetch data from Payments table
$payment_id = $_GET['id']; // Assuming you have a payment_id parameter
$query = "SELECT * FROM Payments WHERE id = payment_id?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $payment_id);
$stmt->execute();
$result = $stmt->get_result();
$payment = $result->fetch_assoc();
$stmt->close();

// Fetch data from students table
$query = "SELECT first_name,last_name, email, student_id FROM students WHERE student_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $payment['student_id']); // Assuming 'student_id' is the foreign key in Payments table
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();
$stmt->close();

// Now you have $payment and $student data, you can generate the receipt
?>

<!DOCTYPE html>
<html>
<head>
    <title>Receipt</title>
</head>
<body>
    <h1>Receipt</h1>
    <p><strong>Name:</strong> <?php echo $student['Name']; ?></p>
    <p><strong>Email:</strong> <?php echo $student['Email']; ?></p>
    <p><strong>Student ID:</strong> <?php echo $student['Student_ID']; ?></p>
    <p><strong>Payment Amount:</strong> <?php echo $payment['amount']; ?></p>
    <p><strong>Payment Date:</strong> <?php echo $payment['payment_date']; ?></p>
    <!-- Add more payment details as needed -->
</body>
</html>