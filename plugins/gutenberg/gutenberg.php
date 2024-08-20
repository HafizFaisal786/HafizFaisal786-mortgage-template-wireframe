<?php
/* Gutenberg support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'heaven11_gutenberg_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'heaven11_gutenberg_theme_setup9', 9 );
	function heaven11_gutenberg_theme_setup9() {

		// Add wide and full blocks support
		add_theme_support( 'align-wide' );

		// Add editor styles to backend
		add_theme_support( 'editor-styles' );
		if ( ! heaven11_get_theme_setting( 'gutenberg_add_context' ) ) {
			add_editor_style( heaven11_get_file_url( 'plugins/gutenberg/gutenberg-preview.css' ) );
		}

		// Uncomment next rows if you want to enable/disable some features
		
		
		

		add_filter( 'heaven11_filter_merge_styles', 'heaven11_gutenberg_merge_styles' );
		add_filter( 'heaven11_filter_merge_styles_responsive', 'heaven11_gutenberg_merge_styles_responsive' );
		add_action( 'enqueue_block_editor_assets', 'heaven11_gutenberg_editor_scripts' );
		add_filter( 'heaven11_filter_localize_script_admin',	'heaven11_gutenberg_localize_script');
		add_action( 'after_setup_theme', 'heaven11_gutenberg_add_editor_colors' );
		if ( is_admin() ) {
			add_filter( 'heaven11_filter_tgmpa_required_plugins', 'heaven11_gutenberg_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'heaven11_gutenberg_tgmpa_required_plugins' ) ) {
	
	function heaven11_gutenberg_tgmpa_required_plugins( $list = array() ) {
		if ( heaven11_storage_isset( 'required_plugins', 'gutenberg' ) && heaven11_storage_get_array( 'required_plugins', 'gutenberg', 'install' ) !== false ) {
			if ( version_compare( get_bloginfo( 'version' ), '5.0', '<' ) ) {
				$list[] = array(
					'name'     => heaven11_storage_get_array( 'required_plugins', 'gutenberg', 'title' ),
					'slug'     => 'gutenberg',
					'required' => false,
				);
			}
		}
		return $list;
	}
}

// Check if Gutenberg is installed and activated
if ( ! function_exists( 'heaven11_exists_gutenberg' ) ) {
	function heaven11_exists_gutenberg() {
		return function_exists( 'register_block_type' );	
	}
}

// Return true if Gutenberg exists and current mode is preview
if ( ! function_exists( 'heaven11_gutenberg_is_preview' ) ) {
	function heaven11_gutenberg_is_preview() {
		return false;
	}
}

// Merge custom styles
if ( ! function_exists( 'heaven11_gutenberg_merge_styles' ) ) {
	
	function heaven11_gutenberg_merge_styles( $list ) {
		if ( heaven11_exists_gutenberg() ) {
			$list[] = 'plugins/gutenberg/_gutenberg.scss';
		}
		return $list;
	}
}

// Merge responsive styles
if ( ! function_exists( 'heaven11_gutenberg_merge_styles_responsive' ) ) {
	
	function heaven11_gutenberg_merge_styles_responsive( $list ) {
		if ( heaven11_exists_gutenberg() ) {
			$list[] = 'plugins/gutenberg/_gutenberg-responsive.scss';
		}
		return $list;
	}
}


// Load required styles and scripts for Gutenberg Editor mode
if ( ! function_exists( 'heaven11_gutenberg_editor_scripts' ) ) {
	
	function heaven11_gutenberg_editor_scripts() {
		heaven11_admin_scripts(true);
		heaven11_admin_localize_scripts();
		// Editor styles
		if ( heaven11_get_theme_setting( 'gutenberg_add_context' ) ) {
			wp_enqueue_style( 'heaven11-gutenberg-preview', heaven11_get_file_url( 'plugins/gutenberg/gutenberg-preview.css' ), array(), null );
		}
		// Editor scripts
		wp_enqueue_script( 'heaven11-gutenberg-preview', heaven11_get_file_url( 'plugins/gutenberg/gutenberg-preview.js' ), array( 'jquery' ), null, true );
	}
}

// Add plugin's specific variables to the scripts
if ( ! function_exists( 'heaven11_gutenberg_localize_script' ) ) {
	
	function heaven11_gutenberg_localize_script( $arr ) {
		$arr['color_scheme']  = heaven11_get_theme_option( 'color_scheme' );
		return $arr;
	}
}

// Save CSS with custom colors and fonts to the gutenberg-editor-style.css
if ( ! function_exists( 'heaven11_gutenberg_save_css' ) ) {
	add_action( 'heaven11_action_save_options', 'heaven11_gutenberg_save_css', 30 );
	add_action( 'trx_addons_action_save_options', 'heaven11_gutenberg_save_css', 30 );
	function heaven11_gutenberg_save_css() {

		$msg = '/* ' . esc_html__( "ATTENTION! This file was generated automatically! Don't change it!!!", 'heaven11' )
				. "\n----------------------------------------------------------------------- */\n";

		// Get main styles
		$css = heaven11_fgc( heaven11_get_file_dir( 'style.css' ) );

		// Append theme-vars styles
		$css .= heaven11_customizer_get_css(
			array(
				'colors' => heaven11_get_theme_setting( 'separate_schemes' ) ? false : null,
			)
		);
		
		// Append color schemes
		if ( heaven11_get_theme_setting( 'separate_schemes' ) ) {
			$schemes = heaven11_get_sorted_schemes();
			if ( is_array( $schemes ) ) {
				foreach ( $schemes as $scheme => $data ) {
					$css .= heaven11_customizer_get_css(
						array(
							'fonts'  => false,
							'colors' => $data['colors'],
							'scheme' => $scheme,
						)
					);
				}
			}
		}

		// Add context class to each selector
		if ( heaven11_get_theme_setting( 'gutenberg_add_context' ) && function_exists( 'trx_addons_css_add_context' ) ) {
			$css = trx_addons_css_add_context(
						$css,
						array(
							'context' => '.edit-post-visual-editor ',
							'context_self' => array( 'html', 'body', '.edit-post-visual-editor' )
							)
					);
		} else {
			$css = apply_filters( 'heaven11_filter_prepare_css', $css );
		}

		// Save styles to the file
		heaven11_fpc( heaven11_get_file_dir( 'plugins/gutenberg/gutenberg-preview.css' ), $msg . $css );
	}
}


