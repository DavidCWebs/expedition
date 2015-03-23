<?php
use Roots\Sage\Extras;
while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <div id="content" class="page_wrapper page_background">
    <div class="columns_312">
        <div id="person_data" class="third">
            <div id="post-880" class="post_box top">
              <?php Extras\carawebs_featured_image('carawebs_person', 'attachment-carawebs_person wp-post-image'); ?>
            <!--<img width="300" height="380" src="http://carawebstest.com/exp/wp-content/uploads/2014/12/DSC0588-300x380.jpg" class="attachment-carawebs_person wp-post-image" alt="_DSC0588">-->
            <h1 class="headline person"><?php the_title();?> - <?php the_field('job_title'); ?></h1>
                <div id="largeview_post_box">
                    <div class="post_content">
                    <?php the_content(); ?>
                    </div>
                    <div id="person_projects">
                    <p class="related_projects">Related Projects:</p>
                    <p class="related_projects"></p>
                    </div>
                </div>
            </div>
        </div>
        <div id="tablet_person_text" style="display: none;">
        </div>
        <div id="flash" class="two_thirds">
            <div id="people_grid">
              <?php echo Extras\carawebs_people_query( get_the_ID() ); ?>
                <div class="quarter_gridbreak"></div>
                <div class="quarter_gridbreak"></div>
            </div>
        </div>
    </div>
    <div class="text_box">
        <div class="go_top" style="width: 940px;">
        <a href="#" title="Go to the top of the page">Back to Top</a>
        </div>
    </div>
</div>
  </article>
<?php endwhile; ?>
