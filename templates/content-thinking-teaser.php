<?php
use Roots\Sage\Extras;
//$headshot = get_field('headshot_image');


?>
<div id="post-<?php echo get_the_ID(); ?>" class="post_box margin_bottom top" itemscope="" itemtype="http://schema.org/Article">
    <div class="columns_7_12 image_container">
    <h1 class="headline project_headline">
      <a href="<?php the_permalink(); ?>"><?php the_title(); ?>&nbsp;-&nbsp;<?php echo get_the_date('d/m/y'); ?></a>
    </h1>
      <a class="featured_image_link" href="<?php the_permalink() ;?>">
        <?php Extras\carawebs_featured_image( 'full', 'aligncenter wp-post-image', get_the_ID()); ?>
      </a>
    </div>
    <div class="columns_5_12">
        <div class="thinking_excerpt">
        </div>
        <?php the_excerpt(); ?>
    </div>
</div>
