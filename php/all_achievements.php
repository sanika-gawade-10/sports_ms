<?php
include "db.php";

$res = $conn->query("SELECT * FROM achievements WHERE status='Approved' ORDER BY id DESC");
?>

<h2 style="text-align:center">All Achievements</h2>

<div style="display:flex;flex-wrap:wrap;gap:20px;padding:20px">

<?php while($row=$res->fetch_assoc()){ 
$imgs = explode(",", $row['images']);
?>

<div style="width:300px;background:white;padding:10px;border-radius:10px;box-shadow:0 0 10px #ccc">

<img src="uploads/<?php echo $imgs[0]; ?>" style="width:100%;border-radius:8px">

<h4><?php echo $row['name']; ?></h4>
<p><?php echo $row['description']; ?></p>

</div>

<?php } ?>

</div>