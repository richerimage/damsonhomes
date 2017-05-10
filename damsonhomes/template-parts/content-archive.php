<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Damson_Homes
 */




 $classes = array('card', 'card-' . $counter);

 ?>

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

		<div class="entry-header aside">
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
