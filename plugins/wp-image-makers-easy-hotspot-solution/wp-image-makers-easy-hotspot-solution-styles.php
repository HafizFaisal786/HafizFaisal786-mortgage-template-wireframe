<?php
// Add plugin-specific colors and fonts to the custom CSS
if ( ! function_exists( 'heaven11_wp_image_get_css' ) ) {
	add_filter( 'heaven11_filter_get_css', 'heaven11_wp_image_get_css', 10, 2 );
	function heaven11_wp_image_get_css( $css, $args ) {

		if ( isset( $css['colors'] ) && isset( $args['colors'] ) ) {
			$colors         = $args['colors'];
			$css['colors'] .= <<<CSS

.wpim-infowindow__inner em {
    color: {$colors['text_hover']} !important;
}
.wpim-marker .wpim-infowindow strong {
    color: {$colors['inverse_hover']} !important;
}

CSS;
		}

		return $css;
	}
}

