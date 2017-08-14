<?php


add_action('dh_custom_template', 'dh_test_content');

function dh_test_content() {

  if(is_page('test')) { 

    $test = new dh_site;

    $test->site_test();

  }

}