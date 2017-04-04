<?php

function custom_taxonomy_site_status() {

  $ct_key    = 'dnh_site_status_taxonomy';

  $name     = 'Site Status';
  $names    = "Site Status'";
  $title    = 'Site Status';
  $desc     = '';


  $args = array(
    'public'   => true
  );

  $labels = array(
    'name'                       => _x( $names, 'Taxonomy General Name', 'dnh' ),
    'singular_name'              => _x( $name, 'Taxonomy Singular Name', 'dnh' ),
    'menu_name'                  => __( $name, 'dnh' ),
    'all_items'                  => __( 'All ' . $names, 'dnh' ),
    'parent_item'                => __( 'Parent ' . $name, 'dnh' ),
    'parent_item_colon'          => __( 'Parent ' . $name . ':', 'dnh' ),
    'new_item_name'              => __( 'New ' . $name . ' Name', 'dnh' ),
    'add_new_item'               => __( 'Add New ' . $name, 'dnh' ),
    'edit_item'                  => __( 'Edit ' . $name, 'dnh' ),
    'update_item'                => __( 'Update ' . $name, 'dnh' ),
    'separate_items_with_commas' => __( 'Separate ' . $names . ' with commas', 'dnh' ),
    'search_items'               => __( 'Search ' . $names, 'dnh' ),
    'add_or_remove_items'        => __( 'Add or remove ' . $name, 'dnh' ),
    'choose_from_most_used'      => __( 'Most used ' . $names, 'dnh' ),
    'not_found'                  => __( $name . ' Not Found', 'dnh' ),
  );
  $rewrite = array(
    'slug'                       => 'status',
    'with_front'                 => false,
    'hierarchical'               => false,
  );
  $args = array(
    'labels'                     => $labels,
    'hierarchical'               => true,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => true,
    'rewrite'                    => $rewrite,
  );

    register_taxonomy( $ct_key, array('post', 'page'), $args );


      

}

add_action( 'init', 'custom_taxonomy_site_status', 0 );


function add_status_taxonomy( $post_id ) {

  // you should check if the current user can do this, probably against publish_posts
  // you should also have a nonce check here as well
  
  $taxonomy = ''; # Delete this line?
  $post_terms = wp_get_object_terms( $post_id, $taxonomy );

  if( get_post_meta( $post_id, 'dnh_live', true ) ) {
      wp_set_post_terms( $post_id, 'Live', 'dnh_site_status_taxonomy', true );
  }
  if( get_post_meta( $post_id, 'dnh_portfolio', true ) ) {
      wp_set_post_terms( $post_id, 'Portfolio', 'dnh_site_status_taxonomy', true );
  }
  if( get_post_meta( $post_id, 'dnh_comingsoon', true ) ) {
      wp_set_post_terms( $post_id, 'Coming Soon', 'dnh_site_status_taxonomy', true );
  }

}

add_action( 'save_post', 'add_status_taxonomy' );