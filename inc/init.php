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
    // Replace "taxonomy_name" with the actual name of your taxonomy
    $taxonomy = 'city';

    // Replace "post" with the appropriate post type if the taxonomy is not associated with the "post" post type
    remove_meta_box('tagsdiv-' . $taxonomy, 'peroperties', 'normal');
    add_meta_box('tagsdiv-' . $taxonomy, $taxonomy, 'post_categories_meta_box', 'peroperties', 'side', 'core');
}
add_action('admin_menu', 'disable_taxonomy_multiselect');
