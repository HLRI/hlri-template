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
            <?php
            $sorted_profiles = array();
            while ($profiles->have_posts()) : $profiles->the_post();
                $agent = get_post_meta(get_the_ID(), 'hlr_framework_agents', true);
                $order = $agent['opt-agents-order'];
                // Add the current agents to the sorted_profiles array with opt-agents-order as the key
                $sorted_profiles[$order] = get_post();
                ?>
                  <?php include(HLR_THEME_COMPONENT . 'agents/card.php'); ?>
            <?php endwhile;
            ksort($sorted_profiles);
            ?>
            <?php wp_reset_postdata(); ?>
        </div>
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
<?php endif; ?>