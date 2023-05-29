<?php get_header(); ?>
<?php
$theme_options = get_option('hlr_framework');
$galleries = get_post_meta(get_the_ID(), 'hlr_framework_properties', true);
$floorplans = get_post_meta(get_the_ID(), 'hlr_framework_properties-floorplan', true);
$gallery_ids = explode(',', $galleries['opt-gallery-properties']);
$floorplans_ids = explode(',', $floorplans['opt-gallery-properties-floorplan']);
$incentives = @get_post_meta(get_the_ID(), 'hlr_framework_properties-incentives', true)['opt_properties_incentives_items'];
$videos = @get_post_meta(get_the_ID(), 'hlr_framework_properties-video', true)['opt_properties_video_items'];
$developments = @get_post_meta(get_the_ID(), 'hlr_framework_properties_development_details', true)['opt_properties_development_details_items'];
$price_images = @get_post_meta(get_the_ID(), 'hlr_framework_properties_price_list', true)['opt_properties_price_list_items'];
?>


<?php //include HLR_THEME_COMPONENT . 'navigation-single-property.php' ?>
<div id="navigation-fixed-location"></div>
<div class="container-fluid px-lg-5">
    <div class="row mt-10">
        <div class="col-12 col-sm-12 col-md-3 col-lg-2">
            <div class="card-properties-image">
                <?php the_post_thumbnail() ?>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-9 col-lg-10 pl-0">
            <div class="card-profile-details p-0 position-relative">
                <span class="update-label">Last Update : <?= get_the_modified_date('j F Y') ?></span>
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <h1 class="mb-2"><?php the_title() ?></h1>
                    <div class="card-share-single my-0">
                        <div class="card-share-single-options">
                            <a target="_blank" href="https://www.facebook.com/sharer.php?u=<?= wp_get_shortlink(get_the_ID(), 'post', true) ?>"><i class="fa fa-facebook-square"></i></a>
                            <a target="_blank" href="https://reddit.com/submit?url=<?= wp_get_shortlink(get_the_ID(), 'post', true) ?>&title=<?php the_title() ?>"><i class="fa fa-reddit"></i></a>
                            <a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=<?= wp_get_shortlink(get_the_ID(), 'post', true) ?>?ref=linkedin&title=<?php the_title() ?>&summary=<?php the_excerpt() ?>"><i class="fa fa-linkedin-square"></i></a>
                            <a target="_blank" href="https://wa.me/?text=<?= wp_get_shortlink(get_the_ID(), 'post', true) ?>"><i class="fa fa-whatsapp"></i></a>
                            <a target="_blank" href="https://telegram.me/share/url?url=<?= wp_get_shortlink(get_the_ID(), 'post', true) ?>?ref=telegram"><i class="fa fa-telegram"></i></a>
                            <a target="_blank" href="https://www.pinterest.com/pin/create/button?url=<?= wp_get_shortlink(get_the_ID(), 'post', true) ?>&media=<?= get_the_post_thumbnail_url() ?>&description=<?php the_title() ?>"><i class="fa fa-pinterest"></i></a>
                            <a target="_blank" href="https://twitter.com/intent/tweet?url=<?= wp_get_shortlink(get_the_ID(), 'post', true) ?>"><i class="fa fa-twitter-square"></i></a>
                        </div>
                    </div>
                </div>
                <div class="start-price">Starting from $571,990</div>
                <?php if (!empty(get_the_excerpt())) : ?>
                    <div class="content-profile"><?php the_excerpt() ?></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
    <div class="container-fluid px-0">
        <?php include HLR_THEME_COMPONENT . 'navigation-single-fixed-on-scroll.php' ?>
    </div>
    <div class="container-fluid px-lg-5">
    <div class="row mt-4 mb-2" id="ga">
        <?php if (!empty($gallery_ids[0])) : ?>
            <div class="col-lg-6">
                <ul class="pgwSlideshow">
                    <?php foreach ($gallery_ids as $gallery_item_id) : ?>
                        <li><img src="<?= wp_get_attachment_url($gallery_item_id) ?>" alt="<?= wp_get_attachment_caption($gallery_item_id) ?>" data-large-src="<?= wp_get_attachment_url($gallery_item_id) ?>"></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php if (!empty($incentives)) : ?>
            <div class="col-lg-6">
                <div class="incentives">
                    <?php foreach ($incentives as $item) : ?>
                        <div class="content-info"><?php if (!empty($item['opt-icon-incentives'])) : ?><i class="<?= $item['opt-icon-incentives'] ?> icon-profile"></i><?php endif; ?><?= $item['opt-link-incentives'] ?></div>
                    <?php endforeach; ?>
                </div>
                <div class="wrap-map">
                    <div id="map"></div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <?php if (!empty(get_the_content())) : ?>
        <div class="row mt-2 mb-4" id="ov">
            <div class="col-12">
                <div class="content-profile"><?php the_content() ?></div>
            </div>
        </div>
    <?php endif; ?>

