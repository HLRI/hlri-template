<?php

function Staff()
{
  register_taxonomy('staff', 'agents', array(
    'hierarchical' => true,
    'labels' => array(
      'name' => _x('Staffs', 'taxonomy general name'),
      'singular_name' => _x('Staff', 'taxonomy singular name'),
      'search_items' =>  __('Search Staff'),
      'all_items' => __('All Staff'),
      'parent_item' => __('Parent Staff'),
      'parent_item_colon' => __('Parent Staff:'),
      'edit_item' => __('Edit Staff'),
      'update_item' => __('Update Staff'),
      'add_new_item' => __('Add New Staff'),
      'new_item_name' => __('New Staff Name'),
      'menu_name' => __('Staffs'),
    ),
    'rewrite' => array(
      'slug' => 'staff',
      'with_front' => false,
      'hierarchical' => false
    ),
  ));
}
add_action('init', 'Staff', 0);


function Stage()
{
  register_taxonomy('stage', 'properties', array(
    'hierarchical' => true,
    'labels' => array(
      'name' => _x('Stages', 'taxonomy general name'),
      'singular_name' => _x('Stage', 'taxonomy singular name'),
      'search_items' =>  __('Search Stage'),
      'all_items' => __('All Stage'),
      'parent_item' => __('Parent Stage'),
      'parent_item_colon' => __('Parent Stage:'),
      'edit_item' => __('Edit Stage'),
      'update_item' => __('Update Stage'),
      'add_new_item' => __('Add New Stage'),
      'new_item_name' => __('New Stage Name'),
      'menu_name' => __('Stages'),
    ),
    'rewrite' => array(
      'slug' => 'stage',
      'with_front' => false,
      'hierarchical' => false
    ),
  ));
}
add_action('init', 'Stage', 0);


function Type()
{
  register_taxonomy('type', 'properties', array(
    'hierarchical' => true,
    'labels' => array(
      'name' => _x('Types', 'taxonomy general name'),
      'singular_name' => _x('Type', 'taxonomy singular name'),
      'search_items' =>  __('Search Type'),
      'all_items' => __('All Type'),
      'parent_item' => __('Parent Type'),
      'parent_item_colon' => __('Parent Type:'),
      'edit_item' => __('Edit Type'),
      'update_item' => __('Update Type'),
      'add_new_item' => __('Add New Type'),
      'new_item_name' => __('New Type Name'),
      'menu_name' => __('Types'),
    ),
    'rewrite' => array(
      'slug' => 'type',
      'with_front' => false,
      'hierarchical' => false
    ),
  ));
}
add_action('init', 'Type', 0);


function City()
{
  register_taxonomy('city', 'properties', array(
    'hierarchical' => true,
    'labels' => array(
      'name' => _x('Cities', 'taxonomy general name'),
      'singular_name' => _x('City', 'taxonomy singular name'),
      'search_items' =>  __('Search City'),
      'all_items' => __('All City'),
      'parent_item' => __('Parent City'),
      'parent_item_colon' => __('Parent City:'),
      'edit_item' => __('Edit City'),
      'update_item' => __('Update City'),
      'add_new_item' => __('Add New City'),
      'new_item_name' => __('New City Name'),
      'menu_name' => __('Cities'),
    ),
    'rewrite' => array(
      'slug' => 'city',
      'with_front' => false,
      'hierarchical' => false
    ),
  ));
}
add_action('init', 'City', 0);


function Neighborhood ()
{
  register_taxonomy('neighborhood', 'properties', array(
    'hierarchical' => true,
    'labels' => array(
      'name' => _x('Neighborhoods', 'taxonomy general name'),
      'singular_name' => _x('Neighborhood', 'taxonomy singular name'),
      'search_items' =>  __('Search Neighborhood'),
      'all_items' => __('All Neighborhood'),
      'parent_item' => __('Parent Neighborhood'),
      'parent_item_colon' => __('Parent Neighborhood:'),
      'edit_item' => __('Edit Neighborhood'),
      'update_item' => __('Update Neighborhood'),
      'add_new_item' => __('Add New Neighborhood'),
      'new_item_name' => __('New Neighborhood Name'),
      'menu_name' => __('Neighborhoods'),
    ),
    'rewrite' => array(
      'slug' => 'neighborhood',
      'with_front' => false,
      'hierarchical' => false
    ),
  ));
}
add_action('init', 'Neighborhood', 0);


function group ()
{
  register_taxonomy('group', 'properties', array(
    'hierarchical' => true,
    'labels' => array(
      'name' => _x('Groups', 'taxonomy general name'),
      'singular_name' => _x('Group', 'taxonomy singular name'),
      'search_items' =>  __('Search Group'),
      'all_items' => __('All Group'),
      'parent_item' => __('Parent Group'),
      'parent_item_colon' => __('Parent Group:'),
      'edit_item' => __('Edit Group'),
      'update_item' => __('Update Group'),
      'add_new_item' => __('Add New Group'),
      'new_item_name' => __('New Group Name'),
      'menu_name' => __('Groups'),
    ),
    'rewrite' => array(
      'slug' => 'group',
      'with_front' => false,
      'hierarchical' => false
    ),
  ));
}
add_action('init', 'group', 0);