<?php
include "db.php";

if(isset($_GET['id'])){
  $id = $_GET['id'];

  $conn->query("UPDATE achievements SET status='Approved' WHERE id=$id");

  header("Location: dashboard.php?page=achievements"); // SAME PAGE
}
?>