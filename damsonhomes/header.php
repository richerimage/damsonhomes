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



require get_template_directory() . '/atoms/dh_logo.php';
// require get_template_directory() . '/atoms/dh_svg.php';

$css_source = get_template_directory_uri() . '/sass/critical.css';

$css = file_get_contents($css_source); 

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<style id="critical_css"><?php echo "\n" . $css . "\n"; ?></style>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php wp_head(); ?>
</head>

<body <?php body_class('xv');?>>
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'damsonhomes' ); ?></a>
	<header id="masthead" class="header-area" role="banner">
		<div class="header page">
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
            <span class="dh-svg dh-svg-facebook icon-square-22">
              <svg class="icon-facebook" height="100%" width="100%">
                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-facebook"></use>
              </svg>
            </span>
            <span class="screen-reader-text">Facebook</span>
          </a>
        </li>
        <li class="dna_sm_twitter">
          <a href="https://twitter.com/damsonhomes/" class="icon-alone" title="Follow us on Twitter" target="_blank">
            <span class="dh-svg dh-svg-twitter icon-square-22">
        <svg class="icon-twitter" height="100%" width="100%">
          <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-twitter"></use>
        </svg>
      </span>      <span class="screen-reader-text">Twitter</span>
          </a>
        </li>
        <li class="dna_sm_instagram">
          <a href="https://instagram.com/damsonhomes/" class="icon-alone" title="Follow us on Instagram" target="_blank">
            <span class="dh-svg dh-svg-instagram icon-square-22">
        <svg class="icon-instagram" height="100%" width="100%">
          <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-instagram"></use>
        </svg>
      </span>      <span class="screen-reader-text">Instagram</span>
          </a>
        </li>
        <li class="dna_sm_telephone">
          <a href="+441217090539" class="icon-alone" title="Call us" target="_blank">
            <span class="dh-svg dh-svg-phone icon-square-22">
        <svg class="icon-phone" height="100%" width="100%">
          <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-phone"></use>
        </svg>
      </span>      <span class="screen-reader-text">0121 709 0539</span>
          </a>
        </li>
        <li class="dna_sm_login">
          <a href="http://portal.damsonhomes.net/" class="icon-alone" title="Log in to the Client Portal" target="_blank">
            <span class="dh-svg dh-svg-client icon-square-22">
        <svg class="icon-client" height="100%" width="100%">
          <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-client"></use>
        </svg>
      </span>      <span class="screen-reader-text">Client Portal</span>
          </a>
        </li>
      </ul>


		</div><!-- .header.page -->

		<nav id="site-navigation" class="nav-area" role="navigation">
      <div class="page">
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
	</header><!-- #masthead -->