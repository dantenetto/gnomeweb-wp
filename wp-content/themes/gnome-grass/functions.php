<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

add_editor_style("editor_style.css");

add_theme_support('menus');

add_theme_support( 'post-thumbnails', array( 'banner' ) );
set_post_thumbnail_size(940, 350);

add_action( 'init', 'create_post_type' );
function create_post_type() {
  register_post_type( 'banner',
    array(
      'labels' => array(
        'name' => __( 'Banners' ),
        'singular_name' => __( 'Banner' )
      ),
      'labels' => array(
        'name' => __( 'Banners' ),
        'singular_name' => __( 'Banner' ),
        'add_new' => __( 'Add New' ),
        'add_new_item' => __( 'Add New Banner' ),
        'edit' => __( 'Edit' ),
        'edit_item' => __( 'Edit' ),
        'new_item' => __( 'New Banner' ),
        'view' => __( 'View' ),
        'view_item' => __( 'View Banner' ),
        'search_items' => __( 'Search Banners' ),
        'not_found' => __( 'No banners found' ),
        'not_found_in_trash' => __( 'No banners found in Trash' ),
        'parent' => __( 'Parent Banner' ),
      ),
      'public' => true,
      'exclude_from_search' => false,
      'supports' => array(
        'title', 'thumbnail', 'excerpt', 'revisions', 'author', 'custom-fields'
      )
    )
  );
}

define('ICL_DONT_LOAD_NAVIGATION_CSS', true);
define('ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS', true);


?>
