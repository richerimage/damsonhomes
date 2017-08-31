<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Damson_Homes
 */

get_header(); 

global $wp;

$counter 	= 0; 

$type 	 	= 'page';

$url 			= home_url('/') . $wp->request;

?>

<?php if ( have_posts() ) : ?>

<section id="hero_area" class="hero-area bg-white hero-fly-in">
	<div class="row hero-box">
		<div class="hero-left six columns">
			<header class="headline-area">
				<?php the_archive_title( '<h1 class="headline archive-headline h2">', '</h1>' ); ?>
			</header>
				<div class="post-content archive-description">
					<?php the_archive_description(); ?>
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

			$classes = array('columns', 'card', 'card-' . $counter);

			$link_to = get_post_meta($post->ID, 'dh_link_to_url', true) ? get_post_meta($post->ID, 'dh_link_to_url', true) : get_permalink();


			/*
			 * Include the Post-Format-specific template for the content.
			 * If you want to override this in a child theme, then include a file
			 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
			 */
			
			//get_template_part( 'template-parts/content-archive', get_post_format() ); 
			?>

			<article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>
				<a class="block-link" href="<?php echo esc_url( $link_to ); ?>" rel="bookmark">
					<?php get_template_part( 'templates/template-parts/modules/card-post', get_post_format() ); ?>
				</a>
			</article><!-- #post-## -->

		<?php endwhile; 

	else :

		get_template_part( 'template-parts/content', 'none' );

	endif; ?>

	</main>

	<?php $class = 'row hide-critical'; dh_pagation($class); ?>

</section>

<?php get_footer();
