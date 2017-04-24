<?php
/**
 * Include and setup custom metaboxes and fields. (make sure you copy this file to outside the CMB2 directory)
 *
 * Be sure to replace all instances of 'dh_' with your project's prefix.
 * http://nacin.com/2010/05/11/in-wordpress-prefix-everything/
 *
 * @category YourThemeOrPlugin
 * @package  Demo_CMB2
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/CMB2/CMB2
 */


if ( file_exists( get_template_directory() . '/classes/cmb2/init.php' ) ) {
	require_once get_template_directory() . '/classes/cmb2/init.php';
} elseif ( file_exists( get_template_directory() . '/classes/cmb2/init.php' ) ) {
	require_once get_template_directory() . '/classes/cmb2/init.php';
}


// https://github.com/CMB2/cmb2-attached-posts

if ( file_exists( get_template_directory() . '/classes/cmb2-attached-posts/cmb2-attached-posts-field.php' ) ) {
	require_once get_template_directory() . '/classes/cmb2-attached-posts/cmb2-attached-posts-field.php';
} elseif ( file_exists( get_template_directory() . '/classes/cmb2-attached-posts/cmb2-attached-posts-field.php' ) ) {
	require_once get_template_directory() . '/classes/cmb2-attached-posts/cmb2-attached-posts-field.php';
}


/**
 * Conditionally displays a field when used as a callback in the 'show_on_cb' field parameter
 *
 * @param  CMB2_Field object $field Field object.
 *
 * @return bool                     True if metabox should show
 */
function dh_hide_if_no_cats( $field ) {
	// Don't show this field if not in the cats category.
	if ( ! has_tag( 'cats', $field->object_id ) ) {
		return false;
	}
	return true;
}

/**
 * Manually render a field.
 *
 * @param  array      $field_args Array of field arguments.
 * @param  CMB2_Field $field      The field object.
 */
function dh_render_row_cb( $field_args, $field ) {
	$classes     = $field->row_classes();
	$id          = $field->args( 'id' );
	$label       = $field->args( 'name' );
	$name        = $field->args( '_name' );
	$value       = $field->escaped_value();
	$description = $field->args( 'description' );
	?>
	<div class="custom-field-row <?php echo esc_attr( $classes ); ?>">
		<p><label for="<?php echo esc_attr( $id ); ?>"><?php echo esc_html( $label ); ?></label></p>
		<p><input id="<?php echo esc_attr( $id ); ?>" type="text" name="<?php echo esc_attr( $name ); ?>" value="<?php echo $value; ?>"/></p>
		<p class="description"><?php echo esc_html( $description ); ?></p>
	</div>
	<?php
}

/**
 * Manually render a field column display.
 *
 * @param  array      $field_args Array of field arguments.
 * @param  CMB2_Field $field      The field object.
 */
function dh_display_text_small_column( $field_args, $field ) {
	?>
	<div class="custom-column-display <?php echo esc_attr( $field->row_classes() ); ?>">
		<p><?php echo $field->escaped_value(); ?></p>
		<p class="description"><?php echo esc_html( $field->args( 'description' ) ); ?></p>
	</div>
	<?php
}

/**
 * Conditionally displays a message if the $post_id is 2
 *
 * @param  array             $field_args Array of field parameters.
 * @param  CMB2_Field object $field      Field object.
 */
function dh_before_row_if_2( $field_args, $field ) {
	if ( 2 == $field->object_id ) {
		echo '<p>Testing <b>"before_row"</b> parameter (on $post_id 2)</p>';
	} else {
		echo '<p>Testing <b>"before_row"</b> parameter (<b>NOT</b> on $post_id 2)</p>';
	}
}


/**
 * Gets a number of terms and displays them as options
 * @param  CMB2_Field $field 
 * @return array An array of options that matches the CMB2 options array
 *
 * Use a callback to avoid performance hits on pages where this field is not displayed (including the front-end).
 *
 *   Example: 'options_cb' => 'cmb2_get_term_options',
 *
 *   'get_terms_args' => array(
 *  		'taxonomy'   => 'category',
 *  		'hide_empty' => false,
 *    ),
 */

