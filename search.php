<?php
use Roots\Sage\Extras;
if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'sage'); ?>
  </div>
  <?php get_search_form(); ?>
<?php endif; ?>
<div id="content" class="page_wrapper page_background">
    <h1 class="headline">Search Results for the Term: <span style="color: #fff;">test</span></h1>
    <div id="search_grid">
      <?php while (have_posts()) : the_post(); ?>
        <?php get_template_part('templates/content', 'search-teaser'); ?>
      <?php endwhile; ?>
        <div class="gridbreak">
        </div>
    </div>
    <div id="next_previous" class="no_top_padding">
        <?php echo Extras\carawebs_next_previous_links( 'Older', 'Newer'); ?>
    </div>
</div>
