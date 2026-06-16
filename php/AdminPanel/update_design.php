<?php
include ("admin_config.php");
$id = $_GET['id'];
$query = "SELECT * FROM students where student_id = '$id'";
$data = $db->query($query);
$total = $data->rowCount();
$result = $data->fetch(PDO::FETCH_ASSOC)
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Admission form with PDF preview able..</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    
    <script>
        document.getElementById("registrationForm").addEventListener("submit", function(e){
            var firstName = this.fname.value;
            var lastName = this.lname.value;
            var regex = /^[A-Za-z]+$/;
            
            if(!(regex.test(firstName) && regex.test(lastName))){
                alert("Invalid input in First Name or Last Name");
                e.preventDefault();
            }
             var studentId = document.querySelector('#registrationForm input[name="uid"]').value;
        var studentIdRegex = /^[0-9]{5,}$/;
        var email = document.querySelector('#registrationForm input[name="email"]').value;
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!studentIdRegex.test(studentId)) {
            alert('Student ID must be a number and at least 5 digits long');
            return false;
        }

        if (!emailRegex.test(email)) {
            alert('Invalid Email');
            return false;
        }

        return true;
    });
        
    

    </script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth()+1; 
        var yyyy = today.getFullYear() - 18; // Subtract 18 years from the current year.
        var maxYear = today.getFullYear();

        if(dd<10) {
            dd = '0'+dd;
        } 

        if(mm<10) {
            mm = '0'+mm;
        }

        var minDate = yyyy + '-' + mm + '-' + dd;
        var maxDate = maxYear + '-' + mm + '-' + dd;

        document.getElementById("dob").setAttribute("min", minDate);
        document.getElementById("dob").setAttribute("max", maxDate);
    });
</script>
  <script>
function validateForm() {
    var inputs = document.querySelectorAll('#registrationForm input');
    var selects = document.querySelectorAll('#registrationForm select');
    var textarea = document.querySelector('#registrationForm textarea');
    var checkboxes = document.querySelectorAll('#registrationForm input[type="checkbox"]');
    var formElements = [...inputs, ...selects, textarea, ...checkboxes];
    var password = document.querySelector('#registrationForm input[name="password"]').value;
var regex = /^(?=.\d)(?=.[a-z])(?=.[A-Z])(?=.[^a-zA-Z0-9]).{8,20}$/;

if (!regex.test(password)) {
    alert('Password should be between 8 to 20 characters, include at least 1 uppercase letter, 1 lowercase letter, 1 numeric digit, and 1 special character');
    return false;
}
    for (var i = 0; i < formElements.length; i++) {
        if (formElements[i].value === '' && formElements[i].required) {
            alert('All fields must be filled out');
            return false;
        }
    }

}
</script>
</head>
<body>
<div class="container">
<div class="row">
  <div class="col-sm-2">
  </div>
  <div class="col-sm-8" style="border: 2px solid black;padding:5px; text-align: center;">
   <h1>Update Form </h1>
  </div>
  <div class="col-sm-2">
  </div>
  </div>
  <div class="row">
  <div class="col-sm-1">
  </div>
    <div class="col-sm-10" style="border: 0px solid black; padding:80px;">
      <form action="update_action.php" method="post" enctype="multipart/form-data" id="registrationForm" onsubmit="return validateForm()">
<div class="row">
    <div class="col-sm-6">
      <div class="mb-3 row">
   <div class="col-sm-4">
      <label class="lable">First Name :- </label>
    </div>
     <div class="col-sm-8">
      <input type="text" name="fname" value="<?php echo $result['first_name'] ?>" class="form-control" pattern="[A-Za-z]+" title="Please enter only alphabets" required>
    </div>
    </div>
    <div class="mb-3 row">
   <div class="col-sm-4">
      <label class="lable">Last Name :- </label>
    </div>
     <div class="col-sm-8">
     <input type="text" name="lname" value="<?php echo $result['last_name'] ?>" class="form-control" pattern="[A-Za-z]+" title="Please enter only alphabets" required>
    </div>
    </div>
    <div class="mb-3 row">
   <div class="col-sm-4">
      <label class="lable">Student_ID:-</label>
    </div>
     <div class="col-sm-8">
      <input type="text" name="uid" value="<?php echo $result['student_id'] ?>"  class="Student ID must" placeholder="Enter your student ID"  required>

    </div>
    <div class="mb-3 row">
   <div class="col-sm-4">
      <label class="lable">Address:- </label>
    </div>
     <div class="col-sm-8">
     <textarea name="address" value=" echo $result['address'] ?>" class="form-control" required><?php  echo $result['address']; ?></textarea>
    </div>
    </div>
    <div class="mb-3 row">
   <div class="col-sm-4">
      <label class="lable">Email:- </label>
    </div>
     <div class="col-sm-8">
      <input type="email" name="email" value="<?php echo $result['email']?>" class="form-control" required>
    </div>
    </div>
    <div class="mb-3 row">
   <div class="col-sm-4">
      <label class="password">Password:-</label>
    </div>
     <div class="col-sm-8">
      <input type="password" name="password" value="<?php echo $result['password']?>" class="form-control" title="Password should be between 8 to 20 characters, include at least 1 uppercase letter, 1 lowercase letter, 1 numeric digit, and 1 special character" required>
    </div>
    </div>
    <div class="mb-3 row">
   <div class="col-sm-4">
      <label class="lable">Mobile No:- </label>
    </div>
     <div class="col-sm-8">
      <input type="text" name="mobile" value="<?php echo $result['mobile']?>"maxlength="10" class="form-control" required>
    </div>
    </div>
