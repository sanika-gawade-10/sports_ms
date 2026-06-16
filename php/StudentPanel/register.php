<?php
include "db.php";

if(isset($_POST['register'])){

  $name = trim($_POST['name']);
  $class = trim($_POST['class']);
  $roll = trim($_POST['roll']);
  $email = trim($_POST['email']);
  $user = trim($_POST['username']);
  $pass = trim($_POST['password']);

  if(strlen($pass) < 8){
    $error = "Password must be at least 8 characters!";
  }
  elseif(
    !preg_match("/[A-Z]/",$pass) ||
    !preg_match("/[a-z]/",$pass) ||
    !preg_match("/[0-9]/",$pass) ||
    !preg_match("/[\W]/",$pass)
  ){
    $error = "Password must contain uppercase, lowercase, number and special character!";
  }
  else{

    $checkUser = $conn->query(
      "SELECT * FROM students WHERE username='$user'"
    );

    $checkEmail = $conn->query(
      "SELECT * FROM students WHERE email='$email'"
    );

    if($checkUser->num_rows > 0){
      $error = "Username already exists!";
    }
    elseif($checkEmail->num_rows > 0){
      $error = "Email already registered!";
    }
    else{

      $hash = password_hash($pass, PASSWORD_DEFAULT);

      $conn->query("
        INSERT INTO students
        (name,class,roll,email,username,password)
        VALUES
        ('$name','$class','$roll','$email','$user','$hash')
      ");

      $studentId = $conn->insert_id;

      $conn->query("
        INSERT INTO password_history
        (student_id,password_hash)
        VALUES
        ('$studentId','$hash')
      ");

      header("Location: login.php");
      exit();
    }
  }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Student Registration</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>

/* Base */
html{
  font-size:16px;
}

body{
  margin:0;
  font-family:'Segoe UI', sans-serif;
  height:100vh;
  display:flex;
}

/* LEFT SIDE */
.left{
  flex:1;
  background:linear-gradient(135deg,#1e3a8a,#2563eb);
  color:white;
  display:flex;
  flex-direction:column;
  justify-content:center;
  align-items:center;
  padding:2rem;
  text-align:center;
}

.left h1{
  font-size:2rem;
  margin-bottom:1rem;
}

.left p{
  font-size:1rem;
  opacity:0.9;
}

/* RIGHT SIDE */
.right{
  flex:1;
  display:flex;
  justify-content:center;
  align-items:center;
  background:#f8fafc;
}

/* FORM BOX */
.box{
  background:white;
  padding:2rem;
  width:22rem;
  border-radius:1rem;
  box-shadow:0 0.6rem 1.5rem rgba(0,0,0,0.15);
}

h2{
  text-align:center;
  margin-bottom:1rem;
}

input{
  width:100%;
  padding:0.7rem;
  margin-top:0.7rem;
  border:0.08rem solid #ccc;
  border-radius:0.4rem;
  outline:none;
  box-sizing:border-box;
}

.password-box{
  position:relative;
  margin-top:0.7rem;
}

.password-box input{
  margin-top:0;
  padding-right:3rem;
}

.toggle-password{
  position:absolute;
  right:1rem;
  top:50%;
  transform:translateY(-50%);
  cursor:pointer;
  color:#666;
  font-size:1rem;
}

button{
  width:100%;
  padding:0.7rem;
  margin-top:1rem;
  border:none;
  border-radius:0.5rem;
  background:#1e3a8a;
  color:white;
  font-weight:bold;
  cursor:pointer;
  transition:0.3s;
}

button:hover{
  background:#2563eb;
}

.error{
  color:red;
  font-size:0.9rem;
  margin-bottom:0.8rem;
  text-align:center;
}

</style>
</head>

<body>

<!-- LEFT SIDE -->
<div class="left">
  <h1>🎓 Join Sports Portal</h1>
  <p>Register yourself to track participation, achievements & events.</p>
</div>

<!-- RIGHT SIDE -->
<div class="right">

<div class="box">

  <h2>📝 Registration</h2>

  <?php if(isset($error)) echo "<div class='error'>$error</div>"; ?>

  <form method="POST">

    <input
      name="name"
      placeholder="Full Name"
      required
    >

    <input
      name="class"
      placeholder="TYBScIT"
      required
    >

    <input
      name="roll"
      placeholder="Roll No."
      required
    >

    <input
      type="email"
      name="email"
      placeholder="College Email"
      required
    >

    <input
      name="username"
      placeholder="Set Username"
      required
    >

    <div class="password-box">

      <input
        type="password"
        id="password"
        name="password"
        placeholder="Set Password"
        required
      >

      <i
        class="fa-solid fa-eye-slash toggle-password"
        id="togglePassword">
      </i>

    </div>

    <button name="register">
      Register
    </button>

  </form>

</div>

</div>

<script>

const togglePassword =
document.getElementById("togglePassword");

const password =
document.getElementById("password");

togglePassword.addEventListener("click", function(){

    if(password.type === "password"){

        password.type = "text";

        this.classList.remove("fa-eye-slash");
        this.classList.add("fa-eye");

    }
    else{

        password.type = "password";

        this.classList.remove("fa-eye");
        this.classList.add("fa-eye-slash");
    }

});

</script>

</body>
</html>