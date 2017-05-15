<?php
/*
  This file is for skin specific customizations. Be careful not to change your skin's skin.php file as that will be upgraded in the future and your work will be lost.
  If you are more comfortable with PHP, we recommend using the super powerful Thesis Box system to create elements that you can interact with in the Thesis HTML Editor.
*/



class dh_custom_functions {

  public function __construct() {
   
    // define asset paths

    define('DH_PATH', get_template_directory() . '/');
    define('DH_URL', get_template_directory_uri());

    define('DH_CF_PATH', DH_PATH . 'inc/classes/damson_homes_custom_functions/');

    // Enqueue Scripts and Styles


    add_action('admin_enqueue_scripts', array($this , 'dh_admin_styles'));

    add_action('wp_enqueue_scripts', array($this , 'dh_load_scripts'));

    add_action( 'dh_critical_css', array($this, 'dh_critical_css'));

    // add footer css file

    add_action('wp_footer', array($this, 'dh_deferred_styles'), 50);

    add_action('wp_footer', array($this, 'dh_brochure_link_js'), 50);
    

    // Remove emoji js

    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );

    // Remove jQuery Migrate

    add_action('wp_default_scripts', array($this, 'remove_jquery_migrate'));

    // Remove WP Embed

    add_action( 'wp_footer', array($this, 'dh_deregister_wp_embed_script'));
    add_shortcode('email',  array($this, 'dh_antispam_email'));

    
    add_action( 'save_post', array($this, 'delete_transients_live_site'));


    // $row_width          = 1600;
    // $content_width      = round($row_width * 0.6666667);
    
    // $square             = round($content_width / 2);
    // $classic_height     = round($content_width / 3 * 2);
    // $standard_height    = round($content_width / 4 * 3);
    // $golden_height      = round($content_width / 1.61803398875);
    // $letterbox_height   = round($row_width / 16 * 9);
    // $anamorphic_height  = round($row_width / 2.39);
    // $panavision_height  = round($row_width / 2.75);
    // $ultrawide_height   = round($row_width / 21 * 9);
    // $polyvision_height  = round($row_width / 4);

    // add_image_size( 'DNA Dev', 600, 338, true );
    // add_image_size( 'Icon', 75, 75, true );
    // add_image_size( 'Square', $square, $square, true );
    // add_image_size( 'Classic', $content_width, $classic_height, true );
    // add_image_size( 'Standard', $content_width, $standard_height, true );
    // add_image_size( 'Golden Ratio', $content_width, $golden_height, true );
    // add_image_size( 'Letterbox 16:9', $row_width, $letterbox_height, true );
    // add_image_size( 'Anamorphic 2.39:1', $row_width, $anamorphic_height, true );
    // add_image_size( 'Ultra-Panavision 2.75:1', $row_width, $panavision_height, true );
    // add_image_size( 'Ultra-Wide 21:9', $row_width, $ultrawide_height, true );
    // add_image_size( 'Polyvision 4:1', $row_width, $polyvision_height, true );

    // add_filter('image_size_names_choose', array($this, 'dh_custom_sizes'));

    

