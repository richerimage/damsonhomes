<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Damson_Homes
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main page" role="main">

		<?php while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', get_post_format() );

			the_post_navigation();

		endwhile; // End of the loop. ?>

		</main><!-- #main -->

		<?php // get_sidebar(); ?>
	</section><!-- #primary -->

<?php get_footer();
