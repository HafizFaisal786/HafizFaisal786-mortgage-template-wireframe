<?php
/* WP Simple Iconfonts support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'heaven11_wp_simple_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'heaven11_wp_simple_theme_setup9', 9 );
	function heaven11_wp_simple_theme_setup9() {

		if ( is_admin() ) {
			add_filter( 'heaven11_filter_tgmpa_required_plugins', 'heaven11_wp_simple_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'heaven11_wp_simple_tgmpa_required_plugins' ) ) {
	
	function heaven11_wp_simple_tgmpa_required_plugins( $list = array() ) {
		if ( heaven11_storage_isset( 'required_plugins', 'wp-simple-iconfonts' ) && heaven11_storage_get_array( 'required_plugins', 'wp-simple-iconfonts', 'install' ) !== false ) {
			$path = heaven11_get_plugin_source_path( 'plugins/wp-simple-iconfonts/wp-simple-iconfonts.zip' );
			if ( ! empty( $path ) || heaven11_get_theme_setting( 'tgmpa_upload' ) ) {
				$list[] = array(
					'name'     => heaven11_storage_get_array( 'required_plugins', 'wp-simple-iconfonts', 'title' ),
					'slug'     => 'wp-simple-iconfonts',
					'version'  => '0.5.1',
					'source'   => ! empty( $path ) ? $path : 'upload://wp-simple-iconfonts.zip',
					'required' => false,
				);
			}
		}
		return $list;
	}
}

// Check if plugin installed and activated
if ( ! function_exists( 'heaven11_exists_wp_simple' ) ) {
	function heaven11_exists_wp_simple() {
		return function_exists( 'wp_simple_iconfonts' ) || defined( 'WPSI_VERSION' );
	}
}
