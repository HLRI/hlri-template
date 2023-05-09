<?php

get_header();

if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'home' ) ) {
	get_template_part( 'template-parts/home' );
}

get_footer();