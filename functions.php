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