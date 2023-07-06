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


function setTokenAfterLogin($username, $user)
{
    $user_id = $user->ID;

    $token = get_user_meta($user_id, "api_token", true);
    if (!empty($token) && isset($token)) {
        setcookie('uthlri', $token, time() + (3600 * 24), COOKIEPATH, COOKIE_DOMAIN);
    } else {
        $user_token = update_user_meta($user_id, "api_token", wp_generate_password(50, false));
        setcookie('uthlri', $user_token, time() + (3600 * 24), COOKIEPATH, COOKIE_DOMAIN);
    }
}
add_action('wp_login', 'setTokenAfterLogin', 10, 2);

add_action('init', 'setpropertiesquery');
function setpropertiesquery()
{
    $args = [
        'post_type' => 'properties',
        'post_status' => 'publish',
        'posts_per_page' => -1,
    ];

    $peroperties = new WP_Query($args);

    while ($peroperties->have_posts()) {
        $peroperties->the_post();

        $terms_ids = wp_get_object_terms( get_the_ID(), 'group', array( 'fields' => 'ids' ) );

        $items[] = [
            'id' => get_the_ID(),
            'title' => strlen(get_the_title())  > 12 ? substr(get_the_title(), 0, 12) . '...' : get_the_title(),
            'content' => strlen(strip_tags(get_the_excerpt()))  > 65 ? substr(strip_tags(get_the_excerpt()), 0, 65) . '...' : strip_tags(get_the_content()),
            'thumbnail_url' => get_the_post_thumbnail_url(),
            'term_ids' => $terms_ids,
            'metadata' => [
                'opt-min-price-sqft' => get_post_meta(get_the_ID(), 'hlr_framework_mapdata', true)['opt-min-price-sqft'],
                'opt-max-price-sqft' => get_post_meta(get_the_ID(), 'hlr_framework_mapdata', true)['opt-max-price-sqft'],
                'opt-size-min' => get_post_meta(get_the_ID(), 'hlr_framework_mapdata', true)['opt-size-min'],
                'opt-size-max' => get_post_meta(get_the_ID(), 'hlr_framework_mapdata', true)['opt-size-max'],
                'opt-size-max' => get_post_meta(get_the_ID(), 'hlr_framework_mapdata', true)['opt-size-max'],
                'opt-address' => get_post_meta(get_the_ID(), 'hlr_framework_mapdata', true)['opt-address'],
                'total_like' => get_post_meta(get_the_ID(), 'total_like', true),
            ],
        ];
    }

    wp_die(var_dump($items));
}
