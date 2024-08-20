<?php
/* Revolution Slider support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'heaven11_revslider_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'heaven11_revslider_theme_setup9', 9 );
	function heaven11_revslider_theme_setup9() {

		add_filter( 'heaven11_filter_merge_styles', 'heaven11_revslider_merge_styles' );

		if ( is_admin() ) {
			add_filter( 'heaven11_filter_tgmpa_required_plugins', 'heaven11_revslider_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'heaven11_revslider_tgmpa_required_plugins' ) ) {
	
	function heaven11_revslider_tgmpa_required_plugins( $list = array() ) {
		if ( heaven11_storage_isset( 'required_plugins', 'revslider' ) && heaven11_storage_get_array( 'required_plugins', 'revslider', 'install' ) !== false && heaven11_is_theme_activated() ) {
			$path = heaven11_get_plugin_source_path( 'plugins/revslider/revslider.zip' );
			if ( ! empty( $path ) || heaven11_get_theme_setting( 'tgmpa_upload' ) ) {
				$list[] = array(
					'name'     => heaven11_storage_get_array( 'required_plugins', 'revslider', 'title' ),
					'slug'     => 'revslider',
					'source'   => ! empty( $path ) ? $path : 'upload://revslider.zip',
					'required' => false,
				);
			}
		}
		return $list;
	}
}

// Check if RevSlider installed and activated
if ( ! function_exists( 'heaven11_exists_revslider' ) ) {
	function heaven11_exists_revslider() {
		return function_exists( 'rev_slider_shortcode' );
	}
}

// Merge custom styles
if ( ! function_exists( 'heaven11_revslider_merge_styles' ) ) {
	
	function heaven11_revslider_merge_styles( $list ) {
		if ( heaven11_exists_revslider() ) {
			$list[] = 'plugins/revslider/_revslider.scss';
		}
		return $list;
	}
}

