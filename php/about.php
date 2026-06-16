<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=00, initial-scale=1.0">
    <title>SPORTS MANAGEMENT SYSTEM -ABOUT US</title>
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css">
    <?php require('inc/links.php') ?>
</head>
<style>

  
*{
    font-family: 'Poppins', sans-serif;
}
.h-font{
    font-family: 'Merienda', cursive;
}

input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

    input[type=number] {
    -moz-appearanc: textfield;
     }
    



.custom-bg{
    background-color: var(--teal);
    border: 1px solid var(--teal);
}
.custom-bg:hover{
    background-color: var(--teal_hover);
    border-color: var(--teal_hover);
}


  .h-line{
    width: 150px;
    margin: 0 auto;
    height: 1.7px;
}

.pop:hover{
  border-top-color: var(--teal) !important;
  transform: scale(1.03);
  transition: all 0.3s;
}

.box{
    border-top-color: var(--teal) !important;
}
</style>

<body class="bg-light">
    
  <?php require('inc/header.php'); ?>


   <div class="my-5 px-4">
    <h2 class="fw-bold h-font text-center">ABOUT US</h2>
     <div class="h-line bg-dark"></div>
     <p class="text-center mt-3">
     The Sathaye College has sports Details as follows :
     </p>
  </div>
  
  <div class="conatiner">
    <div class="row justify=content-between align-items-center">
        <div class="col-lg-6 col-md-5 mb-4 order-lg-1 order-md-1 order-2">
            <h3 class="mb-3">SATHAYE COLLEGE GYMKHANA</h3>
            <p>
            Parle Tilak Vidyalaya Association’s Sathaye College located in the cultural hub of suburbs 
            Vile Parle is a well known College affiliated to the University of Mumbai founded in 1959, 
            this Arts, Science College later on added Commerce faculty in 1982

            </p>
        </div>
        <div class="col-lg-5 col-md-5 mb-4 order-lg-2 order-md-2 order-1">
            <img src="images/features/sathaye college.jpg" class="w-100">
        </div>
    </div>
  </div>

  <div class="container mt-5">
    <div class="row">
        <div class="col-lg-3 col-md-6 mb-4 px-4">
            <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
                <img src="images/features/about1.jpg" width="180px">
                <h4 class="mt-3"></h4>
            </div>

        </div>

        <div class="col-lg-3 col-md-6 mb-4 px-4">
            <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
                <img src="images/features/about2.jpg" width="180px">
                <h4 class="mt-3"></h4>
            </div>

        </div>

        <div class="col-lg-3 col-md-6 mb-4 px-4">
            <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
                <img src="images/features/about3.jpeg" width="190px">
                <h4 class="mt-3"></h4>
            </div>

        </div>

        <div class="col-lg-3 col-md-6 mb-4 px-4">
            <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
                <img src="images/features/about4.png" width="180px">
                <h4 class="mt-3"></h4>
            </div>
        </div>
    </div>

  </div>


  <h3 class="my-5 fw-bold h-font text-center">Sports Day</h3>

  <div class="container px-4">
  <div class="swiper mySwiper">
    <div class="swiper-wrapper mb-5">
      <div class="swiper-slide bg-white text-center overflow-hidden rounded">
        <img src="images/features/a6.jpg" class="w-100">
        <h5 class="mt-2"></h5>
      </div>
      <div class="swiper-slide bg-white text-center overflow-hidden rounded">
        <img src="images/features/a5.jpg" class="w-100">
        <h5 class="mt-2"></h5>
      </div>
      <div class="swiper-slide bg-white text-center overflow-hidden rounded">
        <img src="images/features/a4.jpg" class="w-100">
        <h5 class="mt-2"></h5>
      </div>
      <div class="swiper-slide bg-white text-center overflow-hidden rounded">
        <img src="images/features/a3.jpg" class="w-100">
        <h5 class="mt-2"></h5>
      </div>
      <div class="swiper-slide bg-white text-center overflow-hidden rounded">
        <img src="images/features/a2.jpeg" class="w-100">
        <h5 class="mt-2"></h5>
      </div>
      <div class="swiper-slide bg-white text-center overflow-hidden rounded">
        <img src="images/features/a7.jpeg" class="w-100">
        <h5 class="mt-2"></h5>
      </div>
      <div class="swiper-slide bg-white text-center overflow-hidden rounded">
        <img src="images/features/a8.jpg" class="w-100">
        <h5 class="mt-2"></h5>
      </div>
      
    </div>
    <div class="swiper-pagination"></div>
  </div>
  </div>

   <?php require('inc/footer.php'); ?>

      <!-- Swiper JS -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<!-- Initialize Swiper -->
<script>
  var swiper = new Swiper(".mySwiper", {
    
    spaceBetween: 40,
    pagination: {
      el: ".swiper-pagination",
    },
    breakpoints: {
        320: {
            slidesPerView: 1,
        },
        640: {
            slidesPerView: 1,
        },
        768: {
            slidesPerView: 4,
        
        },
        1024: {
            slidesPerView: 3,
        
        }
      }
  });
</script>  

</body>
</html>