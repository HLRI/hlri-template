<?php

use Rakit\Validation\Validator;

add_action('wp_ajax_nopriv_getlatestpost', 'getlatestpost');
add_action('wp_ajax_getlatestpost', 'getlatestpost');
function getlatestpost()
{
    $args = array(
        'post_type' => ['post'],
        'post_status' => ['publish'],
        'posts_per_page' => 10,
    );
    $query = new WP_Query($args);
    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            ?>

            <a href="<?= get_the_permalink() ?>" title="<?= get_the_title() ?>" target="_blank" class="card-post-sidebar mb-2">
                <div class="card-post-sidebar-image">
                        <?php the_post_thumbnail('normal', ['loading' => 'lazy']) ?>
                </div>
                <div class="card-post-sidebar-content">
                    <div class="card-post-sidebar-title">
                        <?= strlen(get_the_title())  > 30 ? substr(get_the_title(), 0, 30) . '...' : get_the_title() ?>
                    </div>
                    <div class="wrap-card-post-sidebar-meta">
                        <div class="card-post-sidebar-meta">
                            <i class="fa fa-eye"></i>
                            <span><?= getView(get_the_ID()) ?></span>
                        </div>
                        <div class="card-post-sidebar-meta">
                            <i class="fa fa-calendar"></i>
                            <span><?= get_the_date() ?></span>
                        </div>
                    </div>
                </div>
            </a>

        <?php
        endwhile;
    endif;
    exit();
}

add_action('wp_ajax_nopriv_getpopularpost', 'getpopularpost');
add_action('wp_ajax_getpopularpost', 'getpopularpost');
function getpopularpost()
{
    $args = array(
        'post_type' => ['post'],
        'post_status' => ['publish'],
        'posts_per_page' => 10,
    );
    $query = new WP_Query($args);
    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            $posts[] = [
                'link' => get_the_permalink(),
                'image' => get_the_post_thumbnail(),
                'title' => get_the_title(),
                'date' => get_the_date(),
                'view' => getView(get_the_ID()),
            ];
        endwhile;
    endif;


    array_multisort(array_column($posts, 'view'), SORT_DESC, $posts);


    foreach ($posts as $post) :
        ?>

        <a href="<?= $post['link'] ?>" title="<?= $post['title'] ?>" target="_blank" class="card-post-sidebar mb-2">
            <div class="card-post-sidebar-image">
                <?php if ($post['image']) : ?>
                    <?= $post['image'] ?>
                <?php else : ?>
                    <img src="<?= HLR_THEME_ASSETS . 'images/noimage.jpg' ?>" alt="">
                <?php endif; ?>
            </div>
            <div class="card-post-sidebar-content">
                <div class="card-post-sidebar-title">
                    <?= strlen($post['title'])  > 30 ? substr($post['title'], 0, 30) . '...' : $post['title'] ?>
                </div>
                <div class="wrap-card-post-sidebar-meta">
                    <div class="card-post-sidebar-meta">
                        <i class="fa fa-eye"></i>
                        <span><?= $post['view'] ?></span>
                    </div>
                    <div class="card-post-sidebar-meta">
                        <i class="fa fa-calendar"></i>
                        <span><?= $post['date'] ?></span>
                    </div>
                </div>
            </div>
        </a>

    <?php
    endforeach;
    exit();
}

add_action('wp_ajax_nopriv_propertiesFavorites', 'propertiesFavorites');
add_action('wp_ajax_propertiesFavorites', 'propertiesFavorites');
function propertiesFavorites()
{
    if (!is_user_logged_in()) {
        wp_send_json([
            'status' => 'notLogin'
        ]);
    }


    $favorites = get_user_meta(get_current_user_id(), 'properties_favorites', true);

    if (!empty($favorites)) {
        if (in_array($_POST['post_id'], $favorites)) {
            if (($key = array_search($_POST['post_id'], $favorites)) !== false) {
                unset($favorites[$key]);
            }
            update_user_meta(get_current_user_id(), 'properties_favorites', $favorites);

            wp_send_json([
                'status' => 'removed'
            ]);
        } else {
            array_push($favorites, $_POST['post_id']);
        }
    } else {
        $favorites = [];
        array_push($favorites, $_POST['post_id']);
    }

    update_user_meta(get_current_user_id(), 'properties_favorites', $favorites);

    wp_send_json([
        'status' => 'added'
    ]);
}

add_action('wp_ajax_nopriv_propertiesRating', 'propertiesRating');
add_action('wp_ajax_propertiesRating', 'propertiesRating');
function propertiesRating()
{
    if (!is_user_logged_in()) {
        wp_send_json([
            'status' => 'notLogin'
        ]);
    }

    $property_id = get_user_meta(get_current_user_id(), 'properties_rated', true);
    if ($property_id == $_POST['post_id']) {
        wp_send_json([
            'status' => 'exists',
        ]);
    }

    $total_rates = get_post_meta($_POST['post_id'], 'properties_total_rates', true);
    $user_rates = get_post_meta($_POST['post_id'], 'properties_user_rates', true);

    if (!empty($total_rates) && !empty($user_rates)) {
        $total_rates = $total_rates + $_POST['rate'];
        $user_rates = $user_rates + 1;
        update_post_meta($_POST['post_id'], 'properties_total_rates', $total_rates);
        update_post_meta($_POST['post_id'], 'properties_user_rates', $user_rates);
        update_user_meta(get_current_user_id(), 'properties_rated', $_POST['post_id']);
    } else {
        $total_rates = $_POST['rate'];
        $user_rates = 1;
        update_post_meta($_POST['post_id'], 'properties_total_rates', $total_rates);
        update_post_meta($_POST['post_id'], 'properties_user_rates', $user_rates);
        update_user_meta(get_current_user_id(), 'properties_rated', $_POST['post_id']);
    }

    wp_send_json([
        'status' => 'added',
        'votes' => $user_rates
    ]);
}

add_action('wp_ajax_set_like_properties', 'set_like_properties');
add_action('wp_ajax_nopriv_set_like_properties', 'set_like_properties');
function set_like_properties()
{


    if (!isset($_COOKIE[$_POST['properties_id']])) {
        setcookie(
            $_POST['properties_id'],
            "isset",
            time() + (10 * 365 * 24 * 60 * 60),
            '/',
            $_SERVER['HTTP_HOST']
        );
        if (!empty(get_post_meta($_POST['properties_id'], 'total_like', true))) {
            $total_like = (int)get_post_meta($_POST['properties_id'], 'total_like', true) + 1;
        } else {
            $total_like = 1;
        }
        update_post_meta($_POST['properties_id'], 'total_like', $total_like);
        wp_send_json([
            "total" => get_post_meta($_POST['properties_id'], 'total_like', true),
            "status" => "set"
        ]);
    } else {
        $total_like = (int)get_post_meta($_POST['properties_id'], 'total_like', true) - 1;
        update_post_meta($_POST['properties_id'], 'total_like', $total_like);
        unset($_COOKIE[$_POST['properties_id']]);
        setcookie(
            $_POST['properties_id'],
            null,
            -1,
            '/',
            $_SERVER['HTTP_HOST']
        );
        wp_send_json([
            "total" => get_post_meta($_POST['properties_id'], 'total_like', true),
            "status" => "unset"
        ]);
    }
}

