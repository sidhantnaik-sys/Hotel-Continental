document.addEventListener('DOMContentLoaded', function () {
  const filterSelect = document.querySelector('.suite-filter');
  const swiperContainer = document.querySelector('.suite-swiper .swiper-wrapper');
  const allSlides = swiperContainer ? Array.from(swiperContainer.querySelectorAll('.swiper-slide')) : [];
  let suiteSwiper;

  // Save original slides to memory for reuse
  const originalSlides = allSlides.map(slide => slide.cloneNode(true));

  const prevBtn = document.querySelector('.carousel-prev');
  const nextBtn = document.querySelector('.carousel-next');

  function initSwiper() {
  if (!swiperContainer) return; // prevent error

  if (suiteSwiper) suiteSwiper.destroy(true, true);

  const totalSlides = swiperContainer.querySelectorAll('.swiper-slide').length;

  if (prevBtn && nextBtn) {
    if (totalSlides <= 2) {
      prevBtn.style.display = 'none';
      nextBtn.style.display = 'none';
    } else {
      prevBtn.style.display = '';
      nextBtn.style.display = '';
    }
  }

  // ✅ Enable loop only if we have enough slides
  const enableLoop = totalSlides > 3;

  suiteSwiper = new Swiper('.suite-swiper', {
    slidesPerView: 1,
    spaceBetween: 30,
    loop: enableLoop,
    navigation: {
      nextEl: '.carousel-next',
      prevEl: '.carousel-prev',
    },
    autoplay: {
      delay: 2000,
      disableOnInteraction: false,
    },
    breakpoints: {
      768: {
        slidesPerView: 2,
      },
      1024: {
        slidesPerView: 3,
      },
    },
  });

  // ✅ Pause autoplay on hover, resume on leave
  const swiperEl = document.querySelector('.suite-swiper');
  if (swiperEl && suiteSwiper.autoplay) {
    swiperEl.addEventListener('mouseenter', () => suiteSwiper.autoplay.stop());
    swiperEl.addEventListener('mouseleave', () => suiteSwiper.autoplay.start());
  }
}


  function filterSlides(category) {
    if (!swiperContainer) return; // prevent error

    swiperContainer.innerHTML = ''; // Clear existing slides

    // Filter slides based on category
    const filteredSlides = originalSlides.filter(slide => {
      const slideCategory = slide.getAttribute('data-category');
      return category === 'all category' || slideCategory === category;
    });

    // Append filtered slides
    filteredSlides.forEach(slide => swiperContainer.appendChild(slide));

    // Re-initialize Swiper after filtering
    initSwiper();
  }

  if (swiperContainer) {
    // Initialize with all slides
    filterSlides('all category');
  }

  // On filter change
  if (filterSelect && swiperContainer) {
    filterSelect.addEventListener('change', function () {
      const selected = this.value.toLowerCase();
      filterSlides(selected);
    });
  }
});



document.addEventListener('DOMContentLoaded', function () {
  const offersSwiperEl = document.querySelector('.offers-swiper');

  if (offersSwiperEl) {
    const offersSwiper = new Swiper('.offers-swiper', {
      slidesPerView: 3,
      spaceBetween: 30,
      loop: true,
      navigation: {
        nextEl: '.offers-next',
        prevEl: '.offers-prev',
      },
      autoplay: {
        delay: 2000,
        disableOnInteraction: false,
      },
      breakpoints: {
        0: {
          slidesPerView: 1
        },
        768: {
          slidesPerView: 1.5
        },
        1024: {
          slidesPerView: 2.5
        },
        2001: {
          slidesPerView: 3.5
        }
      }
    });

    
    offersSwiperEl.addEventListener('mouseenter', () => {
      offersSwiper.autoplay.stop();
    });

    
    offersSwiperEl.addEventListener('mouseleave', () => {
      offersSwiper.autoplay.start();
    });
  }
});




document.addEventListener('DOMContentLoaded', function () {
  const filterSelect = document.querySelector('.suite-filter');
  const allSlides = document.querySelectorAll('.suite-swiper .swiper-slide');
  const swiperWrapper = document.querySelector('.suite-swiper .swiper-wrapper');

  // run only if filter and swiper exist
  if (filterSelect && swiperWrapper && allSlides.length > 0) {
    function updateSlideVisibility() {
      const selected = filterSelect.value.toLowerCase();
      let visibleCount = 0;

      allSlides.forEach(slide => {
        const category = slide.getAttribute('data-category');
        if (selected === 'all category' || category === selected) {
          slide.style.display = 'block';
          visibleCount++;
        } else {
          slide.style.display = 'none';
        }
      });

      // toggle single-slide class
      swiperWrapper.classList.toggle('single-slide', visibleCount === 1);

      // safely update swiper if it exists
      if (window.suiteSwiper && typeof window.suiteSwiper.update === 'function') {
        window.suiteSwiper.update();
      }
    }

    filterSelect.addEventListener('change', updateSlideVisibility);

    // run once on load
    updateSlideVisibility();
  }
});


