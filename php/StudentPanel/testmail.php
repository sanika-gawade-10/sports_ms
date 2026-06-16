<?php

require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

try{

    $mail->isSMTP();

    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;

    // YOUR GMAIL
    $mail->Username = 'gymkhana104@gmail.com';

    // APP PASSWORD (paste without spaces)
    $mail->Password = 'ervbywymttdudpef';

    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom(
        'gymkhana104@gmail.com',
        'Gymkhana Portal'
    );

    // where you want to receive email
    $mail->addAddress('gymkhana104@gmail.com');

    $mail->Subject =
    'Gymkhana Portal Test';

    $mail->Body =
    'Congratulations! Email sending is working successfully.';

    $mail->send();

    echo "Email Sent Successfully";

}
catch(Exception $e){

    echo "Error: " . $mail->ErrorInfo;

}
?>