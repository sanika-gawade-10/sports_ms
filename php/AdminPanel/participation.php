<?php
include "db.php";

if(!isset($_SESSION['admin'])){
  header("Location: login.php");
  exit();
}

/* ================= GET VALUES ================= */
$stream = $_POST['stream'] ?? '';
$year   = $_POST['year'] ?? '';
$sport  = $_POST['sport'] ?? '';
$level  = $_POST['level'] ?? '';
$roll   = $_POST['roll'] ?? '';
$time   = $_POST['time_filter'] ?? '';

/* ================= FILTER ================= */
$where = "WHERE is_sent=1";

if($stream != "") $where .= " AND stream='$stream'";
if($year != "")   $where .= " AND year='$year'";
if($sport != "")  $where .= " AND sport LIKE '%$sport%'";
if($level != "")  $where .= " AND level='$level'";
if($roll != "")   $where .= " AND roll='$roll'";

/* ================= TIME FILTER ================= */
if($time == "day"){
  $where .= " AND DATE(event_date) = CURDATE()";
}
elseif($time == "week"){
  $where .= " AND YEARWEEK(event_date,1) = YEARWEEK(CURDATE(),1)";
}
elseif($time == "month"){
  $where .= " AND MONTH(event_date)=MONTH(CURDATE()) AND YEAR(event_date)=YEAR(CURDATE())";
}
elseif($time == "year"){
  $where .= " AND YEAR(event_date)=YEAR(CURDATE())";
}

/* ================= FETCH ================= */
$res = $conn->query("SELECT * FROM participation $where ORDER BY id DESC");
?>

<style>
.card{
  background:white;
  padding:1.2rem;
  border-radius:0.6rem;
  box-shadow:0 0.3rem 0.8rem rgba(0,0,0,0.1);
  margin-bottom:1rem;
}

select, input, button{
  padding:0.5rem;
  margin-right:0.5rem;
  border-radius:0.3rem;
  border:0.05rem solid #ccc;
}

button{
  background:#1e3a8a;
  color:white;
  border:none;
  cursor:pointer;
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
.unapproved{color:#ef4444; font-weight:bold;}

/* buttons */
.btn{
  padding:5px 10px;
  border-radius:5px;
  text-decoration:none;
  color:white;
  margin:2px;
}

.btn-approve{background:#22c55e;}
.btn-unapprove{background:#ef4444;}
</style>

<h2>Participation Requests</h2>

<!-- FILTER -->
<div class="card">
<form method="POST">

<select name="stream">
  <option value="">Select Stream</option>
  <option <?php if($stream=="BSc") echo "selected"; ?>>BSc</option>
  <option <?php if($stream=="BMS") echo "selected"; ?>>BMS</option>
  <option <?php if($stream=="BCom") echo "selected"; ?>>BCom</option>
  <option <?php if($stream=="BAF") echo "selected"; ?>>BAF</option>
  <option <?php if($stream=="BA") echo "selected"; ?>>BA</option>
  <option <?php if($stream=="BMMS") echo "selected"; ?>>BMMS</option>
  <option <?php if($stream=="IT") echo "selected"; ?>>IT</option>
</select>

<select name="year">
  <option value="">Select Class</option>
  <option <?php if($year=="FY") echo "selected"; ?>>FY</option>
  <option <?php if($year=="SY") echo "selected"; ?>>SY</option>
  <option <?php if($year=="TY") echo "selected"; ?>>TY</option>
</select>

<input name="roll" placeholder="Roll No" value="<?php echo $roll; ?>">

<input name="sport" placeholder="Enter Sport" value="<?php echo $sport; ?>">

<select name="level">
  <option value="">Select Level</option>
  <option <?php if($level=="College") echo "selected"; ?>>College</option>
  <option <?php if($level=="State") echo "selected"; ?>>State</option>
</select>

<select name="time_filter">
  <option value="">All Time</option>
  <option value="day" <?php if($time=="day") echo "selected"; ?>>Today</option>
  <option value="week" <?php if($time=="week") echo "selected"; ?>>This Week</option>
  <option value="month" <?php if($time=="month") echo "selected"; ?>>This Month</option>
  <option value="year" <?php if($time=="year") echo "selected"; ?>>This Year</option>
</select>

<button name="generate">Generate Report</button>

</form>
</div>

<!-- TABLE -->
<div class="card">

<table>

<tr>
<th>Name</th>
<th>Stream</th>
<th>Class</th>
<th>Roll</th>
<th>Sport</th>
<th>Level</th>
<th>Event Date</th>
<th>Status</th>
<th>Action</th>
</tr>

<?php if($res->num_rows > 0){ 
while($row = $res->fetch_assoc()){ ?>

<tr>
<td><?php echo $row['name']; ?></td>
<td><?php echo $row['stream']; ?></td>
<td><?php echo $row['year']; ?></td>
<td><?php echo $row['roll']; ?></td>
<td><?php echo $row['sport']; ?></td>
<td><?php echo $row['level']; ?></td>
<td><?php echo $row['event_date']; ?></td>

<td>
<?php if($row['status']=="Approved"){ ?>
  <span class="approved"> Approved</span>
<?php } elseif($row['status']=="Unapproved"){ ?>
  <span class="unapproved"> Unapproved</span>
<?php } else { ?>
  <span class="pending">Pending</span>
<?php } ?>
</td>

<td>

<?php if($row['status']=="Approved"){ ?>
  ✔
<?php } elseif($row['status']=="Unapproved"){ ?>
  ❌
<?php } else { ?>

  <a class="btn btn-approve"
     href="approve_participation.php?id=<?php echo $row['id']; ?>">
     Approve
  </a>

  <a class="btn btn-unapprove"
     href="unapprove_participation.php?id=<?php echo $row['id']; ?>">
     Unapprove
  </a>

<?php } ?>

</td>

</tr>

<?php } } else { ?>

<tr>
<td colspan="9">No data found</td>
</tr>

<?php } ?>

</table>

</div>