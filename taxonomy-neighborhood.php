<?php get_header(); ?>


<?php
// Retrieve the current term object for the taxonomy 'neighborhood'
$term = get_queried_object();

// Display the name and description of the term
$description = term_description($term->term_id, $term->taxonomy);
echo $description;
// Get all custom fields (meta data) for this term
//$custom_fields = get_term_meta($term->term_id);
//
//// Display each custom field
//if ($custom_fields) {
//    echo '<div class="neighborhood-custom-fields">';
//    foreach ($custom_fields as $field_name => $field_values) {
//        // Each field may have multiple values, so loop through them
//        foreach ($field_values as $value) {
//            echo '<p><strong>' . esc_html($field_name) . ':</strong> ' . esc_html($value) . '</p>';
//        }
//    }
//    echo '</div>';
//} else {
//    echo '<p>No custom fields found for this neighborhood.</p>';
//}
?>

<?php
$category_title = single_cat_title('', false);

// Override the global define for a specific page
define('CUSTOM_PAGE_HEADER', [
    'subtitle' => "Explore Your Dream Space",
    'title' => 'Properties listed in ' . $category_title,
]);

// Include the custom-page-header.php file
include(HLR_THEME_COMPONENT . 'custom-page-header.php');
echo $description;
?>
aaa
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
    gfgh
        <div class="row justify-content-center">
11111
            <?php
            while ($properties_query->have_posts()) :
                $properties_query->the_post();
                $mdata = get_post_meta(get_the_ID(), 'hlr_framework_mapdata', true);
                include(HLR_THEME_COMPONENT . 'properties/card.php');
            endwhile;
            ?>
        </div>
    4444
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
    <?php
    endif;
    wp_reset_postdata();
    ?>
</div>
<?php get_footer(); ?>
