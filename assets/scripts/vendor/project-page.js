(function($) {// Safe for WP no-conflict mode

$(window).resize(function () {
    var responsive_viewport = $(window).width();

    //  console.log(responsive_viewport);
    if (responsive_viewport < 980 ) {

        // Change the order of the main container divs
        $('#project_image').insertBefore('#project_text');

        // Show #project_info_tab
        $('#project_info_container').show();

        // Move the nav arrow p element
        $( '#project_info_container' ).after( $( '.paramove' ) );

        // Move post content into #firstcol
        //$( '#firstcol' ).prepend( $( '.post_content' ) );
        $( '#firstcol' ).prepend( $( '.post_box' ) );

        // Move #project_info into #secondcol
        $( '#secondcol' ).prepend( $( '#project_info' ) );

        // Hide .third container
        $('#project_text').hide();


    } else {

        // Show .third container
        $('#project_text').show();

        // Revert order of container divs
        $('#project_text').insertBefore('#project_image');

        // Put the nav arrow p back inside #project_text
        $( '#project_text' ).prepend( $( '.paramove' ) );

        // Hide the half columns
        // THIS IS F**KING UP FOOTER
        // +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        //$('.columns_211').hide();
        $('#project_info_container').hide();

        // Move post_content and project_info back
        $( '#project_text' ).prepend( $( '#project_info' ) );
        $( '#project_text' ).prepend( $( '.post_box' ) );
        //$( '#project_text' ).prepend( $( '.post_content' ) );
        $( '#project_text' ).prepend( $( '.paramove' ) );

    }

});

/*====================================================================*/

/* 570 Pixels */

$(window).resize(function () {
    var responsive_viewport = $(window).width();

    //  console.log(responsive_viewport);
    if (responsive_viewport < 570) {

		// Move project category menu into #content
        $( '#content' ).prepend( $( '#menu-project-sub-categories' ) );

        // Move #cat_menu_border
        $( '.columns_312' ).prepend( $( '#cat_menu_border' ) );

        // Show Border
        $('#cat_menu_border').show();
    }

    if (responsive_viewport > 571)  {

		// Hide Border
        $('#cat_menu_border').hide();

        // Move project category menu into #content
        $( '#nav_wrap' ).append( $( '#menu-project-sub-categories' ) );
    }

});


jQuery(document).ready(

    function () {
        $(window).trigger('resize');
        //$('.js .no-fouc').removeClass('no-fouc'); // Remove FOUC class - won't matter if js disabled, as the .js .no-fouc won't be hidden
    });

/*==============================================================================
  Toggle additional content
  ============================================================================*/

  var readmore = '&nbsp;<a href="javascript:;" id="para-read-more">Read more...</a>';
  var readless = '&nbsp;<a href="javascript:;" id="para-read-less">Read less...</a>';

  $('.extensive-content').hide();

  // If there is extra content, build a readmore link
  var extraContent = (carawebsProjectVars.secondContent);
  if ('true' == extraContent) $('.post_content p:last-child').append(readmore);
  $('.extensive-content p:last-child').append(readless);
  $('a#para-read-less').toggle();

  $('a#para-read-more').click(function () {

    //event.preventDefault();

        $('.extensive-content').slideToggle('200');
        $('.extensive-content p:last-child').append( readless);
        $('a#para-read-more').toggle();
        $('a#para-read-less').toggle();

    });

  $('a#para-read-less').click(function () {

        $('a#para-read-more').toggle();
        $('a#para-read-less').toggle();

        $('.extensive-content').slideToggle('200');

    });


})(jQuery);
