<?php
include "db.php";

$id = $_GET['id'];

$conn->query("UPDATE participation SET status='Approved' WHERE id=$id");

header("Location: dashboard.php?page=participation");
?>