<?php get_header(); ?>
<?php
$psd = properties_single_cached();
$associated_floorplans = associated_floorplans_cached();
$data = get_post_meta(get_the_ID(), 'hlr_framework_mapdata', true);
function addOrdinalSuffix($number)
{
    return $number . ($number % 100 == 11 || $number % 100 == 12 || $number % 100 == 13 ? 'th' : ['th', 'st', 'nd', 'rd'][$number % 10] ?? 'th');
}

if (is_user_logged_in()) {
    $loginClasses = ' dataShowStyle';

} else {
    $loginClasses = ' dataShowStyles';
}
?>

<?php //include HLR_THEME_COMPONENT . 'navigation-single-property.php' ?>

    <div id="navigation-fixed-location"></div>
    <div class="container-fluid px-lg-5">

        <div class="mt-4">
            <div class="p-3 bg-foreground rounded mb-4">
                <div class="p-0 position-relative">

                    <div class="excerpt-top d-flex align-items-center justify-content-between mb-2 card-property-responsive">
                        <?php if (!empty($psd['properties_logo']['url'])) : ?>
                            <img src="<?= $psd['properties_logo']['url'] ?>" loading="lazy"
                                 style="max-width:200px;max-height:200px;"
                                 class="hide-on-sm project-logo-top w-auto rounded mr-4"
                                 alt="<?= $psd['properties_logo']['url'] ?>"/>
                        <?php elseif (!empty($psd['thumbnail_url'])) : ?>
                            <img src="<?= $psd['thumbnail_url'] ?>" loading="lazy"
                                 class="hide-on-sm w-auto rounded mr-4"
                                 alt="<?= $psd['thumbnail_caption'] ?>"/>
                        <?php else : ?>
                            <img src="<?= HLR_THEME_ASSETS . 'images/noimage.jpg' ?>" alt="">
                        <?php endif; ?>
                        <div class="container-fluid">
                            <div class="show-on-sm col-sm-12" style="display:none;">
                                <?php if (!empty($psd['properties_logo']['url'])) : ?>
                                    <img src="<?= $psd['properties_logo']['url'] ?>" loading="lazy"
                                         style="max-width:200px;max-height:200px;"
                                         class="project-logo-top w-auto rounded mr-4"
                                         alt="<?= $psd['properties_logo']['url'] ?>"/>
                                <?php elseif (!empty($psd['thumbnail_url'])) : ?>
                                    <img src="<?= $psd['thumbnail_url'] ?>" loading="lazy" class="w-auto rounded mr-4"
                                         alt="<?= $psd['thumbnail_caption'] ?>"/>
                                <?php else : ?>
                                    <img src="<?= HLR_THEME_ASSETS . 'images/noimage.jpg' ?>" alt="">
                                <?php endif; ?>
                            </div>
                            <h2><?= $psd['title'] ?></h2>
                            <?php if (!empty(the_excerpt())) : ?>
                                <p class="text-muted"> <?= the_excerpt() ?></p>
                            <?php endif; ?>

                            <a href="#register" class="mt-2 mb-2 btn btn-lg" style="background-color: rgb(221, 219, 233);border: 2px solid rgb(0 0 0);border-radius: 5px;text-align: center;font-weight: bold;transition: background-color 0.3s, transform 0.3s, box-shadow 0.3s;box-shadow: none;transform: scale(1);font-size: 14px;color: black;"
                               onmouseover="this.style.backgroundColor='rgb(254 194 15)';"
                               onmouseout="this.style.backgroundColor='rgb(221, 219, 233)'; this.style.transform='scale(1)';">
                                Register below to secure your unit
                            </a>







                            <?php if (($data['opt-sales-type'] == "Preconstruction") || ($data['opt-sales-type'] == "Resale") || ($data['opt-sales-type'] == "Comming soon")) : ?>
                                <div class="characteristics-cnt">
                                    <ul>
                                        <?php if (($data['opt-sales-type'] == "Preconstruction")) : ?>
                                            <li class="sales-tatus ic-salesstatus"
                                                title="Sales Status: <?php echo $data['opt-sales-type']; ?>">
                                                <img src="https://condoy.com/wp-content/themes/homeleaderrealty/assets/images/building-construction-icon.svg"
                                                     style="margin-bottom: 4px;height: 30px;">
                                                <?php echo $data['opt-sales-type'] ?>
                                            </li>
                                        <?php endif; ?>
                                        <?php if ($data['opt-sales-type'] == "Resale") : ?>
                                            <li class="sales-tatus ic-salesstatus"
                                                title="Sales Status: <?php echo $data['opt-sales-type']; ?>">
                                                <i class="fa-solid fa-bullhorn"></i>
                                                <?php echo $data['opt-sales-type'] ?>
                                            </li>
                                        <?php endif; ?>
                                        <?php if ($data['opt-sales-type'] == "SoldOut") : ?>
                                            <li class="sales-tatus ic-salesstatus"
                                                title="Sales Status: <?php echo $data['opt-sales-type']; ?>">
                                                <i class="fa-solid fa-tag"></i>
                                                <?php echo $data['opt-sales-type'] ?>
                                            </li>
                                        <?php endif; ?>
                                        <?php if ($data['opt-sales-type'] == "Comming soon") : ?>
                                            <li class="sales-tatus ic-salesstatus" title="Sales Status: Coming Soon">
                                                <i class="fas fa-clock"></i><br>
                                                Coming Soon
                                            </li>
                                        <?php endif; ?>
                                        <?php if (($key = array_search('Preconstruction', $data['opt-sales-type'] ?? [])) !== false) {
                                            $data['opt-sales-type'] = array_values(array_diff($data['opt-sales-type'] ?? [], ['Preconstruction']));
                                        } ?>
                                        <li class="property-type ic-proptype"
                                            title="Property type: <?php echo $data['opt-sales-type'] . ' ' . implode(', ', $data['opt-type']); ?>">
                                            <i class="fas fa-fas fa-building"></i><br>
                                            <?php echo $data['opt-sales-type'] . ' ' . implode(', ', $data['opt-type']); ?>
                                        </li>
                                        <?php if (($data['opt-ownership'] != "")) : ?>
                                            <li class="ownership ic-ownership"
                                                title="Ownership: <?php echo implode(', ', $data['opt-ownership']); ?>">
                                                <i class="fas fa-fas fa-key"></i><br>
                                                <?php echo implode(', ', $data['opt-ownership']); ?>
                                            </li>
                                        <?php endif; ?>
                                        <?php if (array_search('Commercial', $data['opt-type']) === false) : ?>
                                            <li data-label="Beds" class="ic-beds"
                                                title="Number of Bedrooms: <?php echo($data['opt-min-bed'] != "" ? $data['opt-min-bed'] . " - " : 'TBA '); ?> <?php echo $data['opt-max-bed'] ?>">
                                                <i class="fas fa-bed"></i><br>
                                                <strong><?php echo($data['opt-min-bed'] != "" ? $data['opt-min-bed'] . " - " : 'TBA '); ?><?php echo $data['opt-max-bed'] ?></strong>
                                                <span class="gray normal-lbl">Bedroom<?php echo(intval($data['opt-max-bed']) >= 2 ? 's' : ''); ?></span><span
                                                        class="gray short-lbl"></span>
                                            </li>

                                            <li data-label="Baths" class="ic-baths"
                                                title="Number of Bathrooms: <?php echo($data['opt-min-bath'] != "" ? $data['opt-min-bath'] . " - " : 'TBA '); ?> <?php echo $data['opt-max-bath'] ?>">
                                                <i class="fas fa-bath"></i><br><strong><?php echo($data['opt-min-bath'] != "" ? $data['opt-min-bath'] . " - " : 'TBA '); ?><?php echo $data['opt-max-bath'] ?></strong>
                                                <span class="gray normal-lbl">Bathroom<?php echo(intval($data['opt-max-bath']) >= 2 ? 's' : ''); ?></span><span
                                                        class="gray short-lbl"></span>
                                            </li>
                                        <?php endif; ?>


                                        <li data-label="Sqft" class="ic-sqft"
                                            title="Property Size: <?php echo($data['opt-size-min'] != "" ? $data['opt-size-min'] . " - " : 'TBA '); ?> <?php echo $data['opt-size-max'] ?> Sqft.">
                                            <i class="fas fa-vector-square"></i><br><strong><?php echo($data['opt-size-min'] != "" ? $data['opt-size-min'] . " - " : 'TBA '); ?><?php echo $data['opt-size-max'] ?></strong>
                                            <span
                                                    class="gray normal-lbl">Sqft</span><span
                                                    class="gray short-lbl"></span>
                                        </li>
                                        <?php if (!empty($data['opt-floors'])) : ?>
                                            <li class="property-type ic-proptype"
                                                title="Level: <?php echo $data['opt-floors'] ?>"><i
                                                        class="fa-solid fa-elevator"></i><br>
                                                <b><?php echo $data['opt-floors'] ?></b> Storeys
                                            </li>
                                        <?php endif; ?>
                                        <?php if (!empty($data['opt-suites'])) : ?>
                                            <li class="property-type ic-proptype"
                                                title="Level: <?php echo $data['opt-suites'] ?>">
                                                <div style="display: inline-block;width: 100%;margin-bottom: 4px;">
                                                    <svg id="storiesIcon" xmlns="http://www.w3.org/2000/svg" width="30"
                                                         height="30" fill="#6c6c6c" class="bi bi-building-up"
                                                         viewBox="0 0 16 16">
                                                        <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.354-5.854 1.5 1.5a.5.5 0 0 1-.708.708L13 11.707V14.5a.5.5 0 0 1-1 0v-2.793l-.646.647a.5.5 0 0 1-.708-.708l1.5-1.5a.5.5 0 0 1 .708 0"></path>
                                                        <path d="M2 1a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v6.5a.5.5 0 0 1-1 0V1H3v14h3v-2.5a.5.5 0 0 1 .5-.5H8v4H3a1 1 0 0 1-1-1z"></path>
                                                        <path d="M4.5 2a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm3 0a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm3 0a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm-6 3a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm3 0a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm3 0a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm-6 3a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm3 0a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5z"></path>
                                                    </svg>
                                                </div>
                                                <b><?php echo $data['opt-suites'] ?></b> Suites
                                            </li>
                                        <?php endif; ?>
                                        <?php if (!empty($data['opt-occupancy']) || !empty($data['opt-occupancy-time-period'])) : ?>
                                            <li class="property-type ic-proptype">
                                                <i class="fas fa-calendar"></i><br><?php $occupancyOp = (!empty($data['opt-occupancy-time-period'])) ? $data['opt-occupancy-time-period'] . ' ' : '';
                                                echo 'occup ' . $occupancyOp . $data['opt-occupancy']; ?>
                                            </li>
                                        <?php endif; ?>
                                        <?php if (!empty($data['opt-parking-quantity'])) : ?>
                                            <li class="property-type ic-proptype"
                                                title="Number of Parkings: <?php echo $data['opt-parking-quantity']; ?>">
                                                <i class="fas fa-parking"></i><br><?php echo $data['opt-parking-quantity'] . ' Parking' ?>
                                            </li>
                                        <?php endif; ?>

                                        <?php if (!empty($firstfloor['opt-floorplans-floor-range'])) : ?>
                                            <li class="property-type ic-proptype"
                                                title="Level: <?php echo addOrdinalSuffix($firstfloor['opt-floorplans-floor-range']) ?>">
                                                <i
                                                        class="fa-solid fa-elevator"></i><br>
                                                <b><?php echo addOrdinalSuffix($firstfloor['opt-floorplans-floor-range']) ?></b>
                                                Level
                                            </li>
                                        <?php endif; ?>
                                        <?php if (!empty($data['opt-locker'])) : ?>
                                            <li class="property-type ic-proptype"
                                                title="Number of Lockers: <?php echo $data['opt-locker'] ?>">
                                                <i class="fas fa-lock"></i><br><b><?php echo $data['opt-locker']; ?></b>
                                                Locker
                                            </li>
                                        <?php endif; ?>
                                        <?php if (!empty($firstfloor['opt-floorplans-interior-size']) && !empty($firstfloor['opt-floorplans-price-from'])) : ?>
                                            <li class="property-type ic-proptype"
                                                title="Property Price/Sqft: <?= '$' . round(number_format($firstfloor['opt-floorplans-price-from'], 2, '.', '') / number_format($firstfloor['opt-floorplans-interior-size'], 2, '.', '')) ?>">
                                                <i class="fas fa-comments-dollar"></i><br>
                                                <b><?= '$' . round(number_format($firstfloor['opt-floorplans-price-from'], 2, '.', '') / number_format($firstfloor['opt-floorplans-interior-size'], 2, '.', '')) ?></b>/Sqft.
                                            </li>
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
                                            <li class="property-type ic-proptype"
                                                title="Neighbourhood Price/Sqft Average: <?php echo '$' . number_format($avgn, 0); ?>">
                                                <i class="fas fa-map"></i><br><?php echo number_format($avgn, 0); ?>
                                                /Sqft Nbhd Avg
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            <?php endif; ?>

                        </div>

                    </div>


                    <style>
                        table#example td:nth-child(6){text-align:right !important; padding-right:40px;}
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

                        .characteristics-cnt ul {
                            margin-top: 20px;
                            display: grid;
                            gap: 10px;
                            grid-template-columns: repeat(auto-fill, minmax(135px, 1fr));
                            grid-template-rows: masonry;
                        }

                        .characteristics-cnt li {
                            margin-bottom: 10px;
                            margin-right: 8px;
                        }

                        @media screen and (max-width: 1300px) {
                            .project-logo-top {
                                max-width: 200px;
                                max-height: 200px;
                                margin: 0px auto !important;
                                margin-bottom: 20px !important;
                                margin-top: 20px !important;
                            }

                            .excerpt-top {
                                text-align: center;
                            }
                        }

                        @media screen and (max-width: 538px) {
                            .mb-center {
                                -ms-flex-pack: center !important;
                                justify-content: center !important;
                                text-align: center !important;
                                justify-items: center !important;
                                align-items: unset !important;
                            }
                        }

                        @media screen and (max-width: 1300px) {
                            .hide-on-sm {
                                display: none !important;
                            }

                            .show-on-sm {
                                display: block !important;
                            }
                        }
                    </style>

                    <div>
                        <div>
                            <?php
                            $project_incentives = get_post_meta(get_the_ID(), 'hlr_framework_properties-incentives', true);
                            if (!empty($project_incentives['opt_properties_incentives_items'])) {
                                $incentives = $project_incentives['opt_properties_incentives_items'];
                            } else {
                                $incentives = [];
                            }
                            ?>
                            <ul class="custom-incentive-list mb-4">
                                <?php foreach ($incentives as $incentive): ?>
                                    <li class="custom-incentive-item d-flex align-items-center mb-2 text-center">
                                        <i class="text-dark <?php echo htmlspecialchars($incentive['opt-icon-incentives']); ?> me-2 custom-icon"></i>
                                        <span class="custom-text"><?php echo $incentive['opt-link-incentives']; ?></span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>

                    <style>
                        /* Custom styling for the list container */
                        .custom-incentive-list {
                            display: flex;
                            flex-wrap: wrap;
                            justify-content: center;
                            gap: 20px;
                            padding: 0;
                            margin-top: 1.5rem;
                        }

                        /* Custom styling for each incentive item */
                        .custom-incentive-item {
                            color: #ff6600;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                        }

                        /* Custom styling for the icon */
                        .custom-icon {
                            font-size: 1.6rem;
                            min-width: 32px;
                            margin-right:20px;
                            text-align: center;
                        }

                        /* Custom styling for the text */
                        .custom-text {
                            font-size: 1.2rem;
                        }

                        /* For tablets: reduce icon and text size */
                        @media (max-width: 1200px) {
                            .custom-incentive-item .custom-icon {
                                font-size: 1.5rem; /* Smaller icon on tablets */
                                margin-right:10px;
                            }

                            .custom-incentive-item .custom-text {
                                font-size: 1rem; /* Smaller text on tablets */
                            }
                        }

                        /* For mobile: further reduce icon and text size */
                        @media (max-width: 575px) {
                            .custom-incentive-item .custom-icon {
                                font-size: 0.9rem; /* Even smaller icon on mobile */
                                margin-right:0px;
                            }

                            .custom-incentive-item .custom-text {
                                font-size: 0.8rem; /* Even smaller text on mobile */
                            }
                        }
                    </style>


                    <div class="row mb-2 justify-content-start px-0 px-md-3 ">
                        <div class=" col-12 col-sm-6 d-flex p-1 align-items-end justify-content-start mb-center">
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
                        <?php if (!empty($data['opt-price-min']) || !empty($data['opt-cominsoon-price'])) : ?>
                            <div class="mb-center col-12 col-sm-6 d-flex flex-column justify-content-center align-items-end">
                                <div class="start-price mb-3">
                                    <?php if (($data['opt-sales-type'] == "Assignment") || ($data['opt-sales-type'] == "Resale")) : ?>
                                        Asking Price
                                    <?php else : ?>
                                        Starting from
                                    <?php endif; ?><span>
                                                <?php if (!empty($data['opt-cominsoon-price'])) : ?>
                                                    <?= $data['opt-cominsoon-price'] ?>
                                                <?php else : ?>
                                                    $<?= number_format($data['opt-price-min']) ?>
                                                <?php endif; ?>
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
        <div class="col-12 col-md-12 justify-content-center align-items-center p-0" id="Gallery">
            <?php if (isset($psd['galleries'][0]['gallery_url'])) : ?>
                <?php if ($psd['galleries'][0]['gallery_url']) : ?>
                    <div class="vrmedia-gallery">
                        <ul class="ecommerce-gallery">
                            <?php foreach ($psd['galleries'] as $gallery_item) : ?>
                                <li class="rounded" data-fancybox="gallery"
                                    data-caption="<?= $gallery_item['caption'] ?>"
                                    data-src="<?= $gallery_item['gallery_url'] ?>"
                                    data-thumb="<?= $gallery_item['gallery_url'] ?>"
                                    data-src="<?= $gallery_item['gallery_url'] ?>">
                                    <img class="rounded" loading="lazy" src="<?= $gallery_item['gallery_url'] ?>"
                                         alt="<?= $gallery_item['caption'] ?>">

                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php else : ?>
                    <div class="d-flex flex-wrap justify-content-between" style="gap:10px;">
                        <img loading="lazy" src="<?= HLR_THEME_ASSETS . 'images/noimage.jpg' ?>" alt="">
                        <img loading="lazy" src="<?= HLR_THEME_ASSETS . 'images/noimage.jpg' ?>" alt="">
                        <img loading="lazy" src="<?= HLR_THEME_ASSETS . 'images/noimage.jpg' ?>" alt="">
                        <img loading="lazy" src="<?= HLR_THEME_ASSETS . 'images/noimage.jpg' ?>" alt="">
                    </div>
                <?php endif; ?>
            <?php else: ?>
                <div class="h-100 d-flex justify-content-center align-items-center flex-column bg-foreground">
                    <h2 class="text-2xl font-bold">Gallery</h2>
                    <p class="text-gray-500">No images available at this time.</p>
                </div>
            <?php endif; ?>
        </div>

        <div class="row mt-4 properties-image-gallery px-3  mb-4 border-top pt-4">
            <div class="col-12  rounded mb-2 mb-md-0 justify-content-center align-items-center col-md-6 d-flex">
                <!-- map details -->
                <!-- Properties map -->
                <!--location:  inc/scripts.php -->
                <div class="col-12 p-0 map-container rounded">
                    <div id="map"></div>
                </div>
            </div>
            <div class="col-12  rounded mb-2 mb-md-0 col-md-6" style="border: 1px solid #e3e3e3;">
                <script type='text/javascript'>
                    var ws_wsid = 'g61630a670a2847169cb58e9189f6caab';
                    var ws_address = '<?php echo $data['opt-coords']['address'] ?>';
                    var ws_format = 'wide';
                    var ws_width = '400';
                    var ws_height = '400';
                </script><style type='text/css'>#ws-walkscore-tile{position:relative;text-align:left}#ws-walkscore-tile *{float:none;}</style><div class="mt-1" id='ws-walkscore-tile'></div><script type='text/javascript' src='https://www.walkscore.com/tile/show-walkscore-tile.php'></script>

            </div>
        </div>
    </div>
    <!-- Content Section  -->

    <div class="container-fluid mx-auto row mt-3 px-lg-5">
        <!-- content sidebar -->
        <div class="col-12 col-sm-3 col-md-3 d-flex justify-content-center ">
            <nav class="xm-auto position-sticky top-48" id="table-of-contents">
                <div class="title toggle-list-btn">
                    Table of Contents
                    <i class="fa fa-arrow-up toggle-list arrow-toggle"></i>
                </div>
                <ol id="tag-list">
                    <?php if (!($data['opt-sales-type'] == "Assignment") && !($data['opt-sales-type'] == "Resale")) : ?>
                        <li><a href="#development-detail" class="item-list-tag" title="map">Development Detail</a></li>
                        <li><a href="<?php if (empty($psd['price_images'])) : ?>#FloorPlans<?php else : ?>#PriceList<?php endif; ?>" class="item-list-tag" title="map">Price List</a></li>
                    <?php endif; ?>
                </ol>
            </nav>
        </div>

        <style>
            .wp-caption {
                padding-top: 10px;
                padding-bottom: 10px;
                width: auto !important;
            }
        </style>
        <!-- content  -->
        <div class="col-12 col-sm-9 col-md-9  border-right border-left mb-4">
            <div class="container-fluid px-lg-5">
                <?php if (!empty($psd['content'])) : ?>
                    <div class="row mt-2 border-top  mb-4" id="Overview">
                        <div class="col-12">
                            <div class=" content-original">
                                <!--                                --><?php //= wpautop($psd['content']) ?>
                                <?= the_content(); ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <?php if (!empty($psd['videos'])) : ?>
                <div class="container-fluid px-lg-5 py-4">
                    <div class="row border-top pt-2 mt-2 mb-4">
                        <div class="col-12">
                            <div class="rvs-container">
                                <div class="rvs-item-container">
                                    <div class="rvs-item-stage">
                                        <?php foreach ($psd['videos'] as $video) : ?>
                                            <div class="rvs-item"
                                                 style="background-image: url('<?= $video['opt-video-thumbnail']['url'] ?>')">
                                                <p class="rvs-item-text"><?= $video['opt-video-title'] ?> <small>by Home
                                                        Leader Realty</small></p>
                                                <a href="<?= $video['opt-video-url'] ?>" class="rvs-play-video"></a>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <div class="rvs-nav-container">
                                    <a class="rvs-nav-prev"></a>
                                    <div class="rvs-nav-stage">
                                        <?php foreach ($psd['videos'] as $video) : ?>
                                            <a class="rvs-nav-item">
                                                <span class="rvs-nav-item-thumb"
                                                      style="background-image: url('<?= $video['opt-video-thumbnail']['url'] ?>')"></span>
                                                <h4 class="rvs-nav-item-title"><?= $video['opt-video-title'] ?></h4>
                                                <small class="rvs-nav-item-credits">by Home Leader Realty</small>
                                            </a>
                                        <?php endforeach; ?>
                                    </div>
                                    <a class="rvs-nav-next"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="container-fluid px-lg-5 mb-4" id="development-detail">
                <!-- Development Detail -->
                <div class="row border-top pt-4 mt-5 mb-4">
                    <div class="col-12">
                        <div class="titr-list ml-0">
                            <h3 class="font-weight-bold">Development Details</h3>
                        </div>
                    </div>
                    <?php if (!empty($data['opt-floors'])) : ?>
                        <div class="col-6 col-sm-6 col-md-4 col-lg-3 mb-4">
                            <div class="card-developments">
                                <div class="card-developments-title">
                                    Number of Storeys
                                </div>
                                <div class="card-developments-content">
                                    <?php echo $data['opt-floors'] ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($data['opt-suites'])) : ?>
                        <div class="col-6 col-sm-6 col-md-4 col-lg-3 mb-4">
                            <div class="card-developments">
                                <div class="card-developments-title">
                                    Total Number of Suites
                                </div>
                                <div class="card-developments-content">
                                    <?php echo $data['opt-suites'] ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="col-6 col-sm-6 col-md-4 col-lg-3 mb-4">
                        <div class="card-developments">
                            <div class="card-developments-title">
                                Est. Building Size
                            </div>
                            <div class="card-developments-content">
                                <?php echo !empty($data['opt-size-min']) ? $data['opt-size-min'] . (!empty($data['opt-size-max']) ? " - " . $data['opt-size-max'] : "") . " Sq.ft." : "TBA"; ?>
                            </div>
                        </div>
                    </div>
                    <?php if (!empty($data['opt-architect'])) : ?>
                        <div class="col-6 col-sm-6 col-md-4 col-lg-3 mb-4">
                            <div class="card-developments">
                                <div class="card-developments-title">
                                    Architects
                                </div>
                                <div class="card-developments-content">
                                    <?php echo $data['opt-architect'] ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($data['opt-interior-designer'])) : ?>
                        <div class="col-6 col-sm-6 col-md-4 col-lg-3 mb-4">
                            <div class="card-developments">
                                <div class="card-developments-title">
                                    Architects
                                </div>
                                <div class="card-developments-content">
                                    <?php echo $data['opt-interior-designer'] ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($data['opt-occupancy']) || !empty($data['opt-occupancy-time-period'])) : ?>
                        <div class="col-6 col-sm-6 col-md-4 col-lg-3 mb-4">
                            <div class="card-developments">
                                <div class="card-developments-title">
                                    Est. Occupancy
                                </div>
                                <div class="card-developments-content">
                                    <?php $occupancyOp = (!empty($data['opt-occupancy-time-period'])) ? $data['opt-occupancy-time-period'] . ' ' : '';
                                    echo $occupancyOp . $data['opt-occupancy']; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($data['opt-sales-type']) || !empty($data['opt-type'])) : ?>
                        <div class="col-6 col-sm-6 col-md-4 col-lg-3 mb-4">
                            <div class="card-developments">
                                <div class="card-developments-title">
                                    Building Type
                                </div>
                                <div class="card-developments-content">
                                    <?php echo $data['opt-sales-type'] . ' ' . implode(', ', $data['opt-type']); ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($psd['developments'])) : ?>
                        <?php foreach ($psd['developments'] as $development) : ?>
                            <div class="col-6 col-sm-6 col-md-4 col-lg-3 mb-4">
                                <div class="card-developments">
                                    <div class="card-developments-title">
                                        <?= $development['opt-development-details-title'] ?>
                                    </div>
                                    <div class="card-developments-content">
                                        <?= $development['opt-development-details-content'] ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <div class="col-6 col-sm-6 col-md-4 col-lg-3 mb-4">
                        <div class="card-developments">
                            <div class="card-developments-title">
                                <?php
                                // Get the developer taxonomy terms for the current post
                                $developer_terms = get_the_terms(get_the_ID(), 'developer');

                                // Check if any terms were found
                                if ($developer_terms && !is_wp_error($developer_terms)) {
                                    if (count($developer_terms) > 1) {
                                        echo 'Developers';
                                    } else {
                                        echo 'Developer';
                                    }
                                } else {
                                    echo 'No Developer Found';
                                }
                                ?>
                            </div>
                            <div class="card-developments-content">
                                <?php
                                if ($developer_terms && !is_wp_error($developer_terms)) {
                                    $developers = [];
                                    foreach ($developer_terms as $developer_term) {
                                        // Collect the term names
                                        $developers[] = $developer_term->name;
                                    }
                                    // Output the list of developers
                                    echo implode(', ', $developers);
                                } else {
                                    echo 'No Developers Listed';
                                }
                                ?>
                            </div>
                        </div>

                    </div>
                </div>
                <?php if (!empty($psd['price_images'])) : ?>
                    <div class="row mt-5 border-top  mb-4" id="PriceList">
                        <div class="col-12">
                            <div class="titr-list ml-0">
                                <h3 class="font-weight-bold">Price List</h3>
                            </div>
                        </div>
                        <?php foreach ($psd['price_images'] as $image) : ?>
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 mb-4">
                                <div class="image-price">
                                    <img loading="lazy" src="<?= $image['opt-price-list-image']['url'] ?>"
                                         alt="<?= $image['opt-price-list-image']['alt'] ?>">
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>


                <!-- scrapped floorplan-->


                <div class="row mt-5 border-top  pt-4 mb-4">
                    <div class="col-12">

                        <?php

                        if ($data['opt-floorplans_from_old_website'] == true && !empty($data['opt-old_website_link'])) {
                            $url = $data['opt-old_website_link'];
                        } else {
                            $url = '';
                        }
                        try {
                            if ($url === '') {
                                throw new Exception('no locatecondo link');
                            }
                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, $url);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)');
                            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                            $html = curl_exec($ch);
                            curl_close($ch);
                            if ($html === false) {
                                throw new Exception('Failed to retrieve the content of the URL.');
                            }

                            libxml_use_internal_errors(true);
                            $dom = new DOMDocument();
                            $dom->loadHTML($html);
                            libxml_clear_errors();

                            $xpath = new DOMXPath($dom);
                            $query = '//div[contains(@class, "flex_cell_inner")][.//h3[@class="av-special-heading-tag " and contains(text(), "Floor Plans")]]';
                            $nodes = $xpath->query($query);

                            $floorplans = [];
                            $titles = [];
                            foreach ($nodes as $node) {
                                $floorplans[] = $dom->saveHTML($node);

                                // Extract the content of the <h3> tag
                                $h3 = $xpath->query('.//h3[@class="av-special-heading-tag "]', $node);
                                if ($h3->length > 0) {
                                    $titles[] = trim($h3->item(0)->textContent);
                                } else {
                                    $titles[] = 'Gallery'; // Default title if no <h3> is found
                                }
                            }
                            $scraped_html = implode("\n\n", $floorplans);

                        } catch (Exception $e) {
                            $scraped_html = '';
                            $titles = []; // Ensure titles are empty in case of failure
                        }

                        $dom = new DOMDocument();
                        libxml_use_internal_errors(true); // Suppress warnings for malformed HTML
                        $dom->loadHTML($scraped_html);
                        libxml_clear_errors();

                        // Find all <div> with class "flex_cell_inner"
                        $xpath = new DOMXPath($dom);
                        $flex_cells = $xpath->query("//div[contains(@class, 'flex_cell_inner')]");

                        $galleries = [];
                        foreach ($flex_cells as $index => $flex_cell) {
                            $anchors = (new DOMXPath($dom))->query(".//a[contains(@href, 'http')]", $flex_cell);
                            $gallery_items = [];
                            foreach ($anchors as $anchor) {
                                $image_url = $anchor->getAttribute('href');
                                $thumbnail_url = $anchor->getAttribute('data-prev-img');
                                $title = $anchor->getElementsByTagName('img')->item(0)->getAttribute('title');
                                $gallery_items[] = [
                                    'image' => $image_url,
                                    'thumbnail' => $thumbnail_url,
                                    'caption' => $title,
                                ];
                            }
                            $galleries[] = $gallery_items;
                        }
                        ?>
                        <div class="row">
                            <div class="col-12 justify-content-center align-items-center">
                                <script>
                                    jQuery(document).ready(function ($) {
                                        <?php foreach ($galleries as $index => $gallery): ?>
                                        $(".ecommerce-gallery-<?php echo $index; ?>").lightSlider({
                                            lazyLoad: true,
                                            gallery: true,
                                            item: 1,
                                            loop: false,
                                            thumbItem: <?php echo count($gallery); ?>,
                                            thumbMargin: 10,
                                        });
                                        <?php endforeach; ?>
                                        lightbox.option({
                                            'resizeDuration': 200,
                                            'wrapAround': true,
                                            'maxHeight': 500
                                        });
                                    });
                                </script>
                                <?php foreach ($galleries as $index => $gallery_items): ?>
                                    <div class=""
                                         id="Gallery-<?php echo $index; ?>">
                                        <div class="titr-list ml-0">
                                            <h3 class="font-weight-bold"><?php echo htmlspecialchars($titles[$index] ?? 'Gallery ' . ($index + 1)); ?></h3>
                                        </div>
                                        <div class="vrmedia-gallery">
                                            <ul class="ecommerce-gallery-<?php echo $index; ?>">
                                                <?php foreach ($gallery_items as $item): ?>
                                                    <li class="rounded" data-fancybox="gallery-<?php echo $index; ?>"
                                                        data-caption="<?= esc_attr($item['caption']) ?>"
                                                        data-src="<?= esc_url($item['image']) ?>"
                                                        data-thumb="<?= esc_url($item['thumbnail']) ?>">
                                                        <img class="rounded" loading="lazy"
                                                             src="<?= esc_url($item['thumbnail']) ?>"
                                                             alt="<?= esc_attr($item['caption']) ?>">
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                    </div>
                </div>


                <!-- scrapped floorplan-->


                <?php if (!empty($floorplans_ids[0])) : ?>
                    <div class="row mt-5 border-top my-4">
                        <div class="col-12">
                            <div class="titr-list ml-0">
                                <h3 class="font-weight-bold">Floor Plans</h3>
                            </div>
                        </div>
                        <div class="container-fluid">
                            <div class="row px-4">
                                <?php foreach ($floorplans_ids as $floorplans_item_id) : ?>
                                    <div class="col-3 col-sm-2 col-md-2 col-lg-1 px-2 mb-4">
                                        <div class="card-floolplan">
                                            <a href="<?= wp_get_attachment_url($floorplans_item_id) ?>"
                                               title="<?= wp_get_attachment_caption($floorplans_item_id) ?>"
                                               data-lightbox="roadtrip">
                                                <img loading="lazy" class="img-floorplan"
                                                     src="<?= wp_get_attachment_url($floorplans_item_id) ?>"
                                                     alt="<?= wp_get_attachment_caption($floorplans_item_id) ?>">
                                            </a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="top-48"
                     style="background: #f7f7f7;padding: 10px;border-radius: 10px;margin-bottom: 20px;font-size: 12px;width: 100%;height: fit-content;">
                    <!--                                        --><?php
                    //                                        function getWalkScore($url) {
                    //                                            // Fetch the webpage content
                    //                                            $htmlContent = file_get_contents($url);
                    //                                            if ($htmlContent === FALSE) {
                    //                                                return "Failed to fetch content.";
                    //                                            } else{
                    //                                                return $htmlContent;
                    //                                            }
                    //                                        }
                    //                                        $address = stripslashes("300 Richmond St W #300, Toronto, ON M5V 1X2");
                    //                                        $address = str_replace(" ", "-", $address);
                    //                                        $url = "https://www.walkscore.com/badge/html/$address-?fixed=true&badges=available";
                    //                                        $value = getWalkScore($url);
                    //                                        echo $value;
                    //                                        ?>
                </div>
                <?php if ($associated_floorplans->have_posts()) : ?>
                    <div class="container-fluid border-top pt-3 px-0 mt-lg-5 mt-2" id="FloorPlans">
                        <div class="content">
                            <div class="row mb-lg-4 mb-2">
                                <div class="col-12 mb-4">
                                    <h4 class="font-weight-bold h3">Browse more <?= $psd['title'] ?> Floor Plans</h4>
                                </div>
                                <div class="col-12 d-flex flex-column flex-md-row justify-content-between align-items-center">
                                    <div class="btn-group submitter-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text btn-status-floorplan">Status</div>
                                        </div>
                                        <select class="form-control status-dropdown">
                                            <option value="">All</option>
                                            <option value="Sold Out">Sold Out</option>
                                            <option value="Available">Available</option>
                                        </select>
                                    </div>
                                    <div class="btn-group submitter-group mt-2 mt-md-0">
                                        <a style="padding: 5px 10px; border: 0px; background: #f1642c; color: white; border-radius: 4px;" href="#register">
                                            Register Now to get full package
                                        </a>
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
                            <div class="table-responsive">
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
                                    $row_index = 0; // Initialize a counter for rows

                                    while ($associated_floorplans->have_posts()) :
                                        $associated_floorplans->the_post();
                                        $floor = get_post_meta(get_the_ID(), 'hlr_framework_floorplans', true);
                                        $row_index++; // Increment the row index
                                        ?>
                                        <tr <?php echo ($row_index >= 4) ? 'class="' . $loginClasses . '"' : ''; ?>>
                                            <td>
                                                <div class="d-none"><?= $floor['opt-floorplans-status'] == 'available' ? 'Available' : 'Sold Out' ?></div>
                                                <div class="wrap-head-floorplan">
                                                    <span class="status-floorplan <?= $floor['opt-floorplans-status'] == 'available' ? 'status-color-success' : 'status-color-danger' ?>"></span>
                                                    <?php the_post_thumbnail('thumbnail', ['loading' => 'lazy']) ?>
                                                </div>
                                            </td>
                                            <td><?= $floor['opt-floorplans-suite-name'] ?></td>
                                            <td>
                                                <?php if (!empty($floor['opt-studio']) and ($floor['opt-studio'] == 1)) : ?>
                                                    Studio
                                                <?php endif; ?>
                                                <?php if (!empty($floor['opt-floorplans-beds']) && !empty($floor['opt-floorplans-baths'])) : ?>
                                                    <?= $floor['opt-floorplans-beds'] . ' Bed' ?> , <?= $floor['opt-floorplans-baths'] . ' Bath' ?>
                                                <?php else : ?>
                                                    <?php if (!empty($floor['opt-floorplans-baths'])) : ?>
                                                        <?= ', ' . $floor['opt-floorplans-baths'] . ' Bath' ?>
                                                    <?php else : ?>
                                                        <?php if (empty($floor['opt-studio'])) : ?>
                                                            -
                                                        <?php endif; ?>
                                                    <?php endif; ?>
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
                                                    <div class="font-weight-bold">
                                                        <?php if (!empty($floor['opt-floorplans-price-to'])) : ?>
                                                            <span style="font-size: x-small;">from </span>
                                                        <?php endif; ?>
                                                        <?= '$' . number_format($floor['opt-floorplans-price-from']) ?>
                                                    </div>
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
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

        </div>

        <!-- sidebar -->
        <div class="col-12 col-sm-12 col-md-12 ">

            <div class="hlri-container">
                <!--                <img src="img/shape.png" class="hlri-square" alt="" />-->
                <div id="register" class="hlri-formsection">
                    <div class="hlri-contact-info">
                        <h3 class="title">Register Now</h3>

                        <div class="hlri-info">
                            <div class="hlri-information">
                                <i class="fas fa-map-marker-alt"></i> &nbsp &nbsp

                                <p>300 Richmond St W #300, Toronto, ON M5V 1X2</p>
                            </div>
                            <div class="hlri-information">
                                <i class="fas fa-envelope"></i> &nbsp &nbsp
                                <p>inquiries@Condoy.com</p>
                            </div>
                            <div class="hlri-information">
                                <i class="fas fa-phone"></i>&nbsp&nbsp
                                <p>(416) 599-9599</p>
                            </div>
                            <p style="font-size: 13px;line-height: 20px;">
                                We are independent realtors® with Home leader Realty Inc. Brokerage in Toronto.
                                Our team specializes in pre-construction sales and through our developer relationships
                                have access to PLATINUM SALES &amp; TRUE UNIT ALLOCATION in advance of the general
                                REALTOR® and the general public.
                                We do not represent the builder directly.</p>
                            <br>
                            <img loading="lazy" src="https://condoy.com/wp-content/uploads/2023/07/CondoY_logo.png"
                                 style="opacity: 0.1;width: 95%;margin-top: 20px;">
                        </div>
                    </div>

                    <div class="hlri-contact-form">
                        <span class="hlri-circle one"></span>
                        <span class="hlri-circle two"></span>

                        <!--                        <form action="index.html" autocomplete="off">-->
                        <!--                            <h3 class="hlri-title">Register for -->
                        <?php //= $psd['title'] ?><!--</h3>-->
                        <!--                            -->
                        <!--                            --><?php //= do_shortcode($psd['theme_options']['opt-properties-shortcode']) ?>
                        <!---->
                        <!--                        </form>-->
                        <style>
                            #assignment_form {
                                padding-top: 10px;
                            }

                            .wpcf7-form {
                                padding-top: 0px;
                            }
                        </style>
                        <h3 class="hlri-title" style="padding:2.3rem 2.2rem 0 2.2rem">Register for <?= $psd['title'] ?>
                            <span style="font-size: 13px;">(to get full package)</span></h3>
                        <?= do_shortcode('[contact-form-7 id="88b86af" title="Preconstruction contact form"]') ?>
                    </div>
                </div>
            </div>
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
        </div>


    </div>

    <!-- End Content Section -->
