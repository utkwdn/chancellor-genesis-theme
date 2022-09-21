<?php
if ( ! defined( 'UTKCHANCELLOR_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'UTKCHANCELLOR_VERSION', '0.1.2' );
}

include_once( get_template_directory() . '/lib/init.php' );


 // Get the stylesheet
 function mychildtheme_enqueue_styles() {
	wp_enqueue_style( 'utkchancellor-style', get_template_directory_uri() . '/style.css', array(), UTKCHANCELLOR_VERSION, true );
	wp_enqueue_script( 'utkchancellor-bootstrap',  'https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js', array(), UTKCHANCELLOR_VERSION, true ); 
	wp_enqueue_script( 'utkchancellor-script', get_stylesheet_directory_uri() . '/js/utk.js', array(), UTKCHANCELLOR_VERSION, true ); 
}
 add_action( 'wp_enqueue_scripts', 'mychildtheme_enqueue_styles' );


// UT Filters below
require_once ( 'filters/region-headsearch.php' );
require_once ( 'filters/region-footer.php' );

//* Add support for custom header
add_theme_support( 'custom-header', array(
	'flex-width'      => true,
	'width'           => 400,
	'flex-height'     => true,
	'height'          => 150,
	'header-selector' => '.site-title a',
) );

/**
 * Registers block categories, and type.
 *
 * (Stole this from utkchancellor)
 */
function utkchancellor_register_block_pattern_categories() {

	/* Functionality specific to the Block Pattern Explorer plugin. */
	if ( function_exists( 'register_block_pattern_category_type' ) ) {
		register_block_pattern_category_type( 'utkchancellor', array( 'label' => __( 'utkchancellor', 'utkchancellor' ) ) );
	}

	$block_pattern_categories = array(
		'utkchancellor-general' => array(
			'label'         => __( 'Chancellor', 'utkchancellor' ),
			'categoryTypes' => array( 'utkchancellor' ),
		),
	);

	foreach ( $block_pattern_categories as $name => $properties ) {
		register_block_pattern_category( $name, $properties );
	}
}
add_action( 'init', 'utkchancellor_register_block_pattern_categories', 9 );

// Removing things from Genesis
// =======================================================================

// Remove the site description
remove_action( 'genesis_site_description', 'genesis_seo_site_description' );
