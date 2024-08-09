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
$mdata_status = get_post_meta($pid, 'hlr_framework_mapdata', true);

$args = array(
    'post_type' => 'properties',
    'posts_per_page' => 1,
    'p' => $pid
);
$property = new WP_Query($args);

?>
<div class="container-lg  px-lg-5 my-4">
    <div class="row">
        <div class="col-lg-9 px-4">

            <div class="row floorplan-header mb-4">
                <div class="col-lg-8 px-lg-0">
                    <?php
                        if (isset($property) && $property->have_posts()) :
                            while ($property->have_posts()) : 
                                $property->the_post();
                                $terms = get_the_terms(get_the_ID(), 'neighborhood');
                                $total_neighborhood = [];
                                
                                if (!empty($terms)) {
                                    foreach ($terms as $term) {
                                        $neighborhood_meta = get_term_meta($term->term_id, 'neighborhood_options', true);
                                        if (is_array($neighborhood_meta) && isset($neighborhood_meta['opt-neighborhood-appson'])) {
                                            $total_neighborhood[] = $neighborhood_meta['opt-neighborhood-appson'];
                                        }
                                    }
                                    if (count($total_neighborhood)) {
                                        $avgn = array_sum($total_neighborhood) / count($total_neighborhood);
                                    } else {
                                        $avgn = '';
                                    }
                                } else {
                                    $avgn = '';
                                }

                                $mdata_single = get_post_meta(get_the_ID(), 'hlr_framework_mapdata', true);
                        ?>
                                <div>
                                    <?php if (!empty($mdata_single['opt-developer'])) : ?>
                                        <h4 class="font-weight-bold h6"><?= strtoupper(get_the_title() . ' by ' . $mdata_single['opt-developer']) ?></h4>
                                    <?php else : ?>
                                        <h4 class="font-weight-bold h6"><?= strtoupper(get_the_title()) ?></h4>
                                    <?php endif; ?>
                                </div>
                        <?php
                            endwhile;
                            wp_reset_postdata();
                            wp_reset_query();
                        endif;
                        ?>
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
                            From <span class="from-price"><?= '$' . number_format($floorplans['opt-floorplans-price-from']) ?></span>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($floorplans['opt-floorplans-price-per'])) : ?>
                        <div>
                            <?= '$' . number_format($floorplans['opt-floorplans-price-per']) . '/sq.ft' ?>
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
                            if (!empty($mdata_single['opt-developer'])) {
                                $title_img = strtoupper(get_the_title() . ' by ' . $mdata_single['opt-developer']);
                            } else {
                                $title_img = strtoupper(get_the_title());
                            }
                        endwhile;
                        wp_reset_postdata();
                        wp_reset_query();

                        if (!empty($floorplans['opt-floorplans-price-from'])) {
                            $fp = 'From $' . number_format($floorplans['opt-floorplans-price-from']);
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
                        $view = $floorplans['opt-floorplans-view'];

                        $info = implode(', ', array_filter([$sq, $bed, $baths, $view]));
                        $infoimg = implode(', ', array_filter([$title_img, $fp, $baths, $info]));

                        ?>
                        <a href="<?= get_the_post_thumbnail_url() ?>"  title="<?= $infoimg ?>" data-lightbox="roadtrip">
                            <img loading="lazy" class="img-floorplan" src="<?= get_the_post_thumbnail_url() ?>" alt="<?= $infoimg ?>">
                        </a>
                    </div>
                </div>
            </div>

            <div class="row mt-4 p-lg-2 py-2 rounded ">
                <?php if (!empty($floorplans['opt-floorplans-interior-size'])) : ?>
                    <div class="col-6 col-lg-3 mb-3 mb-lg-0">
                        <div class="floorplan-item">
                            <div class="title-item">
                                SQ.FT.
                            </div>
                            <div class="content-item">
                                <?= $floorplans['opt-floorplans-interior-size'] ?> sq.ft
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if (!empty($floorplans['opt-floorplans-beds']) || !empty($floorplans['opt-floorplans-baths'])) : ?>
                    <div class="col-6 col-lg-3 mb-3 mb-lg-0">
                        <div class="floorplan-item">
                            <div class="title-item">
                                TYPE
                            </div>
                            <div class="content-item">
                                <?= $floorplans['opt-floorplans-beds'] ?> Bed, <?= $floorplans['opt-floorplans-baths'] ?> Bath
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if (!empty($floorplans['opt-floorplans-view'])) : ?>
                    <div class="col-6 col-lg-3 mb-3 mb-lg-0">
                        <div class="floorplan-item">
                            <div class="title-item">
                                EXPOSURE
                            </div>
                            <div class="content-item">
                                <?= $floorplans['opt-floorplans-view']; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if (!empty($floorplans['opt-floorplans-floor-range'])) : ?>
                <div class="col-6 col-lg-3 mb-3 mb-lg-0">
                    <div class="floorplan-item">
                            <div class="title-item">
                                FLOOR RANGE
                            </div>
                            <div class="content-item">
                                <?= $floorplans['opt-floorplans-floor-range'] ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
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
                                                <div class="square-foot-price"><span><?= '$' . number_format($floorplans['opt-floorplans-price-per']) ?></span>/sq.ft</div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 mb-5 mb-lg-0">
                                        <div class="square-foot-wrap">
                                            <div class="square-foot-head">
                                                <?php if ($property->have_posts()) : ?>
                                                    <?php
                                                    while ($property->have_posts()) : $property->the_post();
                                                        $mdata_single = get_post_meta(get_the_ID(), 'hlr_framework_mapdata', true);
                                                    ?>
                                                        <div>
                                                            <?php if (!empty($mdata_single['opt-developer'])) : ?>
                                                                <?= strtoupper(get_the_title() . ' by ' . $mdata_single['opt-developer']) ?>
                                                            <?php else : ?>
                                                                <?= strtoupper(get_the_title() . ' AVERAGE') ?>
                                                            <?php endif; ?>
                                                        </div>
                                                    <?php
                                                    endwhile;
                                                    wp_reset_postdata();
                                                    wp_reset_query();
                                                    ?>
                                                <?php endif; ?>
                                            </div>
                                            <?php if ($property->have_posts()) : ?>
                                                <?php
                                                while ($property->have_posts()) : $property->the_post();
                                                    $mdata_single = get_post_meta(get_the_ID(), 'hlr_framework_mapdata', true);
                                                ?>
                                                    <?php if (!empty($mdata_single['opt-pricepersqft'])) : ?>
                                                        <div class="square-foot-price"><span>$<?= $mdata_single['opt-pricepersqft'] ?></span>/sq.ft</div>
                                                    <?php endif; ?>
                                            <?php
                                                endwhile;
                                            endif;
                                            wp_reset_postdata();
                                            wp_reset_query();
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 mb-5 mb-lg-0">
                                        <div class="square-foot-wrap">
                                            <div class="square-foot-head">NEIGHBOURHOOD AVERAGE</div>
                                            <?php if (!empty($avgn)) : ?>
                                                <div class="square-foot-price"><span>$<?= $avgn ?></span>/sq.ft</div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-lg-4 mb-5 mb-lg-0">
                                        <div class="square-foot-wrap">
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
                                                    <span class="value"><?= $floorplans['opt-floorplans-view']; ?></span>
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
                                            <div class="square-foot-title">Prices</div>
                                            <?php if (!empty($floorplans['opt-floorplans-price-from'])) : ?>
                                                <div class="square-foot-item">
                                                    <span class="name">Price (From) : </span>
                                                    <span class="value"><?= '$' . number_format($floorplans['opt-floorplans-price-from']) ?></span>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (!empty($floorplans['opt-floorplans-price-per'])) : ?>
                                                <div class="square-foot-item">
                                                    <span class="name">Price Per Sq.Ft : </span>
                                                    <span class="value"><?= '$' . number_format($floorplans['opt-floorplans-price-per']) . '/sq.ft' ?></span>
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
                                            <?php
                                            if (!empty($floorplans['opt-floorplans-deposit-structure'])) {
                                                // If the deposit structure of the floor plan is not empty, display it
                                                echo '<div class="square-foot-title">Deposit Structure</div>';
                                                echo $floorplans['opt-floorplans-deposit-structure'];
                                            } else {
                                                // If the deposit structure of the floor plan is empty, retrieve it from the associated property
                                                $selectedFloorPlanType = isset($floorplans['floor_plan_type_text']) ? $floorplans['floor_plan_type_text'] : '';
                                                // Check if the selected floor plan type is not empty
                                                if (!empty($selectedFloorPlanType)) {
                                                    $floor_plan_types = get_post_meta( $pid, 'hlr_framework_mapdata', true );
                                                    $floorPlanTypes = $floor_plan_types['floor_plan_types'];
                                                    foreach ($floorPlanTypes as $floorPlanType) {
                                                        // Check if the title of the floor plan type matches the selected floor plan type
                                                        if ($floorPlanType['title'] === $selectedFloorPlanType) {
                                                            // Display the deposit structure of the matched floor plan type
                                                            echo '<div class="square-foot-title">Deposit Structure</div>';
                                                            echo apply_filters('the_content', $floorPlanType['deposit_structure']);
                                                            break; // Exit the loop once a match is found
                                                        }
                                                    }
                                                }  else {
                                                    // here
                                                    if ($property->have_posts()) :
                                                        while ($property->have_posts()) : $property->the_post();
                                                            $mdata_single = get_post_meta(get_the_ID(), 'hlr_framework_mapdata', true);
                                                            ?>
                                                            <div class="square-foot-title">Deposit Structure</div>
                                                            <?php echo wpautop($mdata_single['opt-deposit-structue'], true); ?>
                                                        <?php
                                                        endwhile;
                                                    endif;
                                                    wp_reset_postdata();
                                                    wp_reset_query();
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-lg-4 mb-5 mb-lg-0">
                                        <p class="additional-note-wrap">
                                        <div class="additional-note-title">Additional Note</div>
                                        <?php if (!empty($floorplans['opt-floorplans-note'])) : ?>
                                            <p>
                                                <?= $floorplans['opt-floorplans-note'] ?>
                                            </p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-lg-3 pl-lg-4 pr-lg-0 px-4">
<style>
    .hlri-input-container span.wpcf7-spinner {
        position: relative;
        top: -19px;
    }
    .wpcf7-spinner:before {
        opacity: 1 !important;
        background-color: white !important;
        width: 5px !important;
        top: 4px !important;
        left: 4px !important;
    }
    form{
        margin-top: -25px;
    }
    .image-floorplan img {
        border-radius: 10px;
    }
    ::placeholder {
        color: white;
    }
    ::-ms-input-placeholder { /* Edge 12 -18 */
        color: white;
    }
    .wpcf7 form.sent .wpcf7-response-output {
        border-color: #ffffff;
        color: white;
        background: #5dae44;
    }
    .additional-note-wrap,
    .square-foot-wrap {
        max-height: 370px;
        overflow: auto;
    }
</style>
            <div style="background: orange;border-radius: 10px;"><br><h3 class="font-weight-bold h5 mb-0 mt-2 text-center text-white">Register Now to get full package , book your unit</h3>
                <?php echo do_shortcode('[contact-form-7 id="b14d9c3" title="floorplan contact form"]') ?></div>
            <script>
                const inputs = document.querySelectorAll(".hlri-input");

                function focusFunc() {
                    let parent = this.parentNode;
                    parent.classList.add("focus");
                }

                function blurFunc() {
                    let parent = this.parentNode;
                    if (this.value == "") {
                        parent.classList.remove("focus");
                    }
                }

                inputs.forEach((input) => {
                    input.addEventListener("focus", focusFunc);
                    input.addEventListener("blur", blurFunc);
                });
            </script>
            <?php if ($theme_options['opt-properties-status']) : ?>
                <?php if (!empty($theme_options['opt-properties-shortcode'])) : ?>
                    <div class="properties-shortcode">
                        <div class="titr-list ml-0 mb-2 pb-1 mr-0">
                            <?php if (isset($mdata_status['opt-project-status'])) : ?>
                                <h3 class="font-weight-bold h5 mb-0 text-center">Fill the Form to get latest available Listings in This building</h3>
                            <?php else : ?>
                                <h3 class="font-weight-bold h5 mb-0 text-center">Register Now to get full package , book your unit</h3>
                            <?php endif; ?>
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
            <?php include(HLR_THEME_COMPONENT . 'properties/floorplans-table.php'); ?>
    </div>

</div>
<?php get_footer(); ?>