<?php $theme_options = get_option('hlr_framework'); ?>

<?php
$arg = [
    'post_type' => 'agents',
    'post_status' => 'publish',
    'posts_per_page' => -1
];

$profiles = new WP_Query($arg);

?>
<?php if ($profiles->have_posts()) : ?>
<?php     $sorted_profiles = array();
?>
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
                        <?php
                        // Initialize an array to store posts sorted by opt-agents-order
                        $sorted_profiles = array();

                        // Start the loop to populate the sorted_profiles array
                        while ($profiles->have_posts()) : $profiles->the_post();
                            // Retrieve the opt-agents-order value for the current post
                            $agent = get_post_meta(get_the_ID(), 'hlr_framework_agents', true);
                            $order = $agent['opt-agents-order'];

                            // Add the current post to the sorted_profiles array with opt-agents-order as the key
                            $sorted_profiles[$order] = get_post();
                        endwhile;

                        // Sort the sorted_profiles array based on opt-agents-order
                        ksort($sorted_profiles);

                        // Loop through sorted_profiles to display the posts
                        foreach ($sorted_profiles as $post) :
                            setup_postdata($post);
                            // Include your template part here
                            include(HLR_THEME_COMPONENT . 'agents/card-mini.php');
                        endforeach;

                        // Restore original post data
                        wp_reset_postdata();
                        ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
<?php endif; ?>