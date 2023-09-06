<?php get_header(); ?>
<?php
$psd = properties_single_cached();
$associated_floorplans = associated_floorplans_cached();
?>

<?php //include HLR_THEME_COMPONENT . 'navigation-single-property.php' 
?>
<div id="navigation-fixed-location"></div>
<div class="container-fluid px-lg-5">
    <div class="row mt-10 header-property-responsive">
        <div class="col-12 col-sm-12 col-md-3 col-lg-2 d-flex align-items-center">
            <div class="card-properties-image">
                <?php if (!empty($psd['thumbnail_url'])) : ?>
                    <img src="<?= $psd['thumbnail_url'] ?>" loading="lazy" alt="<?= $psd['thumbnail_caption'] ?>">
                <?php else : ?>
                    <img src="<?= HLR_THEME_ASSETS . 'images/noimage.jpg' ?>" alt="">
                <?php endif; ?>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-9 col-lg-10 pl-0 top-responsive">
            <div class="card-profile-details p-0 position-relative">
                <span class="update-label">Last Update : <?= isset($psd['modified_dat']) ? $psd['modified_dat'] : 'No Update' ?></span>
                <div class="d-flex align-items-center justify-content-between mb-2 card-property-responsive">
                    <h1 class="mb-2"><?= $psd['title'] ?></h1>
                    <div class="card-share-single my-0">
                        <div class="card-share-single-options">
                            <a target="_blank" href="https://www.facebook.com/sharer.php?u=<?= $psd['shortlink'] ?>"><i class="fa fa-facebook-square"></i></a>
                            <a target="_blank" href="https://reddit.com/submit?url=<?= $psd['shortlink'] ?>&title=<?= $psd['title'] ?>"><i class="fa fa-reddit"></i></a>
                            <a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=<?= $psd['shortlink'] ?>?ref=linkedin&title=<?= $psd['title'] ?>&summary=<?= $psd['excerpt'] ?>"><i class="fa fa-linkedin-square"></i></a>
                            <a target="_blank" href="https://wa.me/?text=<?= $psd['shortlink'] ?>"><i class="fa fa-whatsapp"></i></a>
                            <a target="_blank" href="https://telegram.me/share/url?url=<?= $psd['shortlink'] ?>?ref=telegram"><i class="fa fa-telegram"></i></a>
                            <a target="_blank" href="https://www.pinterest.com/pin/create/button?url=<?= $psd['shortlink'] ?>&media=<?= $psd['thumbnail_url'] ?>&description=<?= $psd['title'] ?>"><i class="fa fa-pinterest"></i></a>
                            <a target="_blank" href="https://twitter.com/intent/tweet?url=<?= $psd['shortlink'] ?>"><i class="fa fa-twitter-square"></i></a>
                        </div>
                    </div>
                </div>

                <div class="d-flex align-items-center justify-content-between mb-2 card-property-responsive">

                    <div class="rating-section">
                        <span class="rating">Rating : </span>
                        <div class="rating-stars text-center">
                            <ul id="stars">
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
                                            <li class="star selected" data-value="<?= $i + 1 ?>" title="<?= $status ?>">
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

                    <?php if (!empty($psd['opt_price_min'])) : ?>
                        <div class="start-price">Starting from $<?= number_format($psd['opt_price_min']) ?></div>
                    <?php endif; ?>

                </div>

                <?php if (!empty($psd['excerpt'])) : ?>
                    <div class="content-profile"><?= $psd['excerpt'] ?></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid px-0 mt-4">
    <?php include HLR_THEME_COMPONENT . 'navigation-single-fixed-on-scroll.php' ?>
