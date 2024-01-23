<?php

function agents()
{

    $labels = array(
        'name'                  => _x('Agents', 'agents General Name', 'text_domain'),
        'singular_name'         => _x('agent', 'agent Singular Name', 'text_domain'),
        'menu_name'             => __('Agents', 'text_domain'),
        'name_admin_bar'        => __('agents', 'text_domain'),
        'archives'              => __('Item Archives', 'text_domain'),
        'attributes'            => __('Item Attributes', 'text_domain'),
        'parent_item_colon'     => __('Parent Item:', 'text_domain'),
        'all_items'             => __('All Items', 'text_domain'),
        'add_new_item'          => __('Add New Item', 'text_domain'),
        'add_new'               => __('Add New', 'text_domain'),
        'new_item'              => __('New Item', 'text_domain'),
        'edit_item'             => __('Edit Item', 'text_domain'),
        'update_item'           => __('Update Item', 'text_domain'),
        'view_item'             => __('View Item', 'text_domain'),
        'view_items'            => __('View Items', 'text_domain'),
        'search_items'          => __('Search Item', 'text_domain'),
        'not_found'             => __('Not found', 'text_domain'),
        'not_found_in_trash'    => __('Not found in Trash', 'text_domain'),
        'featured_image'        => __('Featured Image', 'text_domain'),
        'set_featured_image'    => __('Set featured image', 'text_domain'),
        'remove_featured_image' => __('Remove featured image', 'text_domain'),
        'use_featured_image'    => __('Use as featured image', 'text_domain'),
        'insert_into_item'      => __('Insert into item', 'text_domain'),
        'uploaded_to_this_item' => __('Uploaded to this item', 'text_domain'),
        'items_list'            => __('Items list', 'text_domain'),
        'items_list_navigation' => __('Items list navigation', 'text_domain'),
        'filter_items_list'     => __('Filter items list', 'text_domain'),
    );
    $args = array(
        'label'                 => __('Agents', 'text_domain'),
        'description'           => __('agents Description', 'text_domain'),
        'labels'                => $labels,
        'supports'              => ['title', 'excerpt', 'thumbnail'],
        // 'taxonomies'            => array( ''),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'menu_icon'   => 'dashicons-businessman',
    );
    register_post_type('agents', $args);
}
add_action('init', 'agents', 0);


function properties() {
    $labels = array(
        'name'                  => _x('Properties', 'properties General Name', 'text_domain'),
        'singular_name'         => _x('property', 'property Singular Name', 'text_domain'),
        'menu_name'             => __('Properties', 'text_domain'),
        'name_admin_bar'        => __('properties', 'text_domain'),
        'archives'              => __('Item Archives', 'text_domain'),
        'attributes'            => __('Item Attributes', 'text_domain'),
        'parent_item_colon'     => __('Parent Item:', 'text_domain'),
        'all_items'             => __('All Items', 'text_domain'),
        'add_new_item'          => __('Add New Item', 'text_domain'),
        'add_new'               => __('Add New', 'text_domain'),
        'new_item'              => __('New Item', 'text_domain'),
        'edit_item'             => __('Edit Item', 'text_domain'),
        'update_item'           => __('Update Item', 'text_domain'),
        'view_item'             => __('View Item', 'text_domain'),
        'view_items'            => __('View Items', 'text_domain'),
        'search_items'          => __('Search Item', 'text_domain'),
        'not_found'             => __('Not found', 'text_domain'),
        'not_found_in_trash'    => __('Not found in Trash', 'text_domain'),
        'featured_image'        => __('Featured Image', 'text_domain'),
        'set_featured_image'    => __('Set featured image', 'text_domain'),
        'remove_featured_image' => __('Remove featured image', 'text_domain'),
        'use_featured_image'    => __('Use as featured image', 'text_domain'),
        'insert_into_item'      => __('Insert into item', 'text_domain'),
        'uploaded_to_this_item' => __('Uploaded to this item', 'text_domain'),
        'items_list'            => __('Items list', 'text_domain'),
        'items_list_navigation' => __('Items list navigation', 'text_domain'),
        'filter_items_list'     => __('Filter items list', 'text_domain'),

    );

    $args = array(
        'label'                 => __('Properties', 'text_domain'),
        'description'           => __('properties Description', 'text_domain'),
        'labels'                => $labels,
        'supports'              => ['title', 'excerpt', 'editor', 'thumbnail'],
        // 'taxonomies'            => array( ''),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'menu_icon'   => 'dashicons-analytics',
    );

    register_post_type('properties', $args);
}
add_action('init', 'properties', 0);


