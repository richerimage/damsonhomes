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


if ( file_exists( get_template_directory() . '/inc/classes/cmb2/init.php' ) ) {
	require_once get_template_directory() . '/inc/classes/cmb2/init.php';
} elseif ( file_exists( get_template_directory() . '/inc/classes/cmb2/init.php' ) ) {
	require_once get_template_directory() . '/inc/classes/cmb2/init.php';
}


add_action( 'cmb2_admin_init', 'dh_area_metabox' );



function dh_area_metabox() {
	$prefix = 'dh_';


	$dh_area = new_cmb2_box( array(
		'id'            => $prefix . 'area_metabox',
		'title'         => esc_html__( 'Area Meta', 'dh' ),
		'object_types'  => array( 'dnh_cpt_area' ), // Post type
		'context'    		=> 'normal',
		'priority'   		=> 'high',
		'show_names' 		=> true,
		'classes'    		=> 'dh-mb dh-area-mb',
	) );

	https://www.schoolguide.co.uk/secondary-schools/Edgbaston


	$dh_area->add_field( array(
		'name' => esc_html__( 'Local Authority', 'dh' ),
		'id'   => $prefix . 'council',
		'type' => 'text_medium',
	) );

	$dh_area->add_field( array(
		'name' => esc_html__( 'LA Phone Number', 'dh' ),
		'id'   => $prefix . 'council_tel',
		'type' => 'text_medium',
	) );

	$dh_area->add_field( array(
		'name' => esc_html__( 'LA Email', 'dh' ),
		'id'   => $prefix . 'council_email',
		'type' => 'text_medium',
	) );

	$dh_area->add_field( array(
		'name' => esc_html__( 'LA URL', 'dh' ),
		'id'   => $prefix . 'council_url',
		'type' => 'text_medium',
	) );


	$dh_area->add_field( array(
		'name' => esc_html__( 'School List', 'dh' ),
		'desc' => esc_html__( 'https://schoolguide.co.uk/&hellip;' , 'dh'),
		'id'   => $prefix . 'school_list',
		'type' => 'text_url',
	) );


	/***** Repeatable Group: START Damson Picks *****/


	$dh_picks = $dh_area->add_field( array(
		'id'          => $prefix . 'area_picks',
		'type'        => 'group',
		'description' => esc_html__( 'Damson Picks', 'dh' ),
		'options'     => array(
			'group_title'   => esc_html__( 'Damson Pick: {#}', 'dh' ), // {#} gets replaced by row number
			'add_button'    => esc_html__( 'Add Another Pick', 'dh' ),
			'remove_button' => esc_html__( 'Remove Pick', 'dh' ),
			'sortable'      => true, // beta
			'closed'     		=> false, // true to have the groups closed by default

		),
	) );

	$dh_area->add_group_field( $dh_picks, array(
		'name'       => esc_html__( 'Name', 'dh' ),
		'id'         => $prefix . 'pick_name',
		'type'       => 'text_medium',
	));

	$dh_area->add_group_field( $dh_picks, array(
		'name'       => esc_html__( 'URL', 'dh' ),
		'id'         => $prefix . 'pick_url',
		'type'       => 'text_url',
	));

	$dh_area->add_group_field( $dh_picks, array(
		'name'       => esc_html__( 'Description', 'dh' ),
		'id'         => $prefix . 'pick_desc',
		'type'       => 'text_medium',
	));

	/***** Repeatable Group: END Damson Picks *******/

	/***** Repeatable Group: START Schools *****/


	$dh_schools = $dh_area->add_field( array(
		'id'          => $prefix . 'area_schools',
		'type'        => 'group',
		'description' => esc_html__( 'Schooling', 'dh' ),
		'options'     => array(
			'group_title'   => esc_html__( 'School: {#}', 'dh' ), // {#} gets replaced by row number
			'add_button'    => esc_html__( 'Add Another School', 'dh' ),
			'remove_button' => esc_html__( 'Remove School', 'dh' ),
			'sortable'      => true, // beta
			'closed'     		=> false, // true to have the groups closed by default

		),
	) );

	$dh_area->add_group_field( $dh_schools, array(
		'name'       => esc_html__( 'Name', 'dh' ),
		'id'         => $prefix . 'school_name',
		'type'       => 'text_medium',
	));

	$dh_area->add_group_field( $dh_schools, array(
		'name'       => esc_html__( 'URL', 'dh' ),
		'id'         => $prefix . 'school_url',
		'type'       => 'text_url',
	));

	$dh_area->add_group_field( $dh_schools, array(
		'name'       => esc_html__( 'Description', 'dh' ),
		'id'         => $prefix . 'school_desc',
		'type'       => 'text_medium',
	));

	/***** Repeatable Group: END Schools *******/


}