add_action('wp_ajax_nopriv_ajax_login', 'ajax_login');
function ajax_login()
{

    check_ajax_referer('ajax-login-nonce', 'security');

    if (empty($_POST['username']) or empty($_POST['password'])) {
        wp_send_json([
            'loggedin' => false,
            'message' => 'Please fill in all fields.'
        ]);
    }

    $info = array();
    $info['user_login'] = $_POST['username'];
    $info['user_password'] = $_POST['password'];
    $info['remember'] = true;

    $user_signon = wp_signon($info, false);

    if (is_wp_error($user_signon)) {
        echo json_encode(array('loggedin' => false, 'message' => __('Wrong username or password.')));
    } else {
        $userID = $user_signon->ID;
        wp_clear_auth_cookie();
        wp_set_current_user($userID, $info['user_login']);
        wp_set_auth_cookie($userID);
        $user_meta = get_userdata($userID);
        $user_roles = $user_meta->roles;
        if (in_array('administrator', $user_roles)) {
            $url = home_url('wp-admin');
        } else {
            $url = home_url('panel');
        }
        echo json_encode(array('loggedin' => true, 'message' => __('Login successful, redirecting...'), 'url' => $url));
    }
    exit();
}

add_action('wp_ajax_nopriv_ajax_register', 'ajax_register');
function ajax_register()
{

    check_ajax_referer('ajax-login-nonce', 'security');

    if (empty($_POST['username']) or empty($_POST['email']) or empty($_POST['password'])) {
        wp_send_json([
            'status' => false,
            'message' => 'Please fill in all fields.'
        ]);
    }

    include ABSPATH . 'wp-load.php';

    if (email_exists($_POST['email']) and username_exists($_POST['username'])) {
        wp_send_json([
            'status' => false,
            'message' => 'This email and username already exists.'
        ]);
    } elseif (email_exists($_POST['email'])) {
        wp_send_json([
            'status' => false,
            'message' => 'This email already exists.'
        ]);
    } elseif (username_exists($_POST['username'])) {
        wp_send_json([
            'status' => false,
            'message' => 'This username already exists.'
        ]);
    }


    if (!is_email($_POST['email'])) {
        wp_send_json([
            'status' => false,
            'message' => 'The email is not valid.'
        ]);
    }




    $user = [];
    $user['user_login'] = sanitize_user($_POST['username']);
    $user['user_email'] = sanitize_email($_POST['email']);
    $user['user_pass']  = sanitize_text_field($_POST['password']);
    $user['show_admin_bar_front ']  = false;
    $user_register = wp_insert_user($user);


    wp_clear_auth_cookie();
    wp_set_current_user($user_register, $info['user_login']);
    wp_set_auth_cookie($user_register);

    if ($user_register) {
        wp_send_json([
            'status' => true,
            'message' => 'Register successful, redirecting...',
            'url' => home_url('panel')
        ]);
    }
}

add_action('wp_ajax_nopriv_ajax_forgot_password', 'ajax_forgot_password');
function ajax_forgot_password()
{

    check_ajax_referer('ajax-login-nonce', 'security');

    global $wpdb;

    $account = $_POST['username'];

    if (empty($account)) {
        $error = 'Enter an username or email address.';
    } else {
        if (is_email($account)) {
            if (email_exists($account))
                $get_by = 'email';
            else
                $error = 'There is no user registered with that email address.';
        } else if (validate_username($account)) {
            if (username_exists($account))
                $get_by = 'login';
            else
                $error = 'There is no user registered with that username.';
        } else
            $error = 'Invalid username or e-mail address.';
    }

    if (empty($error)) {

        $random_password = wp_generate_password();

        $user = get_user_by($get_by, $account);

        $from = 'wordpress@hlrtest.hlric.com';

        $to = $user->user_email;
        $subject = 'Your new password';
        $sender = 'From: ' . get_option('name') . ' <' . $from . '>' . "\r\n";

        $message = 'Your new password is: ' . $random_password;

        $headers[] = 'MIME-Version: 1.0' . "\r\n";
        $headers[] = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers[] = "X-Mailer: PHP \r\n";
        $headers[] = $sender;

        $mail = wp_mail($to, $subject, $message, $headers);

        if ($mail) {
            wp_update_user(array('ID' => $user->ID, 'user_pass' => $random_password));
            $success = 'Check your email address for you new password.(Check the spam folder)';
        } else {
            $error = 'System is unable to send you mail containg your new password.';
        }
    }

    if (!empty($error))
        echo json_encode(array('loggedin' => false, 'message' => __($error)));

    if (!empty($success))
        echo json_encode(array('loggedin' => true, 'message' => __($success)));

    die();
}

