<?php /* Template Name: Testimonials Archive */ ?>
<?php get_header() ?>
<?php
$theme_options = get_option('hlr_framework');
$count = !empty($param['count']) || $param['count'] == 0  ? $param['count'] : 1;
$showtitr = $param['display'];
$i = 0;
if (!empty($theme_options['opt_testimonial_items'])) :
?>

    <div class="container-fluid px-5 my-5">
        <div class="row">
            <?php
            foreach ($theme_options['opt_testimonial_items'] as $item) {
            ?>
                <div class="col-lg-3 px-2">
                    <div class="wrap-testimonials">
                        <div class="card-testimonials">
                            <div class="card-testimonials-image">
                                <img loading="lazy" src="<?= $item['opt-testimonial-image']['url'] ?>" alt="<?= $item['opt-testimonial-image']['alt'] ?>">
                            </div>
                            <h3 class="card-testimonials-title"><?= $item['opt-testimonial-title'] ?></h3>
                        </div>
                        <div class="card-testimonials-content">
                            <p>
                                <?= $item['opt-testimonial-content'] ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php
                $i++;
            }
            ?>
        </div>
    </div>

<?php endif; ?>

<?php get_footer() ?>