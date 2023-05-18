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
                    <?php foreach ($terms as $term) :
                        $meta = get_term_meta($term->term_id, 'neighborhood_options', true);
                    ?>

                        <a href="#"><div class="wrap-neighborhood">
                            <img src="<?= $meta['opt-neighborhood-image']['url'] ?>" class="neighborhood-image" alt="<?= $meta['opt-neighborhood-image']['alt'] ?>">
                            <div class="neighborhood-title">
                                <?= $term->name ?>
                            </div>
                            <a target="_blank" href="<?= $meta['opt-neighborhood-link']['url'] ?>" class="neighborhood-link"><?= get_post_count_taxonomy($term->term_id,'neighborhood','properties') ?> Listing</a>
                        </div></a>

                    <?php endforeach; ?>
                    <?php wp_reset_postdata(); ?>
                </div>
            </div>
        </div>
    </div>
</div>