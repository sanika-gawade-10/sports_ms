<?php
require_once "admin_config.php";

if (isset($_POST['update'])) {
    $fname = filter_input(INPUT_POST, 'fname', FILTER_SANITIZE_STRING);
    $lname = filter_input(INPUT_POST, 'lname', FILTER_SANITIZE_STRING);
    $uid = filter_input(INPUT_POST, 'uid', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_DEFAULT);
    $gender = filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_STRING);
    $dob = filter_input(INPUT_POST, 'dob', FILTER_SANITIZE_STRING);
    $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);
    $category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_STRING);
    $sports = filter_input(INPUT_POST, 'sports', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $mobile = filter_input(INPUT_POST, 'mobile', FILTER_SANITIZE_STRING);

    $query = "UPDATE students SET first_name = :fname,
                                  last_name = :lname, 
                                  password = :password, 
                                  gender = :gender, 
                                  dob = :dob, 
                                  address = :address, 
                                  category = :category, 
                                  sports = :sports, 
                                  email = :email, 
                                  mobile = :mobile
                              WHERE student_id = :uid";
    
    $stmt = $db->prepare($query); 

    // Binding Parameters
    $stmt->bindParam(':fname', $fname, PDO::PARAM_STR);
    $stmt->bindParam(':lname', $lname, PDO::PARAM_STR);
    $stmt->bindParam(':uid', $uid, PDO::PARAM_STR);
    $stmt->bindParam(':password', $password, PDO::PARAM_STR);
    $stmt->bindParam(':gender', $gender, PDO::PARAM_STR);
    $stmt->bindParam(':dob', $dob, PDO::PARAM_STR);
    $stmt->bindParam(':address', $address, PDO::PARAM_STR);
    $stmt->bindParam(':category', $category, PDO::PARAM_STR);
    $stmt->bindParam(':sports', $sports, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':mobile', $mobile, PDO::PARAM_STR);

    // Executing Query
    if($stmt->execute()) {
        echo "<script>alert('Record Updated'); window.location.href='http://localhost/sports_ms/AdminPanel/display.php';</script>";
    } else {
        echo "Failed to Update";
    }
}
?>
