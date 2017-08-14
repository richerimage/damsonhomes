<?php

function dh_build_updates(&$name = '', &$cat_id = '', &$site_logo_id = '', &$brochure = '') {

global $post;

$counter = 0; 

$args = array(
  'cat' => $cat_id,
  'posts_per_page' => '-1'
);

// The Query
$query = new WP_Query( $args ); 

?>


<div class="headline-wrapper twelve columns">
  <h2 class="headline">Build updates from <?php echo $name; ?></h2>
</div>


<?php // The Loop
if ( $query->have_posts() ) { ?>

<div class="listings clearfix">

  <?php while ( $query->have_posts() ) {
    
    $query->the_post();

    $counter ++;

    $classes = array('columns', 'card', 'post-card', 'card-' . $counter); ?>


      <article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>
        <a class="block-link xv" href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
          
          <?php get_template_part( 'templates/template-parts/modules/card-post', get_post_format() ); ?>

        </a>
      </article><!-- #post-## -->

  <?php } ?>

</div>

<?php } else { ?>

  <div class="eight columns centered">
    <p>No updates just yet, expect this to change in the next few days</p>
  </div>

<?php }

  // Restore original Post Data
  wp_reset_postdata();

}
