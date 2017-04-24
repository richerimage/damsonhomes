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

    define('DH_CF_PATH', DH_PATH . 'classes/damson_homes_custom_functions/');

    // Enqueue Scripts and Styles


    add_action('admin_enqueue_scripts', array($this , 'dh_admin_styles'));

    add_action('wp_enqueue_scripts', array($this , 'dh_load_scripts'));

    add_action( 'dh_critical_css', array($this, 'dh_critical_css'));

    // add footer css file

    add_action('wp_footer', array($this, 'dh_deferred_styles'), 50);

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


    $row_width          = 1600;
    $content_width      = round($row_width * 0.6666667);
    
    $square             = round($content_width / 2);
    $classic_height     = round($content_width / 3 * 2);
    $standard_height    = round($content_width / 4 * 3);
    $golden_height      = round($content_width / 1.61803398875);
    $letterbox_height   = round($row_width / 16 * 9);
    $anamorphic_height  = round($row_width / 2.39);
    $panavision_height  = round($row_width / 2.75);
    $ultrawide_height   = round($row_width / 21 * 9);
    $polyvision_height  = round($row_width / 4);

    add_image_size( 'DNA Dev', 600, 338, true );
    add_image_size( 'Icon', 75, 75, true );
    add_image_size( 'Square', $square, $square, true );
    add_image_size( 'Classic', $content_width, $classic_height, true );
    add_image_size( 'Standard', $content_width, $standard_height, true );
    add_image_size( 'Golden Ratio', $content_width, $golden_height, true );
    add_image_size( 'Letterbox 16:9', $row_width, $letterbox_height, true );
    add_image_size( 'Anamorphic 2.39:1', $row_width, $anamorphic_height, true );
    add_image_size( 'Ultra-Panavision 2.75:1', $row_width, $panavision_height, true );
    add_image_size( 'Ultra-Wide 21:9', $row_width, $ultrawide_height, true );
    add_image_size( 'Polyvision 4:1', $row_width, $polyvision_height, true );

    add_filter('image_size_names_choose', array($this, 'dh_custom_sizes'));

    add_filter ('post_gallery', array($this, 'dh_post_gallery'), 10, 2);
    // add_action ('wp_footer', array($this, 'add_owl_script'), 50);

  }


  public function dh_critical_css() {

    $css_source = get_template_directory_uri() . '/sass/critical.css';
    $css = file_get_contents($css_source); 

    $css_temp_site_source = get_template_directory_uri() . '/sass/critical-template-site.css';
    $css_temp_site = file_get_contents($css_temp_site_source); 

    echo "\n" . $css;

    if (is_page_template( 'template-site.php' )) {
      echo "\n" . $css_temp_site;
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

    $dh_css = '  <link rel="stylesheet" type="text/css" href="' . get_template_directory_uri() . '/sass/style.css"/>' . "\n";

    if (is_page_template( 'template-site.php' )) {

      $dh_css_temp_site = '  <link rel="stylesheet" type="text/css" href="' . get_template_directory_uri() . '/sass/style-template-site.css"/>' . "\n";

    } else {

      $dh_css_temp_site = '';

    }

    echo

    "<noscript id=\"dna_deferred_styles\">\n".
      $dh_css . 
      $dh_css_temp_site .
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

    wp_enqueue_script( 'dh-scripts', DH_URL . '/js/dh_scripts.js', 'jquery', false, true );

    if (is_page_template( 'template-site.php' )) {

      wp_enqueue_script( 'google-maps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyC2MEUHYicgbIvLGyU2o0GZJ_R9vluTJP8&extension=.js', '', false, true);

      // wp_enqueue_script( 'google-maps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyC2MEUHYicgbIvLGyU2o0GZJ_R9vluTJP8&sensor=false&extension=.js', '', false, true);

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


  public function dh_post_gallery($output, $attr) {
      
      global $post, $wp_locale;

      static $instance = 0;
      $instance++;

      // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
      if ( isset( $attr['orderby'] ) ) {
        $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
        if ( !$attr['orderby'] )
            unset( $attr['orderby'] );
      }

      $class_option = 'owl-carousel';

      extract(shortcode_atts(array(
        'order'      => 'ASC',
        'orderby'    => 'menu_order ID',
        'id'         => $post->ID,
        'itemtag'    => 'div',
        'icontag'    => 'div',
        'captiontag' => 'span',
        'columns'    => '',
        'link'       => 'file',
        'size'       => 'thumbnail',
        'class'      => '', 
        'include'    => '',
        'exclude'    => ''
      ), $attr));

      if ($class_option == 'owl-carousel') {
        $this->addScript = true;
      }

      $id = intval($id);
      if ( 'RAND' == $order )
          $orderby = 'none';
      if ( !empty($include) ) {
        $include = preg_replace( '/[^0-9,]+/', '', $include );
        $_attachments = get_posts(
          array(
            'include'         => $include,
            'post_status'     => 'inherit',
            'post_type'       => 'attachment',
            'post_mime_type'  => 'image',
            'order'           => $order,
            'orderby'         => $orderby));

        $attachments = array();
        foreach ( $_attachments as $key => $val ) {
            $attachments[$val->ID] = $_attachments[$key];
        }
      } elseif (!empty($exclude)) {
        $exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
        $attachments = get_children(
          array(
            'post_parent'     => $id,
            'exclude'         => $exclude,
            'post_status'     => 'inherit',
            'post_type'       => 'attachment',
            'post_mime_type'  => 'image',
            'order'           => $order,
            'orderby'         => $orderby));
      } else {
        $attachments = get_children(
          array(
            'post_parent'     => $id,
            'post_status'     => 'inherit',
            'post_type'       => 'attachment',
            'post_mime_type'  => 'image',
            'order'           => $order,
            'orderby'         => $orderby));
      }

      if ( empty($attachments) )
          return '';

      if ( is_feed() ) {
        $output = "\n";
        foreach ( $attachments as $att_id => $attachment )
          $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
        return $output;
      }

      $itemtag    = tag_escape($itemtag);
      $captiontag = tag_escape($captiontag);
      $columns    = intval($columns);
      $itemwidth  = $columns > 0 ? floor(100/$columns) : 100;
      $float      = is_rtl() ? 'right' : 'left';
      $selector   = "gallery-{$instance}";

      // var_dump($this->options['gallery-output']);

      // $plugin_class = !empty($this->options['gallery-output']) ? 'owl-carousel ' : '';

      $class = !empty($class) ? $class . ' ' . $class_option . ' ' : $class_option . ' ';

      // $class_option = !empty($class_option) ? ' ' . $class_option : '';
      

      $output     = "<div id=\"$selector\" class=\"gallery gallery-id-{$id} " . $class . (!empty($columns) ? 'gallery-columns-' . $columns . ' ' : '') . "clearfix\">";

      $i = 0;

      foreach ( $attachments as $id => $attachment ) {

        $link = isset($attr['link']) && 'file' == $attr['link'] 

          ? wp_get_attachment_link($id, $size, false, false) 

          : wp_get_attachment_image($id, $size, false);


        $output .= "<{$itemtag} class='gallery-item'>";
        $output .= "<{$icontag} class='gallery-icon'>";
        $output .= (!empty($title) ? '<div class="image-title">' . $attachment->post_title . '</div>' : '');
        $output .= $link;
        $output .= "</{$icontag}>";
        if ( $captiontag && trim($attachment->post_excerpt) ) {
          $output .= "<{$captiontag} class='gallery-caption'>";
          $output .= wptexturize($attachment->post_excerpt);
          $output .= "</{$captiontag}>";
        }
        $output .= "</{$itemtag}>";
      }
      $output .= "</div>";

      return $output;
  }

  
}
