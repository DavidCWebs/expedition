(function($) {
      $(window).load(function(){
        $('.iosSlider').iosSlider({
              snapToChildren: true,
              snapSlideLeft: true,
              scrollbar: true,
              scrollbarDrag: true,
              scrollbarWidth: '60px',
              scrollbarBorderRadius: 0,
              scrollbarContainer: '.scrollbarContainer',
              scrollbarHide: false,
              scrollbarMargin: 0,
              desktopClickDrag: true,
              scrollbarLocation: 'bottom',
              scrollbarHeight: '20px',
              scrollbarBackground: '#b5d334',
              scrollbarMargin: '0',
              scrollbarOpacity: '0.75',
              responsiveSlides: false,
              responsiveSlideContainer: false,

              onSliderLoaded: loadedCallback

            });
    });

    function loadedCallback(){
      //alert("slider is loaded!");
      //$('.js .no-fouc').removeClass('no-fouc'); //Works well
      $('.js .no-fouc').css('opacity', '1');
      //$('#floatingCirclesG').remove();
      }


   })(jQuery);
