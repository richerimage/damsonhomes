<?php 

/*
 * 
 * Template Name: New Homes Site
 * 
 *
 * 
 */

get_header();

$name       = get_post_meta($post->ID, 'dh_site_name', true) ? get_post_meta($post->ID, 'dh_site_name', true) : ''; 
$intro      = get_post_meta($post->ID, 'intro', true) ? get_post_meta($post->ID, 'intro', true) : '';
$number     = get_post_meta($post->ID, 'site-number', true) ? get_post_meta($post->ID, 'site-number', true) : ''; 
$street     = get_post_meta($post->ID, 'site-street', true) ? get_post_meta($post->ID, 'site-street', true) : ''; 
$area       = get_post_meta($post->ID, 'site-area', true) ? get_post_meta($post->ID, 'site-area', true) : '';
$town       = get_post_meta($post->ID, 'site-town', true) ? get_post_meta($post->ID, 'site-town', true) : '';
$postcode   = get_post_meta($post->ID, 'postcode', true) ? get_post_meta($post->ID, 'postcode', true) : '';

$address =

'<p class="site-address">' .
(!empty ($number) ? '<span class="number">' . $number . '</span>' : '' ) .
(!empty ($street) ? '<span class="street">' . $street . '</span>' : '' ) .
(!empty ($area) ? '<span class="area">' . $area . '</span>' : '' ) .
(!empty ($town) ? '<span class="town">' . $town . '</span>' : '' ) .
(!empty ($postcode) ? '<span class="postcode">' . $postcode . '</span>' : '' ) .
'</p>';

$area_id            = get_post_meta($post->ID, 'dh_area_info', true) ? get_post_meta($post->ID, 'dh_area_info', true) : '';
$cat_id             = get_post_meta($post->ID, 'dh_category', true) ? get_post_meta($post->ID, 'dh_category', true) : '';
$due_date           = get_post_meta($post->ID, 'dh_completion_date', true) ? get_post_meta($post->ID, 'dh_completion_date', true) : '';
$build_time         = get_post_meta($post->ID, 'dh_build_time', true) ? get_post_meta($post->ID, 'dh_build_time', true) : '';
$price_from         = get_post_meta($post->ID, 'dh_price_from', true) ? get_post_meta($post->ID, 'dh_price_from', true) : '';
$flash              = get_post_meta($post->ID, 'dh_flash', true) ? get_post_meta($post->ID, 'dh_flash', true) : ''; 


$ftr_img_id         = get_post_thumbnail_id();
$ftr_img            = wp_get_attachment_image_src($ftr_img_id, 'Letterbox 16:9', true);
$ftr_img_url        = $ftr_img[0];

$site_logo_id       = get_post_meta($post->ID, 'dh_site_logo_id', true) ? get_post_meta($post->ID, 'dh_site_logo_id', true) : ''; 
$site_logo          = wp_get_attachment_image( $site_logo_id, 'square-small', '', array( 'class' => 'site-logo' ));
$site_logo_src      = wp_get_attachment_image_src($site_logo_id, 'thumbnail');
$site_logo_url      = $site_logo_src['0'];

$brochure_img_id    = get_post_meta($post->ID, 'dh_site_brochure_img_id', true) ? get_post_meta($post->ID, 'dh_site_brochure_img_id', true) : ''; 
$brochure_src       = wp_get_attachment_image_src($brochure_img_id, 'Letterbox 16:9');
$brochure_url       = $brochure_src['0'];

$slug = get_permalink();

$dh_video_still_id  = get_post_meta($post->ID, 'dh_video_still_id', true) ? get_post_meta($post->ID, 'dh_video_still_id', true) : '';
$videoID            = get_post_meta($post->ID, 'dh_video', true) ? get_post_meta($post->ID, 'dh_video', true) : '63773282';
    
$brochure           = get_post_meta($post->ID, 'site_brochure_link', true) ? get_post_meta($post->ID, 'site_brochure_link', true) : ''; 
$gallery            = get_post_meta($post->ID, 'dh_site_gallery', true) ? get_post_meta($post->ID, 'dh_site_gallery', true) : '';

if( has_term( 'live', 'dnh_site_status_taxonomy' ) ) {
  $status = 'live';
} elseif ( has_term( 'coming-soon', 'dnh_site_status_taxonomy' ) ) {
  $status = 'coming_soon';
} elseif ( has_term( 'portfolio', 'dnh_site_status_taxonomy' ) ) {
  $status = 'portfolio';
} else {
  $status = '';
}


