<?php
get_header();

if (is_home()) {
    if (!function_exists('elementor_theme_do_location') || !elementor_theme_do_location('home')) {
        get_template_part('template-parts/home');
    }
} else if (is_archive() || is_search()) {
    if (!function_exists('elementor_theme_do_location') || !elementor_theme_do_location('archive')) {
        get_template_part('template-parts/archive');
    }
} else if (is_singular()) {
    if (!function_exists('elementor_theme_do_location') || !elementor_theme_do_location('single')) {
        get_template_part('template-parts/single');
    }
} else {
    if (!function_exists('elementor_theme_do_location') || !elementor_theme_do_location('404')) {
        get_template_part('template-parts/404');
    }
}

get_footer();
