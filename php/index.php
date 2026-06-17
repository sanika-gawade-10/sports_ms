<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPORTS MANAGEMENT SYSTEM - HOME</title>

    <?php require('inc/links.php') ?>
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="Notices/notices.css">
</head>

<body class="body-bg">

<?php require('inc/header.php'); ?>

<!-- Swiper -->
<div class="swiper mySwiper">
  <div class="swiper-wrapper">

    <div class="swiper-slide">
      <img src="images/carousel/home-page-slider-2.jpeg">
    </div>

    <div class="swiper-slide">
      <img src="images/carousel/home-page-slider-3.jpeg">
    </div>

    <div class="swiper-slide">
      <img src="images/carousel/image 3.jpg">
    </div>

    <div class="swiper-slide">
      <img src="images/carousel/image 4.jpg">
    </div>

  </div>
</div>

<br><br><br>

<section class="sports-section">
  <h1>Welcome to Sathaye College Sports!</h1>
  <!-- <p class="intro_home">
    At Sathaye College, <span class="highlight">sports are more than just an activity</span> — they are the spirit of our campus.
    From intercollegiate tournaments to everyday practice, we build a culture of fitness, passion, and teamwork. <br><br>
    Students can explore a wide range of sports — from <span class="highlight">cricket, football, athletics</span> to 
    <span class="highlight">badminton, chess, and indoor events</span>. 
    With excellent facilities and experienced coaches, we help students discover their potential and push their limits.
    Our players have earned medals at district, state, and national levels while carrying forward the values of 
    <span class="highlight">sportsmanship, discipline, and leadership</span>. <br><br>
    <b>Join Sathaye College Sports — where champions grow!</b>
  </p> -->
</section>

<br><br><br>

<!-- ✅ NOTICE SECTION -->
<section>

<link rel="stylesheet" href="css/notices.css">

<h1>📢 Sports Notice</h1>

<div class="notice-box">

  <div class="header">
    <h2>Latest Updates</h2>
    <a href="Notices/all-notices.php" target="_blank" class="view">View All</a>
  </div>

  <div class="wrapper">
    <div class="track">

      <?php
      include("AdminPanel/db.php");

      $res = $conn->query("SELECT * FROM notices ORDER BY id DESC");

      if($res->num_rows == 0){
        echo "<span class='notice-item'>No notices available</span>";
      }

      while($row = $res->fetch_assoc()){
        $file = $row['file'];
      ?>

        <a href="uploads/<?php echo $file; ?>" target="_blank" class="notice-item">
          🔔 <?php echo $row['title']; ?>
        </a>

      <?php } ?>

    </div>
  </div>

</div>

</section>

<br><br>

<?php include("home_achievements.php"); ?>


<?php require('inc/footer.php'); ?>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="css/JS/home.js"></script>

</body>
</html>