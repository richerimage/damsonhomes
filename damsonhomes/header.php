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

require_once get_template_directory() . '/atoms/dh_logo.php';

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-svg">
<head>
<script src="//cdnjs.cloudflare.com/ajax/libs/webfont/1.3.0/webfont.js"></script>
  <script>
    WebFont.load({
      google: { families: ['Open Sans:400,400italic,700']},
      timeout: 2000
    });
</script>
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
      'viewing'
    );

  if (is_page($load_on_page)) {
  gravity_form_enqueue_scripts( 18, true );

} 

wp_head(); ?>

</head>

<body <?php body_class('xv');?>>
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'damsonhomes' ); ?></a>
	<header id="masthead" class="header-area" role="banner">
		<div class="header container">
      <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><span class="damson">damson</span><span class="homes">homes</span></a></p>
			<div class="dna-logo-width">
				<div class="dna-logo" itemscope="" itemtype="http://schema.org/Organization/">
					<a itemprop="url" href="http://damsonhomes.net/">
						<?php dh_logo(); ?>
					</a>
				</div>
			</div>
			<ul class="dna-social-wrapper six">
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


		</div><!-- .header.page -->


    </header><!-- #masthead -->

		<nav id="site-navigation" class="nav-area" role="navigation">
      <div class="container">
        <?php wp_nav_menu( 
          array( 
            'theme_location' => 'menu-1', 
            'menu_id'     => 'primary-menu',
            'menu_class'  => 'menu primary-menu',
            'container'   => false 
          )
        ); ?>
        
        <div id="hamburger_menu" class="hamburger-menu">
          <div class="bar"></div> 
        </div>

        <?php wp_nav_menu( 
          array(
            'theme_location' => 'menu-2',
            'menu_id'     => 'main-menu',
            'menu_class'  => 'menu dna-nav',
            'container'   => false 
          )
        ); ?>
      </div> <!-- .nav-area .page -->
		</nav><!-- #site-navigation -->