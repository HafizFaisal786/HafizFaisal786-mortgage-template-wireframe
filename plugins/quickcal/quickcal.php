<?php
/* QuickCal support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'heaven11_quickcal_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'heaven11_quickcal_theme_setup9', 9 );
	function heaven11_quickcal_theme_setup9() {
		add_filter( 'heaven11_filter_merge_styles', 'heaven11_quickcal_merge_styles' );
		if ( is_admin() ) {
			add_filter( 'heaven11_filter_tgmpa_required_plugins', 'heaven11_quickcal_tgmpa_required_plugins' );
			add_filter( 'heaven11_filter_theme_plugins', 'heaven11_quickcal_theme_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'heaven11_quickcal_tgmpa_required_plugins' ) ) {
	
	function heaven11_quickcal_tgmpa_required_plugins( $list = array() ) {
		if ( heaven11_storage_isset( 'required_plugins', 'quickcal' ) && heaven11_storage_get_array( 'required_plugins', 'quickcal', 'install' ) !== false && heaven11_is_theme_activated() ) {
			$path = heaven11_get_plugin_source_path( 'plugins/quickcal/quickcal.zip' );
			if ( ! empty( $path ) || heaven11_get_theme_setting( 'tgmpa_upload' ) ) {
				$list[] = array(
					'name'     => heaven11_storage_get_array( 'required_plugins', 'quickcal', 'title' ),
					'slug'     => 'quickcal',
					'source'   => ! empty( $path ) ? $path : 'upload://quickcal.zip',
					'required' => false,
				);
			}
		}
		return $list;
	}
}

// Filter theme-supported plugins list
if ( ! function_exists( 'heaven11_quickcal_theme_plugins' ) ) {
	
	function heaven11_quickcal_theme_plugins( $list = array() ) {
		if ( ! empty( $list['quickcal']['group'] ) ) {
			foreach ( $list as $k => $v ) {
				if ( substr( $k, 0, 6 ) == 'quickcal' ) {
					if ( empty( $v['group'] ) ) {
						$list[ $k ]['group'] = $list['quickcal']['group'];
					}
					if ( ! empty( $list['quickcal']['logo'] ) ) {
						$list[ $k ]['logo'] = strpos( $list['quickcal']['logo'], '//' ) !== false
												? $list['quickcal']['logo']
												: heaven11_get_file_url( "plugins/quickcal/{$list['quickcal']['logo']}" );
					}
				}
			}
		}
		return $list;
	}
}



// Check if plugin installed and activated
if ( ! function_exists( 'heaven11_exists_quickcal' ) ) {
	function heaven11_exists_quickcal() {
		return class_exists( 'quickcal_plugin' );
	}
}

// Merge custom styles
if ( ! function_exists( 'heaven11_quickcal_merge_styles' ) ) {
	
	function heaven11_quickcal_merge_styles( $list ) {
		if ( heaven11_exists_quickcal() ) {
			$list[] = 'plugins/quickcal/_quickcal.scss';
		}
		return $list;
	}
}


// Add plugin-specific colors and fonts to the custom CSS
if ( heaven11_exists_quickcal() ) {
	require_once HEAVEN11_THEME_DIR . 'plugins/quickcal/quickcal-styles.php'; }

