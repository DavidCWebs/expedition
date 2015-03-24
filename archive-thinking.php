<?php
if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'sage'); ?>
  </div>
  <?php get_search_form(); ?>
<?php endif; ?>
<div id="content" class="page_wrapper page_background">
    <div class="columns_1">
        <div class="third">
            <h1 class="archive_title headline">Thinking</h1>
            <div class="post_content">
              <?php
              $post_id = 3143;
                $post_object = get_post( $post_id );
                echo apply_filters( 'the_content', $post_object->post_content );
              ?>
            </div>
        </div>
    </div>
    <div class="columns_1">
      <?php while (have_posts()) : the_post(); ?>
        <?php get_template_part('templates/content', 'thinking-teaser'); ?>
      <?php endwhile; ?>
    </div>
    <div class="text_box">
        <div class="go_top" style="width: 940px;">
            <a href="#" title="Go to the top of the page">Back to Top</a>
        </div>
    </div>
</div>
<?php the_posts_navigation(); ?>
