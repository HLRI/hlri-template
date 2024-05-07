<?php $theme_options = get_option('hlr_framework'); ?>

<?php
$arg = [
    'post_type'      => 'agents',
    'post_status'    => 'publish',
    'posts_per_page' => -1
];

$profiles = new WP_Query($arg);
?>
<?php if ($profiles->have_posts()) : ?>
    <?php
    $sorted_profiles_with_order = array(); // Array for agents with non-empty order
    $profiles_without_order = array(); // Array for agents with empty order
    ?>
    <div class="container-fluid px-5 mt-10">
        <div class="row">
            <?php
            // Start the loop to populate the sorted_profiles_with_order array and profiles_without_order array
            while ($profiles->have_posts()) : $profiles->the_post();
                // Retrieve the opt-agents-order value for the current post
                $agent = get_post_meta(get_the_ID(), 'hlr_framework_agents', true);
                $order = $agent['opt-agents-order'];

                // Check if the order is empty
                if (!empty($order)) {
                    // Add the current agent to the sorted_profiles_with_order array with opt-agents-order as the key
                    $sorted_profiles_with_order[$order] = get_post();
                } else {
                    // Add the current agent to the profiles_without_order array
                    $profiles_without_order[] = get_post();
                }
            endwhile;

            // Sort the sorted_profiles_with_order array based on opt-agents-order
            ksort($sorted_profiles_with_order);

            // Loop through sorted_profiles_with_order to display the agents with non-empty order
            foreach ($sorted_profiles_with_order as $post) :
                setup_postdata($post);
                // Include your template part here
                include(HLR_THEME_COMPONENT . 'agents/card.php');
            endforeach;

            // Loop through profiles_without_order to display the agents with empty order
            foreach ($profiles_without_order as $post) :
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
