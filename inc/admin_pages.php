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

// Display property logs in the admin
function display_property_logs() {
    global $wpdb;

    $table_name = $wpdb->prefix . 'property_logs';

    $results = $wpdb->get_results("SELECT * FROM $table_name ORDER BY modified_at DESC LIMIT 3", ARRAY_A);

    echo '<div class="wrap">';
    echo '<h2>Property Logs</h2>';
    echo '<table class="widefat">';
    echo '<thead><tr><th>Property ID</th><th>User ID</th><th>Modified At</th><th>Added At</th></tr></thead>';
    echo '<tbody>';

    foreach ($results as $result) {
        echo '<tr>';
        echo '<td>' . esc_html($result['property_id']) . '</td>';
        echo '<td>' . esc_html($result['user_id']) . '</td>';
        echo '<td>' . esc_html($result['modified_at']) . '</td>';
        echo '<td>' . esc_html($result['added_at']) . '</td>';
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
