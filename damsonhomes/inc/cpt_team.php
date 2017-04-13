<?php

function custom_post_type_team() {

  $name     = 'Team Member';
  $names    = 'Team Members';
  $cpt_slug = 'team';
  $icon     = 'dashicons-groups';
  $cpt_key  = 'dnh_cpt_team';
  $title    = 'The Team: ';
  $desc     = 'Our homes are made by the best people we can find.';


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
      'label'                 =>  'Team Damson',
      'description'           =>  'Our homes are made by the best people we can find.',
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
      'hierarchical'          =>  false,
      'public'                =>  true,
      'show_ui'               =>  true,
      'show_in_menu'          =>  true,
      'menu_position'         =>  23,
      'menu_icon'             => $icon,
      'show_in_admin_bar'     =>  false,
      'show_in_nav_menus'     =>  true,
      'can_export'            =>  true,
      'has_archive'           =>  false,
      'rewrite'               => array(
                                  'slug' => $cpt_slug
                                ),    
      'exclude_from_search'   =>  false,
      'publicly_queryable'    =>  true,
      'capability_type'       =>  'page',
    );

    register_post_type($cpt_key, $args);

}

add_action( 'init', 'custom_post_type_team', 0 );