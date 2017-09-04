<?php
/**
 * Template part for displaying post cards
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Damson_Homes
 */

global $post;

if (has_post_format('link')) {
  $post_icon = 'chain';
} elseif (is_sticky()) {
  $post_icon = 'thumb-tack';
} else {
  $post_icon = '';
}

?>

<header class="headline-area">
  <?php the_title( '<h2 class="headline h4 ntm">', '</h2>' ); 

  if (!empty($post_icon)) {
    echo dh_get_svg(array('icon' => $post_icon));
  } ?>
</header>

<?php if (has_post_thumbnail()) {
  echo '<figure class="featured-image">';
        $img_id     = get_post_thumbnail_id();
        $slide_att  = wp_get_attachment_image_src($img_id, 'letterbox-small');
        $base64     = 'data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==';
        $gif        = get_template_directory_uri() . '/images/holding.gif';
        
        // $slide_src = $slide_att[0];
        // $slide_wth = $slide_att[1];
        // $slide_hgt = $slide_att[2];

        // var_dump($slide_att[0]);

        echo '<img class="b-lazy attachment-letterbox-small size-letterbox-small wp-post-image attachment-id-' . $img_id . '" src="' . $gif . '" data-src="' . $slide_att[0] . '" width="' . $slide_att[1] . '" height="' . $slide_att[2] . '">';

        // the_post_thumbnail('letterbox-small');
  echo '</figure>';

} ?>

<div class="post-content aside">
  <?php the_excerpt(); ?>
</div>

<footer class="card-footer entry-footer aside aux hide-critical">
  <?php $last = 'Continue Reading &rarr;'; damsonhomes_posted_on($last); ?>
</footer>