add_action('wp_ajax_hlr_search', 'hlr_search');
add_action('wp_ajax_nopriv_hlr_search', 'hlr_search');
function hlr_search() {
    // Ensure the keyword is provided and sanitize it
    $keyword = isset($_POST['keyword']) ? sanitize_text_field($_POST['keyword']) : '';

    // Convert the search keyword to lowercase
    $keyword_lower = strtolower($keyword);

    // Initialize the query arguments for properties
    $query_args = array(
        'posts_per_page' => -1,
        'post_type' => 'properties'
    );

    // Perform a regular search for properties without any taxonomy filtering
    $query_args['s'] = $keyword;

    // Check if the keyword matches any term in the "city", "neighborhood", "group", or "developer" taxonomies
    $taxonomies = array('city', 'neighborhood', 'group', 'developer');
    $alternative_keywords_exist = false; // Flag to track if alternative keywords exist
    foreach ($taxonomies as $taxonomy) {
        $terms = get_terms(array(
            'taxonomy' => $taxonomy,
            'hide_empty' => false, // Include empty terms
        ));
        foreach ($terms as $term) {
            // Check if the keyword matches the title of the taxonomy term
            if (strtolower($term->name) === $keyword_lower) {
                // Construct the tax query to include the term
                $tax_query = array(
                    'taxonomy' => $taxonomy,
                    'field' => 'term_id',
                    'terms' => array($term->term_id),
                );
                $query_args['tax_query'] = array($tax_query);

                // Remove the regular search keyword if taxonomy filtering is applied
                unset($query_args['s']);
                // Get the archive link for the term
                $archive_link = get_term_link($term);
                // Determine the search result title based on the taxonomy and term name
                $search_result_title = 'Properties in ' . $term->name;

                // Check if alternative keywords exist for this term
                $alternative_keywords = get_term_meta($term->term_id, 'alternative_keywords', true);
                if (!empty($alternative_keywords)) {
                    $alternative_keywords_exist = true;
                }

                break 2; // Break out of both foreach loops since we found a matching term
            }

            // Check if the keyword matches any alternative keywords for the term
            $alternative_keywords = get_term_meta($term->term_id, 'alternative_keywords', true);
            if (!empty($alternative_keywords)) {
                $alternative_keywords_array = explode(',', $alternative_keywords);
                if (in_array($keyword_lower, array_map('strtolower', $alternative_keywords_array))) {
                    // Construct the tax query to include the term
                    $tax_query = array(
                        'taxonomy' => $taxonomy,
                        'field' => 'term_id',
                        'terms' => array($term->term_id),
                    );
                    $query_args['tax_query'] = array($tax_query);

                    // Remove the regular search keyword if taxonomy filtering is applied
                    unset($query_args['s']);
                    // Get the archive link for the term
                    $archive_link = get_term_link($term);
                    // Determine the search result title based on the taxonomy and term name
                    $search_result_title = 'Properties in ' . $term->name;
                    $alternative_keywords_exist = true;

                    break 2; // Break out of both foreach loops since we found a matching alternative keyword
                }
            }
        }
    }

    // Perform the query
    $the_query = new WP_Query($query_args);

    // Initialize arrays to hold results for each category
    $properties_results = array();
    $posts_results = array();

    // Check if there are any results
    if ($the_query->have_posts()) :
        // Loop through the results
        while ($the_query->have_posts()) : $the_query->the_post();
            // Add the post to the appropriate category array
            $properties_results[] = array(
                'title' => get_the_title(),
                'permalink' => get_permalink() // Permalink for properties
            );
        endwhile;

        // Results container
        ob_start();
        ?>
        <div class="search-results">
            <!-- Properties section with customized title -->
            <h4 class="info-title">
                <?php if (isset($archive_link)) : ?>
                    <a href="<?php echo esc_url($archive_link); ?>">
                        <?php echo esc_html($search_result_title); ?>
                    </a>
                <?php else : ?>
                    <?php echo esc_html($search_result_title); ?>
                <?php endif; ?>
                <?php if ($alternative_keywords_exist) : ?>
                    <!-- Add a number indicating the presence of alternative keywords -->
                    <span style="color: #888; font-size: 0.8em;display:none;"> (with alternative keywords)</span>
                <?php endif; ?>
            </h4>
            <?php foreach ($properties_results as $property) : ?>
                <div class="result-card mt-1 mb-2 px-3">
                    <a href="<?php echo esc_url($property['permalink']); ?>" class="card-result-label">
                        <?php echo esc_html($property['title']); ?>
                    </a>
                </div>
            <?php endforeach; ?>
        </div> <!-- .search-results -->
        <?php
        // Get the results container content
        $search_results_content = ob_get_clean();
    else :
        // No results message
        $search_results_content = '
            <h4 class="info-title">No results</h4>
            <div class="result-card mt-1 mb-2 py-1 px-3">
                <a class="card-result-label" style="text-align: center;">
                    No results found for Properties and Posts!
                </a>
            </div>
        ';
    endif;

    // Reset post data
    wp_reset_postdata();

    // Output the results container content
    echo $search_results_content;

    // End the script
    die();
}






// Test the function by accessing a custom URL
add_action('init', 'test_get_developers_with_alternative_keywords');
function test_get_developers_with_alternative_keywords() {
    if (isset($_GET['test_get_developers'])) {
        $alternative_keywords = get_term_meta(873, 'alternative_keywords', true);
        print_r($alternative_keywords);
        die();
    }
}

function get_developers_with_alternative_keywords() {
    // Initialize array to store developers and their alternative keywords
    $developers_with_alternative_keywords = array();

    // Query developers
    $developers_query = new WP_Query(array(
        'post_type' => 'developer',
        'posts_per_page' => -1,
    ));

    // Check if developers are found
    if ($developers_query->have_posts()) {
        while ($developers_query->have_posts()) {
            $developers_query->the_post();

            // Get developer name
            $developer_name = get_the_title();

            // Get alternative keywords for the developer
            $term_id = get_the_ID(); // Assuming the developer post ID is the term ID
            $alternative_keywords = get_term_meta($term_id, 'alternative_keywords', true);
            $alternative_keywords_array = !empty($alternative_keywords) ? explode(',', $alternative_keywords) : array();

            // Debugging: Print out the retrieved alternative keywords
            error_log('Developer Name: ' . $developer_name);
            error_log('Alternative Keywords: ' . implode(', ', $alternative_keywords_array));

            // Store developer name and alternative keywords in the array
            $developers_with_alternative_keywords[] = array(
                'name' => $developer_name,
                'alternative_keywords' => $alternative_keywords_array,
            );
        }
        wp_reset_postdata();
    }

    // Return the array of developers with their alternative keywords
    return $developers_with_alternative_keywords;
}



// Rest Api
add_action('rest_api_init', 'create_routes');
function create_routes()
{
    register_rest_route('v1', 'get-properties', [
        'methods' => 'GET',
        'callback' => 'getProperties'
    ]);

    register_rest_route('v1', 'get-form', [
        'methods' => 'POST',
        'callback' => 'getForm'
    ]);

    register_rest_route('mapdata/v4', 'getResult', [
        'methods' => 'GET',
        'callback' => 'my_awesome_func_four',
    ]);
    register_rest_route('mapdata/v2', 'getResult', [
        'methods' => 'GET',
        'callback' => 'my_awesome_func_two',
    ]);
    register_rest_route('mapdata/v2', 'lastupdated', [
        'methods' => 'GET',
        'callback' => 'get_last_updated_timestamp_for_entity',
    ]);
    register_rest_route('floorplans/v3', 'getResult', [
        'methods' => 'GET',
        'callback' => 'my_awesome_func_tree',
    ]);
    register_rest_route('floorplans/v5', 'getResult', [
        'methods' => 'GET',
        'callback' => 'get_floor_plan_tu',
    ]);
    register_rest_route('mapdata/v3', 'getResult', [
        'methods' => 'GET',
        'callback' => 'my_awesome_func_final',
    ]);
//    register_rest_route('condoy/v3', 'getResult', [
//        'methods' => 'GET',
//        'callback' => 'process_csv_from_url',
//    ]);
//    register_rest_route('condoy/v4', 'getResult', [
//        'methods' => 'GET',
//        'callback' => 'get_all_property_titles_and_ids',
//    ]);
}

