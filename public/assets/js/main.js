$(document).ready(function() {

  $('#hamburger').on('click', function(e) {
      e.preventDefault();
      e.stopPropagation();
      $('.hamburger').toggleClass('animate');
      $('.bar').toggleClass('animate');
      var mobileNav = $('.menu');
      mobileNav.toggleClass('hide_menu show_menu');
  });

  if ( $(window).width() < 992 ) {
      $('.hover_mobile').on('click', function(e) {
         // $('.hover_mobile').removeClass('active');
          $(this).toggleClass('active no_active');
      });
  }

  const nextIcon = '<img class="img-fluid" src="/images/right-promotion.png">';
  const prevIcon = '<img class="img-fluid" src="/images/left-promotion.png">';
  $('#promotion_slider').owlCarousel({
      nav: true,
      loop: false,
      margin: 30,
      navText: [
          prevIcon,
          nextIcon
      ],
      responsive: {
          0: {
              items: 1
          },
          768: {
              items: 2,
          },
          1200: {
              items: 3,
          },
          1400: {
              items: 4,
          }
      }
  })

  $('.video_vimeo').magnificPopup({
      type: 'iframe',
      iframe: {
        markup: '<div class="mfp-iframe-scaler">'+
                  '<div class="mfp-close"></div>'+
                  '<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>'+
                '</div>',
        patterns: {
          youtube: {
            index: 'vimeo.com/',
            id: 'vimeo.com/',
            src: 'https://player.vimeo.com/video/%id%' // URL that will be set as a source for iframe.
          }, 
        },
        srcAction: 'iframe_src', // Templating object key. First part defines CSS selector, second attribute. "iframe_src" means: find "iframe" and set attribute "src".
      }
  });



});


