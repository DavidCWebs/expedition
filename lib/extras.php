<?php

namespace Roots\Sage\Extras;

use Roots\Sage\Config;

function carawebs_body_class($classes) {

  // Add post/page slug
  if (is_single() || is_page() || is_archive() && !is_front_page()) {
    if (!in_array(basename(get_permalink()), $classes)) {
      $classes[] = basename(get_permalink());
    }

    if( is_singular( 'project' ) ){

      $classes[]  = 'project';
      $classes[]  = 'template-single-project';

    }

  }
  return $classes;
}

add_filter('body_class', 'Roots\Sage\Extras\carawebs_body_class');

function carawebs_featured_image( $page_ID ){

  if ( has_post_thumbnail( $page_ID ) ) {

    $image_array = wp_get_attachment_image_src( get_post_thumbnail_id( $page_ID ), 'carawebs_frontpage_thumbnail' );
    $image = $image_array;

    } else {

    $image = get_template_directory_uri() . '/assets/images/default-project-teaser.jpg';

  }

  return $image;

}

/**
 * HTML footer in quarter-quarter-half layout
 * @return [type] [description]
 *
 *
 */
function carawebs_footer_layout(){

  $layout_option = get_field( 'select_footer_layout', 'option' );

  if( 'quarters' == $layout_option ){

    ob_start();
    ?>
    <div id="footer">
    	<div id="footer_page_wrapper" class="columns_211 page_wrapper page_background">
    		<div class="footer_top_border"></div>
        <div class="half left">
          <div class="nested_halves">
        		<div class="half left">
        			<div itemscope itemtype="http://schema.org/Organization">
                <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
                  <p>
                    <span itemprop="name">Expedition Engineering</span><br/>
                    <span itemprop="streetAddress"><?php the_field('address_line_1', 'option')?></span><br/>
                    <span itemprop="streetAddress"><?php the_field('address_line_2', 'option')?></span><br/>
                    <span itemprop="addressLocality"><?php the_field('town', 'option')?></span>,&nbsp;
                    <span itemprop="postalCode"><?php the_field('postcode', 'option')?></span>
                  </p>
                </div>
                <p>
                  <span itemprop="telephone"><span class="address_titles">Phone:</span><?php the_field('phone_number', 'option'); ?></span><br/>
                  <span itemprop="fax"><span class="address_titles">Fax:</span><?php the_field('fax_number', 'option'); ?></span><br/>
                  <span itemprop="email"><span class="address_titles">Email:</span><a href="mailto: <?php the_field('contact_email', 'option'); ?>"><?php the_field('contact_email', 'option'); ?></a></span>
                </p>
              </div>
              <div class="social_menu_wrapper">
                <?php
                if (has_nav_menu('social_menu')) :
                  wp_nav_menu(['theme_location' => 'social_menu', 'walker' => new \Walker_Nav_Menu(), 'menu_class' => 'menu', 'menu_id' => 'menu-social-menu']);
                endif;
                ?>
        			</div>
              <p>Site by <a href="http://carawebs.com">Carawebs</a></p>
        		</div>
        		<div class="half right">
        			<?php the_field( 'ust_link', 'option' ); ?>
        		</div>
          </div><!-- end nested columns_211 -->
      </div>
    		<div class="half right footer_box">
          <?php the_field( 'company_description', 'option' ); ?>
    		</div>
    	</div>
    </div><?php
    $var = ob_get_clean();

    echo $var;
  }

  if ( 'thirds' == $layout_option ){

    ob_start();
    ?>
    <div id="footer">
    	<div id="footer_page_wrapper" class="page_wrapper page_background">
    		<div class="footer_top_border"></div>
        <div class="third first">
          <div itemscope itemtype="http://schema.org/Organization">
            <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
              <p>
                <span itemprop="name">Expedition Engineering</span><br/>
                <span itemprop="streetAddress"><?php the_field('address_line_1', 'option')?></span><br/>
                <span itemprop="streetAddress"><?php the_field('address_line_2', 'option')?></span><br/>
                <span itemprop="addressLocality"><?php the_field('town', 'option')?></span>,&nbsp;
                <span itemprop="postalCode"><?php the_field('postcode', 'option')?></span>
              </p>
              <p>
                <span itemprop="telephone"><span class="address_titles">Phone:</span><?php the_field('phone_number', 'option'); ?></span><br/>
                <span itemprop="fax"><span class="address_titles">Fax:</span><?php the_field('fax_number', 'option'); ?></span><br/>
                <span itemprop="email"><span class="address_titles">Email:</span><a href="mailto: <?php the_field('contact_email', 'option'); ?>"><?php the_field('contact_email', 'option'); ?></a></span>
              </p>
            </div>
          </div>
          <div class="social_menu_wrapper">
            <?php
            if (has_nav_menu('social_menu')) :
              wp_nav_menu(['theme_location' => 'social_menu', 'walker' => new \Walker_Nav_Menu(), 'menu_class' => 'menu', 'menu_id' => 'menu-social-menu']);
            endif;
            ?>
    			</div>
          <p>Site by <a href="http://carawebs.com">Carawebs</a></p>
        </div>
        <div class="third">
    			<?php the_field( 'ust_link', 'option' ); ?>
        </div>
      	<div class="third footer_box">
          <?php the_field( 'company_description', 'option' ); ?>
      	</div>
    	</div>
    </div><?php
    $var = ob_get_clean();

    echo $var;
  }

}

/**
 * Set Up Options pages for ACF.
 *
 *
 */
if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
		'page_title' 	=> 'Site Footer Settings & Content',
		'menu_title'	=> 'Site Footer',
		'menu_slug' 	=> 'site-footer-settings',
		'capability'	=> 'edit_pages',
		'redirect'		=> false
	));

}

/**
 * Set up menu
 */
register_nav_menus(array(
    'social_menu' => __('Social Menu', 'carawebs')
  ));

/**
 * Encode email address of mailto: links in navigation
 *
 * Borrowed from Twenty Fifteen Theme
 *
 * @return array HTML attributes for Menu item
 */
function carawebs_nav_encode_email( $atts, $item, $args ) {

	if ( preg_match( '/^mailto:(.+)/', $atts['href'], $match ) ) {

		$atts['href'] = 'mailto:' . antispambot( $match[1] );

	}
	return $atts;
 }

add_filter( 'nav_menu_link_attributes', 'Roots\Sage\Extras\carawebs_nav_encode_email', 10, 3 );

/**
 * [carawebs_first_projects_front_page description]
 * @param  [type] $page_ID [description]
 * @return [type]          [description]
 */
function carawebs_first_projects_front_page( $page_ID ){

  $stages = get_post_meta( $page_ID, 'first_featured_articles', true );

  $projects = '';

  if( $stages ) {
      for( $i = 0; $i < $stages; $i++ ) {

        $article_ID = esc_html( get_post_meta( get_the_ID(), 'first_featured_articles_' . $i . '_article', true ) );

        $orient_class = 0 == $i ? 'half left' : 'half right';

        $permalink = get_the_permalink( $article_ID );
        $article_title = get_the_title( $article_ID );
        $image_array = carawebs_featured_image( $article_ID );
        $image_url = $image_array[0];
        $post_type = get_post_type( $article_ID );

        if ( 'thinking' == $post_type ){

          // If thinking...
          $excerpt = carawebs_custom_excerpt_ellipsis( $article_ID, 'return' );

          $projects .= <<<EOF
          <div class="$orient_class">
            <div class="query_box first_teaser half visible_overlay_container">
                <div class="excerpt_overlay_background"></div>
                <div class="headline_container">
                <h2 class="headline overlay_headline"><a href="$permalink" rel="bookmark">$article_title</a></h2>
                </div>
                <div class="visible_excerpt">
                    <div class="post_content post_excerpt">
                    <!--<a href="$permalink">-->
                        $excerpt
                    <!--</a>-->
                    </div>
                </div>
                <a class="featured_image_link" href="$permalink">
                  <img width="616" height="455" src="$image_url" class="aligncenter wp-post-image" alt="biomimetic-offic-expedition-engineering-1" />
                </a>
            </div>
          </div>
EOF;

        } elseif ( 'project' == $post_type ){

          // if Project
          $container_class = "overlay_container";
          $excerpt_div = '';
          $overlay_background = '';

          $projects .= <<<EOF
          <div class="$orient_class">
            <div class="query_box first_teaser half overlay_container">
              <a class="featured_image_link" href="$permalink">
                <img width="620" height="455" src="$image_url" class="attachment-carawebs_frontpage_thumbnail wp-post-image" alt="WWF-living-planet-centre-surrey-expedition-engineering-1" />
              </a>
              <div class="overlay">
                  <h2 class="headline overlay_headline"><a href="$permalink" rel="bookmark">$article_title</a></h2>
                  <!--<div class="post_content post_excerpt overlay_excerpt"></div>
                  <p><a class="read_more" href="$permalink">Read More</a></p>-->
              </div>
            </div>
          </div>
EOF;

      }

    }

      return $projects;

    }

}

