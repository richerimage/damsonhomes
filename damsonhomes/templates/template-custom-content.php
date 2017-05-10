<?php 

/*
 * 
 * Template Name: Custom Content Template
 * 
 *
 * 
 */

get_header(); 

global $post; ?>

<section class="content-area">
  <main id="primary" class="site-main container" role="main">

    <?php while ( have_posts() ) : the_post();

      if (is_page('brochure')) {
        get_template_part( 'template-parts/content-brochure', get_post_format());
      } else {
        get_template_part( 'template-parts/content', get_post_format());

      }

    endwhile; ?>

  </main>
  <!-- #main -->
</section>

<?php get_footer();