<?php


add_action('dh_custom_template', 'dh_spec_content');

function dh_spec_content() {

if(is_page('spec')) { 

  global $post;

  $prehead    = get_post_meta($post->ID, 'dh_prehead', true) ? '<h5 class="pre-head">' . get_post_meta($post->ID, 'dh_prehead', true) . '</h5>' : '';
  $subhead    = get_post_meta($post->ID, 'dh_subhead', true) ? '<h3 class="sub-head">' . get_post_meta($post->ID, 'dh_subhead', true) . '</h3>' : '';

    get_header() ?>

    <section id="hero_area" class="hero-area hero-fly-in">
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



    <section class="content-area bg-white">
      <main id="primary" class="site-main row" role="main">

          <?php 

            $args = array(
              'post_type' => array('dnh_cpt_spec'),
              'orderby' => 'menu_order',
              'order'   => 'ASC',
              'posts_per_page' => 100
            );

            // The Query
            $query = new WP_Query( $args );

            // The Loop
            if ( $query->have_posts() ) { while ( $query->have_posts() ) { $query->the_post(); ?>

            <div class="xv box clearfix mb">
              <div class="headline-wrapper twelve columns">
                <?php the_title( '<h2 class="headline h3">', '</h2>' ); ?>
              </div>
              <?php echo get_the_post_thumbnail( $spec->ID, 'letterbox-medium',  array( 'class' => 'six columns spec-img mb' )); ?> 
              <div class="post-excerpt six columns aside">
                <?php the_content(); ?>
              </div>
            </div>  

              <?php }

              if ($query->max_num_pages > 1) { // check if the max number of pages is greater than 1  ?>
                <nav class="prev-next-posts">
                  <div class="prev-posts-link">
                    <?php echo get_next_posts_link( 'Older Entries', $query->max_num_pages ); // display older posts link ?>
                  </div>
                  <div class="next-posts-link">
                    <?php echo get_previous_posts_link( 'Newer Entries' ); // display newer posts link ?>
                  </div>
                </nav>
              <?php }

            } else { } 

          ?>



      </main>

    </section>

    <? get_footer();

  } 

}