function return_ID( $page_ID){

  return $page_ID;
}

/**
 * Add <body> classes
 */
function body_class($classes) {
  // Add page slug if it doesn't exist
  if (is_single() || is_page() && !is_front_page()) {

    if (!in_array(basename(get_permalink()), $classes)) {

      $classes[] = basename(get_permalink());

    }

  }

  // Add class if sidebar is active
  if (Config\display_sidebar()) {
    $classes[] = 'sidebar-primary';
  }

  return $classes;
}
add_filter('body_class', __NAMESPACE__ . '\\body_class');

/**
 * Clean up the_excerpt()
 */

/*function excerpt_more() {
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
}
add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');

*/

function carawebs_staffpage_content() {

	if( is_user_logged_in() ) {

		the_content();

	} else {

		echo '<h1>Expedition Staff Area</h1><p>Sorry - you\'re either not logged in, or you don\'t have permission to view this content.</p>';
		echo '<p><a href="' . wp_login_url( get_the_permalink() ) . '" title="Login">Login to the Site</a></p>';

	}

}

//add_action( 'hook_top_controlled_staff_content', 'carawebs_staffpage_content' );

/* Category Custom Description
 *
 * This function brings through the category_introduction field from the category description page - for the sub category pages */

function carawebs_category_description() {

	$catID = get_query_var('cat');

	if(get_field('category_introduction', 'category_'.$catID )):

	// The ACF API references taxonomies in the format 'taxonomyname_taxonomyID'

   ?><div class="post_content"><?php

   the_field('category_introduction', 'category_'.$catID);

   ?></div><?php

   endif;

}

//add_action('hook_after_category_intro', 'carawebs_category_description');

/*==============================================================================
  Detect Phones, not tablets
==============================================================================*/
/*
function carawebs_is_phone() {
	$useragent=$_SERVER['HTTP_USER_AGENT'];
	if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
    return true;
  } else {
	   return false;
   }
   return false;
}
*/
/*==============================================================================
  Front Page Flexslider
  ============================================================================*/

function carawebs_frontpage_slider() {

   $slider_images = get_field('slider_images');

   if(!empty($slider_images) ){ // run if the repeater field has content

    ?><div id="slider" class="flexslider">
        <ul class="slides"><?php

        while( has_sub_field('slider_images') ){

            // ACF image field outputs attachment ID
            $attachment_id = get_sub_field('image');
            $size = "large"; // (thumbnail, medium, large, full or custom size)
            $image = wp_get_attachment_image_src( $attachment_id, $size );

              ?>
                    <li>
											<?php

											echo "<img src='$image[0]' title='title'/>";

											?>
                        <!--<img src="<?php echo $image[0]; ?>" />-->
                    </li>
                <?php

          } // End the while loop

					// If the last image < 620px, add some extra padding

      ?></ul>
    </div><!-- /#slider --><?php

    }

}

//add_action('hook_bottom_frontpage_slider', 'carawebs_frontpage_slider');

/*==============================================================================
  Detect Phones, not tablets
==============================================================================*/

function carawebs_is_phone() {

	$useragent=$_SERVER['HTTP_USER_AGENT'];

	if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||
	preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){

		return true;

	} else {

		return false;
	}

}

/*==============================================================================
  Project Page iosSlider
  ============================================================================*/

function carawebs_project_slider() {

  $slider_images = get_field('project_images');

  if(!empty($slider_images) ){ // run if the repeater field has content

    $is_phone = carawebs_is_phone();

        if ( $is_phone == true ){

        //No slider - get the first image
        $rows = get_field('project_images' ); // get all the rows
        $first_row = $rows[0]; // get the first row
        $first_row_image = $first_row['image' ]; // get the sub field value

        // Note
        // $first_row_image = a numerical image ID

        $first_image = wp_get_attachment_image_src( $first_row_image, 'full' );
        $first_image_url = $first_image[0];
        // url = $image[0];
        // width = $image[1];
        // height = $image[2];
        ?>
        <img src="<?php echo $first_image[0]; ?>" /><?php


        } else {

          // It's not a phone, so build a slider
          $rows = get_field('project_images' ); // get all the rows
          $first_row = $rows[0]; // get the first row
          $first_row_image = $first_row['image' ]; // get the sub field value
          $first_image = wp_get_attachment_image_src( $first_row_image, 'full' );
          $first_image_url = $first_image[0];


          // Build the first image separately - show this when screen size < 660 pixels - set in CSS
          ?><div class ="first-project-image"><img src="<?php echo $first_image_url; ?>" /></div>
          <div class = 'sliderContainer'>

            <!--Loader icon -->
            <div id="floatingCirclesG">
            <div class="f_circleG" id="frotateG_01">
            </div>
            <div class="f_circleG" id="frotateG_02">
            </div>
            <div class="f_circleG" id="frotateG_03">
            </div>
            <div class="f_circleG" id="frotateG_04">
            </div>
            <div class="f_circleG" id="frotateG_05">
            </div>
            <div class="f_circleG" id="frotateG_06">
            </div>
            <div class="f_circleG" id="frotateG_07">
            </div>
            <div class="f_circleG" id="frotateG_08">
            </div>
          </div>
          <!-- icon end -->

          <div class = 'iosSlider'>
                  <div class = 'slider'><?php

									//$total = 0;
									//while( has_sub_field('project_images') ) { $total++; } // $total = total number of slides

									//echo "total: $total";

										//$count = 1;
                    while( has_sub_field('project_images') ) { // Loop through ACF repeater field images

                    // ACF image field outputs attachment ID
                    $attachment_id = get_sub_field('image');
                    $size = 'full'; // (thumbnail, medium, large, full or custom size)
                    $image = wp_get_attachment_image_src( $attachment_id, $size );

										//echo "<pre>";
										//var_dump( $image );
										//echo "</pre>";

                      ?><div class = "item">
                              <div class = "inner">
																<?php

																	echo "<img class='no-fouc' src='$image[0]' width='$image[1]' height='$image[2]'/>";

																?>
                                <!--<img class="no-fouc" src = "<?php //echo $image[0]; ?>" />-->
                              </div>
                        </div><?php

                  	//$count++;

									} // End the while loop

                  ?>
                  <!--Dummy End Slide-->
                  <div class = "item">
                          <div class = "inner">
                            <img class="no-fouc dummy-slide" src="<?php echo THESIS_USER_SKIN_URL . '/images/blank-slide-full-width.png'; ?>"/>
                          </div>
                  </div>
                </div>
          </div><!-- /.iosSlider -->
          <div class = 'scrollbarContainer'></div>
        </div><?php

      }

    }

}

add_action('hook_after_dynamic_slider', 'carawebs_project_slider');

// Add featured images under content at small screen sizes

function carawebs_project_image_stream(){

  if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){

    $is_phone ='true';

    } else {

    $is_phone = 'false';

    }

    // if this is a mobile phone, build the image stream
    //if ($is_phone == 'false'){

      if(get_field('project_images')) { $i = 0;
          while(has_sub_field('project_images')): $i++;
            if ($i != 1):
              // ACF image field outputs attachment ID
              $attachment_id = get_sub_field('image');
              $size = 'medium'; // (thumbnail, medium, large, full or custom size)
              $image = wp_get_attachment_image_src( $attachment_id, $size );

                ?><div class = "project-image"><img src = "<?php echo $image[0]; ?>" /></div><?php

            endif;
          endwhile;
      }

    //} else {

      //return;

    //}


}

//add_action('hook_after_image_stream', 'carawebs_project_image_stream');

/*==============================================================================
  Featured Image Meta Box
==============================================================================*/

// See wpse4270

function carawebs_projects_image_instruction( $content ) {

      return $content .= '<p>For proper display please ensure that the Featured Image for this project is at least <span style="font-weight: bold;">500 x 303 pixels</span>.</p><p>This is a representative image that will be shown throughout the site as a preview.</p><p>Click the link above to add or change the featured image. </p>';

}

function carawebs_person_image_instruction( $content ) {

      return $content .= '<p>For proper display please ensure that the Featured Image for this person is at least <span style="font-weight: bold;">256 x 240 pixels</span>. Ideally, the image you upload should be exactly this size. Larger images will be cropped.</p><p>This is a representative image that will be shown throughout the site as a preview.</p><p>Click the link above to add or change the featured image. </p>';

}


function carawebs_basic_image_instruction( $content ) {

      return $content .= '<p>This is a representative image that will be shown throughout the site as a preview.</p><p>Click the link above to add or change the featured image. </p>';
}


add_action( 'admin_head-post.php', 'Roots\Sage\Extras\carawebs_featured_images_instruction' ); // This hook targets the post editing page


