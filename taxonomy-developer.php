<?php
// Check if user is logged in and has the appropriate role, otherwise display login form
if (is_user_logged_in() && (current_user_can('administrator') || current_user_can('editor') || current_user_can('agent'))) {
    get_header();

    $category_title = single_cat_title('', false);

    // Override the global define for a specific page
    define('CUSTOM_PAGE_HEADER', [
        'subtitle' => "Explore Properties",
        'title' => 'Made by: ' . $category_title,
    ]);

    // Include the custom-page-header.php file
    include(HLR_THEME_COMPONENT . 'custom-page-header.php');
    ?>
    <div class="container-lg">
    <?php
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
        <div class="row justify-content-center">
            <?php
            while ($properties_query->have_posts()) :
                $properties_query->the_post();
                $mdata = get_post_meta(get_the_ID(), 'hlr_framework_mapdata', true);
                include(HLR_THEME_COMPONENT . 'properties/card.php');
            endwhile;
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
        <?php
        endif;
        ?>
        </div>
        <?php
        get_footer();
    } else {
    // If user is not logged in or does not have the appropriate role, display login form
    echo do_shortcode('[nextend_social_login]');
}
?>
