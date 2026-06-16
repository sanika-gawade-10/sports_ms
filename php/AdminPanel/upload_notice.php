<?php
include "db.php";

$title = $_POST['title'];

$fileName = $_FILES['file']['name'];
$tmp = $_FILES['file']['tmp_name'];

$newName = time() . "_" . $fileName;

// move file
move_uploaded_file($tmp, "../uploads/" . $newName);

// insert into DB
$conn->query("INSERT INTO notices (title, file) VALUES ('$title', '$newName')");

// redirect
header("Location: dashboard.php?page=notices");
?>