<?php
/*
Template Name: Update Floorplans Status
*/

if (!current_user_can('manage_options')) {
    wp_die('You do not have permission to access this page.');
}

// Get property ID from the query parameter
$property_id = isset($_GET['property_id']) ? intval($_GET['property_id']) : 0;

if ($property_id) {
    // Query all floorplans linked to the property via "associated_property" taxonomy
    $args = [
        'post_type'      => 'floorplan', // Replace with your floorplan post type name
        'posts_per_page' => -1,
        'tax_query'      => [
            [
                'taxonomy' => 'associated_property',
                'field'    => 'term_id',
                'terms'    => $property_id,
            ],
        ],
    ];

    $floorplans = new WP_Query($args);

    if ($floorplans->have_posts()) {
        while ($floorplans->have_posts()) {
            $floorplans->the_post();
            $floorplan_id = get_the_ID();

            // Get existing meta data and update status
            $meta = get_post_meta($floorplan_id, 'hlr_framework_floorplans', true);
            if (is_array($meta)) {
                $meta['opt-floorplans-status'] = 'sold_out';
                update_post_meta($floorplan_id, 'hlr_framework_floorplans', $meta);
            }
        }
        wp_reset_postdata();

        $message = "All floorplans for the specified property have been marked as 'Sold Out'.";
    } else {
        $message = "No floorplans found for the specified property.";
    }
} else {
    $message = "No valid property ID provided.";
}

get_header();
?>

    <div class="wrap">
        <h1>Update Floorplans Status</h1>
        <p><?= esc_html($message); ?></p>
    </div>

<?php
get_footer();
