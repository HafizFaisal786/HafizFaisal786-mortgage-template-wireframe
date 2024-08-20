<?php
/* Contact Form 7 support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'heaven11_cf7_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'heaven11_cf7_theme_setup9', 9 );
	function heaven11_cf7_theme_setup9() {

		add_filter( 'heaven11_filter_merge_scripts', 'heaven11_cf7_merge_scripts' );
		add_filter( 'heaven11_filter_merge_styles', 'heaven11_cf7_merge_styles' );

		if ( heaven11_exists_cf7() ) {
			add_action( 'wp_enqueue_scripts', 'heaven11_cf7_frontend_scripts', 1100 );
		}

		if ( is_admin() ) {
			add_filter( 'heaven11_filter_tgmpa_required_plugins', 'heaven11_cf7_tgmpa_required_plugins' );
			add_filter( 'heaven11_filter_theme_plugins', 'heaven11_cf7_theme_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'heaven11_cf7_tgmpa_required_plugins' ) ) {
	
	function heaven11_cf7_tgmpa_required_plugins( $list = array() ) {
		if ( heaven11_storage_isset( 'required_plugins', 'contact-form-7' ) && heaven11_storage_get_array( 'required_plugins', 'contact-form-7', 'install' ) !== false ) {
			// CF7 plugin
			$list[] = array(
				'name'     => heaven11_storage_get_array( 'required_plugins', 'contact-form-7', 'title' ),
				'slug'     => 'contact-form-7',
				'required' => false,
			);
		}
		return $list;
	}
}

// Filter theme-supported plugins list
if ( ! function_exists( 'heaven11_cf7_theme_plugins' ) ) {
	
	function heaven11_cf7_theme_plugins( $list = array() ) {
		if ( ! empty( $list['contact-form-7']['group'] ) ) {
			foreach ( $list as $k => $v ) {
				if ( substr( $k, 0, 15 ) == 'contact-form-7-' ) {
					if ( empty( $v['group'] ) ) {
						$list[ $k ]['group'] = $list['contact-form-7']['group'];
					}
					if ( ! empty( $list['contact-form-7']['logo'] ) ) {
						$list[ $k ]['logo'] = strpos( $list['contact-form-7']['logo'], '//' ) !== false
												? $list['contact-form-7']['logo']
												: heaven11_get_file_url( "plugins/contact-form-7/{$list['contact-form-7']['logo']}" );
					}
				}
			}
		}
		return $list;
	}
}



// Check if cf7 installed and activated
if ( ! function_exists( 'heaven11_exists_cf7' ) ) {
	function heaven11_exists_cf7() {
		return class_exists( 'WPCF7' );
	}
}

// Enqueue custom scripts
if ( ! function_exists( 'heaven11_cf7_frontend_scripts' ) ) {
	
	function heaven11_cf7_frontend_scripts() {
		if ( heaven11_exists_cf7() ) {
			if ( heaven11_is_on( heaven11_get_theme_option( 'debug_mode' ) ) ) {
				$heaven11_url = heaven11_get_file_url( 'plugins/contact-form-7/contact-form-7.js' );
				if ( '' != $heaven11_url ) {
					wp_enqueue_script( 'heaven11-cf7', $heaven11_url, array( 'jquery' ), null, true );
				}
			}
		}
	}
}

// Merge custom scripts
if ( ! function_exists( 'heaven11_cf7_merge_scripts' ) ) {
	
	function heaven11_cf7_merge_scripts( $list ) {
		if ( heaven11_exists_cf7() ) {
			$list[] = 'plugins/contact-form-7/contact-form-7.js';
		}
		return $list;
	}
}

// Merge custom styles
if ( ! function_exists( 'heaven11_cf7_merge_styles' ) ) {
	
	function heaven11_cf7_merge_styles( $list ) {
		if ( heaven11_exists_cf7() ) {
			$list[] = 'plugins/contact-form-7/_contact-form-7.scss';
		}
		return $list;
	}
}

