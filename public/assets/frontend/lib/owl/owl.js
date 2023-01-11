var owl = $('.owl-carousel');
    owl.owlCarousel({ 
      loop:true,
          item:5,
          autoplay:true,
          autoplayHoverPause:true,
          nav:false,
          margin:10,
          responsive:{
                  0:{
                      items:1, 
                  },
                  600:{
                      items:2,
                  },
                  1000:{
                      items:3,
                      loop:true
                  }
              }
    });



