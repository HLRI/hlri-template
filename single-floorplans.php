<?php get_header(); ?>
<?php
$theme_options = get_option('hlr_framework');
?>

<div class="container-fluid px-5 my-4">
    <div class="row">
        <div class="col-lg-8">
            <div class="image-floorplan">
                <?php the_post_thumbnail() ?>
            </div>
        </div>
        <div class="col-lg-4">
            <?php if ($theme_options['opt-properties-status']) : ?>
                <?php if (!empty($theme_options['opt-properties-shortcode'])) : ?>
                    <div class="row mt-5 properties-shortcode" id="RegisterNow">
                        <div class="col-12">
                            <div class="titr-list ml-0 mb-2">
                                <h3 class="font-weight-bold">Register Now to get full package , book your unit</h3>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <style>
                                <?php echo $theme_options['opt-properties-style'] ?>
                            </style>
                            <div class="card-form">
                                <?= do_shortcode($theme_options['opt-properties-shortcode']) ?>
                            </div>
                        </div>
                        <div class="col-12 col-lg-8 d-none d-lg-block">
                            <div class="form-image">
                                <img class="fit-form-image" src="<?= $theme_options['opt-properties-banner']['url'] ?>" alt="<?= $theme_options['opt-properties-banner']['alt'] ?>">
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>


<?php get_footer(); ?>