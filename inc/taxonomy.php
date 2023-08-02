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



function developer ()
{
  register_taxonomy('developer', 'properties', array(
    'hierarchical' => true,
    'labels' => array(
      'name' => _x('Developers', 'taxonomy general name'),
      'singular_name' => _x('Developer', 'taxonomy singular name'),
      'search_items' =>  __('Search Developer'),
      'all_items' => __('All Developer'),
      'parent_item' => __('Parent Developer'),
      'parent_item_colon' => __('Parent Developer:'),
      'edit_item' => __('Edit Developer'),
      'update_item' => __('Update Developer'),
      'add_new_item' => __('Add New Developer'),
      'new_item_name' => __('New Developer Name'),
      'menu_name' => __('Developers'),
    ),
    'rewrite' => array(
      'slug' => 'developer',
      'with_front' => false,
      'hierarchical' => false
    ),
  ));
}
add_action('init', 'developer', 0);


// Add meta box for Sales Team taxonomy to Properties edit page
function add_sales_team_meta_box() {
    add_meta_box(
        'sales_team_meta_box',
        'Sales Team',
        'display_sales_team_meta_box',
        'properties',
        'side',
        'default'
    );
}
add_action('add_meta_boxes', 'add_sales_team_meta_box');

// Display the meta box content
function display_sales_team_meta_box($post) {
    $terms = get_terms('sales-team', array('hide_empty' => false));
    $current_team = get_post_meta($post->ID, '_sales_team', true);

    echo '<label for="sales_team_select">Select a Sales Team:</label>';
    echo '<input type="text" id="sales_team_search" placeholder="Search Sales Team" />';
    echo '<select name="sales_team_select" id="sales_team_select">';
    echo '<option value="">None</option>';
    foreach ($terms as $term) {
        echo '<option value="' . $term->term_id . '"';
        if ($current_team == $term->term_id) {
            echo ' selected';
        }
        echo '>' . $term->name . '</option>';
    }
    echo '</select>';
    ?>
    <script>
        jQuery(document).ready(function($) {
            $('#sales_team_search').on('keyup', function() {
                var searchTerm = $(this).val().toLowerCase();
                $('#sales_team_select option').each(function() {
                    var optionText = $(this).text().toLowerCase();
                    if (optionText.indexOf(searchTerm) !== -1) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });

            $('#sales_team_search').on('input', function() {
                if ($(this).val() === '') {
                    $('#sales_team_select option').show();
                }
            });
        });
    </script>
    <?php
}

// Save the selected sales team when updating the property
function save_sales_team_meta($post_id) {
    if (isset($_POST['sales_team_select'])) {
        $sales_team_id = sanitize_text_field($_POST['sales_team_select']);
        update_post_meta($post_id, '_sales_team', $sales_team_id);
    }
}
add_action('save_post_properties', 'save_sales_team_meta');
