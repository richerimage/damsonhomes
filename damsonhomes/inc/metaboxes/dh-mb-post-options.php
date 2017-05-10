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


add_action( 'cmb2_admin_init', 'dh_post_options_metabox' );



function dh_post_options_metabox() {
  $prefix = 'dh_';


  $dh_post_option = new_cmb2_box( array(
    'id'            => $prefix . 'post_options_metabox',
    'title'         => esc_html__( 'Post Options', 'dh' ),
    'object_types'  => array('post', 'page'),
    'context'       => 'normal',
    'priority'      => 'high',
    'show_names'    => true,
    'classes'       => 'dh-mb dh-post-options-mb',
  ) );

  $dh_post_option->add_field( array(
    'name' => esc_html__( 'Hide Havigation', 'dh' ),
    'id'   => $prefix . 'hide_nav',
    'type' => 'checkbox',
  ) );

  $dh_post_option->add_field( array(
    'name' => esc_html__( 'Art Direction CSS', 'dh' ),
    'id'   => $prefix . 'post_css',
    'type' => 'textarea_code',
  ) );

  $dh_post_option->add_field( array(
    'name' => esc_html__( 'Post jQuery', 'dh' ),
    'id'   => $prefix . 'post_js',
    'type' => 'textarea_code',
  ) );


}




