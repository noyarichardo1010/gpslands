document.addEventListener('DOMContentLoaded', function () {

  if (typeof Swiper === 'undefined') {
    console.error('Swiper belum ter-load');
    return;
  }

  new Swiper('.product-swiper', {
    slidesPerView: 4,
    spaceBetween: 24,
    grabCursor: true,
    // loop: true,
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },

    breakpoints: {
      0: {
        slidesPerView: 1,
      },
      576: {
        slidesPerView: 2,
        // loop: true,
      },
      768: {
        slidesPerView: 3,
      },
      1024: {
        slidesPerView: 4,
      }
    }
  });

});

  
// Clients
document.addEventListener('DOMContentLoaded', function () {
  new Swiper('.trusted-swiper', {
    loop: true,

    grid: {
      rows: 2,
      fill: 'row',
    },

    slidesPerView: 2,
    spaceBetween: 30,

    autoplay: {
      delay: 2500,
      disableOnInteraction: false,
    },

    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },

    breakpoints: {
      640: {
        slidesPerView: 3,
      },
      1024: {
        slidesPerView: 5,
      }
    }
  });
});






document.addEventListener("DOMContentLoaded", function () {

  function initAllSwipers() {

    document.querySelectorAll('.trusted-swiper-client').forEach((el) => {

      if (el.swiper) return;
    
      const totalSlides = el.querySelectorAll('.swiper-slide').length;
    
      // maksimal tampil 6
      const maxView = 6;
      const slidesView = Math.min(totalSlides, maxView);
    
      const swiper = new Swiper(el, {
        loop: totalSlides > 1,
        spaceBetween: 20,
        slidesPerView: slidesView,
        initialSlide: 0,
    
        observer: true,
        observeParents: true,
        updateOnWindowResize: true,
    
        pagination: {
          el: el.querySelector('.swiper-pagination'),
          clickable: true,
        },
    
        breakpoints: {
          0: {
            slidesPerView: 2,
            spaceBetween: 0,
          },
          768: { slidesPerView: Math.min(totalSlides, 3) },
          1024: { slidesPerView: Math.min(totalSlides, 6) }
        }
      });
    
      setTimeout(() => swiper.update(), 300);
    });


    document.querySelectorAll('.project-swiper-client').forEach((el) => {

      if (el.swiper) return;

      const swiper = new Swiper(el, {
        loop: true,
        spaceBetween: 20,
        slidesPerView: 3,
        // centeredSlides: true,
        initialSlide: 0,
        observer: true,
        observeParents: true,
        updateOnWindowResize: true,

        pagination: {
          el: el.querySelector('.swiper-pagination'),
          clickable: true,
        },

        breakpoints: {
          0: {
            slidesPerView: 1,
            spaceBetween: 0,
          },
          768: {
            slidesPerView: 3,
            centeredSlides: false,
          },
          1200: {
            slidesPerView: 3,
          }
        }
      });

      //  paksa update
      setTimeout(() => swiper.update(), 300);
    });

  }

  initAllSwipers();
  window.addEventListener('load', initAllSwipers);

});


// smoth anchor

document.querySelectorAll('.btn_cat_services a').forEach(link => {
  link.addEventListener('click', function(e) {
    const target = document.querySelector(this.getAttribute('href'));

    if (target) {
      e.preventDefault();

      document.querySelectorAll('.btn_cat_services a')
        .forEach(a => a.classList.remove('active'));

      this.classList.add('active');

      target.scrollIntoView({
        behavior: 'smooth',
        block: 'start'
      });
    }
  });
});



