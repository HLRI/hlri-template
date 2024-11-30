<div class="container-fluid border-top pt-3 px-0 mt-lg-5 mt-2" id="FloorPlans">
    <div class="content">
        <div class="row mb-lg-4 mb-2">
            <div class="col-12 mb-4">
                <h4 class="font-weight-bold h3">Browse more Floor Plans</h4>
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
        </div>
    </div>
    <div class="card-form py-4">
        <div class="table-responsive">
            <table class="table pt-4">
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
                        'posts_per_page' => -1,
                        'orderby'   => 'meta_value',
                        'order' => 'DESC',
                        'meta_query' => array(
                            array(
                                'key' => 'associated_property',
                                'value' => $associated_property, // This variable should be defined previously or replace with actual value
                                'compare' => '=',
                            ),
                        )
                    );

                    $associated_floorplans = new WP_Query($args);
                    if ($associated_floorplans->have_posts()) :
                        while ($associated_floorplans->have_posts()) :
                            $associated_floorplans->the_post();
                            $floor = get_post_meta(get_the_ID(), 'hlr_framework_floorplans', true);
                    ?>
                            <tr>
                                <td>
                                    <div class="d-none"><?= $floor['opt-floorplans-status'] ?></div>
                                    <div class="wrap-head-floorplan">
                                        <span class="status-floorplan <?= $floor['opt-floorplans-status'] == 'available' ? 'status-color-success' : 'status-color-danger' ?>"></span>
                                        <?php the_post_thumbnail('thumbnail', ['loading' => 'lazy']) ?>
                                    </div>
                                </td>
                                <td><?= $floor['opt-floorplans-suite-name'] ?></td>
                                <td>
                                    <?php if (!empty($floor['opt-floorplans-beds']) && !empty($floor['opt-floorplans-baths'])) : ?>
                                        <?= $floor['opt-floorplans-beds'] . ' Bed' ?> , <?= $floor['opt-floorplans-baths'] . ' Bath' ?>
                                    <?php else : ?>
                                        -
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if (!empty($floor['opt-floorplans-size'])) : ?>
                                        <?= $floor['opt-floorplans-size'] . ' SQFT' ?>
                                    <?php else : ?>
                                        -
                                    <?php endif; ?>
                                </td>
                                <td><?= $floor['opt-floorplans-view'] ?></td>
                                <td>
                                    <?php if (!empty($floor['opt-floorplans-price-from'])) : ?>
                                        <div class="font-weight-bold"><?= '$' . number_format($floor['opt-floorplans-price-from']) ?></div>
                                    <?php else : ?>
                                        -
                                    <?php endif; ?>
                                    <?php if (!empty($floor['opt-floorplans-interior-size']) && !empty($floor['opt-floorplans-price-from'])) : ?>
                                    <small><?= '$' . round(number_format($floor['opt-floorplans-price-from'], 2, '.', '') / number_format($floor['opt-floorplans-interior-size'], 2, '.', '')) . '/sq.ft' ?></small>
                                    <?php else : ?>
                                        -
                                    <?php endif; ?>
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