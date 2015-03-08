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
                    <!--<ul id="menu-main-menu" class="menu"><li id="menu-item-16" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home menu-item-16"><a href="http://localhost/expedition/">Home</a></li>
    <li id="menu-item-391" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-391"><a href="http://localhost/expedition/about/">About</a></li>
    <li id="menu-item-56" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-56"><a href="http://localhost/expedition/category/project/">Projects</a></li>
    <li id="menu-item-345" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-345"><a href="http://localhost/expedition/category/people/">People</a></li>
    <li id="menu-item-219" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-219"><a href="http://localhost/expedition/services/">Services</a></li>
    <li id="menu-item-732" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-732"><a href="http://localhost/expedition/category/thinking/">Thinking</a></li>
    <li id="menu-item-217" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-217"><a href="http://localhost/expedition/news/">News</a></li>
    <li id="menu-item-390" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-390"><a href="http://localhost/expedition/contact/">Contact</a></li>
  </ul>-->
    <div style="clear:both;"></div>
                </div>
            </div>
            <div style="clear:both;"></div>
        </div>
        <div id="#dotted_border" class="dotted_border"></div>
    <div style="clear:both;"></div>
    </div>
    <div style="clear:both;"></div>
</div>
