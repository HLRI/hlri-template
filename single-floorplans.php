<?php get_header(); ?>
<?php
$theme_options = get_option('hlr_framework');
?>

<div class="container-fluid px-5 my-4">

    <div class="row">
        <div class="col-lg-8">

            <div class="row">
                <div class="col-lg-10">Presidential Floor Plan</div>
                <div class="col-lg-2">$746/sq.ft</div>
            </div>

            <div class="image-floorplan">
                <?php the_post_thumbnail() ?>
            </div>
            
        </div>
        <div class="col-lg-4">
            <?php if ($theme_options['opt-properties-status']) : ?>
                <?php if (!empty($theme_options['opt-properties-shortcode'])) : ?>
                    <div class="properties-shortcode">
                        <div class="titr-list ml-0 mb-2 pb-1 mr-0">
                            <h3 class="font-weight-bold h4 mb-0">Register Now to get full package , book your unit</h3>
                        </div>
                        <style>
                            <?php echo $theme_options['opt-properties-style'] ?>
                        </style>
                        <div class="card-form">
                            <?= do_shortcode($theme_options['opt-properties-shortcode']) ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>


<?php get_footer(); ?>