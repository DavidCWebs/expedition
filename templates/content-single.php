<?php
use Roots\Sage\Extras;

while (have_posts()) : the_post(); ?>
  <div id="content" class="page_wrapper page_background">
    <div class="columns_321">
      <p class="backarrow" style="padding-bottom: 20px;">
        <a class="category_link" href="<?php echo Extras\carawebs_link_page_for_posts(); ?>">Back to News</a>
        </p>
        <div class="two_thirds">
            <div id="post-<?php echo get_the_ID(); ?>" class="post_box top">
                <h1 class="headline project_headline"><?php the_title(); ?>&nbsp;-&nbsp;<?php echo get_the_date('d/m/y'); ?></h1>
                <?php Extras\carawebs_featured_image( 'full', 'attachment-medium wp-post-image' ); ?>
                <div class="byline_container"></div>
                <div class="post_content">
                    <?php the_content(); ?>
                </div>
                <?php Extras\carawebs_social_sharing(); ?>
            </div>
        </div>
        <div class="third single_small_grid">
            <?php Extras\carawebs_post_images(); ?>
        </div>
    </div>
</div>
<?php endwhile; ?>
