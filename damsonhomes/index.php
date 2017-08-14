<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Damson_Homes
 */

get_header(); 
do_action('dh_after_header'); ?>
<section id="content_area" class="content-area">
  <?php do_action('dh_before_main_content'); ?>
  <main id="main" class="row main-content" role="main">
    <?php do_action('dh_main_content_top');
    if ( have_posts() ) {

      /* Start the Loop */
      while ( have_posts() ) : the_post();

        /*
         * Include the Post-Format-specific template for the content.
         * If you want to override this in a child theme, then include a file
         * called content-___.php (where ___ is the Post Format name) and that will be used instead.
         */
        get_template_part( 'template-parts/content', get_post_format() );

        the_posts_navigation();

      endwhile;

    } else {

      get_template_part( 'template-parts/content', 'none' );

    } 

    do_action('dh_main_content_bottom'); ?>
  </main>
  <?php do_action('dh_after_main_content'); ?>
</section><!-- #content_area -->

<?php 
do_action('dh_before_footer');
get_footer();
