<?php
use Roots\Sage\Extras;

while (have_posts()) : the_post(); ?>
  <div id="content" class="page_wrapper page_background">
    <div id="contact_info_container" class="columns_211" style="display: none;">
        <div id="contact_col1" class="half left">
        </div>
        <div id="contact_col2" class="half left">
        </div>
    </div>
    <div class="columns_312">
        <div id="contact_text" class="third">
            <div id="post-388" class="post_box top"><h1 class="headline"><?php the_title(); ?></h1>
                <?php echo Extras\carawebs_address_block(); ?>
                <div class="post_content main_contact_text">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
        <div class="two_thirds">
        <div class="map_image">
        <div id="map_canvas" style="position: relative; overflow: hidden; transform: translateZ(0px); background-color: rgb(229, 227, 223);"></div>
        </div>
        </div>
    </div>
    <div class="text_box">
    <div class="go_top" style="width: 940px;">
    <a href="#" title="Go to the top of the page">Back to Top</a>
    </div>
    </div>
</div>
<?php endwhile; ?>
