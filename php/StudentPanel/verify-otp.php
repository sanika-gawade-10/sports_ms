<?php
session_start();
include "db.php";

if(!isset($_SESSION['reset_email'])){
    header("Location: forgot.php");
    exit();
}

$email = $_SESSION['reset_email'];

if(isset($_POST['verify'])){

    $otp = trim($_POST['otp']);

    $check = $conn->query("
        SELECT * FROM password_resets
        WHERE email='$email'
        AND otp='$otp'
        AND created_at >=
        NOW() - INTERVAL 2 MINUTE
    ");

    if($check->num_rows > 0){

        $_SESSION['otp_verified'] = true;

        header(
        "Location: reset-password.php"
        );
        exit();

    } else {

        $error =
        "Invalid or Expired OTP!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Verify OTP</title>

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
    box-shadow:
    0 0.7rem 2rem
    rgba(0,0,0,0.12);
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

.info div{
    background:
    rgba(255,255,255,0.08);

    padding:1rem;

    border-left:
    4px solid #facc15;

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
    line-height:1.7;
    margin-bottom:1.5rem;
}

.timer-box{
    background:#eff6ff;
    border-left:
    4px solid #2563eb;
    padding:1rem;
    border-radius:0.5rem;
    margin-bottom:1.5rem;
}

#timer{
    color:#dc2626;
    font-size:1.3rem;
    font-weight:bold;
}

input{
    width:100%;
    padding:0.9rem;
    border:1px solid #d1d5db;
    border-radius:0.5rem;
    margin-top:0.8rem;
    font-size:1rem;
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
    cursor:pointer;
    font-size:1rem;
    font-weight:600;
}

button:hover{
    background:#2563eb;
}

.error{
    background:#fee2e2;
    color:#dc2626;
    padding:0.9rem;
    border-radius:0.5rem;
    margin-bottom:1rem;
}

.note{
    margin-top:1.5rem;
    color:#6b7280;
    line-height:1.7;
}

.links{
    margin-top:1.5rem;
}

.links a{
    color:#1e3a8a;
    text-decoration:none;
    font-weight:600;
}

@media(max-width:900px){

.container{
    flex-direction:column;
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
Identity Verification
</h1>

<p>

We’ve sent a secure
One-Time Password (OTP)
to your registered email.

Please verify your identity
to continue securely.

</p>

<div class="info">

<div>
✔ OTP Valid for 2 Minutes
</div>

<div>
✔ Secure Account Verification
</div>

<div>
✔ Password Reset Protection
</div>

<div>
✔ Safe Authentication Process
</div>

</div>

</div>

<!-- RIGHT -->

<div class="right">

<h2>
Verify OTP
</h2>

<p class="subtitle">

Please enter the 6-digit
verification code sent to
your registered email address.

</p>

<div class="timer-box">

OTP expires in:

<div id="timer">
02:00
</div>

</div>

<?php
if(isset($error)){
echo "<div class='error'>
$error
</div>";
}
?>

<form method="POST">

<input
type="text"
name="otp"
maxlength="6"
placeholder="Enter 6-digit OTP"
required>

<button name="verify">
Verify OTP
</button>

</form>

<div class="note">

Didn't receive OTP?

Please check your spam folder
or request a new OTP.

</div>

<div class="links">

<a href="forgot.php">
← Back
</a>

</div>

</div>

</div>

<script>

let time = 60;

let timer =
document.getElementById("timer");

let countdown =
setInterval(function(){

let minutes =
Math.floor(time/60);

let seconds =
time % 60;

timer.innerHTML =
`${minutes.toString()
.padStart(2,'0')}:${
seconds.toString()
.padStart(2,'0')}`;

time--;

if(time < 0){

clearInterval(countdown);

timer.innerHTML =
"Expired";

alert(
"OTP expired! Please generate a new OTP."
);

window.location =
"forgot.php";
}

},1000);

</script>

</body>
</html>