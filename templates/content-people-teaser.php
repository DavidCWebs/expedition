<?php
use Roots\Sage\Extras;
$headshot = get_field('headshot_image');

?>
<a href="<?php the_permalink(); ?>"><img src="<?php echo $headshot; ?>" title="<?php the_title(); ?>"></a>
</div>
<h4><a class="underline" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4><h4 class="subheading"><?php the_field('job_title'); ?></h4>
