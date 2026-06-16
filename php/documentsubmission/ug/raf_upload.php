<?php
if(isset($_FILES['passing_certificate']) && isset($_FILES['marksheet'])&& isset($_FILES['transfer_certificate']) && isset($_FILES['aadhar_card']) && isset($_FILES['gap_certificate'])&& isset($_FILES['fee_receipt'])) {
    $targetDir = "rac_upload/";
    
    $passingCertificate = $targetDir . basename($_FILES['passing_certificate']['name']);
    $marksheet = $targetDir . basename($_FILES['marksheet']['name']);
    $transfer = $targetDir . basename($_FILES['transfer_certificate']['name']);
    $aadharCard = $targetDir . basename($_FILES['aadhar_card']['name']);
    $gapCertificate = $targetDir . basename($_FILES['gap_certificate']['name']);
    $feeReceipt = $targetDir . basename($_FILES['fee_receipt']['name']);
    
    if(move_uploaded_file($_FILES['passing_certificate']['tmp_name'], $passingCertificate) &&
       move_uploaded_file($_FILES['marksheet']['tmp_name'], $marksheet) &&
       move_uploaded_file($_FILES['transfer_certificate']['tmp_name'],$transfer) &&
       move_uploaded_file($_FILES['aadhar_card']['tmp_name'], $aadharCard) &&
       move_uploaded_file($_FILES['gap_certificate']['tmp_name'], $gapCertificate)&&
       move_uploaded_file($_FILES['fee_receipt']['tmp_name'], $feeReceipt))
       {
           echo "<script>alert('Certificates uploaded successfully!');</script>";
    } else {
        echo "<script>alert('Error uploading certificates.');</script>";
    }
}
?>