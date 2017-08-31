<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Damson_Homes
 */

// https://github.com/typekit/webfontloader

require_once get_template_directory() . '/inc/modules/dh_logo.php'; ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-svg">
<head>
<?php do_action('dh_head_top'); ?>
<link rel="dns-prefetch" href="//fonts.googleapis.com">
<link rel="dns-prefetch" href="//cdnjs.cloudflare.com">
<link rel="dns-prefetch" href="//www.google-analytics.com">
<link rel="dns-prefetch" href="//connect.facebook.net">
<script src="//cdnjs.cloudflare.com/ajax/libs/webfont/1.3.0/webfont.js"></script>
<script>WebFont.load({google:{families:['Open Sans:400,400italic,700']},timeout: 2000});</script>
<style id="critical_css"><?php do_action('dh_critical_css'); ?></style>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php 

  $load_on_page = array(
      'brochure', 
      'register', 
      'reserve',  
      'subscribe',
      'viewing',
      'contact',
      'badh'
    );

  if (is_page($load_on_page)) {
  gravity_form_enqueue_scripts( 18, true );

} 

wp_head(); ?>

  <link rel="apple-touch-icon" sizes="60x60" href="<?php echo get_template_directory_uri(); ?>/images/favicons/apple-touch-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_template_directory_uri(); ?>/images/favicons/apple-touch-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_template_directory_uri(); ?>/images/favicons/apple-touch-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_template_directory_uri(); ?>/images/favicons/apple-touch-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/images/favicons/apple-touch-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/images/favicons/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/images/favicons/favicon-16x16.png">
  <link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/images/favicons/manifest.json">
  <link rel="mask-icon" href="<?php echo get_template_directory_uri(); ?>/images/favicons/safari-pinned-tab.svg" color="#7b7b7b">
  <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicons/favicon.ico">
  <meta name="msapplication-TileColor" content="#f0f0f0">
  <meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/images/favicons/mstile-144x144.png">
  <meta name="msapplication-config" content="<?php echo get_template_directory_uri(); ?>/images/favicons/browserconfig.xml">
  <meta name="theme-color" content="#502c5a">
<?php do_action('dh_head_bottom'); ?>
</head>
<body <?php body_class('xv');?>>
<?php do_action('dh_body_top'); ?>
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'damsonhomes' ); ?></a>
	<header id="masthead" class="header-area" role="banner">
		<div class="header row">
      <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><span class="damson">damson</span><span class="homes">homes</span></a></p>
			<div class="dna-logo-width">
				<div class="dna-logo" itemscope="" itemtype="http://schema.org/Organization/">
					<a itemprop="url" href="http://damsonhomes.net/">
						<?php dh_logo(); ?>
					</a>
				</div>
			</div>
			<ul class="dna-social-wrapper clearfix hide-critical">
        <li class="dna_sm_facebook">
          <a href="https://facebook.com/damsonnewbuild/" class="icon-alone" title="Like us on Facebook" target="_blank">
            <?php echo dh_get_svg(array('icon' => 'facebook')); ?>
          </a>
        </li>
        <li class="dna_sm_twitter">
          <a href="https://twitter.com/damsonhomes/" class="icon-alone" title="Follow us on Twitter" target="_blank">
            <?php echo dh_get_svg(array('icon' => 'twitter')); ?>
          </a>
          </a>
        </li>
        <li class="dna_sm_instagram">
          <a href="https://instagram.com/damsonhomes/" class="icon-alone" title="Follow us on Instagram" target="_blank">
            <?php echo dh_get_svg(array('icon' => 'instagram')); ?>
          </a>
        </li>
        <li class="dna_sm_telephone">
          <a href="+441217090539" class="icon-alone" title="Call us" target="_blank">
            <?php echo dh_get_svg(array('icon' => 'phone')); ?>
            <span class="screen-reader-text mobile-hide">0121 709 0539</span>
          </a>
          </a>
        </li>
        <li class="dna_sm_login">
          <a href="http://portal.damsonhomes.net/" class="icon-alone" title="Log in to the Client Portal" target="_blank">
            <?php echo dh_get_svg(array('icon' => 'client')); ?>
          </a>
        </li>
      </ul>


		</div><!-- .header.row -->


    </header><!-- #masthead -->

		<section id="main_nav" class="nav-area" role="navigation">
      <nav class="nav-box row">
        <?php wp_nav_menu( 
          array( 
            'theme_location'  => 'menu-1', 
            'menu_id'         => 'primary-menu',
            'menu_class'      => 'menu primary-menu',
            'item_spacing'    => 'discard',
            'container'       => false 
          )
        ); 

        wp_nav_menu( 
          array(
            'theme_location'  => 'menu-2',
            'menu_id'         => 'main-menu',
            'menu_class'      => 'menu dna-nav',
            'item_spacing'    => 'discard',
            'container'       => false 
          )
        ); ?>
      </nav> <!-- .nav-area .row -->

      <div id="fly_out_menu" class="fly-out-menu">
        <p style="text-align: right;"><a href="#" id="close_fly_out" class="close-fly-out">&times;</a></p>
        <?php wp_nav_menu( 
          array(
            'theme_location'  => 'menu-3',
            'menu_id'         => 'side_menu',
            'menu_class'      => 'menu side-menu',
            'item_spacing'    => 'discard',
            'container'       => false 
          )
        ); ?>
      </div>
		</section><!-- #site-navigation -->

    <?php do_action('dh_after_header'); ?>