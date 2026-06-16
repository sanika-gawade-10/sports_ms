<?php  
require('../admin/inc/db_config.php');
require('../admin/inc/essentials.php');



if(isset($_POST['register']))
{
    $data = filteration($_POST);

    // match password and  confirm password field

    if($data['pass'] != $data['cpass']){
        echo 'pass_mismatch';
        exit;
    }

    // check user exists or not

    $u_exist = select("SELECT * FROM `user_cred` WHERE `email` = ? AND `phonenum` = ? LIMIT 1",
     [$data['email'],$data['phonenum']],"ss");

     if(mysqli_num_rows($u_exist)!=0){
        $u_exist_fetch = mysqli_fetch_assoc($u_exist);
        echo ($u_exist_fetch['email']== $data['email']) ? 'email_already' : 'phone_already';
        exit;
     }

     // upload user image to server

     $img = uploadUserImage($_FILES['profile']);

     if($img == 'inv_img'){
        echo 'inv_img';
        exit;
     }
     else if($img == 'upd_failed'){
        echo 'upd_failed';
        exit;
     }

     
}

if(isset($_POST['login']))
{
   $data = filteration($_POST);

   $u_exist = select("SELECT * FROM `user_cred` WHERE `email` = ? AND `phonenum` = ? LIMIT 1",
   [$data['email_mob'],$data['email_mob']],"ss");

   if(mysqli_num_rows($u_exist==0)){
      echp 'inv_email_mob';
      exit;
     
   }
   else{
   $u_fetch = mysqli_fetch_assoc($u_exist);
   if($u_fetch['is_verified']==0){
      echo 'not_verified';
   }
   else{
      if(!password_verify($data['pass'],$u_fetch['password']))
      echo 'invalid_pass';

   }
else{
   session_start();
   $_SESSION['login'] = true;
   $_SESSION['uId'] = $u_fetch['id'];
   $_SESSION['uName'] = $u_fetch['name'];
   $_SESSION['uPic'] = $u_fetch['picture'];
   $_SESSION['uMobile'] = $u_fetch['mobile'];
   echo 1;
}
   }
   
}


?>