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
            // Call different functions based on the 'admin_function' parameter
            switch ($function_name) {
                case 'update_precon_progress':
                    update_precon_progress();
                    break;
                case 'not_updated_for_3_months':
                    not_updated_for_3_months();
                    break;
                case 'not_updated_for_6_months':
                    not_updated_for_6_months();
                    break;
                // Add more cases for other functions as needed
                default:
                    // If the function is not recognized, show an error or default message
                    echo 'Function not found.';
                    break;
            }
            exit; // Prevent WordPress from rendering a full page
        }
    }
});

// Example functions
function update_precon_progress() {
    // Define the URL for the JSON request
    $url = 'https://hlrihub.com/project-progress-list-json';

    // Make the GET request
    $response = wp_remote_get($url);

    // Check if the response is successful
    if (is_wp_error($response)) {
        // Handle the error
        echo 'Failed to retrieve data: ' . $response->get_error_message();
        return;
    }

    // Retrieve the body of the response
    $body = wp_remote_retrieve_body($response);

    // Decode the JSON data
    $data = json_decode($body, true);

    // Check if the JSON is valid
    if (json_last_error() !== JSON_ERROR_NONE) {
        echo 'Failed to decode JSON: ' . json_last_error_msg();
        return;
    }

    // Update the WordPress option with the JSON data
    update_option('precon_progress', $data);

    // Output success message
    echo 'Pre-construction progress data updated successfully.';
}








// Function to get properties not updated in the specified months
function get_properties_not_updated($months) {
    $args = [
        'post_type'      => 'property',  // Ensure this is the correct post type
        'posts_per_page' => -1,          // Get all properties
        'post_status'    => 'publish',   // Only published properties
//        'date_query'     => [
//            [
//                'column' => 'post_modified',
//                'before' => "$months months ago", // Date query to filter by modified date
//            ],
//        ],
    ];

    $query = new WP_Query($args);

    return $query->posts;
}

// Generate the table
function generate_properties_table($properties) {
    if (empty($properties)) {
        return '<p>No properties found.</p>';
    }

    $table = '<table border="1" cellspacing="0" cellpadding="5">';
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

// Function to display properties not updated for 3 months
function not_updated_for_3_months() {
    $properties = get_properties_not_updated(3);
    echo '<h2>Properties Not Updated for 3 Months</h2>';
    echo generate_properties_table($properties);
}

// Function to display properties not updated for 6 months
function not_updated_for_6_months() {
    $properties = get_properties_not_updated(6);
    echo '<h2>Properties Not Updated for 6 Months</h2>';
    echo generate_properties_table($properties);
}