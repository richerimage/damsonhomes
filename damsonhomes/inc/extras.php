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



add_shortcode('test', 'my_shortcode');

function my_shortcode($atts, $content = null) {
  
  extract(shortcode_atts(array(
  "tag"   => 'div',
  "class" => '',
  "id"    => '',
  ), $atts));


  $id = !empty($id) ? "id=\"dna-reveal-{$id}\" " : "";
  $class = !empty($class) ? " $class" : "";

$output = '<div class="gallery">
  <a href="https://damsondev.wpengine.com/wp-content/uploads/2017/02/Front-View.jpg" 
  	data-fancybox="images" 
  	data-width="1280" 
  	data-height="720" 
  	data-srcset="https://damsondev.wpengine.com/wp-content/uploads/2017/02/Front-View-960x540.jpg 1600w,
  	             https://damsondev.wpengine.com/wp-content/uploads/2017/02/Front-View-960x540.jpg 1200w,
  	             https://damsondev.wpengine.com/wp-content/uploads/2017/02/Front-View-768x432.jpg 768w,
  	             https://damsondev.wpengine.com/wp-content/uploads/2017/02/Front-View-300x169.jpg 300w">
    <img src="https://damsondev.wpengine.com/wp-content/uploads/2017/02/Front-View-150x150.jpg">
  </a>
  
   <a href="https://damsondev.wpengine.com/wp-content/uploads/2017/02/Rear-View.jpg" 
     data-fancybox="images" 
     data-width="1280" 
     data-height="720"
     data-srcset="https://damsondev.wpengine.com/wp-content/uploads/2017/02/Rear-View-960x540.jpg 1600w, 
                  https://damsondev.wpengine.com/wp-content/uploads/2017/02/Rear-View-960x540.jpg 1200w, 
                  https://damsondev.wpengine.com/wp-content/uploads/2017/02/Rear-View-768x432.jpg 768w,
                  https://damsondev.wpengine.com/wp-content/uploads/2017/02/Rear-View-300x169.jpg 300w"
     data-caption="<strong>Hello Tiger</strong> You\'re looking fine today!!">
    	<img src="https://damsondev.wpengine.com/wp-content/uploads/2017/02/Rear-View-150x150.jpg">
  </a>
  
  <a href="https://damsondev.wpengine.com/wp-content/uploads/2016/11/Dingle-Side-Finals-15-900x540.jpg" 
     data-fancybox="images" 
     data-width="900" 
     data-height="540">
    	<img src="https://damsondev.wpengine.com/wp-content/uploads/2016/11/Dingle-Side-Finals-15-150x150.jpg">
  </a>
  
  <a href="https://damsondev.wpengine.com/wp-content/uploads/2016/11/Trinity-Gate-HD-34-960x540.jpg" 
     data-fancybox="images" 
     data-width="900" 
     data-height="540">
    	<img src="https://damsondev.wpengine.com/wp-content/uploads/2016/11/Trinity-Gate-HD-34-150x150.jpg">
  </a>
  
  <a href="https://damsondev.wpengine.com/wp-content/uploads/2016/11/Dingle-Side-Finals-06-900x540.jpg" 
     data-fancybox="images" 
     data-width="900" 
     data-height="540">
    	<img src="https://damsondev.wpengine.com/wp-content/uploads/2016/11/Dingle-Side-Finals-06-150x150.jpg">
  </a>
    
  <a href="https://damsondev.wpengine.com/wp-content/uploads/2016/11/Trinity-Gate-HD-57-960x540.jpg" 
     data-fancybox="images" 
     data-width="900" 
     data-height="540">
    	<img src="https://damsondev.wpengine.com/wp-content/uploads/2016/11/Trinity-Gate-HD-57-150x150.jpg">
  </a>
  
  <a href="https://damsondev.wpengine.com/wp-content/uploads/2016/11/Trinity-Gate-HD-77-960x540.jpg" 
     data-fancybox="images" 
     data-width="900" 
     data-height="540">
    	<img src="https://damsondev.wpengine.com/wp-content/uploads/2016/11/Trinity-Gate-HD-77-150x150.jpg">
  </a>

</div>';

    return $output;

}





