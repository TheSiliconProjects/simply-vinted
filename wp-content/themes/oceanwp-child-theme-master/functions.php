<?php
/**
 * OceanWP Child Theme Functions
 *
 * When running a child theme (see http://codex.wordpress.org/Theme_Development
 * and http://codex.wordpress.org/Child_Themes), you can override certain
 * functions (those wrapped in a function_exists() call) by defining them first
 * in your child theme's functions.php file. The child theme's functions.php
 * file is included before the parent theme's file, so the child theme
 * functions will be used.
 *
 * Text Domain: oceanwp
 * @link http://codex.wordpress.org/Plugin_API
 *
 */

/**
 * Load the parent style.css file
 *
 * @link http://codex.wordpress.org/Child_Themes
 */
function oceanwp_child_enqueue_parent_style() {

	// Dynamically get version number of the parent stylesheet (lets browsers re-cache your stylesheet when you update the theme).
	$theme   = wp_get_theme( 'OceanWP' );
	$version = $theme->get( 'Version' );

	// Load the stylesheet.
	wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'oceanwp-style' ), $version );
	
}

add_action( 'wp_enqueue_scripts', 'oceanwp_child_enqueue_parent_style' );

/** Hide admin menu for non logged in user */

function wpdocs_unset_menu_items( $menu_objects, $args ) {

    if ( is_user_logged_in() ) {
        return $menu_objects;
   }

   $menu_items = array(
        'Admin',
    );

    foreach ( $menu_objects as $key => $menu_object ) {
      if ( ! in_array( $menu_object->title, $menu_items ) ) {
         continue;
     }
        unset( $menu_objects[ $key ] );
 }

 return $menu_objects;}

 add_filter( 'wp_nav_menu_objects', 'wpdocs_unset_menu_items', 10, 2 );
