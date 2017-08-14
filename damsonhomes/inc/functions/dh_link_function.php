<?php

function dh_link(&$site_meta=array(), &$link_to='', &$dh_option='') {

  if (!empty($link_to)) {

    $start = '?';
    $con   = '&';

    $type         = '?dh_type=' . rawurlencode($link_to);
    $link         = get_site_url() . '/' . $link_to . '/';
    $name_enc     = '&dh_site_name=' . rawurlencode($site_meta['name']);
    $logo         = (!empty($site_meta['logo']) ? '&dh_logo=' . esc_url($site_meta['logo']) : '');
    $brochure     = (!empty($site_meta['brochure']) ? '&dh_link=' . $site_meta['brochure'] : '');
    $source       = (!empty($site_meta['source']) ? '&dh_source=' . esc_url($site_meta['source']) : '');
    $brochure_img = (!empty($site_meta['brochure_img']) ? '&dh_image=' . esc_url($site_meta['brochure_img']) : '');
    $feature_img  = (!empty($site_meta['feature_img']) ? '&dh_image=' . esc_url($site_meta['feature_img']) : '');

    $option       = (!empty($dh_option) ? '&dh_option=' . rawurlencode($dh_option) : ''); 

    $default      = $link . $type . $option . $name_enc . $logo . $source;

    $plot_no      = (!empty($site_meta['plot_no']) ? '&dh_plot_no=' . rawurlencode($site_meta['plot_no']) : ''); 
    $plot_val     = (!empty($site_meta['plot_val']) ? '&dh_plot_val=' . rawurlencode($site_meta['plot_val']) : ''); 
    $plot_desc    = (!empty($site_meta['plot_desc']) ? '&dh_plot_desc=' . rawurlencode($site_meta['plot_desc']) : ''); 
    $plot_h2b     = (!empty($site_meta['plot_h2b']) ? '&dh_plot_h2b=' . rawurlencode('yes') : ''); 
    

    if ($link_to === 'brochure') {

      echo  $default . $brochure . $brochure_img;

    } elseif ($link_to === 'viewing') {

      echo  $default . $feature_img;

    } elseif ($link_to === 'reserve') {

      echo  $default . $brochure . $feature_img . $plot_no . $plot_val . $plot_desc . $plot_h2b;

    } elseif ($link_to === 'register') {

      echo  $default . $feature_img;

    } elseif ($link_to === 'subscribe') {

      // echo  $default . $feature_img;

      echo  $link;

    } else {

      echo '#no_link_defined';

    }


  }

}


// http://damsonhomes.staging.wpengine.com/reserve/?dh_type=reserve&dh_site_name=Lakeside&dh_logo=http://damsonhomes.staging.wpengine.com/wp-content/uploads/2017/06/Lakeside-Logo-600px-150x150.png&dh_source=http://damsonhomes.staging.wpengine.com/lakeside/&dh_link=https://indd.adobe.com/view/b75e2677-81c5-454d-b166-6642cc3a26dc&dh_image=http://damsonhomes.staging.wpengine.com/wp-content/uploads/2017/01/lakeside-ftr-image.png&dh_plot_no=Roses%20Reach%20%28Plot%20One%29&dh_plot_val=420%2C000&dh_plot_desc=Three%20bedroom%20contemporary%20barn%3Ccode%20id=