<?php
session_start();
include "db.php";

require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';
require '../PHPMailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if(isset($_POST['send_otp'])){

    $email = trim($_POST['email']);

    $check = $conn->query("
        SELECT * FROM students
        WHERE email='$email'
    ");

    if($check->num_rows > 0){

        $row = $check->fetch_assoc();

        $student_name = $row['name'];

        $otp = rand(100000,999999);

        // delete old otp
        $conn->query("
            DELETE FROM password_resets
            WHERE email='$email'
        ");

        // insert new otp
        $conn->query("
            INSERT INTO password_resets(email, otp)
            VALUES('$email','$otp')
        ");

        $mail = new PHPMailer(true);

        try{

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;

            // YOUR GMAIL
            $mail->Username = 'gymkhana104@gmail.com';

            // YOUR APP PASSWORD
            $mail->Password = 'ervbywymttdudpef';

            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom(
                'gymkhana104@gmail.com',
                'Gymkhana Sports Portal'
            );

            $mail->addAddress($email);

            $mail->isHTML(true);

            $mail->Subject =
            "Password Reset Verification";

            $mail->Body = "

            <div style='
            font-family:Segoe UI,sans-serif;
            max-width:600px;
            margin:auto;
            border:1px solid #e5e7eb;
            border-radius:12px;
            overflow:hidden;
            '>

                <div style='
                background:#1e3a8a;
                color:white;
                padding:25px;
                text-align:center;
                '>

                    <h1 style='margin:0;'>
                    Gymkhana Sports Portal
                    </h1>

                </div>

                <div style='padding:30px;'>

                    <h2 style='
                    color:#1e3a8a;
                    margin-top:0;
                    '>
                    Password Reset Verification
                    </h2>

                    <p style='font-size:16px;'>
                    Hello, <b>$student_name</b>
                    </p>

                    <p style='
                    color:#374151;
                    line-height:1.7;
                    '>

                    We received a request to reset
                    your Gymkhana Sports Portal password.

                    Please use the OTP below to verify
                    your identity and continue securely.

                    </p>

                    <div style='
                    background:#f3f4f6;
                    padding:20px;
                    text-align:center;
                    border-radius:10px;
                    margin:25px 0;
                    '>

                        <p style='
                        margin:0;
                        color:#6b7280;
                        font-size:14px;
                        '>
                        Your Verification Code
                        </p>

                        <h1 style='
                        letter-spacing:8px;
                        color:#1e3a8a;
                        margin:10px 0 0;
                        '>
                        $otp
                        </h1>

                    </div>

                    <p style='
                    color:#dc2626;
                    font-weight:600;
                    '>

                    OTP valid for only 2 minutes.

                    </p>

                    <p style='
                    color:#4b5563;
                    line-height:1.6;
                    '>

                    If you did not request a password reset,
                    you can safely ignore this email.

                    </p>

                </div>

                <div style='
                background:#f9fafb;
                padding:18px;
                text-align:center;
                color:#6b7280;
                font-size:14px;
                '>

                Gymkhana Sports Portal © 2026

                </div>

            </div>

            ";

            $mail->send();

            $_SESSION['reset_email'] = $email;

            $success =
            "OTP sent successfully to your registered email.";

            header("refresh:2;url=verify-otp.php");

        }
        catch(Exception $e){

            $error =
            "Unable to send OTP email.";
        }

    }
    else{

        $error =
        "No account found with this email.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Forgot Password</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:'Segoe UI',sans-serif;
    background:#f1f5f9;
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    padding:2rem;
}

.container{
    width:58rem;
    background:white;
    border-radius:1rem;
    overflow:hidden;
    display:flex;
    box-shadow:0 0.7rem 2rem rgba(0,0,0,0.12);
}

/* LEFT */

.left{
    width:50%;
    background:#1e3a8a;
    color:white;
    padding:3rem;
}

.left h1{
    font-size:2rem;
    margin-bottom:1rem;
}

.left p{
    line-height:1.8;
    color:#dbeafe;
    margin-bottom:2rem;
}

.info{
    margin-top:2rem;
}

.info div{
    background:rgba(255,255,255,0.08);
    padding:1rem;
    border-left:4px solid #facc15;
    border-radius:0.5rem;
    margin-bottom:1rem;
    line-height:1.6;
}

/* RIGHT */

.right{
    width:50%;
    padding:3rem;
}

.right h2{
    color:#1e3a8a;
    margin-bottom:0.8rem;
}

.subtitle{
    color:#6b7280;
    margin-bottom:2rem;
    line-height:1.7;
}

input{
    width:100%;
    padding:0.9rem;
    border:1px solid #d1d5db;
    border-radius:0.5rem;
    margin-top:0.8rem;
    font-size:0.95rem;
    outline:none;
}

input:focus{
    border-color:#1e3a8a;
}

button{
    width:100%;
    padding:0.9rem;
    margin-top:1.2rem;
    border:none;
    border-radius:0.5rem;
    background:#1e3a8a;
    color:white;
    font-size:1rem;
    cursor:pointer;
    transition:0.3s;
    font-weight:600;
}

button:hover{
    background:#2563eb;
}

.note{
    margin-top:1.5rem;
    color:#6b7280;
    font-size:0.92rem;
    line-height:1.7;
}

.error{
    background:#fee2e2;
    color:#dc2626;
    padding:0.9rem;
    border-radius:0.5rem;
    margin-bottom:1rem;
}

.success{
    background:#dcfce7;
    color:#166534;
    padding:0.9rem;
    border-radius:0.5rem;
    margin-bottom:1rem;
}

.links{
    margin-top:1.5rem;
    text-align:center;
}

.links a{
    color:#1e3a8a;
    text-decoration:none;
    font-weight:600;
}

.links a:hover{
    text-decoration:underline;
}

@media(max-width:900px){

.container{
    flex-direction:column;
    width:100%;
}

.left,
.right{
    width:100%;
}

}

</style>
</head>

<body>

<div class="container">

    <!-- LEFT -->

    <div class="left">

        <h1>
        Reset Your Password
        </h1>

        <p>

        Forgot your password?
        Don’t worry.

        Enter your registered email address
        and we’ll send a secure One-Time Password
        to verify your identity safely.

        </p>

        <div class="info">

            <div>
            ✔ Secure OTP Verification
            </div>

            <div>
            ✔ OTP Valid for 2 Minutes
            </div>

            <div>
            ✔ Protected Password Recovery
            </div>

            <div>
            ✔ Safe & Encrypted Authentication
            </div>

        </div>

    </div>

    <!-- RIGHT -->

    <div class="right">

        <h2>
        Forgot Password
        </h2>

        <p class="subtitle">

        Please enter your registered email address
        to continue the password reset process.

        </p>

        <?php
        if(isset($error)){
            echo "<div class='error'>
            $error
            </div>";
        }

        if(isset($success)){
            echo "<div class='success'>
            $success
            <br><br>
            Redirecting to OTP verification...
            </div>";
        }
        ?>

        <form method="POST">

            <input
            type="email"
            name="email"
            placeholder="Enter Registered Email"
            required>

            <button name="send_otp">
            Send Verification OTP
            </button>

        </form>

        <div class="note">

        Make sure you enter the same email address
        used during registration.

        </div>

        <div class="links">

            <a href="login.php">
            ← Back to Login
            </a>

        </div>

    </div>

</div>

</body>
</html>