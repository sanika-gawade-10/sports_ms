<?php
include "AdminPanel/db.php";

/* ✅ FETCH ONLY APPROVED + CURRENT MONTH */
$res = $conn->query("
SELECT * FROM achievements 
WHERE status='Approved'
AND MONTH(event_date)=MONTH(CURDATE())
AND YEAR(event_date)=YEAR(CURDATE())
ORDER BY id DESC
");
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>

<style>

/* SECTION */
.ach-section{
  padding:40px 30px;
}

.ach-header{
  display:flex;
  justify-content:space-between;
  align-items:center;
  margin-bottom:15px;
}


.ach-header h2{
  margin:0;
  font-size:24px;
}

.view-all{
  text-decoration:none;
  color:#1e3a8a;
  font-weight:bold;
}

/* SWIPER */
.swiper{
  padding:5px;
}

.swiper-slide{
  display:flex;
  justify-content:center;
}

/* CARD */
.ach-card{
  width:100%;
  max-width:300px;
  background:white;
  border-radius:12px;
  overflow:hidden;
  box-shadow:0 4px 12px rgba(0,0,0,0.1);
  transition:0.3s;
  cursor:pointer;
  position:relative;
}
.ach-card:hover{
  transform:translateY(-6px) scale(1.03);
}

/* IMAGE */
.ach-card img{
  width:100%;
  aspect-ratio:1/1;
  object-fit:cover;
  transition:0.4s;
}

.ach-card:hover img{
  transform:scale(1.08);
}

/* OVERLAY */
.overlay{
  position:absolute;
  bottom:0;
  width:100%;
  background:linear-gradient(to top,rgba(0,0,0,0.8),transparent);
  color:white;
  padding: 12px;
}

.overlay h4{
  margin:0;
  font-size:15px;
}

.overlay p{
  font-size:12px;
}

/* MODAL */
#achModal{
  display:none;
  position:fixed;
  top:0;
  left:0;
  width:100%;
  height:100%;
  background:rgba(0,0,0,0.85);
  backdrop-filter:blur(6px);
  justify-content:center;
  align-items:center;
  z-index:999;
}

.modal-box{
  background:white;
  padding:20px;
  border-radius:12px;
  width:320px;
  text-align:center;
  animation:zoom 0.3s ease;
}

.modal-box img{
  width:100%;
  border-radius:10px;
}

@keyframes zoom{
  from{transform:scale(0.8);opacity:0;}
  to{transform:scale(1);opacity:1;}
}

</style>


<section class="ach-section">

<div class="ach-header">
<h2>🏆 Monthly Achievements</h2>
<a href="all_achievements.php" class="view-all">View All →</a>
</div>

<div class="swiper myAchSwiper">
<div class="swiper-wrapper">

<?php while($row = $res->fetch_assoc()){ 

  $imgs = explode(",", $row['images']);
  $firstImg = $imgs[0] ?? 'default.jpg';
?>

<div class="swiper-slide">

<div class="ach-card"
onclick='openAchModal(
  <?php echo json_encode($row["name"]); ?>,
  <?php echo json_encode($row["description"]); ?>,
  "<?php echo "uploads/".$firstImg; ?>"
)'>

<img src="<?php echo "uploads/".$firstImg; ?>">

<div class="overlay">
<h4><?php echo $row['name']; ?></h4>
<p><?php echo substr($row['description'],0,40); ?>...</p>
</div>

</div>
</div>

<?php } ?>

</div>
</div>

</section>


<!-- MODAL -->
<div id="achModal" onclick="closeAchModal(event)">
<div class="modal-box">
<img id="achImg">
<h3 id="achName"></h3>
<p id="achDesc"></p>
</div>
</div>


<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>

/* ✅ SWIPER */
new Swiper(".myAchSwiper", {
  slidesPerView:3,
  spaceBetween:2,
  loop:true,
  autoplay:{
    delay:10000,
    disableOnInteraction:false
  },
  breakpoints:{
    0:{slidesPerView:1},
    768:{slidesPerView:2}
  }
});

/* ✅ MODAL */
function openAchModal(name,desc,img){
  document.getElementById("achModal").style.display="flex";
  document.getElementById("achName").innerText=name;
  document.getElementById("achDesc").innerText=desc;
  document.getElementById("achImg").src=img;
}

function closeAchModal(e){
  if(e.target.id==="achModal"){
    document.getElementById("achModal").style.display="none";
  }
}

</script>