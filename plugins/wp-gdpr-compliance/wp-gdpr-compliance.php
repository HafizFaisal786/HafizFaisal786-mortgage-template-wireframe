<?php
/* Cookie Information support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'heaven11_wp_gdpr_compliance_feed_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'heaven11_wp_gdpr_compliance_theme_setup9', 9 );
	function heaven11_wp_gdpr_compliance_theme_setup9() {
		if ( is_admin() ) {
			add_filter( 'heaven11_filter_tgmpa_required_plugins', 'heaven11_wp_gdpr_compliance_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'heaven11_wp_gdpr_compliance_tgmpa_required_plugins' ) ) {
	
	function heaven11_wp_gdpr_compliance_tgmpa_required_plugins( $list = array() ) {
		if ( heaven11_storage_isset( 'required_plugins', 'wp-gdpr-compliance' ) && heaven11_storage_get_array( 'required_plugins', 'wp-gdpr-compliance', 'install' ) !== false ) {
			$list[] = array(
				'name'     => heaven11_storage_get_array( 'required_plugins', 'wp-gdpr-compliance', 'title' ),
				'slug'     => 'wp-gdpr-compliance',
				'required' => false,
			);
		}
		return $list;
	}
}

// Check if this plugin installed and activated
if ( ! function_exists( 'heaven11_exists_wp_gdpr_compliance' ) ) {
	function heaven11_exists_wp_gdpr_compliance() {
		return class_exists( 'WPGDPRC\WPGDPRC' );
	}
}

// Add hack on page 404 to prevent error message
if ( !function_exists( 'heaven11_wp_gdpr_compliance_create_empty_post_on_404' ) ) {
	add_action( 'wp', 'heaven11_wp_gdpr_compliance_create_empty_post_on_404', 1);
	function heaven11_wp_gdpr_compliance_create_empty_post_on_404() {
		if (heaven11_exists_wp_gdpr_compliance() && !isset($GLOBALS['post'])) {
			$GLOBALS['post'] = new stdClass();
			$GLOBALS['post']->ID = 0;
			$GLOBALS['post']->post_type = 'unknown';
			$GLOBALS['post']->post_content = '';
		}
	}
}
