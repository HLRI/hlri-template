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

<?php get_header() ?>

<div class="container-fluid px-5 my-5">
    <div class="row">
        <h1><?php single_cat_title() ?></h1>
    </div>
    <?php if ($peroperties->have_posts()) : ?>

        <div class="row">
            <?php while ($peroperties->have_posts()) : $peroperties->the_post(); ?>
                <div class="col-lg-4 px-2 mb-4">
                    <div class="card-listing card-listing-v2">

                        <div class="card-listing-image card-listing-image-v2">
                            <?php the_post_thumbnail('normal', ['loading' => 'lazy']) ?>
                        </div>

                        <div class="card-body-listing card-body-listing-v2">
                            <div class="card-listing-content card-listing-content-v2">
                                <h6 class="text-black"><?= strlen(get_the_title())  > 12 ? substr(get_the_title(), 0, 12) . '...' : get_the_title() ?></h6>
                                <div class="card-listing-description card-listing-description-v2">
                                    <?= strlen(strip_tags(get_the_excerpt()))  > 65 ? substr(strip_tags(get_the_excerpt()), 0, 65) . '...' : strip_tags(get_the_content()) ?>
                                </div>
                            </div>
                            <div class="lable-listing lable-listing-v2">
                                <?php if (!empty($mdata['opt-min-price-sqft'])) : ?>
                                    <div><?= "$" . $mdata['opt-min-price-sqft'] . " to " . "$" . $mdata['opt-max-price-sqft'] ?></div>
                                <?php endif; ?>
                                <?php if (!empty($mdata['opt-size-min'])) : ?>
                                    <div><?= $mdata['opt-size-min'] . " - " . $mdata['opt-size-max'] . " Sq Ft | " . $mdata['opt-occupancy'] ?></div>
                                <?php endif; ?>
                                <?php if (!empty($mdata['opt-address'])) : ?>
                                    <div><?= $mdata['opt-address'] ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                       

                    </div>
                </div>
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