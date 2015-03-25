<div id="content" class="page_wrapper page_background">
<?php get_template_part('templates/page', 'header'); ?>
<div class="alert alert-warning">
  <p><?php _e('Sorry, but the page you were trying to view does not exist.', 'sage'); ?></p>
  <p>Go to our <a href="<?php echo esc_url( home_url( '/' ) ); ?>">home page</a>, or use the search form to find what you need:</p>
</div>
<?php get_search_form(); ?>
</div>
