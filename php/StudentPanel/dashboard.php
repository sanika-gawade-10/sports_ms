<?php
ini_set('session.cookie_lifetime', 0);
ini_set('session.gc_maxlifetime', 1800);

session_start();

if(!isset($_SESSION['student'])){
  header("Location: login.php");
  exit();
}

/* AUTO LOGOUT AFTER 30 MIN */
if(isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 1800)){
  session_unset();
  session_destroy();
  header("Location: login.php");
  exit();
}
$_SESSION['last_activity'] = time();

$user = $_SESSION['student'];

/* PAGE SWITCH */
$page = $_GET['page'] ?? 'home';
?>

<!DOCTYPE html>
<html>
<head>

<title>Student Dashboard</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
body{
  margin:0;
  display:flex;
  font-family:sans-serif;
}

/* SIDEBAR */
.sidebar{
  width:14rem;
  height:100vh;
  position:fixed;
  top:0;
  left:0;
  background:#1e3a8a;
  color:white;
  padding:1rem;
}

.main{
  margin-left:16.3rem;   /* push content right */
  padding:2rem;
  background:#f1f5f9;
  min-height:100vh;
}

.profile{
  text-align:center;
  margin-bottom:2rem;
}

.profile i{
  font-size: 5rem;
}

.profile p{
  font-size: 1.7rem;
}

.menu a{
  display:block;
  padding:0.6rem;
  color:white;
  text-decoration:none;
  margin-top:0.5rem;
  border-radius:0.3rem;
}

.menu a:hover{
  background:#334155;
}

/* MAIN */
.main{
  flex:1;
  padding:2rem;
  background:#f1f5f9;
}
</style>

</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
<br/>
  <div class="profile">
    <i class="fa-solid fa-user-circle"></i>
    <p><?php echo $user; ?></p>
  </div>

  <div class="menu">
    <a href="?page=cc">CC Registration</a>
    <a href="?page=participation">Participation</a>
    <a href="?page=achievements">Achievements</a>
    <a href="logout.php">Logout</a>
  </div>

</div>

<!-- MAIN CONTENT -->
<div class="main">

<?php

/* HOME */
if($page == 'home'){
  echo "<h2>Welcome 👋</h2>";
}

/* CC REGISTRATION (placeholder for now) */
if($page == 'cc'){
  echo "<h2>CC Registration Section</h2>";
}

/* PARTICIPATION */
if($page == 'participation'){
  include "participation.php";
}

/* ACHIEVEMENTS */
if($page == 'achievements'){
  include "achievements.php";
}

?>

</div>

</body>
</html>