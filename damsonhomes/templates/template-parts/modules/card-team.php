<?php
/**
 * Template part for displaying site cards
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Damson_Homes
 */


global $post;


$position       = get_post_meta($post->ID, 'dnh_team_title', true) ? get_post_meta($post->ID, 'dnh_team_title', true) : ''; 




?>

<article id="post-<?php the_ID(); ?>" <?php post_class(array('card', 'card-team')); ?>>
  <a class="block-link xv" href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
    <?php if (has_post_thumbnail()) {

    echo '<figure class="featured-image text-center">';

      the_post_thumbnail('square-small'); ?>
      <div class="caption aside">
        <h4 class="nbm ntm"><?php the_title(); ?></h4>
        <p><?php echo $position; ?></p>
      </div>


    <?php echo '</figure>';

    } ?>
  </a>
</article><!-- #post-## -->