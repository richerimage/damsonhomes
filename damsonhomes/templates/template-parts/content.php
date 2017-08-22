<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Damson_Homes
 */


	$prehead 		= get_post_meta($post->ID, 'dh_prehead', true) ? '<h5 class="pre-head">' . get_post_meta($post->ID, 'dh_prehead', true) . '</h5>' : '';

	$subhead 		= get_post_meta($post->ID, 'dh_subhead', true) ? '<h3 class="sub-head">' . get_post_meta($post->ID, 'dh_subhead', true) . '</h3>' : '';

	$img_option = get_post_meta($post->ID, 'dh_ftr_img_option', true) ? get_post_meta($post->ID, 'dh_ftr_img_option', true) : '';

	if ($img_option === 'breakout') {
		$img_class = ' ' . $img_option;
	} else {
		$img_class = '';
	}  

	$share_post = get_post_meta($post->ID, 'dh_no_share', true) ? get_post_meta($post->ID, 'dh_no_share', true) : '';

	$full_width = get_post_meta($post->ID, 'dh_fullwidth', true) ? get_post_meta($post->ID, 'dh_fullwidth', true) : '';

	$width 			= (!empty($full_width) ? ' twelve columns centered' : ' ten columns centered');
	$sub_class	= (!empty($subhead) ? ' has-subhead' : '');

	$post_class = $width . $sub_class;

	$type = 'page';


	if (is_single()) {
		$type = 'post';
	}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class($post_class); ?>>
	<header class="headline-area">
		<?php 
		if ( is_single() ) { ?>

			<div class="headline-wrapper">
				<h5 id="say_hello" class="pre-head">From the Blog&hellip;</h5>
				<?php the_title( '<h1 class="headline h2 ntm">', '</h1>' ); 
				echo $subhead; ?>
			</div>
			<div class="meta-wrap aside">
				<?php damsonhomes_posted_on(); dh_social_share($type); ?>
			</div>

		<?php } else { ?>

			<div class="headline-wrapper">
				<?php echo $prehead;
				the_title( '<h1 class="headline h2 ntm">', '</h1>' ); 
				echo $subhead; ?>
			</div>

			<?php if(empty($share_post)) { ?>
				<div class="meta-wrap">
					<?php dh_social_share($type); ?>
				</div>
			<?php }

		} ?>
		
	</header><!-- .entry-header -->

	
	<?php if (has_post_thumbnail()) {

			if($img_option != 'supress') {

				echo '<figure class="featured-image mb' . $img_class . '">';

			 	the_post_thumbnail('letterbox-large');

				echo '</figure>';

			}

	} ?>

	<div id="post_content" class="post-content">
		<?php the_content(); 

		if (is_single()) {

			$cta_id = get_post_meta($post->ID, 'dh_cta', true) ? get_post_meta($post->ID, 'dh_cta', true) : '';

			if (!empty($cta_id)) {

				$dh_cta_class = WP_PLUGIN_DIR . '/dh-custom-functions/inc/classes/dh_cta.php';
				require_once $dh_cta_class;
				
				$cta 		= new dh_cta($cta_id);

				echo $cta->new_cta();  

			}

    } ?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">


		<?php damsonhomes_entry_footer(); ?>


	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
