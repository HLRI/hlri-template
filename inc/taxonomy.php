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

function property_tags() {
    register_taxonomy('property_tag', 'properties', array(
        'hierarchical' => false,
        'labels' => array(
            'name' => _x('Tags', 'taxonomy general name'),
            'singular_name' => _x('Tag', 'taxonomy singular name'),
            'search_items' => __('Search Tags'),
            'all_items' => __('All Tags'),
            'edit_item' => __('Edit Tag'),
            'update_item' => __('Update Tag'),
            'add_new_item' => __('Add New Tag'),
            'new_item_name' => __('New Tag Name'),
            'menu_name' => __('Tags'),
        ),
        'rewrite' => array(
            'slug' => 'property-tag',
            'with_front' => false,
            'hierarchical' => false
        ),
    ));
}
add_action('init', 'property_tags', 0);


add_action('init', function () {
    register_taxonomy('property-tag', 'property', [
        'label' => 'Property Tags',
        'rewrite' => ['slug' => 'property-tag'],
        'hierarchical' => false,
    ]);
});


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
    $alternative_keywords = get_term_meta($term_id, 'alternative_keywords', true);
    ?>
    <tr class="form-field">
        <th scope="row" valign="top"><label for="term_meta[alternative_keywords]"><?php _e('Alternative Keywords', 'text_domain'); ?></label></th>
        <td>
            <textarea name="term_meta[alternative_keywords]" id="term_meta[alternative_keywords]" rows="5" cols="40"><?php echo esc_textarea($alternative_keywords); ?></textarea>
            <p class="description"><?php _e('Enter alternative keywords separated by commas', 'text_domain'); ?></p>
        </td>
    </tr>
    <?php
}
add_action('city_edit_form_fields', 'edit_city_custom_field', 10, 2);

// Save custom field when term is edited or created
function save_city_custom_field($term_id) {
    if (isset($_POST['term_meta']['alternative_keywords'])) {
        // Custom sanitization function to allow % character
        function custom_sanitize_keywords($input) {
            return str_replace(array('%'), array('\%'), $input);
        }

        $alternative_keywords = custom_sanitize_keywords($_POST['term_meta']['alternative_keywords']);
        update_term_meta($term_id, 'alternative_keywords', $alternative_keywords);
    }
}
add_action('edited_city', 'save_city_custom_field', 10, 2);
add_action('create_city', 'save_city_custom_field', 10, 2);

// Similarly update for Developer, Group, and Neighborhood taxonomies
// Add field to Developer taxonomy
function add_developer_custom_field() {
    ?>
    <div class="form-field">
        <label for="term_meta[alternative_keywords]"><?php _e('Alternative Keywords', 'text_domain'); ?></label>
        <textarea name="term_meta[alternative_keywords]" id="term_meta[alternative_keywords]" rows="5" cols="40"></textarea>
        <p class="description"><?php _e('Enter alternative keywords separated by commas', 'text_domain'); ?></p>
    </div>
    <?php
}
add_action('developer_add_form_fields', 'add_developer_custom_field', 10, 2);

function edit_developer_custom_field($term) {
    $term_id = $term->term_id;
    $alternative_keywords = get_term_meta($term_id, 'alternative_keywords', true);
    ?>
    <tr class="form-field">
        <th scope="row" valign="top"><label for="term_meta[alternative_keywords]"><?php _e('Alternative Keywords', 'text_domain'); ?></label></th>
        <td>
            <textarea name="term_meta[alternative_keywords]" id="term_meta[alternative_keywords]" rows="5" cols="40"><?php echo esc_textarea($alternative_keywords); ?></textarea>
            <p class="description"><?php _e('Enter alternative keywords separated by commas', 'text_domain'); ?></p>
        </td>
    </tr>
    <?php
}
add_action('developer_edit_form_fields', 'edit_developer_custom_field', 10, 2);

// Save custom field when term is edited or created
function save_developer_custom_field($term_id) {
    if (isset($_POST['term_meta']['alternative_keywords'])) {
        // Custom sanitization function to allow % character
        function custom_sanitize_keywords($input) {
            return str_replace(array('%'), array('\%'), $input);
        }

        $alternative_keywords = custom_sanitize_keywords($_POST['term_meta']['alternative_keywords']);
        update_term_meta($term_id, 'alternative_keywords', $alternative_keywords);
    }
}
add_action('edited_developer', 'save_developer_custom_field', 10, 2);
add_action('create_developer', 'save_developer_custom_field', 10, 2);

