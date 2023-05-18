<div class="col-lg-12 px-0">
    <?php if (!empty($theme_options['opt-slider-fieldset']['opt_slider_items'])) : ?>
        <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel">
            <div class="section-slide">
                <div>
                    <h4 class="slider-title">Find Your Dreams Condo</h4>
                </div>

                <?php include(HLR_THEME_PATH . '/template-parts/components/search-slider.php'); ?>

                <a target="_blank" href="https://hlric.com/" class="btn-slider">Search Condos on Map</a>
            </div>
            <div class="carousel-inner">
                <?php
                $i = 0;
                foreach ($theme_options['opt-slider-fieldset']['opt_slider_items'] as $item) :
                ?>
                    <div class="carousel-item <?= $i == 0 ? 'active' : ''  ?>">
                        <img class="d-block w-100 item-slider" src="<?= $item['opt-slider-image']['url'] ?>" alt="<?= $item['opt-slider-link']['alt'] ?>">
                        <div class="carousel-caption d-none d-md-block">
                                <a href="<?= $item['opt-slider-title-link']['url'] ?>" title="<?= $item['opt-slider-title1'] ?>">
                                    <?php if (!empty($item['opt-slider-title1'])) : ?>
                                        <h5><?= $item['opt-slider-title1'] ?></h5>
                                    <?php endif; ?>
                                    <?php if (!empty($item['opt-slider-title2'])) : ?>
                                        <h4><?= $item['opt-slider-title2'] ?></h4>
                                    <?php endif; ?>
                                </a>
                        </div>
                    </div>
                <?php
                    $i++;
                endforeach;
                ?>
            </div>
        </div>
    <?php else : ?>
        <p>Please select an image for slider</p>
    <?php endif; ?>

</div>