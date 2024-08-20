<?php
// Add skin-specific colors and fonts to the custom CSS
if ( ! function_exists( 'heaven11_skin_get_css' ) ) {
	add_filter( 'heaven11_filter_get_css', 'heaven11_skin_get_css', 10, 2 );
	function heaven11_skin_get_css( $css, $args ) {

		if ( isset( $css['fonts'] ) && isset( $args['fonts'] ) ) {
			$fonts         = $args['fonts'];
			$css['fonts'] .= <<<CSS

CSS;
		}

		if ( isset( $css['vars'] ) && isset( $args['vars'] ) ) {
			$vars         = $args['vars'];
			$css['vars'] .= <<<CSS

CSS;
		}

		if ( isset( $css['colors'] ) && isset( $args['colors'] ) ) {
			$colors         = $args['colors'];
			$css['colors'] .= <<<CSS
			
/* Events */
.tribe-common--breakpoint-medium.tribe-events .tribe-events-c-search__button:hover {
	color: {$colors['inverse_link']};
	background-color: {$colors['text_hover']};	
}
.tribe-common--breakpoint-medium.tribe-events .tribe-events-c-search__button:hover {
	color: {$colors['inverse_link']};
	background-color: {$colors['text_hover']};	
}

CSS;

		}

		return $css;
	}
}

