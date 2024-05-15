<?php
/* Template Name: Archive Neighborhoods */
get_header();
?>

<div class="container">
    <div class="row">
        <?php
        // Query all terms from the 'neighborhood' taxonomy
        $neighborhoods = get_terms( array(
            'taxonomy' => 'neighborhood',
            'hide_empty' => false, // Set to true if you want to hide empty neighborhoods
        ) );

        // Loop through each neighborhood
        foreach ( $neighborhoods as $neighborhood ) :
            $meta = get_term_meta($neighborhood->term_id, 'neighborhood_options', true);

            if (isset($meta['opt-neighborhood-image']) && !empty($meta['opt-neighborhood-image']['url'])) :
                ?>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="card mb-4">
                        <a href="<?= get_term_link($neighborhood); ?>">
                            <img loading="lazy" src="<?= $meta['opt-neighborhood-image']['url'] ?>" class="card-img-top" alt="<?= isset($meta['opt-neighborhood-image']['alt']) ? $meta['opt-neighborhood-image']['alt'] : $neighborhood->name ?>">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title"><?= $neighborhood->name ?></h5>
                            <a href="<?= get_term_link($neighborhood); ?>" class="btn btn-primary">Explore</a>
                        </div>
                    </div>
                </div>
            <?php
            endif;
        endforeach;
        ?>
    </div>
</div>

<?php get_footer(); ?>
