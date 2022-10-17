<?php
if ( ! defined( 'UTKCHANCELLOR_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'UTKCHANCELLOR_VERSION', '0.1.3' );
}
include_once( get_template_directory() . '/lib/init.php' );


// WordPress Set Up
// ===============================================================

// Get the stylesheet
 function mychildtheme_enqueue_styles() {
	wp_enqueue_style( 'utkchancellor-style', get_template_directory_uri() . '/style.css', array(), UTKCHANCELLOR_VERSION, true );
	wp_enqueue_script( 'utkchancellor-bootstrap',  'https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js', array(), UTKCHANCELLOR_VERSION, true ); 
	wp_enqueue_script( 'utkchancellor-script', get_stylesheet_directory_uri() . '/js/utk.js', array(), UTKCHANCELLOR_VERSION, true ); 
	wp_enqueue_script( 'utkchancellor-google-script', 'https://cse.google.com/cse.js?cx=da48cf0836de1c946', array(), UTKCHANCELLOR_VERSION, true ); 
}
 add_action( 'wp_enqueue_scripts', 'mychildtheme_enqueue_styles' );

// Add support for custom header
add_theme_support( 'custom-header', array(
	'flex-width'      => true,
	'width'           => 400,
	'flex-height'     => true,
	'height'          => 150,
	'header-selector' => '.site-title a',
) );

// Register your footer sidebar. 
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



// UT Filters to add HTML
// ===============================================================

require_once ( 'functions/filter-mobile-nav.php' );
require_once ( 'functions/filter-region-headsearch.php' );
require_once ( 'functions/filter-region-footer.php' );


// Functions to modify elements
// ===============================================================

require_once ( 'functions/inc-breadcrumb.php' );
require_once ( 'functions/inc-layouts.php' );
require_once ( 'functions/inc-patterns.php' );


// Disabling blocks
// ===============================================================

require_once ( 'functions/inc-disableblocks.php' );





// Removing things from Genesis
// =======================================================================

// Remove the site description
remove_action( 'genesis_site_description', 'genesis_seo_site_description' );

// Remove Genesis SEO settings from post/page editor
remove_action( 'admin_menu', 'genesis_add_inpost_seo_box' );

// Remove Genesis SEO settings option page
remove_theme_support( 'genesis-seo-settings-menu' );

// Remove Genesis SEO settings from taxonomy editor
remove_action( 'admin_init', 'genesis_add_taxonomy_seo_options' );