</div>
<div class="container-fluid px-lg-5">
    <div class="row mt-4 mb-2" id="Gallery">
        <?php if (isset($psd['galleries'][0]['gallery_url'])) : ?>
            <?php if ($psd['galleries'][0]['gallery_url']) : ?>
                <div class="col-lg-6 ">
                    <!-- <ul class="pgwSlideshow"> -->
                    <div class="vrmedia-gallery">
                        <ul class="ecommerce-gallery">
                            <?php foreach ($psd['galleries'] as $gallery_item) : ?>
                                <li data-fancybox="gallery" data-src="<?= $gallery_item['gallery_url'] ?>" data-thumb="<?= $gallery_item['gallery_url'] ?>" data-src="<?= $gallery_item['gallery_url'] ?>">
                                    <img src="<?= $gallery_item['gallery_url'] ?>">
                                </li>
                                <!-- <li><img src="<?= $gallery_item['gallery_url'] ?>" alt="<?= $gallery_item['caption'] ?>" data-large-src="<?= $gallery_item['gallery_url'] ?>"></li> -->
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>
        <div class="col-lg-6">
            <?php if (count($psd['incentives_data']) > 0) : ?>
                <div class="incentives">
                    <?php foreach ($psd['incentives_data'] as $item) : ?>
                        <div class="content-info"><?php if (!empty($item['opt_icon_incentives'])) : ?><i class="<?= $item['opt_icon_incentives'] ?> icon-profile"></i><?php endif; ?><?= $item['opt_link_incentives'] ?></div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <div class="wrap-map">
                <div id="map"></div>
            </div>
        </div>
    </div>

    <?php if (!empty($psd['content'])) : ?>
        <div class="row mt-2 mb-4" id="Overview">
            <div class="col-12">
                <div class="content-profile content-original">
                    <nav id="table-of-contents">
                        <h2>Table of Contents</h2>
                        <ol id="tag-list">
                            
                        </ol>
                    </nav>
                    <?= wpautop($psd['content']) ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

