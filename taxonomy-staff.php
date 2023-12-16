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
?>
<div class="w-100" >
        <?php

        if ($profiles->have_posts()) :

            // Assuming $term is defined earlier in your code and is an object
            if (!empty($term) && !empty($term->name)) {
                $page_title = 'All ' . strtoupper($term->name) . 'S';
            } else {
                $page_title = 'Home Leader Realty Inc.'; // Default value
            }

            // Override the global define for a specific page
            define('CUSTOM_PAGE_HEADER', [
                'title' => $page_title,
                'subtitle' => 'Agents',
            ]);

            // Include the custom-page-header.php file
            include(HLR_THEME_COMPONENT . 'custom-page-header.php');?>

   
        <div class="container px-5 mb-5">
            <div class="row">
                <?php while ($profiles->have_posts()) : $profiles->the_post(); ?>
                    <?php include(HLR_THEME_COMPONENT . 'agents/card.php'); ?>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            </div>
        </div>
    <?php endif; ?>

</div>

<?php get_footer(); ?>