$link_to = array (
  'brochure'  => 'brochure', 
  'register'  => 'register', 
  'reserve'   => 'reserve',  
  'subscribe' => 'subscribe',
  'viewing'   => 'viewing'  
);

$site_meta = array(
  'name'          => $name, 
  'logo'          => $site_logo_url, 
  'brochure'      => $brochure, 
  'source'        => $slug, 
  'brochure_img'  => $brochure_url,
  'feature_img'   => $ftr_img_url,
  'status'        => $status
);

  

if ($status == 'live') {
  $button_text = dh_get_svg(array('icon' => 'brochure')) . '<span class="button-text">View Brochure</span>';
  $button_link = $link_to['brochure'];
  $badge = (!empty($flash) ? '<span class="badge badge-live hide-critical">' . $flash . '</span>' : '');
} elseif ($status == 'coming_soon') {
  $button_text = 'Register For Pre-Release Details';
  $button_link = $link_to['register'];
  $badge       = '<span class="badge badge-coming-soon hide-critical">' . (!empty($flash) ? $flash : 'Coming Soon') . '</span>';
} else {
  $button_text = 'Subscribe for Upcoming Sites';
  $button_link = $link_to['subscribe'];
  $badge       = '<span class="badge badge-sold-out hide-critical">' . (!empty($flash) ? $flash : 'Sold Out') . '</span>';
}


 
?>


<section id="hero_area" class="hero-area site-hero">
  <header class="page-header row hero-box">

        <div class="site-intro-wrap">
        <?php if (!empty($site_logo_id)) {
        // echo wp_get_attachment_image( $site_logo_id, 'square', '', array( 'class' => 'site-logo' )); 
        echo $site_logo;
      } ?>
        <div class="headline-area">
          <h1 class="headline h2"><?php echo $name; ?></h1>
          <h3 class="sub-head h4"><em>in</em> <?php echo $area; ?></h3>
        </div>
      </div>

    <div class="hero-left site-intro six columns">

      <?php echo $badge; ?>
      <ul class="site-meta entry-meta no-style hide-critical">
        <?php if ($status == 'coming_soon') {
          echo (!empty($due_date) ? '<li>' . dh_get_svg(array('icon' => 'folder-open')). ' ' . $due_date . '</li>' : '');
        } elseif ($status == 'live') {
          echo (!empty($price_from) ? '<li>' . dh_get_svg(array('icon' => 'home')). ' <strong>From: £' . $price_from . '</strong></li>' : '');
        } elseif ($status == 'portfolio') {
          echo (!empty($build_time) ? '<li>' . dh_get_svg(array('icon' => 'build')). ' ' . $build_time . '</li>' : '');
        } else {}

        if ($status == 'live') {
          echo (!empty($due_date) ? '<li>' . dh_get_svg(array('icon' => 'key')) . ' <span class="screen-reader-text">Estimated Completion</span>' . $due_date . '</li>' : '');
        } elseif ($status == 'portfolio') {
          echo (!empty($due_date) ? '<li>' . dh_get_svg(array('icon' => 'key')) . ' <span class="screen-reader-text">Completed in</span>' . $due_date . '</li>' : '');
        } else {} ?>  
        <li><a class="button cta" target="_blank" href="<?php dh_link($site_meta, $button_link); ?>"><?php echo $button_text; ?></a></li>
      </ul>
      <div class="archive-description post-content">
          <p><?php echo $intro; ?></p>
      </div>
      <?php $type = 'Site&hellip;'; dh_social_share($type); ?>
    </div><!-- END .site-intro.six.columns -->
    <div class="hero-right six columns">
    <?php if (!empty($dh_video_still_id)) {
      echo '<a class="video-thumb" data-fancybox="video" href="https://player.vimeo.com/video/' . $videoID . '?autoplay=1" width="500" height="281" frameborder="0""><span class="play-button">' . dh_get_svg(array('icon' => 'play')) . '</span>' . wp_get_attachment_image( $dh_video_still_id, 'letterbox-medium', '', array( 'class' => 'video_thumb' )) . '</a>';
    } elseif (has_post_thumbnail()) { 
        the_post_thumbnail('letterbox-medium');
    } else {
      echo '<img class="wp-post-image nbm" src="' . get_template_directory_uri() . '/images/coming-soon.jpg' . '" width="900" height="506">';
    } ?>
    </div>
    <div id="on_momma" class="hero-footer twelve columns text-center"></div>
  </header><!-- END .page-header -->
