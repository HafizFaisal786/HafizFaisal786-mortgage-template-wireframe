<?php
/* ThemeREX Updater support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'heaven11_trx_updater_theme_setup9' ) ) {
    add_action( 'after_setup_theme', 'heaven11_trx_updater_theme_setup9', 9 );
    function heaven11_trx_updater_theme_setup9() {

        if ( is_admin() ) {
            add_filter( 'heaven11_filter_tgmpa_required_plugins', 'heaven11_trx_updater_tgmpa_required_plugins' );
        }
    }
}

// Filter to add in the required plugins list
if ( ! function_exists( 'heaven11_trx_updater_tgmpa_required_plugins' ) ) {
    
    function heaven11_trx_updater_tgmpa_required_plugins( $list = array() ) {
        if ( heaven11_storage_isset( 'required_plugins', 'trx_updater' ) && heaven11_is_theme_activated() ) {
            $path = heaven11_get_plugin_source_path( 'plugins/trx_updater/trx_updater.zip' );
            if ( ! empty( $path ) || heaven11_get_theme_setting( 'tgmpa_upload' ) ) {
                $list[] = array(
                    'name'     => heaven11_storage_get_array( 'required_plugins', 'trx_updater', 'title' ),
                    'slug'     => 'trx_updater',
                    'source'   => ! empty( $path ) ? $path : 'upload://trx_updater.zip',
                    'required' => false,
                );
            }
        }
        return $list;
    }
}
// Check if plugin installed and activated
if ( ! function_exists( 'heaven11_exists_trx_updater' ) ) {
	function heaven11_exists_trx_updater() {
		return defined( 'EG_PLUGIN_PATH' );
	}
}