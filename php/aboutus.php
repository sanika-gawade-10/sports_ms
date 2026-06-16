<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPORTS MANAGEMENT SYSTEM -ABOUT US</title>
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"> 
    <link rel="stylesheet" href="css\main_about.css">

    <?php require('inc/links.php') ?>
</head>

<body>
    
  <?php require('inc/header.php'); ?>



<!-- 1) HERO -->
<div class="hero">
  <div>
    <h1> College Gymkhana</h1>
    <p>A space where fitness, discipline, confidence, and sportsmanship grow together.</p>
  </div>
</div>


<!-- 2) ABOUT -->
<section>
  <h2 class="title">About Gymkhana</h2>
  <div class="row">
    <img src="images\carousel\about_pic.png">
    <div class="text">
      The Sathaye College Gymkhana is the centre for sports, fitness, and student activities on campus. It offers a mini-gym with basic workout equipment 
      and facilities for indoor games like table tennis, carrom, and chess. Outdoor sports such as cricket, football, volleyball, 
      and basketball are also supported. Guided by the Gymkhana Committee, students get regular practice, participate in inter-college competitions, 
      and many even achieve state-level success. The Gymkhana encourages fitness, teamwork, and a healthy campus culture.
      It also provides a supportive environment for new players to learn and grow, making sports accessible to every student.
    </div>
  </div>
</section>


<!-- 3) SPORTS & NEP -->
<section>
  <h2 class="title">Sports & NEP : Credit Course</h2>
  <p style="font-size:18px; text-align:center;">
    Sathaye College follows the NEP 2020 system, which includes credit-based courses. Under NEP, 
    students must complete co-curricular credit courses along with academics. Sports is one of the 
    important options available as a credit course activity, where students can earn credits by 
    participating in sports events and activities. Around 30 hours of sports participation gives 
    2 credits. This system encourages physical fitness and teamwork among students and also helps 
    in overall personality development, not just academics. Sathaye College provides sports 
    facilities like playgrounds and indoor games. The NEP structure makes education more practical 
    and skill-based. Thus, the sports credit course plays an important role in holistic student 
    development at Sathaye College.

  </p>

  <div style="text-align:center;">
  <button class="btn" onclick="showPopup()">Register for CC</button>
</div>

<script>
function showPopup() {
  alert("Registration will start soon!");
}
</script>
</section>


<!-- 4) COACHES -->
<section>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>

<style>
body{
  background: #F5F7FA;
  font-family:Arial, sans-serif;
}

.title{
  text-align:center;
  font-size:30px;
  margin-bottom:30px;
  color: #1e293b;
}

/* SWIPER */
.swiper{
  width:90%;
  padding:40px 0;
}

/* SLIDE */
.swiper-slide{
  display:flex;
  justify-content:center;
  transition:0.3s;
}

/* BIG CARD */
.coach{
  width:320px;              /* increased size */
  height:200px;             /* added height */
  padding:30px;
  border-radius:20px;
  text-align:center;

  background: linear-gradient(135deg, #2563eb, #1e40af);

  color:#fff;
  box-shadow:0 15px 35px rgba(0,0,0,0.2);

  display:flex;
  flex-direction:column;
  justify-content:center;

  transition:0.4s;
}

/* TEXT */
.coach h3{
  font-size:20px;
  margin-bottom:10px;
  font-weight:600;
}

.coach p{
  font-size:15px;
  opacity:0.9;
}

/* HOVER EFFECT */
.coach:hover{
  transform:translateY(-10px) scale(1.05);
}

/* ACTIVE CENTER CARD (highlight) */
.swiper-slide-active .coach{
  transform:scale(1.1);
  box-shadow:0 20px 45px rgba(0,0,0,0.3);
}
</style>

<h2 class="title">Coaches & Trainers</h2>

<div class="swiper mySwiper">
  <div class="swiper-wrapper">

    <div class="swiper-slide"><div class="coach"><h3>Shri. G.D. Maske</h3><p>Gymkhana Chairman</p></div></div>
    <div class="swiper-slide"><div class="coach"><h3>Shri. A.L. Vartak</h3><p>Sports Director</p></div></div>
    <div class="swiper-slide"><div class="coach"><h3>Dr. M.N. Narayankar</h3><p>Football Coach</p></div></div>
    <div class="swiper-slide"><div class="coach"><h3>Dr. (Smt.) M.S. Patankar</h3><p>Physical Education</p></div></div>
    <div class="swiper-slide"><div class="coach"><h3>Dr. Sandeep Shinde</h3><p>Cricket Coach</p></div></div>
    <div class="swiper-slide"><div class="coach"><h3>Shri. Gaurang Rajwadkar</h3><p>Carrom Coach</p></div></div>
    <div class="swiper-slide"><div class="coach"><h3>Dr. Diplai Mhapsekar</h3><p>Kho-Kho Coach</p></div></div>
    <div class="swiper-slide"><div class="coach"><h3>Smt. S.A. Pethe</h3><p>Certificate Committee</p></div></div>

  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
var swiper = new Swiper(".mySwiper", {
  slidesPerView: 3,
  centeredSlides: true,   // center focus
  spaceBetween: 30,
  loop: true,

  autoplay: {
    delay: 2200,
    disableOnInteraction: false,
  },

  breakpoints: {
    0: { slidesPerView: 1 },
    768: { slidesPerView: 2 },
    1024: { slidesPerView: 3 }
  }
});
</script>

</section>


<!-- 5) ACHIEVEMENTS -->
<section>
  <h2 class="title">🏆 Achievements</h2>

  <div class="grid" id="achievements"></div>

  <div class="center">
    <a href="images/achievements/all-achievements.html" class="btn">View All →</a>
  </div>
