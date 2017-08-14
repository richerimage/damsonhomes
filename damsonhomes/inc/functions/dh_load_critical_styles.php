<?php
/**
 * Loads critical CSS in Head
 *
 * @package Damson_Homes
 */

add_action( 'dh_critical_css', 'dh_load_critical_css', 1);

function dh_load_critical_css() {

	$crit_path 				= get_template_directory_uri() . '/styles/critical-';

  $css_source 			= $crit_path . 'global-styles.css';
  $css_crit_global 	= file_get_contents($css_source); 


  $css_listing_source    = $crit_path . 'listings.css';
  $css_team_source       = $crit_path . 'team.css';
  $css_site_source       = $crit_path . 'site.css';
  $css_front_source      = $crit_path . 'front.css';

  if ( 

    (is_home()) || 
    (is_archive()) || 
    (is_page_template('templates/template-listings.php')) || 
    (is_page_template('templates/template-site.php')) || 
    (is_singular('dnh_cpt_team')) 

  ) {

    $css_crit_listing = file_get_contents($css_listing_source); 

  } else { $css_crit_listing = ''; }


  if (is_singular('dnh_cpt_team')) {

    $css_crit_team = file_get_contents($css_team_source); 

  } else {

    $css_crit_team = ''; 

  }


  if (is_page_template('templates/template-site.php')) {

    $css_crit_site = file_get_contents($css_site_source); 

  } else { $css_crit_site = ''; }

  if (is_front_page()) {

    $css_crit_front = file_get_contents($css_front_source); 

  } else { $css_crit_front = ''; }



  $css = $css_crit_global . $css_crit_listing . $css_crit_team  . $css_crit_site . $css_crit_front;


  echo "\n" . $css; dh_conditional_critical_css();

  // if (is_page_template( 'templates/template-site.php' )) {
  //   echo "\n" . $css_temp_site;
  // }

  // if (is_page_template('templates/template-listings.php')) {
  //   echo "\n " . $css_listings;
  // }

  // $load_on_page = array(
  //   'brochure', 
  //   'register', 
  //   'reserve',  
  //   'subscribe',
  //   'viewing'
  // );

  // if (is_page($load_on_page)) {

  //   echo "\n" . $css_hero_banner_default;

  // }

  // if (is_front_page()) {

  //   echo "\n" . $css_front;

  // }

  // if (is_page('about-us')) {

  //   echo "\n" . $css_about;

  // }

  // if (is_page('spec')) {

  //   echo "\n" . $css_spec;

  // }

 }



 function dh_conditional_critical_css() {

    global $post;

    $portfolio_path = get_template_directory_uri() . '/images/portfolio/';
    $portfolio_1    = $portfolio_path . 'dh-portfolio-wgrange-';
    $portfolio_2    = $portfolio_path . 'dh-portfolio-plaque-';
    $img_sml = '600x600.jpg';
    $img_med = '900x900.jpg';
    $img_lge = '1600x900.jpg';

    $hero_img = get_post_meta($post->ID, 'dh_has_hero', true) ? get_post_meta($post->ID, 'dh_has_hero', true) : '';


    echo "\n/* --- dh_conditional_critical_css --- */\n";

    if (is_home()) {
      echo ".hero-fly-in:before {background-image: url(" . $portfolio_1 . $img_sml . ");}\n".

      // Grandma 960
     "@media only screen and (min-width: 960px) { ".
     ".hero-fly-in:before {background-image: url(" . $portfolio_1 . $img_med . ");}}\n".

      // grandpaPlus 1600
     "@media only screen and (min-width: 1600px) { ".
     ".hero-fly-in:before {background-image: url(" . $portfolio_1 . $img_lge . ");}}\n";

    } else if (is_archive()) {

      echo ".hero-fly-in:before {background-image: url(" . $portfolio_2 . $img_sml . ");}\n".

      // Grandma 960
      "@media only screen and (min-width: 960px) { ".
      ".hero-fly-in:before {background-image: url(" . $portfolio_2 . $img_med . ");}}\n".

      // grandpaPlus 1600
      "@media only screen and (min-width: 1600px) { ".
      ".hero-fly-in:before {background-image: url(" . $portfolio_2 . $img_lge . ");}}\n";
    
    } else if ( (is_single()) || (is_page()) || (is_front()) ) {

        if ( ($hero_img === 'hero-fly-in') && (has_post_thumbnail()) ) {

          $ftr_img_id         = get_post_thumbnail_id();

          $ftr_img_sml        = wp_get_attachment_image_src($ftr_img_id, 'square-small', true);
          $ftr_img_sml_url    = $ftr_img_sml[0];

          $ftr_img_med        = wp_get_attachment_image_src($ftr_img_id, 'square-medium', true);
          $ftr_img_med_url    = $ftr_img_med[0];

          $ftr_img_lge        = wp_get_attachment_image_src($ftr_img_id, 'letterbox-large', true);
          $ftr_img_lge_url    = $ftr_img_lge[0];

          echo ".hero-fly-in:before {background-image: url(" . $ftr_img_sml_url . ");}\n".

          // Grandma 960
          "@media only screen and (min-width: 960px) { ".
          ".hero-fly-in:before {background-image: url(" . $ftr_img_med_url . ");}}\n".

          // grandpaPlus 1600
          "@media only screen and (min-width: 1600px) { ".
          ".hero-fly-in:before {background-image: url(" . $ftr_img_lge_url . ");}}";

        } else {}

    } else { } 

 }

 // add_action( 'dh_critical_css', 'dh_conditional_critical_css', 5);

  