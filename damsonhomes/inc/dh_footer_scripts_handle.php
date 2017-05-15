<?php

function dh_footer_script_handle() { ?>

  <script id="dh_footer_script_handle">
  <?php do_action('dh_footer_top'); ?>
    jQuery(document).ready(function($) {
      <?php do_action('dh_footer_doc_ready'); ?>
    });
  </script>
  <?php do_action('dh_footer_bottom');
  
}

add_action( 'wp_footer', 'dh_footer_script_handle', 9999 );
