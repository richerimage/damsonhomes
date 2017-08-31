<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Damson_Homes
 */

	$currentID = get_the_ID();

	$prefix = 'dnh_team_';

	$subhead 		= get_post_meta($post->ID, $prefix . 'title', true) ? '<h3 class="sub-head">' . get_post_meta($post->ID, $prefix . 'title', true) . '</h3>' : '';
	
	$role 			= get_post_meta($post->ID, $prefix . 'role', true) ? '<li><strong>What I do: </strong><br>' . get_post_meta($post->ID, $prefix . 'role', true) . '</li>' : '';
	$fav_site 	= get_post_meta($post->ID, $prefix . 'fav_site', true) ? '<li><strong>Favoutite Damson Site: </strong><br>' . get_post_meta($post->ID, $prefix . 'fav_site', true) . '</li>' : '';
	$fav_moment = get_post_meta($post->ID, $prefix . 'fav_moment', true) ? '<li><strong>Favoutite Damson Moment: </strong><br>' . get_post_meta($post->ID, $prefix . 'fav_moment', true) . '</li>' : '';
	$alterego 	= get_post_meta($post->ID, $prefix . 'alterego', true) ? '<li><strong>Animal Alterego: </strong><br>' . get_post_meta($post->ID, $prefix . 'alterego', true) . '</li>' : '';

	$post_class = array('has-subhead', 'team-single-content', 'ten columns centered');


?>

<article id="post-<?php the_ID(); ?>" <?php post_class($post_class); ?>>
	<header class="headline-area twelve columns">

			<div class="headline-wrapper">
				<h3 id="say_hello" class="pre-head">Meet&hellip;</h3>
				<?php the_title( '<h1 class="headline h2 ntm">', '</h1>' ); 
				echo $subhead; ?>
			</div>
		
	</header><!-- .entry-header -->

	<section class="meta-content-wrap clearfix post-content divider-bottom">
	<?php if (has_post_thumbnail()) {

			if($img_option != 'supress') {

				echo '<figure class="featured-image main-ftr-image mb five columns">';

			 	the_post_thumbnail('square-small');

				echo '</figure>';

			}

	} ?>

		<div class="meta-content seven columns">
			<?php echo '<ul>' .	$role . $fav_site . $fav_moment . $alterego . '</ul>'; ?>
		</div>
	</section>

	<div id="post_content" class="post-content">
		<?php the_content(); ?>

	</div><!-- .entry-content -->

	<footer class="entry-footer listings footer-listings">
		          
	  <?php 
	  $args = array(
	    'post_type'       => array( 'dnh_cpt_team' ),
	    'posts_per_page'  => '25',
	    'orderby'         => 'menu_order',
	    'order'           => 'ASC',
	    'post__not_in' 		=> array($currentID)
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

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
