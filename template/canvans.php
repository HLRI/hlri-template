<?php /* Template Name: Canvans */ ?>

<?php /* Template Name: Api */ ?>
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


<html <?php language_attributes(); ?>>

<head>
<meta charset="<?php bloginfo('charset') ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head() ?>
</head>

<body <?php body_class(); ?>>
<?php the_content(); ?>
<?php wp_footer() ?>
</body>

</html>
