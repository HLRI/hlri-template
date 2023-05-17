<?php $theme_options = get_option('hlr_framework'); ?>
<?php include(HLR_THEME_PATH . '/template-parts/components/slider.php'); ?>
<?php include(HLR_THEME_PATH . '/template-parts/components/top-section.php'); ?>

<?php include(HLR_THEME_PATH . '/template-parts/components/neighborhood.php'); ?>

<div class="container-fluid mb-5 mt-5">
    <div class="row px-2 px-lg-4">
        <div class="col-12 col-sm-12 col-md-6 col-lg-4 px-2 mb-4 mb-lg-0">
            <?php include(HLR_THEME_PATH . '/template-parts/components/properties-category/just-launched.php'); ?>
        </div>
        <div class="col-12 col-sm-12 col-md-6 col-lg-4 px-2 mb-4 mb-lg-0">
            <?php include(HLR_THEME_PATH . '/template-parts/components/properties-category/buy-with-5-percent-down.php'); ?>
        </div>
        <div class="col-12 col-sm-12 col-md-6 col-lg-4 px-2 mb-4 mb-lg-0">
            <?php include(HLR_THEME_PATH . '/template-parts/components/properties-category/buy-with-10-percent-down.php'); ?>
        </div>
    </div>
</div>
<?php include(HLR_THEME_PATH . '/template-parts/components/properties-category/coming-soon.php'); ?>
<?php include(HLR_THEME_PATH . '/template-parts/components/properties-category/condo-assignment.php'); ?>
<?php include(HLR_THEME_PATH . '/template-parts/components/personal-list.php'); ?>
<?php include(HLR_THEME_PATH . '/template-parts/components/counter.php'); ?>


<!-- <div class="container-fluid my-5">
    <div class="row px-4">
        <div class="col-lg-6">
            <?php include(HLR_THEME_PATH . '/template-parts/components/ads-banner.php'); ?>
        </div>
        <div class="col-lg-6">
            <?php do_shortcode('[testimonials count="4" display="1"]'); ?>
        </div>
    </div>
</div> -->


<?php include(HLR_THEME_PATH . '/template-parts/components/blog-list.php'); ?>