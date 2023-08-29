<?php /* Template Name: Canvans */ ?>

<?php

$args = array(
    'post_type'      => 'properties',
    'posts_per_page' => -1,
);

$portfolio_query = new WP_Query($args);


if ($portfolio_query->have_posts()) {
    while ($portfolio_query->have_posts()) {
        $portfolio_query->the_post();

        $post_title = get_the_title();
        $thumbnail_url = get_the_post_thumbnail_url();

        $portfolio_item = array(
            'title'     => $post_title,
            'thumbnail' => $thumbnail_url,
        );

        $portfolio_data[] = $portfolio_item;
    }
}

wp_reset_postdata();

echo json_encode($portfolio_data);
