<?php get_header(); ?>

<?php

$term = get_queried_object();

$arg = [
    'post_type' => 'agents',
    'post_status' => 'publish',
    'posts_per_page' => 12,
    'tax_query' => array(
        array(
            'taxonomy' => $term->taxonomy,
            'field' => 'slug',
            'terms' => $term->slug,
        )
    ),
];

$profiles = new WP_Query($arg);

if ($profiles->have_posts()) : ?>
    <div class="container-fluid px-5 my-5">
        <div class="row">
            <div class="col-12 px-2">
                <div class="titr-list ml-0 mb-2">
                    <h3 class="font-weight-bold">All <?= strtoupper($term->name) . 'S' ?></h3>
                </div>
            </div>
            <?php while ($profiles->have_posts()) : $profiles->the_post(); ?>
                <div class="col-6 col-sm-4 col-md-4 col-lg-2 px-2">
                    <div class="card-teams">
                        <div class="job-position"><?php the_terms(get_the_ID(), 'staff', '', ' / ', ' ') ?></div>
                        <?php the_post_thumbnail('normal', ['loading' => 'lazy']) ?>
                        <a href="<?= get_the_permalink() ?>" title="<?php the_title() ?>"><?php the_title() ?></a>
                    </div>
                </div>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>

        </div>
    </div>
<?php endif; ?>
<?php get_footer(); ?>