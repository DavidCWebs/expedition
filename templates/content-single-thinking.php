<?php
use Roots\Sage\Extras;
while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <div id="content" class="page_wrapper page_background">
    <div class="columns_1">
        <div class="columns_7_12">
            <div id="post-<?php get_the_ID(); ?>" class="post_box top">
                <h1 class="headline project_headline"><?php the_title();?></h1>
                <div class="inline_block_container">
                    <div class="author_byline">
                        <span class="post_author"><?php the_author();?></span>
                        <span class="post_date_intro">- </span> <span class="post_date" title="<?php echo get_the_date(); ?>"><?php echo get_the_date('F d, Y'); ?></span>
                    </div>
                </div>
                <div class="post_content"><?php the_content(); ?></div>
            </div>
            <?php Extras\carawebs_social_sharing(); ?>
        </div>
        <div id="thinking_image_grid" class="columns_5_12">
            <div class="gridbreak"></div>
        </div>
    </div>
</div>
  </article>
<?php endwhile; ?>
