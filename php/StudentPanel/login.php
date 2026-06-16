<?php
session_start();
include "db.php";

if(isset($_POST['login'])){
  $u = trim($_POST['username']);
  $p = trim($_POST['password']);

  // prepared statement (safe)
  $stmt = $conn->prepare("SELECT * FROM students WHERE username=?");
  $stmt->bind_param("s", $u);
  $stmt->execute();
  $res = $stmt->get_result();

  if($res->num_rows > 0){
    $row = $res->fetch_assoc();

    // ✅ correct for hashed password
    if(password_verify($p, $row['password'])){
      $_SESSION['student'] = $row['username'];
      header("Location: dashboard.php");
      exit();
    } else {
      $error = "Wrong password!";
    }

  } else {
    $error = "User not found!";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login as Student</title>

<style>
html{
  font-size:16px;
}

body{
  margin:0;
  font-family:'Segoe UI', sans-serif;
  height:100vh;
  display:flex;
  justify-content:center;
  align-items:center;
  position:relative;
}

/* Background */
body::before{
  content:"";
  position:absolute;
  top:0;
  left:0;
  width:100%;
  height:100%;
  background:url("../images/A-Z%20Sports/adminimg.png") no-repeat center/cover;
  filter:brightness(0.6);
  z-index:-1;
}

/* Card */
.container{
  background:rgba(255,255,255,0.15);
  backdrop-filter:blur(0.75rem);
  padding:2rem;
  width:20rem;
  border-radius:1rem;
  box-shadow:0 0.6rem 1.8rem rgba(0,0,0,0.3);
  text-align:center;
  color:white;
}

h2{
  margin-bottom:1.2rem;
  font-size:1.5rem;
}

input{
  width:100%;
  padding:0.75rem;
  margin-top:0.75rem;
  border:none;
  border-radius:0.5rem;
  outline:none;
  font-size:0.9rem;
}

button{
  width:100%;
  padding:0.75rem;
  margin-top:1rem;
  border:none;
  border-radius:0.5rem;
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

.links{
  margin-top:0.8rem;
}

.links a{
  color:#facc15;
  text-decoration:none;
}

.links a:hover{
  text-decoration:underline;
}

.error{
  background:#ef4444;
  padding:0.5rem;
  border-radius:0.4rem;
  margin-bottom:0.6rem;
}
</style>

</head>

<body>

<div class="container">
  <h2>🎓 Login as Student</h2>

  <?php if(isset($error)) echo "<div class='error'>$error</div>"; ?>

  <form method="POST">
    <input name="username" placeholder="👤 Enter Username" required>
    <input type="password" name="password" placeholder="🔒 Enter Password" required>
    <button name="login">Login</button>
  </form>

  <div class="links">
    Not registered? <a href="register.php">Register</a><br>
    <a href="forgot.php">Forgot Password?</a>
  </div>
</div>

</body>
</html>