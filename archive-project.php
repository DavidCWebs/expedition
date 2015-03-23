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
  	</div>
  	<div class="two_thirds">
  		<div id="grid">
        <?php while (have_posts()) : the_post(); ?>
          <?php get_template_part('templates/content', 'project-teaser'); ?>
        <?php endwhile; ?>
  			<div class="gridbreak">
  			</div>
  			<div class="gridbreak">
  			</div>
  		</div>
  	</div>
  </div>
		<div id="next_previous" class="margin_bottom">
			<div class="left">
			</div>
			<div class="right">
			</div>
		</div>
		<div class="text_box">
			<div class="go_top">
        <a href="#" title="Go to the top of the page">Back to Top</a>
      </div>
    </div>
</div>
<?php the_posts_navigation(); ?>