function carawebs_featured_images_instruction() { // Function adds filters

// Globalize the $post variable
global $post;


    if ( 'project' == $GLOBALS['post_type'] ) { // Check to see if this is a 'project' CPT

        add_filter( 'admin_post_thumbnail_html', 'Roots\Sage\Extras\carawebs_projects_image_instruction' ); // ...if it is, change the admin post thumbnail html accordngly

    } elseif ( 'person' == $GLOBALS['post_type'] ) { // Check to see if this is a 'person' post type

        add_filter( 'admin_post_thumbnail_html', 'Roots\Sage\Extras\carawebs_person_image_instruction' );

    } else {

      add_filter( 'admin_post_thumbnail_html', 'Roots\Sage\Extras\carawebs_basic_image_instruction' );

    }
}

/*==============================================================================
  Extra content for show/hide on project pages
  ============================================================================*/

function carawebs_additional_project_content() {

  $extra = get_field('extra_content');

  if( !empty($extra) ) {

    echo '<div class="extensive-content">' . $extra . '</div>';

  }

}

//add_action('hook_before_project_additional_content', 'carawebs_additional_project_content');

/*==============================================================================
	The Google Map Script
	============================================================================*/

/* Add Google Map Script to Specific Page */

function cw_map_style() {

	// Define styles for the map_canvas - run on the contact page only
	if (is_page('388')) {
		echo '<style>#map_canvas { width: 100%; height: 548px; }</style>';
	}
}

function carawebs_initialise_googlemaps(){

	if (is_page('388')) {
	    $googlescript = '<script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>';
	    echo $googlescript;
	}
}

function carawebs_googlemaps_control(){

	if (is_page('388')) {

    // Register the control script - in a folder called js in the active Thesis skin
    wp_register_script( 'carawebs_googlemap', get_template_directory_uri() . '/assets/scripts/vendor/google-map.js');

	// Pass variables to the script - this avoids having to hardcode the map marker in javascript
	$imagelocation = get_template_directory_uri() . '/assets/images/expedition_marker.png';
	$site_variables = array(
    'markerImage' => $imagelocation
    );

	wp_localize_script( 'carawebs_googlemap', 'carawebsMapVars', $site_variables ); // This function makes variables available to carawebs_googlemap

	// Enqueue the masonry controls - they will be built into the footer
    wp_enqueue_script('carawebs_googlemap');

	}
}

// Add hooks for front-end - order is important
add_action('wp_head', 'Roots\Sage\Extras\cw_map_style', 1);
add_action('wp_head', 'Roots\Sage\Extras\carawebs_initialise_googlemaps', 2);
add_action('wp_enqueue_scripts', 'Roots\Sage\Extras\carawebs_googlemaps_control', 105);

/*==============================================================================
	Enqueue JS on project pages
	============================================================================*/
function carawebs_enqueue_project_scripts () {

	if (is_singular('project')) {

    //get_template_directory_uri() . '/assets/scripts/vendor

    wp_register_script( 'project-page-script', get_template_directory_uri() . '/assets/scripts/vendor/project-page.js', array( 'jquery' ), null, true);

    $extra = get_field('extra_content');

    if( !empty($extra)) {

      $second_content = 'true';

    } else {

      $second_content = 'false';

      }

		$project_variables = array(
			'secondContent' => $second_content
			);

		wp_localize_script( 'project-page-script', 'carawebsProjectVars', $project_variables );

		wp_enqueue_script('project-page-script');

	}
}

add_action('wp_enqueue_scripts', 'Roots\Sage\Extras\carawebs_enqueue_project_scripts');

function carawebs_custom_js() {
    echo '<script type="text/javascript">
      jQuery("html").addClass("js");
    </script>';
}

// Add hook for front-end <head></head>
add_action('wp_head', 'Roots\Sage\Extras\carawebs_custom_js');

/*==============================================================================
	Slider script enqueue on proper pages
	============================================================================*/
function carawebs_enqueue_slider () {

	if (is_front_page()){

		wp_register_script( 'flexslider', get_template_directory_uri() . '/assets/scripts/vendor/jquery.flexslider-min.js', array( 'jquery' ), null, false);
		wp_register_script( 'flexslider_control', get_template_directory_uri() . '/assets/scripts/vendor/flexslider-control.js', array( 'jquery' ), null, false);

		wp_enqueue_script('flexslider');
		wp_enqueue_script('flexslider_control');

	}

	if (is_singular('project')) {

		//jquery.iosslider.min
		//wp_register_script( 'ios_slider', THESIS_USER_SKIN_URL . '/js/jquery.iosslider.min.js', array( 'jquery' ), null, false);
    wp_register_script( 'ios_slider', get_template_directory_uri() . '/assets/scripts/vendor/jquery.iosslider.js', array( 'jquery' ), null, false);
		wp_register_script( 'ios_slider_control', get_template_directory_uri() . '/assets/scripts/vendor/ios-slider-control.js', array( 'jquery' ), null, true);

    //wp_register_script( 'swiper_slider', THESIS_USER_SKIN_URL . '/js/idangerous.swiper.min.js', array( 'jquery' ), null, false);
    //wp_register_script( 'swiper_scrollbar', THESIS_USER_SKIN_URL . '/js/idangerous.swiper.scrollbar.min.js', array( 'jquery' ), null, false);
    //wp_register_script( 'swiper_slider_control', THESIS_USER_SKIN_URL . '/js/swiper-control.js', array( 'jquery' ), null, true);

		wp_enqueue_script('ios_slider');
		wp_enqueue_script('ios_slider_control');


    //wp_enqueue_script('swiper_slider');
    //wp_enqueue_script('swiper_scrollbar');
    //wp_enqueue_script('swiper_slider_control');

	}
}

add_action('wp_enqueue_scripts', 'Roots\Sage\Extras\carawebs_enqueue_slider', 106);


/*==============================================================================
	Set fallback image
	============================================================================*/
/*
add_filter( 'post_thumbnail_html', 'carawebs_default_thumbnail' );

function carawebs_default_thumbnail( $html ) {



			if ( empty( $html ) )
				$html = '<img src="' . THESIS_USER_SKIN_URL . '/images/default.jpg' . '" alt="" />';

			return $html;
}*/

add_filter('post_thumbnail_html', 'carawebs_default_thumbnail');

function carawebs_default_thumbnail($html) {

  if (is_home()) {

    if ( empty( $html ) )
	$html = '<img src="' . THESIS_USER_SKIN_URL . '/images/default.jpg' . '" alt="" />';

	return $html;
	}


  else {
     return $html;
	}
}

/*==============================================================================
	jQuery Masonry
	============================================================================*/

// Add Masonry and link to masonry control script file into footer

function cw_enqueue_masonry() {

	// Run on the front page (static page) only
	if (is_home()) {

    // Register the control script - in a folder called js in the active Thesis skin
    wp_register_script( 'masonry_control', THESIS_USER_SKIN_URL . '/js/masonry_control.js', array( 'jquery' ), null, true);

	// Don't need to register masonry as it already has a WP handle - just enqueue it, and WP builds it into footer
	wp_enqueue_script('jquery-masonry', '', array('jquery'), '', true);

	// Enqueue the masonry controls - they will be built into the footer
    wp_enqueue_script('masonry_control', '', array('jquery'), '', true);

    }
}

// Bring link to masonry and control script through on front end
add_action('wp_enqueue_scripts', 'Roots\Sage\Extras\cw_enqueue_masonry', 10, 0);

/* Add CSS for masonry into head- this MUST be in head rather than in stylesheet
 *
 * Define the masonry container as #linky. Masonry units as .boxy, .boxy2
 *
 * Important to define widths
 *
 */


function cw_masonry_css() {

	// Run on the front page (static page) only
	if (is_home()) {
		// change #linky from 350 to 100% line 62
		echo '
		<style type="text/css">
			#linky { width:100%; }
			#linky .boxy { width: 300px; }

			/*@media only screen and (max-width:660px),
				screen and (max-device-width:660px) {
				#linky { width: 350px; }
				.boxy { max-width: 100%; width:auto; height: auto; }
				}*/
			@media only screen and (max-width:340px),
				screen and (max-device-width:340px) {
				#linky { width:100%; }
				#linky .boxy { width: 100%;}
				}
			@media (min-width: 980px){
				#linky { width:100%; }
				#linky .boxy { width: 300px; }
				}
		</style>
		';
	}
}

// Add hook for front-end
add_action('wp_head', 'Roots\Sage\Extras\cw_masonry_css');

// End masonry setup

/*==============================================================================
	Force medium image crop
	============================================================================*/

function carawebs_force_crop() {

	if(false === get_option("medium_crop")) {
			add_option("medium_crop", "1");
		} else {
			update_option("medium_crop", "1");
		}

	if(false === get_option("large_crop")) {
			add_option("large_crop", "1");
		} else {
			update_option("large_crop", "1");
		}
	}

add_action ('add_attachment','carawebs_force_crop');



