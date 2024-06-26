<?php get_header(); ?>
<?php
$psd = properties_single_cached();
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
                        <?php if (!empty($psd['properties_logo']['url'])) : ?>
                            <img src="<?= $psd['properties_logo']['url'] ?>" loading="lazy" class="w-25 rounded mr-4"
                                 alt="<?= $psd['properties_logo']['url'] ?>">
                        <?php elseif (!empty($psd['thumbnail_url'])) : ?>
                            <img src="<?= $psd['thumbnail_url'] ?>" loading="lazy" class="w-25 rounded mr-4"
                                 alt="<?= $psd['thumbnail_caption'] ?>">
                        <?php else : ?>
                            <img src="<?= HLR_THEME_ASSETS . 'images/noimage.jpg' ?>" alt="">
                        <?php endif; ?>
                        <div class="container">
                            <h2><?= $psd['title'] ?></h2>
                            <?php if (!empty(the_excerpt())) : ?>
                                <p class="text-muted"> <?= the_excerpt() ?></p>
                            <?php endif; ?>
                            <?php // Get the developer taxonomy terms for the current post
                            $developer_terms = get_the_terms(get_the_ID(), 'developer');
                            // Check if any terms were found
                            if ($developer_terms && !is_wp_error($developer_terms)) {
                                // Loop through each term
                                foreach ($developer_terms as $developer_term) {
                                    // Output the term name
                                    echo '<p>' . $developer_term->name . '</p>';
                                }
                            }
                            ?>
                            <?php if (($data['opt-sales-type'] == "Preconstruction") || ($data['opt-sales-type'] == "Resale")) : ?>
                                <div class="characteristics-cnt">
                                    <ul>
                                        <li class="property-type ic-proptype" title="Property type: <?php echo $data['opt-sales-type'] . ' ' . implode(', ', $data['opt-type']); ?>" >
                                            <i class="fas fa-fas fa-building"></i><br>
                                            <?php echo $data['opt-sales-type'] . ' ' . implode(', ', $data['opt-type']); ?>
                                        </li>
                                        <li data-label="Beds" class="ic-beds" title="Number of Bedrooms: <?php echo $data['opt-min-bed']; ?> - <?php echo $data['opt-max-bed']; ?>">
                                            <i class="fas fa-bed"></i><br><strong><?php echo $data['opt-min-bed'] ?> - <?php echo $data['opt-max-bed'] ?></strong>
                                            <span
                                                    class="gray normal-lbl">Bedroom<?php echo (intval($data['opt-max-bed']) >= 2 ? 's' : ''); ?></span><span
                                                    class="gray short-lbl"></span>
                                        </li>
                                        <li data-label="Baths" class="ic-baths" title="Number of Bathrooms: <?php echo $data['opt-min-bath']; ?> - <?php echo $data['opt-max-bath']; ?>">
                                            <i class="fas fa-bath"></i><br><strong><?php echo $data['opt-min-bath'] ?> - <?php echo $data['opt-max-bath'] ?></strong>
                                            <span
                                                    class="gray normal-lbl">Bathroom<?php echo (intval($data['opt-max-bath']) >= 2 ? 's' : ''); ?></span><span
                                                    class="gray short-lbl"></span>
                                        </li>
                                        <li data-label="Sqft" class="ic-sqft" title="Property Size: <?php echo $data['opt-size-min']; ?> - <?php echo $data['opt-size-max']; ?> Sqft.">
                                            <i class="fas fa-vector-square"></i><br><strong><?php echo $data['opt-size-min'] ?> - <?php echo $data['opt-size-max'] ?></strong>
                                            <span
                                                    class="gray normal-lbl">Sqft</span><span
                                                    class="gray short-lbl"></span>
                                        </li>
                                        <?php if (!empty($data['opt-parking-quantity'])) : ?>
                                            <li class="property-type ic-proptype" title="Number of Parkings: <?php echo $data['opt-parking-quantity']; ?>">
                                                <i class="fas fa-parking"></i><br><?php echo $data['opt-parking-quantity'] . ' Parking' ?>
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
                                    </ul>
                                </div>
                            <?php endif; ?>

                        </div>

                    </div>

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
                        .characteristics-cnt ul {
                            margin-top: 20px;
                            display: grid;
                            gap: 10px;
                            grid-template-columns: repeat(auto-fill, minmax(127px, 1fr));
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
        </div>
    </div>
    <!-- Content Section  -->

    <div class="container-lg mx-auto row mt-3 px-lg-5">
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
                        <li><a href="#PriceList" class="item-list-tag" title="map">Price List</a></li>
                    <?php endif; ?>
                </ol>
            </nav>
        </div>

        <!-- content  -->
        <div class="col-12 col-sm-9 col-md-9  border-right border-left mb-4">
            <div class="container-fluid px-lg-5">
                <?php if (!empty($psd['content'])) : ?>
                    <div class="row mt-2 border-top  mb-4" id="Overview">
                        <div class="col-12">
                            <div class=" content-original">
                                <?= wpautop($psd['content']) ?>
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
            <div class="container-fluid px-lg-5 mb-4">
                <!-- Development Detail -->
                <?php if (!empty($psd['developments'])) : ?>
                    <div class="row border-top  mt-5 mb-4" id="development-detail">
                        <div class="col-12">
                            <div class="titr-list ml-0">
                                <h3 class="font-weight-bold">Development Details</h3>
                            </div>
                        </div>
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
                    </div>
                <?php endif; ?>

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

                <?php if (!empty($floorplans_ids[0])) : ?>
                    <div class="row border-top  my-4">
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
                    <!--                    --><?php
                    //                    function getWalkScore($lat, $lon, $address) {
                    //                        $address=urlencode($address);
                    //                        $url = "https://api.walkscore.com/score?format=json&address=$address";
                    //                        $url .= "&lat=$lat&lon=$lon&wsapikey=303447da1a4a6f6f0ea4815b2bda134f";
                    //                        $str = file_get_contents($url);
                    //                        return $str;
                    //                    }
                    //                    function getWalkScore2($address) {
                    //                        $address=urlencode($address);
                    //                        $url = "https://www.walkscore.com/professional/badges.php?address=$address#hood-widge";
                    //                        $str = file_get_contents($url);
                    //                        return $str;
                    //                    }
                    ////                    print_r(getWalkScore2("300 Richmond Street West Toronto,  CA-ON M5V 1X2"));
                    //
                    //
                    ////                    $lat = $_GET['lat'];
                    //                    $lat = 43.6490596;
                    ////                    $lon = $_GET['lon'];
                    //                    $lon = -79.391674;
                    //                    $address = stripslashes("300 Richmond St W #300, Toronto, ON M5V 1X2");
                    ////                    $address = stripslashes($_GET['address']);
                    //                    $json = getWalkScore($lat,$lon,$address);
                    ////                    echo $json;
                    //                    // Decode the JSON response
                    //                    $responseData = json_decode($json, true);
                    //
                    //                    // Display the HTML using the information from the response
                    //                    echo '<h1>Walkscore: ' . $responseData['walkscore'] . '</h1>';
                    //                    echo '<p>Description: ' . $responseData['description'] . '</p>';
                    //                    echo '<img src="' . $responseData['logo_url'] . '" alt="Walkscore Logo">';
                    //                    // Add more HTML elements using other information from the response as needed
                    //
                    //                    ?>
                </div>
                <?php if ($associated_floorplans->have_posts()) : ?>
                    <div class="container-fluid border-top pt-3 px-0 mt-lg-5 mt-2" id="FloorPlans">
                        <div class="content">
                            <div class="row mb-lg-4 mb-2">
                                <div class="col-12 mb-4">
                                    <h4 class="font-weight-bold h3">Browse more <?= $psd['title'] ?> Floor Plans</h4>
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
                                    while ($associated_floorplans->have_posts()) :
                                        $associated_floorplans->the_post();
                                        $floor = get_post_meta(get_the_ID(), 'hlr_framework_floorplans', true);
                                        ?>
                                        <tr>
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
                                                    <div class="font-weight-bold"><?= '$' . number_format($floor['opt-floorplans-price-from']) ?></div>
                                                <?php else : ?>
                                                    -
                                                <?php endif; ?>

                                                <?php if (!empty($floor['opt-floorplans-price-per'])) : ?>
                                                    <small><?= '$' . number_format($floor['opt-floorplans-price-per']) . '/sq.ft' ?></small>
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

            <?php if ($psd['theme_options']['opt-properties-status']) : ?>
                <?php if (!empty($psd['theme_options']['opt-properties-shortcode'])) : ?>
                    <div class="d-flex flex-column  properties-shortcode position-sticky top-48 bg-foreground rounded pb-3"
                         style="gap:10px;" id="RegisterNow">
                        <div class="col-12">
                            <div class="titr-list ml-0 mb-2">
                                <?php if ($psd['opt-project-status']) : ?>
                                    <h3 class="font-weight-bold">Fill the Form to get latest available Listings in This
                                        building</h3>
                                <?php else : ?>
                                    <div>
                                        <h3 class="font-weight-bold">Register Now</h3>
                                        <p>
                                            to get full package , book your unit
                                        </p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-12">
                            <style>
                                <?php echo $psd['theme_options']['opt-properties-style'] ?>
                            </style>
                            <div class="card-form">
                                <?= do_shortcode($psd['theme_options']['opt-properties-shortcode']) ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

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
                                                    <?= strlen(strip_tags($psd['excerpt'])) > 65 ? substr(strip_tags($psd['excerpt']), 0, 65) . '...' : strip_tags($psd['content']) ?>
                                                </a>
                                            </div>
                                        </div>


                                        <!-- <div class="card-listing-content card-listing-content-v2">
                                        <h6 class="text-black"><?= strlen(get_the_title()) > 12 ? substr(get_the_title(), 0, 12) . '...' : get_the_title() ?></h6>
                                        <div class="card-listing-description card-listing-description-v2">
                                            <?= strlen(strip_tags($psd['excerpt'])) > 65 ? substr(strip_tags($psd['excerpt']), 0, 65) . '...' : strip_tags($psd['content']) ?>
                                        </div>
                                    </div> -->

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
                                       href="https://www.linkedin.com/shareArticle?mini=true&url=<?= wp_get_shortlink(get_the_ID(), 'post', true) ?>?ref=linkedin&title=<?= get_the_title() ?>&summary=<?= get_the_content() ?>"><i
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