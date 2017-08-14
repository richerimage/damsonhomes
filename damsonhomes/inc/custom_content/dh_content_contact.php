<?php


add_action('dh_custom_template', 'dh_contact_content');

function dh_contact_content() {

if(is_page('contact')) { 

  global $post;

  $prehead    = get_post_meta($post->ID, 'dh_prehead', true) ? '<h5 id="#say_hello" class="pre-head">' . get_post_meta($post->ID, 'dh_prehead', true) . '</h5>' : '';
  $subhead    = get_post_meta($post->ID, 'dh_subhead', true) ? '<h3 class="sub-head">' . get_post_meta($post->ID, 'dh_subhead', true) . '</h3>' : '';

    get_header() ?>

    <section id="hero_area" class="hero-area hero-fly-in">
      <div class="row hero-box">
        <div class="hero-left six columns">
          <header class="headline-area">
            <?php echo $prehead;
            the_title( '<h1 class="headline archive-headline h2">', '</h1>' );
            echo $subhead; ?>
          </header>
            <?php if ( have_posts() ) { while ( have_posts() ) { the_post(); ?>
              <div class="post-content archive-description">
                <?php the_content(); ?>
            </div>
            <?php } } else {} ?>
        </div>
      </div>
    </section>
    <?php do_action('dh_before_main_content'); ?>



    <section class="content-area bg-white">
      <main id="primary" class="site-main row" role="main">

        <div class="six columns">
          <?php echo do_shortcode('[gravityform id="7" name="Contact Page Form" title="false" description="false"]'); ?>
        </div>

        <div class="six columns">

          <?php require get_template_directory() . '/templates/template-parts/modules/dh_address.php';
          dh_address(); ?>

          <div id="dh_map" class="site-map frame"></div>


        </div>


      </main>

    </section>

    <? get_footer();

  } 

}

add_action('wp_footer', 'dh_address_gmap', 50);

function dh_address_gmap() {

  if(is_page('contact')) {

    global $post;

    $pin  = '52.4461088,-1.8269067';
    $name = 'Damson Homes';

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




