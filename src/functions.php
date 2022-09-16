<?php


 // Get the stylesheet
 function mychildtheme_enqueue_styles() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
 }
 add_action( 'wp_enqueue_scripts', 'mychildtheme_enqueue_styles' );


// UT Filters below
require_once ( 'filters/region-headsearch.php' );
require_once ( 'filters/region-footer.php' );
