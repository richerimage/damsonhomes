<?php


add_action('dh_custom_template', 'dh_test_content');

function dh_test_content() {


  if(is_page('test')) { 

    global $post;

    $hero  = get_post_meta($post->ID, 'dh_get_hero', true) ? get_post_meta($post->ID, 'dh_get_hero', true) : 'Nada';

    // dump($hero_id);

    $test     = new dh_site($hero);

    //$test->new_hero();

    // $id = 'Danny';
    // $test->set($id);

    // $test->get();

    // $array = $test->siteMeta();

    // dump($array['v2']);

    get_header();
    do_action('dh_after_header'); ?>


    <section class="sites-area">
      <div class="site-main row">
        <h2 class="ntm text-center">Featured New Home Developments</h2>
          <div class="site-slider-holder">

      <?php  

        $args = array (

          'posts_per_page' => '-1',
          'tax_query' => array(
            array(
              'taxonomy' => 'dnh_site_status_taxonomy',
              'field' => 'slug',
              'terms' => 'feature',
            )
          ),
          'order' => 'asc',
          'orderby'     => 'menu_order',
        );

        // The Query
        $query = new WP_Query( $args );

        // The Loop
        if ( $query->have_posts() ) {

          while ( $query->have_posts() ) {
            $query->the_post();
            // do something

            require get_template_directory() . '/templates/template-parts/modules/card-site.php';

          }

        } else { }

        wp_reset_postdata(); 

      ?>
        </div>
        <div class="hero-footer tweleve columns text-center">
          <?php $type = 'page'; dh_social_share($type); ?>
        </div>
      </div>
    </section>

    <section class="content-area bg-white">
      <main id="primary" class="site-main row" role="main">

        

          <?php while ( have_posts() ) : the_post();
            
            $prehead    = get_post_meta($post->ID, 'dh_prehead', true) ? '<h5 class="pre-head">' . get_post_meta($post->ID, 'dh_prehead', true) . '</h5>' : '';
            $subhead    = get_post_meta($post->ID, 'dh_subhead', true) ? '<h3 class="sub-head">' . get_post_meta($post->ID, 'dh_subhead', true) . '</h3>' : '';

          ?>

            <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

              <header class="headline-area twelve columns">
                <div class="headline-wrapper">
                <?php echo $prehead;
                the_title( '<h1 class="headline h2 ntm">', '</h1>' ); 
                echo $subhead; ?>
                </div>
              </header>

              <div id="post_content" class="post-content seven columns">
                <?php the_content(); ?>
              </div><!-- .entry-content -->

              <div class="five columns content-right latest-posts aside">
                <header>
                  <h3 class="ntm">Latest from the Blog&hellip;</h3>
                </header>
                  <?php get_template_part( 'templates/template-parts/modules/card-front-blog', get_post_format() ); ?>
                <footer>
                  <p><a class="button sub" href="/blog/">See more blog posts &rarr;</a></p>
                </footer>
              </div>

            </div>

          <?php endwhile; // End of the loop. ?>

        
        <?php get_template_part( 'templates/template-parts/modules/feature-links', get_post_format() ); ?>
      </main>
    </section>

    <?php get_footer(); 
















  }

}