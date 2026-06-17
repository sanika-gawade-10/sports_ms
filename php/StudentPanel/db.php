<?php
$conn = new mysqli("db","root","root","sports_db");

if($conn->connect_error){
  die("Connection failed: " . $conn->connect_error);
}
?>