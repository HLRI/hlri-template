<?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$term = get_queried_object();

$arg = [
    'post_type' => 'agents',
    'post_status' => 'publish',
    'posts_per_page'   => get_option('posts_per_page'),
    'paged' => $paged,
];

$profiles = new WP_Query($arg);

if ($profiles->have_posts()) :
    // Loop through profiles to display the agent order
    while ($profiles->have_posts()) :
        $profiles->the_post();
        // Retrieve the opt-agents-order value for the current post
        $agent_order = get_post_meta(get_the_ID(), 'hlr_framework_agents', true);
        $order = isset($agent_order['opt-agents-order']) ? $agent_order['opt-agents-order'] : 'N/A';
        echo '<div>' . $order . '</div>';
    endwhile;
    // Restore original post data
    wp_reset_postdata();
endif;
?>
