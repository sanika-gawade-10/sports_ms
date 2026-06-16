<?php
include "db.php";

if(!isset($_SESSION['student'])){
  header("Location: login.php");
  exit();
}

$user = $_SESSION['student'];

/* ================= PREVIEW ================= */
$preview = $_SESSION['ach_preview'] ?? null;

if(isset($_POST['preview'])){

  $images = [];

  $uploadDir = "../uploads/";
  if(!is_dir($uploadDir)){
    mkdir($uploadDir, 0777, true);
  }

  // 3 FILE INPUTS
  $fileInputs = ['image1','image2','image3'];

  foreach($fileInputs as $input){
    if(isset($_FILES[$input]) && $_FILES[$input]['name'] != ""){
      $fileName = time().'_'.str_replace(" ","_",$_FILES[$input]['name']);
      move_uploaded_file($_FILES[$input]['tmp_name'], $uploadDir.$fileName);
      $images[] = $fileName;
    }
  }

  $_POST['images'] = $images;

  $_SESSION['ach_preview'] = $_POST;
  $preview = $_POST;
}

/* ================= EDIT ================= */
if(isset($_POST['edit'])){
  $preview = $_SESSION['ach_preview'];
}

/* ================= DELETE ================= */
if(isset($_POST['delete'])){
  unset($_SESSION['ach_preview']);
  $preview = null;
}

