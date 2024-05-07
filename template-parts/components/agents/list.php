<?php
$theme_options = get_option('hlr_framework');

$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1; // Get current page number

// Custom SQL query to fetch agents with pagination and sorting
global $wpdb;
$agents_table = $wpdb->prefix . 'posts';
$meta_table = $wpdb->prefix . 'postmeta';
$results = $wpdb->get_results(
    $wpdb->prepare(
        "
        SELECT posts.*
        FROM $agents_table AS posts
        LEFT JOIN $meta_table AS meta
        ON posts.ID = meta.post_id AND meta.meta_key = 'hlr_framework_agents'
        ORDER BY CAST(meta.meta_value AS SIGNED), posts.post_date DESC
        LIMIT %d OFFSET %d
        ",
        15, // Agents per page
        ($paged - 1) * 15 // Offset calculation
    )
);

if ($results) : ?>
    <div class="container-fluid px-5 mt-10">
        <div class="row">
            <?php
            // Loop through fetched agents and display them
            foreach ($results as $post) :
                setup_postdata($post);
                // Include your template part here
                include(HLR_THEME_COMPONENT . 'agents/card.php');
            endforeach;

            // Restore original post data
            wp_reset_postdata();
            ?>
        </div>
    </div>

    <!-- Pagination -->
    <div class="pagination">
        <?php
        echo paginate_links(array(
            'total'   => ceil($wpdb->get_var("SELECT COUNT(posts.ID) FROM $agents_table AS posts LEFT JOIN $meta_table AS meta ON posts.ID = meta.post_id AND meta.meta_key = 'hlr_framework_agents'") / 15),
            'current' => $paged,
            'format'  => '?paged=%#%',
        ));
        ?>
    </div>
<?php endif; ?>
