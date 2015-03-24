<?php
use Roots\Sage\Extras;
while (have_posts()) : the_post(); ?>
  <div id="content" class="page_wrapper page_background">
    <div class="columns_312">
        <div id="project_text" class="third">
            <div id="post-208" class="post_box top">
                <h1 class="headline"><?php the_title(); ?></h1>
                <div class="post_content"><?php the_content(); ?></div>
            </div>
        </div>
        <div class="two_thirds">
            <?php Extras\carawebs_featured_image( 'full', 'attachment-full wp-post-image' ); ?>
            <div id="grid" class="padding_top">
              <?php Extras\carawebs_about_images( 'thumbnail' ); ?>
            </div>
        </div>
    </div>
</div>
<?php endwhile; ?>
