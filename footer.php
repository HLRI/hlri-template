<?php

if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'footer' ) ) {
	get_template_part( 'template-parts/footer' );
}

echo "<script>jQuery('.owl-carousel').trigger('refresh.owl.carousel');</script>";

wp_footer();

?>

