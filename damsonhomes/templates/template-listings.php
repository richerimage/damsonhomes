<?php 

/*
 * 
 * Template Name: Property Listings
 * 
 *
 * 
 */

global $post;

get_header(); 

$counter = 0; 
$prehead    = get_post_meta($post->ID, 'dh_prehead', true) ? '<h5 class="pre-head">' . get_post_meta($post->ID, 'dh_prehead', true) . '</h5>' : '';
$subhead    = get_post_meta($post->ID, 'dh_subhead', true) ? '<h3 class="sub-head">' . get_post_meta($post->ID, 'dh_subhead', true) . '</h3>' : '';

$hero       = get_post_meta($post->ID, 'dh_has_hero', true) ? get_post_meta($post->ID, 'dh_has_hero', true) : '';

$hero_class = (!empty($hero) ? ' ' . $hero : '');

?>

<section id="hero_area" class="hero-area bg-white<?php echo $hero_class; ?>">
  <div class="row hero-box">
    <div class="hero-left six columns">
      <header class="headline-area">
        <?php echo $prehead;
        the_title( '<h1 class="headline archive-headline h2">', '</h1>' );
        echo $subhead; ?>
      </header>
        <?php if ( have_posts() ) { while ( have_posts() ) { the_post(); ?>
          <div class="post-content archive-description">
            <?php the_content(); ?>
        </div>
        <?php } } else {} ?>
      <?php dh_social_share($type); ?>
    </div>
  </div>
</section>
<?php do_action('dh_before_main_content'); ?>
<section id="primary" class="content-area">
  <main id="main_content" class="main-content row listings" role="main">
    <?php do_action('dh_main_content_top');

    if (is_page('for-sale')) {
      $tax = 'live';
    } elseif (is_page('coming-soon')) {
      $tax = 'coming-soon';
    } elseif (is_page('portfolio')) {
      $tax = 'portfolio';
    } else {
      $tax = '';
    }

    $current_page = get_query_var('paged');


    $args = array(
      'dnh_site_status_taxonomy' => $tax,
      'orderby' => 'menu_order',
      'order'   => 'ASC',
      'posts_per_page' => 8,
      'paged'   => $current_page
    );

    // The Query
    $query = new WP_Query( $args );

    // The Loop
    if ( $query->have_posts() ) {

      while ( $query->have_posts() ) {
        $query->the_post();
        // do something

        get_template_part( 'templates/template-parts/modules/card-site', get_post_format() );

      } ?>



    <?php } else { 


      if (is_page('for-sale')) { ?>

      
        <div class="post-content">
          <h3>No New Build Developments Currently For Sale</h3>
          <p>All plots are now currently sold &mdash; please visit our coming soon section to view forthcoming developments.</p>
          <p><a class="button cta" href="/coming-soon/">Visit the Coming Soon Page</a></p>
        </div>

      <?php } elseif (is_page('coming-soon')) { ?>

        <div class="post-content">
          <h3>We're not quite ready&hellip;</h3>
          <p>To show what we are working on yet &mdash; rest assureed this will not be the case in the very near future!</p>
          <p>To ensure you don't miss out, subscribe here and we will drop you an email with some exciting news soon.</p>
          <p><a class="button cta" href="/subscribe/">Subscribe Here &rarr;</a></p>
        </div>


      <?php } else { }

    }

    // Restore original Post Data
    wp_reset_postdata();
    do_action('dh_main_content_bottom'); ?>


  </main>

  <?php if ($query->max_num_pages > 1) { ?>

  <div class="pagation-wrap row">
    <nav class="pagation-nav twelve columns">
    <?php echo paginate_links(array('total' => $query->max_num_pages)); ?>
    </nav>
  </div>

  <?php } ?>

  
  <?php do_action('dh_after_main_content'); ?>

</section>
<?php do_action('dh_after_main_content_area');

if (!is_page('coming-soon')) { ?>

  <div id="dh_map" class="site-map listings-map"></div>

<?php }

get_footer(); 
