<?php
// Check if user is logged in and has the appropriate role
if (is_user_logged_in() && (current_user_can('administrator') || current_user_can('editor') || current_user_can('agent'))) {
    get_header();
    ?>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Welcome to the Developer Archive Template</h1>
                <!-- Your content here -->
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
