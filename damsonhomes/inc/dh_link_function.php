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

      echo  $default . $feature_img;

    } else {

      echo '#no_link_defined';

    }


  }

}
