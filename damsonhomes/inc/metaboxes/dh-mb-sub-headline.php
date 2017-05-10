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


add_action( 'cmb2_admin_init', 'dh_sub_headline_metabox' );



function dh_sub_headline_metabox() {

  $prefix = 'dh_';

  $post_types = get_post_types('', 'names');


  $dh_subhead = new_cmb2_box( array(
    'id'            => $prefix . 'sub_headline_metabox',
    'title'         => esc_html__( 'Sub Headline', 'dh' ),
    'object_types'  => array('post', 'page'), // Post type
    'context'       => 'normal',
    'priority'      => 'high',
    'show_names'    => true,
    'classes'       => 'dh-mb dh-subhead-mb',
  ) );



  $dh_subhead->add_field( array(
    'name' => esc_html__( 'Subheadline', 'dh' ),
    'id'   => $prefix . 'subhead',
    'type' => 'text',
  ) );



}