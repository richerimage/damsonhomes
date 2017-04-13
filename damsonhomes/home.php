<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Damson_Homes
 */

get_header(); 

$counter = 0; ?>

<?php if ( have_posts() ) : ?>

<section id="hero" class="hero-area">
	<header class="page-header container hero-box">
		<h1 class="page-title">You’re reading the Damson Homes Blog&hellip;</h1>
		<div class="archive-description">
			<p>Never miss a brick being laid and be the first to hear about our new and exclusive, award-winning developments. Join fellow readers by subscribing today!</p>
		</div>
	</header><!-- .page-header -->
</section>

<section id="primary" class="content-area">
	<main id="main" class="site-main container post-results" role="main">

		<?php /* Start the Loop */ while ( have_posts() ) : the_post();

			$counter ++;

			$classes = array('card', 'card-' . $counter);

			$facebook_class 	= array('card', 'card-social', 'card-facebook');
			$twitter_class 		= array('card', 'card-social', 'card-twitter');
			$instagram_class 	= array('card', 'card-social', 'card-instagram');

			/*
			 * Include the Post-Format-specific template for the content.
			 * If you want to override this in a child theme, then include a file
			 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
			 */
			
			//get_template_part( 'template-parts/content-archive', get_post_format() ); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>
				<a class="block-link" href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
					<header class="entry-header">
						<?php the_title( '<h2 class="entry-title h5 ntm">', '</h2>' ); ?>
					</header><!-- .entry-header -->
					<?php if (has_post_thumbnail()) {

					echo '<figure class="featured-image">';

				 		the_post_thumbnail('Letterbox 16:9');

					echo '</figure>';

					} ?>

					<div class="excerpt-content aside">
						<?php the_excerpt(); ?>
						<p class="read-on">Continue Reading &rarr;</p>
					</div>

					<footer class="entry-footer">
						<div class="entry-meta">
							<?php damsonhomes_posted_on(); ?>
						</div><!-- .entry-meta -->
					</footer><!-- .entry-footer -->
				</a>
			</article><!-- #post-## -->

		<?php endwhile; ?>

			<article id="facebook_link" class="hentry card card-social card-facebook">
				<a class="block-link" href="https://facebook.com/damsonnewbuild/" target="_blank" rel="bookmark">
					<?php get_template_part( 'template-parts/modules/card-facebook', get_post_format() ); ?>
				</a>
			</article><!-- #post-## -->

			<article id="twitter_link" class="hentry card card-social card-twitter">
					<a class="block-link" href="https://twitter.com/damsonhomes/" target="_blank" rel="bookmark">
						<?php get_template_part( 'template-parts/modules/card-twitter', get_post_format() ); ?>
					</a>
				</article><!-- #post-## -->

			<article id="instagram_link" class="hentry card card-social card-instagram">
				<a class="block-link" href="https://instagram.com/damsonhomes/" target="_blank" rel="bookmark">
					<?php get_template_part( 'template-parts/modules/card-instagram', get_post_format() ); ?>
				</a>
			</article><!-- #instagram_link -->

			<article id="subscibe_link" class="hentry card card-social card-subscribe">
				<a class="block-link modal-launch" href="#0">
					<?php get_template_part( 'template-parts/modules/card-subscribe', get_post_format() ); ?>
				</a>
			</article><!-- #instagram_link -->

		<?php the_posts_navigation();

	else :

		get_template_part( 'template-parts/content', 'none' );

	endif; ?>

	</main>

</section>

<?php get_footer();
