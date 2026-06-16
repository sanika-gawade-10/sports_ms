<?php
include ("admin_config.php");
$id = $_GET['id'];
$query = "DELETE FROM students WHERE student_id = '$id'";
$data = $db->prepare($query);
$data->execute();

if($data->rowCount() > 0) {
    echo "Record Deleted";
} else{
    echo "Failed To Delete";
}
?>