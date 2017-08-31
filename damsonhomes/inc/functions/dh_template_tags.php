<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Damson_Homes
 */

if ( ! function_exists( 'damsonhomes_posted_on' ) ) {

  /**
   * Prints HTML with meta information for the current post-date/time and author.
   */

  function damsonhomes_posted_on($last='') {
    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
    if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
      $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated srt" datetime="%3$s">%4$s</time>';
    }

    $time_string = sprintf( $time_string,
    	esc_attr( get_the_date( 'c' ) ),
    	esc_html( get_the_date('jS M Y') ),
    	esc_attr( get_the_modified_date( 'c' ) ),
    	esc_html( get_the_modified_date('jS M Y') )
    );

    $last = (!empty($last) ? "<li class=\"read-on\">$last</li>\n" : '');

    $byline     = esc_html( get_the_author() );
    $avatar     = get_avatar( get_the_author_meta( 'ID' ), 48 );

    echo  "<ul data-content=\"entry_meta\" class=\"entry-meta no-style hide-critical\">\n".
          "<li class=\"posted-on\">$time_string</li>\n".
          "<li class=\"author\">$byline $avatar</li>\n".
          $last. 
          
          "</ul>\n";

  }

}



function damsonhomes_entry_footer() {
	// Hide category and tag text for pages.
  if ( 'post' === get_post_type() ) { ?>

    <div class="blog-navigation clearfix xv text-center aside">
      <h4 class="twelve columns ntm">More from the Blog</h4>
      <div class="six columns this-cat">
        <p>More from this development</p>
        <?php next_post_link( '%link', 'Next', TRUE ); ?>
        <?php previous_post_link( '%link', 'Previously', TRUE ); ?>
      </div>
      <div class="six columns all-cats">
        <p>From the rest of the Blog</p>
        <?php next_post_link( '%link', 'Next Up'); ?>
        <?php previous_post_link( '%link', 'Go Back'); ?>
      </div>
    </div>


  <?php 

    /* translators: used between list items, there is a space after the comma */
    // $categories_list = get_the_category_list( esc_html__( ', ', 'damsonhomes' ) );
    // if ( $categories_list && damsonhomes_categorized_blog() ) {
    //   printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'damsonhomes' ) . '</span>', $categories_list ); // WPCS: XSS OK.
    // }

    //  translators: used between list items, there is a space after the comma 
    // $tags_list = get_the_tag_list( '', esc_html__( ', ', 'damsonhomes' ) );
    // if ( $tags_list ) {
    //   printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'damsonhomes' ) . '</span>', $tags_list ); // WPCS: XSS OK.
    // }




   } ?>


   <div class="fb-follow-wrap">
        <div class="fb-follow" data-href="https://www.facebook.com/damsonnewbuild" data-layout="standard" data-size="large" data-show-faces="true"></div>
      </div>



<?php }



/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function damsonhomes_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'damsonhomes_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'damsonhomes_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so damsonhomes_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so damsonhomes_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in damsonhomes_categorized_blog.
 */
function damsonhomes_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'damsonhomes_categories' );
}
add_action( 'edit_category', 'damsonhomes_category_transient_flusher' );
add_action( 'save_post',     'damsonhomes_category_transient_flusher' );
