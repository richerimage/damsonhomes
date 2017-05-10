<?php
/**
 * Template part for Brochrue Link
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Damson_Homes
 */

  global $post;

  $subhead = get_post_meta($post->ID, 'dh_subhead', true) ? '<h3 id="sub_head"class="sub-head">' . get_post_meta($post->ID, 'dh_subhead', true) . '</h3>' : '';

?>

<section id="hero" class="hero-area">
  <header class="page-header container hero-box">

    <div class="site-intro-wrap">
      <img id="site_logo" class="site-logo" src="<?php echo get_template_directory_uri() . '/images/dh-logo-square.png'; ?>" height="100px" width="100px">
      <div class="headline-wrapper">
        <?php the_title( '<h1 id="headline" class="headline page-title">', '</h1>' ); ?>
        <?php echo $subhead; ?>
      </div>
    </div>

    <div id="hero_left" class="hero-left site-intro six columns">
        <div class="archive-description entry-content">
          <div id="default_content"><?php the_content(); ?></div>
      </div>
    </div><!-- END .site-intro.six.columns -->

    <div id="hero_right" class="hero-right six columns">
        <img id="ftr_image" class="wp-post-image" src="<?php echo get_the_post_thumbnail_url( $post->ID, 'large'); ?>">
      
    </div>
  </header><!-- END .page-header -->
</section>