/*==============================================================================
	Display Project Info
	============================================================================*/

function carawebs_project_fields() {

	if (get_field('project_info')){

		$project_info = the_field('project_info');

		echo '<div class="project-details">' . $project_info . '</div>';


	}

}
//add_action('hook_top_project_intro', 'carawebs_project_fields');

/*==============================================================================
	Add CPTs to main query
	============================================================================*/

// Show posts of 'post', 'page' and 'project' post types in the main query
// Doesn't fire on admin pages or blog (home) page

add_action( 'pre_get_posts', 'Roots\Sage\Extras\carawebs_post_types_to_query' );

function carawebs_post_types_to_query( $query ) {

	if ( ! is_admin() && ! is_home() && $query->is_main_query() )
		$query->set( 'post_type', array( 'post', 'page', 'project', 'people', 'thinking' ) );
	return $query;
}


/*==============================================================================
	Home page link
	============================================================================*/

function carawebs_home_link() {

	?>
		<a href="<?php $blogurl = bloginfo('url') ; ?>" title="<?php bloginfo('name'); ?>">

			<div id="site_logo"></div>

		</a>

	<?php

}

//add_action('hook_top_site_logo', 'carawebs_home_link');

/*==============================================================================
	Enqueue Global Scripts
	============================================================================*/
/*
add_action( 'wp_enqueue_scripts', 'Roots\Sage\Extras\carawebs_load_common_javascript_files' );

function carawebs_load_common_javascript_files() {

	wp_register_script( 'global_scripts', get_template_directory_uri() . '/assets/scripts/common_scripts.js', array( 'jquery' ), '1.0', true);

	wp_enqueue_script('global_scripts');

}
*/
/*==============================================================================
	Greyscale jQuery filter
	============================================================================

add_action( 'wp_enqueue_scripts', 'carawebs_bw_javascript' );

function carawebs_bw_javascript() {

	if ( is_category('13') || is_singular ('people')) { // Conditional - is it the archive page for "people" category or is it a "person" CPT

		wp_register_script( 'bw_scripts', THESIS_USER_SKIN_URL . '/js/pixastic.custom.js', array( 'jquery' ), '1.0', true);
		wp_register_script( 'bw_control', THESIS_USER_SKIN_URL . '/js/bw_control.js', array( 'jquery' ), '1.0', true);

		wp_enqueue_script('bw_scripts');
		wp_enqueue_script('bw_control');

	}
}

function carawebs_head_custom_js() { // Prevent FOUC

	if( is_category('13') || is_singular ('people') ) {
        	echo '<style type="text/css">.js #flash {display: none;}</style>';
			echo '<script type="text/javascript">';
			echo 'document.documentElement.className = ';
			echo "'js';</script>";
		}
	else {
		return;
	}

}

// Add hook for front-end <head></head>
add_action('wp_head', 'carawebs_head_custom_js');

/*==============================================================================
	Carawebs Trim All Excerpts
	============================================================================*/

function carawebs_trim_all_excerpt($text) {
// Creates an excerpt if needed; and shortens the manual excerpt as well
global $post;
  $raw_excerpt = $text;
  if ( '' == $text ) {
    $text = get_the_content('');
    $text = strip_shortcodes( $text );
    $text = apply_filters('the_content', $text);
    $text = str_replace(']]>', ']]&gt;', $text);
  }

$text = strip_tags($text);
$excerpt_length = apply_filters('excerpt_length', 18);
$excerpt_more = apply_filters('excerpt_more', '');
$text = wp_trim_words( $text, $excerpt_length, $excerpt_more );

return apply_filters('wp_trim_excerpt', $text, $raw_excerpt);
}

remove_filter('get_the_excerpt', 'wp_trim_excerpt');

add_filter('get_the_excerpt', 'Roots\Sage\Extras\carawebs_trim_all_excerpt');



function carawebs_custom_excerpt() {

	$str = get_the_excerpt();

	$trimmed = rtrim ( $str, ".,:;!?" );

	// Echo to the page and add a Read More link
	?><div class="post_content post_excerpt">

		<p><?php echo $trimmed; ?>&hellip;<a class="readmore" href="<?php echo get_permalink();?>">Read More</a></p>

	</div>
	<?php

}

//add_action ('hook_bottom_custom_excerpt', 'carawebs_custom_excerpt');

/*==============================================================================
	Frontpage "Thinking" excerpt - no readmore link, ellipsis
	============================================================================*/

function carawebs_custom_excerpt_ellipsis( $post_ID, $return_format = 'echo' ) {

	//$str = get_the_excerpt( $post_ID );
	//
	//$post_object = get_post( $post_ID );
  //$post_excerpt = $post_object->post_excerpt;

  $str = get_post_field( 'post_excerpt', $post_ID );

	$trimmed = rtrim ( $str, ".,:;!?" );

  if( 'echo' == $return_format ){

  	// Echo to the page and add an ellipsis
  	echo $trimmed . '&hellip;';

  }

  if( 'return' == $return_format ){

    $excerpt = $trimmed . "&hellip;";

    return $excerpt;

  }

}

//add_action ('hook_bottom_custom_excerpt_ellipsis', 'carawebs_custom_excerpt_ellipsis');

/*==============================================================================
	Add Project Images
	============================================================================*/

function carawebs_add_project_images() {

if(get_field('images')):

	?><h2 class="headline centre centreline">Project Images</h2><?php

	while(has_sub_field('images')): ?>

              <img class="padding_bottom" src ="<?php echo get_sub_field('image'); ?>"title="<?php echo get_sub_field('hover_text'); ?>"><?php

	endwhile;


	endif;
}


//add_action('hook_after_project_images', 'carawebs_add_project_images');

/*==============================================================================
	Add related People
	============================================================================*/

function carawebs_add_related_people() {

	$posts = get_field('related_people');

	if( $posts ): //only displays if field has a value
	        ?><p>People:<br>

				<?php foreach( $posts as $post_object): ?>

	     			<a href="<?php echo get_permalink($post_object->ID); ?>"><?php echo get_the_title($post_object->ID); ?></a><br>

				<?php endforeach; ?>

	<?php endif;

}

//add_action('hook_after_related_people', 'carawebs_add_related_people');


/*==============================================================================
	Test array
 =============================================================================*/

function carawebs_test_arrays() {

	echo "<p>TEST ARRAYS</p>";

		// Test the repeater field array
		$rows = get_field('project_images');
		if($rows)
			{
			$stack = array(); //set up a new array

				foreach($rows as $row) //loop through the repeater field array
				{
					array_push($stack,$row['image']);	//add image data to $stack

				}

			}

		echo "<p>Raw From Stack: ";
		print_r($stack);
		echo "<br>END</p>";

		echo "<p>Imploded From Stack: ";
		$img_ids = implode(',',$stack); // Create a variable that contains comma separated integers
		echo $img_ids ."</p>";


		// Test the gallery array
		echo "<p>From Gallery: ";

		$image_ids = get_field('gallery', false, false);

		$id_array = implode(',', $image_ids);

		echo $id_array ."</p>";

}

//add_action('hook_after_test_arrays', 'carawebs_test_arrays');

/*==============================================================================
	Dynamic Soliloquy
	============================================================================*/
/*
function carawebs_dynamic_soliloquy(){

	//from image repeater field
	$rows = get_field('project_images');

		if($rows)
		{
			$stack = array();
			foreach($rows as $row)
			{
				array_push($stack,$row['image']);

			}

		}

		$img_ids = implode(',',$stack);


	//Generate the slider: $img_ids from repeater $id_array from gallery --see line 316
	//soliloquy_dynamic( array( 'id' => 'custom-project-images', 'images' => $img_ids, 'crop' => 'true', 'link' => 'file', 'thumbnails' => 'true', 'thumbnails_width' => '140', 'thumbnails_margin' => '20', 'thumbnails_min' => '4' ) );
	soliloquy_dynamic( array( 'id' => 'custom-project-images', 'images' => $img_ids, 'crop' => 'true', 'thumbnails' => 'true', 'thumbnails_width' => '140', 'thumbnails_margin' => '20', 'thumbnails_min' => '4' ) );

}

add_action('hook_bottom_dynamic_soliloquy', 'carawebs_dynamic_soliloquy');
*/
/*==============================================================================
	Add Frontpage Slider
	============================================================================*/
/*
function carawebs_main_slider() {

	if ( function_exists( 'soliloquy_slider' ) ) soliloquy_slider( '222' );

}

add_action('hook_bottom_main_slider', 'carawebs_main_slider');

//Add Projects Slider/

function carawebs_projects_slider() {

	$post = get_field('image_slider'); //
	$slider_id = $post->ID;

	wp_reset_postdata();

if ( function_exists( 'soliloquy_slider' ) ) soliloquy_slider( $slider_id );


}
add_action('hook_bottom_projects_slider', 'carawebs_projects_slider');

*/

