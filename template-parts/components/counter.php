<?php if (!empty($theme_options['opt_homeleaderrealtycounter_items'])) : ?>
    <div class="container-fluid mt-5 mb-5 bg-counter">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex justify-content-center">
                    <div class="row wrap-list" id="wrap-counter">
                        <?php foreach ($theme_options['opt_homeleaderrealtycounter_items'] as $item) : ?>
                            <div class="col-6 col-sm-6 col-md-4 col-lg-2 px-1 py-4">
                                <div class="card-countup">
                                    <div class="countup-number">
                                        <span id="<?= $item['opt-homeleaderrealtycounter-id'] ?>"><?= $item['opt-homeleaderrealtycounter-number'] ?></span>+
                                    </div>
                                    <div class="countup-title">
                                        <h6><?= $item['opt-homeleaderrealtycounter-title'] ?></h6>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>