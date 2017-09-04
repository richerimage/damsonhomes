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
        $img_id     = get_post_thumbnail_id();
        $slide_att  = wp_get_attachment_image_src($img_id, 'letterbox-small');
        $base64     = 'data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==';
        $gif        = get_template_directory_uri() . '/images/holding.gif';
        
        // $slide_src = $slide_att[0];
        // $slide_wth = $slide_att[1];
        // $slide_hgt = $slide_att[2];

        // var_dump($slide_att[0]);

        echo '<img class="b-lazy attachment-letterbox-small size-letterbox-small wp-post-image attachment-id-' . $img_id . '" src="' . $gif . '" data-src="' . $slide_att[0] . '" width="' . $slide_att[1] . '" height="' . $slide_att[2] . '">';

  echo '</figure>';

} ?>

<div class="post-content aside ">
  <?php the_excerpt(); ?>
</div>

<footer class="card-footer entry-footer aside aux hide-critical">
  <ul data-content="entry_meta" class="entry-meta no-style hide-critical">
    <li class="read-on">Continue Reading &rarr;</li>
</ul>
</footer>
