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

<div class="container-fluid px-lg-5">
    <div class="row mt-10">
        <div class="col-12 col-sm-12 col-md-3 col-lg-2">
            <div class="card-properties-image">
                <?php the_post_thumbnail() ?>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-9 col-lg-10">
            <div class="card-profile-details p-0 position-relative">
                <span class="update-label">Last Update : <?= get_the_modified_date('j F Y') ?></span>
                <h1 class="mb-2"><?php the_title() ?></h1>
                <div class="content-profile"><?php the_excerpt() ?></div>
            </div>
        </div>
    </div>

    <div class="row mt-4 mb-2">
        <div class="col-lg-6">
            <ul class="pgwSlideshow">
                <?php foreach ($gallery_ids as $gallery_item_id) : ?>
                    <li><img src="<?= wp_get_attachment_url($gallery_item_id) ?>" alt="<?= wp_get_attachment_caption($gallery_item_id) ?>" data-large-src="<?= wp_get_attachment_url($gallery_item_id) ?>"></li>
                <?php endforeach; ?>
            </ul>
        </div>
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
    </div>

    <div class="row mt-2 mb-4">
        <div class="col-12">
            <div class="content-profile"><?php the_content() ?></div>
        </div>
    </div>

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

    <div class="row mt-5 mb-4">
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

    <div class="row mt-4 mb-4">
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

    <?php if ($theme_options['opt-properties-status']) : ?>
        <?php if (!empty($theme_options['opt-properties-shortcode'])) : ?>
            <div class="row px-5 mt-5 properties-shortcode">
                <div class="col-12 mb-4">
                    <style>
                        <?php echo $theme_options['opt-properties-style'] ?>
                    </style>
                    <?= do_shortcode($theme_options['opt-properties-shortcode']) ?>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>


    <div class="row mt-4 mb-4">
        <div class="col-12">
            <div class="titr-list ml-0">
                <h3 class="font-weight-bold">Share on social media</h3>
            </div>
        </div>
        <div class="col-12">
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
    </div>


</div>

<?php get_footer(); ?>