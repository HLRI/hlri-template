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
include HLR_THEME_PATH . 'inc/admin_functions.php';
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

add_filter('wpcf7_form_elements', function( $content ) {
    $dom = new DOMDocument();
    $dom->preserveWhiteSpace = false;
    $dom->loadHTML(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

    $xpath = new DomXPath($dom);
    $spans = $xpath->query("//span[contains(@class, 'wpcf7-form-control-wrap')]" );

    foreach ( $spans as $span ) :
        $children = $span->firstChild;
        $span->parentNode->replaceChild( $children, $span );
    endforeach;

    return $dom->saveHTML();
});

add_filter('wpcf7_autop_or_not', '__return_false');

//add_filter('wpcf7_mail_tag_replacement', 'wpcf7_add_lottery_code_tag', 10, 4);
//function wpcf7_add_lottery_code_tag($output, $tag, $submission, $instance) {
//    if ('lottery-code' === $tag->name) {
//        // Generate a unique lottery code
//        $lotteryCode = strtoupper('LOT-' . time() . '-' . date('Ymd'));
//        $_SESSION['lottery-code'] = $lotteryCode;
//        return $lotteryCode;
//    }
//
//    return $output;
//}

function start_session() {
    if (!session_id()) {
        session_start();
    }
}
add_action('init', 'start_session');

add_action("wpcf7_before_send_mail", "wpcf7_sendtogeneralformhandlerpreconstruction");
function wpcf7_sendtogeneralformhandlerpreconstruction($WPCF7_ContactForm) {
    // Get current form
    $wpcf7 = WPCF7_ContactForm::get_current();
    // Get current submission instance
    $submission = WPCF7_Submission::get_instance();

    // Proceed if submission exists
    if ($submission) {
        // Get submitted data
        $data = $submission->get_posted_data();

        // Ensure data is not empty
        if (!empty($data)) {
            // Use the referring URL to determine the current page
            if (isset($_SERVER['HTTP_REFERER'])) {
                $referrer_url = $_SERVER['HTTP_REFERER'];
                $page_id = url_to_postid($referrer_url);

                if ($page_id) {
                    $current_page_title = get_the_title($page_id);
                    $current_page_url = get_permalink($page_id);
                } else {
                    $current_page_title = 'Unknown Page';
                    $current_page_url = $referrer_url;
                }
            } else {
                $current_page_title = 'Direct Access';
                $current_page_url = '';
            }

            // Add the page title and URL to the data
            $data['pageTitle'] = $current_page_title;
            $data['pageUrl'] = $current_page_url;
            $data['url'] = $current_page_url;
            if (strpos($current_page_url, '/properties/') !== false && strpos($current_page_url, '/floorplans/') == false) {
                $data['tags'] = $current_page_title;
                $data['street'] = $current_page_title;
                $data['utm_source'] = $current_page_title;
                $data['type'] = 'Property Inquiry';
            } elseif (strpos($current_page_url, '/floorplans/') !== false) {
                $associated_property_id = get_post_meta($page_id, 'associated_property', true);
                $current_page_title = get_the_title($associated_property_id);
                $data['tags'] = [$current_page_title, 'Floorplan Request'];
                $data['street'] = $current_page_title;
                $data['utm_source'] = $current_page_title;
                $data['type'] = 'Property Inquiry';
            } elseif (strpos($current_page_url, 'contact-us') !== false) {
                $data['utm_source'] = $current_page_title;
                $data['type'] = 'General Inquiry';
            } elseif (strpos($current_page_url, 'join-us') !== false) {
                $data['tags'] = ['Realtor'];
                $data['utm_source'] = $current_page_title;
                $data['type'] = 'Registration';
            } elseif (strpos($current_page_url, '/agents/') !== false) {
                $data['utm_source'] = $current_page_title . ' Contact Page - CondoY.com';
                $data['pageTitle'] = 'Contact ' . $current_page_title;
                $data['type'] = 'General Inquiry';
                $data['assignedTo'] = $current_page_title;
            } elseif (strpos($current_page_url, 'holidays-draw') !== false) {
                $data['utm_source'] = $current_page_title;
                $data['type'] = 'Registration';
                // Generate the lottery code
                $lotteryCode = strtoupper('LOT-' . time() . '-' . date('Ymd'));
                $data['lottery-code'] = $lotteryCode;

                // Add the lottery code to the message
                $data['your-message'] = "\nProperty Interest: " . $data['your-message'][0];
                $data['your-message'] .= "\nLottery Code: " . $lotteryCode;
                $_SESSION['lottery-code'] = $lotteryCode;
                $data['street'] = '';
            } elseif (strpos($current_page_url, 'test') !== false) {
                $priceRanges = [
                    "Under $100K",
                    "$100K - $150K",
                    "$150K - $200K",
                    "$200K - $250K",
                    "$250K - $300K",
                    "$300K - $350K",
                    "$350K - $400K",
                    "$400K - $450K",
                    "$450K - $500K",
                    "$500K - $600K",
                    "$600K - $700K",
                    "$700K - $800K",
                    "$800K - $900K",
                    "$900K - $1M",
                    "$1M+",
                    "$5M+"
                ];
                $data['type'] = 'Seller Inquiry';
                $data['message'] = 'inquiry for: ' . $data['transaction']
                    . "\n\n Price Range: " . $data['price_range'] . "\n\n"
                    . "\n\n Property Type: " . $data['property_type'] . "\n\n"
                    . "\n\n Property Address: " . $data['street'] . "\n\n"
                    . "\n\n Postal Code: " . $data['zipcode'] . "\n\n" ;
            }

            // URL for the webhook endpoint
            $urlsend = 'http://locatecondo.com/web_controllers/form_controllers/general_form.php';

            // Prepare cURL
            $chsend = curl_init($urlsend);
            $datasend = array(
                'firstName' => $data['your-name'],
                'lastName' => isset($data['your-lastname']) ? $data['your-lastname'] : '', // Handle missing fields
                'emails' => $data['your-email'],
                'phones' => $data['your-phone'],
                'message' => $data['your-message'] . "\n" . isset($data['lottery-code']) ? $data['lottery-code'] : '',
                'isrealtor' => is_array($data['realtor']) ? implode(", ", $data['realtor']) : $data['realtor'],
                'type' => $data['type'],
                'pageTitle' => $data['pageTitle'], // Use the fetched title
                'pageUrl' => $data['pageUrl'],     // Use the fetched URL
                'url' => $data['url'],
                'utm_campaign' => $data['utm_campaign'],
                'utm_medium' => $data['utm_medium'],
                'utm_content' => $data['utm_source'],
                'utm_term' => $data['utm_term'],
                'custom_source' => $data['utm_source'],
                'street' => $data['street'],
                'tags' => $data['tags'],
                'tagArray' => $data['tagArray'],
                'assignedTo' => $data['assignedTo']
            );

            mail("shahab.a@homeleaderrealty.com", 'data', json_encode($datasend));
            $payloadsend = json_encode(array("formData" => $datasend));
            curl_setopt($chsend, CURLOPT_POSTFIELDS, $payloadsend);
            curl_setopt($chsend, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
            curl_setopt($chsend, CURLOPT_RETURNTRANSFER, true);

            // Debugging: check for cURL errors
            $resultsend = curl_exec($chsend);
            if (curl_errno($chsend)) {
                $error_msg = curl_error($chsend);
                error_log("cURL error: " . $error_msg);
            } else {
                error_log("cURL result: " . $resultsend);
            }

            curl_close($chsend);
        } else {
            error_log("No data found in the submission.");
        }
    } else {
        error_log("No submission instance found.");
    }
}







function schedule_remove_hot_deals() {
    if (!wp_next_scheduled('remove_hot_deals_properties_event')) {
        wp_schedule_event(time(), 'monthly', 'remove_hot_deals_properties_event');
    }
}

function remove_hot_deals_properties() {
    $args = [
        'post_type'      => 'properties',
        'posts_per_page' => -1,
        'tax_query'      => [
            [
                'taxonomy' => 'group',
                'field'    => 'slug',
                'terms'    => 'this-month-hot-new-projects-in-toronto',
            ],
        ],
    ];

    $query = new WP_Query($args);

    echo 'Checking properties...' . '<br>';

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $date = get_the_modified_time();
            // Convert stored date to timestamp for comparison
            $date_timestamp = strtotime($date);
            $one_months_ago = strtotime('-1 months');

            if ($date_timestamp && $date_timestamp < $one_months_ago) {
                wp_remove_object_terms(get_the_ID(), 'this-month-hot-new-projects-in-toronto', 'group');
            }
        }
    }

    wp_reset_postdata();
}

