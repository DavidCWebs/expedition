<?php
use Roots\Sage\Extras;

while (have_posts()) : the_post();
?>
<div id="content" class="page_wrapper page_background">
    <div class="slider_container">
        <div class="overlay_background"></div>
        <div class="slider_overlay">
            <?php the_field( 'slider_overlay' ); ?>
        </div>
        <div id="post-14" class="post_box frontpage_image_container top">
        <a class="featured_image_link" href="<?php echo esc_url( home_url( '/contact' ) ); ?>"><img width="620" height="380" src="http://carawebstest.com/exp/wp-content/uploads/2013/12/las_arenas-620x380.jpg" class="attachment-carawebs_frontpage_thumbnail wp-post-image" alt="las_arenas" /></a>		</div>
        <div id="mobile_nav">
            <form action="<?php echo esc_url( home_url( '/projects' ) ); ?>" method="get">
            <button class="mobile_button">Projects</button>
            </form>
            <form action="<?php echo esc_url( home_url( '/about' ) ); ?>" method="get">
            <button class="mobile_button">About Us</button>
            </form>
            <form action="<?php echo esc_url( home_url( '/people' ) ); ?>" method="get">
            <button class="mobile_button">People</button>
            </form>
            <form action="<?php echo esc_url( home_url( '/contact' ) ); ?>" method="get">
            <button class="mobile_button">Contact</button>
            </form>
        </div>
        <div id="main_slider">
          <?php $test = Extras\carawebs_frontpage_slider(); ?>
        </div>
    </div>
    <div class="columns_211">
      <?php echo Extras\carawebs_first_projects_front_page( get_the_ID() ); ?>
    </div>
    <div id="teaser_grid">
      <div class="teaser twitter_container">
        <?php Extras\carawebs_frontpage_twitter(); ?>
      </div>
      <?php echo Extras\carawebs_minor_teasers_front_page( get_the_ID() ); ?>
    </div>
</div>
<?php endwhile; ?>
