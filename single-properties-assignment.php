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
            </div>

        </div>

        <!-- sidebar -->
        <div class="col-12 col-sm-12 col-md-12 ">

            <div class="hlri-container">
<!--                <img src="img/shape.png" class="hlri-square" alt="" />-->
                <div class="hlri-formsection">
                    <div class="hlri-contact-info">
                        <h3 class="title">Register Now</h3>
                        <p class="hlri-text">
                            to get full package , book your unit
                        </p>

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
                        </div>
                    </div>

                    <div class="hlri-contact-form">
                        <span class="hlri-circle one"></span>
                        <span class="hlri-circle two"></span>

<!--                        <form action="index.html" autocomplete="off">-->
<!--                            <h3 class="hlri-title">Register for --><?php //= $psd['title'] ?><!--</h3>-->
<!--                            -->
<!--                            --><?php //= do_shortcode($psd['theme_options']['opt-properties-shortcode']) ?>
<!---->
<!--                        </form>-->
                        <style>
                            #assignment_form{
                                padding-top: 10px;
                            }
                        </style>
                        <h3 class="hlri-title" style="padding:2.3rem 2.2rem 0 2.2rem">Register for <?= $psd['title'] ?></h3>
                        <?= do_shortcode('[contact-form-7 id="1891ff1" html_id="assignment_form" title="Assignment contact form"]') ?>
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
    <br><br>
<?= do_shortcode($psd['theme_options']['opt-properties-shortcode']) ?>
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
                                                <i onclick="setLikeProperties(this, <?= get_the_ID() ?>)"
                                                   role="button"
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
                                        <span class="share-close"><i role="button"
                                                                     class="fa fa-arrow-up"></i></span>
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