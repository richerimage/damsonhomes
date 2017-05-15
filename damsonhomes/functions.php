<?php
/**
 * Damson Homes functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Damson_Homes
 */


if ( ! function_exists( 'damsonhomes_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function damsonhomes_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Damson Homes, use a find and replace
	 * to change 'damsonhomes' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'damsonhomes', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary', 'damsonhomes' ),
		'menu-2' => esc_html__( 'Main Menu', 'damsonhomes' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'damsonhomes_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );


	// Add our Image Sizes

	add_image_size( 'letterbox-small ', 600, 338, true );
	add_image_size( 'letterbox-medium ', 900, 506, true );
  add_image_size( 'letterbox-large ', 1200, 675, true );
  add_image_size( 'letterbox-xlarge ', 1600, 900, true );
	
	add_image_size( 'square-small ', 600, 600, true );
	add_image_size( 'square-medium ', 900, 900, true );
  add_image_size( 'square-large ', 1200, 1200, true ); // (cropped)

  add_image_size( 'golden-ratio-small ', 600, 371, true );
	add_image_size( 'golden-ratio-medium ', 900, 556, true );
  add_image_size( 'golden-ratio-large ', 1200, 742, true );

  add_image_size( 'panoramic-large ', 1200, 267, true );
  add_image_size( 'panoramic-xlarge ', 1600, 356, true );
  add_image_size( 'panoramic-full ', 2000, 444, true );

  add_image_size( 'mega-image', 2000 ); // 300 pixels wide (and unlimited height)


} endif;

add_action( 'after_setup_theme', 'damsonhomes_setup' );


add_filter( 'image_size_names_choose', 'dh_custom_img_sizes' );
 
function dh_custom_img_sizes( $sizes ) {
  return array_merge( $sizes, array(

  	'medium_large' => __('Medium Large'),
    
    'letterbox-small'		=> __('Letterbox S (600)'),
    'letterbox-medium'	=> __('Letterbox M (900)'),
    'letterbox-large'		=> __('Letterbox L (1200)'),
    'letterbox-xlarge'  => __('Letterbox XL (1600)'),
    
    'square-small' 			=> __('Square S (600)'),
    'square-medium' 		=> __('Square M (900)'),
    'square-large' 			=> __('Square L (1200)'),

    'panoramic-large'		=> __('Panoramic L (1200)'),
		'panoramic-xlarge'  => __('Panoramic XL (1600)'),
		'panoramic-full'    => __('Panoramic F (2000)'),

    'mega-image'   			=> __('Mahoosive'),
  ) );
}

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */


function damsonhomes_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'damsonhomes_content_width', 640 );
}
add_action( 'after_setup_theme', 'damsonhomes_content_width', 0 );



function dump(&$dump="") {
	if(!empty($dump)) {
		echo '<code><pre>';
		var_dump($dump);
		echo '</pre></code>';
	}
}



/* Add Exceprt for pages */


function add_excerpt_pages() {
	add_post_type_support( 'page', 'excerpt' );
}

add_action('init', 'add_excerpt_pages');

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function damsonhomes_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'damsonhomes' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'damsonhomes' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'damsonhomes_widgets_init' );


/**
 * Implement the Custom Header feature.
 */


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Register Taxonomies
 */
require get_template_directory() . '/inc/tax_site_status.php';

/**
 * Register Custom Post Types
 */
require get_template_directory() . '/inc/cpt_areas.php';
require get_template_directory() . '/inc/cpt_spec.php';
require get_template_directory() . '/inc/cpt_team.php';


/**
 * Social Share Box
 */

require get_template_directory() . '/inc/dh_social_share.php';


/**
 * MetaBoxes
 */

require get_template_directory() . '/inc/metaboxes/dh-mb-sites.php';
require get_template_directory() . '/inc/metaboxes/dh-mb-area.php';
require get_template_directory() . '/inc/metaboxes/dh-mb-post-options.php';
require get_template_directory() . '/inc/metaboxes/dh-mb-sub-headline.php';

/**
 * Plugins
 */

require get_template_directory() . '/inc/plugins/dh_fancybox.php';  // Fancybox
require get_template_directory() . '/inc/plugins/slick/dh_slick.php';  // Slick Slider
require get_template_directory() . '/inc/icon-functions.php';       // SVG Icon Sprites


require get_template_directory() . '/js/dh_footer_scripts_handle.php';
require get_template_directory() . '/inc/dh_link_function.php';

require get_template_directory() . '/inc/classes/damson_homes_custom_functions/inc/dh_post_gallery.php';

require get_template_directory() . '/inc/classes/damson_homes_custom_functions/dhcf.php';

new dh_custom_functions;
