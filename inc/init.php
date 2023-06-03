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


 function disable_taxonomy_multiselect() {
    $taxonomy = 'city';
    $taxonomy_object = get_taxonomy($taxonomy);
    $taxonomy_object->meta_box_cb = 'post_categories_meta_box';
}
add_action('init', 'disable_taxonomy_multiselect');
