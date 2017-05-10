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
$price_from         = get_post_meta($post->ID, 'dh_price_from', true) ? get_post_meta($post->ID, 'dh_price_from', true) : '';


$ftr_img_id         = get_post_thumbnail_id();
$ftr_img            = wp_get_attachment_image_src($ftr_img_id, 'Letterbox 16:9', true);
$ftr_img_url        = $ftr_img[0];

$site_logo_id       = get_post_meta($post->ID, 'dh_site_thumb_id', true) ? get_post_meta($post->ID, 'dh_site_thumb_id', true) : ''; 
$site_logo          = wp_get_attachment_image( $site_logo_id, 'square', '', array( 'class' => 'site-logo' ));
$site_logo_src      = wp_get_attachment_image_src($site_logo_id, 'thumbnail');
$site_logo_url      = $site_logo_src['0'];

$brochure_img_id    = get_post_meta($post->ID, 'dh_site_brochure_img_id', true) ? get_post_meta($post->ID, 'dh_site_brochure_img_id', true) : ''; 
$brochure_src       = wp_get_attachment_image_src($brochure_img_id, 'Letterbox 16:9');
$brochure_url       = $brochure_src['0'];

$slug = get_permalink();

$dh_video_thumb_id  = get_post_meta($post->ID, 'dh_video_thumb_id', true) ? get_post_meta($post->ID, 'dh_video_thumb_id', true) : '';
$brochure           = get_post_meta($post->ID, 'site_brochure_link', true) ? get_post_meta($post->ID, 'site_brochure_link', true) : ''; 
$gallery            = get_post_meta($post->ID, 'dh_site_gallery', true) ? get_post_meta($post->ID, 'dh_site_gallery', true) : '';


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
  'feature_img'   => $ftr_img_url
);
 
?>


<section id="hero" class="hero-area">
  <header class="page-header container hero-box">

        <div class="site-intro-wrap">
        <?php if (!empty($site_logo_id)) {
        // echo wp_get_attachment_image( $site_logo_id, 'square', '', array( 'class' => 'site-logo' )); 
        echo $site_logo; 
      } ?>
        <div class="headline-wrapper">
          <h1 class="headline page-title"><?php echo $name; ?></h1>
          <h3 class="sub-head"><em>in</em> <?php echo $area; ?></h3>
        </div>
      </div>

    <div class="hero-left site-intro six columns">

      <ul class="site-meta">
        <li>
          <?php echo dh_get_svg(array('icon' => 'home')); ?>
          From: £<?php echo $price_from; ?></li>
        <li>
          <?php echo dh_get_svg(array('icon' => 'key')); ?>
          <span class="screen-reader-text">Estimated Completion</span> <?php echo $due_date; ?>
        </li>
        <li><a class="button cta" target="_blank" href="<?php dh_link($site_meta, $link_to['brochure']); ?>"><?php echo dh_get_svg(array('icon' => 'brochure')); ?> View Brochure</a></li>
      </ul>
      <div class="archive-description entry-content">
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
  <div class="tabgroup container aside">
    <ul class="tabs clearfix" data-tabgroup="primary">
      <li><a id="tab1_trigger" href="#tab1" class="active">Description</a></li>
      <li><a id="tab2_trigger" href="#tab2" class="">Availablity</a></li>
      <?php if (!empty($gallery)) { ?>
        <li><a id="tab3_trigger" href="#tab3" class="">Gallery</a></li>
      <?php } ?>
      <li><a id="tab4_trigger" href="#tab4" class="">Spec</a></li>
      <li><a id="tab5_trigger" href="#tab5" class="">Location</a></li>
      <li><a id="tab6_trigger" href="#tab6" class="">Updates</a></li>
      <li><a id="tab7_trigger" href="#tab7" class="">Enquire</a></li>
    </ul>
  </div>
</section>

<section class="content-area">
  <main id="primary" class="site-main container entry-content" role="main">

    <div id="tab1" class="post tab-content tab1 tab-description tab-top">
      <?php while ( have_posts() ) : the_post();
          the_content();
      endwhile; // End of the loop. ?>
    </div>

    <div id="tab2" class="tab-content tab2 tab-plots tab-bottom">

    <h2>Plot Plan &amp; Availablity</h2>
    <?php require get_template_directory() . '/inc/dh_available_plots.php';
    dh_available_plots($site_meta, $link_to); ?>

    </div>

    <?php if (!empty($gallery)) { ?>

      <div id="tab3" class="tab-content tab3 tab-gallery tab-bottom xv">

      <h2>Gallery</h2>

      <?php echo wpautop(do_shortcode($gallery)); ?>

      </div>

    <?php } ?>

    <div id="tab4" class="tab-content tab4 tab-spec tab-bottom">
      
      <?php require get_template_directory() . '/inc/dh_spec.php';
      dh_spec($name, $site_logo_id, $brochure);  ?>

    </div>
    <div id="tab5" class="tab-content tab5 tab-location tab-bottom">
      
      <?php require get_template_directory() . '/inc/dh_location.php';
      dh_location($name, $address, $area_id);  ?>

    </div>

    <div id="tab6" class="tab-content tab6 tab-updates post-results tab-bottom">
      <?php require get_template_directory() . '/inc/dh_build_updates.php';
      dh_build_updates($name, $cat_id, $site_logo_id, $brochure);  ?>
    </div>

    <div id="tab7" class="tab-content tab7 tab-enquire tab-bottom">
      <?php require get_template_directory() . '/inc/dh_enquire.php';
      dh_enquire($site_meta, $link_to);  ?>
    </div>
  </main>
  <!-- #main -->

</section>
  <section class="cta-area">
    <div class="cta-box container">
      <?php if (!empty($site_logo_id)) {
          echo wp_get_attachment_image( $site_logo_id, 'thumbnail', '', array( 'class' => 'site-logo' )); 
        } ?><p class="nbm"><a class="button cta" href="#0">View The Brochure</a></p>
    </div>
  </section>

<?php get_footer();