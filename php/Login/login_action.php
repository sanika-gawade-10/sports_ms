<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'config.php';

    $emailid = $_POST["emailid"];
    $password = $_POST["password"];
  
    $stmt = $db->prepare("SELECT * FROM students WHERE email= ? AND password= ?");
    $stmt->bindParam(1, $emailid);
    $stmt->bindParam(2, $password);
    
    $stmt->execute();

    $result = $stmt->fetchAll();
    $num = count($result);

    if ($num == 1) {
        echo "  
            <div style='margin-top: 20px; font-family: Arial, sans-serif;'>
                <h2>Login Successful!!</h2>
                <p>Please proceed to the following link for payment:</p>
                <a href='/sports_ms/payment.html' style='color: blue;'>Go to Payment Page</a>
            </div>";
    } else {
        echo 'Your email or password is incorrect!';
    }
    $stmt->closeCursor();
}
?>