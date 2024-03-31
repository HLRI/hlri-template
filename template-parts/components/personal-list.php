<?php
$theme_options = get_option('hlr_framework');

// Get the hlr_framework_agents option
$agents_option = isset($theme_options['hlr_framework_agents']) ? $theme_options['hlr_framework_agents'] : array();

// Sort the agents based on the opt-agents-order field
usort($agents_option, function($a, $b) {
    return $a['opt-agents-order'] <=> $b['opt-agents-order'];
});

// Get the sorted agent IDs
$agent_ids = array_column($agents_option, 'id');

$arg = array(
    'post_type'      => 'agents',
    'post_status'    => 'publish',
    'posts_per_page' => 3,
    'post__in'       => $agent_ids, // Retrieve posts based on the sorted IDs
    'orderby'        => 'post__in', // Order by the specified IDs
);

$profiles = new WP_Query($arg);
?>


<?php if ($profiles->have_posts()) : ?>
    <div class="container-fluid my-5">
        <div class="row">
            <div class="col-lg-12 ">
                <div class="titr-list">
                    <h3 class="font-weight-bold">DEDICATED AGENTS</h3>
                    <?php if (!empty($theme_options['opt-homeleaderrealtylinkviews-agents-link']['url'])) : ?>
                        <a href="<?= $theme_options['opt-homeleaderrealtylinkviews-agents-link']['url'] ?>" title="<?= $theme_options['opt-homeleaderrealtylinkviews-agents-link']['alt'] ?>" class="view-more">View more</a>
                    <?php endif; ?>
                </div>
                <div class="d-flex justify-content-center">
                    <div class="owl-carousel owl-theme teams wrap-list">

                        <?php while ($profiles->have_posts()) : $profiles->the_post(); ?>
                             <?php include(HLR_THEME_COMPONENT . 'agents/card-mini.php'); ?>
                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>