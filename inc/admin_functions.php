<?php

// Add a custom rewrite rule to catch the 'admin_function' query variable under wp-admin
add_action('init', function () {
    add_rewrite_rule(
        '^wp-admin/admin_function/?$', // Custom URL: example.com/wp-admin/admin_function
        'index.php?action=1', // Internal query parameter
        'top' // Priority at the top of the rules
    );
});

// Register the custom query variable 'admin_function'
add_filter('query_vars', function ($query_vars) {
    $query_vars[] = 'action'; // Add 'admin_function' to the list of query vars
    return $query_vars;
});

// Hook into template_redirect to run the functions based on the 'admin_function' query variable
add_action('template_redirect', function () {
    // Ensure that only administrators can access this URL
    if (!is_admin() && current_user_can('administrator')) {
        $function_name = get_query_var('action');

        // Check if the query variable is set and matches a known function
        if ($function_name) {
            // Check for the dynamic month-based function
            if (preg_match('/^not_updated_for_(\d+)_months$/', $function_name, $matches)) {
                $months = (int) $matches[1]; // Extract the month number from the URL
                not_updated_for_months($months);
                exit;
            }

            // Other static functions can be handled here
            switch ($function_name) {
                case 'update_precon_progress':
                    update_precon_progress();
                    break;
                default:
                    echo 'Function not found.';
                    break;
            }
            exit; // Prevent WordPress from rendering a full page
        }
    }
});

// Example function to handle updating pre-construction progress
function update_precon_progress() {
    $url = 'https://hlrihub.com/project-progress-list-json';
    $response = wp_remote_get($url);

    if (is_wp_error($response)) {
        echo 'Failed to retrieve data: ' . $response->get_error_message();
        return;
    }

    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        echo 'Failed to decode JSON: ' . json_last_error_msg();
        return;
    }

    update_option('precon_progress', $data);
    echo 'Pre-construction progress data updated successfully.';
}

// Function to get properties not updated in the specified months, sorted by modified date
function get_properties_not_updated($months) {
    $args = [
        'post_type'      => 'properties',  // Ensure this is the correct post type
        'posts_per_page' => -1,            // Get all properties
        'post_status'    => 'publish',     // Only published properties
        'date_query'     => [
            [
                'column' => 'post_modified',
                'before' => "$months months ago", // Date query to filter by modified date
            ],
        ],
        'orderby'        => 'modified',    // Sort by the modified date
        'order'          => 'DESC',        // In descending order (most recent first)
    ];

    $query = new WP_Query($args);
    return $query->posts;
}

// Generate the table
function generate_properties_table($properties) {
    if (empty($properties)) {
        return '<p>No properties found.</p>';
    }

    // Display total properties above the title
    $total_properties = count($properties);
    $table = '<p>Total Properties: ' . $total_properties . '</p>';

    // Start the table
    $table .= '<table border="1" cellspacing="0" cellpadding="5">';
    $table .= '<thead>';
    $table .= '<tr><th>Title</th><th>Edit Link</th><th>Last Updated</th></tr>';
    $table .= '</thead>';
    $table .= '<tbody>';

    foreach ($properties as $property) {
        $edit_link = get_edit_post_link($property->ID);
        $table .= '<tr>';
        $table .= '<td>' . esc_html($property->post_title) . '</td>';
        $table .= '<td><a href="' . esc_url($edit_link) . '" target="_blank">Edit</a></td>';
        $table .= '<td>' . esc_html($property->post_modified) . '</td>';
        $table .= '</tr>';
    }

    $table .= '</tbody>';
    $table .= '</table>';

    return $table;
}

// Function to display properties not updated for the dynamic number of months
function not_updated_for_months($months) {
    // Ensure the months value is between 1 and 12
    $months = max(1, min(12, intval($months))); // This ensures the months value is between 1 and 12
    $properties = get_properties_not_updated($months);

    echo "<h2>Properties Not Updated for $months Month" . ($months > 1 ? 's' : '') . "</h2>";
    echo generate_properties_table($properties);
}
