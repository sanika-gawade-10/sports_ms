new Swiper(".mySwiper",{
  effect:"coverflow",centeredSlides:true,slidesPerView:"auto",
  coverflowEffect:{rotate:30,depth:100,slideShadows:true},
  loop:true,autoplay:{delay:8000},
  pagination:{el:".swiper-pagination",clickable:true}
});