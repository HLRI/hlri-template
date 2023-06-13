<?php get_header(); ?>
<?php
$theme_options = get_option('hlr_framework');
$floorplans = get_post_meta(get_the_ID(), 'hlr_framework_floorplans', true);
$associated_property = get_post_meta(get_the_ID(), 'associated_property', true);




global $wpdb;
$post_id = get_the_ID();
$tbl = $wpdb->prefix . 'postmeta';
$prepare_guery = $wpdb->prepare("SELECT post_id FROM $tbl where meta_key ='associated_property' AND post_id = '$post_id'");
$get_values = $wpdb->get_col($prepare_guery);
$pid = get_post_meta($get_values[0], 'associated_property', true);

$args = array(
    'post_type' => 'properties',
    'numberposts' => 1,
    'p' => $pid
);
$property = new WP_Query(${args});

?>
<div class="container-fluid px-lg-5 my-4">
    <div class="row">
        <div class="col-lg-9 px-4">

            <div class="row floorplan-header mb-4">
                <div class="col-lg-8 px-lg-0">
                    <?php if ($property->have_posts()) : ?>
                        <?php
                        while ($property->have_posts()) : $property->the_post();
                            $mdata_single = get_post_meta(get_the_ID(), 'hlr_framework_mapdata', true);
                        ?>
                            <div>
                                <?php if (!empty($floorplans['opt-developer'])) : ?>
                                    <h4 class="font-weight-bold h6"><?= strtoupper(get_the_title() . ' by ' . $mdata_single['opt-developer']) ?></h4>
                                <?php else : ?>
                                    <h4 class="font-weight-bold h6"><?= strtoupper(get_the_title()) ?></h4>
                                <?php endif; ?>
                            </div>
                        <?php
                        endwhile;
                        wp_reset_postdata();
                        wp_reset_query();
                        ?>
                    <?php endif; ?>
                    <div class="d-flex align-items-center">
                        <?php if (!empty($floorplans['opt-floorplans-status'])) : ?>
                            <span class="status-floorplan <?= $floorplans['opt-floorplans-status'] == 'available' ? 'status-color-success' : 'status-color-danger' ?>"></span>
                        <?php endif; ?>
                        <h1 class="font-weight-bold h2"><?php the_title() ?></h1>
                    </div>
                </div>
                <div class="col-lg-4 text-right px-lg-0">
                    <?php if (!empty($floorplans['opt-floorplans-price-from'])) : ?>
                        <div class="floorplan-price">
                            From <span class="from-price"><?= '$' . $floorplans['opt-floorplans-price-from'] ?></span>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($floorplans['opt-floorplans-price-per'])) : ?>
                        <div>
                            <?= '$' . $floorplans['opt-floorplans-price-per'] . '/sq.ft' ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="row">
                <div class="col-12 px-lg-0">
                    <div class="image-floorplan">
                        <?php
                        while ($property->have_posts()) : $property->the_post();
                            $mdata_single = get_post_meta(get_the_ID(), 'hlr_framework_mapdata', true);

                            if (!empty($floorplans['opt-developer'])) {
                                $title_img = strtoupper(get_the_title() . ' by ' . $mdata_single['opt-developer']);
                            } else {
                                $title_img = strtoupper(get_the_title());
                            }
                        endwhile;
                        wp_reset_postdata();
                        wp_reset_query();

                        if (!empty($floorplans['opt-floorplans-price-from'])) {
                            $fp = 'From $' . $floorplans['opt-floorplans-price-from'];
                        } else {
                            $fp = '';
                        }

                        if (!empty($floorplans['opt-floorplans-interior-size'])) {
                            $sq = $floorplans['opt-floorplans-interior-size'] . 'sq.ft';
                        } else {
                            $sq = '';
                        }

                        if (!empty($floorplans['opt-floorplans-beds'])) {
                            $bed = $floorplans['opt-floorplans-beds'] . ' Bed';
                        } else {
                            $bed = '';
                        }

                        if (!empty($floorplans['opt-floorplans-baths'])) {
                            $baths = $floorplans['opt-floorplans-baths'] . ' Bath';
                        } else {
                            $baths = '';
                        }

                        if (!empty($floorplans['opt-floorplans-view'])) {
                            $view = implode('/', $floorplans['opt-floorplans-view']);
                        } else {
                            $view = '';
                        }


                        $info =  $sq . ' ' . $bed . ' ' . $baths . ' ' . $view;

                        ?>
                        <a href="<?= get_the_post_thumbnail_url() ?>" title="<center> <?= $title_img ?> <br><br> <?= $fp ?> <br><br> <?= $info ?></center>" data-lightbox="roadtrip">
                            <img class="img-floorplan" src="<?= get_the_post_thumbnail_url() ?>" alt="test aly">
                        </a>
                    </div>
                </div>
            </div>

            <div class="row mt-4 p-lg-4 border py-4">
                <div class="col-6 col-lg-3 mb-3 mb-lg-0">
                    <div class="floorplan-item">
                        <?php if (!empty($floorplans['opt-floorplans-interior-size'])) : ?>
                            <div class="title-item">
                                SQ.FT.
                            </div>
                            <div class="content-item">
                                <?= $floorplans['opt-floorplans-interior-size'] ?> sq.ft
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-6 col-lg-3 mb-3 mb-lg-0">
                    <div class="floorplan-item">
                        <?php if (!empty($floorplans['opt-floorplans-beds']) || !empty($floorplans['opt-floorplans-baths'])) : ?>
                            <div class="title-item">
                                TYPE
                            </div>
                            <div class="content-item">
                                <?= $floorplans['opt-floorplans-beds'] ?> Bed, <?= $floorplans['opt-floorplans-baths'] ?> Bath
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-6 col-lg-3 mb-3 mb-lg-0">
                    <div class="floorplan-item">
                        <?php if (!empty($floorplans['opt-floorplans-view'])) : ?>
                            <div class="title-item">
                                EXPOSURE
                            </div>
                            <div class="content-item">
                                <?= implode('/', $floorplans['opt-floorplans-view']) ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-6 col-lg-3 mb-3 mb-lg-0">
                    <div class="floorplan-item">
                        <?php if (!empty($floorplans['opt-floorplans-floor-range'])) : ?>
                            <div class="title-item">
                                FLOOR RANGE
                            </div>
                            <div class="content-item">
                                <?= $floorplans['opt-floorplans-floor-range'] ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-12 px-lg-0">
                    <div id="accordion">
                        <div class="">
                            <div class="card-header p-0" id="headingOne">
                                <h5 class="mb-0">
                                    <button class="btn btn-link px-0" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Price Per Square Foot
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="row mt-4">
                                    <div class="col-lg-4 mb-5 mb-lg-0">
                                        <div class="square-foot-wrap">
                                            <div class="square-foot-head">THIS FLOOR PLAN</div>
                                            <?php if (!empty($floorplans['opt-floorplans-price-per'])) : ?>
                                                <div class="square-foot-price"><span><?= '$' . $floorplans['opt-floorplans-price-per'] ?></span>/sq.ft</div>
                                            <?php endif; ?>
                                            <div class="square-foot-title">Suite Details</div>
                                            <?php if (!empty($floorplans['opt-floorplans-suite-name'])) : ?>
                                                <div class="square-foot-item">
                                                    <span class="name">Suite Name : </span>
                                                    <span class="value"><?= $floorplans['opt-floorplans-suite-name'] ?></span>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (!empty($floorplans['opt-floorplans-beds'])) : ?>
                                                <div class="square-foot-item">
                                                    <span class="name">Beds : </span>
                                                    <span class="value"><?= $floorplans['opt-floorplans-beds'] ?> Bed</span>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (!empty($floorplans['opt-floorplans-baths'])) : ?>
                                                <div class="square-foot-item">
                                                    <span class="name">Baths : </span>
                                                    <span class="value"><?= $floorplans['opt-floorplans-baths'] ?> Bath</span>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (!empty($floorplans['opt-floorplans-view'])) : ?>
                                                <div class="square-foot-item">
                                                    <span class="name">View : </span>
                                                    <span class="value"><?= implode('/', $floorplans['opt-floorplans-view']) ?></span>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (!empty($floorplans['opt-floorplans-interior-size'])) : ?>
                                                <div class="square-foot-item">
                                                    <span class="name">Interior Size : </span>
                                                    <span class="value"><?= $floorplans['opt-floorplans-interior-size'] ?> sq.ft.</span>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (!empty($floorplans['opt-floorplans-floor-range'])) : ?>
                                                <div class="square-foot-item">
                                                    <span class="name">Floor Range : </span>
                                                    <span class="value"><?= $floorplans['opt-floorplans-floor-range'] ?></span>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 mb-5 mb-lg-0">
                                        <div class="square-foot-wrap">
                                            <div class="square-foot-head">IMPERIA CONDOS BY TRUMAN AVERAGE</div>
                                            <div class="square-foot-price"><span>$868</span>/sq.ft</div>
                                            <div class="square-foot-title">Prices</div>
                                            <?php if (!empty($floorplans['opt-floorplans-price-from'])) : ?>
                                                <div class="square-foot-item">
                                                    <span class="name">Price (From) : </span>
                                                    <span class="value"><?= '$' . $floorplans['opt-floorplans-price-from'] ?></span>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (!empty($floorplans['opt-floorplans-price-per'])) : ?>
                                                <div class="square-foot-item">
                                                    <span class="name">Price Per Sq.Ft : </span>
                                                    <span class="value"><?= '$' . $floorplans['opt-floorplans-price-per'] . '/sq.ft' ?></span>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (!empty($floorplans['opt-floorplans-mt-fees-per-month'])) : ?>
                                                <div class="square-foot-item">
                                                    <span class="name">Mt. Fees per Month : </span>
                                                    <span class="value"><?= $floorplans['opt-floorplans-mt-fees-per-month'] ?></span>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (!empty($floorplans['opt-floorplans-parking'])) : ?>
                                                <div class="square-foot-item">
                                                    <span class="name">Parking : </span>
                                                    <span class="value"><?= $floorplans['opt-floorplans-parking'] ?></span>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (!empty($floorplans['opt-floorplans-locker'])) : ?>
                                                <div class="square-foot-item">
                                                    <span class="name">Locker : </span>
                                                    <span class="value"><?= $floorplans['opt-floorplans-locker'] ?></span>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 mb-5 mb-lg-0">
                                        <div class="square-foot-wrap">
                                            <div class="square-foot-head">NEIGHBOURHOOD AVERAGE</div>
                                            <div class="square-foot-price"><span>$0</span>/sq.ft</div>
                                            <?php if (!empty($floorplans['opt-floorplans-deposit-structure'])) : ?>
                                                <div class="square-foot-title">Deposit Structure</div>
                                                <?php echo $floorplans['opt-floorplans-deposit-structure']; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-lg-3 pl-lg-4 pr-lg-0 px-4">
            <?php if ($theme_options['opt-properties-status']) : ?>
                <?php if (!empty($theme_options['opt-properties-shortcode'])) : ?>
                    <div class="properties-shortcode">
                        <div class="titr-list ml-0 mb-2 pb-1 mr-0">
                            <h3 class="font-weight-bold h5 mb-0 text-center">Register Now to get full package , book your unit</h3>
                        </div>
                        <style>
                            <?php echo $theme_options['opt-properties-style'] ?>
                        </style>
                        <div class="card-form">
                            <?= do_shortcode($theme_options['opt-properties-shortcode']) ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>

    <div class="container-fluid px-0 mt-lg-5 mt-2">
        <div class="content">
            <div class="row mb-lg-4 mb-2">
                <div class="col-12 mb-4">
                    <h4 class="font-weight-bold h3">Browse more Imperia Condos by Truman Floor Plans</h4>
                </div>
                <div class="col-12">
                    <div class="btn-group submitter-group float-left">
                        <div class="input-group-prepend">
                            <div class="input-group-text btn-status-floorplan">Status</div>
                        </div>
                        <select class="form-control status-dropdown">
                            <option value="">All</option>
                            <option value="Sold Out">Sold Out</option>
                            <option value="Available">Available</option>
                        </select>
                    </div>
                </div>
                <!-- <div class="col-8">
                    <div class="filter-wrapper">
                        <input type="checkbox" class="filter-checkbox" value="Software Engineer" /> Software Engineer
                        <input type="checkbox" class="filter-checkbox" value="Accountant" /> Accountant
                        <input type="checkbox" class="filter-checkbox" value="Sales Assistant" /> Sales Assistant
                        <input type="checkbox" class="filter-checkbox" value="Developer" /> Developer
                    </div>
                </div>
                <div class="col-4">
                    <div class="btn-group submitter-group float-right">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Status</div>
                        </div>
                        <select class="form-control status-dropdown">
                            <option value="">All</option>
                            <option value="Sold Out">Sold Out</option>
                            <option value="Available">Available</option>
                        </select>
                    </div>
                </div> -->
            </div>
        </div>
        <div class="card-form py-4">
            <table id="example" class="table pt-4">
                <thead>
                    <tr>
                        <th></th>
                        <th>Suite Name</th>
                        <th>Suite Type</th>
                        <th>Size</th>
                        <th>View</th>
                        <th>Price</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $args = array(
                        'post_type' => 'floorplans',
                        'numberposts' => -1,
                        'orderby'   => 'meta_value',
                        'order' => 'DESC',
                        'meta_query' => array(
                            array(
                                'key' => 'associated_property',
                                'value' => $associated_property,
                                'compare' => '=',
                            ),
                        )
                    );

                    $associated_floorplans = new WP_Query(${args});
                    if ($associated_floorplans->have_posts()) :
                        while ($associated_floorplans->have_posts()) :
                            $associated_floorplans->the_post();
                            $floor = get_post_meta(get_the_ID(), 'hlr_framework_floorplans', true);
                    ?>
                            <tr>
                                <td>
                                    <div class="d-none"><?= $floor['opt-floorplans-status'] == 'available' ? 'Available' : 'Sold Out' ?></div>
                                    <div class="wrap-head-floorplan">
                                        <span class="status-floorplan <?= $floor['opt-floorplans-status'] == 'available' ? 'status-color-success' : 'status-color-danger' ?>"></span>
                                        <?php the_post_thumbnail('thumbnail') ?>
                                    </div>
                                </td>
                                <td><?= $floor['opt-floorplans-suite-name'] ?></td>
                                <td>
                                    <?= $floor['opt-floorplans-beds'] . ' Beds' ?> , <?= $floor['opt-floorplans-baths'] . ' Baths' ?>
                                </td>
                                <td><?= $floor['opt-floorplans-size'] . ' SQFT' ?></td>
                                <td><?= implode(' / ', $floor['opt-floorplans-view']) ?></td>
                                <td>
                                    <div class="font-weight-bold"><?= '$' . $floor['opt-floorplans-price-from'] ?></div>
                                    <small><?= '$' . $floor['opt-floorplans-price-per'] . '/sq.ft' ?></small>
                                </td>
                                <td><a target="_blank" href="<?php the_permalink() ?>">More Info</a></td>
                            </tr>
                    <?php
                        endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<?php get_footer(); ?>