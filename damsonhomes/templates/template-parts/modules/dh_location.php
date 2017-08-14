<?php

function dh_location(&$name = '', &$address = '', $area_id = '') {

global $post;

$area_intro    = get_post_meta($post->ID, 'dh_area_intro', true) ?  get_post_meta($post->ID, 'dh_area_intro', true) : '';

?>

<div class="headline-wrapper twelve columns">
  <h3 class="headline">Around <?php echo $name; ?></h3>
</div>

<?php if (!empty($area_intro)) { ?>
  <div class="area-intro twleve columns text-columns">
    <?php echo wpautop(do_shortcode($area_intro)); ?>
  </div>
<?php } ?>


<div class="map-wrap six columns xv box aside push-six">
  <h4>
    <?php echo dh_get_svg(array('icon' => 'location')); ?>
    <?php echo $name; ?> Address
  </h4>
  <?php echo $address; ?>
<div id="dh_map" class="site-map frame"></div>

<?php

$dh_distances = get_post_meta($post->ID, 'dh_distance', true) ?  get_post_meta($post->ID, 'dh_distance', true) : '';

if (!empty($dh_distances)) { ?>
  <h4>Key Distances</h4>
  <ul class="target-distances">
    <?php foreach( $dh_distances as $key => $dh_dist){
    echo '<li><span class="target">' . $dh_dist['dh_location_name'] . ' </span><span class="distance">' . $dh_dist['dh_location_distance'] . '</span></li>';
    } ?>
  </ul>

  <?php } ?>
</div>



<div class="desc-wrap six columns pull-six">

<h3 class="headline"><?php echo get_post_field('post_title', $area_id); ?></h3>
<?php 
  echo get_the_post_thumbnail( $area_id, 'letterbox-small' );
  echo wpautop(do_shortcode(get_post_field('post_content', $area_id)));
?>
  
</div>




<?php 

add_action('wp_footer', 'dh_site_gmap', 50);

function dh_site_gmap() {
    global $post;

    $pin  = get_post_meta($post->ID, 'dh_site_map', true) ? get_post_meta($post->ID, 'dh_site_map', true) : '52.4461088,-1.8269067';
    $name = get_post_meta($post->ID, 'dh_site_name', true) ? get_post_meta($post->ID, 'dh_site_name', true) : 'Site Name';

    $marker = get_template_directory_uri() . '/images/dh-pin-available.png';

 
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

}
