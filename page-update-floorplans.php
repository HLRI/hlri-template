<?php
/*
Template Name: Update Floorplans Status
*/

if (!current_user_can('manage_options')) {
    wp_die('You do not have permission to access this page.');
}


//$args1 = [
//    'post_type' => 'properties',
//    'post_status' => 'publish',
//    'posts_per_page' => -1,
//];
//
//$peroperties = new WP_Query($args1);
//
//while ($peroperties->have_posts()) {
//    $peroperties->the_post();
//
//    $post_id = get_post_meta(get_the_ID(), 'hlr_framework_mapdata', true)['opt-coords']['address'];
//    if ($post_id === '300 Richmond St W #300, Toronto' ){
//        echo get_the_ID() . '<br>';
//    }
//}



// Get property ID from the query parameter
$property_id = isset($_GET['property_id']) ? intval($_GET['property_id']) : 0;






















if ($property_id) {


    // Query all floorplans linked to the property via "associated_property" taxonomy
    $args = array(
        'post_type' => 'floorplans',
        'posts_per_page' => -1,
        'orderby'   => 'meta_value',
        'order' => 'DESC',
        'meta_query' => array(
            array(
                'key' => 'associated_property',
                'value' => $property_id,
                'compare' => '='
            )
        )
    );

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
        wp_reset_query();

        $message = "All floorplans for the specified property have been marked as 'Sold Out'.";

    } else {
        $message = "No floorplans found for the specified property.";
    }
} else {
    $message = "No valid property ID provided.";
}

get_header();
?>

    <div class="container mt-5 mb-5 pt-5 pb-5">
    <div class="mt-5 mb-5 pt-5 pb-5">

    <h1>Update Floorplans Status for <?= get_the_title($property_id) ?></h1>
        <p><?= esc_html($message); ?></p>
    </div>
    </div>

<?php
get_footer();