</div>

<?php if (!empty($videos)) : ?>
    <div class="container-fluid px-lg-5 py-4" style="background: linear-gradient(45deg, #bf212f, #3a27bd);">
        <div class="row mt-2 mb-4">
            <div class="col-12">
                <div class="rvs-container">
                    <div class="rvs-item-container">
                        <div class="rvs-item-stage">
                            <?php foreach ($videos as $video) : ?>
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
                            <?php foreach ($videos as $video) : ?>
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

<div class="container-fluid px-lg-5">
    <?php if (!empty($developments)) : ?>
        <div class="row mt-5 mb-4">
            <div class="col-12">
                <div class="titr-list ml-0">
                    <h3 class="font-weight-bold">Development Details</h3>
                </div>
            </div>
            <?php foreach ($developments as $development) : ?>
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

    <?php if (!empty($price_images)) : ?>
        <div class="row mt-5 mb-4" id="pl">
            <div class="col-12">
                <div class="titr-list ml-0">
                    <h3 class="font-weight-bold">Price List</h3>
                </div>
            </div>
            <?php foreach ($price_images as $image) : ?>
                <div class="col-12 col-sm-12 col-md-6 col-lg-6 mb-4">
                    <div class="image-price">
                        <img src="<?= $image['opt-price-list-image']['url'] ?>" alt="<?= $image['opt-price-list-image']['alt'] ?>">
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($floorplans_ids[0])) : ?>
        <div class="row my-4" id="fp">
            <div class="col-12">
                <div class="titr-list ml-0">
                    <h3 class="font-weight-bold">Floor Plans</h3>
                </div>
            </div>
            <div class="row px-4">
                <?php foreach ($floorplans_ids as $floorplans_item_id) : ?>
                    <div class="col-3 col-sm-2 col-md-2 col-lg-1 px-2 mb-4">
                        <div class="card-floolplan">
                            <a href="<?= wp_get_attachment_url($floorplans_item_id) ?>" title="<?= wp_get_attachment_caption($floorplans_item_id) ?>" data-lightbox="roadtrip">
                                <img class="img-floorplan" src="<?= wp_get_attachment_url($floorplans_item_id) ?>" alt="<?= wp_get_attachment_caption($floorplans_item_id) ?>">
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>


    <?php if ($theme_options['opt-properties-status']) : ?>
        <?php if (!empty($theme_options['opt-properties-shortcode'])) : ?>
            <div class="row mt-5 properties-shortcode" id="rn">
                <div class="col-12">
                    <div class="titr-list ml-0 mb-2">
                        <h3 class="font-weight-bold">Register Now to get full package , book your unit</h3>
                    </div>
                </div>
                <div class="col-12 mb-4">
                    <style>
                        <?php echo $theme_options['opt-properties-style'] ?>
                    </style>
                    <div class="card-form">
                        <?= do_shortcode($theme_options['opt-properties-shortcode']) ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>

</div>


