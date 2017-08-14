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

	// // This theme uses wp_nav_menu() in one location.
	// register_nav_menus( array(
	// 	'menu-1' => esc_html__( 'Primary', 'damsonhomes' ),
	// 	'menu-2' => esc_html__( 'Main Menu', 'damsonhomes' ),
	// 	'menu-3' => esc_html__( 'Flyout Menu', 'damsonhomes' ),
	// ) );

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

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

} endif;

add_action( 'after_setup_theme', 'damsonhomes_setup' );


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
 * Plugins
 */

require get_template_directory() . '/inc/dh_theme_functions.php';
// require get_template_directory() . '/inc/plugins/dh_fancybox.php';  // Fancybox
// require get_template_directory() . '/inc/plugins/slick/dh_slick.php';  // Slick Slider
// require get_template_directory() . '/inc/icon-functions.php';       // SVG Icon Sprites


// require get_template_directory() . '/js/dh_footer_scripts_handle.php';
// require get_template_directory() . '/inc/dh_link_function.php';

// require get_template_directory() . '/inc/classes/damson_homes_custom_functions/inc/dh_post_gallery.php';

// require get_template_directory() . '/inc/classes/damson_homes_custom_functions/dhcf.php';

// new dh_custom_functions;