/*==============================================================================
	Theme support: Thumbnails & custom image sizes
	============================================================================*/

add_theme_support( 'post-thumbnails' );

add_action('after_setup_theme','Roots\Sage\Extras\carawebs_bw_size');

function carawebs_bw_size() {

	if ( function_exists( 'add_image_size' ) ) {
	//add_image_size('carawebs-bw-image', 140, 160, true);
	//add_image_size('carawebs_headshot', 140, 160, true);
	add_image_size('carawebs_person', 300, 380, true);
	//add_image_size('carawebs_frontpage_thumbnail', 600, 440, true); // Add thumbnails for frontpage to allow re-sizing
	add_image_size('carawebs_frontpage_thumbnail', 620, 455, true); // Add thumbnails for frontpage to allow re-sizing
	}
}

/*add_filter('wp_generate_attachment_metadata','gholumns_grayscale_filter');

function gholumns_grayscale_filter($meta)
{
$file = $meta['sizes']['carawebs-bw-image']['file'];
$meta['sizes']['carawebs-bw-image']['file'] = do_grayscale_filter($file);

return $meta;
}


function do_grayscale_filter($file)
{
$dir = wp_upload_dir();
$image = wp_load_image(trailingslashit($dir['path']).$file);
imagefilter($image, IMG_FILTER_GRAYSCALE);
return save_modified_image($image, $file, '-grayscale');
}

function save_modified_image($image, $filename, $suffix)
{
$dir = wp_upload_dir();
$dest = trailingslashit($dir['path']).$filename;
//$dest = trailingslashit($dir) . $filename;

list($orig_w, $orig_h, $orig_type) = @getimagesize($dest);

$filename = str_ireplace(array('.jpg', '.jpeg', '.gif', '.png'), array($suffix.'.jpg', $suffix.'.jpeg', $suffix.'.gif', $suffix.'.png'), $filename);
$dest = trailingslashit($dir['path']).$filename;
//$dest = trailingslashit($dir).$filename;

switch ($orig_type)
{
    case IMAGETYPE_GIF:
        imagegif( $image, $dest );
        break;
    case IMAGETYPE_PNG:
        imagepng( $image, $dest );
        break;
    case IMAGETYPE_JPEG:
        imagejpeg( $image, $dest );
        break;
}

return $filename;
}
*/

function carawebs_add_bw_image () {
	/*
	if(function_exists('has_post_thumbnail') && has_post_thumbnail()) {
	echo '<a href="'.get_permalink().'" class="fade-image">';
	the_post_thumbnail('carawebs-bw-image', array('class'=>'fade-image-a'));
	the_post_thumbnail('carawebs_headshot', array('class'=>'fade-image-b'));
	echo '</a>';
	}
	* */
	$headshot = get_field('headshot_image');
	$personlink = get_permalink();

	if(empty($headshot)) {

		?>
		<a href="<?php echo $personlink; ?>"><img src="http://www.carawebstest.com/exp/wp-content/uploads/2014/03/person-headshot-default.jpg" title="<?php echo get_the_title(); ?>"></a>
		<?php

	}

	else
	{
		?>
		<a href="<?php echo $personlink; ?>"><img src="<?php echo $headshot; ?>" title="<?php echo get_the_title(); ?>"></a>
		<?php
	}

}


//add_action ('hook_after_bw_thumb', 'carawebs_add_bw_image');

/*====================================================================*/

/* Add Titles on Person Page */

function cw_person_title () {

	$query_id = get_the_ID(); // ID of the query box post - used later to return a custom field for this post
	$person_title = get_the_title($post->ID); // gets the title of the query box post
	$person_url = get_permalink($post->ID);


	wp_reset_query();
	$parent_title = get_the_title($post->ID); // gets the title of the containing post/page

	$active = 'active';

	if ( $parent_title == $person_title) { // h4 gets the class "active" if the titles match

		echo "<h4 class =$active>";
		echo $person_title;
		echo "</h4>";
	}

	else  {

		?><h4><a href ="<?php echo $person_url; ?>"><?php echo $person_title; ?></a></h4><?php

		//echo "<h4>";
		//echo $person_title;
		//echo "</h4>";
	}

	?><h4 class="subheading"><?php the_field('job_title', $query_id); ?></h4><?php // Subheading from the query box post

}

//add_action ('hook_after_person_title', 'cw_person_title');


/*====================================================================*/

/* Automatically assign "people"custom post types to the category "people" */

function cw_add_people_category_automatically($post_ID) {
	global $wpdb;
	if(!has_term('','category',$post_ID)){
		$cat = array(13);
		wp_set_object_terms($post_ID, $cat, 'category');
	}
}
add_action('publish_people', 'cw_add_people_category_automatically');


/* Automatically assign "thinking" custom post types to the category "thinking" */

function cw_add_thinking_category_automatically($post_ID) {
	global $wpdb;
	if(!has_term('','category',$post_ID)){
		$cat = array(24);
		wp_set_object_terms($post_ID, $cat, 'category');
	}
}
add_action('publish_thinking', 'cw_add_thinking_category_automatically');



/* Automatically assign "project" custom post types to the category "projects"

function cw_add_project_category_automatically($post_ID) {
	global $wpdb;
	if(!has_term('','category',$post_ID)){
		$cat = array(3);
		wp_set_object_terms($post_ID, $cat, 'category');
	}
}
add_action('publish_project', 'cw_add_project_category_automatically');
*/
/*====================================================================*/

/* Add heading to slider */

add_filter( 'tgmsp_after_slider', 'tgm_soliloquy_custom_title_after_slider', 10, 5 );
function tgm_soliloquy_custom_title_after_slider( $slider, $id, $images, $soliloquy_data, $soliloquy_count ) {

    if ( '222' == $id ) { // if slider id ==222, don't do anything
    return $slider;
	}

    else {
    // Build the H1 tag.
    $page_title = get_the_title($post->ID);
    $h1 = '<h1 class="headline project_headline">' . $page_title . '</h1>';

    // Append the tag to the slider.
    return $slider . $h1;
	}

}

/*add_filter( 'tgmsp_dynamic_after_slider', 'tgm_soliloquy_dynamic_title_after_slider', 10, 5 );
function tgm_soliloquy_dynamic_title_after_slider( $slider, $id, $images, $soliloquy_data, $soliloquy_count ) {

    if ( '222' == $id ) { // if slider id ==222, don't do anything
    return $slider;
	}

    else {
    // Build the H1 tag.
    $page_title = get_the_title($post->ID);
    $h1 = '<h1 class="headline project_headline">' . $page_title . '</h1>';

    // Append the tag to the slider.
    return $slider . $h1;
	}

}*/

/*====================================================================*/

/***ADD ABOUT IMAGES****/
function carawebs_about_images() {

if(get_field('extra_images')):

	$i = 1;

	while(has_sub_field('extra_images')):

	?><div class="box<?php echo ( $i > 2 ) ? ' topspace' : '' ;?>"><?php

	$attachment_id = get_sub_field('about_image');
	$size = "medium"; // (thumbnail, medium, large, full or custom size)
 	$image = wp_get_attachment_image_src( $attachment_id, $size );

		// url = $image[0];
		// width = $image[1];
		// height = $image[2];
		?>
			<img src="<?php echo $image[0]; ?>" />
		</div>

		<?php
		$i++;

	endwhile;

	endif;

}


//add_action('hook_after_about_images', 'carawebs_about_images');

/*====================================================================*/

/**DISPLAY SERVICES INFO**/

function carawebs_services_1() {

	if(get_field('service_description_1')):

	while(has_sub_field('service_description_1')):

	?>

		<h3 class="no_top_margin"><?php echo the_sub_field('subheading'); ?></h3>
		<p><?php echo the_sub_field('text'); ?></p>

	<?php

	endwhile;

	endif;

}
/*2*/
function carawebs_services_2() {

	if(get_field('service_description_2')):

	while(has_sub_field('service_description_2')):

	?>

		<h3 class="no_top_margin"><?php echo the_sub_field('subheading'); ?></h3>
		<p><?php echo the_sub_field('text'); ?></p>

	<?php

	endwhile;

	endif;

}
/*3*/
function carawebs_services_3() {

	if(get_field('service_description_3')):

	while(has_sub_field('service_description_3')):

	?>

		<h3 class="no_top_margin"><?php echo the_sub_field('subheading'); ?></h3>
		<p><?php echo the_sub_field('text'); ?></p>

	<?php

	endwhile;

	endif;

}
/*4*/
function carawebs_services_4() {

	if(get_field('service_description_4')):

	while(has_sub_field('service_description_4')):

	?>

		<h3 class="no_top_margin"><?php echo the_sub_field('subheading'); ?></h3>
		<p><?php echo the_sub_field('text'); ?></p>

	<?php

	endwhile;

	endif;

}
/*5*/
function carawebs_services_5() {

	if(get_field('service_description_5')):

	while(has_sub_field('service_description_5')):

	?>

		<h3 class="no_top_margin"><?php echo the_sub_field('subheading'); ?></h3>
		<p><?php echo the_sub_field('text'); ?></p>

	<?php

	endwhile;

	endif;

}
/*6*/
function carawebs_services_6() {

	if(get_field('service_description_6')):

	while(has_sub_field('service_description_6')):

	?>

		<h3 class="no_top_margin"><?php echo the_sub_field('subheading'); ?></h3>
		<p><?php echo the_sub_field('text'); ?></p>

	<?php

	endwhile;

	endif;

}
/*add_action('hook_bottom_services_1', 'carawebs_services_1');
add_action('hook_bottom_services_2', 'carawebs_services_2');
add_action('hook_bottom_services_3', 'carawebs_services_3');
add_action('hook_bottom_services_4', 'carawebs_services_4');
add_action('hook_bottom_services_5', 'carawebs_services_5');
add_action('hook_bottom_services_6', 'carawebs_services_6');*/

