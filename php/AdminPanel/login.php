<?php
session_start();
include "db.php";

if(isset($_POST['login'])){
  $u=$_POST['username'];
  $p=$_POST['password'];

$res = $conn->query("SELECT * FROM admin WHERE username='$u'");

if($res->num_rows>0){
  $row = $res->fetch_assoc();

  if($p == $row['password']){   // simple for now
    $_SESSION['admin']=$u;
    header("Location: dashboard.php");
  } else {
    $error="Wrong password!";
  }

} else {
  $error="User not found!";
} 

}
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Login</title>

<style>
body{
  margin:0;
  font-family:'Segoe UI', sans-serif;
  height:100vh;
  display:flex;
  justify-content:center;
  align-items:center;
  position:relative;
}

/* Background Image + Overlay */
body::before{
  content:"";
  position:absolute;
  top:0;
  left:0;
  width:100%;
  height:100%;
  background: url("../images/A-Z%20Sports/adminimg.png") no-repeat center center/cover;
  filter:brightness(0.6);
  z-index:-1;
}

/* Glass Card */
.container{
  background:rgba(255,255,255,0.15);
  backdrop-filter:blur(12px);
  padding:35px;
  width:320px;
  border-radius:15px;
  box-shadow:0 10px 30px rgba(0,0,0,0.3);
  text-align:center;
  color:white;
}

/* Heading */
h2{
  margin-bottom:20px;
}

/* Inputs */
input{
  width:100%;
  padding:12px;
  margin-top:12px;
  border:none;
  border-radius:8px;
  outline:none;
  font-size:14px;
}

/* Button */
button{
  width:100%;
  padding:12px;
  margin-top:15px;
  border:none;
  border-radius:8px;
  background:#facc15;
  color:#1e3a8a;
  font-weight:bold;
  cursor:pointer;
  transition:0.3s;
}

button:hover{
  transform:scale(1.05);
  background:#fde047;
}

/* Error */
.error{
  background:#ef4444;
  padding:8px;
  border-radius:6px;
  margin-bottom:10px;
  font-size:14px;
}
</style>
</head>

<body>

<div class="container">
  <h2>🔐 Admin Login</h2>

  <?php if(isset($error)) echo "<div class='error'>$error</div>"; ?>

  <form method="POST">
    <input name="username" placeholder="👤 Username" required>
    <input type="password" name="password" placeholder="🔒 Password" required>
    <button name="login">Login</button>
  </form>
</div>

</body>
</html>