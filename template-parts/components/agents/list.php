<?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$term = get_queried_object();

$arg = [
    'post_type' => 'agents',
    'post_status' => 'publish',
    'posts_per_page'   => get_option('posts_per_page'),
    'paged' => $paged,
];

$profiles = new WP_Query($arg);

if ($profiles->have_posts()) : ?>
    <div class="container-fluid px-5 mt-10">
        <div class="row">
            <?php while ($profiles->have_posts()) : $profiles->the_post(); ?>
                <div class="col-12 col-sm-12 col-md-6 col-lg-4 px-2" >
                  <?php include(HLR_THEME_COMPONENT . 'agents/card.php'); ?>
                </div>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>

            <div class="mt-5 row d-flex align-items-center justify-content-center">
                <?php
                echo paginate_links(array(
                    'base'         => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                    'total'        => $profiles->max_num_pages,
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
<?php endif; ?>