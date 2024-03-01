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
