<?php
// Add plugin-specific colors and fonts to the custom CSS
if ( ! function_exists( 'heaven11_wpml_get_css' ) ) {
	add_filter( 'heaven11_filter_get_css', 'heaven11_wpml_get_css', 10, 2 );
	function heaven11_wpml_get_css( $css, $args ) {
		return $css;
	}
}

