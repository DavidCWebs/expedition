<?php
use Roots\Sage\Extras;

?>
<div id="post-<?php get_the_ID(); ?>" class="post_box search_box top">
<h2 class="headline"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
<div class="post_content post_excerpt">
<?php Extras\carawebs_custom_excerpt( 'hellip', true ); ?>
<!--<a href="<?php //the_permalink(); ?>" class="readmore">Read More&nbsp;&raquo;</a>-->
</div>
</div>
