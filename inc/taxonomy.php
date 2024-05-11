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


//function Stage()
//{
//  register_taxonomy('stage', 'properties', array(
//    'hierarchical' => true,
//    'labels' => array(
//      'name' => _x('Stages', 'taxonomy general name'),
//      'singular_name' => _x('Stage', 'taxonomy singular name'),
//      'search_items' =>  __('Search Stage'),
//      'all_items' => __('All Stage'),
//      'parent_item' => __('Parent Stage'),
//      'parent_item_colon' => __('Parent Stage:'),
//      'edit_item' => __('Edit Stage'),
//      'update_item' => __('Update Stage'),
//      'add_new_item' => __('Add New Stage'),
//      'new_item_name' => __('New Stage Name'),
//      'menu_name' => __('Stages'),
//    ),
//    'rewrite' => array(
//      'slug' => 'stage',
//      'with_front' => false,
//      'hierarchical' => false
//    ),
//  ));
//}
//add_action('init', 'Stage', 0);
//
//
//function Type()
//{
//  register_taxonomy('type', 'properties', array(
//    'hierarchical' => true,
//    'labels' => array(
//      'name' => _x('Types', 'taxonomy general name'),
//      'singular_name' => _x('Type', 'taxonomy singular name'),
//      'search_items' =>  __('Search Type'),
//      'all_items' => __('All Type'),
//      'parent_item' => __('Parent Type'),
//      'parent_item_colon' => __('Parent Type:'),
//      'edit_item' => __('Edit Type'),
//      'update_item' => __('Update Type'),
//      'add_new_item' => __('Add New Type'),
//      'new_item_name' => __('New Type Name'),
//      'menu_name' => __('Types'),
//    ),
//    'rewrite' => array(
//      'slug' => 'type',
//      'with_front' => false,
//      'hierarchical' => false
//    ),
//  ));
//}
//add_action('init', 'Type', 0);


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
      'public'       => true,
      'show_ui'      => true,
      'show_in_menu' => true,
    'rewrite' => array(
      'slug' => 'city',
      'with_front' => false,
      'hierarchical' => true
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


function salesteam ()
{
  register_taxonomy('sales-team', 'properties', array(
    'hierarchical' => true,
    'labels' => array(
      'name' => _x('Sales Team', 'taxonomy general name'),
      'singular_name' => _x('Sales Team', 'taxonomy singular name'),
      'search_items' =>  __('Search Sales Team'),
      'all_items' => __('All Sales Team'),
      'parent_item' => __('Parent Sales Team'),
      'parent_item_colon' => __('Parent Sales Team:'),
      'edit_item' => __('Edit Sales Team'),
      'update_item' => __('Update Sales Team'),
      'add_new_item' => __('Add New Sales Team'),
      'new_item_name' => __('New Sales Team Name'),
      'menu_name' => __('Sales Team'),
    ),
    'rewrite' => array(
      'slug' => 'sales-team',
      'with_front' => false,
      'hierarchical' => false
    ),
  ));
}
add_action('init', 'salesteam', 0);

function register_communities_taxonomy()
{
    register_taxonomy('communities', 'properties', array(
        'hierarchical' => true,
        'labels' => array(
            'name' => _x('Communities', 'taxonomy general name'),
            'singular_name' => _x('Community', 'taxonomy singular name'),
            'search_items' =>  __('Search Communities'),
            'all_items' => __('All Communities'),
            'parent_item' => __('Parent Community'),
            'parent_item_colon' => __('Parent Community:'),
            'edit_item' => __('Edit Community'),
            'update_item' => __('Update Community'),
            'add_new_item' => __('Add New Community'),
            'new_item_name' => __('New Community Name'),
            'menu_name' => __('Communities'),
        ),
        'rewrite' => array(
            'slug' => 'communities',
            'with_front' => false,
            'hierarchical' => false
        ),
    ));
}

add_action('init', 'register_communities_taxonomy', 0);

















// Add field to City taxonomy
function add_city_custom_field() {
    ?>
    <div class="form-field">
        <label for="term_meta[alternative_keywords]"><?php _e('Alternative Keywords', 'text_domain'); ?></label>
        <textarea name="term_meta[alternative_keywords]" id="term_meta[alternative_keywords]" rows="5" cols="40"></textarea>
        <p class="description"><?php _e('Enter alternative keywords separated by commas', 'text_domain'); ?></p>
    </div>
    <?php
}
add_action('city_add_form_fields', 'add_city_custom_field', 10, 2);

function edit_city_custom_field($term) {
    $term_id = $term->term_id;
    $term_meta = get_option("taxonomy_$term_id");
    ?>
    <tr class="form-field">
        <th scope="row" valign="top"><label for="term_meta[alternative_keywords]"><?php _e('Alternative Keywords', 'text_domain'); ?></label></th>
        <td>
            <textarea name="term_meta[alternative_keywords]" id="term_meta[alternative_keywords]" rows="5" cols="40"><?php echo isset($term_meta['alternative_keywords']) ? esc_attr($term_meta['alternative_keywords']) : ''; ?></textarea>
            <p class="description"><?php _e('Enter alternative keywords separated by commas', 'text_domain'); ?></p>
        </td>
    </tr>
    <?php
}
add_action('city_edit_form_fields', 'edit_city_custom_field', 10, 2);

// Similar functions for other taxonomies: Neighborhood, Group, and Developer






// Save custom field when term is edited
function save_city_custom_field($term_id) {
    if (isset($_POST['term_meta'])) {
        $term_meta = get_option("taxonomy_$term_id");
        $term_meta['alternative_keywords'] = sanitize_text_field($_POST['term_meta']['alternative_keywords']);
        update_option("taxonomy_$term_id", $term_meta);
    }
}
add_action('edited_city', 'save_city_custom_field', 10, 2);

// Save custom field when term is created
function save_new_city_custom_field($term_id) {
    if (isset($_POST['term_meta'])) {
        $term_meta['alternative_keywords'] = sanitize_text_field($_POST['term_meta']['alternative_keywords']);
        update_option("taxonomy_$term_id", $term_meta);
    }
}
add_action('create_city', 'save_new_city_custom_field', 10, 2);

// Similar functions for other taxonomies: Neighborhood, Group, and Developer

