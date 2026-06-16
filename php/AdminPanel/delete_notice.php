<?php
include "db.php";

$id = $_GET['id'];

// get file name
$res = $conn->query("SELECT file FROM notices WHERE id=$id");
$row = $res->fetch_assoc();

if($row){
  unlink("../uploads/" . $row['file']); // delete file
}

// delete from DB
$conn->query("DELETE FROM notices WHERE id=$id");

header("Location: dashboard.php?page=notices");
?>