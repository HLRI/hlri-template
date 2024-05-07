<?php
$theme_options = get_option('hlr_framework');

$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1; // Get current page number

// Custom query to fetch agents
$arg = [
    'post_type'      => 'agents',
    'post_status'    => 'publish',
    'posts_per_page' => 15, // Agents per page
    'paged'          => $paged, // Current page number
];

$profiles = new WP_Query($arg);
?>
<?php if ($profiles->have_posts()) : ?>
    <div class="container-fluid px-5 mt-10">
        <div class="row">
            <?php
            // Start the loop to display agents
            while ($profiles->have_posts()) : $profiles->the_post();
                // Retrieve the opt-agents-order value for the current agent
                $agent = get_post_meta(get_the_ID(), 'hlr_framework_agents', true);
                $order = isset($agent['opt-agents-order']) ? $agent['opt-agents-order'] : ''; // Get the agent order

                // Create an array to store agents with order key for sorting
                $agents_with_order[$order][] = get_post();
            endwhile;

            // Sort agents based on opt-agents-order
            ksort($agents_with_order);

            // Loop through sorted agents and display them
            foreach ($agents_with_order as $order => $agents) {
                foreach ($agents as $post) {
                    setup_postdata($post);
                    // Include your template part here
                    include(HLR_THEME_COMPONENT . 'agents/card.php');
                }
            }

            // Restore original post data
            wp_reset_postdata();
            ?>
        </div>
    </div>

    <!-- Pagination -->
    <div class="pagination">
        <?php
        echo paginate_links(array(
            'total'   => $profiles->max_num_pages,
            'current' => $paged,
            'format'  => '?paged=%#%',
        ));
        ?>
    </div>
<?php endif; ?>
