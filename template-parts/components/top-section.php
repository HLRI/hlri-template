<?php $theme_options = get_option('hlr_framework'); ?>



<div class="container-fluid px-3 px-lg-5 my-5">
    <div class="row">
        <?php if (!empty($theme_options['opt_topsection_items'])) : ?>
            <?php foreach ($theme_options['opt_topsection_items'] as $item) : ?>
                <div class="col-12 col-sm-12 col-md-6 col-lg-4 mb-3 mb-lg-0">
                    <div class="card-top-section">
                        <div class="top-section-icon">
                            <i class="<?= str_replace('fas', 'fa', $item['opt-topsection-icon']) ?>"></i>
                        </div>
                        <div class="top-section-content">
                            <div class="top-section-title">
                                <?= $item['opt-topsection-title'] ?>
                            </div>
                            <div class="top-section-description">
                                <?= $item['opt-topsection-content'] ?>
                            </div>
                        </div>
                        <div class="wrap-top-section-button">
                            <a href="<?= $item['opt-topsection-link']['url'] ?>" title="<?= $item['opt-topsection-title-button'] ?>" class="top-section-button">
                                <?= $item['opt-topsection-title-button'] ?>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>