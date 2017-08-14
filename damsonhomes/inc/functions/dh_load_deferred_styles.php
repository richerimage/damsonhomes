<?php
/**
 * Loads Deferred CSS in Footer
 *
 * @package Damson_Homes
 */


// Add styles to Deferred CSS Output

add_action('dh_deferred_styles', 'dh_deferred_css', 5);

function dh_deferred_css() {

    $defer_css_path = '  <link rel="stylesheet" type="text/css" href="' . get_template_directory_uri() . '/styles/';

    $global_css     = $defer_css_path . 'defer-global-styles.css"/>' . "\n";

    if (is_page_template('templates/template-site.php')) {

        $site_css   = $defer_css_path . 'defer-site-styles.css"/>' . "\n";

    } else { $site_css = ''; }

    $fancybox_css = $defer_css_path . 'defer-fancybox.css"/>' . "\n";



    // $slick =  '  <link rel="stylesheet" type="text/css" href="' . get_template_directory_uri() . '/inc/plugins/slick/slick.css"/>' . "\n";

    // $dh_css_fancybox  = '  <link rel="stylesheet" type="text/css" href="' . get_template_directory_uri() . '/styles/jquery.fancybox.css"/>' . "\n";

    // $dh_css_aftercare = '  <link rel="stylesheet" type="text/css" href="' . get_template_directory_uri() . '/styles/style-module-aftercare.css"/>' . "\n";

    // if (is_page_template( 'templates/template-site.php' )) {

    //   $dh_css_1 = '  <link rel="stylesheet" type="text/css" href="' . get_template_directory_uri() . '/style-sites-page.css"/>' . "\n";

    // } elseif (is_page_template('templates/template-listings.php')) {

    //   $dh_css_1 = '  <link rel="stylesheet" type="text/css" href="' . get_template_directory_uri() . '/styles/style-template-listings.css"/>' . "\n";

    // } else {

    //   $dh_css_1 = '';

    // }


    // if (is_page('aftercare')) {
    //   $aftercare_css = $dh_css_aftercare;
    // } else {
    //   $aftercare_css = '';
    // }


    echo $global_css . $site_css . $fancybox_css;

}


// Build Deferred Styles Output

// add_action('wp_footer', 'dh_deferred_styles_output', 50);

// function dh_deferred_styles_output() {

//   echo

//   "<noscript id=\"dh_deferred_styles_output\">\n";
  
//   do_action('dh_deferred_styles'); 
  
//   echo

//   "</noscript>\n".
//   "<script id=\"load_deferred_styles\">\n".
//   "  var loadDeferredStyles = function() {\n".
//   "    var addStylesNode = document.getElementById('dh_deferred_styles_output');\n".
//   "    var replacement = document.createElement('div');\n".
//   "    replacement.innerHTML = addStylesNode.textContent;\n".
//   "    document.body.appendChild(replacement)\n".
//   "    addStylesNode.parentElement.removeChild(addStylesNode);\n".
//   "  };\n".
//   "  var raf = requestAnimationFrame || mozRequestAnimationFrame || webkitRequestAnimationFrame || msRequestAnimationFrame;\n".
//   "  if (raf) raf(function() { window.setTimeout(loadDeferredStyles, 0); });\n".
//   "  else window.addEventListener('load', loadDeferredStyles);\n".
//   "</script>\n";

// }
