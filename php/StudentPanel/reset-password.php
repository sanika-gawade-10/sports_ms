<?php
session_start();
include "db.php";

if(
!isset($_SESSION['reset_email'])
||
!isset($_SESSION['otp_verified'])
){
    header("Location: forgot.php");
    exit();
}

$email =
$_SESSION['reset_email'];

$getStudent =
$conn->query("
SELECT * FROM students
WHERE email='$email'
");

$student =
$getStudent->fetch_assoc();

$student_id =
$student['id'];

$current_hash =
$student['password'];

if(isset($_POST['reset'])){

    $new =
    trim($_POST['password']);

    // validation
    if(strlen($new) < 8){

        $error =
        "Password must be at least 8 characters.";

    }
    elseif(
    !preg_match("/[0-9]/",$new)
    ||
    !preg_match("/[\W]/",$new)
    ){

        $error =
        "Password must include numbers and symbols.";
    }

    else{

        // current password check
        if(
        password_verify(
        $new,
        $current_hash
        )
        ){

            $error =
            "You cannot reuse your current password!";
        }

        else{

            // password history check
            $history =
            $conn->query("
            SELECT password_hash
            FROM password_history
            WHERE student_id='$student_id'
            ");

            $usedBefore =
            false;

            while(
            $row =
            $history->fetch_assoc()
            ){

                if(
                password_verify(
                $new,
                $row['password_hash']
                )
                ){

                    $usedBefore =
                    true;
                    break;
                }
            }

            if($usedBefore){

                $error =
                "This password has already been used before!";

            } else {

                $new_hash =
                password_hash(
                $new,
                PASSWORD_DEFAULT
                );

                // update password
                $conn->query("
                UPDATE students
                SET password='$new_hash'
                WHERE id='$student_id'
                ");

                // save history
                $conn->query("
                INSERT INTO
                password_history
                (
                student_id,
                password_hash
                )
                VALUES
                (
                '$student_id',
                '$new_hash'
                )
                ");

                // delete otp
                $conn->query("
                DELETE FROM
                password_resets
                WHERE email='$email'
                ");

                unset(
                $_SESSION['otp_verified']
                );

                unset(
                $_SESSION['reset_email']
                );

                $success =
                "Password updated successfully! Redirecting to login...";

                header(
                "refresh:2;url=login.php"
                );
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Reset Password</title>

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
}

body{
font-family:'Segoe UI',
sans-serif;
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

.password-box{
position:relative;
}

.password-box input{
width:100%;
padding:0.9rem;
padding-right:3rem;
border:1px solid #d1d5db;
border-radius:0.5rem;
font-size:1rem;
outline:none;
}

.password-box input:focus{
border-color:#1e3a8a;
}

.eye{
position:absolute;
right:1rem;
top:50%;
transform:translateY(-50%);
cursor:pointer;
font-size:1.2rem;
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

.success{
background:#dcfce7;
color:#166534;
padding:0.9rem;
border-radius:0.5rem;
margin-bottom:1rem;
}

.note{
margin-top:1.5rem;
color:#6b7280;
line-height:1.8;
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
Create New Password
</h1>

<p>

For your account security,
please choose a strong password
that has not been used before.

</p>

<div class="info">

<div>
✔ Minimum 8 Characters
</div>

<div>
✔ Include Numbers
</div>

<div>
✔ Include Special Symbols
</div>

<div>
✔ Previous Passwords Not Allowed
</div>

</div>

</div>

<!-- RIGHT -->

<div class="right">

<h2>
Reset Password
</h2>

<p class="subtitle">

Create a strong password to
secure your Gymkhana Sports Portal account.

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
</div>";
}
?>

<form method="POST">

<div class="password-box">

<input
type="password"
name="password"
id="password"
placeholder="Enter New Password"
required>

<span
class="eye"
onclick="togglePassword()">
👁
</span>

</div>

<button name="reset">
Update Password
</button>

</form>

<div class="note">

Strong Password Requirements:

<br><br>

• At least 8 characters<br>
• Include numbers<br>
• Include special symbols<br>
• Cannot reuse old passwords

</div>

<div class="links">

<a href="login.php">
← Back to Login
</a>

</div>

</div>

</div>

<script>

function togglePassword(){

let password =
document.getElementById(
"password"
);

if(
password.type ===
"password"
){

password.type = "text";

}else{

password.type =
"password";
}

}

</script>

</body>
</html>