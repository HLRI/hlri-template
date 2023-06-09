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




// Render the custom meta box content on the properties edit screen
function custom_render_floorplans_meta_box( $post ) {
    $floorplans = get_posts( array(
        'post_type' => 'floorplans',
        'numberposts' => -1,
        'orderby' => 'title',
        'order' => 'ASC',
        'post_status' => 'publish',
        'meta_query' => array(
            array(
                'key' => 'property',
                'value' => $post->ID,
                'compare' => '='
            )
        )
    ) );

    if ( ! empty( $floorplans ) ) {
        echo '<table>';
        echo '<tr><th>View</th><th>Bed</th><th>Bath</th><th>Price</th></tr>';

        foreach ( $floorplans as $floorplan ) {
            $view = get_post_meta( $floorplan->ID, 'view', true );
            $bed = get_post_meta( $floorplan->ID, 'bed', true );
            $bath = get_post_meta( $floorplan->ID, 'bath', true );
            $price = get_post_meta( $floorplan->ID, 'price', true );

            echo '<tr>';
            echo '<td>' . esc_html( $view ) . '</td>';
            echo '<td>' . esc_html( $bed ) . '</td>';
            echo '<td>' . esc_html( $bath ) . '</td>';
            echo '<td>' . esc_html( $price ) . '</td>';
            echo '</tr>';
        }

        echo '</table>';
    } else {
        echo '<p>No floorplans associated with this property.</p>';
    }
}

// Add the custom meta box to the properties edit screen
function custom_add_floorplans_meta_box() {
    add_meta_box(
        'floorplans_meta_box',
        'Floorplans',
        'custom_render_floorplans_meta_box',
        'properties',
        'normal',
        'default'
    );
}
add_action( 'add_meta_boxes', 'custom_add_floorplans_meta_box' );

// Add custom meta box to the floorplans edit screen for property association
function custom_render_property_association_meta_box( $post ) {
    wp_nonce_field( 'custom_floorplan_property_association', 'custom_floorplan_property_nonce' );

    $associated_property = get_post_meta( $post->ID, 'associated_property', true );
    $properties = get_posts( array(
        'post_type' => 'properties',
        'numberposts' => -1,
        'orderby' => 'title',
        'order' => 'ASC',
        'post_status' => 'publish'
    ) );

    echo '<label for="associated_property">Associated Property:</label>';
    echo '<select name="associated_property" id="associated_property">';
    echo '<option value="">Select Property</option>';

    foreach ( $properties as $property ) {
        $selected = selected( $associated_property, $property->ID, false );
        echo '<option value="' . esc_attr( $property->ID ) . '"' . $selected . '>' . esc_html( $property->post_title ) . '</option>';
    }

    echo '</select>';
}

// Save the associated property when the floorplan is saved
function custom_save_property_association_meta( $post_id ) {
    if ( ! isset( $_POST['custom_floorplan_property_nonce'] ) || ! wp_verify_nonce( $_POST['custom_floorplan_property_nonce'], 'custom_floorplan_property_association' ) ) {
        return;
    }

    if ( isset( $_POST['associated_property'] ) ) {
        update_post_meta( $post_id, 'associated_property', $_POST['associated_property'] );
    }
}
add_action( 'save_post_floorplans', 'custom_save_property_association_meta' );

// Add the custom meta box to the floorplans edit screen
function custom_add_property_association_meta_box() {
    add_meta_box(
        'property_association_meta_box',
        'Property Association',
        'custom_render_property_association_meta_box',
        'floorplans',
        'side',
        'default'
    );
}
add_action( 'add_meta_boxes', 'custom_add_property_association_meta_box' );

// Modify the floorplans query to include the associated property
function custom_modify_floorplans_query( $query ) {
    if ( ! is_admin() || ! $query->is_main_query() ) {
        return;
    }

    if ( $query->get( 'post_type' ) === 'floorplans' ) {
        $associated_property = get_query_var( 'property' );

        if ( $associated_property ) {
            $query->set( 'meta_key', 'associated_property' );
            $query->set( 'meta_value', $associated_property );
            $query->set( 'meta_compare', '=' );
        }
    }
}
add_action( 'pre_get_posts', 'custom_modify_floorplans_query' );
function custom_render_associated_floorplans() {
    global $post;

    // Get the associated property for the current floorplan
    $associated_property = get_post_meta( $post->ID, 'associated_property', true );

    if ( $associated_property ) {
        $floorplans = get_posts( array(
            'post_type' => 'floorplans',
            'numberposts' => -1,
            'orderby' => 'title',
            'order' => 'ASC',
            'post_status' => 'publish',
            'meta_query' => array(
                array(
                    'key' => 'associated_property',
                    'value' => $associated_property,
                    'compare' => '='
                )
            )
        ) );

        if ( $floorplans ) {
            echo '<ul>';
            foreach ( $floorplans as $floorplan ) {
                echo '<li><a href="' . get_edit_post_link( $floorplan->ID ) . '">' . esc_html( $floorplan->post_title ) . '</a></li>';
            }
            echo '</ul>';
        } else {
            echo 'No floorplans associated with this property.';
        }
    } else {
        echo 'No associated property found for this floorplan.';
    }
}
add_action('admin_init', 'custom_render_associated_floorplans');


function custom_save_floorplans_meta( $post_id ) {
    if ( ! isset( $_POST['floorplans_meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['floorplans_meta_box_nonce'], 'floorplans_meta_box' ) ) {
        return;
    }

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    if ( isset( $_POST['post_type'] ) && 'properties' === $_POST['post_type'] ) {
        if ( isset( $_POST['floorplans'] ) ) {
            $floorplans = array_map( 'intval', $_POST['floorplans'] );
            update_post_meta( $post_id, 'floorplans', $floorplans );
        } else {
            delete_post_meta( $post_id, 'floorplans' );
        }
    }
}
add_action( 'save_post_properties', 'custom_save_floorplans_meta' );