/*====================================================================*/

/*====================================================================*/

/* News Category Archive Intro */

function carawebs_news_category_archive_intro() {

	$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
	$news_page_id = get_option( 'page_for_posts');
	$news_page_url = get_page_link($news_page_id);

		?><p>This page contains <a href ="<?php echo $news_page_url; ?>">News</a> articles in the "<?php echo $term->name; ?>" category.<p>
		<?php

}

//add_action('hook_after_news_cat_intro','carawebs_news_category_archive_intro');

/*====================================================================*/

/* Back to Category Link */

function carawebs_back_to_category() {

	$category = get_the_category();
	$category_url = get_category_link($category[0]->term_id );
	$category_name = $category[0]->cat_name;


	if($category[0]){
		?><p class="paramove"><a class ="category_link" href="<?php echo $category_url; ?>">Back to <?php echo $category_name; ?></a></p><?php

		}

}

//add_action('hook_after_back_to_category', 'carawebs_back_to_category');

/*====================================================================*/

/* Add News Category as a custom taxonomy */

function carawebs_add_custom_taxonomies() {
	// Add new "News Category" taxonomy to Posts
	register_taxonomy('news_category', array('post', 'thinking'), array(
		// Hierarchical taxonomy (like categories)
		'hierarchical' => true,
		// This array of options controls the labels displayed in the WordPress Admin UI
		'labels' => array(
			'name' => _x( 'News Categories', 'taxonomy general name' ),
			'singular_name' => _x( 'News Category', 'taxonomy singular name' ),
			'search_items' =>  __( 'Search News Categories' ),
			'all_items' => __( 'All News Categories' ),
			'parent_item' => __( 'Parent News Category' ),
			'parent_item_colon' => __( 'Parent News Category:' ),
			'edit_item' => __( 'Edit News Category' ),
			'update_item' => __( 'Update News Category' ),
			'add_new_item' => __( 'Add New News Category' ),
			'new_item_name' => __( 'New News Category Name' ),
			'menu_name' => __( 'News Categories' ),
		),
		// Control the slugs used for this taxonomy
		'rewrite' => array(
			'slug' => 'news_category', // This controls the base slug that will display before each term
			'with_front' => false, // Don't display the category base before "/locations/"
			'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
		),
	));
}
//add_action( 'init', 'carawebs_add_custom_taxonomies', 0 );

/*====================================================================*/

/* Extra Images on single post */

/***ADD ABOUT IMAGES****/
function carawebs_post_images() {

if(get_field('extra_images')):

	while(has_sub_field('extra_images')):

	$attachment_id = get_sub_field('image');
	$size = "carawebs_frontpage_thumbnail"; // (thumbnail, medium, large, full or custom size)
 	$image = wp_get_attachment_image_src( $attachment_id, $size );

		// url = $image[0];
		// width = $image[1];
		// height = $image[2];
		?>
		<div class="post_image">
			<img src="<?php echo $image[0]; ?>"><?php
			if(get_sub_field('text')): ?><div class="image_hover_wrap"><?php the_sub_field('text'); ?></div>
			<?php
			endif;

		?></div>
		<?php

	endwhile;

	endif;


}


//add_action('hook_after_post_images', 'carawebs_post_images');

/*====================================================================*/

/* Extra Images on Thinking post */

function carawebs_thinking_images() {

if(get_field('extra_images')):

	while(has_sub_field('extra_images')):

	$attachment_id = get_sub_field('image');
	$size = "medium"; // (thumbnail, medium, large, full or custom size)
 	$image = wp_get_attachment_image_src( $attachment_id, $size );

		// url = $image[0];
		// width = $image[1];
		// height = $image[2];
		?>
		<div class="post_image">
			<img src="<?php echo $image[0]; ?>">

			<?php
			if(get_sub_field('text')): ?>
			<div class="image_hover_wrap"><?php the_sub_field('text'); ?></div>
			<?php
			endif;

		?></div>
		<?php

	endwhile;

	endif;


}


//add_action('hook_after_thinking_images', 'carawebs_thinking_images');

/*====================================================================*/

/* Custom Title on Thinking Archive Page */

function carawebs_thinking_archive_title(){

	echo '<h1 class="headline project_headline"><a href="'. get_permalink() . '">' . get_the_title();
	//echo '<h1 class="headline project_headline">' . get_the_title();
	echo ' - ';
	echo get_the_date('d/m/y') . '</h1>';

}

//add_action('hook_after_thinking_archive_title', 'carawebs_thinking_archive_title');

/*====================================================================*/

/* Thinking Download Link */

function carawebs_thinking_download() {

if(get_field('pdf_download')): ?>


        <?php while(has_sub_field('pdf_download')): ?>


                <a class = "thinking_download" href="<?php the_sub_field('file'); ?>" target="_blank" title="Opens in new browser tab"><?php the_sub_field('text'); ?>&nbsp;(<?php the_sub_field('filedata'); ?>)</a>



	<?php endwhile; ?>



<?php endif;
}

//add_action('hook_after_thinking_download', 'carawebs_thinking_download');

/*====================================================================*/

/* Related projects on Person page */

function carawebs_simple_add_related_projects() {

$posts = get_field('projects');

if( $posts ): //only displays if field has a value

	?>
	<div id="person_projects">
		  <p class="related_projects">Related Projects:</p>


			<p class="related_projects">
				<?php foreach( $posts as $post_object): ?>


						<a class ="related_projects" href="<?php echo get_permalink($post_object->ID); ?>" title="View the project" ><?php echo get_the_title($post_object->ID); ?></a><br>


				<?php endforeach; ?>
			</p>
	</div>


<?php endif;


}
//add_action('hook_after_related_projects', 'carawebs_simple_add_related_projects');

/*====================================================================*/

/* Custom Title on Person Page */

function carawebs_person_page_title(){

	echo '<h1 class="headline person">' . get_the_title();
	echo ' - ';
	echo the_field('job_title') . '</h1>';

}

//add_action('hook_after_person_page_title', 'carawebs_person_page_title');

/*====================================================================*/

/* Back to News Link */

function carawebs_back_to_news() {

	if( get_option( 'show_on_front' ) == 'page' ) {

		$bloglink = get_permalink( get_option('page_for_posts' ) );
		$blogname = get_the_title( get_option('page_for_posts'));

	}

	else {

		$bloglink = bloginfo('url');
		$blogname = bloginfo('name');

	}


	?><p class="backarrow"><a class ="category_link" href="<?php echo $bloglink; ?>">Back to <?php echo $blogname ?></a></p><?php



}

//add_action('hook_after_back_to_news', 'carawebs_back_to_news');

/*====================================================================*/

/* Custom Title on Single Post */

function carawebs_post_title(){

	echo '<h1 class="headline project_headline">' . get_the_title();
	echo ' - ';
	echo get_the_date('d/m/y') . '</h1>';

}

//add_action('hook_after_post_title', 'carawebs_post_title');


/*====================================================================*/

/* Custom Title on Single Post */

function carawebs_blog_archive_post_title(){

	echo '<h2 class="headline overlay_headline">' . get_the_title();
	echo ' - ';
	echo get_the_date('d/m/y') . '</h2>';

}

//add_action('hook_top_archive_post_title', 'carawebs_blog_archive_post_title');

/*====================================================================*/

/* News Page Twitter */