add_action('remove_hot_deals_properties_event', 'remove_hot_deals_properties');


function schedule_remove_just_launched() {
    if (!wp_next_scheduled('remove_just_launched_properties_event')) {
        wp_schedule_event(time(), 'daily', 'remove_just_launched_properties_event');
    }
}
add_action('wp', 'schedule_remove_just_launched');


function remove_just_launched_properties() {
    $args = [
        'post_type'      => 'properties',
        'posts_per_page' => -1,
        'tax_query'      => [
            [
                'taxonomy' => 'group',
                'field'    => 'slug',
                'terms'    => 'just-launched',
            ],
        ],
    ];

    $query = new WP_Query($args);

    echo 'Checking properties...' . '<br>';

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $mdata = get_post_meta(get_the_ID(), 'hlr_framework_mapdata', true);

            // Ensure $mdata is an array and contains the opt-launched-date key
            if (is_array($mdata) && !empty($mdata['opt-launched-date'])) {
                $date = $mdata['opt-launched-date'];

                // Convert stored date to timestamp for comparison
                $date_timestamp = strtotime($date);
                $six_months_ago = strtotime('-6 months');

                if ($date_timestamp && $date_timestamp <= $six_months_ago) {
                     wp_remove_object_terms(get_the_ID(), 'just-launched', 'group');
                }
            }
        }
    }

    wp_reset_postdata();
}

