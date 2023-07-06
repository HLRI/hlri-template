<?php

function theme_setup(){
    add_theme_support('custom-logo');
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
}
add_action( 'init', 'theme_setup' );

function custom_menus() {
    $locations = array(
        'main-menu'   => 'Main menu',
        'mobile-menu'   => 'Mobile menu',
    );
    register_nav_menus( $locations );
 }
 add_action( 'init', 'custom_menus' );


 add_action('manage_users_columns','wp_add_user_column');
function wp_add_user_column($columns) {
    $columns['user_auth_key'] = "Api token";
    return $columns;
}