function carawebs_newspage_twitter() {

	// The header
	?><h2 class="twitter_headline"><a href="http://twitter.com/EXP_Eng">@EXP_Eng</a></h2><?php

	if (wp_is_mobile()) { // Check to see if it is a mobile device

		// If so, display a single tweet in a div class "shortbox"

		?><div class="shortbox"><?php
			$client ='EXP_Eng';

			$tweets = getTweets($client, 1);
			//$tweets = getTweets(EXP_Eng, 1);

			if(is_array($tweets)){

					// to use with intents
					echo '<script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>';

					foreach($tweets as $tweet){

						if($tweet['text']){
							$the_tweet = $tweet['text'];

							if(is_array($tweet['entities']['user_mentions'])){
								foreach($tweet['entities']['user_mentions'] as $key => $user_mention){

									$the_tweet = preg_replace(
										'/@'.$user_mention['screen_name'].'/i',
										'<a href="http://www.twitter.com/'.$user_mention['screen_name'].'" target="_blank">@'.$user_mention['screen_name'].'</a>',
										$the_tweet);

								}
							}

							// ii. Hashtags must link to a twitter.com search with the hashtag as the query.
							if(is_array($tweet['entities']['hashtags'])){
								foreach($tweet['entities']['hashtags'] as $key => $hashtag){
									$the_tweet = preg_replace(
										'/#'.$hashtag['text'].'/i',
										'<a href="https://twitter.com/search?q=%23'.$hashtag['text'].'&src=hash" target="_blank">#'.$hashtag['text'].'</a>',
										$the_tweet);
								}
							}

							// iii. Links in Tweet text must be displayed using the display_url
							//      field in the URL entities API response, and link to the original t.co url field.
							if(is_array($tweet['entities']['urls'])){
								foreach($tweet['entities']['urls'] as $key => $link){
									$the_tweet = preg_replace(
										'`'.$link['url'].'`',
										'<a href="'.$link['url'].'" target="_blank">'.$link['url'].'</a>',
										$the_tweet);
								}
							}

							// since RT disabled don't display EXP_Eng screen-name, since this is already in the title


								//echo '<a href="http://twitter.com/EXP_Eng" target="_blank">@EXP_Eng</a><br>' . $the_tweet;
								echo '<p>' . $the_tweet . '</p>';


							// 3. Tweet Actions
							//    Reply, Retweet, and Favorite action icons must always be visible for the user to interact with the Tweet. These actions must be implemented using Web Intents or with the authenticated Twitter API.
							//    No other social or 3rd party actions similar to Follow, Reply, Retweet and Favorite may be attached to a Tweet.
							// get the sprite or images from twitter's developers resource and update your stylesheet
							echo '
							<div class="twitter_intents">
								<a class="reply" href="https://twitter.com/intent/tweet?in_reply_to='.$tweet['id_str'].'">Reply</a> 
								<a class="retweet" href="https://twitter.com/intent/retweet?tweet_id='.$tweet['id_str'].'">Retweet</a> 
								<a class="favorite" href="https://twitter.com/intent/favorite?tweet_id='.$tweet['id_str'].'">Favorite</a>
							</div>';


							// 4. Tweet Timestamp
							//    The Tweet timestamp must always be visible and include the time and date. e.g., “3:00 PM - 31 May 12”.
							// 5. Tweet Permalink
							//    The Tweet timestamp must always be linked to the Tweet permalink.
							echo

							/*'
							<p class="timestamp">
								<a href="https://twitter.com/EXP_Eng/status/'.$tweet['id_str'].'" target="_blank">
									'.date('h:i A M d',strtotime($tweet['created_at']. '- 8 hours')).'
								</a>
							</p>';// -8 GMT for Pacific Standard Time*/

							'
							<p class="timestamp">
								<a href="https://twitter.com/EXP_Eng/status/'.$tweet['id_str'].'" target="_blank">
									'.date('G:i M dS',strtotime($tweet['created_at'])).'
								</a>
							</p>';// GMT

							} else {
							echo '
							<br /><br />
							<a href="http://twitter.com/EXP_Eng" target="_blank">Click here to read EXP_Eng\'S Twitter feed</a>';
							}
					}
				}

				?></div><?php

	}

	else {

	// Display three tweets in a div class "tallbox"

	?><div class="tallbox"><?php

	$client ='EXP_Eng';

	$tweets = getTweets($client, 3);
	//$tweets = getTweets(EXP_Eng, 3);

	if(is_array($tweets)){

			// to use with intents
			//echo '<script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>';

			foreach($tweets as $tweet){

				if($tweet['text']){
					$the_tweet = $tweet['text'];

					if(is_array($tweet['entities']['user_mentions'])){
						foreach($tweet['entities']['user_mentions'] as $key => $user_mention){
							$the_tweet = preg_replace(
								'/@'.$user_mention['screen_name'].'/i',
								'<a href="http://www.twitter.com/'.$user_mention['screen_name'].'" target="_blank">@'.$user_mention['screen_name'].'</a>',
								$the_tweet);
						}
					}

					// ii. Hashtags must link to a twitter.com search with the hashtag as the query.
					if(is_array($tweet['entities']['hashtags'])){
						foreach($tweet['entities']['hashtags'] as $key => $hashtag){
							$the_tweet = preg_replace(
								'/#'.$hashtag['text'].'/i',
								'<a href="https://twitter.com/search?q=%23'.$hashtag['text'].'&src=hash" target="_blank">#'.$hashtag['text'].'</a>',
								$the_tweet);
						}
					}

					// iii. Links in Tweet text must be displayed using the display_url
					//      field in the URL entities API response, and link to the original t.co url field.
					if(is_array($tweet['entities']['urls'])){
						foreach($tweet['entities']['urls'] as $key => $link){
							$the_tweet = preg_replace(
								'`'.$link['url'].'`',
								'<a href="'.$link['url'].'" target="_blank">'.$link['url'].'</a>',
								$the_tweet);
						}
					}

					//echo '<a href="http://twitter.com/EXP_Eng" target="_blank">@EXP_Eng</a><br>' . $the_tweet;
					echo '<p>' . $the_tweet . '</p>';


					// 3. Tweet Actions
					//    Reply, Retweet, and Favorite action icons must always be visible for the user to interact with the Tweet. These actions must be implemented using Web Intents or with the authenticated Twitter API.
					//    No other social or 3rd party actions similar to Follow, Reply, Retweet and Favorite may be attached to a Tweet.
					// get the sprite or images from twitter's developers resource and update your stylesheet
					echo '
					<div class="twitter_intents">
						<a class="reply" href="https://twitter.com/intent/tweet?in_reply_to='.$tweet['id_str'].'">Reply</a> 
						<a class="retweet" href="https://twitter.com/intent/retweet?tweet_id='.$tweet['id_str'].'">Retweet</a> 
						<a class="favorite" href="https://twitter.com/intent/favorite?tweet_id='.$tweet['id_str'].'">Favorite</a>
					</div>';


					// 4. Tweet Timestamp
					//    The Tweet timestamp must always be visible and include the time and date. e.g., “3:00 PM - 31 May 12”.
					// 5. Tweet Permalink
					//    The Tweet timestamp must always be linked to the Tweet permalink.
					echo

					/*'
					<p class="timestamp">
						<a href="https://twitter.com/EXP_Eng/status/'.$tweet['id_str'].'" target="_blank">
							'.date('h:i A M d',strtotime($tweet['created_at']. '- 8 hours')).'
						</a>
					</p>';// -8 GMT for Pacific Standard Time*/

					'
					<p class="timestamp">
						<a href="https://twitter.com/EXP_Eng/status/'.$tweet['id_str'].'" target="_blank">
							'.date('G:i M dS',strtotime($tweet['created_at'])).'
						</a>
					</p>';// GMT

					} else {
					echo '
					<br /><br />
					<a href="http://twitter.com/EXP_Eng" target="_blank">Click here to read EXP_Eng\'S Twitter feed</a>';
					}
				}
		}

		?></div><?php

	}

}

//add_action('hook_top_twitter_feed', 'carawebs_newspage_twitter');

/*====================================================================*/

/* Front Page Twitter */

