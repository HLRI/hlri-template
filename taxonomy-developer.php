<?php
// Check if user is logged in and has the appropriate role
if (is_user_logged_in() && (current_user_can('administrator') || current_user_can('editor') || current_user_can('agent'))) {
    get_header();
    ?>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Welcome to the Developer Archive Template</h1>
                <h2>Property Listings</h2>
                <ul>
                    <?php
                    $args = array(
                        'post_type' => 'properties',
                        'posts_per_page' => 10, // Adjust as needed
                    );
                    $properties_query = new WP_Query($args);
                    if ($properties_query->have_posts()) :
                        while ($properties_query->have_posts()) :
                            $properties_query->the_post();
                            ?>
                            <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                        <?php
                        endwhile;
                        wp_reset_postdata();
                    else :
                        echo '<p>No properties found.</p>';
                    endif;
                    ?>
                </ul>
            </div>
        </div>
    </div>
    <?php
    get_footer();
} else {
    wp_redirect(wp_login_url());
    exit;
}
?>