function cmb2_get_term_options( $field ) {
	$args = $field->args( 'get_terms_args' );
	$args = is_array( $args ) ? $args : array();

	$args = wp_parse_args( $args, array( 'taxonomy' => 'category' ) );

	$taxonomy = $args['taxonomy'];

	$terms = (array) cmb2_utils()->wp_at_least( '4.5.0' )
		? get_terms( $args )
		: get_terms( $taxonomy, $args );

	// Initate an empty array
	$term_options = array();
	if ( ! empty( $terms ) ) {
		foreach ( $terms as $term ) {
			$term_options[ $term->term_id ] = $term->name;
		}
	}

	return $term_options;
}






/**
 * Gets a number of posts and displays them as options
 * @param  array $query_args Optional. Overrides defaults.
 * @return array             An array of options that matches the CMB2 options array
 */
function cmb2_get_post_options( $query_args ) {

	$args = wp_parse_args( $query_args, array(
		'post_type'   => 'post',
		'numberposts' => 10,
	) );

	$posts = get_posts( $args );

	$post_options = array();
	if ( $posts ) {
		foreach ( $posts as $post ) {
          $post_options[ $post->ID ] = $post->post_title;
		}
	}

	return $post_options;
}

/**
 * Gets 5 posts for your_post_type and displays them as options
 * @return array An array of options that matches the CMB2 options array
 */
function dh_area_cpt_list() {
	return cmb2_get_post_options( 
		array( 
			'post_type' 	=> 'dnh_cpt_area', 
			'numberposts' => 100,
			'orderby'			=> 'title', 
			'order' 			=> 'ASC'
		));
}











add_action( 'cmb2_admin_init', 'dh_register_demo_metabox' );
/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_admin_init' or 'cmb2_init' hook.
 */