<div class="mb-3 row">
   <div class="col-sm-4">
      <label class="lable">DOB:- </label>
    </div>
     <div class="col-sm-8" >
      <input type="date" name="dob" value="<?php echo $result['dob']?>" id="dob" class="form-control"required>
    </div>
    </div>
    <div class="mb-3 row">
   <div class="col-sm-4">
      <label class="lable">Category:- </label>
    </div>
     <div class="col-sm-8">
     <select name="category" value="<?php echo $result['category']?>" class="form-control" required>
      <option value="">Select your category</option>
        <option value="SC"
           <?php 
           if($result['category']=='SC'){
            echo "selected";
           }
        ?>
        >ST</option>
        <option value="ST"
          <?php 
           if($result['category']=='ST'){
            echo "selected";
           }
        ?>
        >ST</option>
        <option value="OBC"
             <?php 
           if($result['category']=='SC'){
            echo "selected";
           }
        ?>
        >OBC</option>
        <option value="General"
        <?php 
           if($result['category']=='General'){
            echo "selected";
           }
        ?>
        >General</option>
     </select>
    </div>
    </div>
<div class="mb-3 row">
   <div class="col-sm-4">
      <label class="lable">Gender :- </label>
    </div>
     <div class="col-sm-8">
     <select name="gender" value="<?php echo $result['gender']?>" class="form-control" required>
      <option value="">Select Gender</option>
        <option value="Male"
        <?php 
           if($result['gender']=='Male'){
            echo "selected";
           }
        ?>
        >Male</option>
        <option value="Female"
        <?php 
           if($result['gender']=='Female'){
            echo "selected";
           }
        ?>
        >Female</option>
        <option value="Other">Other</option>
     </select>
    </div>
    </div>
    <div class="mb-3 row">
   <div class="col-sm-4">
      <label class="lable">Choose Sports:-</label>
    </div>
     <div class="col-sm-8">
     <select name="sports" value="<?php echo $result['sports']?>" class="form-control" required>
      <option value="">Select Sports</option>
        <option value="Chess"
         <?php 
   if(strcasecmp(trim($result['sports']), 'Chess') == 0){
    echo "selected";
   }
?>
        >Chess</option>
        <option value="Badminton"
        <?php 
   if(strcasecmp(trim($result['sports']), 'Badminton') == 0){
    echo "selected";
   }
?>
        >Badminton</option>
        <option value="Aquatic"
        <?php 
   if(strcasecmp(trim($result['sports']), 'Aquatic') == 0){
    echo "selected";
   }
?>
        >Aquatic</option>
        <option value="Cross Country"
        <?php 
   if(strcasecmp(trim($result['sports']), 'Cross Country') == 0){
    echo "selected";
   }
?>
        >Cross Country</option>
        <option value="Foot Ball"
        <?php 
   if(strcasecmp(trim($result['sports']), 'Foot Ball') == 0){
    echo "selected";
   }
?>
        >Foot Ball</option>
        <option value="Basket Ball"
         <?php 
   if(strcasecmp(trim($result['sports']), 'Basket Ball') == 0){
    echo "selected";
   }
?>
        >Basket Ball</option>
        <option value="KhoKho"
        <?php 
   if(strcasecmp(trim($result['sports']), 'KhoKho') == 0){
    echo "selected";
   }
?>
        >KhoKho</option>
        <option value="Tennis"
        <?php 
   if(strcasecmp(trim($result['sports']), 'Tennis') == 0){
    echo "selected";
   }
?>
        >Tennis</option>
        <option value="Tug Of War"
        <?php 
   if(strcasecmp(trim($result['sports']), 'Tug Of War') == 0){
    echo "selected";
   }
?>
        >Tug Of War</option>
        <option value="Kabaddi"
        <?php 
   if(strcasecmp(trim($result['sports']), 'Kabaddi') == 0){
    echo "selected";
   }
?>
        >Kabaddi</option>
        <option value="Volleyball"
        <?php 
   if(strcasecmp(trim($result['sports']), 'Volleyball') == 0){
    echo "selected";
   }
