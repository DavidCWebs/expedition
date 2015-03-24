<?php use Roots\Sage\Extras;

?>
<div id="post-<?php get_the_ID(); ?>" class="post_box boxy top">
  <div class="visible_overlay_container">
    <div class="excerpt_overlay_background">
    </div>
    <div class="headline_container">
      <h2 class="headline overlay_headline"><?php the_title();?>&nbsp;-&nbsp;<?php echo get_the_date('d/m/y'); ?></h2>
    </div>
    <div class="visible_excerpt">
      <div class="post_content post_excerpt">
        <?php Extras\carawebs_custom_excerpt(); ?>
      </div>
    </div>
    <a class="featured_image_link" href="<?php the_permalink(); ?>">
    <?php Extras\carawebs_featured_image( 'thumbnail', 'attachment-thumbnail wp-post-image', get_the_ID()); ?>
    </a>
  </div>
</div>