//function get_all_property_titles_and_ids() {
//    // Initialize an empty array to store results
//    $results = array();
//
//    // Query property post-type to retrieve all properties
//    $property_query = new WP_Query(array(
//        'post_type' => 'properties',
//        'posts_per_page' => -1, // Retrieve all posts
//    ));
//
//    // Check if any properties are found
//    if ($property_query->have_posts()) {
//        // Loop through each property
//        while ($property_query->have_posts()) {
//            $property_query->the_post();
//            // Get property ID and title
//            $property_id = get_the_ID();
//            $property_title = get_the_title();
//            // Add property ID and title to results array
//            $results[] = array(
//                'id' => $property_id,
//                'title' => $property_title,
//            );
//        }
//        wp_reset_postdata(); // Reset post data
//    }
//    // Return results
//    return $results;
//}

//function process_csv_from_url() {
//    // URL of the CSV file
//    $csv_url = 'https://condoy.com/wp-content/themes/homeleaderrealty/assets/export.csv';
//
//    // Fetch the CSV file contents
//    $csv_data = file_get_contents($csv_url);
//
//    // Parse the CSV data
//    $csv_rows = explode("\n", $csv_data);
//
//    // Initialize an empty array to store results
//    $results = array();
//
//    // Loop through each row of the CSV
//    foreach ($csv_rows as $row) {
//        // Split CSV row into columns
//        $columns = explode(",", $row);
//
//        // Check if CSV row has expected number of columns (adjust according to your CSV structure)
//        if (count($columns) >= 3) {
//            $id = trim($columns[0]);
//            $title = trim($columns[1]);
//            $city = trim($columns[2]);
//
//            // Query property post-type to find matching title
//            $property_query = new WP_Query(array(
//                'post_type' => 'properties', // Adjust post type as needed
//                'title' => $title, // Query by post title directly
//            ));
//
//            // Check if any property matches the title
//            if ($property_query->have_posts()) {
//                // Output matching properties
//                while ($property_query->have_posts()) {
//                    $property_query->the_post();
//                    // Get the property ID
//                    $property_id = get_the_ID();
//                    // Update the city taxonomy for the matching property
//                    wp_set_object_terms($property_id, $city, 'city', true); // Replace 'city' with your actual taxonomy name
//                    $results[] = array(
//                        'id' => $id,
//                        'title' => $title,
//                        'matching_property' => get_the_title(),
//                        'city_updated' => $city, // Include the updated city
//                    );
//                }
//                wp_reset_postdata(); // Reset post data
//            } else {
//                // No matching property found
//                $results[] = array(
//                    'id' => $id,
//                    'title' => $title,
//                    'matching_property' => 'No matching property found',
//                );
//            }
//        }
//    }
//
//    // Return results
//    return $results;
//}

function getProperties(WP_REST_Request $request)
{
    $cache_key = 'properties_data_' . $_GET['term_id'];
    $auth_user = checkToken();
    $is_login = false;
    if ($auth_user->status != 401 && $auth_user->status != 404) {
        $is_login = true;
    }
    $item = [];
    $i = 0;
    $result = get_transient($cache_key);

    if ($result === false) {
        $args = [
            'post_type' => 'properties',
            'post_status' => 'publish',
            'posts_per_page' => -1,
        ];

        $peroperties = new WP_Query($args);

        while ($peroperties->have_posts()) {
            $peroperties->the_post();

            $terms_ids = wp_get_object_terms(get_the_ID(), 'group', array('fields' => 'ids'));

            $result2[] = [
                'id' => get_the_ID(),
                'title' => strlen(get_the_title())  > 31 ? substr(get_the_title(), 0, 31) . '...' : get_the_title(),
                'content' => strlen(strip_tags(get_the_excerpt()))  > 65 ? substr(strip_tags(get_the_excerpt()), 0, 65) . '...' : strip_tags(get_the_content()),
                'permalink' => get_the_permalink(),
                'shortlink' => wp_get_shortlink(get_the_ID(), 'post', true),
                'thumbnail_url' => get_the_post_thumbnail_url(),
                'term_ids' => $terms_ids,
                'metadata' => [
                    'opt-min-price-sqft' => get_post_meta(get_the_ID(), 'hlr_framework_mapdata', true)['opt-min-price-sqft'],
                    'incentives' => get_post_meta(get_the_ID(), 'hlr_framework_properties-incentives', true),
                    'opt-max-price-sqft' => get_post_meta(get_the_ID(), 'hlr_framework_mapdata', true)['opt-max-price-sqft'],
                    'opt-size-min' => get_post_meta(get_the_ID(), 'hlr_framework_mapdata', true)['opt-size-min'],
                    'opt-size-max' => get_post_meta(get_the_ID(), 'hlr_framework_mapdata', true)['opt-size-max'],
                    'opt-size-max' => get_post_meta(get_the_ID(), 'hlr_framework_mapdata', true)['opt-size-max'],
                    'opt-address' => get_post_meta(get_the_ID(), 'hlr_framework_mapdata', true)['opt-address'],
                    'total_like' => get_post_meta(get_the_ID(), 'total_like', true),
                ],
            ];
        }

        foreach ($result2 as $property) {
            if (in_array($_GET['term_id'], $property['term_ids'])) {
                if ($i < $_GET['page']) {
                    if ($is_login) {
                        $favs = [];
                        if (!empty(get_user_meta($auth_user->data['id'], 'properties_favorites', true))) {
                            $favs = get_user_meta($auth_user->data['id'], 'properties_favorites', true);
                        }
                        if (in_array($property['id'], $favs)) {
                            $bookColor = '#9de450';
                        } else {
                            $bookColor = '';
                        }
                    } else {
                        $bookColor = '';
                    }
                    $items[] = [
                        'data' => $property,
                        'bookColor' => $bookColor
                    ];
                }
                $i++;
            }
        }


        set_transient($cache_key, $items, 5 * MINUTE_IN_SECONDS);

    } else {
        foreach ($result as $property) {
            if (in_array($_GET['term_id'], $property['data']['term_ids'])) {
                if ($i < $_GET['page']) {
                    if ($is_login) {
                        $favs = [];
                        if (!empty(get_user_meta($auth_user->data['id'], 'properties_favorites', true))) {
                            $favs = get_user_meta($auth_user->data['id'], 'properties_favorites', true);
                        }
                        if (in_array($property['data']['id'], $favs)) {
                            $bookColor = '#9de450';
                        } else {
                            $bookColor = '';
                        }
                    } else {
                        $bookColor = '';
                    }
                    $items[] = [
                        'data' => $property['data'],
                        'bookColor' => $bookColor
                    ];
                }
                $i++;
            }
        }
    }

//    wp_send_json([
//        "data6" => $items
//    ]);
    return new WP_REST_Response([
        'list' => $items
    ], 200);
}


