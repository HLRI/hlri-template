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


function custom_log_post_changes($post_id) {
    // Check if this is not an autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Get the post type
    $post_type = get_post_type($post_id);

    // Define the post types you want to log changes for
    $supported_post_types = array('post', 'page', 'custom_post_type'); // Add your custom post types here

    // Check if the post type is supported
    if (!in_array($post_type, $supported_post_types)) {
        return;
    }

    // Get the post title and status
    $post_title = get_the_title($post_id);
    $post_status = get_post_status($post_id);

    // Prepare the log message
    $log_message = "Post '{$post_title}' (ID: {$post_id}) has been {$post_status}";

    // Log the message to the error_log file
    error_log($log_message);
}

// Hook into the save_post action
add_action('save_post', 'custom_log_post_changes');