<?php
$peroperties_single = properties_related_cached();
if ($peroperties_single) :
    if ($peroperties_single->have_posts()) :
        ?>
        <div class="container-fluid my-4" id="rp">
            <div class="row">
                <div class="col-12 px-lg-5">
                    <div class="titr-list ml-0">
                        <h3 class="font-weight-bold">Related Properties</h3>
                    </div>
                </div>
                <div class="col-12">
                    <div class="d-flex justify-content-center">
                        <div class="owl-carousel owl-theme listing-wrap wrap-list">
                            <?php while ($peroperties_single->have_posts()) : $peroperties_single->the_post();
                                $mdata = get_post_meta(get_the_ID(), 'hlr_framework_mapdata', true);
                                ?>
                                <div class="card-listing card-listing-v2">

                                    <div class="card-listing-image card-listing-image-v2">
                                        <a href="<?= get_the_permalink() ?>"
                                           title="<?= strlen(get_the_title()) > 12 ? substr(get_the_title(), 0, 12) . '...' : get_the_title() ?>">
                                            <?php the_post_thumbnail('normal', ['loading' => 'lazy']) ?>
                                        </a>
                                    </div>

                                    <div class="card-body-listing card-body-listing-v2">

                                        <div class="card-listing-content card-listing-content-v2">
                                            <a href="<?= get_the_permalink() ?>"
                                               title="<?= strlen(get_the_title()) > 12 ? substr(get_the_title(), 0, 12) . '...' : get_the_title() ?>">
                                                <h6 class="text-black"><?= strlen(get_the_title()) > 12 ? substr(get_the_title(), 0, 12) . '...' : get_the_title() ?></h6>
                                            </a>
                                            <div class="card-listing-description card-listing-description-v2">
                                                <a href="<?= get_the_permalink() ?>"
                                                   title="<?= strlen(get_the_title()) > 12 ? substr(get_the_title(), 0, 12) . '...' : get_the_title() ?>">
                                                    <!--                                                    --><?php //= strlen(strip_tags($psd['excerpt'])) > 65 ? substr(strip_tags($psd['excerpt']), 0, 65) . '...' : substr(strip_tags($psd['excerpt']), 0, 65) ?>
                                                </a>
                                            </div>
                                        </div>


                                        <!--                                         <div class="card-listing-content card-listing-content-v2">
                                        <h6 class="text-black"><?php /*= strlen(get_the_title()) > 12 ? substr(get_the_title(), 0, 12) . '...' : get_the_title() */ ?></h6>
                                        <div class="card-listing-description card-listing-description-v2">
                                            <?php /*= strlen(strip_tags($psd['excerpt'])) > 65 ? substr(strip_tags($psd['excerpt']), 0, 65) . '...' : strip_tags($psd['content']) */ ?>
                                        </div>
                                    </div>-->

                                        <div class="lable-listing lable-listing-v2">
                                            <?php if (!empty($mdata['opt-min-price'])) : ?>
                                                <div><?= "$" . $mdata['opt-min-price'] . " to " . "$" . $mdata['opt-max-price'] ?></div>
                                            <?php endif; ?>
                                            <?php if (!empty($mdata['opt-size-min'])) : ?>
                                                <div><?= $mdata['opt-size-min'] . " - " . $mdata['opt-size-max'] . " Sq Ft | " . $mdata['opt-occupancy'] ?></div>
                                            <?php endif; ?>
                                            <?php if (!empty($mdata['opt-address'])) : ?>
                                                <div><?= $mdata['opt-address'] ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>


                                    <div class="more more-v2">
                                        <div class="card-listing-options">
                                            <div>
                                                <i onclick="setLikeProperties(this, <?= get_the_ID() ?>)" role="button"
                                                   class="fa fa-heart" <?= isset($_COOKIE[get_the_ID()]) ? ' style="color:red" ' : '' ?>></i>
                                                <span class="text-muted" id="like-total">
                                                    <?php if (!empty(get_post_meta(get_the_ID(), 'total_like', true))) : ?>
                                                        <?= get_post_meta(get_the_ID(), 'total_like', true) ?>
                                                    <?php endif; ?>
                                                </span>
                                            </div>

                                            <i role="button" class="fa fa-share-alt"></i>
                                            <i <?= is_user_logged_in() ? in_array(get_the_ID(), get_user_meta(get_current_user_id(), 'properties_favorites', true)) ? ' style="color:#9de450" ' : '' : '' ?>
                                                    role="button" onclick="bookmark(this,<?= get_the_ID() ?>)"
                                                    class="fa fa-bookmark"></i>
                                        </div>
                                        <a href="<?= get_the_permalink() ?>" title="<?= $psd['title'] ?>"
                                           class="">more</a>
                                    </div>

                                    <div class="card-share">
                                        <a target="_blank"
                                           href="https://www.facebook.com/sharer.php?u=<?= wp_get_shortlink(get_the_ID(), 'post', true) ?>"><i
                                                    class="fa fa-facebook-square"></i></a>
                                        <a target="_blank"
                                           href="https://reddit.com/submit?url=<?= wp_get_shortlink(get_the_ID(), 'post', true) ?>&title=<?= $psd['title'] ?>"><i
                                                    class="fa fa-reddit"></i></a>
                                        <a target="_blank"
                                           href="https://www.linkedin.com/shareArticle?mini=true&url=<?= wp_get_shortlink(get_the_ID(), 'post', true) ?>?ref=linkedin&title=<?= $psd['title'] ?>&summary=<?php $psd['content'] ?>"><i
                                                    class="fa fa-linkedin-square"></i></a>
                                        <a target="_blank"
                                           href="https://wa.me/?text=<?= wp_get_shortlink(get_the_ID(), 'post', true) ?>"><i
                                                    class="fa fa-whatsapp"></i></a>
                                        <a target="_blank"
                                           href="https://telegram.me/share/url?url=<?= wp_get_shortlink(get_the_ID(), 'post', true) ?>?ref=telegram"><i
                                                    class="fa fa-telegram"></i></a>
                                        <a target="_blank"
                                           href="https://www.pinterest.com/pin/create/button?url=<?= wp_get_shortlink(get_the_ID(), 'post', true) ?>&media=<?= $psd['thumbnail_url'] ?>&description=<?= $psd['title'] ?>"><i
                                                    class="fa fa-pinterest"></i></a>
                                        <a target="_blank"
                                           href="https://twitter.com/intent/tweet?url=<?= wp_get_shortlink(get_the_ID(), 'post', true) ?>"><i
                                                    class="fa fa-twitter-square"></i></a>
                                        <span class="share-close"><i role="button" class="fa fa-arrow-up"></i></span>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                            <?php wp_reset_postdata(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>


<?php
$args = array(
    'post_type' => ['properties'],
    'post_status' => ['publish'],
    'posts_per_page' => 6,
    'tax_query' => [
        [
            'taxonomy' => 'group',
            'field' => 'term_id',
            'terms' => 6,
        ]
    ]
);
$peroperties_month = new WP_Query($args);

if ($peroperties_month->have_posts()) :
    ?>
    <div class="container-fluid my-4" id="hp">
        <div class="row">
            <div class="col-12 px-lg-5">
                <div class="titr-list ml-0">
                    <h3 class="font-weight-bold">This Month Hot New Projects</h3>
                </div>
            </div>
            <div class="col-12">
                <div class="d-flex justify-content-center">
                    <div class="owl-carousel owl-theme listing-wrap wrap-list">
                        <?php while ($peroperties_month->have_posts()) : $peroperties_month->the_post();
                            $mdata = get_post_meta(get_the_ID(), 'hlr_framework_mapdata', true);
                            ?>
                            <div class="card-listing card-listing-v2">

                                <div class="card-listing-image card-listing-image-v2">
                                    <a href="<?= get_the_permalink() ?>"
                                       title="<?= strlen(get_the_title()) > 12 ? substr(get_the_title(), 0, 12) . '...' : get_the_title() ?>">
                                        <?php the_post_thumbnail('normal', ['loading' => 'lazy']) ?>
                                    </a>
                                </div>


                                <div class="card-body-listing card-body-listing-v2">


                                    <div class="card-listing-content card-listing-content-v2">
                                        <a href="<?= get_the_permalink() ?>"
                                           title="<?= strlen(get_the_title()) > 12 ? substr(get_the_title(), 0, 12) . '...' : get_the_title() ?>">
                                            <h6 class="text-black"><?= strlen(get_the_title()) > 12 ? substr(get_the_title(), 0, 12) . '...' : get_the_title() ?></h6>
                                        </a>
                                        <div class="card-listing-description card-listing-description-v2">
                                            <a href="<?= get_the_permalink() ?>"
                                               title="<?= strlen(strip_tags(get_the_excerpt())) > 65 ? substr(strip_tags(get_the_excerpt()), 0, 65) . '...' : strip_tags(get_the_content()) ?>">
                                                <?= strlen(strip_tags(get_the_excerpt())) > 65 ? substr(strip_tags(get_the_excerpt()), 0, 65) . '...' : strip_tags(get_the_content()) ?>
                                            </a>
                                        </div>
                                    </div>

                                    <!-- <div class="card-listing-content card-listing-content-v2">
                                        <h6 class="text-black"><?= strlen(get_the_title()) > 12 ? substr(get_the_title(), 0, 12) . '...' : get_the_title() ?></h6>
                                        <div class="card-listing-description card-listing-description-v2">
                                            <?= strlen(strip_tags(get_the_excerpt())) > 65 ? substr(strip_tags(get_the_excerpt()), 0, 65) . '...' : strip_tags(get_the_content()) ?>
                                        </div>
                                    </div> -->

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


                                <div class="more more-v2">
                                    <div class="card-listing-options">
                                        <div>
                                            <i onclick="setLikeProperties(this, <?= get_the_ID() ?>)" role="button"
                                               class="fa fa-heart" <?= isset($_COOKIE[get_the_ID()]) ? ' style="color:red" ' : '' ?>></i>
                                            <span class="text-muted" id="like-total">
                                                <?php if (!empty(get_post_meta(get_the_ID(), 'total_like', true))) : ?>
                                                    <?= get_post_meta(get_the_ID(), 'total_like', true) ?>
                                                <?php endif; ?>
                                            </span>
                                        </div>

                                        <i role="button" class="fa fa-share-alt"></i>
                                        <?php
                                        $favs = [];
                                        if (!empty(get_user_meta(get_current_user_id(), 'properties_favorites', true))) {
                                            $favs = get_user_meta(get_current_user_id(), 'properties_favorites', true);
                                        }
                                        ?>
                                        <i <?= is_user_logged_in() ? in_array(get_the_ID(), $favs) ? ' style="color:#9de450" ' : '' : '' ?>
                                                role="button" onclick="bookmark(this,<?= get_the_ID() ?>)"
                                                class="fa fa-bookmark"></i>
                                    </div>
                                    <a href="<?= get_the_permalink() ?>" title="<?= get_the_title() ?>"
                                       class="">more</a>

                                </div>

                                <div class="card-share">
                                    <a target="_blank"
                                       href="https://www.facebook.com/sharer.php?u=<?= wp_get_shortlink(get_the_ID(), 'post', true) ?>"><i
                                                class="fa fa-facebook-square"></i></a>
                                    <a target="_blank"
                                       href="https://reddit.com/submit?url=<?= wp_get_shortlink(get_the_ID(), 'post', true) ?>&title=<?= get_the_title() ?>"><i
                                                class="fa fa-reddit"></i></a>
                                    <a target="_blank"
                                       href="https://www.linkedin.com/shareArticle?mini=true&url=<?= wp_get_shortlink(get_the_ID(), 'post', true) ?>?ref=linkedin&title=<?= get_the_title() ?>&summary=<?= get_the_excerpt() ?>"><i
                                                class="fa fa-linkedin-square"></i></a>
                                    <a target="_blank"
                                       href="https://wa.me/?text=<?= wp_get_shortlink(get_the_ID(), 'post', true) ?>"><i
                                                class="fa fa-whatsapp"></i></a>
                                    <a target="_blank"
                                       href="https://telegram.me/share/url?url=<?= wp_get_shortlink(get_the_ID(), 'post', true) ?>?ref=telegram"><i
                                                class="fa fa-telegram"></i></a>
                                    <a target="_blank"
                                       href="https://www.pinterest.com/pin/create/button?url=<?= wp_get_shortlink(get_the_ID(), 'post', true) ?>&media=<?= get_the_post_thumbnail_url() ?>&description=<?= get_the_title() ?>"><i
                                                class="fa fa-pinterest"></i></a>
                                    <a target="_blank"
                                       href="https://twitter.com/intent/tweet?url=<?= wp_get_shortlink(get_the_ID(), 'post', true) ?>"><i
                                                class="fa fa-twitter-square"></i></a>
                                    <span class="share-close"><i role="button" class="fa fa-arrow-up"></i></span>
                                </div>
                            </div>
                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>


<?php get_footer(); ?>