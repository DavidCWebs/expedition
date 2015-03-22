<?php

namespace Roots\Sage\Titles;

/**
 * Page titles
 */
function title() {

  $post_types = array(
    'projects',
    'person',
    'thinking'
  );

  if (is_home()) {

    if (get_option('page_for_posts', true)) {

      return get_the_title(get_option('page_for_posts', true));

    } else {

      return __('Latest Posts', 'sage');

    }

  } elseif ( is_archive() && !is_post_type_archive() ) {

    return get_the_archive_title(); //post_type_archive_title( $prefix, $display );

  } elseif ( is_post_type_archive(  ) ){

    return post_type_archive_title( '', false );

  } elseif (is_search()) {

    return sprintf(__('Search Results for %s', 'sage'), get_search_query());

  } elseif (is_404()) {

    return __('Not Found', 'sage');

  } else {

    return get_the_title();

  }
}

/*add_filter( 'get_the_archive_title', function ( $title ) {

    if( is_archive() ) {

        $title = single_cat_title( '', false );

    }

    return $title;

});*/
