<?php

function dh_footer_script_handle() {

  echo "<script id=\"dh_footer_script_handle\">\n";
        do_action('dh_footer_top');
  echo "  jQuery(document).ready(function($) {\n ";
        do_action('dh_footer_doc_ready');
  echo " });\n";
  echo "</script>";
  do_action('dh_footer_bottom');
  
}

add_action( 'wp_footer', 'dh_footer_script_handle', 9999 );