<?php $theme_options = get_option('hlr_framework'); ?>

<?php
$paged = get_query_var('paged') ? get_query_var('paged') : 1;
$arg = [
    'post_type' => 'properties',
    'post_status' => 'publish',
    'posts_per_page'   => get_option('posts_per_page'),
    'paged' => $paged,
];

$peroperties = new WP_Query($arg);


?>

<?php get_header() ?>


<?php
    // Override the global define for a specific page
    define('CUSTOM_PAGE_HEADER', [
        'subtitle' => "Explore Your Dream Space",
        'title' => 'Properties List – All Properties',
    ]);

    // Include the custom-page-header.php file
    include(HLR_THEME_COMPONENT . 'custom-page-header.php');

    if ($peroperties->have_posts()) : ?>
    <div class="container my-5">
        
        <div class="row">
            <div class=" col-xs-12 col-md-12 d-flex flex-column" >
                <div>
                    
                </div>
            </div>
            <div class="col-md-12 row px-5" >
                <?php while ($peroperties->have_posts()) : $peroperties->the_post(); ?>
                     <?php include(HLR_THEME_COMPONENT . 'properties/card.php'); ?>
                <?php endwhile; ?>
            </div>
            <?php wp_reset_postdata(); ?>
        </div>

        <div class="mt-5 row d-flex align-items-center justify-content-center">
            <?php
            echo paginate_links(array(
                'base'         => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                'total'        => $peroperties->max_num_pages,
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
    </div>
<?php endif; ?>
<?php get_footer(); ?>