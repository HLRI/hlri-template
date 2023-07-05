<?php $theme_options = get_option('hlr_framework'); ?>
<?php include(HLR_THEME_COMPONENT . 'slider.php'); ?>
<?php include(HLR_THEME_COMPONENT . 'top-section.php'); ?>

<?php include(HLR_THEME_COMPONENT . 'neighborhood.php'); ?>

<div class="container-fluid mb-5 mt-5">
    <div class="row px-2 px-lg-4">

        <div class="col-lg-4">
            <div class="skeleton">
                <div class="skeleton-left flex1">
                    <div class="square"></div>
                </div>
                <div class="skeleton-right flex2">
                    <div class="line h25 w75 m10"></div>
                    <div class="line"></div>
                    <div class="line h8 w50"></div>
                    <div class="line"></div>
                    <div class="line h8 w50"></div>
                    <div class="line  w75"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="skeleton">
                <div class="skeleton-left">
                    <div class="line h17 w40 m10"></div>
                    <div class="line"></div>
                    <div class="line h8 w50"></div>
                    <div class="line  w75"></div>
                </div>
                <div class="skeleton-right">
                    <div class="square"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="skeleton">
                <div class="skeleton-left">
                    <div class="line h17 w40 m10"></div>
                    <div class="line"></div>
                    <div class="line h8 w50"></div>
                    <div class="line  w75"></div>
                </div>
                <div class="skeleton-right">
                    <div class="square"></div>
                </div>
            </div>
        </div>
       
    </div>
</div>


<div class="container-fluid mb-5 mt-5">
    <div class="row px-2 px-lg-4">
        <div class="col-12 col-sm-12 col-md-6 col-lg-4 px-2 mb-4 mb-lg-0">
            <?php include(HLR_THEME_COMPONENT . 'properties-category/just-launched.php'); ?>
        </div>
        <div class="col-12 col-sm-12 col-md-6 col-lg-4 px-2 mb-4 mb-lg-0">
            <?php include(HLR_THEME_COMPONENT . 'properties-category/buy-with-5-percent-down.php'); ?>
        </div>
        <div class="col-12 col-sm-12 col-md-6 col-lg-4 px-2 mb-4 mb-lg-0">
            <?php include(HLR_THEME_COMPONENT . 'properties-category/buy-with-10-percent-down.php'); ?>
        </div>
    </div>
</div>
<?php include(HLR_THEME_COMPONENT . 'properties-category/coming-soon.php'); ?>
<?php include(HLR_THEME_COMPONENT . 'properties-category/condo-assignment.php'); ?>
<?php include(HLR_THEME_COMPONENT . 'personal-list.php'); ?>
<?php include(HLR_THEME_COMPONENT . 'counter.php'); ?>


<!-- <div class="container-fluid my-5">
    <div class="row px-4">
        <div class="col-lg-6">
            <?php include(HLR_THEME_COMPONENT . 'ads-banner.php'); ?>
        </div>
        <div class="col-lg-6">
            <?php do_shortcode('[testimonials count="4" display="1"]'); ?>
        </div>
    </div>
</div> -->


<?php include(HLR_THEME_COMPONENT . 'blog-list.php'); ?>