// Add theme-specific colors to the Gutenberg color picker
if ( ! function_exists( 'heaven11_gutenberg_add_editor_colors' ) ) {
	//Hamdler of the add_action( 'after_setup_theme', 'heaven11_gutenberg_add_editor_colors' );
	function heaven11_gutenberg_add_editor_colors() {
		$scheme = heaven11_get_scheme_colors();
		$groups = heaven11_storage_get( 'scheme_color_groups' );
		$names  = heaven11_storage_get( 'scheme_color_names' );
		$colors = array();
		foreach( $groups as $g => $group ) {
			foreach( $names as $n => $name ) {
				$c = 'main' == $g ? $n : $g . '_' . str_replace( 'text_', '', $n );
				if ( isset( $scheme[ $c ] ) ) {
					$colors[] = array(
						'name'  => ( 'main' == $g ? '' : $group['title'] . ' ' ) . $name['title'],
						'slug'  => $c,
						'color' => $scheme[ $c ]
					);
				}
			}
			// Add only one group of colors
			// Delete next condition (or add false && to them) to add all groups
			if ( 'main' == $g ) {
				break;
			}
		}
		add_theme_support( 'editor-color-palette', $colors );
	}
}

// Add plugin-specific colors and fonts to the custom CSS
if ( heaven11_exists_gutenberg() ) {
	require_once HEAVEN11_THEME_DIR . 'plugins/gutenberg/gutenberg-styles.php';
}
