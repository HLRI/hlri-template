<?php

if (!defined('ABSPATH')) {
    exit;
}


include 'constant.php';

include HLR_THEME_PATH . 'inc/match_elementor.php';
include HLR_THEME_PATH . '/lib/validation/vendor/autoload.php';
include HLR_THEME_PATH . '/lib/validation/canada_phone_rule.php';
include HLR_THEME_PATH . '/lib/vendor/autoload.php';
include HLR_THEME_PATH . 'lib/codestar/codestar-framework.php';
include HLR_THEME_PATH . 'inc/validate_codestar.php';
include HLR_THEME_PATH . 'lib/view-module/view.php';
include HLR_THEME_PATH . 'options.php';
include HLR_THEME_PATH . 'inc/init.php';
include HLR_THEME_PATH . 'inc/helper.php';
include HLR_THEME_PATH . 'inc/scripts.php';
include HLR_THEME_PATH . 'inc/ajax.php';
include HLR_THEME_PATH . 'inc/forms.php';
include HLR_THEME_PATH . 'inc/shortcodes.php';
include HLR_THEME_PATH . 'inc/post_types.php';
include HLR_THEME_PATH . 'inc/meta_boxes.php';
include HLR_THEME_PATH . 'inc/taxonomy.php';
include HLR_THEME_PATH . 'inc/visit_history.php';
include HLR_THEME_PATH . 'inc/admin_pages.php';
include HLR_THEME_PATH . 'inc/caching.php';

function custom_log_post_changes678($post_id) {
    $post_title = get_the_title($post_id);
    $post_status = get_post_status($post_id);
    $log_message = "Post '{$post_title}' (ID: {$post_id}) has been {$post_status}";
    error_log($log_message);
}

// Hook into the save_post action
add_action('save_post', 'custom_log_post_changes678',1);
add_action('wp_insert_post', 'custom_log_post_changes678',1);
add_action('publish_post', 'custom_log_post_changes678',1);
add_action('draft_post', 'custom_log_post_changes678',1);
add_action('transition_post_status', 'custom_log_post_changes678',1);
add_action('pre_post_update', 'custom_log_post_changes678',1);
add_action('edit_post', 'custom_log_post_changes678',1);
add_action('save_post_post', 'custom_log_post_changes678',1);






// Add custom columns to the properties post type
function custom_properties_columns($columns) {
    $columns['last_updated'] = 'Last Updated';
    $columns['updater_name'] = 'Updater Name';
    return $columns;
}
add_filter('manage_properties_posts_columns', 'custom_properties_columns');

// Populate custom columns with data
function custom_properties_column_data($column, $post_id) {
    switch ($column) {
        case 'last_updated':
            $last_updated = get_post_modified_time('F j, Y g:i a', false, $post_id, true);
            echo $last_updated;
            break;

        case 'updater_name':
            $updater_id = get_post_meta($post_id, '_edit_last', true);
            $updater = get_userdata($updater_id);
            echo $updater ? $updater->display_name : '';
            break;
    }
}
add_action('manage_properties_posts_custom_column', 'custom_properties_column_data', 10, 2);


// Assuming this code goes into your theme's functions.php file

add_filter('template_include', 'custom_property_template');

function custom_property_template($template)
{
    // Check if it's a single property post
    if (is_singular('properties')) {
        global $post;

        // Get the value of 'opt-sales-type' meta key
        $map_data = get_post_meta($post->ID, 'hlr_framework_mapdata', true);
        $opt_sales_type = isset($map_data['opt-sales-type']) ? $map_data['opt-sales-type'] : '';

        // Check the value and load the appropriate template
        if ($opt_sales_type == 'Assignment') {
            $new_template = locate_template(array('single-properties-assignment.php'));
            if ('' != $new_template) {
                return $new_template;
            }
        } elseif ($opt_sales_type == 'Resale') {
            $new_template = locate_template(array('single-properties-resale.php'));
            if ('' != $new_template) {
                return $new_template;
            }
        } elseif (in_array($opt_sales_type, array('Preconstruction', 'Coming soon', 'Sold Out'))) {
            $new_template = locate_template(array('single-properties.php'));
            if ('' != $new_template) {
                return $new_template;
            }
        }
    }

    // For other cases, return the original template
    return $template;
}


// Add custom admin menu
function custom_delete_posts_admin_menu() {
    add_menu_page(
        'Delete Posts', // Page title
        'Delete Posts', // Menu title
        'manage_options', // Capability
        'custom-delete-posts', // Menu slug
        'custom_delete_posts_page', // Callback function
        'dashicons-trash', // Icon
        99 // Position
    );
}
add_action('admin_menu', 'custom_delete_posts_admin_menu');

