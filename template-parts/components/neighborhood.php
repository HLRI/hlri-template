
<?php

$terms = get_terms([
    'taxonomy' => 'neighborhood',
    'hide_empty' => false,
]);


?>
    <div class="container-fluid my-5">
        <div class="row">
            <div class="col-lg-12">
                <div class="titr-list">
                    <h3 class="font-weight-bold">Neighborhood</h3>
                    <a href="#" title="" class="view-more">View more</a>
                </div>
                <div class="d-flex justify-content-center">
                    <div class="owl-carousel owl-theme neighborhood wrap-list">
                        <?php foreach ($terms as $term) : ?>

                            <div class="wrap-neighborhood">
                                <?php get_term_meta($term->id, 'neighborhood_image', true); ?>
                                <img src="<?= $image ?>" class="neighborhood-image" alt="">
                                <div class="neighborhood-title">
                                    <?= $term->name ?>
                                </div>
                                <a href="#" class="neighborhood-link">5 Listing</a>
                            </div>

                        <?php endforeach; ?>
                        <?php wp_reset_postdata(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