add_action('remove_just_launched_properties_event', 'remove_just_launched_properties');


add_action('save_post', 'update_property_price_per_sqft_on_floorplan_edit', 10, 3);

function update_property_price_per_sqft_on_floorplan_edit($post_id, $post, $update) {
    // Exit if this is an auto-save or a revision
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if ($post->post_type !== 'floorplans') return;

    // Get the associated property ID from the floorplan
    $associated_property_id = get_post_meta($post_id, 'associated_property', true);
    if (empty($associated_property_id)) return;

    // Fetch all floorplans for the associated property
    $associated_floorplans = get_posts(array(
        'post_type' => 'floorplans',
        'posts_per_page' => -1,
        'fields' => 'ids',
        'meta_query' => array(
            array(
                'key' => 'associated_property',
                'value' => $associated_property_id,
                'compare' => '='
            )
        )
    ));
    $totalFloors = [];
    foreach ($associated_floorplans as $floorplan_id) {
        $floorplans = get_post_meta($floorplan_id, 'hlr_framework_floorplans', true);
        $interiorSize = floatval($floorplans['opt-floorplans-interior-size'] ?? 0);
        $priceFrom = floatval($floorplans['opt-floorplans-price-from'] ?? 0);

        if ($interiorSize > 0 && $priceFrom > 0) {
            $totalFloors[] = round($priceFrom / $interiorSize, 2);
        }
    }

    $averagePropertySqft = count($totalFloors) ? ceil(array_sum($totalFloors) / count($totalFloors)) : 0;
    // Retrieve the existing map data for the associated property
    $mapdata = get_post_meta($associated_property_id, 'hlr_framework_mapdata', true);

    if (is_array($mapdata)) {
        // Update the `opt-pricepersqft` field
        $mapdata['opt-pricepersqft'] = $averagePropertySqft;

        // Save the updated map data back to the property
        update_post_meta($associated_property_id, 'hlr_framework_mapdata', $mapdata);
    }
}




















//disable scrool on inputs
function disable_scroll_on_inputs($hook) {
    // Check if the current screen is 'post' for the required post types
    $screen = get_current_screen();
    if ($screen->post_type) {
        // Add inline script to disable mouse wheel on range and number inputs
        $script = <<<EOT
        <script>
          document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('input[type="range"], input[type="number"]').forEach(input => {
              input.addEventListener('wheel', (event) => {
                event.preventDefault(); // Stop default scroll behavior
              });
            });
          });
        </script>
        EOT;
        echo $script;
    }
}
add_action('admin_footer', 'disable_scroll_on_inputs');