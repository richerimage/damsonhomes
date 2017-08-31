<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Damson_Homes
 */


global $post;

get_header(); 
do_action('dh_after_header');
do_action('dh_before_main_content_area'); ?>
<section id="content_area" class="content-area bg-white">
  <?php do_action('dh_before_main_content'); ?>
  <main id="main" class="row main-content" role="main">
    <?php do_action('dh_main_content_top');

    if ( have_posts() ) {

      /* Start the Loop */
      while ( have_posts() ) : the_post();

        get_template_part( 'templates/template-parts/content', 'together'); 

        // the_posts_navigation();

      endwhile;

    } else {

      get_template_part( 'template-parts/content', 'none' );

    }

    $args = array(
      'post_type'     => 'dnh_cpt_together',
      'posts_per_page' => -1,
      'post_parent'    => $post->ID,
      'order'          => 'ASC',
      'orderby'        => 'menu_order'
     );


    $parent = new WP_Query( $args );

    if ( $parent->have_posts() ) : ?>

    <div class="ten columns centered" style="float: none;"><hr></div>

    <div class="listings">
    <div class="healdine-wrapper twelve columns text-center"><h3 class="ntm">Read more&hellip;</h3></div>

        <?php while ( $parent->have_posts() ) : $parent->the_post(); ?>

          <article id="post-<?php the_ID(); ?>" <?php post_class(array('card', 'card-post')); ?>>
          <a class="block-link xv" href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">

            <?php get_template_part( 'templates/template-parts/modules/card-post', get_post_format() ); ?>

           </a>
           </article>

        <?php endwhile; ?>

    </div>

    <?php endif; wp_reset_query(); ?>

    <div class="post-content ten columns centered" style="float: none;">

      <?php if (comments_open()) { ?>
      <div class="fb-comments-wrap"><span class="fb-logo">
        <?php echo dh_get_svg(array('icon' => 'facebook')); ?> <p>Chat away&hellip;</p></span>
        <div class="fb-comments" data-href="<?php echo the_permalink(); ?>" data-width="100%" data-numposts="10"></div>
      </div>

      <?php } ?>

      <footer class="entry-footer">


      <?php damsonhomes_entry_footer(); ?>


    </footer><!-- .entry-footer -->


    </div><!-- .entry-content -->

    







    <?php do_action('dh_main_content_bottom'); ?>
  </main>

  <?php do_action('dh_after_main_content'); ?>
</section><!-- #content_area -->
<?php do_action('dh_after_main_content_area');

do_action('dh_before_footer');
get_footer();
