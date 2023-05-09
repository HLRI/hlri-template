<?php

get_header();

if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( '404' ) ) {
	get_template_part( 'template-parts/404' );
}

get_footer();