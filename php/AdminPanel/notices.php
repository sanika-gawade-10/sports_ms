<?php include "db.php"; ?>

<style>
body{
  background:#f1f5f9;
  font-family:Segoe UI;
}

/* FORM */
.form-box{
  background:white;
  padding:1.5rem;
  border-radius:0.8rem;
  max-width:32rem;
  margin:auto;
  box-shadow:0 0.5rem 1.5rem rgba(0,0,0,0.1);
}

input{
  width:90%;
  font-size:1rem;
  padding:0.8rem;
  margin-top:0.6rem;
  border-radius:0.4rem;
}

button{
  width:100%;
  background:#2563eb;
  color: white;
  font-size:1rem;
  padding:0.8rem;
  margin-top:0.6rem;
  border-radius:0.4rem;
  border:none;
  cursor:pointer;
}

/* GRID */
.container{
  margin-top:2rem;
  display:grid;
  grid-template-columns:repeat(auto-fill,minmax(20rem,1fr));
  gap:1.2rem;
}

/* CARD */
.card{
  background:white;
  padding: 1.5rem;
  border-radius:0.8rem;
  box-shadow:0 0.4rem 1rem rgba(0,0,0,0.1);
}

.card img{
  width:100%;
  height:10rem;
  object-fit:cover;
  border-radius:0.5rem;
}

.title{
  font-weight:bold;
  margin:0.6rem 0;
  font-size:1rem;
}

/* BUTTONS (HORIZONTAL FIXED) */
.actions{
  display:flex;
  gap:0.8rem;
  margin-top:0.8rem;
}

.btn{
  flex:1;
  padding:0.7rem;
  border:none;
  border-radius:0.5rem;
  cursor:pointer;
  color:white;
  font-size:0.9rem;
  font-weight:500;
  text-align:center;
}

.preview{ background:#22c55e; }
.download{ background:#3b82f6; }
.delete{ background:#ef4444; }

/* HOVER */
.btn:hover{
  transform:scale(1.05);
  transition:0.2s;
}

/* MODAL */
.modal{
  display:none;
  position:fixed;
  top:0;
  left:0;
  width:100%;
  height:100%;
  background:rgba(0,0,0,0.7);
  justify-content:center;
  align-items:center;
  z-index:1000;
}

.modal img{
  max-width:80%;
  max-height:80%;
  border-radius:0.5rem;
}

.close{
  position:absolute;
  top:1rem;
  right:2rem;
  font-size:2rem;
  color:white;
  cursor:pointer;
}
</style>

<div class="form-box">
  <h2>Upload Notice</h2>

  <form action="upload_notice.php" method="POST" enctype="multipart/form-data">
    <input type="text" name="title" placeholder="Enter title" required>
    <input type="file" name="file" required>
    <button>Upload</button>
  </form>
</div>

<div class="container">

<?php
$res = $conn->query("SELECT * FROM notices ORDER BY id DESC");

while($row = $res->fetch_assoc()){

  $file = $row['file'];
  $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
?>

<div class="card">

<?php
if(in_array($ext,['jpg','jpeg','png','gif'])){
  echo "<img src='../uploads/$file'>";
}else{
  echo "<img src='https://cdn-icons-png.flaticon.com/512/337/337946.png'>";
}
?>

<div class="title"><?php echo $row['title']; ?></div>

<div class="actions">

<!-- PREVIEW -->
<?php if(in_array($ext,['jpg','jpeg','png','gif'])){ ?>
<button class="btn preview" onclick="openModal('../uploads/<?php echo $file; ?>')">
  Preview
</button>
<?php } else { ?>
<a href="../uploads/<?php echo $file; ?>" target="_blank">
  <button class="btn preview">Preview</button>
</a>
<?php } ?>

<!-- DOWNLOAD -->
<a href="../uploads/<?php echo $file; ?>" download>
  <button class="btn download">Download</button>
</a>

<!-- DELETE -->
<a href="delete_notice.php?id=<?php echo $row['id']; ?>">
  <button class="btn delete">Delete</button>
</a>

</div>

</div>

<?php } ?>

</div>

<!-- IMAGE PREVIEW MODAL -->
<div class="modal" id="modal">
  <span class="close" onclick="closeModal()">×</span>
  <img id="modalImg">
</div>

<script>
function openModal(src){
  document.getElementById("modal").style.display="flex";
  document.getElementById("modalImg").src=src;
}

function closeModal(){
  document.getElementById("modal").style.display="none";
}
</script>