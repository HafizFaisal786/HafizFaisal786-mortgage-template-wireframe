<?php
/* Mail Chimp support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'heaven11_mailchimp_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'heaven11_mailchimp_theme_setup9', 9 );
	function heaven11_mailchimp_theme_setup9() {

		add_filter( 'heaven11_filter_merge_styles', 'heaven11_mailchimp_merge_styles' );

		if ( is_admin() ) {
			add_filter( 'heaven11_filter_tgmpa_required_plugins', 'heaven11_mailchimp_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'heaven11_mailchimp_tgmpa_required_plugins' ) ) {
	
	function heaven11_mailchimp_tgmpa_required_plugins( $list = array() ) {
		if ( heaven11_storage_isset( 'required_plugins', 'mailchimp-for-wp' ) && heaven11_storage_get_array( 'required_plugins', 'mailchimp-for-wp', 'install' ) !== false ) {
			$list[] = array(
				'name'     => heaven11_storage_get_array( 'required_plugins', 'mailchimp-for-wp', 'title' ),
				'slug'     => 'mailchimp-for-wp',
				'required' => false,
			);
		}
		return $list;
	}
}

// Check if plugin installed and activated
if ( ! function_exists( 'heaven11_exists_mailchimp' ) ) {
	function heaven11_exists_mailchimp() {
		return function_exists( '__mc4wp_load_plugin' ) || defined( 'MC4WP_VERSION' );
	}
}



// Custom styles and scripts
//------------------------------------------------------------------------

// Merge custom styles
if ( ! function_exists( 'heaven11_mailchimp_merge_styles' ) ) {
	
	function heaven11_mailchimp_merge_styles( $list ) {
		if ( heaven11_exists_mailchimp() ) {
			$list[] = 'plugins/mailchimp-for-wp/_mailchimp-for-wp.scss';
		}
		return $list;
	}
}


// Add plugin-specific colors and fonts to the custom CSS
if ( heaven11_exists_mailchimp() ) {
	require_once HEAVEN11_THEME_DIR . 'plugins/mailchimp-for-wp/mailchimp-for-wp-styles.php'; }

