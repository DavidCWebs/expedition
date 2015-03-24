<?php
use Roots\Sage\Extras;

//get_template_part('templates/page', 'header'); ?>

<?php if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'sage'); ?>
  </div>
  <?php get_search_form(); ?>
<?php endif; ?>

<div id="content" class="page_wrapper page_background">
	<div id="linky">
		<div id="twitter_container" class="boxy">
        <?php Extras\carawebs_newspage_twitter(); ?>
    </div>
    <?php while (have_posts()) : the_post(); ?>
      <?php get_template_part('templates/content', 'news-teaser'); ?>
    <?php endwhile; ?>
	</div>
	<div class="text_box">
		<div class="go_top" style="width: 940px;">
  <a href="#" title="Go to the top of the page">Back to Top</a>
</div>
	</div>
</div>



<?php the_posts_navigation(); ?>