function dh_register_demo_metabox() {
	$prefix = 'dh_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$dh_site = new_cmb2_box( array(
		'id'            => $prefix . 'site_metabox',
		'title'         => esc_html__( 'New Homes Site Meta', 'dh' ),
		'object_types'  => array( 'page' ), // Post type
		'show_on'      	=> array( 'key' => 'page-template', 'value' => 'template-site.php' ),
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true,
		'classes'    => 'dh-mb dh-site-mb',
	) );



	$dh_site->add_field( array(
		'name' => esc_html__( 'Development Name', 'dh' ),
		'id'   => 'site-name',
		'type' => 'text',
		'before_row'   => '<div class="row"><div class="six columns">', // callback.
		// 'classes'  => 'six columns'
	) );

	$dh_site->add_field( array(
		'name'     => esc_html__( 'Associated Blog Category', 'dh' ),
		'id'       => $prefix . 'category',
		'type' 		 => 'select',
		'options_cb'     => 'cmb2_get_term_options',
		// Same arguments you would pass to 'get_terms'.
		'get_terms_args' => array(
			'taxonomy'   => 'category',
			'hide_empty' => false,
		),
		'after_row'   => '</div>'
	) );

	$dh_site->add_field( array(
		'name'     => esc_html__( 'Site Status', 'dh' ),
		'id'       => $prefix . 'site_status',
		'type'     => 'taxonomy_multicheck',
		'taxonomy' => 'dnh_site_status_taxonomy', // Taxonomy Slug
		'text'           => array(
		'no_terms_text' => 'Sorry, no terms could be found.', // Change default text. Default: "No terms"
		),
		'select_all_button' => false,
		'remove_default' => 'true',
		'inline'  => true,
		'classes'  => 'six columns',
		'after_row'   => '</div>'
	) );

	$dh_site->add_field( array(
		'name' => esc_html__( 'Site Logo', 'dh' ),
		'id'   => $prefix . 'site_thumb',
		'type' => 'file',
		'preview_size' => array( 64, 64 ), // Default: array( 50, 50 )
	) );

	$dh_site->add_field( array(
		'name' => esc_html__( 'Brochure Link', 'dh' ),
		'id'   => 'site_brochure_link',
		'type' => 'text_url',
		'classes' => 'dh-mb-full-width',
		'after_row' => '<hr />'
	) );

	$dh_site->add_field( array(
		'name' => esc_html__( 'Number/Name', 'dh' ),
		'id'   => 'site-number',
		'type' => 'text_small',
		'before_row'   => '<div class="mb-ftr-section"><h4 class="ntm">Development Details</h4><div class="row"><div class="six colmns">', // callback.
	) );

	$dh_site->add_field( array(
		'name' => esc_html__( 'Street', 'dh' ),
		'id'   => 'site-street',
		'type' => 'text_medium',
		// 'before_row'   => '<div class="mb-ftr-section"><h4 class="ntm">Development Details</h4><div class="row"><div class="six colmns">', // callback.
	) );

	$dh_site->add_field( array(
		'name' => esc_html__( 'Area', 'dh' ),
		'id'   => 'site-area',
		'type' => 'text_medium',
	) );

	$dh_site->add_field( array(
		'name' => esc_html__( 'Town', 'dh' ),
		'id'   => 'site-town',
		'type' => 'text_medium',
	) );

	$dh_site->add_field( array(
		'name' => esc_html__( 'Post Code', 'dh' ),
		'id'   => 'postcode',
		'type' => 'text_small',
		'after_row'   => '</div>'
	) );


	$dh_site->add_field( array(
		'name' => esc_html__( 'Prices From £', 'dh' ),
		'id'   => $prefix . 'price_from',
		'type' => 'text_medium',
		'before_row'   => '<div class="six columns">',
	) );


	$dh_site->add_field( array(
		'name' => esc_html__( 'Completion Date', 'dh' ),
		'id'   => $prefix . 'completion_date',
		'type' => 'text_medium',
		'after_row'   => '</div></div></div>'
	) );


	$dh_site->add_field( array(
		'name' => esc_html__( 'Video', 'dh' ),
		'desc' => esc_html__( 'Enter last 10 digits from vimeo.com url', 'dh' ),
		'id'   => $prefix . 'video',
		'type' => 'text_medium',
		'before_row'   => '<div class="row">',
		'classes'			=> 'four columns',
	) );

	$dh_site->add_field( array(
		'name' => esc_html__( 'Video Splash Image', 'dh' ),
		'id'   => $prefix . 'video_thumb',
		'type' => 'file',
		'preview_size' => array( 50, 50 ),
		'classes'			=> 'eight columns',
		'after_row'   => '</div>',
	) );




	$dh_site->add_field( array(
		'name' => esc_html__( 'Plot Map', 'dh' ),
		'id'   => $prefix . 'plot_map_url',
		'type' => 'file',
		'preview_size' => array( 64, 64 ), // Default: array( 50, 50 )
	) );


	/*
	 *
	 * Repeatable Plot Groups -- START
	 *
	 */


	$dh_plots = $dh_site->add_field( array(
		'id'          => $prefix . 'plot_avail',
		'type'        => 'group',
		'description' => esc_html__( 'Plot Information', 'dh' ),
		'options'     => array(
			'group_title'   => esc_html__( 'Plot Number: {#}', 'dh' ), // {#} gets replaced by row number
			'add_button'    => esc_html__( 'Add Another Plot', 'dh' ),
			'remove_button' => esc_html__( 'Remove Plot', 'dh' ),
			'sortable'      => true, // beta
			// 'closed'     => true, // true to have the groups closed by default
		),
	) );


	$dh_site->add_group_field( $dh_plots, array(
		'name'       => esc_html__( 'Plot Number', 'dh' ),
		'id'         => $prefix . 'plot_number',
		'type'       => 'text_small',
		// 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
	));

	$dh_site->add_group_field( $dh_plots, array(
		'name'       => esc_html__( 'Description', 'dh' ),
		'id'         => $prefix . 'plot-desc',
		'type'       => 'text_medium',
	));

	$dh_site->add_group_field( $dh_plots, array(
		'name'       => esc_html__( 'Value', 'dh' ),
		'id'         => $prefix . 'plot_value',
		'type'       => 'text_small',
	));


	$dh_site->add_group_field( $dh_plots, array(
		'name'             => esc_html__( 'Sale Status', 'dh' ),
		'id'               => $prefix . 'plot_status',
		'type'             => 'select',
		'show_option_none' => true,
		'options'          => array(
			'available' => esc_html__( 'Available', 'dh' ),
			'sstc'   		=> esc_html__( 'SSTC', 'dh' ),
			'sold'     	=> esc_html__( 'SOLD', 'dh' ),
		),
	));


	/*
	 *
	 * Repeatable Plot Groups -- END
	 *
	 */


	$dh_site->add_field( array(
		'name'    => 'Site Location Introduction',
		'id'      => $prefix . 'area_intro',
		'type'    => 'wysiwyg',

		'options' => array(

			// https://codex.wordpress.org/Function_Reference/wp_editor

			'textarea_rows' => 8,
			'teeny' => true,
		),

		'before_row'  => '<div class="site-area-section"><h4>Area Details</h4><div class="row area-options">',
		'classes'			=> 'eight columns',
	) );

	$dh_site->add_field( array(
		'name'       => __( 'Area Information', 'cmb2' ),
		'id'         => $prefix . 'area_info',
		'type'       => 'select',
		'options_cb' => 'dh_area_cpt_list',
		'before_row'  => '<div class="four columns">',
		
	) );


	$dh_site->add_field( array(
		'name' => esc_html__( 'OS Coordinates', 'dh' ),
		'desc' => esc_html__( 'eg. 52.471420, -1.946139', 'dh'),
		'id'   => $prefix . 'site_map',
		'type' => 'text_medium',
		
		'after_row'   => '</div></div>'

	) );





	/***** Repeatable Group: START Key Distances *****/


	$dh_dist = $dh_site->add_field( array(
		'id'          => $prefix . 'distance',
		'type'        => 'group',
		'description' => esc_html__( 'Key Distances', 'dh' ),
		'options'     => array(
			'group_title'   => esc_html__( 'Location: {#}', 'dh' ), // {#} gets replaced by row number
			'add_button'    => esc_html__( 'Add Another Location', 'dh' ),
			'remove_button' => esc_html__( 'Remove Location', 'dh' ),
			'sortable'      => true, // beta
			'closed'     		=> false, // true to have the groups closed by default

		),
	) );

	$dh_site->add_group_field( $dh_dist, array(
		'name'       => esc_html__( 'Name', 'dh' ),
		'id'         => $prefix . 'location_name',
		'type'       => 'text_medium',
	));

	$dh_site->add_group_field( $dh_dist, array(
		'name'       => esc_html__( 'Distance', 'dh' ),
		'id'         => $prefix . 'location_distance',
		'type'       => 'text_small',
	));

	/***** Repeatable Group: END Key Distances *******/



	$dh_site->add_field( array(
		'name' => esc_html__( 'Show Reserve Buyer Option', 'dh' ),
		'id'   => $prefix . 'show_reserve_buyer',
		'type' => 'checkbox',
		'before_row'  => '<p><a href="http://sites.psu.edu/symbolcodes/accents/math/mathchart/#fractions/">Handy Fraction HTML References</a></p><div class="mb-ftr-section"><h4>Toggle Options</h4><div class="row toggle-options">',
		'classes'			=> 'four columns',
		'after_row' 	=> '</div></div>'
		
	) );


	$dh_site->add_field( array(
		'name'    => __( 'Specification Features', 'cmb2' ),
		'desc'    => __( 'Drag posts from the left column to the right column to attach them to this page.<br />You may rearrange the order of the posts in the right column by dragging and dropping.', 'cmb2' ),
		'id'      => $prefix . 'site_spec',
		'type'    => 'custom_attached_posts',
		'options' => array(
			'show_thumbnails' => true, // Show thumbnails on the left
			'filter_boxes'    => true, // Show a text box for filtering the results
			'query_args'      => array(
				'posts_per_page' => 10,
				'post_type'      => 'dnh_cpt_spec',
			), // override the get_posts args
		),
	) );


	// $dh_site->add_field( array(
	// 	'name'         => 'Testing Field Parameters',
	// 	'id'           => $prefix . 'parameters',
	// 	'type'         => 'text',
	// 	'before_row'   => 'dh_before_row_if_2', // callback.
	// 	'before'       => '<p>Testing <b>"before"</b> parameter</p>',
	// 	'before_field' => '<p>Testing <b>"before_field"</b> parameter</p>',
	// 	'after_field'  => '<p>Testing <b>"after_field"</b> parameter</p>',
	// 	'after'        => '<p>Testing <b>"after"</b> parameter</p>',
	// 	'after_row'    => '<p>Testing <b>"after_row"</b> parameter</p>',
	// ) );

}





