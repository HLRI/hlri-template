<?php


function testimonials($param)
{
    $theme_options = get_option('hlr_framework');
    $count = !empty($param['count']) || $param['count'] == 0  ? $param['count'] : 1;
    $showtitr = $param['display'];
    $i = 0;
    if (!empty($theme_options['opt_testimonial_items'])) {
?>

        <?php if ($showtitr) : ?>
            <div class="titr-list mx-0">
                <h3 class="font-weight-bold">TESTIMONIALS</h3>
                <a href="<?= $theme_options['opt-testimonial-view-link']['url'] ?>" alt="<?= $theme_options['opt-testimonial-view-link']['alt'] ?>" class="view-more">View more</a>
            </div>
        <?php endif; ?>
        <div class="testimonials-body">
            <div class="slide-progress"></div>
            <div class="owl-carousel owl-theme testimonials pl-2 pr-4">
                <?php
                foreach ($theme_options['opt_testimonial_items'] as $item) {
                    if ($i < $count) {
                ?>
                        <div class="wrap-testimonials">
                            <div class="card-testimonials">
                                <div class="card-testimonials-image">
                                    <img src="<?= $item['opt-testimonial-image']['url'] ?>" alt="<?= $item['opt-testimonial-image']['alt'] ?>">
                                </div>
                                <h3 class="card-testimonials-title"><?= $item['opt-testimonial-title'] ?></h3>
                            </div>
                            <div class="card-testimonials-content">
                                <p>
                                    <?= $item['opt-testimonial-content'] ?>
                                </p>
                            </div>
                        </div>
                <?php
                    }
                    $i++;
                }
                ?>
            </div>
        </div>


<?php
    }
}
add_shortcode('testimonials', 'testimonials');
