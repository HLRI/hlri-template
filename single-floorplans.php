<?php get_header(); ?>
<?php
$theme_options = get_option('hlr_framework');
$floorplans = get_post_meta(get_the_ID(), 'hlr_framework_floorplans', true);
?>

<div class="container-fluid px-5 my-4">

    <div class="row">
        <div class="col-lg-8">

            <div class="row floorplan-header mb-5">
                <div class="col-lg-8 d-flex align-items-center">
                    <h1 class="font-weight-bold h2"><?php the_title() ?></h1>
                </div>
                <div class="col-lg-4 text-right">
                    <div class="floorplan-price">
                        From <span class="from-price"><?= $floorplans['opt-floorplans-price-from'] ?></span>
                    </div>
                    <div>
                        <?= $floorplans['opt-floorplans-price-per'] ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 px-0">
                    <div class="image-floorplan">
                        <?php the_post_thumbnail() ?>
                    </div>
                </div>
            </div>

            <div class="row mt-4 p-4 border">
                <div class="col-lg-3">
                    <div class="floorplan-item">
                        <div class="title-item">
                            SQ.FT.
                        </div>
                        <div class="content-item">
                            <?= $floorplans['opt-floorplans-interior-size'] ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="floorplan-item">
                        <div class="title-item">
                            TYPE
                        </div>
                        <div class="content-item">
                            <?= $floorplans['opt-floorplans-beds'] ?>, <?= $floorplans['opt-floorplans-baths'] ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="floorplan-item">
                        <div class="title-item">
                            EXPOSURE
                        </div>
                        <div class="content-item">
                            <?= $floorplans['opt-floorplans-view'] ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="floorplan-item">
                        <div class="title-item">
                            FLOOR RANGE
                        </div>
                        <div class="content-item">
                            <?= $floorplans['opt-floorplans-floor-range'] ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div id="accordion">
                    <div class="">
                        <div class="card-header p-0" id="headingOne">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Price Per Square Foot
                                </button>
                            </h5>
                        </div>

                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="row">
                                <div class="col-lg-4">1</div>
                                <div class="col-lg-4">2</div>
                                <div class="col-lg-4">3</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-lg-4">
            <?php if ($theme_options['opt-properties-status']) : ?>
                <?php if (!empty($theme_options['opt-properties-shortcode'])) : ?>
                    <div class="properties-shortcode">
                        <div class="titr-list ml-0 mb-2 pb-1 mr-0">
                            <h3 class="font-weight-bold h4 mb-0">Register Now to get full package , book your unit</h3>
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
</div>


<?php get_footer(); ?>