<?php
/**
 * Skins support: Main skin file for the skin 'Default'
 *
 * Setup skin-dependent fonts and colors, load scripts and styles,
 * and other operations that affect the appearance and behavior of the theme
 * when the skin is activated
 *
 * @package WordPress
 * @subpackage HEAVEN11
 * @since HEAVEN11 1.0.46
 */


// Theme init priorities:
// 3 - add/remove Theme Options elements
if ( ! function_exists( 'heaven11_skin_theme_setup3' ) ) {
	add_action( 'after_setup_theme', 'heaven11_skin_theme_setup3', 3 );
	function heaven11_skin_theme_setup3() {
		// ToDo: Add / Modify theme options, color schemes, required plugins, etc.
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'heaven11_skin_tgmpa_required_plugins' ) ) {
	add_filter( 'heaven11_filter_tgmpa_required_plugins', 'heaven11_skin_tgmpa_required_plugins' );
	function heaven11_skin_tgmpa_required_plugins( $list = array() ) {
		// ToDo: Check if plugin is in the 'required_plugins' and add his parameters to the TGMPA-list
		//       Replace 'skin-specific-plugin-slug' to the real slug of the plugin
		if ( heaven11_storage_isset( 'required_plugins', 'skin-specific-plugin-slug' ) ) {
			$list[] = array(
				'name'     => heaven11_storage_get_array( 'required_plugins', 'skin-specific-plugin-slug', 'title' ),
				'slug'     => 'skin-specific-plugin-slug',
				'required' => false,
			);
		}
		return $list;
	}
}

// Enqueue skin-specific styles and scripts
// Priority 1150 - after plugins-specific (1100), but before child theme (1200)
if ( ! function_exists( 'heaven11_skin_frontend_scripts' ) ) {
	add_action( 'wp_enqueue_scripts', 'heaven11_skin_frontend_scripts', 1150 );
	function heaven11_skin_frontend_scripts() {
		$heaven11_url = heaven11_get_file_url( HEAVEN11_SKIN_DIR . 'skin.css' );
		if ( '' != $heaven11_url ) {
			wp_enqueue_style( 'heaven11-skin-' . esc_attr( HEAVEN11_SKIN_NAME ), $heaven11_url, array(), null );
		}
		if ( heaven11_is_on( heaven11_get_theme_option( 'debug_mode' ) ) ) {
			$heaven11_url = heaven11_get_file_url( HEAVEN11_SKIN_DIR . 'skin.js' );
			if ( '' != $heaven11_url ) {
				wp_enqueue_script( 'heaven11-skin-' . esc_attr( HEAVEN11_SKIN_NAME ), $heaven11_url, array( 'jquery' ), null, true );
			}
		}
	}
}

// Enqueue skin-specific responsive styles
// Priority 2050 - after theme responsive 2000
if ( ! function_exists( 'heaven11_skin_styles_responsive' ) ) {
	add_action( 'wp_enqueue_scripts', 'heaven11_skin_styles_responsive', 2050 );
	function heaven11_skin_styles_responsive() {
		$heaven11_url = heaven11_get_file_url( HEAVEN11_SKIN_DIR . 'skin-responsive.css' );
		if ( '' != $heaven11_url ) {
			wp_enqueue_style( 'heaven11-skin-' . esc_attr( HEAVEN11_SKIN_NAME ) . '-responsive', $heaven11_url, array(), null );
		}
	}
}

// Merge custom scripts
if ( ! function_exists( 'heaven11_skin_merge_scripts' ) ) {
	add_filter( 'heaven11_filter_merge_scripts', 'heaven11_skin_merge_scripts' );
	function heaven11_skin_merge_scripts( $list ) {
		if ( heaven11_get_file_dir( HEAVEN11_SKIN_DIR . 'skin.js' ) != '' ) {
			$list[] = HEAVEN11_SKIN_DIR . 'skin.js';
		}
		return $list;
	}
}

// Set theme specific importer options
if ( ! function_exists( 'heaven11_skin_importer_set_options' ) ) {
	add_filter('trx_addons_filter_importer_options', 'heaven11_skin_importer_set_options', 9);
	function heaven11_skin_importer_set_options($options = array()) {
		if ( is_array( $options ) ) {
			$options['demo_type'] = 'default';
			$options['files']['default'] = $options['files']['default'];
			$options['files']['default']['title'] = esc_html__('Default', 'heaven11');
			$options['files']['default']['domain_demo'] = esc_url( 'http://heaven11.axiomthemes.com' );   // Demo-site domain
			
		}
		return $options;
	}
}

// Add slin-specific colors and fonts to the custom CSS
require_once HEAVEN11_THEME_DIR . HEAVEN11_SKIN_DIR . 'skin-styles.php';