// sticky services button
document.addEventListener('DOMContentLoaded', function () {

  const stickyEl = document.querySelector('.btn_cat_services');
  if (!stickyEl) return;

  const navLinks = stickyEl.querySelectorAll('a');
  const header = document.querySelector('header'); 
  const headerHeight = header ? header.offsetHeight : 80;

  const sections = [];

  // =========================
  // KUMPULKAN SECTION
  // =========================
  navLinks.forEach(link => {
    const id = link.getAttribute('href');
    if (!id || !id.startsWith('#')) return;

    const section = document.querySelector(id);
    if (!section) return;

    sections.push({ link, section });

    // CLICK
    link.addEventListener('click', function (e) {
      e.preventDefault();

      navLinks.forEach(a => a.classList.remove('active'));
      this.classList.add('active');

      const y =
        section.getBoundingClientRect().top +
        window.pageYOffset -
        headerHeight -
        20;

      window.scrollTo({
        top: y,
        behavior: 'smooth'
      });
    });
  });

  // =========================
  // STICKY (HEADER FIXED SAFE)
  // =========================
  const stickyStart = stickyEl.offsetTop;

  function handleSticky() {
    if (window.scrollY >= stickyStart - headerHeight) {
      stickyEl.classList.add('is-fixed');
    } else {
      stickyEl.classList.remove('is-fixed');
    }
  }

  window.addEventListener('scroll', handleSticky);

  // =========================
  // SCROLL SPY
  // =========================
  function setActiveOnScroll() {
    const scrollPos = window.scrollY + headerHeight + 120;

    sections.forEach(item => {
      const top = item.section.offsetTop;
      const bottom = top + item.section.offsetHeight;

      if (scrollPos >= top && scrollPos < bottom) {
        navLinks.forEach(a => a.classList.remove('active'));
        item.link.classList.add('active');
      }
    });
  }

  window.addEventListener('scroll', setActiveOnScroll);

  // =========================
  // INIT
  // =========================
  handleSticky();
  setActiveOnScroll();

});


// Lab Slide
document.addEventListener("DOMContentLoaded", function () {

  const certSlider = new Swiper(".custom-cert-slider", {
    loop: true,
    speed: 800,
    spaceBetween: 20,

    autoplay: {
      delay: 3000,
      disableOnInteraction: false,
    },

    pagination: {
      el: ".custom-cert-slider .swiper-pagination",
      clickable: true,
    },

    breakpoints: {
      0: {
        slidesPerView: 1
      },
      768: {
        slidesPerView: 1
      }
    }
  });

  // slide 2
  const flex1 = new Swiper(".flex-1", {
    loop: true,
    speed: 800,
    spaceBetween: 20,

    autoplay: {
      delay: 3000,
      disableOnInteraction: false,
    },

    pagination: {
      el: ".flex-1 .swiper-pagination",
      clickable: true,
    },

    breakpoints: {
      0: {
        slidesPerView: 1
      },
      768: {
        slidesPerView: 1
      }
    }
  });
  // slide3
  const flex2 = new Swiper(".flex-2", {
    loop: true,
    speed: 800,
    spaceBetween: 20,

    autoplay: {
      delay: 3000,
      disableOnInteraction: false,
    },

    pagination: {
      el: ".flex-2 .swiper-pagination",
      clickable: true,
    },

    breakpoints: {
      0: {
        slidesPerView: 1
      },
      768: {
        slidesPerView: 1
      }
    }
  });

});



document.querySelectorAll('.copy-btn').forEach(button => {
  button.addEventListener('click', function() {
    const link = this.getAttribute('data-link');
    const text = this.nextElementSibling;

    navigator.clipboard.writeText(link).then(() => {
      text.classList.add('show');

      setTimeout(() => {
        text.classList.remove('show');
      }, 2000);
    });
  });
});


// swipper product arrow

document.querySelectorAll('.zoom-container').forEach(container => {
  const img = container.querySelector('.zoom-image');

  container.addEventListener('mousemove', function(e) {
      const rect = container.getBoundingClientRect();
      const x = e.clientX - rect.left;
      const y = e.clientY - rect.top;

      const xPercent = (x / rect.width) * 100;
      const yPercent = (y / rect.height) * 100;

      img.style.transformOrigin = xPercent + '% ' + yPercent + '%';
      img.style.transform = 'scale(2)';
  });

  container.addEventListener('mouseleave', function() {
      img.style.transform = 'scale(1)';
      img.style.transformOrigin = 'center center';
  });
});


const thumbSlider = new Swiper('.product-thumb-slider', {
  slidesPerView: 4,
  spaceBetween: 10,
  watchSlidesProgress: true,
  centeredSlides: true,      
  slideToClickedSlide: true,
});

const mainSlider = new Swiper('.product-main-slider', {
  loop: true, 
  spaceBetween: 10,
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
  thumbs: {
    swiper: thumbSlider,
  },
});