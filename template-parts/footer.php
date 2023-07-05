<?php $theme_options = get_option('hlr_framework'); ?>
<?php
$arg = [
    'post_type' => 'post',
    'post_status' => 'publish',
    'posts_per_page' => 6
];

$posts = new WP_Query($arg);
?>
<footer class="container-fluid footer">
    <div class="row px-5">
        <div class="col-12 col-sm-12 col-md-6 col-lg-3 mb-3">
            <div class="footer-widget">
                <div class="title-footer-widget">
                    <h3>About Us</h3>
                </div>
                <div class="content-footer-widget">
                    <?= $theme_options['opt-footer-about-us'] ?>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-7 col-md-6 col-lg-3 mb-3">
            <?php if ($posts->have_posts()) : ?>
                <div class="footer-widget">
                    <div class="title-footer-widget">
                        <h3>Latest Posts</h3>
                    </div>
                    <div class="content-footer-widget">
                        <ul>
                            <?php while ($posts->have_posts()) : $posts->the_post(); ?>
                                <li><i class="fa fa-file-text-o"></i><a href="<?= get_the_permalink() ?>"> <?= strlen(get_the_title())  > 40 ? substr(get_the_title(), 0, 40) . '...' : get_the_title() ?></a></li>
                            <?php endwhile; ?>
                        </ul>
                    </div>
                </div>
                <?php wp_reset_postdata(); ?>
            <?php endif; ?>
        </div>
        <div class="col-12 col-sm-5 col-md-6 col-lg-3 mb-3">
            <?php if (!empty($theme_options['opt-footer-contact'])) : ?>
                <div class="footer-widget">
                    <div class="title-footer-widget">
                        <h3>Contact</h3>
                    </div>
                    <div class="content-footer-widget">
                        <ul>
                            <?php foreach ($theme_options['opt-footer-contact'] as $item) : ?>
                                <li><i class="<?= $item['opt-footer-contact-icon'] ?>"></i><a href="<?= $item['opt-footer-contact-link']['url'] ?>"> <?= $item['opt-footer-contact-title'] ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3">
            <?php if (!empty($theme_options['opt-footer-social'])) : ?>
                <div class="footer-widget">
                    <div class="title-footer-widget">
                        <h3>Social Links</h3>
                    </div>
                    <div class="content-footer-widget">
                        <ul class="list-social">
                            <?php foreach ($theme_options['opt-footer-social'] as $item) : ?>
                                <li class="item-social"><a href="<?= $item['opt-footer-social-link']['url'] ?>"><i class="<?= $item['opt-footer-social-icon'] ?>"></i></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</footer>
<div class="container-fluid">

    <div class="row copyright">
        <div class="col-12 text-center py-2">
            Copyright 2018 - <?= date("Y") ?> | Home Leader Realty Inc. All Rights Reserved.
        </div>
    </div>
</div>

</div>

<?php $theme_options = get_option('hlr_framework'); ?>

<?php if ($theme_options['opt-popup-status']) : ?>

    <style>
        <?php echo $theme_options['opt-popup-style'] ?>
    </style>

    <?php include HLR_THEME_PATH . 'template-parts/components/popup.php' ?>

    <script>
        jQuery(window).on('load', function() {
            jQuery('#myModal').modal('show');
        });
    </script>
<?php endif; ?>


<?php include HLR_THEME_PATH . 'template-parts/components/search-mobile.php' ?>
<?php include HLR_THEME_PATH . 'template-parts/components/login-popup.php' ?>

</body>

</html>