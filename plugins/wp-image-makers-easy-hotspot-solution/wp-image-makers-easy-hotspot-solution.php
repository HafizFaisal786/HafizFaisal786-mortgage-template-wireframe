<?php
/* Mail Chimp support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'heaven11_wp_image_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'heaven11_wp_image_theme_setup9', 9 );
	function heaven11_wp_image_theme_setup9() {

		add_filter( 'heaven11_filter_merge_styles', 'heaven11_wp_image_merge_styles' );

		if ( is_admin() ) {
			add_filter( 'heaven11_filter_tgmpa_required_plugins', 'heaven11_wp_image_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'heaven11_wp_image_tgmpa_required_plugins' ) ) {
	
	function heaven11_wp_image_tgmpa_required_plugins( $list = array() ) {
		if ( heaven11_storage_isset( 'required_plugins', 'wp-image-makers-easy-hotspot-solution' ) && heaven11_storage_get_array( 'required_plugins', 'wp-image-makers-easy-hotspot-solution', 'install' ) !== false ) {
			$list[] = array(
				'name'     => heaven11_storage_get_array( 'required_plugins', 'wp-image-makers-easy-hotspot-solution', 'title' ),
				'slug'     => 'wp-image-makers-easy-hotspot-solution',
				'required' => false,
			);
		}
		return $list;
	}
}

// Check if plugin installed and activated
if ( ! function_exists( 'heaven11_exists_wp_image' ) ) {
	function heaven11_exists_wp_image() {
		return function_exists( 'wpim' ) || defined( 'WPIM_VERSION' );
	}
}

// Set plugin's specific importer options
if ( !function_exists( 'heaven11_wp_image_importer_set_options' ) ) {
	if (is_admin()) add_filter( 'trx_addons_filter_importer_options',    'heaven11_wp_image_importer_set_options' );
	function heaven11_wp_image_importer_set_options($options=array()) {
		if ( heaven11_exists_wp_image() && in_array('wp-image-makers-easy-hotspot-solution', $options['required_plugins']) ) {
			$options['additional_options'][]    = 'wpim_css';                    // Add slugs to export options for this plugin
		}
		return $options;
	}
}



// Custom styles and scripts
//------------------------------------------------------------------------

// Merge custom styles
if ( ! function_exists( 'heaven11_wp_image_merge_styles' ) ) {
	
	function heaven11_wp_image_merge_styles( $list ) {
		if ( heaven11_exists_wp_image() ) {
			$list[] = 'plugins/wp-image-makers-easy-hotspot-solution/_wp-image-makers-easy-hotspot-solution.scss';
		}
		return $list;
	}
}


// Add plugin-specific colors and fonts to the custom CSS
if ( heaven11_exists_wp_image() ) {
	require_once HEAVEN11_THEME_DIR . 'plugins/wp-image-makers-easy-hotspot-solution/wp-image-makers-easy-hotspot-solution-styles.php'; }

