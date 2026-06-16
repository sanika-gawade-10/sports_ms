<?php
include "db.php";

if(!isset($_SESSION['admin'])){
  header("Location: login.php");
  exit();
}

/* ================= GET FILTER VALUES ================= */
$stream = $_POST['stream'] ?? '';
$year   = $_POST['year'] ?? '';
$sport  = $_POST['sport'] ?? '';
$level  = $_POST['level'] ?? '';
$roll   = $_POST['roll'] ?? '';
$time   = $_POST['time_filter'] ?? '';

/* ================= FILTER ================= */
$where = "WHERE 1=1";

if($stream != "") $where .= " AND stream='$stream'";
if($year != "")   $where .= " AND year='$year'";
if($sport != "")  $where .= " AND sport LIKE '%$sport%'";
if($level != "")  $where .= " AND level='$level'";
if($roll != "")   $where .= " AND roll='$roll'";

/* ===== TIME FILTER (FIXED CORRECT LOGIC) ===== */
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

$res = $conn->query("SELECT * FROM achievements $where ORDER BY id DESC");
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

/* IMAGE */
.thumb{
  width:60px;
  height:60px;
  object-fit:cover;
  border-radius:5px;
  cursor:pointer;
}

/* BUTTONS */
.btn{
  padding:5px 10px;
  border-radius:5px;
  color:white;
  text-decoration:none;
  margin:2px;
}

.approve{background:#22c55e;}
.unapprove{background: #ef4444;}

/* POPUP */
#modal{
  display:none;
  position:fixed;
  top:0;left:0;
  width:100%;height:100%;
  background:rgba(0,0,0,0.9);
  justify-content:center;
  align-items:center;
}

#modal img{
  max-width:80%;
  max-height:80%;
}

.nav{
  position:absolute;
  top:50%;
  transform:translateY(-50%);
  font-size:30px;
  color:white;
  cursor:pointer;
}

.left{left:20px;}
.right{right:20px;}
</style>

<h2>🏆 Student Achievements</h2>

<!-- FILTER -->
<div class="card">
<form method="POST">

<select name="stream">
<option value="">Stream</option>
<option <?php if($stream=="BSc") echo "selected"; ?>>BSc</option>
<option <?php if($stream=="BMS") echo "selected"; ?>>BMS</option>
<option <?php if($stream=="BCom") echo "selected"; ?>>BCom</option>
</select>

<select name="year">
<option value="">Class</option>
<option <?php if($year=="FY") echo "selected"; ?>>FY</option>
<option <?php if($year=="SY") echo "selected"; ?>>SY</option>
<option <?php if($year=="TY") echo "selected"; ?>>TY</option>
</select>

<input name="roll" placeholder="Roll" value="<?php echo $roll; ?>">
<input name="sport" placeholder="Sport" value="<?php echo $sport; ?>">

<select name="level">
<option value="">Level</option>
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

<button>Filter</button>

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
<th>Date</th>
<th>Description</th>
<th>Image</th>
<th>Status</th>
</tr>

<?php while($row=$res->fetch_assoc()){ ?>
<tr>

<td><?php echo $row['name']; ?></td>
<td><?php echo $row['stream']; ?></td>
<td><?php echo $row['year']; ?></td>
<td><?php echo $row['roll']; ?></td>
<td><?php echo $row['sport']; ?></td>
<td><?php echo $row['level']; ?></td>
<td><?php echo date("d M Y", strtotime($row['event_date'])); ?></td>
<td><?php echo $row['description']; ?></td>

<td>
<?php
if(!empty($row['images'])){
$imgs = explode(",", $row['images']);
foreach($imgs as $i=>$img){ ?>
<img class="thumb"
onclick='openImg(<?php echo json_encode($imgs); ?>,<?php echo $i; ?>)'
src="../uploads/<?php echo $img; ?>">
<?php }} ?>
</td>

<td>
<?php if($row['status']=="Approved"){ ?>
✔
<?php } elseif($row['status']=="Unapproved"){ ?>
❌
<?php } else { ?>
<a class="btn approve" href="approve_achievements.php?id=<?php echo $row['id']; ?>">Approve</a>
<a class="btn unapprove" href="unapprove_achievements.php?id=<?php echo $row['id']; ?>">Unapprove</a>
<?php } ?>
</td>

</tr>
<?php } ?>

</table>
</div>

<!-- POPUP -->
<div id="modal" onclick="closeImg(event)">
<span class="nav left" onclick="prev(event)">❮</span>
<img id="modalImg">
<span class="nav right" onclick="next(event)">❯</span>
</div>

<script>
let imgs=[],index=0;

function openImg(arr,i){
  imgs=arr;
  index=i;
  document.getElementById("modal").style.display="flex";
  show();
}

function show(){
  document.getElementById("modalImg").src="../uploads/"+imgs[index];
}

function next(e){
  e.stopPropagation();
  index=(index+1)%imgs.length;
  show();
}

function prev(e){
  e.stopPropagation();
  index=(index-1+imgs.length)%imgs.length;
  show();
}

function closeImg(e){
  if(e.target.id==="modal"){
    document.getElementById("modal").style.display="none";
  }
}

/* SWIPE */
let startX=0;
document.getElementById("modal").addEventListener("touchstart",e=>{
startX=e.touches[0].clientX;
});

document.getElementById("modal").addEventListener("touchend",e=>{
let endX=e.changedTouches[0].clientX;

if(startX-endX>50) next(e);
if(endX-startX>50) prev(e);
});
</script>