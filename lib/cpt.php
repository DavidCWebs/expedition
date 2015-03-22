<?php
/**
 * Register Custom Post Types & Custom Tacxonomies
 *
 * @package CustomPostTypes
 *
 */

/**
 * Register 'project' CPT
 *
 * @return void
 *
 */
function custom_post_type_project() {
	$labels = array(
		'name'                => _x( 'Projects', 'Post Type General Name', 'text_domain' ),
		'singular_name'       => _x( 'Project', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'           => __( 'Projects', 'text_domain' ),
		'parent_item_colon'   => __( 'Parent Project:', 'text_domain' ),
		'all_items'           => __( 'All Projects', 'text_domain' ),
		'view_item'           => __( 'View Project', 'text_domain' ),
		'add_new_item'        => __( 'Add New Project', 'text_domain' ),
		'add_new'             => __( 'New Project', 'text_domain' ),
		'edit_item'           => __( 'Edit Project', 'text_domain' ),
		'update_item'         => __( 'Update Project', 'text_domain' ),
		'search_items'        => __( 'Search projects', 'text_domain' ),
		'not_found'           => __( 'No projects found', 'text_domain' ),
		'not_found_in_trash'  => __( 'No projects found in Trash', 'text_domain' ),
	);

  $rewrite = array(
		'slug'                => 'projects',
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => true,
	);

	$args = array(
		'label'               => __( 'project', 'text_domain' ),
		'description'         => __( 'Information pages about projects', 'text_domain' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields', 'page-attributes', ),
		'taxonomies'          => array( 'category', 'post_tag' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-hammer',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
    'rewrite'             => $rewrite,
	);

	register_post_type( 'project', $args );
}

// Hook into the 'init' action
add_action( 'init', 'custom_post_type_project', 0 );

/**
 * Set up 'thinking' CPT
 *
 *  @return void
 *
 */
function carawebs_custom_post_type_thinking() {
	$labels = array(
		'name'                => _x( 'Thinking', 'Post Type General Name', 'text_domain' ),
		'singular_name'       => _x( 'Thinking', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'           => __( 'Thinking', 'text_domain' ),
		'parent_item_colon'   => __( 'Parent Thinking:', 'text_domain' ),
		'all_items'           => __( 'All Thinking', 'text_domain' ),
		'view_item'           => __( 'View Thinking', 'text_domain' ),
		'add_new_item'        => __( 'Add New Thinking', 'text_domain' ),
		'add_new'             => __( 'New Thinking', 'text_domain' ),
		'edit_item'           => __( 'Edit Thinking', 'text_domain' ),
		'update_item'         => __( 'Update Thinking', 'text_domain' ),
		'search_items'        => __( 'Search Thinking', 'text_domain' ),
		'not_found'           => __( 'No Thinkings found', 'text_domain' ),
		'not_found_in_trash'  => __( 'No Thinkings found in Trash', 'text_domain' ),
	);

	$args = array(
		'label'               => __( 'Thinking', 'text_domain' ),
		'description'         => __( 'Information pages about Thinking', 'text_domain' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields', 'page-attributes', ),
		'taxonomies'          => array( 'category', 'post_tag' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-lightbulb',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);

	register_post_type( 'thinking', $args );
}

// Hook into the 'init' action
add_action( 'init', 'carawebs_custom_post_type_thinking', 0 );

/**
 * Register 'person' CPT
 *
 * @return void
 *
 */
function custom_post_type_person() {
	$labels = array(
		'name'                => _x( 'People', 'Post Type General Name', 'text_domain' ),
		'singular_name'       => _x( 'Person', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'           => __( 'People', 'text_domain' ),
		'parent_item_colon'   => __( '', 'text_domain' ),
		'all_items'           => __( 'All People', 'text_domain' ),
		'view_item'           => __( 'View Person', 'text_domain' ),
		'add_new_item'        => __( 'Add New Person', 'text_domain' ),
		'add_new'             => __( 'New Person', 'text_domain' ),
		'edit_item'           => __( 'Edit Person', 'text_domain' ),
		'update_item'         => __( 'Update Person', 'text_domain' ),
		'search_items'        => __( 'Search people', 'text_domain' ),
		'not_found'           => __( 'No people found', 'text_domain' ),
		'not_found_in_trash'  => __( 'No people found in Trash', 'text_domain' ),
	);

	$rewrite = array(
		'slug'                => 'people',
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => true,
	);

	$args = array(
		'label'               => __( 'people', 'text_domain' ),
		'description'         => __( 'Staff biographical pages', 'text_domain' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'trackbacks', 'revisions', 'custom-fields', 'page-attributes', 'post-formats', ),
		'taxonomies'          => array( 'category', 'post_tag' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-id-alt',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'rewrite'             => $rewrite,
		'capability_type'     => 'page',
	);

	register_post_type( 'people', $args );
}

// Hook into the 'init' action
add_action( 'init', 'custom_post_type_person', 0 );

?>
