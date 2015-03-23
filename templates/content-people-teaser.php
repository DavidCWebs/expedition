<?php
use Roots\Sage\Extras;
$headshot = get_field('headshot_image');

//$headshot = !empty( $headshot ) ? $headshot :

	/*if(empty($headshot)) {

		?>
		<a href="<?php echo $personlink; ?>"><img src="http://www.carawebstest.com/exp/wp-content/uploads/2014/03/person-headshot-default.jpg" title="<?php echo get_the_title(); ?>"></a>
		<?php

	}

	else
	{
		?>
		<a href="<?php echo $personlink; ?>"><img src="<?php echo $headshot; ?>" title="<?php echo get_the_title(); ?>"></a>
		<?php
	}

$image_array = Extras\carawebs_teaser_image( get_the_ID(), 'thumbnail' );
$image_url = $image_array[0];
$thumb_ID = get_post_thumbnail_id( get_the_ID() );
$alt = get_post_meta( $thumb_ID, '_wp_attachment_image_alt', true );
$alt = !empty( $alt) ? 'alt="' . $alt . '"' : '';

*/

?>
<a href="<?php the_permalink(); ?>"><img src="<?php echo $headshot; ?>" title="<?php the_title(); ?>"></a>
</div>
<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4><h4 class="subheading"><?php the_field('job_title'); ?></h4>

<!--<div id="post-<?php echo get_the_ID(); ?>" class="post_box box project type-project status-publish has-post-thumbnail category-experimental category-project" itemscope itemtype="http://schema.org/Article">
  <div class="overlay_container">
    <a class="featured_image_link" href="http://carawebstest.com/exp/project/tensegritree-university-of-kent/"><img width="300" height="200" src="<?php echo $image_url; ?>" class="aligncenter wp-post-image" alt="tensigritree feature" /></a>							<div class="overlay">
      <h2 class="headline overlay_headline" itemprop="name"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
      <div class="post_content post_excerpt overlay_excerpt" itemprop="description">
        <?php the_excerpt(); ?>
      </div>
    </div>
  </div>
</div>-->
