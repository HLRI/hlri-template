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
                'key' => 'associated_property',
                'value' => $post->ID,
                'compare' => '='
            )
        )
    ) );

    // Display associated floorplans as links
    $associated_floorplans = get_posts( array(
        'post_type' => 'floorplans',
        'numberposts' => -1,
        'meta_query' => array(
            array(
                'key' => 'associated_property',
                'value' => $post->ID,
                'compare' => '='
            )
        )
    ) );
    $add_new_url = add_query_arg( array( 'post_type' => 'floorplans', 'associated_property' => $post->ID ), admin_url( 'post-new.php' ) );
    echo '<a href="' . esc_url( $add_new_url ) . '" target="_blank" class="button button-primary">Add New Floorplan</a>';

    if ( $associated_floorplans ) {
        echo $post->title;
        echo '<style>.rightDf{float: right;display: inline-block;}.flIl{border: 1px solid #cfcfcf;padding: 10px 10px 10px 15px;border-radius: 5px;background-color: #f8f8f8;font-size: 16px;color: #ae0c0c;box-shadow: 1px 2px 3px #e9e9e9;margin-bottom: 9px;}</style><div class="inside">';
        echo '<ul style="margin-top:30px;">';
        foreach ( $associated_floorplans as $floorplan ) {
            echo '<li class="flIl"><span>' . esc_html( $floorplan->post_title ) . '</span> <div class="rightDf"><a class="button button-small" target="_blank" href="' . get_edit_post_link( $floorplan->ID ) . '">Edit</a>  <span>  </span>  <a class="button button-small" target="_blank" href="' . get_post_permalink( $floorplan->ID ) . '">View</a></div></li>';
        }
        echo '</ul>';
        echo '</div>';
    } else {
        echo '<p>No associated floorplans found for this property.</p>';
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

    $associated_property = isset( $_GET['associated_property'] ) ? intval( $_GET['associated_property'] ) : get_post_meta( $post->ID, 'associated_property', true );
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

// Add custom meta box to the floorplans edit screen
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
add_action( 'add_meta_boxes_floorplans', 'custom_add_property_association_meta_box' );


// Save the associated property when the floorplan is saved
function custom_save_property_association_meta( $post_id ) {
    if ( isset( $_POST['custom_floorplan_property_nonce'] ) && wp_verify_nonce( $_POST['custom_floorplan_property_nonce'], 'custom_floorplan_property_association' ) ) {
        if ( isset( $_POST['associated_property'] ) && ! empty( $_POST['associated_property'] ) ) {
            update_post_meta( $post_id, 'associated_property', $_POST['associated_property'] );
        }
    }
}

// Hook into the save_post action
add_action( 'save_post', 'custom_save_property_association_meta' );


function add_custom_validation_script() {
    ?>
    <script>
        jQuery(document).ready(function($) {
            // Handle the form submission
            $('form#post').on('submit', function(event) {
                event.preventDefault(); // Prevent the default form submission

                // Check if an associated property is selected
                var associatedProperty = $('select#associated_property').val();
                if (!associatedProperty) {
                    alert('Please select an associated property.');
                    return;
                }

                // If validation passes, proceed with the form submission
                $(this).unbind('submit').submit();
            });
        });
    </script>
    <?php
}
add_action('admin_footer', 'add_custom_validation_script');




// Display error message on the edit page
function custom_display_error_message() {
    if ( isset( $_GET['error'] ) ) {
        $error_message = urldecode( $_GET['error'] );
        echo '<div class="error"><p>' . esc_html( $error_message ) . '</p></div>';
    }
}

// Hook into admin_notices action to display the error message
add_action( 'admin_notices', 'custom_display_error_message' );







// Modify the floorplans query to include the associated property
function custom_modify_floorplans_query( $query ) {
    if ( ! is_admin() || ! $query->is_main_query() ) {
        return;
    }

    if ( $query->get( 'post_type' ) === 'floorplans' ) {
        $query->set( 'rewrite', array( 'slug' => 'properties', 'with_front' => false ) );
    }
}
add_action( 'pre_get_posts', 'custom_modify_floorplans_query' );

add_action( 'pre_get_posts', 'custom_modify_floorplans_query' );

add_action( 'pre_get_posts', 'custom_modify_floorplans_query' );

// Render associated floorplans on the floorplan edit screen
function custom_render_associated_floorplans() {
    global $post;

    // Get the associated property for the current floorplan
    $associated_property = get_post_meta($post->ID, 'associated_property', true);
    $property_name = get_post_field('post_name', $associated_property); // Get the slug of the associated property
    $property_url = home_url("/properties/$property_name/");

    if ($associated_property) {
        // Get the associated floorplans for the current property
        $floorplans = get_posts(array(
            'post_type' => 'floorplans',
            'numberposts' => -1,
            'meta_query' => array(
                array(
                    'key' => 'associated_property',
                    'value' => $associated_property,
                    'compare' => '=',
                ),
            ),
        ));

        if ($floorplans) {
            echo '<style>.rightDf{float: right;display: inline-block;}.flIl{border: 1px solid #cfcfcf;padding: 10px 10px 10px 15px;border-radius: 5px;background-color: #f8f8f8;font-size: 16px;color: #ae0c0c;box-shadow: 1px 2px 3px #e9e9e9;margin-bottom: 9px;}</style><div class="inside">';
            echo '<ul style="margin-top:30px;">';
            foreach ($floorplans as $floorplan) {
                $floorplan_slug = $floorplan->post_name;
                $floorplan_link = $property_url . "floorplans/$floorplan_slug/";

                echo '<li class="flIl"><span>' . esc_html($floorplan->post_title) . '</span> <div class="rightDf"><a class="button button-small" target="_blank" href="' . get_edit_post_link($floorplan->ID) . '">Edit</a>  <span>  </span>  <a class="button button-small" target="_blank" href="' . esc_url($floorplan_link) . '">View</a></div></li>';
            }
            echo '</ul>';
            echo '</div>';
        } else {
            echo '<p>No floorplans associated with this property.</p>';
        }
    } else {
        echo '<p>No associated property found for this floorplan.</p>';
    }
}




// Modify the floorplans permalink structure
function custom_modify_floorplans_permalink($permalink, $post) {
    if ($post->post_type === 'floorplans') {
        $associated_property = get_post_meta($post->ID, 'associated_property', true);
        $property_name = get_post_field('post_name', $associated_property); // Get the slug of the associated property
        $property_url = home_url("/properties/$property_name/");
        $floorplan_slug = $post->post_name;

        $permalink = $property_url . "floorplans/$floorplan_slug/";
    }

    return $permalink;
}
add_filter('post_type_link', 'custom_modify_floorplans_permalink', 10, 2);


// Register additional rewrite rules for the modified floorplans permalink structure
function custom_add_rewrite_rules() {
    add_rewrite_rule( '^properties/([^/]+)/floorplans/([^/]+)/?$', 'index.php?properties=$matches[1]&floorplans=$matches[2]', 'top' );
}
add_action( 'init', 'custom_add_rewrite_rules' );

// Flush rewrite rules when the associated property is saved or updated
function custom_flush_rewrite_rules() {
    flush_rewrite_rules();
}
add_action('save_post_associated_property', 'custom_flush_rewrite_rules');
add_action('delete_post_associated_property', 'custom_flush_rewrite_rules');

// Add the associated floorplans meta box to the floorplan edit screen
function custom_add_associated_floorplans_meta_box() {
    add_meta_box(
        'associated_floorplans_meta_box',
        'All FloorPlans for the Associated Property',
        'custom_render_associated_floorplans',
        'floorplans',
        'normal',
        'default'
    );
}
add_action( 'add_meta_boxes_floorplans', 'custom_add_associated_floorplans_meta_box' );

// Save associated floorplans meta
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

// Move associated floorplans to trash when a property is moved to trash
function custom_trash_associated_floorplans( $post_id ) {
    if ( get_post_type( $post_id ) === 'properties' && get_post_status( $post_id ) === 'trash' ) {
        $associated_floorplans = get_posts( array(
            'post_type' => 'floorplans',
            'numberposts' => -1,
            'meta_query' => array(
                array(
                    'key' => 'associated_property',
                    'value' => $post_id,
                    'compare' => '=',
                ),
            ),
        ) );

        foreach ( $associated_floorplans as $floorplan ) {
            wp_trash_post( $floorplan->ID );
        }
    }
}
add_action( 'trashed_post', 'custom_trash_associated_floorplans' );

// Delete associated floorplans from trash when a property is deleted from trash
function custom_delete_associated_floorplans( $post_id ) {
    if ( get_post_type( $post_id ) === 'properties' && get_post_status( $post_id ) === 'trash' ) {
        $associated_floorplans = get_posts( array(
            'post_type' => 'floorplans',
            'numberposts' => -1,
            'meta_query' => array(
                array(
                    'key' => 'associated_property',
                    'value' => $post_id,
                    'compare' => '=',
                ),
            ),
            'post_status' => 'trash',
        ) );

        foreach ( $associated_floorplans as $floorplan ) {
            wp_delete_post( $floorplan->ID, true );
        }
    }
}
add_action( 'delete_post', 'custom_delete_associated_floorplans' );

