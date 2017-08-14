<?php


function dh_listings_map() {

  // if ((is_page_template('templates/template-listings.php')) && (!is_page('coming-soon')) ) {

  $lp = array(
    'for-sale',
    'portfolio'
    );

  if (is_page($lp)) {
  
    global $post;

    $home  = '52.4461088,-1.8269067';

    $marker = get_template_directory_uri() . '/sass/images/dh-pin-available.png';

    if (is_page('for-sale')) {
      $tax = 'live';
    } elseif (is_page('coming-soon')) {
      $tax = 'coming-soon';
    } elseif (is_page('portfolio')) {
      $tax = 'portfolio';
    } else {
      $tax = '';
    }




    $args = array(
      'orderby' => 'menu_order',
      'order'   => 'ASC',
      'dnh_site_status_taxonomy' => $tax,
      'posts_per_page' => 100
    );

    // The Query
    $query = new WP_Query( $args );

    // The Loop
    if ( $query->have_posts() ) { ?>

      <script id="google_maps_script">
        function loadMap() {
          var mapOptions = {
            center:new google.maps.LatLng(<?php echo $home; ?>), 
            zoom: 10,
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
             mapTypeId:google.maps.MapTypeId.ROADMAP
          };

          var map = new google.maps.Map(document.getElementById('dh_map'),mapOptions);

        <?php while ( $query->have_posts() ) {
          $query->the_post(); 
          $name             = get_post_meta($post->ID, 'dh_site_name', true) ? get_post_meta($post->ID, 'dh_site_name', true) : '';     
          $coords           = get_post_meta($post->ID, 'dh_site_map', true) ? get_post_meta($post->ID, 'dh_site_map', true) : '';
          $site_logo_id     = get_post_meta($post->ID, 'dh_site_logo_id', true) ? get_post_meta($post->ID, 'dh_site_logo_id', true) : ''; 
          $site_logo_array  = (!empty($site_logo_id) ? wp_get_attachment_image_src($site_logo_id, 'thumbnail') : '');
          $site_logo_src    = (!empty($site_logo_array) ? $site_logo_array[0] : get_template_directory_uri() . '/images/dh-logo-square.png'); ?>
          
          // <?php echo $name . "\n"; ?>
          var iconMarker<?php echo $post->ID; ?> = {
            url: '<?php echo $site_logo_src; ?>',
            scaledSize : new google.maps.Size(35,35)
          };
          var marker<?php echo $post->ID; ?> = new google.maps.Marker({
            position: new google.maps.LatLng(<?php echo $coords; ?>),
            map: map,
            animation:google.maps.Animation.DROP,
            icon: iconMarker<?php echo $post->ID; ?>,
          }); 
          <?php } ?>
        }
        google.maps.event.addDomListener(window, 'load', loadMap);
      </script>
      <style id="google_map_listing_styles"> 
        #dh_map {height:600px; width: 100%;}
        .gm-style-iw * {display: block; width: 100%;}
        .gm-style-iw h4, .gm-style-iw p {margin: 0; padding: 0;}
        .gm-style-iw a {color: #4272db;}
        /* @media only screen and (min-width:480px) {#dh_map {width: 400px;}}
        @media only screen and (min-width:568px) {#dh_map {width: 488px;}}
        @media only screen and (min-width:768px) {#dh_map {height:300px; width: 460px;}}
        @media only screen and (min-width:1024px) {#dh_map {width: 620px;}}
        @media only screen and (min-width:1280px) {#dh_map {width: 794px;}} */
      </style>

    <?php } else { }

    // Restore original Post Data
    wp_reset_postdata();


  } 

}


add_action('wp_footer', 'dh_listings_map', 50);
