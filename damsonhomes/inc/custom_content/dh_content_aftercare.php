<?php


add_action('dh_main_content_bottom', 'dh_aftercare_content');

function dh_aftercare_content() {

  if(is_page('aftercare')) { ?>

  <div class="aftercare-grid xv box hide-critical">
    <header>
      <div class="intro-wrap">
        <h3>10 years peace of mind&hellip;</h3>
        <p>Built in with your purchase &mdash; the cover for the structure and interior fitting of your new home.</p>
      </div>
      <div class="provider-logos">
        <img class="dh-logo" src="<?php echo get_template_directory_uri() . '/images/dh-logo-ls-600.png'; ?>" width="75">
        <img class="crl-logo" src="<?php echo get_template_directory_uri() . '/images/crl-logo.png'; ?>" width="50">
      </div>
    </header>
    <p class="years aside">Years (upto)<span class="y1">1</span><span class="y2">2</span><span class="y3">10</span></p>
    <ul class="aftercare-list">
      <li>Settlement cracks and remedial paintwork<span class="duration-dh"></span></li>
      <li>Kitchen appliances and whitegoods<sup>&dagger;</sup><span class="duration-dh"></span></li>
      <li>Natural shrinkage of timber doors and frames<span class="duration-dh"></span></li>
      <li>Wall and floor tiles<span class="duration-dh"></span></li>
      <li>Carpets and floor coverings<span class="duration-dh"></span></li>
      <li class="y2">Baths and showers<span class="duration-dh"></span></li>
      <li class="y2">Toilets<span class="duration-dh"></span></li>
      <li class="y2">Wash basins<span class="duration-dh"></span></li>
      <li class="y2">Pipework and drainage<span class="duration-dh"></span></li>
      <li class="y2">Boiler and Gas Central Heating system<sup>&dagger;</sup><span class="duration-dh"></span></li>
      <li class="y2">Electrical system and security alarm<span class="duration-dh"></span></li>
      <li class="y2">LED spotlights†<span class="duration-dh"></span></li>
      <li class="y2">Windows and access doors<span class="duration-dh"></span></li>
      <li class="y2">Kitchen units and fittings<span class="duration-dh"></span></li>
      <li class="y3">Foundations and footings<span class="duration-dh"></span><span class="duration-crl"></span></li>
      <li class="y3">Floors and staircases<span class="duration-dh"></span><span class="duration-crl"></span></li>
      <li class="y3">Load bearing walls and partitions<span class="duration-dh"></span><span class="duration-crl"></span></li>
      <li class="y3">Roof joists and trusses<span class="duration-dh"></span><span class="duration-crl"></span></li>
      <li class="y3">Load bearing lintels, beams and girders<span class="duration-dh"></span><span class="duration-crl"></span></li>
      <li class="y3">Roof and weatherproof coverings<span class="duration-dh"></span><span class="duration-crl"></span></li>
      <li class="y3">Chimneys and flues<span class="duration-dh"></span><span class="duration-crl"></span></li>
      <li class="y3">Floor decking and screeds<span class="duration-dh"></span><span class="duration-crl"></span></li>
    </ul>
    <footer class="aside">
      <p>Please note: Items are not covered for damage caused by improper use, mistreatment or neglect. <br><sup>&dagger;</sup> Extended warranty available.</p>
    </footer>
  </div>
        
  <?php } 

}





add_action('dh_deferred_styles', 'dh_aftercare_styles', 10);

function dh_aftercare_styles() {

    if (is_page('aftercare')) {

      echo '  <link rel="stylesheet" type="text/css" href="' . get_template_directory_uri() . '/styles/defer-content-aftercare.css"/>' . "\n";

    }

}