// document.addEventListener("DOMContentLoaded", function () {
//   const hamburger = document.querySelector(".hamburger-menu");
//   const nav = document.querySelector(".main-nav");

//   if (hamburger && nav) {
//     hamburger.addEventListener("click", function () {
//       nav.classList.toggle("active");
//     });
//   }
// });



// Premium Swiper
if (document.querySelector(".premiumSwiper")) {
  var premiumSwiper = new Swiper(".premiumSwiper", {
    slidesPerView: 1,
    spaceBetween: 24,
    loop: true,
    navigation: {
      nextEl: ".premium-next",
      prevEl: ".premium-prev",
    },
    autoplay: {
        delay: 2000,      
        disableOnInteraction: false,
      },
    watchOverflow: false,
    breakpoints: {
      768: {
        slidesPerView: 1.2,
      },
      0: {
        slidesPerView: 1.2,
      }
    }
  });
}



$(document).ready(function () {
  if ($(".view-all").length && $(".full-text").length) {
    $(".view-all").click(function () {
      const fullText = $(".full-text");
      const btn = $(this);

      fullText.slideToggle(300, function () {
        if (fullText.is(":visible")) {
          btn.text("VIS MINDRE").addClass("expanded");
        } else {
          btn.text("LES MER").removeClass("expanded");
        }
      });
    });
  }
});


$(document).ready(function () {
  $(".view-all1").click(function () {
    const fullText = $(".full-text1");
    const btn = $(this);

    fullText.slideToggle(300, function () {

      if (fullText.is(":visible")) {
        btn.text("VIS MINDRE").addClass("expanded");
      } else {
        btn.text("SE ALLE").removeClass("expanded");
      }
    });
  });
});



const wrapper = document.querySelector('.card-wrapper');

if (wrapper) {
  const cards = wrapper.querySelectorAll('.card-item');

  if (window.innerWidth >= 768) {
    wrapper.classList.add('hover-center');
  } else {
    wrapper.classList.remove('hover-left', 'hover-center', 'hover-right');

    // 👉 make the first card active on mobile
    const firstCard = cards[0];
    if (firstCard) {
      wrapper.classList.add('hover-left'); // or 'hover-center' if you want centered
    }
  }

  cards.forEach(card => {
    card.addEventListener('mouseenter', () => {
      wrapper.classList.remove('hover-left', 'hover-center', 'hover-right');

      if (card.classList.contains('left')) {
        wrapper.classList.add('hover-left');
      } else if (card.classList.contains('center')) {
        wrapper.classList.add('hover-center');
      } else if (card.classList.contains('right')) {
        wrapper.classList.add('hover-right');
      }
    });

    card.addEventListener('mouseleave', () => {
      if (window.innerWidth >= 768) {
        wrapper.classList.remove('hover-left', 'hover-right');
        wrapper.classList.add('hover-center');
      } else {
        wrapper.classList.remove('hover-left', 'hover-center', 'hover-right');
        // 👉 keep first card active again when leaving
        const firstCard = cards[0];
        if (firstCard) {
          wrapper.classList.add('hover-left');
        }
      }
    });
  });
}








document.addEventListener("DOMContentLoaded", function () {
  const slides = document.querySelectorAll(".suite-swiper .swiper-slide");

  if (slides.length <= 3) {
    const prevBtn = document.querySelector(".carousel-prev");
    const nextBtn = document.querySelector(".carousel-next");

    if (prevBtn) prevBtn.style.display = "none";
    if (nextBtn) nextBtn.style.display = "none";
  }
});




document.addEventListener("DOMContentLoaded", function () {
  const hamburger = document.querySelector(".hamburger-menu");
  const mobileNav = document.querySelector(".mobile-nav");

  if (hamburger && mobileNav) {
    hamburger.addEventListener("click", function () {
      mobileNav.classList.toggle("active");
      hamburger.classList.toggle("open");
    });
  }
});



