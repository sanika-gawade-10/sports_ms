<?php include("../AdminPanel/db.php"); ?>

<!DOCTYPE html>
<html>
<head>
<title>All Notices</title>

<style>
body{
  font-family:Segoe UI;
  background:#f1f5f9;
  margin:0;
  padding:2rem;
}

/* HEADING */
h1{
  text-align:center;
  margin-bottom:2rem;
}

/* GRID */
.container{
  display:grid;
  grid-template-columns:repeat(auto-fill,minmax(20rem,1fr));
  gap:1.5rem;
}

/* CARD */
.card{
  background:white;
  padding:1.2rem;
  border-radius:0.8rem;
  box-shadow:0 0.4rem 1rem rgba(0,0,0,0.1);
  transition:0.2s;
}

.card:hover{
  transform:translateY(-5px);
}

/* IMAGE */
.card img{
  width:100%;
  height:12rem;
  object-fit:cover;
  border-radius:0.5rem;
}

/* TITLE */
.title{
  font-weight:600;
  margin:0.8rem 0;
}

/* BUTTON */
.view-btn{
  display:inline-block;
  padding:0.5rem 1rem;
  background:#2563eb;
  color:white;
  border-radius:0.4rem;
  text-decoration:none;
  font-size:0.9rem;
}
</style>

</head>
<body>

<h1>📢 All Notices</h1>

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

<a href="../uploads/<?php echo $file; ?>" target="_blank" class="view-btn">
  View Notice
</a>

</div>

<?php } ?>

</div>

</body>
</html>