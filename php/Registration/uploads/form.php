<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Student Admission form with PDF preview able..</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="style.css">
<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<style>
    .error-message {
        color: red; /* Set error message color to red */
    }
</style>
</head>
<body>
<div class="container">
<div class="row">
  <div class="col-sm-2">
  </div>
  <div class="col-sm-8" style="border: 2px solid black;padding:5px; text-align: center;">
   <h1>Registration Form </h1>
  </div>
  <div class="col-sm-2">
  </div>
  </div>
  <div class="row">
  <div class="col-sm-1">
  </div>
    <div class="col-sm-10" style="border: 0px solid black; padding:80px;">
      <form action="form_action.php" method="post" enctype="multipart/form-data">
<div class="row">
    <div class="col-sm-6">
      <div class="mb-3 row">
   <div class="col-sm-4">
      <label class="lable">First Name :- </label>
    </div>
     <div class="col-sm-8">
      <input type="text" name="fname" class="form-control" required>
    </div>
    </div>
    <div class="mb-3 row">
   <div class="col-sm-4">
      <label class="lable">Last Name :- </label>
    </div>
     <div class="col-sm-8">
      <input type="text" name="lname" class="form-control" required>
    </div>
    </div>
    <div class="mb-3 row">
   <div class="col-sm-4">
      <label class="lable">Student_ID:-</label>
    </div>
     <div class="col-sm-8">
      <input type="text" name="uid" class="form-control" required>
    </div>
    </div>
    <div class="mb-3 row">
   <div class="col-sm-4">
      <label class="lable">Address:- </label>
    </div>
     <div class="col-sm-8">
     <textarea name="address" class="form-control" required></textarea>
    </div>
    </div>
    <div class="mb-3 row">
   <div class="col-sm-4">
      <label class="lable">Email:- </label>
    </div>
     <div class="col-sm-8">
      <input type="text" name="email" class="form-control" required>
    </div>
    </div>
    <div class="mb-3 row">
        <div class="col-sm-4">
            <label class="password">Password :- </label>
        </div>
        <div class="col-sm-8">
            <input type="password" id="password" name="password" class="form-control" required minlength="8" maxlength="8">
            <div id="password-error" class="error-message"></div>
        </div>
    </div>
    <div class="mb-3 row">
   <div class="col-sm-4">
      <label class="lable">Mobile No:- </label>
    </div>
     <div class="col-sm-8">
      <input type="text" name="mobile" maxlength="10" class="form-control" required>
    </div>
    </div>
    <div class="mb-3 row">
    <div class="col-sm-4">
        <label class="label">DOB :- </label>
    </div>
    <div class="col-sm-8">
        <input type="date" name="dob" id="dob" class="form-control" required>
        <div id="dob-error" class="error-message"></div>
    </div>
</div>

    <div class="mb-3 row">
   <div class="col-sm-4">
      <label class="lable">Category:- </label>
    </div>
     <div class="col-sm-8">
     <select name="category"  class="form-control" required>
      <option value="">Select your category</option>
        <option value="SC">ST</option>
        <option value="ST">SC</option>
        <option value="OBC">OBC</option>
        <option value="General">General</option>
     </select>
    </div>
    </div>
