<?php /* Template Name: Archive Agents */ ?>

<?php get_header(); ?>

<?php

$term = get_queried_object();

$arg = [
    'post_type' => 'agents',
    'post_status' => 'publish',
    'posts_per_page'   => get_option('posts_per_page'),
    'paged' => $paged,
];

$profiles = new WP_Query($arg);

if ($profiles->have_posts()) : ?>
    <div class="container-fluid px-5 my-5">
        <div class="row">
            <?php while ($profiles->have_posts()) : $profiles->the_post(); ?>
                <div class="col-6 col-sm-4 col-md-4 col-lg-2 px-2">
                    <div class="card-teams">
                        <div class="job-position"><?php the_terms(get_the_ID(), 'staff', '', ' / ', ' ') ?></div>
                        <?php the_post_thumbnail() ?>
                        <a href="<?= get_the_permalink() ?>" title="<?php the_title() ?>"><?php the_title() ?></a>
                    </div>
                </div>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>

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
<?php endif; ?>
<?php get_footer(); ?>