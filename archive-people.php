<?php

if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'sage'); ?>
  </div>
  <?php get_search_form(); ?>
<?php endif; ?>
<div id="content" class="page_wrapper page_background">
  <div class="columns_312">
    <div class="third">
        <h1 class="archive_title headline"><?php get_template_part('templates/page', 'header'); ?></h1>
        <div class="post_content">
          <?php
          $post_id = 3116;
            $post_object = get_post( $post_id );
            echo apply_filters( 'the_content', $post_object->post_content );
          ?>
        </div>
    </div>
    <div id="flash" class="two_thirds">
        <div id="people_grid">
          <?php while (have_posts()) : the_post(); ?>
            <div class="query_box quarter_box">
                <div class="bwWrapper">
                  <?php get_template_part('templates/content', 'people-teaser'); ?>
            </div>
          <?php endwhile; ?>
            <div class="quarter_gridbreak"></div>
            <div class="quarter_gridbreak"></div>
        </div>
    </div>
</div>


  <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<?php the_posts_navigation(); ?>
