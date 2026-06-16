<?php
session_start();
include "db.php";

require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if(isset($_POST['send_otp'])){

    $email = trim($_POST['email']);

    // Check if email exists
    $check =
    $conn->query(
      "SELECT * FROM students
       WHERE email='$email'"
    );

    if($check->num_rows > 0){

        // Generate 6-digit OTP
        $otp =
        rand(100000,999999);

        // Delete old OTP if exists
        $conn->query(
          "DELETE FROM password_resets
           WHERE email='$email'"
        );

        // Save OTP in DB
        $conn->query(
          "INSERT INTO password_resets
          (email, otp)
          VALUES
          ('$email','$otp')"
        );

        $mail =
        new PHPMailer(true);

        try{

            $mail->isSMTP();
            $mail->Host =
            'smtp.gmail.com';

            $mail->SMTPAuth =
            true;

            // YOUR GMAIL
            $mail->Username =
            'gymkhana104@gmail.com';

            // APP PASSWORD
            $mail->Password =
            'ervbywymttdudpef';

            $mail->SMTPSecure =
            'tls';

            $mail->Port = 587;

            $mail->setFrom(
              'gymkhana104@gmail.com',
              'Gymkhana Portal'
            );

            $mail->addAddress($email);

            $mail->Subject =
            'Password Reset OTP';

            $mail->Body =
            "Your OTP for password reset is: $otp";

            $mail->send();

            $_SESSION['reset_email']
            = $email;

            header(
              "Location:
               verify-otp.php"
            );
            exit();

        }
        catch(Exception $e){

            $error =
            "Email not sent!";
        }

    }
    else{

        $error =
        "Email not found!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Forgot Password</title>

<style>

body{
    margin:0;
    font-family:'Segoe UI',
    sans-serif;
    background:#f1f5f9;
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
}

.box{
    background:white;
    width:22rem;
    padding:2rem;
    border-radius:1rem;
    box-shadow:
    0 0.5rem 1.5rem
    rgba(0,0,0,0.15);
}

h2{
    text-align:center;
    margin-bottom:1rem;
}

input{
    width:100%;
    padding:0.8rem;
    border:1px solid #ccc;
    border-radius:0.5rem;
    margin-top:1rem;
    box-sizing:border-box;
}

button{
    width:100%;
    padding:0.8rem;
    border:none;
    background:#1e3a8a;
    color:white;
    border-radius:0.5rem;
    margin-top:1rem;
    cursor:pointer;
}

button:hover{
    background:#2563eb;
}

.error{
    color:red;
    text-align:center;
    margin-bottom:1rem;
}

</style>
</head>

<body>

<div class="box">

<h2>Forgot Password</h2>

<?php
if(isset($error)){
echo "<div class='error'>
$error
</div>";
}
?>

<form method="POST">

<input
type="email"
name="email"
placeholder="Enter Registered Email"
required>

<button
name="send_otp">

Send OTP

</button>

</form>

</div>

</body>
</html>