?>
        >Volleyball</option>
        <option value="Boxing"
        <?php 
   if(strcasecmp(trim($result['sports']), 'Boxing') == 0){
    echo "selected";
   }
?>
        >Boxing</option>
        <option value="Cycling"
        <?php 
   if(strcasecmp(trim($result['sports']), 'Cycling') == 0){
    echo "selected";
   }
?>
        >Cycling</option>
        <option value="Athletics"
        <?php 
   if(strcasecmp(trim($result['sports']), 'Athletics') == 0){
    echo "selected";
   }
?>
        >Athletics</option>
        <option value="Cricket"
        <?php 
   if(strcasecmp(trim($result['sports']), 'Cricket') == 0){
    echo "selected";
   }
?>
        >Cricket</option>
        <option value="Shooting"
        <?php 
   if(strcasecmp(trim($result['sports']), 'Shooting') == 0){
    echo "selected";
   }
?>
        >Shooting</option>
        <option value="Judo"
        <?php 
   if(strcmp($result['sports'], 'Judo') == 0){
    echo "selected";
   }
?>>Judo</option>
        <option value="Archery"
        <?php 
   if(strcasecmp(trim($result['sports']), 'Archery') == 0){
    echo "selected";
   }
?>
        >Archery</option>
        <option value="Power Lifting"
        <?php 
   if(strcasecmp(trim($result['sports']), 'Power Lifting') == 0){
    echo "selected";
   }
?>>Power Lifting</option>
        <option value="Best Phisque"
        <?php 
   if(strcasecmp(trim($result['sports']), 'Best Phisque') == 0){
    echo "selected";
   }
?>>Best Phisque</option>
        <option value="Table Tennis"
        <?php 
   if(strcasecmp(trim($result['sports']), 'Table Tennis') == 0){
    echo "selected";
   }
?>>Table Tennis</option>
        <option value="Fencing"
        <?php 
   if(strcasecmp(trim($result['sports']), 'Fencing') == 0){
    echo "selected";
   }
?>>Fencing</option>
        <option value="Carrom"
        <?php 
   if(strcasecmp(trim($result['sports']), 'Carrom') == 0){
    echo "selected";
   }
?>>Carrom</option>
        <option value="Taekwondo"
        <?php 
   if(strcasecmp(trim($result['sports']), 'Taekwondo') == 0){
    echo "selected";
   }
?>>Taekwondo</option>
        <option value="Yogasana"
        <?php 
   if(strcasecmp(trim($result['sports']), 'Yogasana') == 0){
    echo "selected";
   }
?>>Yogasana</option>
        <option value="Water Polo"<?php 
   if(strcasecmp(trim($result['sports']), 'Water Polo') == 0){
    echo "selected";
   }
?>>Water Polo</option>
        <option value="Weight Lifting"<?php 
   if(strcasecmp(trim($result['sports']), 'Weight Lifting') == 0){
    echo "selected";
   }
?>>Weight Lifting</option>
        <option value="Base Ball"<?php 
   if(strcasecmp(trim($result['sports']), 'Base Ball') == 0){
    echo "selected";
   }
?>>Base Ball</option>
        <option value="Half Marathon"<?php 
   if(strcasecmp(trim($result['sports']), 'Half Marathon') == 0){
    echo "selected";
   }
?>>Half Marathon</option>
        <option value="Hand Ball"<?php 
   if(strcasecmp(trim($result['sports']), 'Hand Ball') == 0){
    echo "selected";
   }
?>>Hand Ball</option>
        <option value="Squash"<?php 
   if(strcasecmp(trim($result['sports']), 'Squash') == 0){
    echo "selected";
   }
?>>Squash</option>
        <option value="Hockey"<?php 
   if(strcasecmp(trim($result['sports']), 'Hockey') == 0){
    echo "selected";
   }
?>>Hockey</option>
        <option value="Ball Badminton"<?php 
   if(strcasecmp(trim($result['sports']), 'Ball Badminton') == 0){
    echo "selected";
   }
?>>Ball Badminton</option>
        <option value="Soft Ball"<?php 
   if(strcasecmp(trim($result['sports']), 'Soft Ball') == 0){
    echo "selected";
   }
?>>Soft Ball</option>
        <option value="Ascending & Descending"<?php 
   if(strcasecmp(trim($result['sports']), 'Ascending & Descending') == 0){
    echo "selected";
   }
?>>Ascending & Descending</option>
        <option value="Wrestling"<?php 
   if(strcasecmp(trim($result['sports']), 'Wrestling') == 0){
    echo "selected";
   }
?>>Wrestling</option>

     </select>
    </div>
    </div>
    </div>
    <div class="col-sm-4">
            <br> 
               <button class="btn btn-success" name="update">Update </button>
           </div>
           <div class="col-sm-4">
           </div>
      </div> 
    </div>
  </div> <!-- Row 5 end --> 
</form>
</div>
<div class="col-sm-2">
  </div>
</div>
</div>
</body>

</html>