function carawebs_frontpage_twitter() {

	?><h2 class="twitter_headline"><a href="http://twitter.com/EXP_Eng">@EXP_Eng</a></h2>
	<div class="shortbox"><?php
	$client ='EXP_Eng';

	$tweets = getTweets($client, 1);
	//$tweets = getTweets(EXP_Eng, 1);

	if(is_array($tweets)){

			// to use with intents
			echo '<script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>';

			foreach($tweets as $tweet){

				if($tweet['text']){
					$the_tweet = $tweet['text'];

					if(is_array($tweet['entities']['user_mentions'])){
						foreach($tweet['entities']['user_mentions'] as $key => $user_mention){

							$the_tweet = preg_replace(
								'/@'.$user_mention['screen_name'].'/i',
								'<a href="http://www.twitter.com/'.$user_mention['screen_name'].'" target="_blank">@'.$user_mention['screen_name'].'</a>',
								$the_tweet);

						}
					}

					// ii. Hashtags must link to a twitter.com search with the hashtag as the query.
					if(is_array($tweet['entities']['hashtags'])){
						foreach($tweet['entities']['hashtags'] as $key => $hashtag){
							$the_tweet = preg_replace(
								'/#'.$hashtag['text'].'/i',
								'<a href="https://twitter.com/search?q=%23'.$hashtag['text'].'&src=hash" target="_blank">#'.$hashtag['text'].'</a>',
								$the_tweet);
						}
					}

					// iii. Links in Tweet text must be displayed using the display_url
					//      field in the URL entities API response, and link to the original t.co url field.
					if(is_array($tweet['entities']['urls'])){
						foreach($tweet['entities']['urls'] as $key => $link){
							$the_tweet = preg_replace(
								'`'.$link['url'].'`',
								'<a href="'.$link['url'].'" target="_blank">'.$link['url'].'</a>',
								$the_tweet);
						}
					}

					// since RT disabled don't display EXP_Eng screen-name, since this is already in the title


						//echo '<a href="http://twitter.com/EXP_Eng" target="_blank">@EXP_Eng</a><br>' . $the_tweet;
						echo '<p>' . $the_tweet . '</p>';


					// 3. Tweet Actions
					//    Reply, Retweet, and Favorite action icons must always be visible for the user to interact with the Tweet. These actions must be implemented using Web Intents or with the authenticated Twitter API.
					//    No other social or 3rd party actions similar to Follow, Reply, Retweet and Favorite may be attached to a Tweet.
					// get the sprite or images from twitter's developers resource and update your stylesheet
					echo '
					<div class="twitter_intents">
						<a class="reply" href="https://twitter.com/intent/tweet?in_reply_to='.$tweet['id_str'].'">Reply</a> 
						<a class="retweet" href="https://twitter.com/intent/retweet?tweet_id='.$tweet['id_str'].'">Retweet</a> 
						<a class="favorite" href="https://twitter.com/intent/favorite?tweet_id='.$tweet['id_str'].'">Favorite</a>
					</div>';


					// 4. Tweet Timestamp
					//    The Tweet timestamp must always be visible and include the time and date. e.g., “3:00 PM - 31 May 12”.
					// 5. Tweet Permalink
					//    The Tweet timestamp must always be linked to the Tweet permalink.
					echo

					/*'
					<p class="timestamp">
						<a href="https://twitter.com/EXP_Eng/status/'.$tweet['id_str'].'" target="_blank">
							'.date('h:i A M d',strtotime($tweet['created_at']. '- 8 hours')).'
						</a>
					</p>';// -8 GMT for Pacific Standard Time*/

					'
					<p class="timestamp">
						<a href="https://twitter.com/EXP_Eng/status/'.$tweet['id_str'].'" target="_blank">
							'.date('G:i M dS',strtotime($tweet['created_at'])).'
						</a>
					</p>';// GMT

					} else {
					echo '
					<br /><br />
					<a href="http://twitter.com/EXP_Eng" target="_blank">Click here to read EXP_Eng\'S Twitter feed</a>';
					}
			}
		}

		?></div><?php
}

//add_action('hook_top_frontpage_twitter', 'carawebs_frontpage_twitter');

/*====================================================================*/

/* Insert Read more link */

function carawebs_add_read_more() {

	?><p><a class="read_more" href="<?php echo get_permalink();?>">Read More</a></p><?php

}

//add_action ('hook_bottom_read_more', 'carawebs_add_read_more');

/*====================================================================*/

/* Insert Full Article link */

function carawebs_read_full_article() {

	?><p><?php echo get_the_excerpt(); ?>...<a href="<?php echo get_permalink();?>">Read Full Article</a></p><?php

}

//add_action ('hook_after_read_full_article', 'carawebs_read_full_article');

/*====================================================================*/

/*Social Sharing*/

/* With tooltip span**
 * function carawebs_social_sharing(){
?>
<p>Share this article:</p>
<ul id="social_share_icons" class="menu">
		<li><a class="email_share" href="mailto:?subject=I thought you might like this web page&body=Check out this site: <?php echo urlencode(get_permalink());?>">Email<span>Share by Email</span></a></li>
		<li><a class="linkedin_share" href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode(get_permalink());?>">LinkedIn<span>Share this on LinkedIn</span></a></li>
		<li><a class="twitter_share" href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink());?>&text=<?php echo get_the_title(); ?>">Twitter<span>Tweet this to your followers</span></a></li>

</ul>
	<?php
}
* ****/

function carawebs_social_sharing(){
?>
<div id="social_links">
	<p>Share this article:</p>
	<ul id="social_share_icons" class="menu">
			<li><a class="email_share" href="mailto:?subject=I thought you might like this web page&body=Check out this site: <?php echo urlencode(get_permalink());?>">Email</a></li>
			<li><a class="linkedin_share" href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode(get_permalink());?>">LinkedIn</a></li>
			<li><a class="twitter_share" href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink());?>&text=<?php echo get_the_title(); ?>">Twitter</a></li>

	</ul>
</div>
	<?php
}

//add_action('hook_after_social_sharing','carawebs_social_sharing');

/*====================================================================*/

/* The Address block for Contact Page */

function carawebs_address_block(){

	echo '
	<div id="address_block">
	<div class="post_content">
	<p>Expedition Engineering<br>
	Morley House<br>
	1st Floor<br>
	320 Regent Street<br>
	London, W1B 3BB</p>
	<p><a href="https://mapsengine.google.com/map/edit?mid=z1R_6hsiZ01o.ktcJ5xDXiFbs" target="_blank" title="Click to open a Google Map of Expedition in a new browser tab">Google Maps</a></p>
	</div>';

	?>
	<p><span class="address_titles">Phone:</span><span class="address_content">+44 (0)20 7307 8880</span><br>
	<span class="address_titles">Fax:</span>+44(0)20 7307 1001<br>
	<span class="address_titles">Email:</span><a href="mailto:<?php echo antispambot('info@expedition.uk.com');?>"><?php echo antispambot('info@expedition.uk.com');?></a></p>
	</div><?php

}

//add_action('hook_after_address_block','carawebs_address_block');

/*====================================================================*/

/* Search Results Heading */

function add_search_title() {

	?><h1 class="headline">Search Results for the Term: <span style="color: #fff;"><?php echo the_search_query();?></span></h1>

	<?php

}

//add_action('hook_before_search_title', 'add_search_title');

/*====================================================================*/

/* No search results found */

function carawebs_no_results() {

	if (!have_posts()): ?>

		<p>Sorry, we found no content that matches your search term. Please try searching again, or visit our <a href ="<?php echo home_url(); ?>">home page</a>.</p>

	<?php endif;
}
//add_action('hook_after_no_results', 'carawebs_no_results');

/*====================================================================*/

/* Empty Search Redirect */

function carawebs_search_redirect( $vars ) {

	if( isset( $_GET['s'] ) && empty( $_GET['s'] ) )

    // Adds the term Empty Search in place of an empty entry
		$vars['s'] = "'Empty Search'";
	 return $vars;
}
add_filter( 'request', 'Roots\Sage\Extras\carawebs_search_redirect' );

/*====================================================================*/

/* Email Obfuscate Shortcode */

function carawebs_mail_hide($atts , $content = null ){
	if ( ! is_email ($content) )
		return;

	return '<a href="mailto:'.antispambot($content).'">'.antispambot($content).'</a>';
}
add_shortcode( 'email','carawebs_mail_hide');

// Use this: [email]john.doe@mysite.com[/email]

// Use in text boxes
add_filter( 'widget_text', 'shortcode_unautop');
add_filter('widget_text', 'do_shortcode');

/*====================================================================*/

/* Menu adjustment for CPTs */


add_filter( 'nav_menu_css_class', 'Roots\Sage\Extras\namespace_menu_classes', 10, 2 );

function namespace_menu_classes( $classes , $item ){

	if ( get_post_type() == 'project' || is_archive( 'project' )
		|| get_post_type() == 'thinking' || is_archive( 'thinking' )
		|| get_post_type() == 'people' || is_archive( 'people' )
		)

	{

		// remove that unwanted classes if it's found
		$classes = str_replace( 'current_page_parent', '', $classes );

		// find the url you want and add the class you want
		if ( $item->url == '/events' ) {
			$classes = str_replace( 'menu-item', 'menu-item current_page_item', $classes );
			remove_filter( 'nav_menu_css_class', 'namespace_menu_classes', 10, 2 );
		}
	}
	return $classes;
}

/*====================================================================*/

/* Additional Clearfix Element */

function carawebs_clearfix(){

	echo '<div style="clear:both;"></div>';

}
/*
add_action('hook_bottom_header','carawebs_clearfix');
add_action('hook_bottom_fixed_header','carawebs_clearfix');
add_action('hook_bottom_header_columns','carawebs_clearfix');
add_action('hook_bottom_header_right','carawebs_clearfix');
add_action('hook_bottom_nav_wrap','carawebs_clearfix');
*/
/*====================================================================*/

/* Modify Reset CSS Prepend

function prepend_css_reset($css) {
    $prepend_css = "@import url('css/responsive.css');\n\n";
    $css = $prepend_css . $css;
    return $css;
}

add_filter('thesis_css_reset','prepend_css_reset');
* */
