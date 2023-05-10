<?php
$arg = [
    'post_type' => 'properties',
    'post_status' => 'publish',
    'posts_per_page' => 8,
    'tax_query' => [
        [
            'taxonomy' => 'group',
            'field' => 'term_id',
            'terms' => 23,
        ]
    ]
];

$peroperties = new WP_Query($arg);

?>
<?php if ($peroperties->have_posts()) : ?>
    <div class="container-fluid my-5">
        <div class="row">
            <div class="col-lg-12">
                <div class="titr-list">
                    <h3 class="font-weight-bold">Condo Assignment</h3>
                    <a href="<?= home_url('group/condo-assignment') ?>" title="" class="view-more">View more</a>
                </div>
                <div class="d-flex justify-content-center">
                    <div class="owl-carousel owl-theme neighborhood wrap-list">
                        <?php while ($peroperties->have_posts()) : $peroperties->the_post();
                            $mdata = get_post_meta(get_the_ID(), 'hlr_framework_mapdata', true);
                        ?>

                            <div class="neighborhood">
                                <?php the_post_thumbnail() ?>
                                <div class="neighborhood-title">
                                    <?php the_title() ?>
                                </div>
                                <a class="neighborhood-link">5 Listing</a>
                            </div>

                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>