// Add field to Group taxonomy
function add_group_custom_field() {
    ?>
    <div class="form-field">
        <label for="term_meta[alternative_keywords]"><?php _e('Alternative Keywords', 'text_domain'); ?></label>
        <textarea name="term_meta[alternative_keywords]" id="term_meta[alternative_keywords]" rows="5" cols="40"></textarea>
        <p class="description"><?php _e('Enter alternative keywords separated by commas', 'text_domain'); ?></p>
    </div>
    <?php
}
add_action('group_add_form_fields', 'add_group_custom_field', 10, 2);

function edit_group_custom_field($term) {
    $term_id = $term->term_id;
    $alternative_keywords = get_term_meta($term_id, 'alternative_keywords', true);
    ?>
    <tr class="form-field">
        <th scope="row" valign="top"><label for="term_meta[alternative_keywords]"><?php _e('Alternative Keywords', 'text_domain'); ?></label></th>
        <td>
            <textarea name="term_meta[alternative_keywords]" id="term_meta[alternative_keywords]" rows="5" cols="40"><?php echo esc_textarea($alternative_keywords); ?></textarea>
            <p class="description"><?php _e('Enter alternative keywords separated by commas', 'text_domain'); ?></p>
        </td>
    </tr>
    <?php
}
add_action('group_edit_form_fields', 'edit_group_custom_field', 10, 2);

// Save custom field when term is edited or created
function save_group_custom_field($term_id) {
    if (isset($_POST['term_meta']['alternative_keywords'])) {
        // Custom sanitization function to allow % character
        function custom_sanitize_keywords($input) {
            return str_replace(array('%'), array('\%'), $input);
        }

        $alternative_keywords = custom_sanitize_keywords($_POST['term_meta']['alternative_keywords']);
        update_term_meta($term_id, 'alternative_keywords', $alternative_keywords);
    }
}
add_action('edited_group', 'save_group_custom_field', 10, 2);
add_action('create_group', 'save_group_custom_field', 10, 2);

// Add field to Neighborhood taxonomy
function add_neighborhood_custom_field() {
    ?>
    <div class="form-field">
        <label for="term_meta[alternative_keywords]"><?php _e('Alternative Keywords', 'text_domain'); ?></label>
        <textarea name="term_meta[alternative_keywords]" id="term_meta[alternative_keywords]" rows="5" cols="40"></textarea>
        <p class="description"><?php _e('Enter alternative keywords separated by commas', 'text_domain'); ?></p>
    </div>
    <?php
}
add_action('neighborhood_add_form_fields', 'add_neighborhood_custom_field', 10, 2);

function edit_neighborhood_custom_field($term) {
    $term_id = $term->term_id;
    $alternative_keywords = get_term_meta($term_id, 'alternative_keywords', true);
    ?>
    <tr class="form-field">
        <th scope="row" valign="top"><label for="term_meta[alternative_keywords]"><?php _e('Alternative Keywords', 'text_domain'); ?></label></th>
        <td>
            <textarea name="term_meta[alternative_keywords]" id="term_meta[alternative_keywords]" rows="5" cols="40"><?php echo esc_textarea($alternative_keywords); ?></textarea>
            <p class="description"><?php _e('Enter alternative keywords separated by commas', 'text_domain'); ?></p>
        </td>
    </tr>
    <?php
}
add_action('neighborhood_edit_form_fields', 'edit_neighborhood_custom_field', 10, 2);

// Save custom field when term is edited or created
function save_neighborhood_custom_field($term_id) {
    if (isset($_POST['term_meta']['alternative_keywords'])) {
        // Custom sanitization function to allow % character
        function custom_sanitize_keywords($input) {
            return str_replace(array('%'), array('\%'), $input);
        }

        $alternative_keywords = custom_sanitize_keywords($_POST['term_meta']['alternative_keywords']);
        update_term_meta($term_id, 'alternative_keywords', $alternative_keywords);
    }
}
add_action('edited_neighborhood', 'save_neighborhood_custom_field', 10, 2);
add_action('create_neighborhood', 'save_neighborhood_custom_field', 10, 2);


