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
        0: {
          slidesPerView: 1.2,
        },
        768: {
          slidesPerView: 2,
        },
        1024: {
          slidesPerView: 3,
        },
      }

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
          slidesPerView: 1.2
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


// mobile-only swiper: creates proper .swiper > .swiper-wrapper > .swiper-slide structure
(function () {
  let offerSwiper = null;
  let wrapper = null;

  function isMobile() {
    return window.innerWidth < 768;
  }

  function initOfferSwiper() {
    const container = document.querySelector('.mobile-offers-swiper');
    if (!container) return;

    // ensure Swiper library available
    if (typeof Swiper === 'undefined') {
      console.warn('Swiper is not loaded. Include Swiper JS before this script.');
      return;
    }

    if (isMobile()) {
      if (offerSwiper) return; // already init

      // create wrapper and move direct child columns into it
      wrapper = document.createElement('div');
      wrapper.classList.add('swiper-wrapper');

      // select only direct element children that are the columns (matches current HTML)
      const directCols = Array.from(container.querySelectorAll(':scope > div'));

      directCols.forEach(col => {
        // convert bootstrap columns to slides
        col.classList.add('swiper-slide');
        col.classList.remove('col-12', 'col-md-6', 'col-lg-3');
        wrapper.appendChild(col);
      });

      // mark container as swiper and append wrapper
      container.classList.add('swiper');
      container.appendChild(wrapper);

      // init swiper instance
      offerSwiper = new Swiper('.mobile-offers-swiper', {
        slidesPerView: 1.2,
        spaceBetween: 16,
        loop: true,
        autoplay: {
          delay: 2000,
          disableOnInteraction: false,
        },
      });
      return;
    }

    // if not mobile and swiper exists, destroy & restore
    if (offerSwiper) {
      offerSwiper.destroy(true, true);
      offerSwiper = null;

      // move slides back to container (unwrap)
      if (wrapper) {
        const slides = Array.from(wrapper.children);
        slides.forEach(slide => {
          slide.classList.remove('swiper-slide');
          slide.classList.add('col-12', 'col-md-6', 'col-lg-3');
          container.appendChild(slide);
        });

        // remove wrapper from DOM
        wrapper.remove();
        wrapper = null;
      }

      container.classList.remove('swiper');
    }
  }

  // init on load + resize
  window.addEventListener('load', initOfferSwiper);
  window.addEventListener('resize', function () {
    // debounce small resize flurries
    clearTimeout(window.__offerSwiperResizeTimer);
    window.__offerSwiperResizeTimer = setTimeout(initOfferSwiper, 120);
  });
})();


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

  // hover handler for desktop
  function handleHover(card) {
    wrapper.classList.remove('hover-left', 'hover-center', 'hover-right');
    if (card.classList.contains('left')) wrapper.classList.add('hover-left');
    else if (card.classList.contains('center')) wrapper.classList.add('hover-center');
    else if (card.classList.contains('right')) wrapper.classList.add('hover-right');
  }

  function applyCardBehavior() {
    if (window.innerWidth >= 768) {
      // DESKTOP → enable hover logic
      cards.forEach(card => {
        card.classList.remove('active'); // remove mobile active
        card.onmouseenter = () => handleHover(card);
        card.onmouseleave = () => {
          wrapper.classList.remove('hover-left', 'hover-right');
          wrapper.classList.add('hover-center');
        };
      });

      // Set default desktop state
      wrapper.classList.add('hover-center');

    } else {
      // MOBILE → disable hover logic
      cards.forEach(card => {
        card.onmouseenter = null;
        card.onmouseleave = null;
        card.classList.add('active'); // show all card contents
      });

      wrapper.classList.remove('hover-left', 'hover-center', 'hover-right');
    }
  }

  // Initial setup
  applyCardBehavior();

  // Re-apply on resize
  window.addEventListener('resize', applyCardBehavior);
}


// const wrapper = document.querySelector('.card-wrapper');

// if (wrapper) {
//   const cards = wrapper.querySelectorAll('.card-item');

 

//   cards.forEach(card => {
//     card.addEventListener('mouseenter', () => {
//       wrapper.classList.remove('hover-left', 'hover-center', 'hover-right');

//       if (card.classList.contains('left')) {
//         wrapper.classList.add('hover-left');
//       } else if (card.classList.contains('center')) {
//         wrapper.classList.add('hover-center');
//       } else if (card.classList.contains('right')) {
//         wrapper.classList.add('hover-right');
//       }
//     });

//     card.addEventListener('mouseleave', () => {
//       if (window.innerWidth >= 768) {
//         wrapper.classList.remove('hover-left', 'hover-right');
//         wrapper.classList.add('hover-center');
//       } else {
//         wrapper.classList.remove('hover-left', 'hover-center', 'hover-right');
//         // 👉 keep first card active again when leaving
//         const firstCard = cards[0];
//         if (firstCard) {
//           wrapper.classList.add('hover-left');
//         }
//       }
//     });
//   });

//    if (window.innerWidth >= 768) {
//     wrapper.classList.add('hover-center');
//   } else {
//     wrapper.classList.remove('hover-left', 'hover-center', 'hover-right');

//     // 👉 make the first card active on mobile
//     const firstCard = cards[0];
//     if (firstCard) {
//       wrapper.classList.add('hover-left' ,'hover-center', 'hover-right'); // or 'hover-center' if you want centered
//     }
//   }
//   if (window.innerWidth >= 768) {

//     // desktop → remove active (use hover logic)
//     cards.forEach(card => card.classList.remove('active'));

// } else {

//     // mobile → show all cards
//     cards.forEach(card => card.classList.add('active'));
// }

// }






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