function floorplans() {
    $labels = array(
        'name'                  => _x('Floorplans', 'floorplans General Name', 'text_domain'),
        'singular_name'         => _x('floorplan', 'floorplan Singular Name', 'text_domain'),
        'menu_name'             => __('Floorplans', 'text_domain'),
        'name_admin_bar'        => __('floorplans', 'text_domain'),
        'archives'              => __('Item Archives', 'text_domain'),
        'attributes'            => __('Item Attributes', 'text_domain'),
        'parent_item_colon'     => __('Parent Item:', 'text_domain'),
        'all_items'             => __('All Items', 'text_domain'),
        'add_new_item'          => __('Add New Item', 'text_domain'),
        'add_new'               => __('Add New', 'text_domain'),
        'new_item'              => __('New Item', 'text_domain'),
        'edit_item'             => __('Edit Item', 'text_domain'),
        'update_item'           => __('Update Item', 'text_domain'),
        'view_item'             => __('View Item', 'text_domain'),
        'view_items'            => __('View Items', 'text_domain'),
        'search_items'          => __('Search Item', 'text_domain'),
        'not_found'             => __('Not found', 'text_domain'),
        'not_found_in_trash'    => __('Not found in Trash', 'text_domain'),
        'featured_image'        => __('Featured Image', 'text_domain'),
        'set_featured_image'    => __('Set featured image', 'text_domain'),
        'remove_featured_image' => __('Remove featured image', 'text_domain'),
        'use_featured_image'    => __('Use as featured image', 'text_domain'),
        'insert_into_item'      => __('Insert into item', 'text_domain'),
        'uploaded_to_this_item' => __('Uploaded to this item', 'text_domain'),
        'items_list'            => __('Items list', 'text_domain'),
        'items_list_navigation' => __('Items list navigation', 'text_domain'),
        'filter_items_list'     => __('Filter items list', 'text_domain'),

    );

    $args = array(
        'label'                 => __('floorplans', 'text_domain'),
        'description'           => __('floorplans Description', 'text_domain'),
        'labels'                => $labels,
        'supports'              => ['title', 'thumbnail'],
        // 'taxonomies'            => array( ''),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'menu_icon'   => 'dashicons-analytics',
    );

    register_post_type('floorplans', $args);
}
add_action('init', 'floorplans', 0);

add_action( 'save_post_properties', 'save_last_update' );
add_action( 'save_post_floorplans', 'save_last_update' );


// Reviews post type 


function reviews_custom_post_type() {
    $labels = array(
        'name'                  => _x('Reviews', 'Post Type General Name', 'text_domain'),
        'singular_name'         => _x('Review', 'Post Type Singular Name', 'text_domain'),
        'menu_name'             => __('Reviews', 'text_domain'),
        'name_admin_bar'        => __('Review', 'text_domain'),
        'archives'              => __('Item Archives', 'text_domain'),
        'attributes'            => __('Item Attributes', 'text_domain'),
        'parent_item_colon'     => __('Parent Item:', 'text_domain'),
        'all_items'             => __('All Items', 'text_domain'),
        'add_new_item'          => __('Add New Item', 'text_domain'),
        'add_new'               => __('Add New', 'text_domain'),
        'new_item'              => __('New Item', 'text_domain'),
        'edit_item'             => __('Edit Item', 'text_domain'),
        'update_item'           => __('Update Item', 'text_domain'),
        'view_item'             => __('View Item', 'text_domain'),
        'view_items'            => __('View Items', 'text_domain'),
        'search_items'          => __('Search Item', 'text_domain'),
        'not_found'             => __('Not found', 'text_domain'),
        'not_found_in_trash'    => __('Not found in Trash', 'text_domain'),
        'featured_image'        => __('Featured Image', 'text_domain'),
        'set_featured_image'    => __('Set featured image', 'text_domain'),
        'remove_featured_image' => __('Remove featured image', 'text_domain'),
        'use_featured_image'    => __('Use as featured image', 'text_domain'),
        'insert_into_item'      => __('Insert into item', 'text_domain'),
        'uploaded_to_this_item' => __('Uploaded to this item', 'text_domain'),
        'items_list'            => __('Items list', 'text_domain'),
        'items_list_navigation' => __('Items list navigation', 'text_domain'),
        'filter_items_list'     => __('Filter items list', 'text_domain'),
    );
    $args = array(
        'label'                 => __('Review', 'text_domain'),
        'description'           => __('Product and service reviews', 'text_domain'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail', 'comments'),
        'public'                => true,
        'show_in_menu'          => true,
        'menu_icon'             => 'dashicons-star-filled',
         'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'menu_position'         => 7,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'menu_icon'   => 'dashicons-analytics'
    );
    register_post_type('reviews', $args);
}
add_action('init', 'reviews_custom_post_type', 0);


function add_reviews_rating_meta_box() {
    add_meta_box(
        'reviews_rating',
        __('Rating', 'text_domain'),
        'write_reviews_rating_meta_box',
        'reviews',
        'side',
    );
}
add_action('add_meta_boxes', 'add_reviews_rating_meta_box');

function write_reviews_rating_meta_box($post) {
    $rating = get_post_meta($post->ID, 'reviews_rating', true);
    
    wp_nonce_field('save_reviews_rating_meta_box', 'reviews_rating_nonce');
    echo '<label for="reviews_rating">'.esc_html__('Rating:', 'text_domain').'</label>';
    echo '<input type="number" id="reviews_rating" name="reviews_rating" value="'.esc_attr($rating).'" min="0" max="5" step="0.5">';
}

function save_reviews_rating_meta_box($post_id) {
    if (!isset($_POST['reviews_rating_nonce']) || !wp_verify_nonce($_POST['reviews_rating_nonce'], 'save_reviews_rating_meta_box')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    if (isset($_POST['reviews_rating'])) {
        update_post_meta($post_id, 'reviews_rating', sanitize_text_field($_POST['reviews_rating']));
    }
}
add_action('save_post', 'save_reviews_rating_meta_box');

