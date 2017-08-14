<?php /**
 *
 * Default page template
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Damson_Homes
 */

get_header(); 
do_action('dh_after_header'); ?>
<section id="content_area" class="content-area bg-white">
  <?php do_action('dh_before_main_content'); ?>
  <main id="main" class="row main-content" role="main">
    <?php do_action('dh_main_content_top');

    if ( have_posts() ) {

      while ( have_posts() ) { 

        the_post();

        get_template_part( 'templates/template-parts/content');

      }

    } else {

      get_template_part( 'template-parts/content', 'none' );

    }

    do_action('dh_main_content_bottom'); ?>
  </main>
  <?php do_action('dh_after_main_content'); ?>
</section><!-- #content_area -->

<?php do_action('dh_before_footer');

get_footer();
