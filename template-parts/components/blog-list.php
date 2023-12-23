<?php $theme_options = get_option('hlr_framework'); ?>

<div class="container-fluid my-5">
    <div class="row">
        <div class="col-lg-12">
            <div class="titr-list">
                <h3 class="font-weight-bold">Read From Our Blog</h3>
                <?php if (!empty($theme_options['opt-homeleaderrealtylinkviews-blog-link']['url'])) : ?>
                    <a href="<?= $theme_options['opt-homeleaderrealtylinkviews-blog-link']['url'] ?>" title="<?= $theme_options['opt-homeleaderrealtylinkviews-blog-link']['alt'] ?>" class="view-more">View more</a>
                <?php endif; ?>
            </div>
            <div class="d-flex justify-content-center">
                <div class="owl-carousel owl-theme postlist wrap-list">
                    <?php if (have_posts()) : ?>
                        <?php while (have_posts()) : the_post(); ?>
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
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>