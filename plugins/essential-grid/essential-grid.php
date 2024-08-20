<?php
/* Essential Grid support functions
------------------------------------------------------------------------------- */


// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'heaven11_essential_grid_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'heaven11_essential_grid_theme_setup9', 9 );
	function heaven11_essential_grid_theme_setup9() {

		add_filter( 'heaven11_filter_merge_styles', 'heaven11_essential_grid_merge_styles' );

		if ( is_admin() ) {
			add_filter( 'heaven11_filter_tgmpa_required_plugins', 'heaven11_essential_grid_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'heaven11_essential_grid_tgmpa_required_plugins' ) ) {
	
	function heaven11_essential_grid_tgmpa_required_plugins( $list = array() ) {
		if ( heaven11_storage_isset( 'required_plugins', 'essential-grid' ) && heaven11_storage_get_array( 'required_plugins', 'essential-grid', 'install' ) !== false && heaven11_is_theme_activated() ) {
			$path = heaven11_get_plugin_source_path( 'plugins/essential-grid/essential-grid.zip' );
			if ( ! empty( $path ) || heaven11_get_theme_setting( 'tgmpa_upload' ) ) {
				$list[] = array(
					'name'     => heaven11_storage_get_array( 'required_plugins', 'essential-grid', 'title' ),
					'slug'     => 'essential-grid',
					'source'   => ! empty( $path ) ? $path : 'upload://essential-grid.zip',
					'required' => false,
				);
			}
		}
		return $list;
	}
}

// Check if plugin installed and activated
if ( ! function_exists( 'heaven11_exists_essential_grid' ) ) {
	function heaven11_exists_essential_grid() {
		return defined('EG_PLUGIN_PATH') || defined( 'ESG_PLUGIN_PATH' );
	}
}

// Merge custom styles
if ( ! function_exists( 'heaven11_essential_grid_merge_styles' ) ) {
	
	function heaven11_essential_grid_merge_styles( $list ) {
		if ( heaven11_exists_essential_grid() ) {
			$list[] = 'plugins/essential-grid/_essential-grid.scss';
		}
		return $list;
	}
}

