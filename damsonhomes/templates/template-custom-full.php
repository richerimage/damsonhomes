<?php 

/*
 * 
 * Template Name: Fully Custom
 * 
 *
 * 
 */

global $post; 

if (is_page('brochure')) {

  get_header(); 
    if ( have_posts() ) { 
      while ( have_posts() ) { the_post(); 
        get_template_part( 'template-parts/content-brochure', get_post_format());
      }
    }
  get_footer();

} else if (is_page('viewing')) {

  get_header(); 
    if ( have_posts() ) { 
      while ( have_posts() ) { the_post(); 
      get_template_part( 'template-parts/content-viewing', get_post_format());
      }
    }
  get_footer();

} else if (is_page('reserve')) {

  get_header(); 
    if ( have_posts() ) { 
      while ( have_posts() ) { the_post(); 
      get_template_part( 'template-parts/content-reserve', get_post_format());
      }
    }
  get_footer();

} else if (is_page('register')) {

  get_header(); 
    if ( have_posts() ) { 
      while ( have_posts() ) { the_post(); 
      get_template_part( 'template-parts/content-register', get_post_format());
      }
    }
  get_footer();

} else if (is_page('subscribe')) {

  get_header(); 
    if ( have_posts() ) { 
      while ( have_posts() ) { the_post(); 
      get_template_part( 'template-parts/content-subscribe', get_post_format());
      }
    }
  get_footer();

} else {

  get_header(); 
    if ( have_posts() ) { 
      while ( have_posts() ) { the_post(); 
        get_template_part( 'template-parts/content-page', get_post_format());
      }
    }
  get_footer();

}