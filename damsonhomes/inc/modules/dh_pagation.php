<?php

function dh_pagation(&$class = '') {
    
  global $wp_query, $wp_rewrite;

  $class  = (!empty($class) ? ' ' . $class : '');
  $pages  = '';
  $max    = $wp_query->max_num_pages;

  if (!$current = get_query_var('paged')) $current = 1;

  $a['base']      = str_replace(999999999, '%#%', get_pagenum_link(999999999));
  $a['total']     = $max;
  $a['current']   = $current;
  $total          = 1;
  $a['mid_size']  = 2;
  $a['end_size']  = 1;
  $a['prev_text'] = '&laquo; Prev';
  $a['next_text'] = 'Next &raquo;';

  if ($max > 1) echo '<div class="pagation-wrap' . $class . '"><nav class="pagation-nav">';
  if ($total == 1 && $max > 1) $pages = '<p class="pagation-intro">Page ' . $current . ' of ' . $max . '</p>'."\r\n";
    echo $pages . paginate_links($a);
  if ($max > 1) echo '</nav></div>';  
                    
}