<div class="container-fluid my-4" id="rp">
    <div class="row">
        <?php
        $terms = get_the_terms(get_the_ID(), array('stage', 'type', 'city', 'neighborhood', 'group'));
        if ($terms) {
            $term_ids = array();

            foreach ($terms as $item) {
                $term_ids[] = $item->term_id;
            }

            $args = array(
                'post_type' => ['properties'],
                'post_status' => ['publish'],
                'posts_per_page' => 6,
                'post__not_in' => [get_the_ID()],
                'tax_query' => array(
                    'relation' => 'OR',
                    array(
                        'taxonomy' => 'stage',
                        'field' => 'term_id',
                        'terms' => $term_ids
                    ),
                    array(
                        'taxonomy' => 'type',
                        'field' => 'term_id',
                        'terms' => $term_ids
                    ),
                    array(
                        'taxonomy' => 'city',
                        'field' => 'term_id',
                        'terms' => $term_ids
                    ),
                    array(
                        'taxonomy' => 'neighborhood',
                        'field' => 'term_id',
                        'terms' => $term_ids
                    ),
                    array(
                        'taxonomy' => 'group',
                        'field' => 'term_id',
                        'terms' => $term_ids
                    )
                ),
            );
            $peroperties = new WP_Query($args);
        }
        if ($peroperties->have_posts()) :
        ?>
            <div class="col-12 px-lg-5">
                <div class="titr-list ml-0">
                    <h3 class="font-weight-bold">Related Properties</h3>
                </div>
            </div>

            <div class="col-12">
                <div class="d-flex justify-content-center">
                    <div class="owl-carousel owl-theme listing-wrap wrap-list">
                        <?php while ($peroperties->have_posts()) : $peroperties->the_post();
                            $mdata = get_post_meta(get_the_ID(), 'hlr_framework_mapdata', true);
                        ?>
                            <div class="card-listing card-listing-v2">

                                <div class="card-listing-image card-listing-image-v2">
                                    <a href="<?= get_the_permalink() ?>" title="<?= strlen(get_the_title())  > 12 ? substr(get_the_title(), 0, 12) . '...' : get_the_title() ?>">
                                        <?php the_post_thumbnail() ?>
                                    </a>
                                </div>


                                <div class="card-body-listing card-body-listing-v2">

                                    <div class="card-listing-content card-listing-content-v2">
                                        <a href="<?= get_the_permalink() ?>" title="<?= strlen(get_the_title())  > 12 ? substr(get_the_title(), 0, 12) . '...' : get_the_title() ?>">
                                            <h6 class="text-black"><?= strlen(get_the_title())  > 12 ? substr(get_the_title(), 0, 12) . '...' : get_the_title() ?></h6>
                                        </a>
                                        <div class="card-listing-description card-listing-description-v2">
                                            <a href="<?= get_the_permalink() ?>" title="<?= strlen(get_the_title())  > 12 ? substr(get_the_title(), 0, 12) . '...' : get_the_title() ?>">
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
                                        <div>2781 Yonge St</div>
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
                                        <i <?= is_user_logged_in() ? in_array(get_the_ID(), get_user_meta(get_current_user_id(), 'propertoes_favorites', true)) ? ' style="color:#9de450" ' : '' : '' ?> role="button" onclick="bookmark(this,<?= get_the_ID() ?>)" class="fa fa-bookmark"></i>
                                    </div>
                                    <a href="<?= get_the_permalink() ?>" title="<?php the_title() ?>" class="">more</a>

                                </div>

                                <div class="card-share">
                                    <a target="_blank" href="https://www.facebook.com/sharer.php?u=<?= wp_get_shortlink(get_the_ID(), 'post', true) ?>"><i class="fa fa-facebook-square"></i></a>
                                    <a target="_blank" href="https://reddit.com/submit?url=<?= wp_get_shortlink(get_the_ID(), 'post', true) ?>&title=<?php the_title() ?>"><i class="fa fa-reddit"></i></a>
                                    <a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=<?= wp_get_shortlink(get_the_ID(), 'post', true) ?>?ref=linkedin&title=<?php the_title() ?>&summary=<?php the_content() ?>"><i class="fa fa-linkedin-square"></i></a>
                                    <a target="_blank" href="https://wa.me/?text=<?= wp_get_shortlink(get_the_ID(), 'post', true) ?>"><i class="fa fa-whatsapp"></i></a>
                                    <a target="_blank" href="https://telegram.me/share/url?url=<?= wp_get_shortlink(get_the_ID(), 'post', true) ?>?ref=telegram"><i class="fa fa-telegram"></i></a>
                                    <a target="_blank" href="https://www.pinterest.com/pin/create/button?url=<?= wp_get_shortlink(get_the_ID(), 'post', true) ?>&media=<?= get_the_post_thumbnail_url() ?>&description=<?php the_title() ?>"><i class="fa fa-pinterest"></i></a>
                                    <a target="_blank" href="https://twitter.com/intent/tweet?url=<?= wp_get_shortlink(get_the_ID(), 'post', true) ?>"><i class="fa fa-twitter-square"></i></a>
                                    <span class="share-close"><i role="button" class="fa fa-arrow-up"></i></span>
                                </div>
                            </div>
                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                    </div>
                </div>
            </div>

        <?php endif; ?>
    </div>