<div class="mb-3 row">
   <div class="col-sm-4">
      <label class="lable">Gender :- </label>
    </div>
     <div class="col-sm-8">
     <select name="gender" class="form-control" required>
      <option value="">Select Gender</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
        <option value="Other">Other</option>
     </select>
    </div>
    </div>
    <div class="mb-3 row">
   <div class="col-sm-4">
      <label class="lable">Choose Sports:-</label>
    </div>
     <div class="col-sm-8">
     <select name="sports" class="form-control" required>
      <option value="">Select Sports</option>
        <option value="Chess">Chess</option>
        <option value="Badminton">Badminton</option>
        <option value="Aquatic">Aquatic</option>
        <option value="Cross Country">Cross Country</option>
        <option value="Foot Ball">Foot Ball</option>
        <option value="Basket Ball">Basket Ball</option>
        <option value="KhoKho">KhoKho</option>
        <option value="Tennis">Tennis</option>
        <option value="Tug Of War">Tug Of War</option>
        <option value="Kabaddi">Kabaddi</option>
        <option value="Volleyball">Volleyball</option>
        <option value="Boxing">Boxing</option>
        <option value="Cycling">Cycling</option>
        <option value="Athletics">Athletics</option>
        <option value="Cricket">Cricket</option>
        <option value="Shooting">Shooting</option>
        <option value="Judo">Judo</option>
        <option value="Archery">Archery</option>
        <option value="Power Lifting">Power Lifting</option>
        <option value="Best Phisque">Best Phisque</option>
        <option value="Table Tennis">Table Tennis</option>
        <option value="Fencing">Fencing</option>
        <option value="Carrom">Carrom</option>
        <option value="Taekwondo">Taekwondo</option>
        <option value="Yogasana">Yogasana</option>
        <option value="Water Polo">Water Polo</option>
        <option value="Weight Lifting">Weight Lifting</option>
        <option value="Base Ball">Base Ball</option>
        <option value="Half Marathon">Half Marathon</option>
        <option value="Hand Ball">Hand Ball</option>
        <option value="Squash">Squash</option>
        <option value="Hockey">Hockey</option>
        <option value="Ball Badminton">Ball Badminton</option>
        <option value="Soft Ball">Soft Ball</option>
        <option value="Ascending & Descending">Ascending & Descending</option>
        <option value="Wrestling">Wrestling</option>

     </select>
    </div>
    </div>
    </div>
    <div class="col-sm-6">
  <div class="row">
    <div class="col-sm-12">
    <div class="form-group" style="float: right;">
         <label class="lable"> Photo </label>
   <div style="border: 1px solid black; height: 150px; width: 150px;  background: #F5FAFF;">
      <img id="output"  width="150" height="150" / style="display:none">
  </div>

    <input type="file" name="image" id="image" onchange="loadFile(event)" class="form-control" required accept="image/*" / style="width:150px;" required>

<script>
  var loadFile = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById('output');
      output.src = reader.result;
    }; 

  $('#output').show();
    reader.readAsDataURL(event.target.files[0]);
  };
</script>
  </div>
  </div>
  </div>  



  <br> 
  <div class="row">
    <div class="col-sm-12">
      <div class="form-group" style="float: right;">
         <label class="lable">Signature</label>
   <div style="border: 1px solid black; height: 120px; width: 150px;  background: #F5FAFF;">
      <img id="outputs"  width="150" height="120" / style="display:none">
  </div>
    <input type="file" id="simage" name="sign"  onchange="loadFiles(event)" class="form-control" required accept="image/*" / style="width:150px;" required>
<script>
  var loadFiles = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById('outputs');
      output.src = reader.result;
    }; 

  $('#outputs').show();
    reader.readAsDataURL(event.target.files[0]);
  };
</script>

  </div>  
    </div>
  </div>
    </div>
</div> <!--Row 1 end --> 
  <br>
     <div class="row">
     <div class="col-sm-2">
      <label class="lable"></label>
    </div>
    <div class="col-sm-8"> 
 <div id="msg-price"> </div>
    </div>
  </div> <!-- Row 5 end -->
     <div class="row">
     <div class="col-sm-2">
      <label class="lable">Declaration </label>
    </div>
    <div class="col-sm-8">
      <div style=""><div id="msg-price"> </div></div>
      
      <div style="border: 2px solid black;padding:10px; text-align: center;border-radius: 25px;">
        <input type="checkbox" name="declare" required>
 I declare that I have read and filled the above information, so if the information given by me is incorrect, you have the right to cancel without informing me.
    </div>
      <div class="form-group row">
        <div class="col-sm-4">
        </div>
           <div class="col-sm-4">
            <br> 
               <button class="btn btn-success" name="form_submit">Submit </button>
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


<script>
// JavaScript code
document.getElementById('dob').addEventListener('input', function() {
    var dobInput = this.value;
    var dob = new Date(dobInput);
    var currentDate = new Date();
    
    if (dob > currentDate) {
        document.getElementById('dob-error').innerText = "Date of Birth cannot be a future date";
        this.setCustomValidity("Date of Birth cannot be a future date");
    } else {
        document.getElementById('dob-error').innerText = "";
        this.setCustomValidity("");
    }
});

// Function to handle password input events for real-time validation
  document.getElementById('password').addEventListener('input', function () {
        const password = this.value;

        if (password.length !== 8) {
            document.getElementById('password-error').innerText = "Password should be exactly 8 characters long";
        } else {
            document.getElementById('password-error').innerText = "";
        }
    });

    // Function to handle form submission validation
    function validateForm() {
        const password = document.getElementById('password').value;

        return password.length === 8;
    }

    // Attach form submission validation
    document.getElementById('password-form').addEventListener('submit', function (e) {
        if (!validateForm()) {
            e.preventDefault(); // Prevent form submission if validation fails
        }
        
    });

</script>
</body>
</html>