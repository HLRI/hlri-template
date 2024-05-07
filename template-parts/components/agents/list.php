<?php $theme_options = get_option('hlr_framework'); ?>

<?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$term = get_queried_object();
$arg = [
    'post_type' => 'agents',
    'post_status' => 'publish',
    'posts_per_page'   => 5,
    'paged' => $paged,
];

$profiles = new WP_Query($arg);

?>
<?php if ($profiles->have_posts()) : ?>
    <div class="container-fluid px-5 mt-10">
    <div class="row">
    <?php     $sorted_profiles = array();
    ?>
    <?php
    // Initialize an array to store agents sorted by opt-agents-order
    $sorted_profiles = array();

    // Start the loop to populate the sorted_profiles array
    while ($profiles->have_posts()) : $profiles->the_post();
        // Retrieve the opt-agents-order value for the current post
        $agent = get_post_meta(get_the_ID(), 'hlr_framework_agents', true);
        $order = $agent['opt-agents-order'];

        // Add the current agents to the sorted_profiles array with opt-agents-order as the key
        $sorted_profiles[$order] = get_post();
    endwhile;

    // Sort the sorted_profiles array based on opt-agents-order
    ksort($sorted_profiles);

    // Loop through sorted_profiles to display the agents
    foreach ($sorted_profiles as $post) :
        setup_postdata($post);
        // Include your template part here
        include(HLR_THEME_COMPONENT . 'agents/card.php');
    endforeach;

    // Restore original post data
    wp_reset_postdata();
    ?>
    </div>
    </div>
<?php endif; ?>