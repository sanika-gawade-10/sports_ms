<?php
ini_set('session.cookie_lifetime', 0);
ini_set('session.gc_maxlifetime', 1800);

session_start();

if(!isset($_SESSION['admin'])){
  header("Location: login.php");
  exit();
}

/* AUTO LOGOUT */
if(isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 1800)){
  session_unset();
  session_destroy();
  header("Location: login.php");
  exit();
}
$_SESSION['last_activity'] = time();

$user = $_SESSION['admin'];   // ✅ SAME LIKE STUDENT

$page = $_GET['page'] ?? 'home';
?>

<!DOCTYPE html>
<html>
<head>

<title>Admin Dashboard</title>

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
  background: #1e3a8a;
  color:white;
  padding:1rem;
}

/* PROFILE */
.profile{
  text-align:center;
  margin-bottom:2rem;
}

.profile i{
  font-size:5rem;
}

.profile p{
  font-size:1.5rem;
  margin-top:0.5rem;
}

/* MENU */
.menu a{
  display:block;
  padding:0.6rem;
  color:white;
  text-decoration:none;
  margin-top:0.5rem;
  border-radius:0.3rem;
}

.menu a:hover{
  background: #334155;
}

/* MAIN */
.main{
  margin-left:16.3rem;
  padding:2rem;
  padding-top:3rem;   /* adjust as you like */
  background: #f1f5f9;
  min-height:100vh;
  width:100%;
  box-sizing:border-box;
}

</style>

</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
<br/>
  <div class="profile">
    <i class="fa-solid fa-user-circle"></i>
    <p>Admin Panel</p>
  </div>

  <div class="menu">
    <a href="?page=cc">CC Registration</a>
    <a href="?page=participation">Participation</a>
    <a href="?page=achievements">Achievements</a>
    <a href="?page=notices">Notices</a>
    <a href="logout.php">Logout</a>

  </div>

</div>

<!-- MAIN -->
<div class="main">

<?php

if($page == 'home'){
  echo "<h2>Welcome Admin 👨‍💼</h2>";
}

if($page == 'participation'){
  include "participation.php";
}

if($page == 'achievements'){
  include "achievements.php";
}

if($page == 'notices'){
  include "notices.php";
}
?>

</div>

</body>
</html>