// Custom admin page content
function custom_delete_posts_page() {
    ?>
    <div class="wrap">
        <h2>Delete Posts</h2>
        <p>Click the button below to delete posts and their featured images.</p>
        <form method="post" action="">
            <?php wp_nonce_field('custom-delete-posts-action', 'custom-delete-posts-nonce'); ?>
            <input type="submit" name="delete_posts_button" class="button button-primary" value="Delete Posts">
        </form>
        <?php
        // Handle deletion logic
        if (isset($_POST['delete_posts_button'])) {
            // Verify nonce
            if (!isset($_POST['custom-delete-posts-nonce']) || !wp_verify_nonce($_POST['custom-delete-posts-nonce'], 'custom-delete-posts-action')) {
                wp_die('Unauthorized request!');
            }

            // Run your function to delete posts and their featured images based on IDs
            $posts_to_delete = array(33078, 33075, 33080); // Example post IDs to delete
            $deleted_count = delete_posts_and_featured_images_by_ids($posts_to_delete);

            // Display success message
            echo "<p>Deleted $deleted_count posts and their featured images.</p>";
        }
        ?>
    </div>
    <?php
}

// Delete posts along with their featured images based on an array of post IDs
// Add custom admin menu
function custom_delete_floorplans_admin_menu() {
    add_menu_page(
        'Delete Floorplans', // Page title
        'Delete Floorplans', // Menu title
        'manage_options', // Capability
        'custom-delete-floorplans', // Menu slug
        'custom_delete_floorplans_page', // Callback function
        'dashicons-trash', // Icon
        99 // Position
    );
}
add_action('admin_menu', 'custom_delete_floorplans_admin_menu');

// Custom admin page content
function custom_delete_floorplans_page() {
    global $wpdb;

    if (isset($_POST['property_id']) && isset($_POST['delete_floorplans_button'])) {
        // Verify nonce
        if (!isset($_POST['delete_floorplans_nonce']) || !wp_verify_nonce($_POST['delete_floorplans_nonce'], 'custom-delete-floorplans')) {
            wp_die('Unauthorized request!');
        }

        // Get selected property ID
        $property_id = intval($_POST['property_id']);

        // Fetch associated floorplans
        $floorplans = $wpdb->get_results(
            $wpdb->prepare(
                "SELECT ID, post_title, post_content FROM $wpdb->posts
                WHERE post_type = 'floorplan' AND post_status = 'publish'
                AND ID IN (
                    SELECT post_id FROM $wpdb->postmeta
                    WHERE meta_key = 'associated_property' AND meta_value = %d
                )",
                $property_id
            )
        );

        // Delete selected floorplans and their featured images
        $deleted_count = 0;
        foreach ($floorplans as $floorplan) {
            $featured_image_id = get_post_thumbnail_id($floorplan->ID);
            if (!empty($featured_image_id)) {
                wp_delete_attachment($featured_image_id, true);
            }
            if (wp_delete_post($floorplan->ID, true)) {
                $deleted_count++;
            }
        }

        // Display success message
        echo "<p>Deleted $deleted_count floorplans and their featured images.</p>";
    }

    // Fetch properties
    $properties = get_posts(array(
        'post_type' => 'property',
        'posts_per_page' => -1,
        'post_status' => 'publish'
    ));

    // Display property dropdown
    ?>
    <div class="wrap">
        <h2>Delete Floorplans</h2>
        <form method="post" action="">
            <?php wp_nonce_field('custom-delete-floorplans'); ?>
            <label for="property_id">Select a property:</label>
            <select name="property_id" id="property_id">
                <?php foreach ($properties as $property) : ?>
                    <option value="<?php echo $property->ID; ?>"><?php echo $property->post_title; ?></option>
                <?php endforeach; ?>
            </select>
            <input type="submit" name="delete_floorplans_button" class="button button-primary" value="Delete Floorplans">
        </form>
        <?php
        // Display floorplans associated with the selected property
        if (isset($_POST['property_id']) && isset($_POST['delete_floorplans_button'])) {
            echo "<h3>Floorplans:</h3>";
            echo "<ul>";
            foreach ($floorplans as $floorplan) {
                echo "<li><a href='" . get_permalink($floorplan->ID) . "'>" . $floorplan->post_title . "</a></li>";
            }
            echo "</ul>";
        }
        ?>
    </div>
    <?php
}

