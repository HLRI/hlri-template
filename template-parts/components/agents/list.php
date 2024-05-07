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
            // Initialize an array to store agents
            $agents = array();

            // Start the loop to fetch agents
            while ($profiles->have_posts()) : $profiles->the_post();
                // Retrieve the opt-agents-order value for the current agent
                $agent = get_post_meta(get_the_ID(), 'hlr_framework_agents', true);
                $order = isset($agent['opt-agents-order']) ? $agent['opt-agents-order'] : ''; // Get the agent order

                // Store the agent post object along with its order in the array
                $agents[] = array(
                    'post'  => get_post(),
                    'order' => $order
                );
            endwhile;

            // Custom sorting function to sort agents based on opt-agents-order
            usort($agents, function($a, $b) {
                if ($a['order'] == $b['order']) {
                    return 0;
                }
                return ($a['order'] < $b['order']) ? -1 : 1;
            });

            // Loop through sorted agents and display them
            foreach ($agents as $agent) {
                setup_postdata($agent['post']);
                // Include your template part here
                include(HLR_THEME_COMPONENT . 'agents/card.php');
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