/**
 * Hook in and add a metabox to add fields to taxonomy terms
 */
function dh_register_taxonomy_metabox() {
	$prefix = 'dh_term_';

	/**
	 * Metabox to add fields to categories and tags
	 */
	$cmb_term = new_cmb2_box( array(
		'id'               => $prefix . 'edit',
		'title'            => esc_html__( 'Category Metabox', 'dh' ), // Doesn't output for term boxes
		'object_types'     => array( 'term' ), // Tells CMB2 to use term_meta vs post_meta
		'taxonomies'       => array( 'category', 'post_tag' ), // Tells CMB2 which taxonomies should have these fields
		// 'new_term_section' => true, // Will display in the "Add New Category" section
	) );

	$cmb_term->add_field( array(
		'name'     => esc_html__( 'Extra Info', 'dh' ),
		'desc'     => esc_html__( 'field description (optional)', 'dh' ),
		'id'       => $prefix . 'extra_info',
		'type'     => 'title',
		'on_front' => false,
	) );

	$cmb_term->add_field( array(
		'name' => esc_html__( 'Term Image', 'dh' ),
		'desc' => esc_html__( 'field description (optional)', 'dh' ),
		'id'   => $prefix . 'avatar',
		'type' => 'file',
	) );

	$cmb_term->add_field( array(
		'name' => esc_html__( 'Arbitrary Term Field', 'dh' ),
		'desc' => esc_html__( 'field description (optional)', 'dh' ),
		'id'   => $prefix . 'term_text_field',
		'type' => 'text',
	) );

}

