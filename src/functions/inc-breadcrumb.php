<?php 


//* Change the breadcrumb separator.
add_filter( 'genesis_breadcrumb_args', 'gk_change_breadcrumb_separator' );
function gk_change_breadcrumb_separator( $args ) {
    $args['sep'] = ' &rsaquo; ';
    return $args;
}

//* Remove 'You are here' on the front of breadcrumb trail
add_filter( 'genesis_breadcrumb_args', 'gk_prefix_breadcrumb' );
function gk_prefix_breadcrumb( $args ) {
    $args['labels']['prefix'] = ''; 
    return $args;
}
