<?php

function dh_location(&$name = '', &$address = '', $area_id = '') {

  global $post;

  $area_intro    = get_post_meta($post->ID, 'dh_area_intro', true) ?  get_post_meta($post->ID, 'dh_area_intro', true) : '';

  ?>

  <div class="column-full">
    <h2>Around <?php echo $name; ?></h2>
    <?php if (!empty($area_intro)) { ?>
    <div class="area-intro entry-content">
      <?php echo wpautop(do_shortcode($area_intro)); ?>
    </div>
    <?php } ?>
  </div>

  <div class="column-1-2 columns desc-wrap">

  
    <h3 class="headline"><?php echo get_post_field('post_title', $area_id); ?></h3>
    <?php echo get_the_post_thumbnail( $area_id, 'Golden Ratio' ); ?>
    <div class="entry-content">
      <?php echo  wpautop(do_shortcode(get_post_field('post_content', $area_id))); ?>
    </div>
      
  </div>

  <div class="column-1-2 columns map-wrap xv box">
    <h5>
      <span class="dh-svg dh-svg-location icon-location-22">
        <svg class="icon-location" height="100%" width="100%">
          <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-location"></use>
        </svg>
      </span>
      <?php echo $name; ?> Address
    </h5>
    <?php echo $address; ?>
    <div id="dh_map" class="site-map frame"></div>

    <?php

    $dh_distances    = get_post_meta($post->ID, 'dh_distance', true) ?  get_post_meta($post->ID, 'dh_distance', true) : '';

    if (!empty($dh_distances)) { ?>
    <h5>Key Distances</h5>
    <ul class="target-distances">
      <?php foreach( $dh_distances as $key => $dh_dist){
      echo '<li><span class="target">' . $dh_dist['dh_location_name'] . ' </span><span class="distance">' . $dh_dist['dh_location_distance'] . '</span></li>';
      } ?>
    </ul>

    <?php } ?>
  </div>


  <div class="column-full columns location-meta">


    <?php 


    $dh_picks    = get_post_meta($area_id, 'dh_area_picks', true) ?  get_post_meta($area_id, 'dh_area_picks', true) : '';

    if (!empty($dh_picks)) { ?>
    
    <div class="column-1-3 area-meta-picks">
      <h5>Damson Picks</h5>
      <ul>
      <?php foreach( $dh_picks as $key => $dh_pick){
        echo '<li><a href="' . $dh_pick['dh_pick_url'] . '" target="_blank"><strong>' . $dh_pick['dh_pick_name'] . '</strong></a><br />' . $dh_pick['dh_pick_desc'] . '</li>';
      } ?>
      </ul>
    </div>

    <?php } 

    $dh_schools    = get_post_meta($area_id, 'dh_area_schools', true) ?  get_post_meta($area_id, 'dh_area_schools', true) : '';

    if (!empty($dh_schools)) { ?>
    
    <div class="column-1-3 area-meta-schools">
      <h5>Education</h5>
      <ul>
      <?php foreach( $dh_schools as $key => $dh_school){
        echo '<li><a href="' . $dh_school['dh_school_url'] . '" target="_blank"><strong>' . $dh_school['dh_school_name'] . '</strong></a><br />' . $dh_school['dh_school_desc'] . '</li>';
      } ?>
      </ul>
    </div>

    <?php }

    if (!empty(get_post_meta($area_id, 'dh_council', true))) { ?>
    <div class="column-1-3 area-meta-council">
      <h5>Local Authority</h5> 

      <?php 

      $dh_la        = get_post_meta($area_id, 'dh_council', true) ?  '<li><strong>' . get_post_meta($area_id, 'dh_council', true) . '</strong>' : '';
      $dh_la_tel    = get_post_meta($area_id, 'dh_council_tel', true) ?  '<li>Tel: ' . get_post_meta($area_id, 'dh_council_tel', true) . '</li>' : '';
      $dh_la_email  = get_post_meta($area_id, 'dh_council_email', true) ?  '<li>Email: <a href="mailto:' . get_post_meta($area_id, 'dh_council_email', true) . '" target="_blank">' . get_post_meta($area_id, 'dh_council_email', true) . '</a></li>' : '';
      $dh_la_url    = get_post_meta($area_id, 'dh_council_url', true) ?  '<li>Url: <a href="' . get_post_meta($area_id, 'dh_council_url', true) . '" target="_blank">' . get_post_meta($area_id, 'dh_council_url', true) . '</a></li>' : '';

      ?>

      <ul>
       <?php echo $dh_la . $dh_la_tel . $dh_la_email . $dh_la_url; ?>
      </ul>

    </div>
    <?php } ?>
  </div>



<?php }

