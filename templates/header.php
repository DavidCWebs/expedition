<?php use Roots\Sage\Nav; ?>
<div id="fixed_header">
    <div id="header" class="page_wrapper">
        <div class="columns_1">
            <div id="header_left" class="left">
                <a href="http://localhost/expedition" title="Expedition Test Site">
                    <div id="site_logo"></div>
                </a>
            </div>
            <div id="header_right">
                <div id="search_container">
                    <div class="widget search-form" id="thesis-search-widget-2">
                        <form class="search_form" method="get" action="http://localhost/expedition">
                        <p>
                            <input class="input_text" type="text" id="s" name="s" value="" onfocus="if (this.value == '') {this.value = '';}" onblur="if (this.value == '') {this.value = '';}" />
                            <input type="submit" id="searchsubmit" value="" />
                        </p>
                        </form>
                    </div>
                    <div class="dotted_border">
                    </div>
                </div>
                <div id="nav_wrap" class="menu_wrapper">
                    <div id="menu_top_border" class="dotted_border">
                    </div>
                    <?php
                    if (has_nav_menu('primary_navigation')) :
                      wp_nav_menu(['theme_location' => 'primary_navigation', 'walker' => new Nav\SageNavWalker(), 'menu_class' => 'menu']);
                    endif;
                    ?>
                    <?php
                    if (is_singular( 'project' ) || is_category()){

                      if (has_nav_menu('project_sub_categories')) :
                        wp_nav_menu(['theme_location' => 'project_sub_categories', 'walker' => new Nav\SageNavWalker(), 'menu_class' => 'categories_menu', 'menu_id' => 'menu-project-sub-categories']);
                      endif;

                    }
                    ?>
    <!--<div style="clear:both;"></div>-->
                </div>
            </div>
            <!--<div style="clear:both;"></div>-->
        </div>
        <div id="#dotted_border" class="dotted_border"></div>
    <!--<div style="clear:both;"></div>-->
    </div>
    <!--<div style="clear:both;"></div>-->
</div>
