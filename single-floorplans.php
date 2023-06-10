<?php get_header(); ?>
<?php
$theme_options = get_option('hlr_framework');
$floorplans = get_post_meta(get_the_ID(), 'hlr_framework_floorplans', true);
?>
<div class="container-fluid px-0 mt-lg-5 mt-2">
        <div class="content">
            <div class="row mb-lg-4 mb-2">
                <div class="col-12 mb-4">
                    <h4 class="font-weight-bold h3">Browse more Imperia Condos by Truman Floor Plans</h4>
                </div>
                <div class="col-12">
                    <div class="btn-group submitter-group float-left">
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
                            'value' => get_the_ID(),
                            'compare' => '='
                        )
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
                            <td><?= '$' . $floor['opt-floorplans-price-from'] ?></td>
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
<?php get_footer(); ?>