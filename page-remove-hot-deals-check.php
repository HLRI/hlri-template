<?php
/* Template Name: Remove Properties from Hot Deals (1 month) */

$action = $_GET['action'];

if ($action == '1_month') {
    do_action('remove_hot_deals_properties_event');
    echo "Action executed successfully.";
    exit;
} else{
    global $wp_query;
    $wp_query->set_404();
    status_header( 404 );
    get_template_part( 404 ); // Load the 404 template
    exit;
}
