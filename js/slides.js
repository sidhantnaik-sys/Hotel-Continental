document.addEventListener("DOMContentLoaded", function () {
  const swiper = new Swiper(".mySwiper", {
    loop: true,
    centeredSlides: true,
    slidesPerView: 1.2,
    spaceBetween: 7,
    speed: 600, // Smooth transition speed
    autoplay: {
      delay: 3000,
      disableOnInteraction: false,
    },
    navigation: {
      nextEl: ".suite-next",
      prevEl: ".suite-prev",
    },
    breakpoints: {
      425: {
        spaceBetween: 17.54,
        slidesPerView: 1.5,
      },
    },
  });
});