add_action('wp_footer', 'dh_site_gmap', 50);

function dh_site_gmap() {
    global $post;

    $pin  = get_post_meta($post->ID, 'dh_site_map', true) ? get_post_meta($post->ID, 'dh_site_map', true) : '52.4461088,-1.8269067';
    $name = get_post_meta($post->ID, 'site-name', true) ? get_post_meta($post->ID, 'site-name', true) : 'Site Name';

    $marker = get_template_directory_uri() . '/sass/images/dh-pin-available.png';

 
    echo "<script id=\"google_maps_script\"> 
        google.maps.event.addDomListener(window, 'load', init);
        var map;
        
        function init() {
          var mapOptions = {
            center: new google.maps.LatLng(" . trim($pin) . "),
            zoom: 14,
            maxZoom: 18,
            zoomControl: true,
            zoomControlOptions: {
              style: google.maps.ZoomControlStyle.SMALL,
            },
            disableDoubleClickZoom: true,
            mapTypeControl: false,
            scaleControl: true,
            scrollwheel: false,
            panControl: true,
            streetViewControl: true,
            draggable : true,
            overviewMapControl: true,
            overviewMapControlOptions: {
              opened: true,
            },
            mapTypeId: google.maps.MapTypeId.ROADMAP,
          }
          var mapElement = document.getElementById('dh_map');
          var map = new google.maps.Map(mapElement, mapOptions);
          var locations = [
            ['" . addslashes(trim($name)) . "', 'undefined', 'undefined', 'undefined', '', " . trim($pin) . ", '" . $marker . "']
          ];

          var icon = {
          url: '". $marker . "', // url
          scaledSize: new google.maps.Size(50, 50), // scaled size
          origin: new google.maps.Point(0,0), // origin
          anchor: new google.maps.Point(25, 50) // anchor
        };


            for (i = 0; i < locations.length; i++) {
          if (locations[i][1] =='undefined'){ description ='';} else { description = locations[i][1];}
          if (locations[i][2] =='undefined'){ telephone ='';} else { telephone = locations[i][2];}
          if (locations[i][3] =='undefined'){ email ='';} else { email = locations[i][3];}
               if (locations[i][4] =='undefined'){ web ='';} else { web = locations[i][4];}
               if (locations[i][7] =='undefined'){ markericon ='';} else { markericon = locations[i][7];}
                marker = new google.maps.Marker({
                    // icon: markericon,
                    icon: icon,
                    position: new google.maps.LatLng(locations[i][5], locations[i][6]),
                    map: map,
                    title: locations[i][0],
                    desc: description,
                    tel: telephone,
                    email: email,
                    web: web
                });
              link = '';     }

    }


    </script>
    <style id=\"google_map_styles\"> 
        #dh_map {height:400px; width: 100%;}
        .gm-style-iw * {display: block; width: 100%;}
        .gm-style-iw h4, .gm-style-iw p {margin: 0; padding: 0;}
        .gm-style-iw a {color: #4272db;}
        /* @media only screen and (min-width:480px) {#dh_map {width: 400px;}}
        @media only screen and (min-width:568px) {#dh_map {width: 488px;}}
        @media only screen and (min-width:768px) {#dh_map {height:300px; width: 460px;}}
        @media only screen and (min-width:1024px) {#dh_map {width: 620px;}}
        @media only screen and (min-width:1280px) {#dh_map {width: 794px;}} */
    </style>";

  }
