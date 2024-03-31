<?php $theme_options = get_option('hlr_framework'); ?>

<?php
$arg = [
    'post_type' => 'agents',
    'post_status' => 'publish',
    'posts_per_page' => 4
];

$profiles = new WP_Query($arg);

?>
<?php if ($profiles->have_posts()) : ?>
    <div class="container-fluid my-5">
        <div class="row">
            <div class="col-lg-12 ">
                <div class="titr-list">
                    <h3 class="font-weight-bold">DEDICATED AGENTS</h3>
                    <?php if (!empty($theme_options['opt-homeleaderrealtylinkviews-agents-link']['url'])) : ?>
                        <a href="<?= $theme_options['opt-homeleaderrealtylinkviews-agents-link']['url'] ?>" title="<?= $theme_options['opt-homeleaderrealtylinkviews-agents-link']['alt'] ?>" class="view-more">View more</a>
                    <?php endif; ?>
                </div>
                <div class="d-flex justify-content-center">
                    <div class="owl-carousel owl-theme teams wrap-list">

                        <?php while ($profiles->have_posts()) : $profiles->the_post(); ?>
                             <?php include(HLR_THEME_COMPONENT . 'agents/card-mini.php'); ?>
                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>