<?php
// Check if user is logged in and has the appropriate role
if (is_user_logged_in() && (current_user_can('administrator') || current_user_can('editor') || current_user_can('agent'))) :
    get_header();
    ?>
    <div class="container">
        <div class="row py-5">
            <div class="col-12">
                <div class="modal-content modal-content-login clearfix">
                    <div class="modal-body body-login">
                        <div class="card" style="width: 400px; margin: 0 auto;">
                            <div class="modal-body-login login-form">
                                <!-- Your login form HTML goes here -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <?php
                // Custom query to fetch properties
                $args = [
                    'post_type' => 'properties',
                    'posts_per_page' => 10, // Adjust as needed
                ];
                $properties_query = new WP_Query($args);

                if ($properties_query->have_posts()) :
                    while ($properties_query->have_posts()) :
                        $properties_query->the_post();
                        // Display property information here
                    endwhile;
                    wp_reset_postdata();
                else :
                    echo '<p>No properties found.</p>';
                endif;
                ?>
            </div>
        </div>
    </div>
    <?php
    get_footer();
// If user is not logged in or does not have the appropriate role, redirect to login page
else :
    wp_redirect(wp_login_url());
    exit;
endif;
?>
