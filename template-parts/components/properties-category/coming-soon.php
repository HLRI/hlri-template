<?php
/*
$arg = [
    'post_type' => 'properties',
    'post_status' => 'publish',
    'posts_per_page' => 8,
    'tax_query' => [
        [
            'taxonomy' => 'group',
            'field' => 'term_id',
            'terms' => 19,
        ]
    ]
];

$peroperties = new WP_Query($arg);
*/
?>
<?php //if ($peroperties->have_posts()) : 
?>

<div class="container-fluid mb-5 mt-5 loading">
    <div class="row">
        <div class="col-12">
            <div class="titr-list">
                <h3 class="font-weight-bold">Coming Soon</h3>
                <a href="<?= home_url('group/coming-soon') ?>" title="" class="view-more">View more</a>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="skeleton">
                <div class="skeleton-left flex1">
                    <div class="square"></div>
                </div>
                <div class="skeleton-right flex2">
                    <div class="line h25 w75 m10"></div>
                    <div class="line"></div>
                    <div class="line h8 w50"></div>
                    <div class="line"></div>
                    <div class="line h8 w50"></div>
                    <div class="line  w75"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="skeleton">
                <div class="skeleton-left flex1">
                    <div class="square"></div>
                </div>
                <div class="skeleton-right flex2">
                    <div class="line h25 w75 m10"></div>
                    <div class="line"></div>
                    <div class="line h8 w50"></div>
                    <div class="line"></div>
                    <div class="line h8 w50"></div>
                    <div class="line  w75"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="skeleton">
                <div class="skeleton-left flex1">
                    <div class="square"></div>
                </div>
                <div class="skeleton-right flex2">
                    <div class="line h25 w75 m10"></div>
                    <div class="line"></div>
                    <div class="line h8 w50"></div>
                    <div class="line"></div>
                    <div class="line h8 w50"></div>
                    <div class="line  w75"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid my-5 data-show">
    <div class="row">
        <div class="col-lg-12">
            <div class="titr-list">
                <h3 class="font-weight-bold">Coming Soon</h3>
                <a href="<?= home_url('group/coming-soon') ?>" title="" class="view-more">View more</a>
            </div>
            <div class="d-flex justify-content-center">
                <div class="owl-carousel owl-theme listing-wrap wrap-list">
                    <?php //while ($peroperties->have_posts()) : $peroperties->the_post();
                    //$mdata = get_post_meta(get_the_ID(), 'hlr_framework_mapdata', true);
                    ?>
                    
                    <?php //endwhile; 
                    ?>
                    <?php //wp_reset_postdata(); 
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php //endif; 
?>