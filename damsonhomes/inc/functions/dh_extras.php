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

// function damsonhomes_body_classes( $classes ) {

// 	global $post;

// 	// Adds a class of hfeed to non-singular pages.

// 	if (! is_singular() ) {
// 		$classes[] = 'hfeed';
// 	}

// 	if ( get_post_meta( get_the_ID(), 'dh_hide_nav', true ) ) {
		
// 		$classes[] = 'dh-hide-nav';
		
// 	}

// 	return $classes;
// }

// add_filter( 'body_class', 'damsonhomes_body_classes', 50 );

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




/**
 * Hardcodes Hamburger in navigation
 * @param string $items HTML with navigation items
 * @param object $args navigation menu arguments
 * @return string all navigation items HTML
 */
function dh_add_burger($items, $args) {
    if($args->theme_location == 'menu-1'){
       $burger = '<li class="burger-holder"><div id="hamburger_menu" class="hamburger-menu"><div class="bar"></div></div></li>';
       $items = $items . $burger;
    }

    if($args->theme_location == 'menu-2'){
       $burger2 = '<li id="side_menu_trigger" class="burger-holder"><a href="#"><span class="more-text">More</span><span id="hamburger_menu_2" class="hamburger-menu"><div class="bar"></div></span></a></li>';
       $items = $items . $burger2;
    }

    return $items;
}
add_filter('wp_nav_menu_items', 'dh_add_burger', 10, 2);





