<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Damson_Homes
 */

get_header(); 

$counter = 0; 

$type 	 = 'page';

$url     = home_url() . '/blog/';




?>

<?php if ( have_posts() ) : ?>

<section id="hero_area" class="hero-area hero-fly-in bg-white">
	<div class="row hero-box">
		<div class="hero-left six columns">
			<header class="headline-area">
				<h5 id="say_hello" class="pre-head"></h5>
				<h1 class="headline archive-headline h2">Welcome to the Damson&nbsp;Homes Blog&hellip;</h1>
			</header>
				<div class="post-content archive-description">
					<p>Never miss a brick being laid and be the first to hear about our new and exclusive, award-winning developments.
					<p>Join <span class="brand1"><strong>over 4,200</strong></span> fellow readers by <a href="/subscribe/" target="_blank">subscribing today</a>!</p>
			</div>
			<?php dh_social_share($type, $url); ?>
		</div>
	</div><!-- .page-header -->
</section>

<section id="primary" class="content-area">
	<main id="main_content" class="main-content row listings" role="main">

		<?php /* Start the Loop */ while ( have_posts() ) : the_post();

			$counter ++;

			$classes = array('columns', 'card', 'post-card', 'card-' . $counter);

			$facebook_class 	= array('columns', 'card', 'card-social', 'card-facebook');
			$twitter_class 		= array('columns', 'card', 'card-social', 'card-twitter');
			$instagram_class 	= array('columns', 'card', 'card-social', 'card-instagram');

			$link_to = get_post_meta($post->ID, 'dh_link_to_url', true) ? get_post_meta($post->ID, 'dh_link_to_url', true) : get_permalink();



			/*
			 * Include the Post-Format-specific template for the content.
			 * If you want to override this in a child theme, then include a file
			 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
			 */
			
			//get_template_part( 'template-parts/content-archive', get_post_format() ); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>

				<a class="block-link" href="<?php echo esc_url( $link_to ); ?>" rel="bookmark">

				<?php get_template_part( 'templates/template-parts/modules/card-post', get_post_format() ); ?>
				
				</a>
			</article><!-- #post-## -->

		<?php endwhile; 

					
					// $ua = htmlentities($_SERVER['HTTP_USER_AGENT'], ENT_QUOTES, 'UTF-8');
					// if (preg_match('~MSIE|Internet Explorer~i', $ua) || (strpos($ua, 'Trident/7.0; rv:11.0') !== false)) {
					// 	// do stuff for IE
					// }

?>

					<article id="facebook_link" class="hentry columns card card-social card-facebook">
						<a class="block-link" href="https://facebook.com/damsonnewbuild/" target="_blank" rel="bookmark">
							<?php get_template_part( 'templates/template-parts/modules/card-facebook', get_post_format() ); ?>
						</a>
					</article><!-- #post-## -->

					<article id="twitter_link" class="hentry columns card card-social card-twitter">
							<a class="block-link" href="https://twitter.com/damsonhomes/" target="_blank" rel="bookmark">
								<?php get_template_part( 'templates/template-parts/modules/card-twitter', get_post_format() ); ?>
							</a>
						</article><!-- #post-## -->

					<article id="instagram_link" class="hentry columns card card-social card-instagram">
						<a class="block-link" href="https://instagram.com/damsonhomes/" target="_blank" rel="bookmark">
							<?php get_template_part( 'templates/template-parts/modules/card-instagram', get_post_format() ); ?>
						</a>
					</article><!-- #instagram_link -->

					<article id="subscibe_link" class="hentry columns card card-social card-subscribe">
						<a class="block-link modal-launch" href="#0">
							<?php get_template_part( 'templates/template-parts/modules/card-subscribe', get_post_format() ); ?>
						</a>
					</article><!-- #instagram_link -->

				

		<?php 

	else :

		get_template_part( 'template-parts/content', 'none' );

	endif; ?>

	</main>

	<?php $class = 'row hide-critical'; dh_pagation($class); ?>

</section>

<?php get_footer();
