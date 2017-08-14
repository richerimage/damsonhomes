<?php


add_action('dh_custom_template', 'dh_about_content');

function dh_about_content() {

$pages = array(
  'about',
  'about-us'
);

if(is_page($pages)) { 

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
    <?php do_action('dh_before_main_content'); 


    $tab_1  = '<li><a id="tab1_trigger" href="#tab1" class="active">Our Signature Specifaction</a></li>';
    $tab_2  = '<li><a id="tab2_trigger" href="#tab2" class="">Meet the Team</a></li>';
    $tab_3  = '<li><a id="tab3_trigger" href="#tab3" class="">Community</a></li>';
    $tab_4  = '<li><a id="tab4_trigger" href="#tab4" class="">Gallery</a></li>';
    $tab_5  = '<li><a id="tab5_trigger" href="#tab5" class="">Location</a></li>';
    $tab_6  = '<li><a id="tab6_trigger" href="#tab6" class="">Updates</a></li>';
    $tab_7  = '<li><a id="tab7_trigger" href="#tab7" class="">Enquire</a></li>';

    $tab_1_cont    = get_post_meta($post->ID, 'dh_tab_1', true) ?  get_post_meta($post->ID, 'dh_tab_1', true) : '';
    $tab_2_cont    = get_post_meta($post->ID, 'dh_tab_2', true) ?  get_post_meta($post->ID, 'dh_tab_2', true) : '';
    $tab_3_cont    = get_post_meta($post->ID, 'dh_tab_3', true) ?  get_post_meta($post->ID, 'dh_tab_3', true) : '';
    $tab_4_cont    = get_post_meta($post->ID, 'dh_tab_4', true) ?  get_post_meta($post->ID, 'dh_tab_4', true) : '';

    ?>

    <section class="ftr-nav-area">
      <div class="tabgroup row">
        <ul class="tabs clearfix aside" data-tabgroup="primary">
          <?php echo $tab_1 . $tab_2 . $tab_3 . $tab_4; ?>
        </ul>
      </div>
    </section>

    <section class="content-area bg-white">
      <main id="primary" class="site-main row" role="main">

        <div id="tab1" class="tab-content tab1 tab-spec tab-top ten columns centered">
          <div class="headline-wrapper twelve columns text-center">
            <h2 class="headline h2 ntm">Our Signature 5 &times; Award-Winning Specifiation</h2>
          </div>
          <div class="post-content twelve columns">
            <?php echo wpautop(do_shortcode($tab_1_cont)); ?>
          </div>
        </div>

        <div id="tab2" class="tab-content tab2 tab-team tab-bottom">
          <div class="headline-wrapper twelve columns text-center">
            <h2 class="headline h2 ntm">The Team Behind Damson Homes</h2>
          </div>
          <div class="post-content twelve columns">
            <?php echo wpautop(do_shortcode($tab_2_cont)); ?>
          </div>

          <div class="the-team listings">

          <?php 
          $args = array(
            'post_type'       => array( 'dnh_cpt_team' ),
            'posts_per_page'  => '25',
            'orderby'         => 'menu_order',
            'order'           => 'ASC'
          );

          // The Query
          $query = new WP_Query( $args );

          // The Loop
          if ( $query->have_posts() ) {

            while ( $query->have_posts() ) {
              $query->the_post();

              require get_template_directory() . '/templates/template-parts/modules/card-team.php';

              // do something
            }
          } else {
            // no posts found
          }

          // Restore original Post Data
          wp_reset_postdata(); ?>

          </div>
        </div>

        <div id="tab3" class="tab-content tab3 tab-community tab-bottom">
          <div class="headline-wrapper twelve columns text-center">
            <h2 class="headline h2 ntm">Community</h2>
          </div>
          <div class="post-content ten columns centered">
            <?php echo wpautop(do_shortcode($tab_3_cont)); ?>
          </div>
        </div>

        <div id="tab4" class="tab-content tab4 tab-gallery tab-bottom">
          <div class="headline-wrapper twelve columns text-center">
            <h2 class="headline h2 ntm">Gallery</h2>
          </div>
          <div class="post-content twelve columns">
            <?php echo wpautop(do_shortcode($tab_4_cont)); ?>
          </div>
        </div>

      </main>

    </section>

    <? get_footer();

  } 

}



add_action( 'dh_critical_css', 'dh_load_critical_about_css', 5);

function dh_load_critical_about_css() {

  $pages = array(
    'about',
    'about-us'
  );

  if(is_page($pages)) { 

    $crit_path        = get_template_directory_uri() . '/styles/critical-';
    $css_listining_source       = $crit_path . 'listings.css';
    $css_crit_listing = file_get_contents($css_listining_source); 

    echo "\n" . $css_crit_listing;

  }

}
