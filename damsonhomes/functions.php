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
}
endif;
add_action( 'after_setup_theme', 'damsonhomes_setup' );

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
 * Enqueue scripts and styles.
 */
function damsonhomes_scripts() {

	// wp_enqueue_style( 'damsonhomes-style', get_template_directory_uri() . '/sass/style.css' );
	// wp_enqueue_script( 'damsonhomes-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
	// wp_enqueue_script( 'damsonhomes-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'damsonhomes_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

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
 * Social Share Box
 */

require get_template_directory() . '/inc/dh_social_share.php';






require get_template_directory() . '/classes/damson_homes_custom_functions/dhcf.php';

new dh_custom_functions;
