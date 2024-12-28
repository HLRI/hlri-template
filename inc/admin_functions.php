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
                case 'function_name_2':
                    function_name_2();
                    break;
                case 'function_name_3':
                    function_name_3();
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


function function_name_2() {
    echo 'This is Function 2';
}

function function_name_3() {
    echo 'This is Function 3';
}
