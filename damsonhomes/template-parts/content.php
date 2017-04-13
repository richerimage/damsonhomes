<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Damson_Homes
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('card'); ?>>
	<header class="entry-header">
		<?php
		if ( is_single() ) : ?>
			<span class="title-intro">From the Blog&hellip;</span>
			<?php the_title( '<h1 class="entry-title h2 ntm">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title ntm">', '</h2>' );
		endif; ?>
	</header><!-- .entry-header -->

	<?php if ( 'post' === get_post_type() ) : ?>
	<div class="entry-meta">
		<?php damsonhomes_posted_on(); ?>
	</div><!-- .entry-meta -->
	<?php endif;


	if (has_post_thumbnail()) {

		echo '<figure class="featured-image">';

	 	the_post_thumbnail('Letterbox 16:9');

		echo '</figure>';

	}

	dh_social_share(); ?>

	<div class="entry-content">
		<?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'damsonhomes' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'damsonhomes' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php damsonhomes_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