function getForm(WP_REST_Request $request)
{

    $validator = new Validator;
    $validator->addValidator('canadaphone', new CanadaPhone());

    $validation = $validator->make($_POST + $_FILES, [
        'fname' => 'required|min:3|max:10',
        'lname' => 'required|min:3|max:10',
        'email' => 'required|email',
        'phone' => 'required|canadaphone',
        'brokerage' => 'required',
    ]);

    $validation->setMessages([
        'fname:required' => 'The First Name is required',
        'fname:min' => 'The First Name minimum is 3',
        'fname:max' => 'The First Name maximum is 10',
        'lname:required' => 'The Last Name is required',
        'lname:min' => 'The Last Name minimum is 3',
        'lname:max' => 'The Last Name maximum is 10',
        'brokerage:required' => 'The Brokerage Name is required',
    ]);

    $validation->validate();

    if ($validation->fails()) {
        $errors = $validation->errors();
        wp_send_json([
            'data' => $errors->firstOfAll(),
            'status' => 'errors'
        ]);
    } else {
        wp_send_json([
            'data' => 'Thanks for getting in touch, a platinum broker will be contact you soon to answer all questions.',
            'status' => 'success'
        ]);
    }
}


function my_awesome_func_two($request)
{
    $lastUpdateDate = get_option('map_version_op');
    $lastUpdateDatePharam = $request->get_param('version');

    if(!empty($lastUpdateDatePharam)){
        if(!empty($lastUpdateDate)){
            if($lastUpdateDatePharam != $lastUpdateDate){
                wp_send_json([
                    'status' => false
                ]);
            }
        }
    }
    // Determine if include_floorplans parameter is set
    $include_floorplans = $request->get_param('include_floorplans');

    // Create a unique cache key based on the request parameters
    $cache_key = 'my_awesome_func_two_data';
    if ($include_floorplans === 'true') {
        $cache_key .= '_include_floorplans';
    }

    // Check if the data is cached
    $cached_data = get_transient($cache_key);

    if (false === $cached_data) {
        $args = array(
            'post_type' => 'properties',
            'post_status' => 'any',
            'posts_per_page' => -1,
        );

        $include_floorplans = $request->get_param('include_floorplans');
        $my_query = new WP_query($args);

        if ($my_query->have_posts()) :
            while ($my_query->have_posts()) : $my_query->the_post();

                $mapMeta = get_post_meta(get_the_ID(), 'hlr_framework_mapdata', true);
                 if($mapMeta['opt-status'] !== "sold out") {
                     if (true == true) {
                         if (!empty($mapMeta)) {
                             $slug = get_post_field('post_name', get_post());

                             // $mapMetaType = array_map(function($item) {
                             //     return ($item == "Townhouse") ? "TownHouse" : $item;
                             // }, $mapMeta['opt-type']);


                             if (!is_array($mapMeta['opt-type']) && $mapMeta['opt-type'] != null) {

                                 $mapMetaType = explode(',', $mapMeta['opt-type']);
                             } else {
                                 $mapMetaType = $mapMeta['opt-type'];
                             }

//                        $mapMetaType = array_map(function ($item) {
//                            return ($item == "Home") ? "Detached" : $item;
//                        }, $mapMetaType);

                             if ($mapMeta['opt-sales-type'] == "Comming soon") {
                                 $mapMeta['opt-sales-type'] = "coming_soon";
                             }
                             $is_floorplan = get_floorplans_from_property(get_the_ID(), $mapMeta['opt-occupancy']);
                             $mapdata[] = [
                                 'post_id' => strval(get_the_ID()),
                                 'title' => get_the_title(),
                                 'available_floorplans' => $mapMeta['opt-available-floorplans'],
                                 //                  'permalink' => get_the_permalink(),
                                 'permalink' => 'https://locatecondo.com/i/' . $slug,
                                 'updated' => get_the_date(),
                                 'address' => $mapMeta['opt-address'],
                                 'thumbnail' => get_the_post_thumbnail_url(),
                                 'pricepersqft' => $mapMeta['opt-pricepersqft'],
                                 'strings' => [],
                                 'terms' => $mapMeta['opt-incentives'],
                                 'price' => $mapMeta['opt-price'],
                                 'min_price' => $mapMeta['opt-price-min'],
                                 'max_price' => $mapMeta['opt-price-max'],
                                 'min_size' => $mapMeta['opt-size-min'],
                                 'max_size' => $mapMeta['opt-size-max'],
                                 'sales_type' => $mapMeta['opt-sales-type'],
                                 'min_bed' => $mapMeta['opt-min-bed'],
                                 'max_bed' => $mapMeta['opt-max-bed'],
                                 'min_bath' => $mapMeta['opt-min-bath'],
                                 'max_bath' => $mapMeta['opt-max-bath'],
                                 'type' => $mapMetaType,
                                 'min_price_sqft' => $mapMeta['opt-min-price-sqft'],
                                 'max_price_sqft' => $mapMeta['opt-max-price-sqft'],
                                 'sqft_avg' => $mapMeta['opt-sqft-avg'],
                                 'occupancy' => $mapMeta['opt-occupancy'],
                                 'coming_soon' => $mapMeta['opt-coming-soon'],
                                 'comission_by_percent' => $mapMeta['opt-comission-by-percent'],
                                 'comission_by_flatfee' => $mapMeta['opt-comission-by-flatfee'],
                                 'floorplans' => $include_floorplans ? (!is_null($is_floorplan) ? $is_floorplan : []) : [],
                                 'city' => $mapMeta['opt-city'],
                                 'studio' => $mapMeta['opt-studio'],
                                 'status' => $mapMeta['opt-status'],
                                 'coords' => [$mapMeta['opt-coords']['longitude'], $mapMeta['opt-coords']['latitude']],
                                 'coords2' => $mapMeta['opt-coords'],
                                 'externalid' => $mapMeta['opt-externalid'],
                             ];
                         }
                     }
                 }
            endwhile;
            wp_reset_postdata();
        else :
            _e('Sorry, no posts matched your criteria.');
        endif;
        set_transient($cache_key, $mapdata, 5 * MINUTE_IN_SECONDS);
    } else {
        // If data is already cached, retrieve it directly
        $mapdata = $cached_data;
    }
    return $mapdata;

}

