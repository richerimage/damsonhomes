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
$street     = get_post_meta($post->ID, 'site-street', true) ? get_post_meta($post->ID, 'site-street', true) : ''; 
$area       = get_post_meta($post->ID, 'site-area', true) ? get_post_meta($post->ID, 'site-area', true) : '';
$postcode   = get_post_meta($post->ID, 'postcode', true) ? get_post_meta($post->ID, 'postcode', true) : '';
$due_date   = get_post_meta($post->ID, 'dh_completion_date', true) ? get_post_meta($post->ID, 'dh_completion_date', true) : '';
$price_from = get_post_meta($post->ID, 'dh_price_from', true) ? get_post_meta($post->ID, 'dh_price_from', true) : '';

$site_logo_id = get_post_meta($post->ID, 'dh_site_thumb_id', true) ? get_post_meta($post->ID, 'dh_site_thumb_id', true) : ''; 
$dh_video_thumb_id = get_post_meta($post->ID, 'dh_video_thumb_id', true) ? get_post_meta($post->ID, 'dh_video_thumb_id', true) : ''; 




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
          <span class="screen-reader-text">Estimated Completion</span>
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
    </div><!-- END .site-intro.six.columns -->
    <div class="hero-right six columns">
        <?php if (!empty($dh_video_thumb_id)) {
        echo wp_get_attachment_image( $dh_video_thumb_id, 'Letterbox 16:9', '', array( 'class' => 'video_thumb' ));
      } ?>
    </div>
  </header><!-- END .page-header -->
</section>

	<section id="primary" class="content-area">
		<main id="main" class="site-main container" role="main">
    

		<?php while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', get_post_format() );

		endwhile; // End of the loop. ?>

		</main><!-- #main -->

		<?php // get_sidebar(); ?>
	</section><!-- #primary -->

<?php get_footer();