<?php
/**
 * Loads Scripts n' stuff
 *
 * @package Damson_Homes
 */

add_action('wp_enqueue_scripts', 'dh_load_scripts');

function dh_load_scripts(){

  global $post;

  $inc = includes_url();

  wp_register_script( 'dh-modernizr', get_template_directory_uri() . '/js/dh_modernizr.min.js');

  $jq_in_head = array (
    'contact',
    'brochure', 
    'register', 
    'reserve',  
    'subscribe',
    'viewing'
  );

  if (!is_admin()) {

    wp_deregister_script('jquery');
    wp_register_script('jquery', $inc . 'js/jquery/jquery.js', false, '', true);
    wp_enqueue_script('jquery');

  }

  if (is_page($jq_in_head)) {

    wp_deregister_script('jquery');
    wp_register_script('jquery', $inc . 'js/jquery/jquery.js', false, '', false);
    wp_enqueue_script('jquery');

  }

  wp_register_script( 'dh-scripts', get_template_directory_uri() . '/js/dh_scripts.js', 'jquery', false, true );
  wp_register_script( 'dh-fancybox', get_template_directory_uri() . '/js/jquery.fancybox.min.js', 'jquery', false, true );
  wp_register_script( 'dh-slick', get_template_directory_uri() . '/js/slick.min.js', 'jquery', false, true );

  wp_enqueue_script( 'dh-modernizr' );
  wp_enqueue_script( 'dh-scripts' );
  wp_enqueue_script( 'dh-fancybox' );
  wp_enqueue_script( 'dh-slick' );

  if ( (is_page_template(array ('templates/template-site.php', 'templates/template-listings.php'))) || (is_page('contact')) ) {
    wp_enqueue_script( 'google-maps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyC2MEUHYicgbIvLGyU2o0GZJ_R9vluTJP8&extension=.js', '', false, true);
  }
  
}


function dh_add_to_footer_script_handle() {

  echo "\t\$('.card-social').viewportChecker({\n".
         "\t\toffset: 100\n".
         "\t});\n";

  if (is_home()) { 

    echo "\tvar greeting = [
      'Easy, Tiger!', 
      'Hey There!',
      'Howdy, Rockstar!',
      'S\'up!',
      'A Thousand Greetings!',
      'Ahoy!',
      'Hello Gorgeous x',
      '** High Five **'
    ];\n

    \tvar randomGreeting = Math.floor(Math.random() * greeting.length);\n";

  }

  if (is_home()) {

    echo "\t$('#say_hello').text(greeting[randomGreeting]).addClass('say-hello');\n";

  } elseif (is_single()) {

    echo "\t$('#say_hello').addClass('say-hello');\n";

  } else {}


  if (is_page_template('templates/template-site.php')) {

    echo 

    "\t\$( document ).ready(function() { moveThis(); });\n".
    "\t\$( window ).resize( function() { moveThis(); });\n".

    "\tfunction moveThis(){\n".
    "\t\tvar ww = document.body.clientWidth;\n".
    "\t\tif (ww >= 768) {\n".
    "\t\t\t\$('.dh-social-share-box').appendTo($('#on_momma') );\n".
    "\t\t} else {\n".
    "\t\t\t\$('.dh-social-share-box').appendTo($('.hero-left'));\n".
    "\t\t}\n".
    "\t}\n";

  }



  // Add Slick
  
  echo "    \$('[data-gallery=\"slider\"]').slick({
                autoplay: false,
                adaptiveHeight: true,
                arrows: true,
                dots: true,
                mobileFirst: true,
                nextArrow: '<button type=\"button\" class=\"slick-buttons slick-next\"><svg class=\"icon icon-arrow-right\" aria-hidden=\"true\" role=\"img\"><use href=\"#icon-arrow-right\" xlink:href=\"#icon-arrow-right\"></use></svg></button>',
                prevArrow: '<button type=\"button\" class=\"slick-buttons slick-prev\"><svg class=\"icon icon-arrow-left\" aria-hidden=\"true\" role=\"img\"><use href=\"#icon-arrow-left\" xlink:href=\"#icon-arrow-left\"></use></svg></button>',
            });\n";


}

add_action( 'dh_footer_doc_ready', 'dh_add_to_footer_script_handle');