function sold_out_list($request)
{
    $lastUpdateDate = get_option('map_version_op');
    $lastUpdateDatePharam = $request->get_param('version');

    if(!empty($lastUpdateDatePharam)){
        if(!empty($lastUpdateDate)){
            if($lastUpdateDatePharam != $lastUpdateDate){
                wp_send_json([
                    'status' => false
                ]);
            }
        }
    }
    // Determine if include_floorplans parameter is set
    $include_floorplans = $request->get_param('include_floorplans');

    // Create a unique cache key based on the request parameters
    $cache_key = 'my_awesome_func_two_data';
    if ($include_floorplans === 'true') {
        $cache_key .= '_include_floorplans';
    }

    // Check if the data is cached
    $cached_data = get_transient($cache_key);

    if (false === $cached_data) {
        $args = array(
            'post_type' => 'properties',
            'post_status' => 'any',
            'posts_per_page' => -1,
        );

        $include_floorplans = $request->get_param('include_floorplans');
        $my_query = new WP_query($args);

        if ($my_query->have_posts()) :
            while ($my_query->have_posts()) : $my_query->the_post();

                $mapMeta = get_post_meta(get_the_ID(), 'hlr_framework_mapdata', true);
                 if($mapMeta['opt-status'] !== "sold out"){
                if (true == true) {
                    if (!empty($mapMeta)) {
                        $slug = get_post_field('post_name', get_post());

                        // $mapMetaType = array_map(function($item) {
                        //     return ($item == "Townhouse") ? "TownHouse" : $item;
                        // }, $mapMeta['opt-type']);


                        if (!is_array($mapMeta['opt-type']) && $mapMeta['opt-type'] != null) {

                            $mapMetaType = explode(',', $mapMeta['opt-type']);
                        } else {
                            $mapMetaType = $mapMeta['opt-type'];
                        }

//                        $mapMetaType = array_map(function ($item) {
//                            return ($item == "Home") ? "Detached" : $item;
//                        }, $mapMetaType);

                        if ($mapMeta['opt-sales-type'] == "Comming soon") {
                            $mapMeta['opt-sales-type'] = "coming_soon";
                        }
                        $is_floorplan = get_floorplans_from_property(get_the_ID(), $mapMeta['opt-occupancy']);
                        $mapdata[] = [
                            'post_id' => strval(get_the_ID()),
                            'title' => get_the_title(),
                            'available_floorplans' => $mapMeta['opt-available-floorplans'],
                            //                  'permalink' => get_the_permalink(),
                            'permalink' => 'https://locatecondo.com/i/' . $slug,
                            'updated' => get_the_date(),
                            'address' => $mapMeta['opt-address'],
                            'thumbnail' => get_the_post_thumbnail_url(),
                            'pricepersqft' => $mapMeta['opt-pricepersqft'],
                            'strings' => [],
                            'terms' => $mapMeta['opt-incentives'],
                            'price' => $mapMeta['opt-price'],
                            'min_price' => $mapMeta['opt-price-min'],
                            'max_price' => $mapMeta['opt-price-max'],
                            'min_size' => $mapMeta['opt-size-min'],
                            'max_size' => $mapMeta['opt-size-max'],
                            'sales_type' => $mapMeta['opt-sales-type'],
                            'min_bed' => $mapMeta['opt-min-bed'],
                            'max_bed' => $mapMeta['opt-max-bed'],
                            'min_bath' => $mapMeta['opt-min-bath'],
                            'max_bath' => $mapMeta['opt-max-bath'],
                            'type' => $mapMetaType,
                            'min_price_sqft' => $mapMeta['opt-min-price-sqft'],
                            'max_price_sqft' => $mapMeta['opt-max-price-sqft'],
                            'sqft_avg' => $mapMeta['opt-sqft-avg'],
                            'occupancy' => $mapMeta['opt-occupancy'],
                            'coming_soon' => $mapMeta['opt-coming-soon'],
                            'comission_by_percent' => $mapMeta['opt-comission-by-percent'],
                            'comission_by_flatfee' => $mapMeta['opt-comission-by-flatfee'],
                            'floorplans' => $include_floorplans ? (!is_null($is_floorplan) ? $is_floorplan : []) : [],
                            'city' => $mapMeta['opt-city'],
                            'studio' => $mapMeta['opt-studio'],
                            'status' => $mapMeta['opt-status'],
                            'coords' => [$mapMeta['opt-coords']['longitude'], $mapMeta['opt-coords']['latitude']],
                            'coords2' => $mapMeta['opt-coords'],
                            'externalid' => $mapMeta['opt-externalid'],
                        ];
                    }
                }
            }
            endwhile;
            wp_reset_postdata();
        else :
            _e('Sorry, no posts matched your criteria.');
        endif;
        set_transient($cache_key, $mapdata, 5 * MINUTE_IN_SECONDS);
    } else {
        // If data is already cached, retrieve it directly
        $mapdata = $cached_data;
    }
    return $mapdata;

}

