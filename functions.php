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


function custom_shortcode_atts_wpcf7_filter( $out, $pairs, $atts ) {
    $my_attr = 'your-subject';

    if ( isset( $atts[$my_attr] ) ) {
        $out[$my_attr] = $atts[$my_attr];
    }

    return $out;
}
add_filter( 'shortcode_atts_wpcf7', 'custom_shortcode_atts_wpcf7_filter', 10, 3 );

add_action("wpcf7_before_send_mail", "wpcf7_sendtogeneralformhandlerpreconstruction");
function wpcf7_sendtogeneralformhandlerpreconstruction($WPCF7_ContactForm) {
    // Specify the ID of the form you want to target
//     $target_form_id = '88b86af';

    // Check if the current form matches the target form ID
//     if ($WPCF7_ContactForm->id() == $target_form_id) {
    // Get current form
    $wpcf7 = WPCF7_ContactForm::get_current();
    // get current SUBMISSION instance
    $submission = WPCF7_Submission::get_instance();

    // Ok go forward
    if ($submission) {
        // get submission data
        $data = $submission->get_posted_data();

        // nothing's here... do nothing...
        if (!empty($data)) {
            // extract posted data for example to get name and change it
            $urlsend = 'http://locatecondo.com/web_controllers/form_controllers/general_form.php'; // link inja
            $chsend = curl_init($urlsend);
            $datasend = array(
                'firstName' => $data['your-name'],
                'lastName' => $data['your-lastname'],
                'emails' => $data['your-email'],
                'phones' => $data['your-phone'],
                'message' => $data['your-message'],
                'isrealtor' => $data['realtor'],
                'type' => $data['type'],
                'pageTitle' => $data['pageTitle'],
                'pageUrl' => $data['pageUrl'],
                'url' => $data['url'],
                'utm_campaign' => $data['utm_campaign'],
                'utm_medium' => $data['utm_medium'],
                'utm_content' => $data['utm_source'],
                'utm_term' => $data['utm_term'],
                'custom_source' => $data['utm_source'],
                'street' => $data['street'],
                'tags' => $data['tags'],
                'tagArray' => $data['tagArray'],
            );
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
//     } else {
//         error_log("Form ID does not match. Skipping.");
//     }
}













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

