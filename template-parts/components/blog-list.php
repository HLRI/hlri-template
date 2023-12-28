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
                           <?php include(HLR_THEME_COMPONENT . 'blog/card-mini.php'); ?>
                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>