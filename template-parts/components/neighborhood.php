<?php

$terms = get_terms([
    'taxonomy' => 'neighborhood',
    'hide_empty' => false,
]);
$terms = array_slice($terms, 0, 8);
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
                        
                        if (isset($meta['opt-neighborhood-image']) && !empty($meta['opt-neighborhood-image']['url'])) :
                    ?>
                            <div class="wrap-neighborhood">
                                <a target="_blank" href="<?= isset($meta['opt-neighborhood-link']) ? $meta['opt-neighborhood-link']['url'] : '' ?>" title="<?= $term->name ?>">
                                    <img loading="lazy" src="<?= $meta['opt-neighborhood-image']['url'] ?>" class="neighborhood-image" alt="<?= isset($meta['opt-neighborhood-image']['alt']) ? $meta['opt-neighborhood-image']['alt'] : $term->name ?>">
                                </a>
                                <div class="neighborhood-title">
                                    <?= $term->name ?>
                                </div>
                                <a target="_blank" href="<?= isset($meta['opt-neighborhood-link']) ? $meta['opt-neighborhood-link']['url'] : '' ?>" class="neighborhood-link"><?= get_post_count_taxonomy($term->term_id, 'neighborhood', 'properties') ?> Listing</a>
<!--                                <a target="_blank" class="neighborhood-link">Show on Map</a>-->
<!--                                <a target="_blank" href="--><?php //= isset($meta['opt-neighborhood-link']) ? $meta['opt-neighborhood-link']['url'] : '' ?><!--" class="neighborhood-link">--><?php //= get_post_count_taxonomy($term->term_id, 'neighborhood', 'properties') ?><!-- Show on Map</a>-->
                            </div>
                    <?php
                        endif;
                    endforeach;
                    ?>
                    <?php wp_reset_postdata(); ?>
                </div>
            </div>
        </div>
    </div>
</div>