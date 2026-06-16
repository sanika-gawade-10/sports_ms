<?php
if(isset($_FILES['passing_certificate']) && isset($_FILES['marksheet'])&& isset($_FILES['transfer_certificate']) && isset($_FILES['aadhar_card']) && isset($_FILES['gap_certificate'])) {
    $targetDir = "rac_upload/";
    
    $passingCertificate = $targetDir . basename($_FILES['passing_certificate']['name']);
    $marksheet = $targetDir . basename($_FILES['marksheet']['name']);
    $transfer = $targetDir . basename($_FILES['transfer_certificate']['name']);
    $aadharCard = $targetDir . basename($_FILES['aadhar_card']['name']);
    $gapCertificate = $targetDir . basename($_FILES['gap_certificate']['name']);
    
    if(move_uploaded_file($_FILES['passing_certificate']['tmp_name'], $passingCertificate) &&
       move_uploaded_file($_FILES['marksheet']['tmp_name'], $marksheet) &&
       move_uploaded_file($_FILES['transfer_certificate']['tmp_name'],$transfer) &&
       move_uploaded_file($_FILES['aadhar_card']['tmp_name'], $aadharCard) &&
       move_uploaded_file($_FILES['gap_certificate']['tmp_name'], $gapCertificate)) {

        echo "  
            <div style='margin-top: 20px; font-family: Arial, sans-serif;'>
                <h2>Doucmentation Successful!!</h2>
                <p>Please proceed to the following link to login:</p>
                <a href='/sports_ms/login' style='color: blue;'>Login Page</a>
            </div>";
    } else {
        echo 'Something went wrong while uploading the documents.';
    }
} else {
    echo 'Error: All the documents must be uploaded.';
}
?>