<?php

add_action('admin_menu', 'add_admin_menu');
function add_admin_menu()
{
    add_submenu_page('edit.php?post_type=properties', 'Fast Update', 'Fast Update', 'manage_options', 'fast-update-properties', 'page_view_fast_update');
}

function page_view_fast_update()
{
    global $title;
    include HLR_THEME_PATH . 'template-parts/admin-pages/fast-updates-properties.php';
}
// Create custom table during plugin or theme activation
function create_property_log_table() {
    global $wpdb;

    $table_name = $wpdb->prefix . 'property_logs';

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        log_id bigint(20) NOT NULL AUTO_INCREMENT,
        property_id bigint(20) NOT NULL,
        user_id bigint(20) NOT NULL,
        modified_at datetime NOT NULL,
        PRIMARY KEY  (log_id)
    ) $charset_collate;";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($sql);
}

// Hook to create the table during plugin or theme activation
register_activation_hook(__FILE__, 'create_property_log_table');

// Log changes when a property is updated or added
function log_property_changes($post_ID, $post_after, $post_before) {
    global $wpdb;

    // Check if the post type is 'properties'
    if ($post_after->post_type === 'properties') {
        $log_data = array(
            'property_id' => $post_ID,
            'user_id' => get_current_user_id(),
            'modified_at' => current_time('mysql'),
        );

        // Insert the log data into the custom table
        $wpdb->insert($wpdb->prefix . 'property_logs', $log_data);
    }
}

// Hook to log changes when a post is updated or added
add_action('wp_insert_post', 'log_property_changes', 10, 3);

// Display property logs in the admin
function display_property_logs() {
    global $wpdb;

    $table_name = $wpdb->prefix . 'property_logs';

    $results = $wpdb->get_results("SELECT * FROM $table_name ORDER BY modified_at DESC LIMIT 3", ARRAY_A);

    echo '<div class="wrap">';
    echo '<h2>Property Logs</h2>';
    echo '<table class="widefat">';
    echo '<thead><tr><th>Property ID</th><th>User ID</th><th>Modified At</th></tr></thead>';
    echo '<tbody>';

    foreach ($results as $result) {
        echo '<tr>';
        echo '<td>' . esc_html($result['property_id']) . '</td>';
        echo '<td>' . esc_html($result['user_id']) . '</td>';
        echo '<td>' . esc_html($result['modified_at']) . '</td>';
        echo '</tr>';
    }

    echo '</tbody></table>';
    echo '</div>';
}

// Hook to add the admin submenu page
function add_property_logs_submenu_page() {
    add_submenu_page(
        'edit.php?post_type=properties', // Main menu slug (edit.php?post_type=properties)
        'Property Logs',
        'Property Logs',
        'manage_options',
        'property-logs',
        'display_property_logs'
    );
}

// Hook to add the admin submenu page
add_action('admin_menu', 'add_property_logs_submenu_page');
