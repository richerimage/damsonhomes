<?php
/**
 * Template part for displaying site cards
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Damson_Homes
 */


global $post;


$name       = get_post_meta($post->ID, 'dh_site_name', true) ? get_post_meta($post->ID, 'dh_site_name', true) : ''; 
$intro      = get_post_meta($post->ID, 'intro', true) ? get_post_meta($post->ID, 'intro', true) : '';
$number     = get_post_meta($post->ID, 'site-number', true) ? get_post_meta($post->ID, 'site-number', true) : ''; 
$street     = get_post_meta($post->ID, 'site-street', true) ? get_post_meta($post->ID, 'site-street', true) : ''; 
$area       = get_post_meta($post->ID, 'site-area', true) ? get_post_meta($post->ID, 'site-area', true) : '';
$town       = get_post_meta($post->ID, 'site-town', true) ? get_post_meta($post->ID, 'site-town', true) : '';
$postcode   = get_post_meta($post->ID, 'postcode', true) ? get_post_meta($post->ID, 'postcode', true) : '';
$due_date   = get_post_meta($post->ID, 'dh_completion_date', true) ? get_post_meta($post->ID, 'dh_completion_date', true) : '';
$build_time = get_post_meta($post->ID, 'dh_build_time', true) ? get_post_meta($post->ID, 'dh_build_time', true) : '';
$price_from = get_post_meta($post->ID, 'dh_price_from', true) ? get_post_meta($post->ID, 'dh_price_from', true) : '';
$flash      = get_post_meta($post->ID, 'dh_flash', true) ? get_post_meta($post->ID, 'dh_flash', true) : ''; 

$def_img    = get_template_directory_uri() . '/images/dh-default-';

$coords     = get_post_meta($post->ID, 'dh_site_map', true) ? 'data-coords="' . get_post_meta($post->ID, 'dh_site_map', true) . '" ' : '';

$site =

'<p class="site-name">' .
(!empty ($name) ? '<span class="name h4">' . $name . '</span> ' : '' ) .
(!empty ($area) ? '<span class="area h5"><em>in</em> ' . $area . '</span>' : '' ) .
'</p>';


if( has_term( 'live', 'dnh_site_status_taxonomy' ) ) {
  $status = 'live';
} elseif ( has_term( 'coming-soon', 'dnh_site_status_taxonomy' ) ) {
  $status = 'coming_soon';
} elseif ( has_term( 'portfolio', 'dnh_site_status_taxonomy' ) ) {
  $status = 'portfolio';
} else {
  $status = '';
}


?>

<article id="post-<?php the_ID(); ?>" <?php post_class(array('card', 'card-site')); ?>>
  <a class="block-link" href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">

    <header class="headline-area">
      <?php echo $site; ?>
    </header>

    <figure class="featured-image">

      <?php if (has_post_thumbnail()) {

        $img_id = get_post_thumbnail_id();
        $slide_att = wp_get_attachment_image_src($img_id, 'letterbox-small');
        // $slide_src = $slide_att[0];
        // $slide_wth = $slide_att[1];
        // $slide_hgt = $slide_att[2];

        // var_dump($slide_att[0]);

        echo '<img class="b-lazy attachment-letterbox-small size-letterbox-small wp-post-image attachment-id-' . $img_id . '" src="' . $slide_att[0] . '" width="' . $slide_att[1] . '" height="' . $slide_att[2] . '">';

        // the_post_thumbnail('letterbox-small');

      } else { ?>

        <img width="600" height="338" src="<?php echo $def_img . '600x338.jpg'; ?>" class="attachment-letterbox-small size-letterbox-small wp-post-image" alt="">

      <?php }

      echo (!empty($flash) ? '<span class="flash hide-critical">' . $flash . '</span>' : ''); ?>

    </figure>

    <?php if (is_page_template('templates/template-listings.php')) { ?>

      <div class="post-content aside">

        <?php echo (!empty ($intro) ? '<p>' . $intro . '</p>' : '' ); ?>

      </div>

      <footer class="card-footer entry-footer aside aux hide-critical">
        <ul data-content="entry_meta" class="entry-meta no-style hide-critical">
          <?php if ($status == 'coming_soon') {
            echo (!empty($due_date) ? '<li>' . dh_get_svg(array('icon' => 'folder-open')). ' ' . $due_date . '</li>' : '');
          } elseif ($status == 'live') {
            echo (!empty($price_from) ? '<li>' . dh_get_svg(array('icon' => 'home')). ' From: <strong>£' . $price_from . '</strong></li>' : '');
          } elseif ($status == 'portfolio') {
            echo (!empty($build_time) ? '<li>' . dh_get_svg(array('icon' => 'build')). ' ' . $build_time . '</li>' : '');
          } else {}

          if ($status == 'live') {
            echo (!empty($due_date) ? '<li>' . dh_get_svg(array('icon' => 'key')) . ' <span class="srt">Estimated Completion</span>' . $due_date . '</li>' : '');
          } elseif ($status == 'portfolio') {
            echo (!empty($due_date) ? '<li>' . dh_get_svg(array('icon' => 'key')) . ' <span class="srt">Completed in</span>' . $due_date . '</li>' : '');
          } else {} ?>  
          <li><span class="read-on">Learn More &rarr;</span></li>
        </ul>
      </footer><!-- .entry-footer -->

      

      <?php } ?>
  </a>
</article><!-- #post-## -->