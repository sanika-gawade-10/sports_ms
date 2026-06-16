<?php
$conn = new mysqli("db","root","root","sports_ms");

if($conn->connect_error){
  die("Connection failed: " . $conn->connect_error);
}
?>