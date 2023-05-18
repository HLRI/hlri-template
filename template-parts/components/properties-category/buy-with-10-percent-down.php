<?php
$arg = [
    'post_type' => 'properties',
    'post_status' => 'publish',
    'posts_per_page' => 10,
    'tax_query' => [
        [
            'taxonomy' => 'group',
            'field' => 'term_id',
            'terms' => 22,
        ]
    ]
];

$peroperties = new WP_Query($arg);
?>
<?php if ($peroperties->have_posts()) : ?>
    <div class="titr-list">
        <h3 class="font-weight-bold">Buy With 10% Down</h3>
        <a href="<?= home_url('group/buy-with-10-percent-down') ?>" title="" class="view-more">View more</a>
    </div>
    <div class="d-flex justify-content-center">
        <div class="testimonials-body bg-box-slider">
            <div class="slide-progress"></div>
            <div class="owl-carousel owl-theme buy-with-10-percent-down  properties-category">
                <?php while ($peroperties->have_posts()) : $peroperties->the_post();
                    $mdata = get_post_meta(get_the_ID(), 'hlr_framework_mapdata', true);
                ?>
                    <div class="card-listing">

                        <div class="card-listing-image">
                            <a href="<?= get_the_permalink() ?>" title="<?= strlen(get_the_title())  > 12 ? substr(get_the_title(), 0, 12) . '...' : get_the_title() ?>">
                                <?php the_post_thumbnail() ?>
                            </a>
                        </div>


                        <div class="card-body-listing">


                            <div class="card-listing-content">
                                <a href="<?= get_the_permalink() ?>" title="<?= strlen(get_the_title())  > 12 ? substr(get_the_title(), 0, 12) . '...' : get_the_title() ?>">
                                    <h6 class="text-black"><?= strlen(get_the_title())  > 12 ? substr(get_the_title(), 0, 12) . '...' : get_the_title() ?></h6>
                                </a>
                                <div class="card-listing-description">
                                    <a href="<?= get_the_permalink() ?>" title="<?= strlen(strip_tags(get_the_excerpt()))  > 65 ? substr(strip_tags(get_the_excerpt()), 0, 65) . '...' : strip_tags(get_the_content()) ?>">
                                        <?= strlen(strip_tags(get_the_excerpt()))  > 65 ? substr(strip_tags(get_the_excerpt()), 0, 65) . '...' : strip_tags(get_the_content()) ?>
                                    </a>
                                </div>
                            </div>


                            <!-- <div class="card-listing-content">
                                <h6 class="text-black"><?= strlen(get_the_title())  > 12 ? substr(get_the_title(), 0, 12) . '...' : get_the_title() ?></h6>
                                <div class="card-listing-description">
                                    <?= strlen(strip_tags(get_the_excerpt()))  > 65 ? substr(strip_tags(get_the_excerpt()), 0, 65) . '...' : strip_tags(get_the_content()) ?>
                                </div>
                            </div> -->

                            <div class="lable-listing">
                                <?php if (!empty($mdata['opt-min-price-sqft'])) : ?>
                                    <div><?= "$" . $mdata['opt-min-price-sqft'] . " to " . "$" . $mdata['opt-max-price-sqft'] ?></div>
                                <?php endif; ?>
                                <?php if (!empty($mdata['opt-size-min'])) : ?>
                                    <div><?= $mdata['opt-size-min'] . " - " . $mdata['opt-size-max'] . " Sq Ft | " . $mdata['opt-occupancy'] ?></div>
                                <?php endif; ?>
                                <div>2781 Yonge St</div>
                            </div>
                        </div>



                        <div class="more">
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