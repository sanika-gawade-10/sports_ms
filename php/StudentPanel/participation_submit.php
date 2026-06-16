<?php
session_start();
include "db.php";

$user=$_SESSION['student'];

$name=$_POST['name'];
$class=$_POST['class'];
$roll=$_POST['roll'];
$sport=$_POST['sport'];
$level=$_POST['level'];

$conn->query("INSERT INTO participation(name,class,roll,sport,level,username)
VALUES('$name','$class','$roll','$sport','$level','$user')");

header("Location: dashboard.php");
?>