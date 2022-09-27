<?php
if ( ! defined( 'UTKCHANCELLOR_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'UTKCHANCELLOR_VERSION', '0.1.2' );
}

// Add full-width to blocks – this is now added in the theme.json as "layout" and is not needed here
// function setup_theme() {
// 	add_theme_support( 'align-wide' );
//   }
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

/* Register your footer sidebar. */
add_action( 'widgets_init', 'utkchancellor_sidebar' );
function utkchancellor_sidebar() {
    register_sidebar(
        array(
            'id'            => 'utkchancellor_footer',
            'name'          => __( 'Footer Sidebar' ),
            'description'   => __( 'Add contact information here.' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        )
    );
    /* Repeat register_sidebar() code for multiple sidebars. */
}


// Create a new layout, fixed width grid.
add_action( 'after_setup_theme', 'authority_register_grid_layout' );
/**
 * Registers custom grid layout.
 */
function authority_register_grid_layout() {
	genesis_register_layout(
		'authority-grid', // A layout slug of your choice. Used in body classes. 
		[
			'label' => __( 'Three-column Grid', 'authority-pro' ),
			'img'   => get_stylesheet_directory_uri() . '/images/max-width-thumb.gif',
			'type'  => [ 'category', 'post_tag' ],
		]
	);
}


//* Include template
add_action( 'template_include', 'content_bottom_sidebars_template', 9999 );
function content_bottom_sidebars_template( $template ) {

	$layout = genesis_site_layout();

	if ( $layout == 'content-bottom-sidebars' ) {

		$template = locate_template( array( 'template-nosidebar.php' ) );

	}

	return $template;

}

// Add layout options back in on archive pages
if ( function_exists( 'genesis_add_type_to_layout' ) ) {
	genesis_add_type_to_layout( 'content-sidebar', [ 'category', 'post_tag' ] );
	genesis_add_type_to_layout( 'sidebar-content', [ 'category', 'post_tag' ] );
	genesis_add_type_to_layout( 'full-width-content', [ 'category', 'post_tag' ] );
}




// Kill the two side-bar layouts
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );

unregister_sidebar( 'sidebar-alt' );
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