add_action( 'cmb2_admin_init', 'dh_register_theme_options_metabox' );
/**
 * Hook in and register a metabox to handle a theme options page
 */
function dh_register_theme_options_metabox() {

	$option_key = 'dh_theme_options';

	/**
	 * Metabox for an options page. Will not be added automatically, but needs to be called with
	 * the `cmb2_metabox_form` helper function. See https://github.com/CMB2/CMB2/wiki for more info.
	 */
	$cmb_options = new_cmb2_box( array(
		'id'      => $option_key . 'page',
		'title'   => esc_html__( 'Theme Options Metabox', 'dh' ),
		'hookup'  => false, // Do not need the normal user/post hookup.
		'show_on' => array(
			// These are important, don't remove.
			'key'   => 'options-page',
			'value' => array( $option_key ),
		),
	) );

	/**
	 * Options fields ids only need
	 * to be unique within this option group.
	 * Prefix is not needed.
	 */
	$cmb_options->add_field( array(
		'name'    => esc_html__( 'Site Background Color', 'dh' ),
		'desc'    => esc_html__( 'field description (optional)', 'dh' ),
		'id'      => 'bg_color',
		'type'    => 'colorpicker',
		'default' => '#ffffff',
	) );

}

/**
 * Only show this box in the CMB2 REST API if the user is logged in.
 *
 * @param  bool                 $is_allowed     Whether this box and its fields are allowed to be viewed.
 * @param  CMB2_REST_Controller $cmb_controller The controller object.
 *                                              CMB2 object available via `$cmb_controller->rest_box->cmb`.
 *
 * @return bool                 Whether this box and its fields are allowed to be viewed.
 */
function dh_limit_rest_view_to_logged_in_users( $is_allowed, $cmb_controller ) {
	if ( ! is_user_logged_in() ) {
		$is_allowed = false;
	}

	return $is_allowed;
}

