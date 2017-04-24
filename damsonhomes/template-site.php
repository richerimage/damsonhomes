<?php 

/*
 * 
 * Template Name: New Homes Site
 * 
 *
 * 
 */

get_header(); 

$name       = get_post_meta($post->ID, 'site-name', true) ? get_post_meta($post->ID, 'site-name', true) : ''; 
$intro      = get_post_meta($post->ID, 'intro', true) ? get_post_meta($post->ID, 'intro', true) : '';
$number     = get_post_meta($post->ID, 'site-number', true) ? get_post_meta($post->ID, 'site-number', true) : ''; 
$street     = get_post_meta($post->ID, 'site-street', true) ? get_post_meta($post->ID, 'site-street', true) : ''; 
$area       = get_post_meta($post->ID, 'site-area', true) ? get_post_meta($post->ID, 'site-area', true) : '';
$town       = get_post_meta($post->ID, 'site-town', true) ? get_post_meta($post->ID, 'site-town', true) : '';
$postcode   = get_post_meta($post->ID, 'postcode', true) ? get_post_meta($post->ID, 'postcode', true) : '';

$address =

'<div class="site-address">' .
(!empty ($number) ? '<span class="number">' . $number . '</span>' : '' ) .
(!empty ($street) ? '<span class="street">' . $street . '</span>' : '' ) .
(!empty ($area) ? '<span class="area">' . $area . '</span>' : '' ) .
(!empty ($town) ? '<span class="town">' . $town . '</span>' : '' ) .
(!empty ($postcode) ? '<span class="postcode">' . $postcode . '</span>' : '' ) .
'</div>';

$area_id = get_post_meta($post->ID, 'dh_area_info', true) ? get_post_meta($post->ID, 'dh_area_info', true) : '';
$cat_id  = get_post_meta($post->ID, 'dh_category', true) ? get_post_meta($post->ID, 'dh_category', true) : '';



$due_date   = get_post_meta($post->ID, 'dh_completion_date', true) ? get_post_meta($post->ID, 'dh_completion_date', true) : '';
$price_from = get_post_meta($post->ID, 'dh_price_from', true) ? get_post_meta($post->ID, 'dh_price_from', true) : '';

$site_logo_id       = get_post_meta($post->ID, 'dh_site_thumb_id', true) ? get_post_meta($post->ID, 'dh_site_thumb_id', true) : ''; 
$dh_video_thumb_id  = get_post_meta($post->ID, 'dh_video_thumb_id', true) ? get_post_meta($post->ID, 'dh_video_thumb_id', true) : '';
$brochure           = get_post_meta($post->ID, 'site_brochure_link', true) ? get_post_meta($post->ID, 'site_brochure_link', true) : ''; 
 
?>


<section id="hero" class="hero-area">
  <header class="page-header container hero-box">

        <div class="site-intro-wrap">
        <?php if (!empty($site_logo_id)) {
        echo wp_get_attachment_image( $site_logo_id, 'square', '', array( 'class' => 'site-logo' )); 
      } ?>
        <div class="headline-wrapper">
          <h1 class="headline page-title"><?php echo $name; ?></h1>
          <h3 class="sub-head"><em>in</em> <?php echo $area; ?></h3>
        </div>
      </div>

    <div class="hero-left site-intro six columns">

      <ul class="site-meta">
        <li>
          <span class="dh-svg dh-svg-home icon-home-22">
            <svg class="icon-home" height="100%" width="100%">
              <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-home"></use>
            </svg>
          </span>
          <span class="screen-reader-text">Values from</span>
          From: £<?php echo $price_from; ?></li>
        <li>
          <span class="dh-svg dh-svg-key icon-key-22">
            <svg class="icon-key" height="100%" width="100%">
              <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-key"></use>
            </svg>
          </span>
          <span class="screen-reader-text">Estimated Completion</span> <?php echo $due_date; ?>
        </li>
        <li><a class="button cta" href="#0">View Brochure</a></li>
      </ul>
      <div class="archive-description">
          <p class="intro"><?php echo $intro; ?></p>
      </div>
      <?php $type = 'Site&hellip;'; dh_social_share($type); ?>
    </div><!-- END .site-intro.six.columns -->
    <div class="hero-right six columns">
        <?php if (!empty($dh_video_thumb_id)) {
        echo wp_get_attachment_image( $dh_video_thumb_id, 'Letterbox 16:9', '', array( 'class' => 'video_thumb' ));
      } ?>
    </div>
  </header><!-- END .page-header -->
</section>



<section class="ftr-nav-area">
  <div class="tabgroup container">
    <ul class="tabs clearfix" data-tabgroup="primary">
      <li><a id="tab1_trigger" href="#tab1" class="active">Description</a></li>
      <li><a id="tab2_trigger" href="#tab2" class="">Availablity</a></li>
      <li><a id="tab3_trigger" href="#tab3" class="">Spec</a></li>
      <li><a id="tab4_trigger" href="#tab4" class="">Location</a></li>
      <li><a id="tab5_trigger" href="#tab5" class="">Updates</a></li>
    </ul>
  </div>
</section>

<section class="content-area">
  <main id="primary" class="site-main container" role="main">

    <div id="tab1" class="hentry card tab-content tab1 tab-description tab-top">
      <?php while ( have_posts() ) : the_post();
          the_content();
      endwhile; // End of the loop. ?>
    </div>
    <div id="tab2" class="tab-content tab2 tab-plots tab-bottom xv">

    <?php require get_template_directory() . '/inc/dh_available_plots.php';
    dh_available_plots(); ?>

    </div>
    <div id="tab3" class="tab-content tab3 tab-spec tab-bottom">
      
      <?php require get_template_directory() . '/inc/dh_spec.php';
      dh_spec($name, $site_logo_id, $brochure);  ?>

    </div>
    <div id="tab4" class="tab-content tab4 tab-location tab-bottom">
      
      <?php require get_template_directory() . '/inc/dh_location.php';
      dh_location($name, $address, $area_id);  ?>

    </div>

    <div id="tab5" class="tab-content tab4 tab-updates post-results tab-bottom">
      <?php require get_template_directory() . '/inc/dh_build_updates.php';
      dh_build_updates($name, $cat_id, $site_logo_id, $brochure);  ?>
    </div>

  </main>
  <!-- #main -->

<section class="cta-area">
  <div class="cta-box container">
    <?php if (!empty($site_logo_id)) {
        echo wp_get_attachment_image( $site_logo_id, 'thumbnail', '', array( 'class' => 'site-logo' )); 
      } ?><p class="nbm"><a class="button cta" href="#0">View The Brochure</a></p>
  </div>
</section>
<?php get_footer();