function my_awesome_func_final($request)
{
    $lastUpdateDate = get_option('map_version_op');
    $lastUpdateDatePharam = $request->get_param('version');

    if(!empty($lastUpdateDatePharam)){
        if(!empty($lastUpdateDate)){
            if($lastUpdateDatePharam == $lastUpdateDate){
                wp_send_json([
                    'status' => false
                ]);
            }
        }
    }
    // Determine if include_floorplans parameter is set
    $include_floorplans = $request->get_param('include_floorplans');

    // Create a unique cache key based on the request parameters
    $cache_key = 'my_awesome_func_two_data';
    if ($include_floorplans === 'true') {
        $cache_key .= '_include_floorplans';
    }

    // Check if the data is cached
    $cached_data = get_transient($cache_key);

    if (false === $cached_data) {
        $args = array(
            'post_type' => 'properties',
            'post_status' => 'publish',
            'posts_per_page' => -1,
        );

        $include_floorplans = $request->get_param('include_floorplans');
        $my_query = new WP_query($args);

        if ($my_query->have_posts()) :
            while ($my_query->have_posts()) : $my_query->the_post();

                $mapMeta = get_post_meta(get_the_ID(), 'hlr_framework_mapdata', true);
                 if($mapMeta['opt-status'] !== "sold out"){
                if (true == true) {
                    if (!empty($mapMeta)) {
                        $slug = get_post_field('post_name', get_post());

                        // $mapMetaType = array_map(function($item) {
                        //     return ($item == "Townhouse") ? "TownHouse" : $item;
                        // }, $mapMeta['opt-type']);


                        if (!is_array($mapMeta['opt-type']) && $mapMeta['opt-type'] != null) {

                            $mapMetaType = explode(',', $mapMeta['opt-type']);
                        } else {
                            $mapMetaType = $mapMeta['opt-type'];
                        }

//                        $mapMetaType = array_map(function ($item) {
//                            return ($item == "Home") ? "Detached" : $item;
//                        }, $mapMetaType);


                        $is_floorplan = get_floorplans_from_property(get_the_ID(), $mapMeta['opt-occupancy']);
                        $mapdata[] = [
                            'post_id' => strval(get_the_ID()),
                            'title' => get_the_title(),
                            'available_floorplans' => $mapMeta[$mapMeta['opt-available-floorplans']],
                            //                  'permalink' => get_the_permalink(),
                            'permalink' => 'https://locatecondo.com/i/' . $slug,
                            'updated' => get_the_date(),
                            'address' => $mapMeta['opt-address'],
                            'thumbnail' => get_the_post_thumbnail_url(),
                            'pricepersqft' => $mapMeta['opt-pricepersqft'],
                            'strings' => [],
                            'terms' => $mapMeta['opt-incentives'],
                            'price' => $mapMeta['opt-price'],
                            'min_price' => $mapMeta['opt-price-min'],
                            'max_price' => $mapMeta['opt-price-max'],
                            'min_size' => $mapMeta['opt-size-min'],
                            'max_size' => $mapMeta['opt-size-max'],
                            'sales_type' => $mapMeta['opt-sales-type'],
                            'min_bed' => $mapMeta['opt-min-bed'],
                            'max_bed' => $mapMeta['opt-max-bed'],
                            'min_bath' => $mapMeta['opt-min-bath'],
                            'max_bath' => $mapMeta['opt-max-bath'],
                            'type' => $mapMetaType,
                            'min_price_sqft' => $mapMeta['opt-min-price-sqft'],
                            'max_price_sqft' => $mapMeta['opt-max-price-sqft'],
                            'sqft_avg' => $mapMeta['opt-sqft-avg'],
                            'occupancy' => $mapMeta['opt-occupancy'],
                            'coming_soon' => $mapMeta['opt-coming-soon'],
                            'comission_by_percent' => $mapMeta['opt-comission-by-percent'],
                            'comission_by_flatfee' => $mapMeta['opt-comission-by-flatfee'],
                            'floorplans' => $include_floorplans ? (!is_null($is_floorplan) ? $is_floorplan : []) : [],
                            'city' => $mapMeta['opt-city'],
                            'studio' => $mapMeta['opt-studio'],
                            'status' => $mapMeta['opt-status'],
                            'coords' => [$mapMeta['opt-coords']['longitude'], $mapMeta['opt-coords']['latitude']],
                            'coords2' => $mapMeta['opt-coords'],
                            'externalid' => $mapMeta['opt-externalid'],
                        ];
                    }
                }
            }
            endwhile;
            wp_reset_postdata();
        else :
            _e('Sorry, no posts matched your criteria.');
        endif;
        set_transient($cache_key, $mapdata, 5 * MINUTE_IN_SECONDS);
    } else {
        // If data is already cached, retrieve it directly
        $mapdata = $cached_data;
    }
    $output = [
        "version" =>$lastUpdateDate,
        "data" => $mapdata,
        "status" => true
    ];
    return $output;

}

function get_last_updated_timestamp_for_entity() {
// Fetch the latest modified post for post type 'properties'
    $args_properties_modified = array(
        'post_type'      => 'properties',
        'posts_per_page' => 1,
        'orderby'        => 'modified',
        'order'          => 'DESC',
    );
    $latest_properties_modified_post = get_posts($args_properties_modified);

// Fetch the latest created post for post type 'properties'
    $args_properties_created = array(
        'post_type'      => 'properties',
        'posts_per_page' => 1,
        'orderby'        => 'date',
        'order'          => 'DESC',
    );
    $latest_properties_created_post = get_posts($args_properties_created);

// Fetch the latest modified post for post type 'floorplans'
    $args_floorplans_modified = array(
        'post_type'      => 'floorplans',
        'posts_per_page' => 1,
        'orderby'        => 'modified',
        'order'          => 'DESC',
    );
    $latest_floorplans_modified_post = get_posts($args_floorplans_modified);

// Fetch the latest created post for post type 'floorplans'
    $args_floorplans_created = array(
        'post_type'      => 'floorplans',
        'posts_per_page' => 1,
        'orderby'        => 'date',
        'order'          => 'DESC',
    );
    $latest_floorplans_created_post = get_posts($args_floorplans_created);

// Get the creation and modification times for post type 'properties'
    $latest_properties_created_time = $latest_properties_created_post ? strtotime($latest_properties_created_post[0]->post_date) : 0;
    $latest_properties_modified_time = $latest_properties_modified_post ? strtotime($latest_properties_modified_post[0]->post_modified) : 0;

// Get the creation and modification times for post type 'floorplans'
    $latest_floorplans_created_time = $latest_floorplans_created_post ? strtotime($latest_floorplans_created_post[0]->post_date) : 0;
    $latest_floorplans_modified_time = $latest_floorplans_modified_post ? strtotime($latest_floorplans_modified_post[0]->post_modified) : 0;

    $overall_newer_timestamp = max($latest_properties_created_time, $latest_properties_modified_time, $latest_floorplans_created_time, $latest_floorplans_modified_time);

// Output the overall newer timestamp
    return $overall_newer_timestamp;
}
function my_awesome_func_four($request)
{
    // Determine if include_floorplans parameter is set
    $include_floorplans = $request->get_param('include_floorplans');
    $args = array(
        'post_type' => 'properties',
        'post_status' => 'publish',
        'posts_per_page' => -1,
    );

    $include_floorplans = $request->get_param('include_floorplans');
    $my_query = new WP_query($args);

    if ($my_query->have_posts()) :
        while ($my_query->have_posts()) : $my_query->the_post();

            $mapMeta = get_post_meta(get_the_ID(), 'hlr_framework_mapdata', true);
             if($mapMeta['opt-status'] !== "sold out"){
            if (true == true) {
                if (!empty($mapMeta)) {
                    $slug = get_post_field('post_name', get_post());

                    // $mapMetaType = array_map(function($item) {
                    //     return ($item == "Townhouse") ? "TownHouse" : $item;
                    // }, $mapMeta['opt-type']);


                    if (!is_array($mapMeta['opt-type']) && $mapMeta['opt-type'] != null) {

                        $mapMetaType = explode(',', $mapMeta['opt-type']);
                    } else {
                        $mapMetaType = $mapMeta['opt-type'];
                    }

//                    $mapMetaType = array_map(function ($item) {
//                        return ($item == "Home") ? "Detached" : $item;
//                    }, $mapMetaType);


                    $is_floorplan = get_floorplans_from_property(get_the_ID(), $mapMeta['opt-occupancy']);
                    if ($mapMeta['opt-sales-type'] === "Comming soon") {
                        $mapMeta['opt-sales-type'] = "coming_soon";
                    }
                    $mapdata[] = [
                        'post_id' => strval(get_the_ID()),
                        'title' => get_the_title(),
                        'available_floorplans' => $mapMeta[$mapMeta['opt-available-floorplans']],
                        //                  'permalink' => get_the_permalink(),
                        'permalink' => 'https://locatecondo.com/i/' . $slug,
                        'updated' => get_the_date(),
                        'address' => $mapMeta['opt-address'],
                        'thumbnail' => get_the_post_thumbnail_url(),
                        'pricepersqft' => $mapMeta['opt-pricepersqft'],
                        'strings' => [],
                        'terms' => $mapMeta['opt-incentives'],
                        'price' => $mapMeta['opt-price'],
                        'min_price' => $mapMeta['opt-price-min'],
                        'max_price' => $mapMeta['opt-price-max'],
                        'min_size' => $mapMeta['opt-size-min'],
                        'max_size' => $mapMeta['opt-size-max'],
                        'sales_type' => $mapMeta['opt-sales-type'],
                        'min_bed' => $mapMeta['opt-min-bed'],
                        'max_bed' => $mapMeta['opt-max-bed'],
                        'min_bath' => $mapMeta['opt-min-bath'],
                        'max_bath' => $mapMeta['opt-max-bath'],
                        'type' => $mapMetaType,
                        'min_price_sqft' => $mapMeta['opt-min-price-sqft'],
                        'max_price_sqft' => $mapMeta['opt-max-price-sqft'],
                        'sqft_avg' => $mapMeta['opt-sqft-avg'],
                        'occupancy' => $mapMeta['opt-occupancy'],
                        'coming_soon' => $mapMeta['opt-coming-soon'],
                        'comission_by_percent' => $mapMeta['opt-comission-by-percent'],
                        'comission_by_flatfee' => $mapMeta['opt-comission-by-flatfee'],
                        'floorplans' => $include_floorplans ? (!is_null($is_floorplan) ? $is_floorplan : []) : [],
                        'city' => $mapMeta['opt-city'],
                        'studio' => $mapMeta['opt-studio'],
                        'status' => $mapMeta['opt-status'],
                        'coords' => [$mapMeta['opt-coords']['longitude'], $mapMeta['opt-coords']['latitude']],
                        'coords2' => $mapMeta['opt-coords'],
                        'externalid' => $mapMeta['opt-externalid'],
                    ];
                }
            }
        }
        endwhile;
        wp_reset_postdata();
    else :
        _e('Sorry, no posts matched your criteria.');
    endif;
    return $mapdata;
}
function get_floorplans_from_property($property_id,$occupancy)
{
    $floorplans = get_posts( array(
        'post_type' => 'floorplans',
        'posts_per_page' => -1,
        'orderby' => 'title',
        'order' => 'ASC',
        'post_status' => 'publish',
        'meta_query' => array(
            array(
                'key' => 'associated_property',
                'value' => $property_id,
                'compare' => '='
            )
        )
    ));

//    foreach ($floorplans as $floorplan){
    foreach (array_slice($floorplans, 0, 5) as $floorplan){
        $floorplanData = get_post_meta($floorplan->ID, 'hlr_framework_floorplans', true);
        if (!empty($floorplanData)) {
            $floorplansFinal[] =
                [
                    "id" => $floorplan->ID,
                    "post_id" => $property_id,
                    "suite_name" => $floorplanData['opt-floorplans-suite-name'],
                    "min_price" => $floorplanData['opt-floorplans-price-from'],
                    "min_size" => $floorplanData['opt-floorplans-size'],
                    "min_bath" => $floorplanData['opt-floorplans-baths'],
                    "min_bed" => $floorplanData['opt-floorplans-beds'],
                    'occupancy' => $occupancy,
                    "view" => $floorplanData['opt-floorplans-view'],
                    "pricepersqft" => $floorplanData['opt-floorplans-price-per'],
                    "availability" => $floorplanData['opt-floorplans-status'],
                    "url" => $floorplan->guid
                ];
        }
    }
    if(!isset($floorplansFinal)){
        $floorplansFinal = [];
    }
    return $floorplansFinal;
}

