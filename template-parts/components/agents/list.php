<?php
$theme_options = get_option('hlr_framework');

$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1; // Get current page number

$arg = [
    'post_type'      => 'agents',
    'post_status'    => 'publish',
    'posts_per_page' => 15, // Agents per page
    'paged'          => $paged, // Current page number
    'meta_key'       => 'hlr_framework_agents', // Meta key for sorting
    'orderby'        => 'meta_value', // Order by meta value
    'meta_query'     => array(
        array(
            'key'     => 'hlr_framework_agents[opt-agents-order]', // Agent order field
            'compare' => 'EXISTS', // Check if the meta key exists
        ),
    ),
];

$profiles = new WP_Query($arg);
?>
<?php if ($profiles->have_posts()) : ?>
    <div class="container-fluid px-5 mt-10">
        <div class="row">
            <?php
            // Start the loop to display agents
            while ($profiles->have_posts()) : $profiles->the_post();
                // Include your template part here
                include(HLR_THEME_COMPONENT . 'agents/card.php');
            endwhile;

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
