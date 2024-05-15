<?php get_header(); ?>
<?php
$psd = properties_single_cached();
$associated_floorplansDetails = associated_floorplans_cached();
$associated_floorplans = associated_floorplans_cached();
$data = get_post_meta(get_the_ID(), 'hlr_framework_mapdata', true);
function addOrdinalSuffix($number)
{
    return $number . ($number % 100 == 11 || $number % 100 == 12 || $number % 100 == 13 ? 'th' : ['th', 'st', 'nd', 'rd'][$number % 10] ?? 'th');
}
?>

<?php //include HLR_THEME_COMPONENT . 'navigation-single-property.php' ?>

    <div id="navigation-fixed-location"></div>
    <div class="container-lg px-lg-5">

        <div class="mt-4">
            <div class="p-3 bg-foreground rounded mb-4">
                <div class="p-0 position-relative">

                    <div class="d-flex align-items-center justify-content-between mb-2 card-property-responsive">
<!--                        --><?php //if (!empty($psd['properties_logo']['url'])) : ?>
<!--                            <img src="--><?php //= $psd['properties_logo']['url'] ?><!--" loading="lazy" class="w-25 rounded mr-4"-->
<!--                                 alt="--><?php //= $psd['properties_logo']['url'] ?><!--">-->
<!--                        --><?php //elseif (!empty($psd['thumbnail_url'])) : ?>
<!--                            <img src="--><?php //= $psd['thumbnail_url'] ?><!--" loading="lazy" class="w-25 rounded mr-4"-->
<!--                                 alt="--><?php //= $psd['thumbnail_caption'] ?><!--">-->
<!--                        --><?php //else : ?>
<!--                            <img src="--><?php //= HLR_THEME_ASSETS . 'images/noimage.jpg' ?><!--" alt="">-->
<!--                        --><?php //endif; ?>
                        <div class="container-fluid">
                            <h2><?= $psd['title'] ?></h2>
                            <p class="project-title toptitle"><?= $data['opt-project-name'] ?></p>
                            <?php if ($data['opt-sales-type'] == "Assignment") : ?>
                                <p class="top-prptype">Assignment <?php echo implode(', ', $data['opt-type']); ?> for Sale</p>
                            <?php endif; ?>
                            <?php if (!empty(get_the_excerpt())) : ?>
                                <p class="text-muted top-excerpt"> <?= get_the_excerpt() ?></p>
                            <?php endif; ?>
                            <?php if (($data['opt-sales-type'] == "Assignment") || ($data['opt-sales-type'] == "Resale")) : ?>
                                <div class="characteristics-cnt">
                                    <ul>
                                        <li class="property-type ic-proptype" title="Property type: <?php echo $data['opt-sales-type'] . ' ' . implode(', ', $data['opt-type']); ?>" >
                                            <i class="fas fa-fas fa-building"></i><br>
                                            <?php echo $data['opt-sales-type'] . ' ' . implode(', ', $data['opt-type']); ?>
                                        </li>
                                        <li data-label="Beds" class="ic-beds" title="Number of Bedrooms: <?php echo $data['opt-min-bed']; ?>">
                                            <i class="fas fa-bed"></i><br><strong><?php echo $data['opt-min-bed'] ?></strong>
                                            <span
                                                    class="gray normal-lbl">Beds</span><span
                                                    class="gray short-lbl"></span>
                                        </li>
                                        <li data-label="Baths" class="ic-baths" title="Number of Bathrooms: <?php echo $data['opt-min-bath']; ?>">
                                            <i class="fas fa-bath"></i><br><strong><?php echo $data['opt-min-bath'] ?></strong>
                                            <span
                                                    class="gray normal-lbl">Baths</span><span
                                                    class="gray short-lbl"></span>
                                        </li>
                                        <li data-label="Sqft" class="ic-sqft" title="Property Size: <?php echo $data['opt-size-min']; ?> Sqft.">
                                            <i class="fas fa-vector-square"></i><br><strong><?php echo $data['opt-size-min'] ?></strong>
                                            <span
                                                    class="gray normal-lbl">Sqft</span><span
                                                    class="gray short-lbl"></span>
                                        </li>
                                        <?php if (!empty($data['opt-parking-quantity'])) : ?>
                                            <li class="property-type ic-proptype" title="Number of Parkings: <?php echo $data['opt-parking-quantity']; ?>">
                                                <i class="fas fa-parking"></i><br><?php echo $data['opt-parking-quantity'] . ' Parking' ?>
                                            </li>
                                        <?php endif; ?>

                                        <?php if ($associated_floorplansDetails->have_posts()) : ?>
                                            <?php
                                            $floorplan_count = 0;
                                            $firstfloor = [];
                                            while ($associated_floorplansDetails->have_posts()) :
                                                $associated_floorplansDetails->the_post();
                                                $floor = get_post_meta(get_the_ID(), 'hlr_framework_floorplans', true);
                                                $floorplan_count++;
                                                if ($floorplan_count === 1) {
                                                    $firstfloor = $floor;
                                                    break;
                                                }
                                            endwhile;
                                            wp_reset_postdata();
                                            ?>
                                        <?php endif; ?>
                                        <?php if (!empty($firstfloor['opt-floorplans-view'])) : ?>
                                            <li class="property-type ic-proptype" title="Exposure: <?php echo $firstfloor['opt-floorplans-view']; ?>"><span><i class="fas fa-eye"></i><br>
                                                <?php echo $firstfloor['opt-floorplans-view'] . ' View'; ?></span>
                                            </li>
                                        <?php endif; ?>
                                        <?php if (!empty($firstfloor['opt-floorplans-floor-range'])) : ?>
                                            <li class="property-type ic-proptype" title="Level: <?php echo addOrdinalSuffix($firstfloor['opt-floorplans-floor-range']) ?>"><i
                                                        class="fa-solid fa-elevator"></i><br>
                                                <b><?php echo addOrdinalSuffix($firstfloor['opt-floorplans-floor-range']) ?></b>  Level
                                            </li>
                                        <?php endif; ?>
                                        <?php if (!empty($data['opt-locker'])) : ?>
                                            <li class="property-type ic-proptype" title="Number of Lockers: <?php echo $data['opt-locker'] ?>">
                                                <i class="fas fa-lock"></i><br><b><?php echo $data['opt-locker']; ?></b> Locker
                                            </li>
                                        <?php endif; ?>
                                        <?php if (!empty($firstfloor['opt-floorplans-price-per'])) : ?>
                                            <li class="property-type ic-proptype" title="Property Price/Sqft: <?php echo '$' . number_format($firstfloor['opt-floorplans-price-per'], 0) ?>"><i class="fas fa-comments-dollar"></i><br>
                                                <b><?php echo '$' . number_format($firstfloor['opt-floorplans-price-per'], 0) ?></b>/Sqft.
                                            </li>
                                        <?php endif; ?>
                                        <?php endif; ?>
                                        <?php $terms = get_the_terms(get_the_ID(), 'neighborhood');
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
                                        ?>
                                        <?php if (!empty($avgn)) : ?>
                                            <li class="property-type ic-proptype" title="Neighbourhood Price/Sqft Average: <?php echo '$' . number_format($avgn, 0); ?>">
                                                <i class="fas fa-map"></i><br><?php echo number_format($avgn, 0); ?>/Sqft Nbhd Avg
                                            </li>
                                        <?php endif; ?>
                                        <?php if (!empty($data['opt-assignment-original-price'])) : ?>
                                            <li class="property-type ic-proptype" title="Property Original Price: <?php echo '$' . number_format($data['opt-assignment-original-price'], 0) ?>"><i class="fas fa-money-bill-alt"></i><br>
                                                <b><?php echo '$' . number_format($data['opt-assignment-original-price'], 0) ?></b> Original Price
                                            </li>
                                        <?php endif; ?>
                                        <?php if (!empty($data['opt-assignment-paid-deposit'])) : ?>
                                            <li class="property-type ic-proptype" title="Paid Deposit: <?php echo '$' . number_format($data['opt-assignment-paid-deposit'], 0) ?>"><i class="fas fa-money-bill-alt"></i><br>
                                                <b><?php echo '$' . number_format($data['opt-assignment-paid-deposit'], 0) ?></b> Paid Deposit
                                            </li>
                                        <?php endif; ?>
                                        <?php if (!empty($data['opt-assignment-remaining-deposit'])) : ?>
                                            <li class="property-type ic-proptype" title="Remaining Deposit: <?php echo '$' . number_format($data['opt-assignment-remaining-deposit'], 0) ?>"><i class="fas fa-money-bill-alt"></i><br>
                                                <b><?php echo '$' . number_format($data['opt-assignment-remaining-deposit'], 0) ?></b> Remaining Deposit
                                            </li>
                                        <?php endif; ?>
                                        <?php if (!empty($data['opt-assignment-total-cash-required'])) : ?>
                                            <li class="property-type ic-proptype" title=" Required Cash: <?php echo '$' . number_format($data['opt-assignment-total-cash-required'], 0) ?>"><i class="fas fa-money-bill-alt"></i><br>
                                                <b><?php echo '$' . number_format($data['opt-assignment-total-cash-required'], 0) ?></b> Required Cash
                                            </li>
                                        <?php if (!empty($data['opt-occupancy'])) : ?>
                                            <li class="property-type ic-proptype">
                                                <i class="fas fa-calendar"></i><br><?php $occupancyOp = (!empty($data['opt-occupancy-time-period'])) ? $data['opt-occupancy-time-period'] . ' ' : '';
                                                echo 'occup ' . $occupancyOp . $data['opt-occupancy']; ?>
                                            </li>
                                        <?php endif; ?>
                                        <?php if (!empty($data['opt-built']) and ($data['opt-built'] == "1")) : ?>
                                            <li class="property-type ic-proptype">
                                                <i class="fas fa-check-square"></i><br><?php echo 'After Occupency' ?>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <style>
                        .characteristics-cnt ul {
                            margin-top: 20px;
                            display: grid;
                            gap: 10px;
                            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
                            grid-template-rows: masonry;
                        }

                        .characteristics-cnt li {
                            margin-bottom: 10px;
                            margin-right: 8px;
                        }
                    </style>


                    <div class="row mb-2 justify-content-start px-0 px-md-3 ">
                        <div class=" col-12 col-sm-6 d-flex p-1 align-items-end justify-content-start ">
                            <div class="rating-stars">
                                <span class="update-label bg-foreground text-muted ">Last Update : <?= isset($psd['modified_date']) ? $psd['modified_date'] : 'No Update' ?></span>
                                <ul class="mt-3" id="stars">
                                    <?php if ($psd['properties_rated_id'] != get_the_ID()) : ?>
                                        <?php for ($i = 0; $i < 5; $i++) : ?>
                                            <?php
                                            switch ($i + 1) {
                                                case 1:
                                                    $status = 'Poor';
                                                    break;
                                                case 2:
                                                    $status = 'Fair';
                                                    break;
                                                case 3:
                                                    $status = 'Good';
                                                    break;
                                                case 4:
                                                    $status = 'Excellent';
                                                    break;
                                                default:
                                                    $status = 'WOW';
                                                    break;
                                            }
                                            ?>
                                            <?php if ($i < $psd['rates']) : ?>
                                                <li class="star selected" data-value="<?= $i + 1 ?>"
                                                    title="<?= $status ?>">
                                                    <i class="fa fa-star fa-fw"></i>
                                                </li>
                                            <?php else : ?>
                                                <li class="star" data-value="<?= $i + 1 ?>" title="<?= $status ?>">
                                                    <i class="fa fa-star fa-fw"></i>
                                                </li>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                    <?php else : ?>
                                        <?php for ($i = 0; $i < 5; $i++) : ?>
                                            <?php if ($i < $psd['rates']) : ?>
                                                <li class="star-rated selected">
                                                    <i class="fa fa-star fa-fw"></i>
                                                </li>
                                            <?php else : ?>
                                                <li class="star-rated">
                                                    <i class="fa fa-star fa-fw"></i>
                                                </li>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                    <?php endif; ?>
                                </ul>
                            </div>
                            <?php if (!empty($psd['user_rates'])) : ?>
                                <span class="votes"> <?= $psd['user_rates'] ?> votes</span>
                            <?php endif; ?>
                        </div>
                        <?php if (!empty($data['opt-price-min'])) : ?>
                            <div class=" col-12 col-sm-6 d-flex flex-column justify-content-center align-items-end">
                                <div class="start-price mb-3">
                                    <?php if (($data['opt-sales-type'] == "Assignment") || ($data['opt-sales-type'] == "Resale")) : ?>
                                        Asking Price
                                    <?php else : ?>
                                        Starting from
                                    <?php endif; ?><span>
                                    $<?= number_format($data['opt-price-min']) ?>
                                </span>
                                </div>
                                <div class="btn-group">
                                    <!-- <button class="btn btn-primary"> <i class="fa fa-share" ></i> Share </button> -->
                                    <button class="btn btn-primary"
                                            onclick="setLikeProperties(this, <?= get_the_ID() ?>)"><i
                                                class="fa fa-heart" <?= isset($_COOKIE[get_the_ID()]) ? ' style="color:red" ' : '' ?>></i>
                                        Favorite
                                    </button>
                                    <button class="btn btn-primary" onclick="bookmark(this,<?= get_the_ID() ?>)">
                                        <i <?= is_user_logged_in() && in_array(get_the_ID(), (array)get_user_meta(get_current_user_id(), 'properties_favorites', false)) ? 'style="color:#9de450"' : '' ?>
                                                class="fa fa-bookmark"></i>
                                        Save
                                    </button>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4 properties-image-gallery px-3  mb-4 border-top pt-4">
            <div class="col-12  rounded mb-3 mb-md-0 justify-content-center align-items-center col-md-6 d-flex">
                <!-- map details -->
                <!-- Properties map -->
                <!--location:  inc/scripts.php -->
                <div class="col-12 p-0 map-container rounded">
                    <div id="map"></div>
                </div>
            </div>





    </div>
    <!-- Content Section  -->


    <br><br>


<?php get_footer(); ?>