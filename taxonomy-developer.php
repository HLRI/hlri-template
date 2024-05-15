<?php
// Check if user is logged in and has the appropriate role
if (is_user_logged_in() && (current_user_can('administrator') || current_user_can('editor') || current_user_can('agent'))) :
    get_header();
    ?>
    <div class="container">
        <div class="row py-5">
            <div class="col-12">
                <div class="modal-content modal-content-login clearfix">
                    <div class="modal-body body-login">
                        <div class="card" style="width: 400px; margin: 0 auto;">
                            <div class="modal-body-login login-form">
                                <!-- Your login form HTML goes here -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        // Apply filters before querying properties
        apply_filters('custom_property_archive_filters');

        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $term = get_queried_object();

        $args = [
            'post_type' => 'properties',
            'post_status' => 'publish',
            'posts_per_page' => get_option('posts_per_page'),
            'tax_query' => [
                [
                    'taxonomy' => $term->taxonomy,
                    'field' => 'slug',
                    'terms' => $term->slug,
                ]
            ],
            'paged' => $paged,
        ];

        $properties_query = new WP_Query($args);

        if ($properties_query->have_posts()) :
            ?>
            <div class="row">
                <?php
                while ($properties_query->have_posts()) :
                    $properties_query->the_post();
                    // Your property listing HTML goes here
                endwhile;
                wp_reset_postdata();
                ?>
            </div>
            <?php
            if ($properties_query->max_num_pages > 1) :
                ?>
                <div class="mt-5 row d-flex align-items-center justify-content-center">
                    <?php
                    echo paginate_links([
                        'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                        'total' => $properties_query->max_num_pages,
                        'current' => max(1, get_query_var('paged')),
                        'format' => '?paged=%#%',
                        'show_all' => false,
                        'type' => 'plain',
                        'end_size' => 2,
                        'mid_size' => 1,
                        'prev_next' => true,
                        'prev_text' => sprintf('<i></i> %1$s', __('Newer Posts', 'text-domain')),
                        'next_text' => sprintf('%1$s <i></i>', __('Older Posts', 'text-domain')),
                        'add_args' => false,
                        'add_fragment' => '',
                    ]);
                    ?>
                </div>
            <?php endif;
        endif; ?>
    </div>
    <?php
    get_footer();
// If user is not logged in or does not have the appropriate role, redirect to login page
else :
    wp_redirect(wp_login_url());
    exit;
endif;
?>
