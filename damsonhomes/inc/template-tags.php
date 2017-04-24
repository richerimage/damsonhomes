<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Damson_Homes
 */

if ( ! function_exists( 'damsonhomes_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function damsonhomes_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	// if (is_singular()) {

	// 	$posted_on = '<span class="posted-on"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a></span>';

	// 	$byline = '<span class="author"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' .
	// 					'<span class="vcard">By ' . esc_html( get_the_author() ) . '</span></a></span>';

	// } else {

		$posted_on = '<span class="posted-on">' . $time_string . '</span>';

		$byline = '<span class="author"><span class="vcard">By ' . esc_html( get_the_author() ) . '</span></span>';

	// }

	

	$avatar = '<span class="avatar">' . get_avatar( get_the_author_meta( 'ID' ), 100 ) . '</span>';

	echo $posted_on . $byline . $avatar; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'damsonhomes_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function damsonhomes_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'damsonhomes' ) );
		if ( $categories_list && damsonhomes_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'damsonhomes' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'damsonhomes' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'damsonhomes' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}


	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'damsonhomes' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

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
