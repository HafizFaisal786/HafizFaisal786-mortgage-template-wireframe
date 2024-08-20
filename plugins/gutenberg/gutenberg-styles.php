<?php
// Add plugin-specific vars to the custom CSS
if ( ! function_exists( 'heaven11_gutenberg_add_theme_vars' ) ) {
	add_filter( 'heaven11_filter_add_theme_vars', 'heaven11_gutenberg_add_theme_vars', 10, 2 );
	function heaven11_gutenberg_add_theme_vars( $rez, $vars ) {
		return $rez;
	}
}


// Add plugin-specific colors and fonts to the custom CSS
if ( ! function_exists( 'heaven11_gutenberg_get_css' ) ) {
	add_filter( 'heaven11_filter_get_css', 'heaven11_gutenberg_get_css', 10, 2 );
	function heaven11_gutenberg_get_css( $css, $args ) {

		if ( isset( $css['vars'] ) && isset( $args['vars'] ) ) {
			extract( $args['vars'] );
			$css['vars'] .= <<<CSS
CSS;
		}

		if ( isset( $css['fonts'] ) && isset( $args['fonts'] ) ) {
			$fonts                   = $args['fonts'];
			$fonts['p_font-family!'] = str_replace(';', ' !important;', $fonts['p_font-family']);
			$css['fonts']           .= <<<CSS
.editor-block-list__block {
	{$fonts['p_font-family!']}
	{$fonts['p_font-size']}
	{$fonts['p_font-weight']}
	{$fonts['p_font-style']}
	{$fonts['p_line-height']}
	{$fonts['p_text-decoration']}
	{$fonts['p_text-transform']}
	{$fonts['p_letter-spacing']}
}

CSS;
		}

		if ( isset( $css['colors'] ) && isset( $args['colors'] ) ) {
			$colors         = $args['colors'];
			$css['colors'] .= <<<CSS
.scheme_self.editor-block-list__layout {
	color: {$colors['text']};
	background-color: {$colors['bg_color']};
}
.scheme_self.editor-block-list__layout p {
	color: {$colors['text']};
}

/* Theme-specific colors */
.has-bg-color-color {		color: {$colors['bg_color']}; }
.has-bd-color-color {		color: {$colors['bd_color']}; }
.has-text-color {			color: {$colors['text']}; }
.has-text-light-color {		color: {$colors['text_light']}; }
.has-text-dark-color {		color: {$colors['text_dark']}; }
.has-text-link-color {		color: {$colors['text_link']}; }
.has-text-hover-color {		color: {$colors['text_hover']}; }
.has-text-link-2-color {	color: {$colors['text_link2']}; }
.has-text-hover-2-color {	color: {$colors['text_hover2']}; }
.has-text-link-3-color {	color: {$colors['text_link3']}; }
.has-text-hover-3-color {	color: {$colors['text_hover3']}; }

.has-bg-color-background-color {		background-color: {$colors['bg_color']};}
.has-bd-color-background-color {		background-color: {$colors['bd_color']}; }
.has-text-background-color {			background-color: {$colors['text']}; }
.has-text-light-background-color {		background-color: {$colors['text_light']}; }
.has-text-dark-background-color {		background-color: {$colors['text_dark']}; }
.has-text-link-background-color {		background-color: {$colors['text_link']}; }
.has-text-hover-background-color {		background-color: {$colors['text_hover']}; }
.has-text-link-2-background-color {		background-color: {$colors['text_link2']}; }
.has-text-hover-2-background-color {	background-color: {$colors['text_hover2']}; }
.has-text-link-3-background-color {		background-color: {$colors['text_link3']}; }
.has-text-hover-3-background-color {	background-color: {$colors['text_hover3']}; }

blockquote.wp-block-quote:not(.has-text-color),
blockquote.wp-block-quote:not(.has-text-color) p,
.wp-block-quote .wp-block-quote__citation {
    color: {$colors['bg_color']};
}
.widget_area .wp-block-search .wp-block-search__input {
	background-color: {$colors['bg_color']};
	border-color: {$colors['bd_color']};
}
.widget_area .wp-block-search .wp-block-search__input:hover,
.widget_area .wp-block-search .wp-block-search__input:focus {
	border-color: {$colors['input_bd_color']};
	background-color: {$colors['input_bg_hover']};
}

CSS;
		}

		return $css;
	}
}

