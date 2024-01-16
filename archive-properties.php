<?php
/* Template Name: Archive Properties */
$theme_options = get_option('hlr_framework');

get_header();

// Override the global define for a specific page
define('CUSTOM_PAGE_HEADER', [
    'subtitle' => "Explore Your Dream Space",
    'title' => 'Properties List – All Properties',
]);

// Include the custom-page-header.php file
include(HLR_THEME_COMPONENT . 'custom-page-header.php');

// Determine the page number for pagination
$paged = get_query_var('paged') ? absint(get_query_var('paged')) : 1;

// Start building the query argument
$arg = [
    'post_type' => 'properties',
    'post_status' => 'publish',
    'posts_per_page' => get_option('posts_per_page'),
    'paged' => $paged,
];

// Check if a neighborhood filter has been applied
$neighborhood = isset($_GET['neighborhood_filter']) ? $_GET['neighborhood_filter'] : '';
if (!empty($neighborhood)) {
    $arg['tax_query'] = [
        [
            'taxonomy' => 'neighborhood',
            'field' => 'slug',
            'terms' => $neighborhood,
        ],
    ];
}

// Check if a cities filter has been applied
$cities = isset($_GET['cities_filter']) ? $_GET['cities_filter'] : '';
if (!empty($cities)) {
    $arg['tax_query'] = [
        [
            'taxonomy' => 'city',
            'field' => 'slug',
            'terms' => $cities,
        ],
    ];
}

$properties = new WP_Query($arg);
?>

<div class="container-lg my-5">
    <div class="d-flex w-100 mt-4 position-sticky bg-background sticky-top shadow mb-4 rounded pt-2 px-4 align-items-center" style="width:100%; z-index:77;gap:10px;">
        <form class="mx-auto mx-md-0 row w-100 w-md-75" action="<?php echo esc_url(get_post_type_archive_link('properties')); ?>" method="get">
            <!-- Cities -->
            <div class="form-group col-6 col-md-3">
                  <label for="cities_filter" class="text-muted">City</label>
                  <select name="cities_filter" class="form-control" id="cities_filter" onchange="this.form.submit()">
                    <option value="">Select City</option>
                        <?php
                            $terms = get_terms(['taxonomy' => 'city', 'hide_empty' => false]);
                            $selected_city = sanitize_text_field($_GET['cities_filter'] ?? '');
                        foreach ($terms as $term) :
                        ?>
                            <option value="<?php echo esc_attr($term->slug); ?>" <?php selected( $selected_city, $term->slug ); ?>>
                                <?php echo esc_html($term->name); ?>
                            </option>
                        <?php 
                        endforeach;
                        ?>
                </select>
            </div>   
            <!-- group -->
            <div class="form-group col-6 col-md-3">
                  <label for="group_filter"class="text-muted">Group</label>
                  <select name="group_filter"  class="form-control" id="group_filter" onchange="this.form.submit()">
                    <option value="">Select Group</option>
                        <?php
                            $terms = get_terms(['taxonomy' => 'group', 'hide_empty' => false]);
                            $selected_group = sanitize_text_field($_GET['group_filter'] ?? '');
                        foreach ($terms as $term) :
                        ?> 
                            <option value="<?php echo esc_attr($term->slug); ?>" <?php selected( $selected_group, $term->slug ); ?>>
                                <?php echo esc_html($term->name); ?>
                            </option>
                        <?php 
                        endforeach;
                        ?>
                </select>
            </div>
          <!-- Neighborhoods -->
            <div class="form-group col-6 col-md-3">
                  <label for="neighborhood_filter"class="text-muted">Neighborhood</label>
                  <select name="neighborhood_filter"  class="form-control" id="neighborhood_filter" onchange="this.form.submit()">
                    <option value="">Select Neighborhood</option>
                    <?php
                        $terms = get_terms(['taxonomy' => 'neighborhood', 'hide_empty' => false]);
                        $selected_neighborhood = sanitize_text_field($_GET['neighborhood_filter'] ?? '');
                    foreach ($terms as $term) :
                    ?>
                        <option value="<?php echo esc_attr($term->slug); ?>" <?php selected( $selected_neighborhood, $term->slug ); ?>>
                            <?php echo esc_html($term->name); ?>
                        </option>
                    <?php 
                    endforeach;
                    ?>
                </select>
                <input type="hidden" name="post_type" value="properties">
                <!-- Keep track of pagination -->
                <?php if ($paged) : ?>
                    <input type="hidden" name="paged" value="<?php echo esc_attr($paged); ?>">
                <?php endif; ?>
            </div>
          
            
        </form>
    </div>
    <div class="row">
        <div class="col-md-12 px-md-5 properties-wrapper">
            <?php if ($properties->have_posts()) : ?>
                <?php while ($properties->have_posts()) : $properties->the_post();
                    $mdata = get_post_meta(get_the_ID(), 'hlr_framework_mapdata', true);
                    // Output your metadata here, e.g., print_r($mdata)
                    include(HLR_THEME_COMPONENT . 'properties/card.php');
                endwhile;
                wp_reset_postdata(); ?>
            <?php else : ?>
                <p><?php esc_html_e('Sorry, no properties matched your criteria.', 'text-domain'); ?></p>
            <?php endif; ?>
        </div>
    </div>
    <div class="mt-5 row d-flex align-items-center justify-content-center">
        <?php
            echo paginate_links(array(
                'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                'total' => $properties->max_num_pages,
                'current' => max(1, get_query_var('paged')),
                'format' => '?paged=%#%',
                'prev_text' => sprintf('<i></i> %1$s', __('Newer Properties', 'text-domain')),
                'next_text' => sprintf('%1$s <i></i>', __('Older Properties', 'text-domain')),
            ));
        ?>
    </div>
</div>

<?php get_footer(); ?>