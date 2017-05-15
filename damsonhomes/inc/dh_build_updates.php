<?php

function dh_build_updates(&$name = '', &$cat_id = '', &$site_logo_id = '', &$brochure = '') {

  global $post;

  $counter = 0; 

  $args = array(
    'cat' => $cat_id,
  );

  // The Query
  $query = new WP_Query( $args );

  // The Loop
  if ( $query->have_posts() ) { ?>

    <?php while ( $query->have_posts() ) {
      
      $query->the_post();

      $counter ++;

        $classes = array('card', 'card-' . $counter); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>
          <a class="block-link xv" href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
            <header class="entry-header">
              <?php the_title( '<h2 class="entry-title h5 ntm">', '</h2>' ); ?>
            </header>
            <?php if (has_post_thumbnail()) {

            echo '<figure class="featured-image">';

              the_post_thumbnail('Letterbox 16:9');

            echo '</figure>';

            } ?>

            <div class="excerpt-content aside">
              <?php the_excerpt(); ?>
              <p class="read-on">Continue Reading &rarr;</p>
            </div>

            <footer class="entry-footer aside">
              <div class="entry-meta">
                <?php damsonhomes_posted_on(); ?>
              </div><!-- .entry-meta -->
            </footer><!-- .entry-footer -->
          </a>
        </article><!-- #post-## -->

    <?php } ?>


  <?php } else {

    get_template_part( 'template-parts/content', 'none' );
  }

  // Restore original Post Data
  wp_reset_postdata();

}
