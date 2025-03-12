document.addEventListener("DOMContentLoaded", function() {


  /*
  let addToCartBtns = document.querySelectorAll('.addtocartbtn');
  addToCartBtns.forEach((btn)=> {
    btn.addEventListener('click', function(e){
      console.log("added to cart");
      //e.preventDefault();
    });
  })
    */

  /* eslint-disable */
  
      const flexProductPrevBtn = document.querySelector('.flexproducts_prev');
      const flexProductNextBtn = document.querySelector('.flexproducts_next');
      const flexProductSwiper = new Swiper('.flex__products_listing_list', {
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
          nextEl: flexProductPrevBtn ,
          prevEl: flexProductNextBtn
        },

        // And if we need scrollbar
        scrollbar: {
          el: '.swiper-scrollbar'
        },

        breakpoints: {
          768: {
            slidesPerView: 3,
            spaceBetween: 15,
            pagination: {
              enabled: false
            }
          },
          1024: {
            slidesPerView: 4,
            spaceBetween: 15,
            pagination: {
              enabled: false
            }
          }
        }

      });
      console.log("test", flexProductSwiper);
      /* eslint-enable */

    
});