</div>


<div class="container-fluid my-4" id="hp">
    <div class="row">
        <?php
        $args = array(
            'post_type' => ['properties'],
            'post_status' => ['publish'],
            'posts_per_page' => 6,
            'tax_query' => [
                [
                    'taxonomy' => 'group',
                    'field' => 'term_id',
                    'terms' => 31,
                ]
            ]
        );
        $peroperties = new WP_Query($args);

        if ($peroperties->have_posts()) :
        ?>
            <div class="col-12 px-lg-5">
                <div class="titr-list ml-0">
                    <h3 class="font-weight-bold">This Month Hot New Projects</h3>
                </div>
            </div>

            <div class="col-12">
                <div class="d-flex justify-content-center">
                    <div class="owl-carousel owl-theme listing-wrap wrap-list">
                        <?php while ($peroperties->have_posts()) : $peroperties->the_post();
                            $mdata = get_post_meta(get_the_ID(), 'hlr_framework_mapdata', true);
                        ?>
                            <div class="card-listing card-listing-v2">

                                <div class="card-listing-image card-listing-image-v2">
                                    <a href="<?= get_the_permalink() ?>" title="<?= strlen(get_the_title())  > 12 ? substr(get_the_title(), 0, 12) . '...' : get_the_title() ?>">
                                        <?php the_post_thumbnail() ?>
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
                                        <div>2781 Yonge St</div>
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
                                        <i <?= is_user_logged_in() ? in_array(get_the_ID(), get_user_meta(get_current_user_id(), 'propertoes_favorites', true)) ? ' style="color:#9de450" ' : '' : '' ?> role="button" onclick="bookmark(this,<?= get_the_ID() ?>)" class="fa fa-bookmark"></i>
                                    </div>
                                    <a href="<?= get_the_permalink() ?>" title="<?php the_title() ?>" class="">more</a>

                                </div>

                                <div class="card-share">
                                    <a target="_blank" href="https://www.facebook.com/sharer.php?u=<?= wp_get_shortlink(get_the_ID(), 'post', true) ?>"><i class="fa fa-facebook-square"></i></a>
                                    <a target="_blank" href="https://reddit.com/submit?url=<?= wp_get_shortlink(get_the_ID(), 'post', true) ?>&title=<?php the_title() ?>"><i class="fa fa-reddit"></i></a>
                                    <a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=<?= wp_get_shortlink(get_the_ID(), 'post', true) ?>?ref=linkedin&title=<?php the_title() ?>&summary=<?php the_content() ?>"><i class="fa fa-linkedin-square"></i></a>
                                    <a target="_blank" href="https://wa.me/?text=<?= wp_get_shortlink(get_the_ID(), 'post', true) ?>"><i class="fa fa-whatsapp"></i></a>
                                    <a target="_blank" href="https://telegram.me/share/url?url=<?= wp_get_shortlink(get_the_ID(), 'post', true) ?>?ref=telegram"><i class="fa fa-telegram"></i></a>
                                    <a target="_blank" href="https://www.pinterest.com/pin/create/button?url=<?= wp_get_shortlink(get_the_ID(), 'post', true) ?>&media=<?= get_the_post_thumbnail_url() ?>&description=<?php the_title() ?>"><i class="fa fa-pinterest"></i></a>
                                    <a target="_blank" href="https://twitter.com/intent/tweet?url=<?= wp_get_shortlink(get_the_ID(), 'post', true) ?>"><i class="fa fa-twitter-square"></i></a>
                                    <span class="share-close"><i role="button" class="fa fa-arrow-up"></i></span>
                                </div>
                            </div>
                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                    </div>
                </div>
            </div>

        <?php endif; ?>
    </div>
</div>


<?php get_footer(); ?>