/* ================= SEND ================= */
if(isset($_POST['send']) && isset($_SESSION['ach_preview'])){

  $p = $_SESSION['ach_preview'];

  $imgs = isset($p['images']) ? implode(",", $p['images']) : "";

  $stmt = $conn->prepare("INSERT INTO achievements
  (name,stream,year,roll,sport,level,event_date,description,images,username)
  VALUES (?,?,?,?,?,?,?,?,?,?)");

  $stmt->bind_param(
    "ssssssssss",
    $p['name'],$p['stream'],$p['year'],$p['roll'],$p['sport'],
    $p['level'],$p['event_date'],$p['description'],$imgs,$user
  );

  $stmt->execute();

  unset($_SESSION['ach_preview']);
  $preview = null;
}

/* ================= FETCH ================= */
$res = $conn->query("SELECT * FROM achievements WHERE username='$user' ORDER BY id DESC");
?>

<style>
.card{
  background:white;
  padding:1.2rem;
  margin-bottom:1.5rem;
  border-radius:0.6rem;
  box-shadow:0 0.3rem 0.8rem rgba(0,0,0,0.1);
}

input, select, textarea{
  width:100%;
  padding:0.5rem;
  margin-top:0.5rem;
  border:0.05rem solid #ccc;
  border-radius:0.3rem;
}

textarea{ height:80px; }

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

.preview-btn{background:#1e3a8a;color:white;}
.send-btn{background:#22c55e;color:white;}
.delete-btn{background:#ef4444;color:white;}
.edit-btn{background:#f59e0b;color:white;}

.preview-box{
  margin-top:1rem;
  padding:1rem;
  border:0.08rem dashed #1e3a8a;
  border-radius:0.5rem;
  background:#eef2ff;
}

.preview-img{
  display:flex;
  gap:0.5rem;
  margin-top:0.5rem;
}

.preview-img img{
  width:70px;
  height:70px;
  object-fit:cover;
  border-radius:5px;
}

/* ===== HORIZONTAL ACHIEVEMENTS ===== */
.gallery{
  display:flex;
  flex-direction:column;
  gap:1rem;
}

.ach-card{
  display:flex;
  justify-content:space-between;
  align-items:center;
  background:white;
  padding:1rem;
  border-radius:0.6rem;
  box-shadow:0 0.2rem 0.6rem rgba(0,0,0,0.1);
}

.ach-content{
  flex:1;
}

.ach-content small{
  color:#6b7280;
}

.ach-images{
  display:flex;
  gap:0.5rem;
}

.ach-images img{
  width:80px;
  height:80px;
  object-fit:cover;
  border-radius:6px;
  cursor:pointer;
}

/* POPUP */
#imgModal{
  display:none;
  position:fixed;
  top:0;
  left:0;
  width:100%;
  height:100%;
  background:rgba(0,0,0,0.85);
  justify-content:center;
  align-items:center;
  z-index:999;
}

#modalImg{
  max-width:80%;
  max-height:80%;
  border-radius:10px;
}

.nav{
  position:absolute;
  top:50%;
  transform:translateY(-50%);
  font-size:2.5rem;
  color:white;
  cursor:pointer;
}

.left{left:25px;}
.right{right:25px;}
</style>

<h2>🏆 Achievements</h2>

<!-- FORM -->
<div class="card">

<form method="POST" enctype="multipart/form-data">

<input name="name" placeholder="Full Name"
value="<?php echo $preview['name'] ?? ''; ?>" required>

<select name="stream">
<option>BSc</option><option>BMS</option><option>BCom</option>
</select>

<select name="year">
<option>FY</option><option>SY</option><option>TY</option>
</select>

<input name="roll" placeholder="Roll No"
value="<?php echo $preview['roll'] ?? ''; ?>">

<input name="sport" placeholder="Sport"
value="<?php echo $preview['sport'] ?? ''; ?>">

<select name="level">
<option>College</option><option>State</option>
</select>

<input type="date" name="event_date"
value="<?php echo $preview['event_date'] ?? ''; ?>">

<small>Select actual participation date</small>

<textarea name="description"
placeholder="Describe achievement"><?php echo $preview['description'] ?? ''; ?></textarea>

<!-- 3 FILE INPUTS -->
<input type="file" name="image1" required>
<input type="file" name="image2">
<input type="file" name="image3">
<small>Upload minimum 1 and maximum 3 images</small>

<button name="preview" class="preview-btn">Preview</button>

</form>

</div>

<!-- PREVIEW -->
<?php if($preview){ ?>
<div class="card">

<h3>Preview</h3>

<p><b><?php echo $preview['sport']; ?></b></p>
<p><?php echo $preview['description']; ?></p>

<div class="preview-img">
<?php 
if(!empty($preview['images'])){
  foreach($preview['images'] as $img){ ?>
    <img src="../uploads/<?php echo $img; ?>">
<?php }} ?>
</div>

<form method="POST">
<button name="send" class="send-btn">Send</button>
<button name="edit" class="edit-btn">Edit</button>
<button name="delete" class="delete-btn">Delete</button>
</form>

</div>
<?php } ?>

<!-- ACHIEVEMENTS -->
<div class="card">
<h3>Your Achievements</h3>

<div class="gallery">

<?php while($row=$res->fetch_assoc()){ ?>

<div class="ach-card">

<div class="ach-content">
<b><?php echo $row['sport']; ?></b><br>
<small><?php echo date("d M Y", strtotime($row['event_date'])); ?></small>
<p><?php echo $row['description']; ?></p>
</div>

<div class="ach-images">
<?php 
if(!empty($row['images'])){
  $imgs = explode(",", $row['images']);
  foreach($imgs as $i => $img){ ?>
    <img src="../uploads/<?php echo $img; ?>"
         onclick='openGallery(<?php echo json_encode($imgs); ?>, <?php echo $i; ?>)'>
<?php }} ?>
</div>

</div>

<?php } ?>

</div>

</div>

<!-- POPUP -->
<div id="imgModal" onclick="closeGallery(event)">
  <span class="nav left" onclick="prevImg(event)">❮</span>
  <img id="modalImg">
  <span class="nav right" onclick="nextImg(event)">❯</span>
</div>

<script>
let images = [];
let currentIndex = 0;

function openGallery(imgArray, index){
  images = imgArray;
  currentIndex = index;
  document.getElementById("imgModal").style.display = "flex";
  showImage();
}

function showImage(){
  document.getElementById("modalImg").src = "../uploads/" + images[currentIndex];
}

function nextImg(e){
  e.stopPropagation();
  currentIndex = (currentIndex + 1) % images.length;
  showImage();
}

function prevImg(e){
  e.stopPropagation();
  currentIndex = (currentIndex - 1 + images.length) % images.length;
  showImage();
}

function closeGallery(e){
  if(e.target.id === "imgModal"){
    document.getElementById("imgModal").style.display = "none";
  }
}

/* SWIPE */
let startX = 0;

document.getElementById("imgModal").addEventListener("touchstart", e=>{
  startX = e.touches[0].clientX;
});

document.getElementById("imgModal").addEventListener("touchend", e=>{
  let endX = e.changedTouches[0].clientX;

  if(startX - endX > 50) nextImg(e);
  if(endX - startX > 50) prevImg(e);
});
</script>