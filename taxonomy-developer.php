<?php get_header() ?>
<?php if (!is_user_logged_in()) : ?>
    <div class="container">
        <div class="row py-5">
            <div class="col-12">
                <div class="card p-4" style="width: 400px; margin: 0 auto;">
                    <div class="d-flex align-items-center mb-2" style="justify-content: space-around; color: #ccc;">
                        <i class="fa fa-lock"></i>
                        <h6 style="font-size:13px">You must login to access the content of this page</h6>
                    </div>
                    <a href="#" class="top-section-button" data-toggle="modal" data-target="#login-modal">Sign In</a>
                </div>
            </div>
        </div>
    </div>
<?php else : ?>
    <?php
    $user = wp_get_current_user();
    if (in_array('agent', (array) $user->roles) || in_array('administrator', (array) $user->roles)) :
    ?>
        <?php
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

        $term = get_queried_object();

        $arg = [
            'post_type' => 'properties',
            'post_status' => 'publish',
            'posts_per_page' => get_option('posts_per_page'),
            'tax_query' => array(
                array(
                    'taxonomy' => $term->taxonomy,
                    'field' => 'slug',
                    'terms' => $term->slug,
                )
            ),
            'paged' => $paged,
        ];

        $peroperties = new WP_Query($arg);

        ?>


        <?php if ($peroperties->have_posts()) : ?>
            <div class="container-fluid px-5 my-5">
                <div class="row">
                    <?php while ($peroperties->have_posts()) : $peroperties->the_post(); ?>
                        <div class="col-lg-4 px-2 mb-4">
                            <div class="card-listing card-listing-v2">

                                <div class="card-listing-image card-listing-image-v2">
                                    <?php the_post_thumbnail('normal', ['loading' => 'lazy']) ?>
                                </div>


                                <div class="card-body-listing card-body-listing-v2">
                                    <div class="card-listing-content card-listing-content-v2">
                                        <h6 class="text-black"><?= strlen(get_the_title())  > 12 ? substr(get_the_title(), 0, 12) . '...' : get_the_title() ?></h6>
                                        <div class="card-listing-description card-listing-description-v2">
                                            <?= strlen(strip_tags(get_the_excerpt()))  > 65 ? substr(strip_tags(get_the_excerpt()), 0, 65) . '...' : strip_tags(get_the_content()) ?>
                                        </div>
                                    </div>

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
                                        <i <?= is_user_logged_in() ? in_array(get_the_ID(), get_user_meta(get_current_user_id(), 'properties_favorites', true)) ? ' style="color:#9de450" ' : '' : '' ?> role="button" onclick="bookmark(this,<?= get_the_ID() ?>)" class="fa fa-bookmark"></i>
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
                        </div>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                </div>

                <?php if (get_query_var('paged') > 1) : ?>
                    <div class="mt-5 row d-flex align-items-center justify-content-center">
                        <?php
                        echo paginate_links(array(
                            'base'         => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                            'total'        => $query->max_num_pages,
                            'current'      => max(1, get_query_var('paged')),
                            'format'       => '?paged=%#%',
                            'show_all'     => false,
                            'type'         => 'plain',
                            'end_size'     => 2,
                            'mid_size'     => 1,
                            'prev_next'    => true,
                            'prev_text'    => sprintf('<i></i> %1$s', __('Newer Posts', 'text-domain')),
                            'next_text'    => sprintf('%1$s <i></i>', __('Older Posts', 'text-domain')),
                            'add_args'     => false,
                            'add_fragment' => '',
                        ));
                        ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    <?php else : ?>
        <div class="container">
            <div class="row py-5">
                <div class="col-12">
                    <div class="card p-4" style="width: 400px; margin: 0 auto;">
                        <div class="d-flex align-items-center" style="justify-content: space-around; color: #ccc;">
                            <i class="fa fa-warning"></i>
                            <h6 style="font-size:13px">You do not have permission to access this page!</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>
<?php get_footer() ?>