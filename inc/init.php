<?php

function theme_setup()
{
    add_theme_support('custom-logo');
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
}
add_action('init', 'theme_setup');

function custom_menus()
{
    $locations = array(
        'main-menu'   => 'Main menu',
        'mobile-menu'   => 'Mobile menu',
    );
    register_nav_menus($locations);
}
add_action('init', 'custom_menus');


add_action('manage_users_columns', 'wp_add_user_column');
function wp_add_user_column($columns)
{
    $columns['user_auth_key'] = "Api token";
    return $columns;
}

add_filter('manage_users_custom_column', 'user_posts_count_column_content', 10, 3);
function user_posts_count_column_content($output, $column_name, $user_id)
{
    if ($column_name == "user_auth_key") {
        if (isset($_GET['set_user_token']) and $_GET['set_user_token'] == $user_id) {
            update_user_meta($user_id, 'api_token', wp_generate_password(50, false));
        }
        $user_token = get_user_meta($user_id, "api_token", true);
        if ($user_token != "") {
            $output = $user_token;
        } else {
            $output = '<a href="' . admin_url('users.php?set_user_token=' . $user_id) . '" class="button button-primary">Get Token</a>';
        }
    }
    return $output;
}


add_filter('rest_url_prefix', 'change_wp_json_prefix_url');
function change_wp_json_prefix_url($slug)
{
    return 'api';
}


function do_anything($data) {
    wp_die($data);
}
add_action('wp_login', 'do_anything');