</section>

<?php 


  $tab_desc     = '<li><a id="tab1_trigger" href="#tab1" class="active">Description</a></li>';
  $tab_avail    = ($status == 'live') ? '<li><a id="tab2_trigger" href="#tab2" class="">Availability</a></li>' : '';
  $tab_gallery  = !empty($gallery) ? '<li><a id="tab3_trigger" href="#tab3" class="">Gallery</a></li>' : '';
  $tab_spec     = ($status == 'live') ? '<li><a id="tab4_trigger" href="#tab4" class="">Spec</a></li>' : '';
  $tab_location = ($status != 'coming_soon') ? '<li><a id="tab5_trigger" href="#tab5" class="">Location</a></li>' : '';
  $tab_updates  = '<li><a id="tab6_trigger" href="#tab6" class="">Updates</a></li>';
  $tab_enquire  = ($status == 'live') ? '<li><a id="tab7_trigger" href="#tab7" class="">Enquire</a></li>' : '';

  if (($status != 'coming_soon') || ( is_user_logged_in() )) { ?>

    <section class="ftr-nav-area">
      <div class="tabgroup row aside">
        <ul class="tabs clearfix" data-tabgroup="primary">
          <?php echo $tab_desc . $tab_avail . $tab_gallery . $tab_spec . $tab_location . $tab_updates . $tab_enquire; ?>
        </ul>
      </div>
    </section>

    <section class="content-area bg-white">
      <main id="primary" class="site-main row" role="main">

        <div id="tab1" class="post-content tab-content tab1 tab-description tab-top ten columns centered">
          <?php while ( have_posts() ) : the_post();
              the_content();
          endwhile; // End of the loop. ?>
        </div>

        <?php if ($status == 'live') { ?>

        <div id="tab2" class="tab-content tab2 tab-plots tab-bottom clearfix">
          <?php require get_template_directory() . '/templates/template-parts/modules/dh_available_plots.php';
          dh_available_plots($site_meta, $link_to); ?>
        </div>

        <?php }

        if (!empty($gallery)) { ?>

          <div id="tab3" class="tab-content tab3 tab-gallery tab-bottom ten columns centered">
            <div class="headline-wrapper">
              <h2>Gallery</h2>
            </div>
            <?php echo wpautop(do_shortcode($gallery)); ?>
          </div>

        <?php }

        if ($status == 'live') { ?>

        <div id="tab4" class="tab-content tab4 tab-spec tab-bottom ten columns centered">
          <div class="headline-wrapper">
            <h2>Our 5 &times; Award Winning Signature Specification</h2>
          </div>
          <?php require get_template_directory() . '/templates/template-parts/modules/dh_spec.php';
          dh_spec($site_meta, $button_link);  
          // dh_spec($name, $site_logo_id, $brochure);  
          ?>
        </div>

        <?php } ?>

        <div id="tab5" class="tab-content tab5 tab-location tab-bottom clearfix">
          <?php require get_template_directory() . '/templates/template-parts/modules/dh_location.php';
          dh_location($name, $address, $area_id);  ?>
        </div>

        <div id="tab6" class="tab-content tab6 tab-updates post-results tab-bottom clearfix listings">
          <?php require get_template_directory() . '/templates/template-parts/modules/dh_build_updates.php';
          dh_build_updates($name, $cat_id, $site_logo_id, $brochure);  ?>
        </div>

        <?php if ($status == 'live') { ?>

        <div id="tab7" class="tab-content tab7 tab-enquire tab-bottom clearfix">
          <?php require get_template_directory() . '/templates/template-parts/modules/dh_enquire.php';
          dh_enquire($site_meta, $link_to);  ?>
        </div>

        <?php } ?>

      </main>

    </section>

  <?php } // End of live and portfolio conditional ?>
  <section class="cta-area">
    <div class="cta-box row">
      <?php // if (!empty($site_logo_id)) {
          // echo wp_get_attachment_image( $site_logo_id, 'thumbnail', '', array( 'class' => 'site-logo' )); 
        // } ?>
    </div>
  </section>

<?php get_footer();