<?php


if (  function_exists( 'elementor_theme_do_location' ) ||  elementor_theme_do_location( 'header' ) ) {
	wp_head();
}

if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'header' ) ) {
	get_template_part( 'template-parts/header' );
}