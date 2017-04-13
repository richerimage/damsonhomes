<?php

function custom_post_type_areas() {

  $name     = 'Area';
  $names    = 'Areas';
  $cpt_slug = 'area';
  $icon     = 'dashicons-location';
  $cpt_key  = 'dnh_cpt_area';
  $title    = 'Where we\'re building';
  $desc     = 'Lorium ipsum';


  $labels = array(
      'name' => $names,
      'singular_name' => $name,
      'add_new' => 'Add New ' . $name,
      'all_items' => 'All ' . $names,
      'add_new_item' => 'Add New ' . $name,
      'edit_item' => 'Edit ' . $name,
      'new_item' => 'New ' . $name,
      'view_item' => 'View ' . $names,
      'search_items' => 'Search ' . $names,
      'not_found' =>  'Not found in ' . $names,
      'not_found_in_trash' => 'Not found in ' . $names . 'trash',
      'parent_item_colon' => 'Parent' . $name . ':',
      'menu_name' => $names
    );

    $args = array(
      'label'                 =>  'Areas',
      'description'           =>  'Where we are building',
      'labels'                =>  $labels,
      'supports'              =>  array(
                                    'title',
                                    'editor',
                                    'thumbnail',
                                    'excerpt',
                                    'custom-fields',
                                    'revisions',
                                    'post-formats', 
                                    'page-attributes'
                                  ),
      'taxonomies'            =>  array( 'category', 'post_tag' ),
      'hierarchical'          =>  false,
      'public'                =>  true,
      'show_ui'               =>  true,
      'show_in_menu'          =>  true,
      'menu_position'         =>  22,
      'menu_icon'             => $icon,
      'show_in_admin_bar'     =>  true,
      'show_in_nav_menus'     =>  true,
      'can_export'            =>  true,
      'has_archive'           =>  true,
      'rewrite'               => array(
                                  'slug' => $cpt_slug
                                ),    
      'exclude_from_search'   =>  false,
      'publicly_queryable'    =>  true,
      'capability_type'       =>  'page',
    );

    register_post_type($cpt_key, $args);

}

add_action( 'init', 'custom_post_type_areas', 0 );