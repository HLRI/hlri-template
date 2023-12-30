<?php get_header() ?>



<?php 

    $category_title = single_cat_title('', false);

    // Override the global define for a specific page
    define('CUSTOM_PAGE_HEADER', [
        'subtitle' => "Explore Your Dream Space",
        'title' => 'Cities List - ' . $category_title,
    ]);

    // Include the custom-page-header.php file
    include(HLR_THEME_COMPONENT . 'custom-page-header.php');

?>

<div class="container-lg">
    
    <?php
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

    $term = get_queried_object();

    $arg = [
        'post_type' => 'properties',
        'post_status' => 'publish',
        'posts_per_page' => get_option('posts_per_page'),
        'tax_query' => array(
            array(
                'taxonomy' => $term->taxonomy,
                'field' => 'slug',
                'terms' => $term->slug,
            )
        ),
        'paged' => $paged,
    ];

    $peroperties = new WP_Query($arg);

    ?>


    <?php if ($peroperties->have_posts()) : ?>

        <div class="row">
            <?php while ($peroperties->have_posts()) : $peroperties->the_post(); ?>
                <?php $mdata = get_post_meta(get_the_ID(), 'hlr_framework_mapdata', true); ?>
                <?php include(HLR_THEME_COMPONENT . 'properties/card.php'); ?>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        </div>

        <?php if (get_query_var('paged') > 1) : ?>
            <div class="mt-5 row d-flex align-items-center justify-content-center">
                <?php
                echo paginate_links(array(
                    'base'         => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                    'total'        => $query->max_num_pages,
                    'current'      => max(1, get_query_var('paged')),
                    'format'       => '?paged=%#%',
                    'show_all'     => false,
                    'type'         => 'plain',
                    'end_size'     => 2,
                    'mid_size'     => 1,
                    'prev_next'    => true,
                    'prev_text'    => sprintf('<i></i> %1$s', __('Newer Posts', 'text-domain')),
                    'next_text'    => sprintf('%1$s <i></i>', __('Older Posts', 'text-domain')),
                    'add_args'     => false,
                    'add_fragment' => '',
                ));
                ?>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>
<?php get_footer() ?>