</div>
<?php if (!empty($psd['videos'])) : ?>
    <div class="container-fluid px-lg-5 py-4" style="background: linear-gradient(45deg, #bf212f, #3a27bd);">
        <div class="row mt-2 mb-4">
            <div class="col-12">
                <div class="rvs-container">
                    <div class="rvs-item-container">
                        <div class="rvs-item-stage">
                            <?php foreach ($psd['videos'] as $video) : ?>
                                <div class="rvs-item" style="background-image: url('<?= $video['opt-video-thumbnail']['url'] ?>')">
                                    <p class="rvs-item-text"><?= $video['opt-video-title'] ?> <small>by Home Leader Realty</small></p>
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
                                    <span class="rvs-nav-item-thumb" style="background-image: url('<?= $video['opt-video-thumbnail']['url'] ?>')"></span>
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
    <?php if (!empty($psd['developments'])) : ?>
        <div class="row mt-5 mb-4">
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
        <div class="row mt-5 mb-4" id="PriceList">
            <div class="col-12">
                <div class="titr-list ml-0">
                    <h3 class="font-weight-bold">Price List</h3>
                </div>
            </div>
            <?php foreach ($psd['price_images'] as $image) : ?>
                <div class="col-12 col-sm-12 col-md-6 col-lg-6 mb-4">
                    <div class="image-price">
                        <img loading="lazy" src="<?= $image['opt-price-list-image']['url'] ?>" alt="<?= $image['opt-price-list-image']['alt'] ?>">
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($floorplans_ids[0])) : ?>
        <!-- <div class="row my-4" >
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
                                <a href="<?= wp_get_attachment_url($floorplans_item_id) ?>" title="<?= wp_get_attachment_caption($floorplans_item_id) ?>" data-lightbox="roadtrip">
                                    <img loading="lazy" class="img-floorplan" src="<?= wp_get_attachment_url($floorplans_item_id) ?>" alt="<?= wp_get_attachment_caption($floorplans_item_id) ?>">
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div> -->
    <?php endif; ?>


    <?php if ($psd['theme_options']['opt-properties-status']) : ?>
        <?php if (!empty($psd['theme_options']['opt-properties-shortcode'])) : ?>
            <div class="row mt-5 properties-shortcode" id="RegisterNow">
                <div class="col-12">
                    <div class="titr-list ml-0 mb-2">
                        <?php if ($psd['opt_project_status']) : ?>
                            <h3 class="font-weight-bold">Fill the Form to get latest available Listings in This building</h3>
                        <?php else : ?>
                            <h3 class="font-weight-bold">Register Now to get full package , book your unit</h3>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <style>
                        <?php echo $psd['theme_options']['opt-properties-style'] ?>
                    </style>
                    <div class="card-form">
                        <?= do_shortcode($psd['theme_options']['opt-properties-shortcode']) ?>
                    </div>
                </div>
                <div class="col-12 col-lg-8 d-none d-lg-block">
                    <div class="form-image">
                        <img loading="lazy" class="fit-form-image" src="<?= $psd['theme_options']['opt-properties-banner']['url'] ?>" alt="<?= $psd['theme_options']['opt-properties-banner']['alt'] ?>">
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>


    <?php if ($associated_floorplans->have_posts()) : ?>
        <div class="container-fluid px-0 mt-lg-5 mt-2" id="FloorPlans">
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
                                        <a href="<?= get_the_permalink() ?>" title="<?= strlen(get_the_title())  > 12 ? substr(get_the_title(), 0, 12) . '...' : get_the_title() ?>">
                                            <?php the_post_thumbnail('normal', ['loading' => 'lazy']) ?>
                                        </a>
                                    </div>

                                    <div class="card-body-listing card-body-listing-v2">

                                        <div class="card-listing-content card-listing-content-v2">
                                            <a href="<?= get_the_permalink() ?>" title="<?= strlen(get_the_title())  > 12 ? substr(get_the_title(), 0, 12) . '...' : get_the_title() ?>">
                                                <h6 class="text-black"><?= strlen(get_the_title())  > 12 ? substr(get_the_title(), 0, 12) . '...' : get_the_title() ?></h6>
                                            </a>
                                            <div class="card-listing-description card-listing-description-v2">
                                                <a href="<?= get_the_permalink() ?>" title="<?= strlen(get_the_title())  > 12 ? substr(get_the_title(), 0, 12) . '...' : get_the_title() ?>">
                                                    <?= strlen(strip_tags($psd['excerpt']))  > 65 ? substr(strip_tags($psd['excerpt']), 0, 65) . '...' : strip_tags($psd['content']) ?>
                                                </a>
                                            </div>
                                        </div>


                                        <!-- <div class="card-listing-content card-listing-content-v2">
                                        <h6 class="text-black"><?= strlen(get_the_title())  > 12 ? substr(get_the_title(), 0, 12) . '...' : get_the_title() ?></h6>
                                        <div class="card-listing-description card-listing-description-v2">
                                            <?= strlen(strip_tags($psd['excerpt']))  > 65 ? substr(strip_tags($psd['excerpt']), 0, 65) . '...' : strip_tags($psd['content']) ?>
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
                                                <i onclick="setLikeProperties(this, <?= get_the_ID() ?>)" role="button" class="fa fa-heart" <?= isset($_COOKIE[get_the_ID()]) ? ' style="color:red" ' : '' ?>></i>
                                                <span class="text-muted" id="like-total">
                                                    <?php if (!empty(get_post_meta(get_the_ID(), 'total_like', true))) : ?>
                                                        <?= get_post_meta(get_the_ID(), 'total_like', true)   ?>
                                                    <?php endif; ?>
                                                </span>
                                            </div>

                                            <i role="button" class="fa fa-share-alt"></i>
                                            <i <?= is_user_logged_in() ? in_array(get_the_ID(), get_user_meta(get_current_user_id(), 'properties_favorites', true)) ? ' style="color:#9de450" ' : '' : '' ?> role="button" onclick="bookmark(this,<?= get_the_ID() ?>)" class="fa fa-bookmark"></i>
                                        </div>
                                        <a href="<?= get_the_permalink() ?>" title="<?= $psd['title'] ?>" class="">more</a>

                                    </div>

                                    <div class="card-share">
                                        <a target="_blank" href="https://www.facebook.com/sharer.php?u=<?= wp_get_shortlink(get_the_ID(), 'post', true) ?>"><i class="fa fa-facebook-square"></i></a>
                                        <a target="_blank" href="https://reddit.com/submit?url=<?= wp_get_shortlink(get_the_ID(), 'post', true) ?>&title=<?= $psd['title'] ?>"><i class="fa fa-reddit"></i></a>
                                        <a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=<?= wp_get_shortlink(get_the_ID(), 'post', true) ?>?ref=linkedin&title=<?= $psd['title'] ?>&summary=<?php $psd['content'] ?>"><i class="fa fa-linkedin-square"></i></a>
                                        <a target="_blank" href="https://wa.me/?text=<?= wp_get_shortlink(get_the_ID(), 'post', true) ?>"><i class="fa fa-whatsapp"></i></a>
                                        <a target="_blank" href="https://telegram.me/share/url?url=<?= wp_get_shortlink(get_the_ID(), 'post', true) ?>?ref=telegram"><i class="fa fa-telegram"></i></a>
                                        <a target="_blank" href="https://www.pinterest.com/pin/create/button?url=<?= wp_get_shortlink(get_the_ID(), 'post', true) ?>&media=<?= $psd['thumbnail_url'] ?>&description=<?= $psd['title'] ?>"><i class="fa fa-pinterest"></i></a>
                                        <a target="_blank" href="https://twitter.com/intent/tweet?url=<?= wp_get_shortlink(get_the_ID(), 'post', true) ?>"><i class="fa fa-twitter-square"></i></a>
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
                                    <a href="<?= get_the_permalink() ?>" title="<?= strlen(get_the_title())  > 12 ? substr(get_the_title(), 0, 12) . '...' : get_the_title() ?>">
                                        <?php the_post_thumbnail('normal', ['loading' => 'lazy']) ?>
                                    </a>
                                </div>


                                <div class="card-body-listing card-body-listing-v2">


                                    <div class="card-listing-content card-listing-content-v2">
                                        <a href="<?= get_the_permalink() ?>" title="<?= strlen(get_the_title())  > 12 ? substr(get_the_title(), 0, 12) . '...' : get_the_title() ?>">
                                            <h6 class="text-black"><?= strlen(get_the_title())  > 12 ? substr(get_the_title(), 0, 12) . '...' : get_the_title() ?></h6>
                                        </a>
                                        <div class="card-listing-description card-listing-description-v2">
                                            <a href="<?= get_the_permalink() ?>" title="<?= strlen(strip_tags(get_the_excerpt()))  > 65 ? substr(strip_tags(get_the_excerpt()), 0, 65) . '...' : strip_tags(get_the_content()) ?>">
                                                <?= strlen(strip_tags(get_the_excerpt()))  > 65 ? substr(strip_tags(get_the_excerpt()), 0, 65) . '...' : strip_tags(get_the_content()) ?>
                                            </a>
                                        </div>
                                    </div>

                                    <!-- <div class="card-listing-content card-listing-content-v2">
                                        <h6 class="text-black"><?= strlen(get_the_title())  > 12 ? substr(get_the_title(), 0, 12) . '...' : get_the_title() ?></h6>
                                        <div class="card-listing-description card-listing-description-v2">
                                            <?= strlen(strip_tags(get_the_excerpt()))  > 65 ? substr(strip_tags(get_the_excerpt()), 0, 65) . '...' : strip_tags(get_the_content()) ?>
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
                                            <i onclick="setLikeProperties(this, <?= get_the_ID() ?>)" role="button" class="fa fa-heart" <?= isset($_COOKIE[get_the_ID()]) ? ' style="color:red" ' : '' ?>></i>
                                            <span class="text-muted" id="like-total">
                                                <?php if (!empty(get_post_meta(get_the_ID(), 'total_like', true))) : ?>
                                                    <?= get_post_meta(get_the_ID(), 'total_like', true)   ?>
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
                                        <i <?= is_user_logged_in() ? in_array(get_the_ID(), $favs) ? ' style="color:#9de450" ' : '' : '' ?> role="button" onclick="bookmark(this,<?= get_the_ID() ?>)" class="fa fa-bookmark"></i>
                                    </div>
                                    <a href="<?= get_the_permalink() ?>" title="<?= get_the_title() ?>" class="">more</a>

                                </div>

                                <div class="card-share">
                                    <a target="_blank" href="https://www.facebook.com/sharer.php?u=<?= wp_get_shortlink(get_the_ID(), 'post', true) ?>"><i class="fa fa-facebook-square"></i></a>
                                    <a target="_blank" href="https://reddit.com/submit?url=<?= wp_get_shortlink(get_the_ID(), 'post', true) ?>&title=<?= get_the_title() ?>"><i class="fa fa-reddit"></i></a>
                                    <a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=<?= wp_get_shortlink(get_the_ID(), 'post', true) ?>?ref=linkedin&title=<?= get_the_title() ?>&summary=<?= get_the_content() ?>"><i class="fa fa-linkedin-square"></i></a>
                                    <a target="_blank" href="https://wa.me/?text=<?= wp_get_shortlink(get_the_ID(), 'post', true) ?>"><i class="fa fa-whatsapp"></i></a>
                                    <a target="_blank" href="https://telegram.me/share/url?url=<?= wp_get_shortlink(get_the_ID(), 'post', true) ?>?ref=telegram"><i class="fa fa-telegram"></i></a>
                                    <a target="_blank" href="https://www.pinterest.com/pin/create/button?url=<?= wp_get_shortlink(get_the_ID(), 'post', true) ?>&media=<?= get_the_post_thumbnail_url() ?>&description=<?= get_the_title() ?>"><i class="fa fa-pinterest"></i></a>
                                    <a target="_blank" href="https://twitter.com/intent/tweet?url=<?= wp_get_shortlink(get_the_ID(), 'post', true) ?>"><i class="fa fa-twitter-square"></i></a>
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