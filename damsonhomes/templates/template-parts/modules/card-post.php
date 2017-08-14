<?php
/**
 * Template part for displaying post cards
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Damson_Homes
 */

global $post;

?>

<header class="headline-area">
  <?php the_title( '<h2 class="headline h4 ntm">', '</h2>' ); ?>
</header>

<?php if (has_post_thumbnail()) {
  echo '<figure class="featured-image">';
    the_post_thumbnail('letterbox-small');
  echo '</figure>';

} ?>

<div class="post-content aside">
  <?php the_excerpt(); ?>
</div>

<footer class="card-footer entry-footer aside aux hide-critical">
  <?php $last = 'Continue Reading &rarr;'; damsonhomes_posted_on($last); ?>
</footer>