</section>

<style>
.title{
  text-align:center;
  font-size:28px;
  margin-bottom:25px;
  color:#1e3a8a;
}

.grid{
  display:grid;
  grid-template-columns:repeat(auto-fit,minmax(240px,1fr));
  gap:25px;
}

/* CARD */
.card{
  position:relative;
  border-radius:15px;
  overflow:hidden;
  cursor:pointer;
  box-shadow:0 8px 20px rgba(0,0,0,0.15);
  transition:0.4s;
}

.card:hover{
  transform:translateY(-8px) scale(1.02);
}

/* IMAGE */
.card img{
  width:100%;
  height:220px;
  object-fit:cover;
}

/* OVERLAY */
.overlay{
  position:absolute;
  bottom:0;
  width:100%;
  padding:15px;
  color:white;
  background:linear-gradient(to top, rgba(0,0,0,0.8), transparent);
  transition:0.3s;
}

.card:hover .overlay{
  background:linear-gradient(to top, rgba(0,0,0,0.95), transparent);
}

.overlay h3{
  margin:0;
}

.overlay p{
  font-size:14px;
}

/* BUTTON */
.center{
  text-align:center;
  margin-top:25px;
}

.btn{
  text-decoration:none;
  background:#2563eb;
  color:white;
  padding:10px 20px;
  border-radius:8px;
  transition:0.3s;
}

.btn:hover{
  background:#1e40af;
}
</style>

<script>
let achievements = [
  {name:"Mrunal Nagare", text:"Shooting Champion", img:"images/achievements/img5.jpeg"},
  {name:"Avdhut Pingle", text:"University Gold - Mallakhamb", img:"images/achievements/img8.jpeg"},
  {name:"Vinayaki Dadke", text:"Inter-Collegiate Silver - Taekwondo", img:"images/achievements/img9.jpeg"},
  {name:"Manasvi Vaidya", text:"Inter-Collegiate Silver - Athletics", img:"images/achievements/img11.jpeg"},
  {name:"Shooting Team", text:"Inter-Collegiate Gold - Shooting", img:"images/achievements/img12.jpeg"},
  {name:"Shriya Gole", text:"Inter-Collegiate Silver - Shooting", img:"images/achievements/img13.jpeg"},
  {name:"Aryan Talekar", text:"Inter-Collegiate Bronze - Boxing", img:"images/achievements/img16.jpeg"},
  {name:"Preeti Sawant", text:"Inter-Collegiate Chess Tournament", img:"images/achievements/img17.jpeg"},
  {name:"Dhruv Desai", text:"Inter-zonal Gold - Kho-Kho", img:"images/achievements/img18.jpeg"},
  {name:"Aditya Salunkhe", text:"Inter-Collegiate Bronze - Boxing", img:"images/achievements/img20.jpeg"},
];

let box = document.getElementById("achievements");

// show only 4
achievements.slice(0,4).forEach(a=>{
  box.innerHTML += `
    <div class="card">
      <img src="${a.img}">
      <div class="overlay">
        <h3>${a.name}</h3>
        <p>${a.text}</p>
      </div>
    </div>
  `;
});

// store for next page
localStorage.setItem("achievements", JSON.stringify(achievements));
</script>


<!-- 6) STATS -->
<section>
  <h2 class="title">Our Progress</h2>
  <div class="stats">
    <div class="stat-box">
      <h1>80+</h1>
      <p>Medals Won</p>
    </div>
    <div class="stat-box">
      <h1>40+</h1>
      <p>Sports Offered</p>
    </div>
    <div class="stat-box">
      <h1>400+</h1>
      <p>Active Players</p>
    </div>
  </div>
</section>


<!-- 7) VIDEO -->
<section>
  <h2 class="title">Sports Highlights</h2>
  <video height="400rem"; width="1100rem" controls autoplay muted loop>
  <source src="images/achievements/video.mp4" type="video/mp4">
  Your browser does not support the video tag.
</video>
</section>



</body>

<?php require('inc/footer.php'); ?>

<!-- 8) FOOTER -->
<footer class="end">
  <p>© 2025 College Gymkhana | All Rights Reserved</p>
</footer>

</html>