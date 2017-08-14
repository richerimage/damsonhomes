<?php
/**
 * Template part for displaying site cards
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Damson_Homes
 */


global $post;

// WP_Query arguments
$args = array(
  'posts_per_page'         => '3',
  'order'                  => 'DESC',
  'orderby'                => 'date',
);

// The Query
$query = new WP_Query( $args );

$counter = 0;

// The Loop
if ( $query->have_posts() ) {
  while ( $query->have_posts() ) {
    $query->the_post(); 

    $counter ++; ?>
    
    <article id="post-<?php the_ID(); ?>" <?php echo post_class(array('front-card', 'clearfix', 'update-' . $counter)); ?>>
  <a class="block-link xv" href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
    <?php if ($counter === 1) { ?>

      <div class="lede-post">
        <?php if (has_post_thumbnail()) {

        echo '<figure class="featured-image">';

          the_post_thumbnail('thumbnail');

        echo '</figure>';

        } ?>

        <div class="lede-post-content aside">
          <header class="entry-header">
            <h4 class="headline ntm nbm"><?php the_title(); ?></h4>
          </header><!-- .entry-header -->
          <div class="post-excerpt aside">
           <?php the_excerpt(); ?>
          </div>
        </div>
      </div>

    <?php } else { ?>

      <h5 class="headline ntm nbm aside"><?php the_title(); ?></h5>
    <!-- .entry-header -->
    <?php } ?>
  </a>
</article><!-- #post-## -->



  <?php }

} else {
  // no posts found
}

// Restore original Post Data
wp_reset_postdata();
?>