<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

add_editor_style("editor_style.css");

add_theme_support('menus');

add_theme_support( 'post-thumbnails');

set_post_thumbnail_size(940, 350); // banners for home page

add_image_size( 'icon-big', 256, 256, true);
add_image_size( 'icon-small', 96, 96, true);


// Custom Posts

add_action( 'init', 'create_post_type' );
function create_post_type() {
  register_post_type( 'banner',
    array(
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
  
  register_post_type( 'projects',
    array(
      'labels' => array(
        'name' => __( 'Projects' ),
        'singular_name' => __( 'Project' ),
        'add_new' => __( 'Add New' ),
        'add_new_item' => __( 'Add New Project' ),
        'edit' => __( 'Edit' ),
        'edit_item' => __( 'Edit' ),
        'new_item' => __( 'New Project' ),
        'view' => __( 'View' ),
        'view_item' => __( 'View Project' ),
        'search_items' => __( 'Search Projects' ),
        'not_found' => __( 'No projects found' ),
        'not_found_in_trash' => __( 'No projects found in Trash' ),
        'parent' => __( 'Parent Project' ),
      ),
      'public' => true,
      'exclude_from_search' => false,
      'supports' => array(
        'title', 'editor', 'thumbnail', 'excerpt', 'revisions', 'author', 'custom-fields'
      )
    )
  );
}


// WPML specific constants do ignore custom css

define('ICL_DONT_LOAD_NAVIGATION_CSS', true);
define('ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS', true);


// Beautify [galery] shortcode

add_filter('gallery_style', create_function('$a', 'return preg_replace("%
<style type=\'text/css\'>(.*?)</style>

%s", "", $a);'));




?>
