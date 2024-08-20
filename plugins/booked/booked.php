<?php
/* Booked Appointments support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'heaven11_booked_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'heaven11_booked_theme_setup9', 9 );
	function heaven11_booked_theme_setup9() {
		add_filter( 'heaven11_filter_merge_styles', 'heaven11_booked_merge_styles' );
		if ( is_admin() ) {
			add_filter( 'heaven11_filter_tgmpa_required_plugins', 'heaven11_booked_tgmpa_required_plugins' );
			add_filter( 'heaven11_filter_theme_plugins', 'heaven11_booked_theme_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'heaven11_booked_tgmpa_required_plugins' ) ) {
	
	function heaven11_booked_tgmpa_required_plugins( $list = array() ) {
		if ( heaven11_storage_isset( 'required_plugins', 'booked' ) && heaven11_storage_get_array( 'required_plugins', 'booked', 'install' ) !== false && heaven11_is_theme_activated() ) {
			$path = heaven11_get_plugin_source_path( 'plugins/booked/booked.zip' );
			if ( ! empty( $path ) || heaven11_get_theme_setting( 'tgmpa_upload' ) ) {
				$list[] = array(
					'name'     => heaven11_storage_get_array( 'required_plugins', 'booked', 'title' ),
					'slug'     => 'booked',
					'source'   => ! empty( $path ) ? $path : 'upload://booked.zip',
					'required' => false,
				);
			}
		}
		return $list;
	}
}

// Filter theme-supported plugins list
if ( ! function_exists( 'heaven11_booked_theme_plugins' ) ) {
	
	function heaven11_booked_theme_plugins( $list = array() ) {
		if ( ! empty( $list['booked']['group'] ) ) {
			foreach ( $list as $k => $v ) {
				if ( substr( $k, 0, 6 ) == 'booked' ) {
					if ( empty( $v['group'] ) ) {
						$list[ $k ]['group'] = $list['booked']['group'];
					}
					if ( ! empty( $list['booked']['logo'] ) ) {
						$list[ $k ]['logo'] = strpos( $list['booked']['logo'], '//' ) !== false
												? $list['booked']['logo']
												: heaven11_get_file_url( "plugins/booked/{$list['booked']['logo']}" );
					}
				}
			}
		}
		return $list;
	}
}



// Check if plugin installed and activated
if ( ! function_exists( 'heaven11_exists_booked' ) ) {
	function heaven11_exists_booked() {
		return class_exists( 'booked_plugin' );
	}
}

// Merge custom styles
if ( ! function_exists( 'heaven11_booked_merge_styles' ) ) {
	
	function heaven11_booked_merge_styles( $list ) {
		if ( heaven11_exists_booked() ) {
			$list[] = 'plugins/booked/_booked.scss';
		}
		return $list;
	}
}


// Add plugin-specific colors and fonts to the custom CSS
if ( heaven11_exists_booked() ) {
	require_once HEAVEN11_THEME_DIR . 'plugins/booked/booked-styles.php'; }

