<?php


add_action('dh_custom_template', 'dh_conversion_content');

function dh_conversion_content() {

  $pages = array(
    'brochure', 
    'register', 
    'reserve',  
    'subscribe',
    'viewing',
    'badh'
  );


  if (is_page('brochure')) {
    $form_id = '18';
  } elseif (is_page('register')) {
    $form_id = '21';
  } elseif (is_page('reserve')) {
    $form_id = '20';
  } elseif (is_page('viewing')) {
    $form_id = '19';
  } else {
    $form_id = '';
  }

  if(is_page($pages)) { 

    global $post;

    $subhead = get_post_meta($post->ID, 'dh_subhead', true) ? '<h3 id="sub_head"class="sub-head">' . get_post_meta($post->ID, 'dh_subhead', true) . '</h3>' : '';

    ?>


  <?php get_header(); ?>
  <section id="hero_area" class="hero-area site-hero conversion-hero bg-white">
    <header class="page-header row hero-box">

      <div class="site-intro-wrap twelve columns">
        <img id="site_logo" class="site-logo" src="<?php echo get_template_directory_uri() . '/images/dh-logo-square.png'; ?>" height="100px" width="100px">
        <div class="headline-area">
          <?php the_title( '<h1 id="headline" class="headline h2">', '</h1>' );
            echo $subhead; ?>
        </div>
      </div>

      <div id="hero_left" class="hero-left site-intro six columns">
        <div class="archive-description entry-content">

          <?php if (!is_page('subscribe')) { ?>
            <div id="dl_form" class="dl-form" style="display: none;"><?php echo do_shortcode('[gravityform id="' . $form_id . '" title="false" description="false"]'); ?></div>
          <?php } 

          if ( have_posts() ) { while ( have_posts() ) {  the_post(); ?>

          <div id="default_content"><?php the_content(); ?></div>

          <?php } } else {} ?>

        </div>
      </div><!-- END .site-intro.six.columns -->

      <div id="hero_right" class="hero-right six columns">
        <img id="ftr_image" class="wp-post-image" src="<?php echo get_the_post_thumbnail_url( $post->ID, 'letterbox-medium'); ?>">
      </div>
    </header><!-- END .page-header -->
  </section>     
  <?php get_footer(); 

  } 

}

add_action( 'dh_critical_css', 'dh_load_critical_conversion_css', 5);

function dh_load_critical_conversion_css() {

  $pages = array(
    'brochure', 
    'register', 
    'reserve',  
    'subscribe',
    'viewing',
    'badh'
  );

  if(is_page($pages)) { 

    $crit_path        = get_template_directory_uri() . '/styles/critical-';
    $css_site_source  = $crit_path . 'site.css';
    $css_crit_site    = file_get_contents($css_site_source); 

    echo "\n" . $css_crit_site . dh_append_crit_convestion_css();

  }

}


function dh_append_crit_convestion_css() {

  echo "\n/* dh_append_crit_convestion_css */\n".
       "@media only screen and (min-width: 768px) {\n".
       "  .hero-box {display: flex; flex-wrap: wrap; align-items: center;}}\n";

}



add_action('wp_footer', 'dh_brochure_link_script', 50);

function dh_brochure_link_script() {

  // Brochure Link 

  // https://css-tricks.com/snippets/javascript/get-url-variables/ 

  $pages = array(
    'brochure', 
    'register', 
    'reserve',  
    'subscribe',
    'viewing'
  );


  if (is_page($pages)){ ?>

    <script id="dh_brochure_link_script">
    
      jQuery(document).ready(function($) {

        function getQueryVariable(variable) {
          var query = window.location.search.substring(1);
          var vars = query.split("&");
          for (var i=0;i<vars.length;i++) {
            var pair = vars[i].split("=");
            if(pair[0] == variable){return pair[1];}
           }
         return(false);
        }

        var type      = decodeURIComponent(getQueryVariable('dh_type'));
        var option    = decodeURIComponent(getQueryVariable('dh_option'));
        var name      = decodeURIComponent(getQueryVariable('dh_site_name'));
        var thumb     = decodeURIComponent(getQueryVariable('dh_logo'));
        var link      = decodeURIComponent(getQueryVariable('dh_link'));
        var source    = decodeURIComponent(getQueryVariable('dh_source'));
        var image     = decodeURIComponent(getQueryVariable('dh_image'));
        var plot      = decodeURIComponent(getQueryVariable('dh_plot_no'));
        var val       = decodeURIComponent(getQueryVariable('dh_plot_val'));
        var desc      = decodeURIComponent(getQueryVariable('dh_plot_desc'));




        if (type !== 'false') {

          $('#dl_form').show();
          // $('#default_content').remove();
          $('.gform_confirmation_wrapper').addClass('xv box');


          if (type == 'brochure') {

            $('#sub_head').html('<em>The</em> ' + name + ' Brochure');
            $('#default_content').hide();

          } 

          if (type == 'viewing') {

            $('#sub_head').html('<em>at</em> ' + name);
            $('#default_content').hide();

          }

          if (type == 'reserve') {

            $('#sub_head').html('<em>for</em> Plot ' + plot + ', ' + name);
            $('#default_content').hide();
            $('#plot_details').html('<p><strong>Plot ' + plot + '</strong> £' + val + '<br /> ' + desc + '</p>').addClass('call-out');
            $('.gform_footer').append('<div class="aside" style="color: #222; margin-top: 1em;"><p>Making a Reservation Request is free of charge and without any obligation to proceed to purchase.</p></div>');

          }

          if (type == 'register') {

            $('#sub_head').html('<em>in</em> ' + name);
            $('#default_content').hide();
            $('.gform_footer').append('<div class="aside" style="color: #222; margin-top: 1em;"><p>Registering your interest is free of charge and without any obligation to proceed to purchase.</p></div>');

            if(option == 'dh_reserve_buyer') {

              $('#site_intro_wrap').append('<div class="alert"><h4 class="ntm">Please let us know if you missed out on your favourite plot in ' + name + '.</h4><p>Drop in your contact details below and should the sale, for any reason, not go through, we will contact you before offering it out to the open market.</p></div>');
              $('#default_content').hide();


            } else {

              $('#site_intro_wrap').append('<div class="alert box xv"><h4 class="ntm">Interested in our upcoming new home development, ' + name + '?</h4><p>Subscribe for pre-release information and opportunities by entering your name and email into the form below.</p><p><strong>Subscribing is the smartest way to get your choice of the best plots!</strong> As with our other developments, we will be contacting our subscribers before offering ' + name + ' to the open market.</p></div>');

            }


          }


          if (thumb !== 'false') {

            $('#site_logo').attr('src', thumb);

          } 


          if (image !== 'false') {

            $('.wp-post-image').attr('src', image);

          }

        }


      });

    </script>

 <?php }

}
