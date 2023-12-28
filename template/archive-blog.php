<?php /* Template Name: Archive Blog  */ ?>

<?php get_header() ?>

<?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$args = array(
    'post_type'   => 'post',
    'post_status' => 'publish',
    'posts_per_page'   => get_option('posts_per_page'),
    'paged' => $paged,
);
$query = new WP_Query($args);


?>
<div>
    <?php
        
        // Override the global define for a specific page
        define('CUSTOM_PAGE_HEADER', [
            'title' => "Blogs",
            'subtitle' => '',
        ]);

        // Include the custom-page-header.php file
        include(HLR_THEME_COMPONENT . 'custom-page-header.php');
        ?>
    <div class="container-lg px-5 my-5">
        <div class="row">
            <?php if ($query->have_posts()) :  ?>
                <?php while ($query->have_posts()) : $query->the_post(); ?>
                    <?php include(HLR_THEME_COMPONENT . 'blog/card.php'); ?>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            <?php endif; ?>
        </div>

        <div class="mt-5 row d-flex align-items-center justify-content-center">
            <?php
            echo paginate_links(array(
                'base'         => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                'total'        => $query->max_num_pages,
                'current'      => max(1, get_query_var('paged')),
                'format'       => '?paged=%#%',
                'show_all'     => false,
                'type'         => 'plain',
                'end_size'     => 2,
                'mid_size'     => 1,
                'prev_next'    => true,
                'prev_text'    => sprintf('<i></i> %1$s', __('Newer Posts', 'text-domain')),
                'next_text'    => sprintf('%1$s <i></i>', __('Older Posts', 'text-domain')),
                'add_args'     => false,
                'add_fragment' => '',
            ));
            ?>
        </div>
    </div>

</div>
<?php get_footer() ?>