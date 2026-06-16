<?php

include "db.php";

if(!isset($_SESSION['student'])){
  header("Location: login.php");
  exit();
}

/* AUTO LOGOUT */
if(isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 1800)){
  session_unset();
  session_destroy();
  header("Location: login.php");
  exit();
}
$_SESSION['last_activity'] = time();

$user = $_SESSION['student'];

/* PREVIEW */
$preview = $_SESSION['preview'] ?? null;

if(isset($_POST['preview'])){
  $_SESSION['preview'] = $_POST;
  $preview = $_POST;
}

/* SEND */
if(isset($_POST['send']) && isset($_SESSION['preview'])){
  $p = $_SESSION['preview'];

  $conn->query("INSERT INTO participation(name,stream,year,roll,sport,level,event_date,username,is_sent)
  VALUES('{$p['name']}','{$p['stream']}','{$p['year']}','{$p['roll']}','{$p['sport']}','{$p['level']}','{$p['event_date']}','$user',1)");

  unset($_SESSION['preview']);
  $preview = null;
}

/* DELETE */
if(isset($_POST['delete']) && isset($_SESSION['preview'])){
  unset($_SESSION['preview']);
  $preview = null;
}

/* FETCH */
$res = $conn->query("SELECT * FROM participation WHERE username='$user'");
?>

<style>
.card{
  background:white;
  padding:1.2rem;
  margin-bottom:1.5rem;
  border-radius:0.6rem;
  box-shadow:0 0.3rem 0.8rem rgba(0,0,0,0.1);
}

input, select{
  width:100%;
  padding:0.5rem;
  margin-top:0.5rem;
  border:0.05rem solid #ccc;
  border-radius:0.3rem;
}

small{
  color:#9ca3af;
  font-size:0.8rem;
  display:block;
  margin-top:0.2rem;
}

button{
  margin-top:0.7rem;
  padding:0.5rem 1rem;
  border:none;
  border-radius:0.3rem;
  cursor:pointer;
}

.preview-btn{background:#1e3a8a; color:white;}
.send-btn{background:#22c55e; color:white;}
.delete-btn{background:#ef4444; color:white;}

.preview-box{
  margin-top:1rem;
  padding:1rem;
  border:0.08rem dashed #1e3a8a;
  border-radius:0.5rem;
  background:#eef2ff;
}

table{
  width:100%;
  border-collapse:collapse;
}

th, td{
  padding:0.5rem;
  border:0.05rem solid #ccc;
  text-align:center;
}

th{
  background:#1e3a8a;
  color:white;
}

.pending{color:#f59e0b; font-weight:bold;}
.approved{color:#22c55e; font-weight:bold;}
.unapproved{color: #ef4444; font-weight:bold;}

.preview-status{color:#6b7280; font-weight:bold;}
</style>

<h2>Participation</h2>

<div class="card">
<form method="POST">

<input name="name" placeholder="Full Name" required>

<select name="stream" required>
  <option value="">Select Stream</option>
  <option>BSc</option>
  <option>BMS</option>
  <option>BCom</option>
  <option>BAF</option>
  <option>BA</option>
  <option>BMMS</option>
  <option>IT</option>
</select>

<select name="year" required>
  <option value="">Select Class</option>
  <option>FY</option>
  <option>SY</option>
  <option>TY</option>
</select>

<input name="roll" placeholder="Roll No." required>

<input name="sport" placeholder="Enter Sport" required>

<select name="level" required>
  <option value="">Select Level</option>
  <option>College</option>
  <option>State</option>
</select>

<input type="date" name="event_date" max="<?php echo date('Y-m-d'); ?>" required>
<small>Select actual participation date</small>

<button name="preview" class="preview-btn">Preview</button>

</form>

<?php if($preview){ ?>
<div class="preview-box">

<p><b>Name:</b> <?php echo $preview['name']; ?></p>
<p><b>Sport:</b> <?php echo $preview['sport']; ?></p>
<p><b>Date:</b> <?php echo $preview['event_date']; ?></p>

<form method="POST">
<button name="send" class="send-btn">Send</button>
<button name="delete" class="delete-btn">Delete</button>
</form>

</div>
<?php } ?>

</div>

<div class="card">
<h3>Your Participation</h3>

<table>
<tr>
<th>Sport</th>
<th>Level</th>
<th>Date</th>
<th>Status</th>
</tr>

<?php while($row=$res->fetch_assoc()){ ?>
<tr>
<td><?php echo $row['sport']; ?></td>
<td><?php echo $row['level']; ?></td>
<td><?php echo $row['event_date']; ?></td>

<td>
<?php if($row['status']=="Approved"){ ?>
<span class="approved">Approved</span>
<?php } elseif($row['status']=="Unapproved") { ?>
<span class="unapproved">Unapproved</span>
<?php } else { ?>
<span class="pending">Pending</span>
<?php } ?>
</td>

</tr>
<?php } ?>

</table>

</div>