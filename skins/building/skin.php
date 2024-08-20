<?php
/**
 * Skins support: Main skin file for the skin 'Building'
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
		// ToDo: Add / Modify theme options, required plugins, etc.

		heaven11_storage_set(
			'load_fonts', array(
				// Google font
				array(
					'name'   => 'Roboto',
					'family' => 'sans-serif',
					'styles' => '300,300italic,400,400italic,700,700italic,900',     // Parameter 'style' used only for the Google fonts
				),
				array(
					'name'   => 'Vidaloka',
					'family' => 'serif',
					'styles' => '400',     // Parameter 'style' used only for the Google fonts
				),
				array(
					'name'   => 'Roboto Condensed',
					'family' => 'sans-serif',
					'styles' => '300,400,700',     // Parameter 'style' used only for the Google fonts
				),
			)
		);

		// Characters subset for the Google fonts. Available values are: latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese
		heaven11_storage_set( 'load_fonts_subset', 'latin,latin-ext' );

		heaven11_storage_set(
			'theme_fonts', array(
				'p'       => array(
					'title'           => esc_html__( 'Main text', 'heaven11' ),
					'description'     => esc_html__( 'Font settings of the main text of the site. Attention! For correct display of the site on mobile devices, use only units "rem", "em" or "ex"', 'heaven11' ),
					'font-family'     => '"Roboto",sans-serif',
					'font-size'       => '1rem',
					'font-weight'     => '400',
					'font-style'      => 'normal',
					'line-height'     => '1.625rem',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '',
					'margin-top'      => '0em',
					'margin-bottom'   => '1.5em',
				),
				'h1'      => array(
					'title'           => esc_html__( 'Heading 1', 'heaven11' ),
					'font-family'     => '"Vidaloka",sans-serif',
					'font-size'       => '5.625rem',
					'font-weight'     => '400',
					'font-style'      => 'normal',
					'line-height'     => '5.813rem',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '-2.25px',
					'margin-top'      => '1.18em',
					'margin-bottom'   => '0.7833em',
				),
				'h2'      => array(
					'title'           => esc_html__( 'Heading 2', 'heaven11' ),
					'font-family'     => '"Vidaloka",sans-serif',
					'font-size'       => '5rem',
					'font-weight'     => '400',
					'font-style'      => 'normal',
					'line-height'     => '4.688rem',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '-2px',
					'margin-top'      => '0.9952em',
					'margin-bottom'   => '0.82em',
				),
				'h3'      => array(
					'title'           => esc_html__( 'Heading 3', 'heaven11' ),
					'font-family'     => '"Vidaloka",sans-serif',
					'font-size'       => '3.75rem',
					'font-weight'     => '400',
					'font-style'      => 'normal',
					'line-height'     => '3.75rem',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '-1.5px',
					'margin-top'      => '1.25em',
					'margin-bottom'   => '0.8879em',
				),
				'h4'      => array(
					'title'           => esc_html__( 'Heading 4', 'heaven11' ),
					'font-family'     => '"Vidaloka",sans-serif',
					'font-size'       => '2.813rem',
					'font-weight'     => '400',
					'font-style'      => 'normal',
					'line-height'     => '2.813rem',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '-1.13px',
					'margin-top'      => '1.47em',
					'margin-bottom'   => '1.1em',
				),
				'h5'      => array(
					'title'           => esc_html__( 'Heading 5', 'heaven11' ),
					'font-family'     => '"Vidaloka",sans-serif',
					'font-size'       => '2.25rem',
					'font-weight'     => '400',
					'font-style'      => 'normal',
					'line-height'     => '2.5rem',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '-0.9px',
					'margin-top'      => '1.5em',
					'margin-bottom'   => '1em',
				),
				'h6'      => array(
					'title'           => esc_html__( 'Heading 6', 'heaven11' ),
					'font-family'     => '"Vidaloka",sans-serif',
					'font-size'       => '1.625rem',
					'font-weight'     => '400',
					'font-style'      => 'normal',
					'line-height'     => '1.875rem',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '-0.65px',
					'margin-top'      => '1.6706em',
					'margin-bottom'   => '1.1412em',
				),
				'logo'    => array(
					'title'           => esc_html__( 'Logo text', 'heaven11' ),
					'description'     => esc_html__( 'Font settings of the text case of the logo', 'heaven11' ),
					'font-family'     => '"Vidaloka",sans-serif',
					'font-size'       => '1.8em',
					'font-weight'     => '400',
					'font-style'      => 'normal',
					'line-height'     => '1.25em',
					'text-decoration' => 'none',
					'text-transform'  => 'uppercase',
					'letter-spacing'  => '1px',
				),
				'button'  => array(
					'title'           => esc_html__( 'Buttons', 'heaven11' ),
					'font-family'     => '"Roboto Condensed",sans-serif',
					'font-size'       => '13px',
					'font-weight'     => '600',
					'font-style'      => 'normal',
					'line-height'     => '1.5rem',
					'text-decoration' => 'none',
					'text-transform'  => 'uppercase',
					'letter-spacing'  => '0.8px',
				),
				'input'   => array(
					'title'           => esc_html__( 'Input fields', 'heaven11' ),
					'description'     => esc_html__( 'Font settings of the input fields, dropdowns and textareas', 'heaven11' ),
					'font-family'     => 'inherit',
					'font-size'       => '14px',
					'font-weight'     => '500',
					'font-style'      => 'normal',
					'line-height'     => '1.5rem', // Attention! Firefox don't allow line-height less then 1.5em in the select
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0px',
				),
				'info'    => array(
					'title'           => esc_html__( 'Post meta', 'heaven11' ),
					'description'     => esc_html__( 'Font settings of the post meta: date, counters, share, etc.', 'heaven11' ),
					'font-family'     => '"Roboto Condensed",sans-serif',
					'font-size'       => '14px',  // Old value '13px' don't allow using 'font zoom' in the custom blog items
					'font-weight'     => '600',
					'font-style'      => 'normal',
					'line-height'     => '1.5rem',
					'text-decoration' => 'none',
					'text-transform'  => 'uppercase',
					'letter-spacing'  => '0.14px',
					'margin-top'      => '0.4em',
					'margin-bottom'   => '',
				),
				'menu'    => array(
					'title'           => esc_html__( 'Main menu', 'heaven11' ),
					'description'     => esc_html__( 'Font settings of the main menu items', 'heaven11' ),
					'font-family'     => '"Roboto Condensed",sans-serif',
					'font-size'       => '14px',
					'font-weight'     => '700',
					'font-style'      => 'normal',
					'line-height'     => '1.5rem',
					'text-decoration' => 'none',
					'text-transform'  => 'uppercase',
					'letter-spacing'  => '0.14px',
				),
				'submenu' => array(
					'title'           => esc_html__( 'Dropdown menu', 'heaven11' ),
					'description'     => esc_html__( 'Font settings of the dropdown menu items', 'heaven11' ),
					'font-family'     => '"Roboto Condensed",sans-serif',
					'font-size'       => '14px',
					'font-weight'     => '700',
					'font-style'      => 'normal',
					'line-height'     => '1.5rem',
					'text-decoration' => 'none',
					'text-transform'  => 'uppercase',
					'letter-spacing'  => '0.14px',
				),
			)
		);

		heaven11_storage_set(
			'schemes', array(

				// Color scheme: 'default'
				'default' => array(
					'title'    => esc_html__( 'Default', 'heaven11' ),
					'internal' => true,
					'colors'   => array(

						// Whole block border and background
						'bg_color'         => '#ffffff',
						'bd_color'         => '#dfdfdf',

						// Text and links colors
						'text'             => '#5a5a5a',  //+
						'text_light'       => '#bdbebe',
						'text_dark'        => '#201e1e',  //+
						'text_link'        => '#29cde6',  //+
						'text_hover'       => '#eab63a',  //+
						'text_link2'       => '#eab63a',
						'text_hover2'      => '#29cde6',
						'text_link3'       => '#ddb837',
						'text_hover3'      => '#eec432',

						// Alternative blocks (sidebar, tabs, alternative blocks, etc.)
						'alter_bg_color'   => '#eff0f2',
						'alter_bg_hover'   => '#f1f2f2',  //+
						'alter_bd_color'   => '#dfdfdf',
						'alter_bd_hover'   => '#e7e6e6',  //+
						'alter_text'       => '#5a5a5a',
						'alter_light'      => '#b7b7b7',
						'alter_dark'       => '#242c41',  //+
						'alter_link'       => '#eab63a',
						'alter_hover'      => '#29cde6',
						'alter_link2'      => '#8be77c',
						'alter_hover2'     => '#80d572',
						'alter_link3'      => '#eec432',
						'alter_hover3'     => '#f1f2f2',

						// Extra blocks (submenu, tabs, color blocks, etc.)
						'extra_bg_color'   => '#29cde6',
						'extra_bg_hover'   => '#ffffff',
						'extra_bd_color'   => '#43474f',
						'extra_bd_hover'   => '#e8e7e6',
						'extra_text'       => '#bfbfbf',
						'extra_light'      => '#f1f2f2',
						'extra_dark'       => '#ffffff',
						'extra_link'       => '#eab63a',
						'extra_hover'      => '#29cde6',
						'extra_link2'      => '#292c34',
						'extra_hover2'     => '#373a43',
						'extra_link3'      => '#29cde6',
						'extra_hover3'     => '#e8e7e6',

						// Input fields (form's fields and textarea)
						'input_bg_color'   => '#f1f2f2',
						'input_bg_hover'   => '#ffffff',
						'input_bd_color'   => '#29cde6',
						'input_bd_hover'   => '#eab63a',
						'input_text'       => '#5a5a5a',
						'input_light'      => '#5a5a5a',
						'input_dark'       => '#f1f2f2',

						// Inverse blocks (text and links on the 'text_link' background)
						'inverse_bd_color' => '#232c40',
						'inverse_bd_hover' => '#5aa4a9',
						'inverse_text'     => '#201e1e',
						'inverse_light'    => '#5a5a5a',
						'inverse_dark'     => '#000000',
						'inverse_link'     => '#ffffff',
						'inverse_hover'    => '#201e1e',
					),
				),

				// Color scheme: 'dark'
				'dark'    => array(
					'title'    => esc_html__( 'Dark', 'heaven11' ),
					'internal' => true,
					'colors'   => array(

						// Whole block border and background
						'bg_color'         => '#0e0d12',
						'bd_color'         => '#2e2c33',

						// Text and links colors
						'text'             => '#eeeeee',
						'text_light'       => '#bdbebe',
						'text_dark'        => '#ffffff',
						'text_link'        => '#eab63a',
						'text_hover'       => '#29cde6',
						'text_link2'       => '#80d572',
						'text_hover2'      => '#8be77c',
						'text_link3'       => '#ddb837',
						'text_hover3'      => '#eec432',

						// Alternative blocks (sidebar, tabs, alternative blocks, etc.)
						'alter_bg_color'   => '#1e1d22',
						'alter_bg_hover'   => '#1e1d22',
						'alter_bd_color'   => '#464646',
						'alter_bd_hover'   => '#201e1e',
						'alter_text'       => '#ffffff',
						'alter_light'      => '#6f6f6f',
						'alter_dark'       => '#ffffff',
						'alter_link'       => '#29cde6',
						'alter_hover'      => '#eab63a',
						'alter_link2'      => '#8be77c',
						'alter_hover2'     => '#80d572',
						'alter_link3'      => '#eec432',
						'alter_hover3'     => '#eab63a',

						// Extra blocks (submenu, tabs, color blocks, etc.)
						'extra_bg_color'   => '#1e1d22',
						'extra_bg_hover'   => '#29cde6',
						'extra_bd_color'   => '#464646',
						'extra_bd_hover'   => '#201e1e',
						'extra_text'       => '#a6a6a6',
						'extra_light'      => '#6f6f6f',
						'extra_dark'       => '#ffffff',
						'extra_link'       => '#eab63a',
						'extra_hover'      => '#eab63a',
						'extra_link2'      => '#e7e6e6',
						'extra_hover2'     => '#f1f2f2',
						'extra_link3'      => '#ffffff',
						'extra_hover3'     => '#e8e7e6',

						// Input fields (form's fields and textarea)
						'input_bg_color'   => '#242c41',
						'input_bg_hover'   => '#242c41',
						'input_bd_color'   => '#eab63a',
						'input_bd_hover'   => '#eab63a',
						'input_text'       => '#ffffff',
						'input_light'      => '#ffffff',
						'input_dark'       => '#ffffff',

						// Inverse blocks (text and links on the 'text_link' background)
						'inverse_bd_color' => '#232c40',
						'inverse_bd_hover' => '#cb5b47',
						'inverse_text'     => '#201e1e',
						'inverse_light'    => '#9f9f9f',
						'inverse_dark'     => '#000000',
						'inverse_link'     => '#ffffff',
						'inverse_hover'    => '#201e1e',
					),
				),

			)
		);

		// Shortcodes support
//------------------------------------------------------------------------

// Add new output types (layouts) in the shortcodes
		if ( ! function_exists( 'heaven11_trx_addons_sc_type3' ) ) {
			add_filter( 'trx_addons_sc_type', 'heaven11_trx_addons_sc_type3', 10, 2 );
			function heaven11_trx_addons_sc_type3( $list, $sc ) {
				// To do: check shortcode slug and if correct - add new 'key' => 'title' to the list
				if ( 'trx_sc_blogger' == $sc ) {
					$list = heaven11_array_merge( $list, heaven11_get_list_blog_styles( false, 'sc' ) );
				}
				if ($sc == 'trx_sc_team') {
					$list['alter'] = 'Alternative';
				}
				return $list;
			}
		}
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
			$options['demo_type'] = 'building';
			$options['files']['building'] = $options['files']['default'];
			$options['files']['building']['title'] = esc_html__('Building Demo', 'heaven11');
			$options['files']['building']['domain_dev'] = esc_url( 'https://building.heaven11.axiomthemes.com' );
			$options['files']['building']['domain_demo'] = esc_url( 'https://building.heaven11.axiomthemes.com' );   // Demo-site domain
			unset($options['files']['default']);
		}
		return $options;
	}
}


// Add skin-specific colors and fonts to the custom CSS
require_once HEAVEN11_THEME_DIR . HEAVEN11_SKIN_DIR . 'skin-styles.php';
