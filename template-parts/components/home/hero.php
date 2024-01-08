<div class="hero-section" >
    <?php if (!empty($theme_options['opt-slider-fieldset']['opt_slider_items'])) : ?>
        <div class="hero-section-left  pl-2 pl-md-3 pl-lg-4 w-50">
            <div class="hero-section-title">
                <h1>Find Your Dreams Condo</h1>
                <h4>Investment Excellence, Condo Brilliance</h4>
                <p>
                    We are recognized for exceeding client expectations and delivering great results through dedication, ease of process, and extraordinary services to our worldwide clients.
                </p>
            </div>
            <div class="hero-section-search" >
                <?php include(HLR_THEME_COMPONENT . 'home/hero-search.php'); ?>
            </div>
        </div>
        <div id="carouselExampleIndicators" class="carousel slide carousel-fade w-50 hero-section-right" data-ride="carousel">
            <div class="carousel-inner">
                <?php
                $i = 0;
                foreach ($theme_options['opt-slider-fieldset']['opt_slider_items'] as $item) :
                ?>
                    <div class="carousel-item <?= $i == 0 ? 'active' : ''  ?>">
                        <img class="d-block w-100 item-slider" src="<?= $item['opt-slider-image']['url'] ?>" alt="<?= $item['opt-slider-image']['alt'] ?>">
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