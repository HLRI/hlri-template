<?php if (!empty($theme_options['opt-ads-fieldset']['opt_ads_items'])) : ?>

    <div class="">
        <div class="slide-progress"></div>
        <div class="owl-carousel owl-theme testimonials wrap-ads-banner">
            <?php foreach ($theme_options['opt-ads-fieldset']['opt_ads_items'] as $item) : ?>
                <div class="ads-banner">
                    <a href="<?= $item['opt-ads-link']['url'] ?>" target="<?= $item['opt-ads-link']['target'] ?>" >
                        <img src="<?= $item['opt-ads-image']['url'] ?>" alt="<?= $item['opt-ads-image']['alt'] ?>">
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

<?php else : ?>
    <p>Please select an image for Ads</p>
<?php endif; ?>