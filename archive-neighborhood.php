<?php
/* Template Name: Archive Neighborhoods */
get_header();
?>
<style>
    .card-img-top {
        height: 230px;
        object-fit: cover;
    }
</style>
<div class="container my-5">
    <div class="row">
        <?php
        // Query all terms from the 'neighborhood' taxonomy
        $neighborhoods = get_terms(array(
            'taxonomy'   => 'neighborhood',
            'hide_empty' => false, // Set to true if you want to hide empty neighborhoods
        ));

        // Loop through each neighborhood
        foreach ($neighborhoods as $neighborhood) :
            $meta        = get_term_meta($neighborhood->term_id, 'neighborhood_options', true);
            $neighborhood_id = $neighborhood->term_id;
            // Query the number of properties for each neighborhood
            $property_count_query = new WP_Query(array(
                'post_type'      => 'property',
                'posts_per_page' => -1,
                'tax_query'      => array(
                    array(
                        'taxonomy' => 'neighborhood',
                        'field'    => 'term_id',
                        'terms'    => $neighborhood_id,
                    ),
                ),
            ));
            $property_count = $property_count_query->found_posts;
            ?>

            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card mb-4">
                    <a href="<?= get_term_link($neighborhood); ?>">
                        <?php if (isset($meta['opt-neighborhood-image']) && !empty($meta['opt-neighborhood-image']['url'])) : ?>
                            <img loading="lazy" src="<?= $meta['opt-neighborhood-image']['url'] ?>" class="card-img-top" alt="<?= isset($meta['opt-neighborhood-image']['alt']) ? $meta['opt-neighborhood-image']['alt'] : $neighborhood->name ?>">
                        <?php else : ?>
                            <img loading="lazy" src="<?= HLR_THEME_ASSETS . 'images/No-Image-Placeholder.jpg' ?>" class="card-img-top" alt="Placeholder Image">
                        <?php endif; ?>
                    </a>
                    <div class="card-body">
                        <h5 class="card-title"><?= $neighborhood->name ?></h5>
                        <p>Available Properties: <?= $property_count ?></p>
                        <?= get_post_count_taxonomy($neighborhood->id, 'neighborhood', 'properties') ?>
                        <a href="<?= get_term_link($neighborhood); ?>" class="btn btn-primary">Explore</a>
                    </div>
                </div>
            </div>
        <?php
        endforeach;
        ?>
    </div>
</div>

<?php get_footer(); ?>
