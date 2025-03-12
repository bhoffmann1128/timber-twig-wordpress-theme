


document.addEventListener("DOMContentLoaded", function() {


  // the element we want to target, targets all sections on a page
  const observer__target = document.querySelectorAll('.animate__section');

  // add/remove class when intersected
  function handleIntersection(entries) {
    entries.map((entry) => {
      if (entry.isIntersecting) {
        entry.target.classList.add('--isvisible')
      } else {
        entry.target.classList.remove('--isvisible')
      }
    });
  }

  const observer = new IntersectionObserver(handleIntersection);
  observer__target.forEach(function(target){
    observer.observe(target);
  });
  

  //toggle main mobile menu on click
  const navToggle = document.querySelector('#navbar-toggle');
  navToggle.addEventListener('click', function(e){
    e.preventDefault();
    const nav = document.querySelector('#nav-main');
    nav.classList.toggle('--is-active');
  });

  //toggle child menu divs on mobile
  const mobileToggle = document.querySelectorAll('.mobile__toggle');
  mobileToggle.forEach(function(btn) {
    btn.addEventListener('click', function(e){
      e.preventDefault();
      this.nextElementSibling.classList.toggle('--is-active');
    });
  });

  //accordion sections
  const accordionToggle = document.querySelectorAll('.accordion__btn');
  accordionToggle.forEach(function(btn) {
      btn.addEventListener('click', function(e){
      e.preventDefault();
          this.classList.toggle('--is-active');
          this.nextElementSibling.classList.toggle('--is-active');
    });
  });


  //collapse top nav bar on scroll on mobile;
  const subheader = document.querySelector('.header__top-right');
  const bodyEl = document.querySelector('body');
  window.addEventListener('scroll', function() {
      let scroll = window.scrollY;

      if (scroll > 25) {
          subheader.classList.add('--collapse');
          bodyEl.classList.add('--collapse');

      } else {
        subheader.classList.remove('--collapse');
        bodyEl.classList.remove('--collapse');
      }
  });

  

  /* eslint-disable */

  var searchToggled = false;
  navSearchButton
  var navSearchBtn = document.querySelector('#navSearchButton');
  navSearchBtn.addEventListener('click', (e) => {
    e.preventDefault();
    toggleSearchFunction();
  })
  var searchNavContainer = document.querySelector('#searchNavContainer');
  function toggleSearchFunction() {
    console.log("toggling");
    searchNavContainer.classList.toggle('--active');
  }
  
  

    if (typeof Swiper !== 'undefined') {
      const flexBannerPrevBtn = document.querySelector('.flexbanner_prev');
      const flexBannerNextBtn = document.querySelector('.flexbanner_next');
      const swiper = new Swiper('.swiper-banner', {
        // Optional parameters
        direction: 'horizontal',
        loop: true,

        // If we need pagination
        pagination: {
          el: '.swiper-pagination',
          clickable: true,
        },

        // Navigation arrows
        navigation: {
          nextEl: flexBannerPrevBtn,
          prevEl: flexBannerNextBtn
        },

        // And if we need scrollbar
        scrollbar: {
          el: '.swiper-scrollbar'
        },

        breakpoints: {
          768: {
            pagination: {
              enabled: false
            }
          }
        }

      });

      const blogPostsSliderPrevBtn = document.querySelector('.blogpost-slider-prev');
      const blogPostsSliderNextBtn = document.querySelector('.blogpost-slider-next');
      const blogpostsSwiper = new Swiper('.swiper-blogposts', {
        // Optional parameters
        direction: 'horizontal',
        loop: true,
        //slidesPerView: 1,

        // If we need pagination
        pagination: {
          el: '.swiper-pagination',
          clickable: true,
        },

        // Navigation arrows
        navigation: {
          nextEl: blogPostsSliderNextBtn,
          prevEl: blogPostsSliderPrevBtn
        },

        // And if we need scrollbar
        scrollbar: {
          el: '.swiper-scrollbar'
        },

        breakpoints: {
          768: {
            slidesPerView: 2,
            spaceBetween: 15,
            pagination: {
              enabled: false
            }
          },
          968: {
            slidesPerView: 3,
            spaceBetween: 15,
            pagination: {
              enabled: false
            }
          },
          1200: {
            slidesPerView: 4,
            spaceBetween: 15,
            pagination: {
              enabled: false
            }
          }
        }

      });

  }


  
/* eslint-enable */
});

