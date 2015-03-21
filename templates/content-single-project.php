<?php
use Roots\Sage\Extras;
while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <div id="content" class="page_wrapper page_background">
		<div class="columns_312">
			<div id="project_text" class="third">
				<div id="post-593" class="post_box test-test top" itemscope itemtype="http://schema.org/Article">
          <?php Extras\carawebs_back_to_category(); ?>
          <div class="post_content" itemprop="articleBody">
            <?php the_content(); ?>
					</div>
          <?php Extras\carawebs_additional_project_content(); ?>
          <?php Extras\carawebs_add_related_people(); ?>
          <div id="project_info">
            <?php Extras\carawebs_project_fields(); ?>
          </div>
				</div>
			</div>
			<div id="project_image" class="two_thirds padding_bottom">
				<div class="project_slider_container">
					<h1 class="headline project_headline"><?php the_title(); ?></h1>
          <?php Extras\carawebs_project_slider(); ?>
				</div>
			</div>
		</div>
		<div id="project_info_container" class="columns_211">
			<div id="firstcol" class="half left">
			</div>
			<div id="secondcol" class="half left">
			</div>
		</div>
		<div class="text_box">
			<div class="go_top">
        <a href="#" title="Go to the top of the page">Back to Top</a>
      </div>
		</div>
	</div>
  </article>
<?php endwhile; ?>
