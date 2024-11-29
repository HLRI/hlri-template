<?php $theme_options = get_option('hlr_framework'); ?>

<?php
if(wp_is_mobile()):
    include(HLR_THEME_COMPONENT . 'home/hero.php');
else:
    include(HLR_THEME_COMPONENT . 'slider.php');
endif;
?>


<!--  homepage content -->
<div class="container-fluid">
    <?php include(HLR_THEME_COMPONENT . 'soundplayer.php'); ?>
    <?php include(HLR_THEME_COMPONENT . 'top-section.php'); ?>
    <?php include(HLR_THEME_COMPONENT . 'neighborhood.php'); ?>
    <?php include(HLR_THEME_COMPONENT . 'properties-category/just-launched.php'); ?>
    <?php include(HLR_THEME_COMPONENT . 'properties-category/buy-with-5-percent-down.php'); ?>
    <?php include(HLR_THEME_COMPONENT . 'properties-category/buy-with-10-percent-down.php'); ?>
    <?php include(HLR_THEME_COMPONENT . 'properties-category/immediate-occupancy.php'); ?>
    <?php include(HLR_THEME_COMPONENT . 'properties-category/coming-soon.php'); ?>
    <?php include(HLR_THEME_COMPONENT . 'properties-category/condo-assignment.php'); ?>
    <?php include(HLR_THEME_COMPONENT . 'personal-list.php'); ?>
    <?php include(HLR_THEME_COMPONENT . 'counter.php'); ?>


    <?php include(HLR_THEME_COMPONENT . 'users-review.php'); ?>

    <?php include(HLR_THEME_COMPONENT . 'ads-banner.php'); ?>
    <?php do_shortcode('[testimonials count="4" display="1"]'); ?>
    <?php include(HLR_THEME_COMPONENT . 'blog-list.php'); ?>

</div>