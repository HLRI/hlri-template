<?php get_header(); ?>
<?php
$theme_options = get_option('hlr_framework');
$floorplans = get_post_meta(get_the_ID(), 'hlr_framework_floorplans', true);
?>
<div class="container-fluid px-lg-5 my-4">
    <div class="row">
        <div class="col-lg-9 px-4">

            <div class="row floorplan-header mb-4">
                <div class="col-lg-8 d-flex align-items-center px-lg-0">
                    <span class="status-floorplan <?= $floorplans['opt-floorplans-status'] == 'available' ? 'status-color-success' : 'status-color-danger' ?>"></span>
                    <h1 class="font-weight-bold h2"><?php the_title() ?></h1>
                </div>
                <div class="col-lg-4 text-right px-lg-0">
                    <div class="floorplan-price">
                        From <span class="from-price"><?= $floorplans['opt-floorplans-price-from'] ?></span>
                    </div>
                    <div>
                        <?= $floorplans['opt-floorplans-price-per'] ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 px-lg-0">
                    <div class="image-floorplan">
                        <?php the_post_thumbnail() ?>
                    </div>
                </div>
            </div>

            <div class="row mt-4 p-lg-4 border py-4">
                <div class="col-6 col-lg-3 mb-3 mb-lg-0">
                    <div class="floorplan-item">
                        <div class="title-item">
                            SQ.FT.
                        </div>
                        <div class="content-item">
                            <?= $floorplans['opt-floorplans-interior-size'] ?>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 mb-3 mb-lg-0">
                    <div class="floorplan-item">
                        <div class="title-item">
                            TYPE
                        </div>
                        <div class="content-item">
                            <?= $floorplans['opt-floorplans-beds'] ?>, <?= $floorplans['opt-floorplans-baths'] ?>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 mb-3 mb-lg-0">
                    <div class="floorplan-item">
                        <div class="title-item">
                            EXPOSURE
                        </div>
                        <div class="content-item">
                            <?= $floorplans['opt-floorplans-view'] ?>
                        </div>
                    </div>
                </div>
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
                                            <?php $data = explode('/', $floorplans['opt-floorplans-price-per']) ?>
                                            <div class="square-foot-price"><span><?= $data[0] ?></span>/<?= $data[1] ?></div>
                                            <div class="square-foot-title">Suite Details</div>
                                            <div class="square-foot-item">
                                                <span class="name">Suite Name : </span>
                                                <span class="value"><?= $floorplans['opt-floorplans-suite-name'] ?></span>
                                            </div>
                                            <div class="square-foot-item">
                                                <span class="name">Beds : </span>
                                                <span class="value"><?= $floorplans['opt-floorplans-beds'] ?></span>
                                            </div>
                                            <div class="square-foot-item">
                                                <span class="name">Baths : </span>
                                                <span class="value"><?= $floorplans['opt-floorplans-baths'] ?></span>
                                            </div>
                                            <div class="square-foot-item">
                                                <span class="name">View : </span>
                                                <span class="value"><?= $floorplans['opt-floorplans-view'] ?></span>
                                            </div>
                                            <div class="square-foot-item">
                                                <span class="name">Interior Size : </span>
                                                <span class="value"><?= $floorplans['opt-floorplans-interior-size'] ?></span>
                                            </div>
                                            <div class="square-foot-item">
                                                <span class="name">Floor Range : </span>
                                                <span class="value"><?= $floorplans['opt-floorplans-floor-range'] ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 mb-5 mb-lg-0">
                                        <div class="square-foot-wrap">
                                            <div class="square-foot-head">IMPERIA CONDOS BY TRUMAN AVERAGE</div>
                                            <div class="square-foot-price"><span>$868</span>/sq.ft</div>
                                            <div class="square-foot-title">Prices</div>
                                            <div class="square-foot-item">
                                                <span class="name">Price (From) : </span>
                                                <span class="value"><?= $floorplans['opt-floorplans-price-from'] ?></span>
                                            </div>
                                            <div class="square-foot-item">
                                                <span class="name">Price Per Sq.Ft : </span>
                                                <span class="value"><?= $floorplans['opt-floorplans-price-per'] ?></span>
                                            </div>
                                            <div class="square-foot-item">
                                                <span class="name">Mt. Fees per Month : </span>
                                                <span class="value"><?= $floorplans['opt-floorplans-mt-fees-per-month'] ?></span>
                                            </div>
                                            <div class="square-foot-item">
                                                <span class="name">Parking : </span>
                                                <span class="value"><?= $floorplans['opt-floorplans-parking'] ?></span>
                                            </div>
                                            <div class="square-foot-item">
                                                <span class="name">Locker : </span>
                                                <span class="value"><?= $floorplans['opt-floorplans-locker'] ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 mb-5 mb-lg-0">
                                        <div class="square-foot-wrap">
                                            <div class="square-foot-head">NEIGHBOURHOOD AVERAGE</div>
                                            <div class="square-foot-price"><span>$0</span>/sq.ft</div>
                                            <div class="square-foot-title">Deposit Structure</div>
                                            <?php echo $floorplans['opt-floorplans-deposit-structure']; ?>
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
    <div class="row">
        <div class="content">
            <div class="row">
                <div class="col-8">
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
                </div>
            </div>
        </div>
        <table id="example" class="table">
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
                <tr>
                    <td>Tiger Nixon</td>
                    <td>System Architect</td>
                    <td>Edinburgh</td>
                    <td>61</td>
                    <td>2011/04/25</td>
                    <td>$320,800</td>
                    <td>
                        <div class="badge status-badge badge-light">
                            Available
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Tiger Nixon</td>
                    <td>System Architect</td>
                    <td>Edinburgh</td>
                    <td>61</td>
                    <td>2011/04/25</td>
                    <td>$320,800</td>
                    <td>
                        <div class="badge status-badge badge-light">
                            Sold Out
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<?php get_footer(); ?>