<?php get_header(); ?>

<?php
$term = get_queried_object();

$category_title = single_cat_title('', false);
$description = term_description($term->term_id, $term->taxonomy);

// Override the global define for a specific page
define('CUSTOM_PAGE_HEADER', [
    'subtitle' => "Explore Your Dream Space",
    'title' => 'Properties in ' . $category_title,
]);

// Include the custom-page-header.php file
include(HLR_THEME_COMPONENT . 'custom-page-header.php');
?>

<style>
    @media (max-width: 768px) {
        .page-header {
            margin-bottom: -40px;
        }
    }
    .header-desc{
        max-height: 293px;
        overflow-y: auto;
    }
</style>
<div class="container-lg">
    <?php
    echo '<div class="mb-5 mt-5 px-4 header-desc" style="color: black;z-index: 998;display: block;position: relative;">' . $description . '</div>';

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
                    'prev_text'    => sprintf('<i></i> %1$s', __('Previous Page', 'text-domain')),
                    'next_text'    => sprintf('%1$s <i></i>', __('Next Page', 'text-domain')),
                    'add_args' => false,
                    'add_fragment' => '',
                ]);
                ?>
            </div>
        <?php
        endif;
        ?>
    <?php
    endif;
    wp_reset_postdata();
    ?>
</div>
<?php get_footer(); ?>
