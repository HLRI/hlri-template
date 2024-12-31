<?php 

get_header(); 
runViewer(); 
if (have_posts()) :
        // post image 
        if (get_the_post_thumbnail_url()) {
            $img_url = get_the_post_thumbnail_url();
        } else {
            $img_url = HLR_THEME_ASSETS . 'images/nopost.jpg';
        }
        // add header page
        define('CUSTOM_PAGE_HEADER', [
            'subtitle' => get_the_date(),
            'title' => get_the_title() ,
        ]);

        // Include the custom-page-header.php file
        include(HLR_THEME_COMPONENT . 'custom-page-header.php');
        ?>

        <div class="container-lg my-4">
            <div class="row">
                <div class="col-lg-9 ">
                    <div class="card-single-blog">
                        <div class="card-blog-content">
                            <h1 class="text-black pt-3 px-3 font-weight-bold"><?php the_title() ?></h1>
                            <div class="d-flex px-3 align-items-center mt-3" style="gap:10px;" >
                            <!-- category list -->
                                <i class="fa fa-folder-open-o"></i>
                                <?php
                                    $i = 1;
                                    foreach (get_the_category() as $cat) :

                                        if ($i == count(get_the_category())) : ?>
                                            <a href="<?= home_url('category/') . $cat->slug ?>"><span> <?= $cat->name ?></span></a>
                                        <?php else : ?>
                                            <a href="<?= home_url('category/') . $cat->slug ?>"><span> <?= $cat->name ?></span></a> /
                                        <?php endif;
                                            $i++;
                                    endforeach; 
                                ?>
                                <div>
                                    <!-- Post publisher -->
                                   <i class="fa fa-user"></i>
                                   <span>by <?= get_the_author_nickname() ?> </span>
                                </div>
                            </div>
                            <div class="w-100 mt-5">
                                <img class="w-100 rounded"  src="<?= $img_url ?>" alt="<?= the_title() ?>" />
                            </div>
                            <div class="card-single-blog-description p-4">
                                <?php the_content() ?>
                            </div>
                        </div>


                    <!-- <div class="card-blog-option">
                        <div class="card-blog-social">
                            <span>2</span>
                            <i class="fa fa-eye"></i>
                            <i class="fa fa-heart"></i>
                        </div>
                    </div> -->
                    <?php 
                     if(get_the_tags()):
                    ?>
                    <div class="px-4 bg-foreground m-3 rounded py-1" >
                        <?php
                            the_tags( '<div class="post-tags"> Tags:   ', ', ', '</div>' );
                        ?>
                    </div>
                    <?php endif; ?>
                    </div>
                    <div class="card-share-single">
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
                    <?php
                    $terms = get_the_terms(get_the_ID(), 'category');
                    if ($terms) {

                        $term_ids[] = 0;

                        foreach ($terms as $item) {

                            $term_ids[] = $item->term_id;
                        }
                    }
                    $args = array(
                        'post_type' => ['post'],
                        'post_status' => ['publish'],
                        'posts_per_page' => 6,
                        'post__not_in' => [get_the_ID()],
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'category',
                                'field' => 'term_id',
                                'terms' => $term_ids
                            )
                        ),
                    );
                    $query = new WP_Query($args);
                    if ($query->have_posts()) :
                    ?>
                        <div class="related-posts">
                            <div class="titr-list mt-4">
                                <h3 class="font-weight-bold">Related Posts</h3>
                            </div>
                            <div class="d-flex justify-content-center">
                                <div class="owl-carousel owl-theme post-related wrap-list">
                                    <?php while ($query->have_posts()) : $query->the_post(); ?>
                                        <div class="card-blog">

                                            <div class="card-blog-header">
                                                <div class="blog-category">
                                                    <i class="fa fa-folder-open-o"></i>
                                                    <?php
                                                    $i = 1;
                                                    foreach (get_the_category() as $cat) :

                                                        if ($i == count(get_the_category())) : ?>
                                                            <a href="<?= home_url('category/') . $cat->slug ?>"><span> <?= $cat->name ?></span></a>
                                                        <?php else : ?>
                                                            <a href="<?= home_url('category/') . $cat->slug ?>"><span> <?= $cat->name ?></span></a> ,
                                                    <?php endif;
                                                        $i++;
                                                    endforeach; ?>
                                                </div>
                                                <div class="date-blog"><i class="fa fa-calendar"></i> <span><?= get_the_date() ?></span></div>
                                            </div>



                                            <div class="card-blog-image">
                                                <?php the_post_thumbnail('normal', ['loading' => 'lazy']) ?>
                                            </div>
                                            <div class="card-blog-content">
                                                <h3 class="text-black"><?= strlen(get_the_title())  > 55 ? substr(get_the_title(), 0, 55) . '...' : get_the_title() ?></h3>
                                                <div class="card-blog-description">
                                                    <?= strlen(strip_tags(get_the_content()))  > 80 ? substr(strip_tags(get_the_content()), 0, 80) . '...' : strip_tags(get_the_content()) ?>
                                                </div>
                                            </div>

                                            <div class="card-blog-option">
                                                <div class="card-blog-social">
                                                    <span><?= getView(get_the_ID()) ?></span>
                                                    <i class="fa fa-eye"></i>
                                                    <!-- <i class="fa fa-heart"></i> -->
                                                </div>
                                                <a class="btn-hlr" href="<?= get_the_permalink() ?>" title="<?= get_the_title() ?>" class="">Read More</a>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                    <?php wp_reset_postdata(); ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php include(HLR_THEME_COMPONENT . 'properties-category/hot-deals.php'); ?>

<script>
    jQuery(".listing-wrap").owlCarousel({
        responsive: {
            200: { items: 1 },
            300: { items: 1 },
            500: { items: 1.4 },
            600: { items: 2 },
            768: { items: 2 },
            800: { items: 2.4 },
            1000: { items: 2.6 },
            1200: { items: 3 },
            1250: { items: 3 },
            1400: { items: 3 },
            1600: { items: 3 },
        },
        loop: true,
        nav: true,
        navText: [
            '<i class="fa fa-angle-left" aria-hidden="true"></i>',
            '<i class="fa fa-angle-right" aria-hidden="true"></i>',
        ],
        autoplay: false,
        autoplaySpeed: 1000,
        autoplayTimeout: 2000,
        autoplayHoverPause: true,
        rtl: false,
        center: false,
        dots: false,
        // autoWidth: true,
        margin: 5,
    });
    getPropertiesRestApi("hot-deals", 6, 6, token);
</script>
<style>
    .properties-card {
        max-height: 456px;
    }
</style>
                </div>
                <div class="col-lg-3">
                    <div class="card position-sticky sticky-top mb-3 tab-card" style="top:10px;">
                        <div class="card-header tab-card-header">
                            <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="Latest" data-toggle="tab" href="#latest-tab" role="tab" aria-controls="latest-tab" aria-selected="true">Latest articles</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="Popular" data-toggle="tab" href="#popular-tab" role="tab" aria-controls="popular-tab" aria-selected="false">Popular articles</a>
                                </li>
                            </ul>
                        </div>

                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active p-3" id="latest-tab" role="tabpanel" aria-labelledby="Latest">
                            </div>
                            <div class="tab-pane fade p-3" id="popular-tab" role="tabpanel" aria-labelledby="Popular">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php endif; ?>
<?php get_footer(); ?>