function save_last_update($post_id){
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    $post_title = get_the_title($post_id);
    if (empty($post_title)) {
        return;
    }
    update_option('map_version_op', current_time('timestamp'));
}




//  get Pre-construction Projects Progress

add_action('wp_ajax_get_PreConstruction', 'get_PreConstruction');

function get_PreConstruction() {
    $url = 'https://hlrihub.com/api/v1/getProjectUrbanToronto';

    $response = wp_remote_get($url, array(
        'headers' => array(
            'Authorization' => 'Bearer 215|hptLGTyj6omxtBs0ngxkSPvLj9BqtXCyiGgkxN3T',
            'Accept' => 'application/json'
        )
    ));   

    if (is_wp_error($response)) {
        wp_send_json_error('Failed to retrieve data');
    }

    $body = wp_remote_retrieve_body($response);

    // Log the entire response
    // error_log(print_r($response, true));

    // wp_send_json_success($response);
    wp_send_json_success(json_decode($body));

    wp_die();
}

add_action('wp_ajax_get_floor_plan_types', 'get_floor_plan_types');
add_action('wp_ajax_nopriv_get_floor_plan_types', 'get_floor_plan_types');

function get_floor_plan_tu(WP_REST_Request $request) {
//    if ( ! isset( $_GET['property_id'] ) ) {
//        wp_send_json_success($_GET['property_id']);
//        return;
//    }

    $property_id = intval( $_GET['property_id'] );
    $floor_plan_types = get_post_meta( $property_id, 'hlr_framework_mapdata', true );
    wp_send_json( $floor_plan_types['floor_plan_types'] );
}
function get_floor_plan_types() {
    if ( ! isset( $_POST['property_id'] ) ) {
        wp_send_json_error('Property ID not provided');
        return;
    }

    $property_id = intval( $_POST['property_id'] );
    $floor_plan_types = get_post_meta( $property_id, 'hlr_framework_mapdata', true );


    if ( empty( $floor_plan_types['floor_plan_types'] ) ) {
        wp_send_json_error('No floor plan types found');
        return;
    }

    $options = array();
    foreach ( $floor_plan_types['floor_plan_types'] as $type ) {
        $options[] = array(
            'title' => $type['title'],
            'label' => $type['title'],
        );
    }
    $options[] = array(
        'title' => 'NA',
        'label' => 'NA',
    );
    $options[] = array(
        'title' => '',
        'label' => 'Empty',
    );
    wp_send_json_success( $options );
}

function enqueue_dynamic_floor_plan_script() {
    wp_enqueue_script('dynamic-floor-plan-script', get_template_directory_uri() . '/assets/js/dynamic-floor-plan13.js', array(), null, true);
    wp_localize_script('dynamic-floor-plan-script', 'ajaxurl', array('url' => admin_url('admin-ajax.php')));
}
add_action('admin_enqueue_scripts', 'enqueue_dynamic_floor_plan_script');

