<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Damson_Homes
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function damsonhomes_body_classes( $classes ) {

	global $post;
	
	// Adds 'sans-hero' to templates without a hero-area

	if (is_single()) {
		$classes[] = 'sans-hero';
	} 

	// Adds a class of hfeed to non-singular pages.

	if (! is_singular() ) {
		$classes[] = 'hfeed';
	}

	if ( get_post_meta( get_the_ID(), 'dh_hide_nav', true ) ) {
		
		$classes[] = 'dh-hide-nav';
		
	}

	return $classes;
}

add_filter( 'body_class', 'damsonhomes_body_classes', 50 );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function damsonhomes_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'damsonhomes_pingback_header' );


function damsonhomes_excerpt_length( $length ) {
    return 20;
}

add_filter( 'excerpt_length', 'damsonhomes_excerpt_length', 999 );

function damsonhomes_excerpt_more( $more ) {
    return '&hellip;';
}
add_filter( 'excerpt_more', 'damsonhomes_excerpt_more' );