    // add_filter ('post_gallery', array($this, 'dh_post_gallery'), 10, 2);
    // add_action ('wp_footer', array($this, 'add_owl_script'), 50);
    // add_action( 'print_media_templates', array($this, 'dh_add_gallery_options' ));

  }





  // public function dh_post_gallery($output, $attr) {
  //   require DH_CF_PATH . '/inc/dh_post_gallery.php';
  // }


  public function dh_brochure_link_js() {

    require DH_CF_PATH . '/inc/dh_brochure_link.php';

  }



  public function dh_critical_css() {

    $css_source = get_template_directory_uri() . '/style-critical.css';
    $css = file_get_contents($css_source); 

    $css_temp_site_source = get_template_directory_uri() . '/style-crit-sites-page.css';
    $css_temp_site = file_get_contents($css_temp_site_source); 

    $css_hero_banner_default_source = get_template_directory_uri() . '/styles/style-critical-hero-banner-default.css';
    $css_hero_banner_default = file_get_contents($css_hero_banner_default_source); 

    echo "\n" . $css;

    if (is_page_template( 'templates/template-site.php' )) {
      echo "\n" . $css_temp_site;
    }

    $load_on_page = array(
      'brochure', 
      'register', 
      'reserve',  
      'subscribe',
      'viewing'
    );

    if (is_page($load_on_page)) {

      echo "\n" . $css_hero_banner_default;

    }

  }

  public function delete_transients_live_site() {
    global $post;
      delete_transient('live_site_query');
      delete_transient('past_site_query');
  }

  


  public function dh_custom_sizes( $sizes ) {
    $dh_sizes = array(
      'Icon'      => __('Icon'),
      'Square'    => __('Square'),
      'Classic'   => __('Classic'),
      'Standard'  => __('Standard'),
      'Golden Ratio'   => __('Golden Ratio'),
      'Letterbox 16:9' => __('Letterbox 16:9'),
      'Anamorphic 2.39:1' => __('Anamorphic 2.39:1'),
      'Ultra-Panavision 2.75:1' => __('Ultra-Panavision 2.75:1'),
      'Ultra-Wide 21:9' => __('Ultra-Wide 21:9'),
      'Polyvision 4:1'  => __('Polyvision 4:1')
    );
    return array_merge( $sizes, $dh_sizes );
  }


  public function dh_deferred_styles() {

    $dh_css = '  <link rel="stylesheet" type="text/css" href="' . get_template_directory_uri() . '/style.css"/>' . "\n";

    $slick =  '  <link rel="stylesheet" type="text/css" href="' . get_template_directory_uri() . '/inc/plugins/slick/slick.css"/>' . "\n";

    $dh_css_fancybox  = '  <link rel="stylesheet" type="text/css" href="' . get_template_directory_uri() . '/styles/jquery.fancybox.css"/>' . "\n";

    if (is_page_template( 'templates/template-site.php' )) {

      $dh_css_temp_site = '  <link rel="stylesheet" type="text/css" href="' . get_template_directory_uri() . '/style-sites-page.css"/>' . "\n";
      

    } else {

      $dh_css_temp_site = '';

    }

    echo

    "<noscript id=\"dna_deferred_styles\">\n".
      $dh_css . 
      // $slick  .
      $dh_css_temp_site .
      $dh_css_fancybox .
    "</noscript>\n\n".

    "<script id=\"load_deferred_styles\">\n".
    "  var loadDeferredStyles = function() {\n".
    "    var addStylesNode = document.getElementById('dna_deferred_styles');\n".
    "    var replacement = document.createElement('div');\n".
    "    replacement.innerHTML = addStylesNode.textContent;\n".
    "    document.body.appendChild(replacement)\n".
    "    addStylesNode.parentElement.removeChild(addStylesNode);\n".
    "  };\n".
    "  var raf = requestAnimationFrame || mozRequestAnimationFrame || webkitRequestAnimationFrame || msRequestAnimationFrame;\n".
    "  if (raf) raf(function() { window.setTimeout(loadDeferredStyles, 0); });\n".
    "  else window.addEventListener('load', loadDeferredStyles);\n".
    "</script>\n";

  }


  public function dh_admin_styles() {

    $admin_css = get_template_directory_uri() . '/sass/admin/dh-admin.css';

    wp_register_style( 'dh_admin_mb', $admin_css, array( 'cmb2-styles' ), false );
    wp_enqueue_style( 'dh_admin_mb' );

  }
  

  public function remove_jquery_migrate($scripts) {
     if (is_admin()) return;
     $scripts->remove('jquery');
     $scripts->add('jquery', false, array('jquery-core'), '1.10.2');
  }

  public function dh_deregister_wp_embed_script(){
    wp_deregister_script( 'wp-embed' );
  }

  public function dh_load_scripts(){

    $inc = includes_url();

    if (!is_admin()) {

      wp_deregister_script('jquery');
      wp_register_script('jquery', $inc . 'js/jquery/jquery.js', false, '', true);
      wp_enqueue_script('jquery');

    }

    wp_register_script( 'dh-scripts', DH_URL . '/js/dh_scripts.js', 'jquery', false, true );
    wp_register_script( 'dh-fancybox', DH_URL . '/js/jquery.fancybox.min.js', 'jquery', false, true );
    wp_register_script( 'dh-slick', DH_URL . '/inc/plugins/slick/slick.min.js', 'jquery', false, true );

    wp_enqueue_script( 'dh-scripts' );
    wp_enqueue_script( 'dh-fancybox' );
    wp_enqueue_script( 'dh-slick' );


    if (is_page_template( 'templates/template-site.php' )) {

      wp_enqueue_script( 'google-maps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyC2MEUHYicgbIvLGyU2o0GZJ_R9vluTJP8&extension=.js', '', false, true);

    }
    



  }



  public function dh_antispam_email($attr) {
    extract( shortcode_atts( array(
        'mailto' => get_the_author_meta('user_email'),
        'text'    => '',
        'id'      => '',
        'class'   => '',
        'title'   => 'send an email'
        
    ), $attr ) );

    $id     = !empty($id)     ? "id=\"$id\" " : "";
    $class  = !empty($class)  ? "class=\"$class\" " : "";

    $link_text = !empty($attr['text']) ? $attr['text'] : $mailto;
 
    $output  = '<a ' . $id . $class . ' href="mailto:' . antispambot($mailto) . '" title="' . $title . '" target="_blank">';
    $output .= antispambot($link_text);
    $output .= '</a>';
 
    return $output;
  }




  
}
