<?php
include "db.php";

$id=$_GET['id'];

if(isset($_POST['update'])){
  $sport=$_POST['sport'];
  $level=$_POST['level'];

  $conn->query("UPDATE participation SET sport='$sport', level='$level' WHERE id=$id");

  header("Location: dashboard.php");
}

$res=$conn->query("SELECT * FROM participation WHERE id=$id");
$row=$res->fetch_assoc();
?>

<form method="POST">
<select name="sport">
  <option>Cricket</option>
  <option>Football</option>
</select>

<select name="level">
  <option>College</option>
  <option>State</option>
</select>

<button name="update">Update</button>
</form>