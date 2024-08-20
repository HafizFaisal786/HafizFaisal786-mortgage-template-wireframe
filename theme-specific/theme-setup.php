<?php
/**
 * Setup theme-specific fonts and colors
 *
 * @package WordPress
 * @subpackage HEAVEN11
 * @since HEAVEN11 1.0.22
 */

// If this theme is a free version of premium theme
if ( ! defined( 'HEAVEN11_THEME_FREE' ) ) {
	define( 'HEAVEN11_THEME_FREE', false );
}
if ( ! defined( 'HEAVEN11_THEME_FREE_WP' ) ) {
	define( 'HEAVEN11_THEME_FREE_WP', false );
}

// If this theme uses multiple skins
if ( ! defined( 'HEAVEN11_ALLOW_SKINS' ) ) {
	define( 'HEAVEN11_ALLOW_SKINS', true );
}
if ( ! defined( 'HEAVEN11_DEFAULT_SKIN' ) ) {
	define( 'HEAVEN11_DEFAULT_SKIN', 'default' );
}



// Theme storage
// Attention! Must be in the global namespace to compatibility with WP CLI
//-------------------------------------------------------------------------
$GLOBALS['HEAVEN11_STORAGE'] = array(

	// Key validator: market[env|loc]-vendor[axiom|ancora|themerex]
	'theme_pro_key'      => 'env-axiom',

	// Generate Personal token from Envato to automatic upgrade theme
	'upgrade_token_url'  => '//build.envato.com/create-token/?default=t&purchase:download=t&purchase:list=t',

	// Theme-specific URLs (will be escaped in place of the output)
	'theme_demo_url'     => '//heaven11.axiomthemes.com',
	'theme_doc_url'      => '//heaven11.axiomthemes.com/doc',
	
	'theme_rate_url'     => '//axiomthemes.com/download',

	'theme_custom_url' => '//themerex.net/offers/?utm_source=offers&utm_medium=click&utm_campaign=themedash',

	'theme_download_url' => '//themeforest.net/item/heaven11-property-apartment-real-estate-wordpress-theme/23843090',         // Axiom

	'theme_support_url'  => '//themerex.net/support/',                                   // Axiom

	'theme_video_url'    => '//www.youtube.com/channel/UCBjqhuwKj3MfE3B6Hg2oA8Q',  // Axiom

	'theme_privacy_url'  => '//axiomthemes.com/privacy-policy/',                    // Axiom

	// Comma separated slugs of theme-specific categories (for get relevant news in the dashboard widget)
	// (i.e. 'children,kindergarten')
	'theme_categories'   => '',

	// Responsive resolutions
	// Parameters to create css media query: min, max
	'responsive'         => array(
		// By device
		'wide'       => array(
			'min' => 2160
		),
		'desktop'    => array(
			'min' => 1680,
			'max' => 2159,
		),
		'notebook'   => array(
			'min' => 1280,
			'max' => 1679,
		),
		'tablet'     => array(
			'min' => 768,
			'max' => 1279,
		),
		'not_mobile' => array( 'min' => 768 ),
		'mobile'     => array( 'max' => 767 ),
		// By size
		'xxl'        => array( 'max' => 1679 ),
		'xl'         => array( 'max' => 1439 ),
		'lg'         => array( 'max' => 1279 ),
		'md_over'    => array( 'min' => 1024 ),
		'md'         => array( 'max' => 1023 ),
		'sm'         => array( 'max' => 767 ),
		'sm_wp'      => array( 'max' => 600 ),
		'xs'         => array( 'max' => 479 ),
	),
);



// THEME-SUPPORTED PLUGINS
// If plugin not need - remove its settings from next array
//----------------------------------------------------------
$heaven11_theme_required_plugins_group = esc_html__( 'Core', 'heaven11' );
$heaven11_theme_required_plugins = array(
	// Section: "CORE" (required plugins)
	// DON'T COMMENT OR REMOVE NEXT LINES!
	'trx_addons'         => array(
								'title'       => esc_html__( 'ThemeREX Addons', 'heaven11' ),
								'description' => esc_html__( "Will allow you to install recommended plugins, demo content, and improve the theme's functionality overall with multiple theme options", 'heaven11' ),
								'required'    => true,
								'logo'        => 'logo.png',
								'group'       => $heaven11_theme_required_plugins_group,
							),
);

// Section: "PAGE BUILDERS"
$heaven11_theme_required_plugins_group = esc_html__( 'Page Builders', 'heaven11' );
$heaven11_theme_required_plugins['elementor'] = array(
	'title'       => esc_html__( 'Elementor', 'heaven11' ),
	'description' => esc_html__( "Is a beautiful PageBuilder, even the free version of which allows you to create great pages using a variety of modules.", 'heaven11' ),
	'required'    => false,
	'logo'        => 'logo.png',
	'group'       => $heaven11_theme_required_plugins_group,
);
$heaven11_theme_required_plugins['gutenberg'] = array(
	'title'       => esc_html__( 'Gutenberg', 'heaven11' ),
	'description' => esc_html__( "It's a posts editor coming in place of the classic TinyMCE. Can be installed and used in parallel with Elementor", 'heaven11' ),
	'required'    => false,
	'install'     => false,      // Do not offer installation of the plugin in the Theme Dashboard and TGMPA
	'logo'        => 'logo.png',
	'group'       => $heaven11_theme_required_plugins_group,
);
if ( ! HEAVEN11_THEME_FREE ) {
	$heaven11_theme_required_plugins['js_composer']          = array(
		'title'       => esc_html__( 'WPBakery PageBuilder', 'heaven11' ),
		'description' => esc_html__( "Popular PageBuilder which allows you to create excellent pages", 'heaven11' ),
		'required'    => false,
		'install'     => false,      // Do not offer installation of the plugin in the Theme Dashboard and TGMPA
		'logo'        => 'logo.jpg',
		'group'       => $heaven11_theme_required_plugins_group,
	);
	$heaven11_theme_required_plugins['trx_updater']          = array(
		'title'       => esc_html__( 'ThemeREX Updater', 'heaven11' ),
		'description' => esc_html__( "Allow updates theme-specific plugins and theme core", 'heaven11' ),
		'required'    => false,
		'logo'        => 'logo.jpg',
		'group'       => $heaven11_theme_required_plugins_group,
	);
	$heaven11_theme_required_plugins['vc-extensions-bundle'] = array(
		'title'       => esc_html__( 'WPBakery PageBuilder extensions bundle', 'heaven11' ),
		'description' => esc_html__( "Many shortcodes for the WPBakery PageBuilder", 'heaven11' ),
		'required'    => false,
		'install'     => false,      // Do not offer installation of the plugin in the Theme Dashboard and TGMPA
		'logo'        => 'logo.png',
		'group'       => $heaven11_theme_required_plugins_group,
	);
}

// Section: "SOCIALS & COMMUNITIES"
$heaven11_theme_required_plugins_group = esc_html__( 'Socials and Communities', 'heaven11' );
$heaven11_theme_required_plugins['mailchimp-for-wp'] = array(
	'title'       => esc_html__( 'MailChimp for WP', 'heaven11' ),
	'description' => esc_html__( "Allows visitors to subscribe to newsletters", 'heaven11' ),
	'required'    => false,
	'logo'        => 'logo.png',
	'group'       => $heaven11_theme_required_plugins_group,
);
$heaven11_theme_required_plugins['wp-image-makers-easy-hotspot-solution'] = array(
	'title'       => esc_html__( 'WP Image Markers - Easy Hotspot Solution', 'heaven11' ),
	'description' => esc_html__( "Add and drag marker icons with tooltips in a image.", 'heaven11' ),
	'required'    => false,
	'logo'        => 'logo.png',
	'group'       => $heaven11_theme_required_plugins_group,
);
$heaven11_theme_required_plugins['wp-simple-iconfonts'] = array(
	'title'       => esc_html__( 'WP Simple Iconfonts', 'heaven11' ),
	'description' => esc_html__( "Icons.", 'heaven11' ),
	'required'    => false,
	'logo'        => 'logo.png',
	'group'       => $heaven11_theme_required_plugins_group,
);

// Section: "EVENTS & TIMELINES"
$heaven11_theme_required_plugins_group = esc_html__( 'Events and Appointments', 'heaven11' );
if ( ! HEAVEN11_THEME_FREE ) {
	$heaven11_theme_required_plugins['booked']                 = array(
		'title'       => esc_html__( 'Booked Appointments', 'heaven11' ),
		'description' => '',
		'required'    => false,
		'logo'        => 'logo.png',
		'group'       => $heaven11_theme_required_plugins_group,
	);
	$heaven11_theme_required_plugins['quickcal']                 = array(
		'title'       => esc_html__( 'QuickCal', 'heaven11' ),
		'description' => '',
		'install'    => false,
		'required'    => false,
		'logo'        => 'logo.png',
		'group'       => $heaven11_theme_required_plugins_group,
	);
	$heaven11_theme_required_plugins['the-events-calendar']    = array(
		'title'       => esc_html__( 'The Events Calendar', 'heaven11' ),
		'description' => '',
		'required'    => false,
		'logo'        => 'logo.png',
		'group'       => $heaven11_theme_required_plugins_group,
	);
}

// Section: "CONTENT"
$heaven11_theme_required_plugins_group = esc_html__( 'Content', 'heaven11' );
$heaven11_theme_required_plugins['contact-form-7'] = array(
	'title'       => esc_html__( 'Contact Form 7', 'heaven11' ),
	'description' => esc_html__( "CF7 allows you to create an unlimited number of contact forms", 'heaven11' ),
	'required'    => false,
	'logo'        => 'logo.jpg',
	'group'       => $heaven11_theme_required_plugins_group,
);
$heaven11_theme_required_plugins['date-time-picker-field'] = array(
	'title'       => esc_html__( 'Date Time Picker Field', 'heaven11' ),
	'description' => esc_html__( "Convert any input field on your website into a date time picker field using CSS selectors", 'heaven11' ),
	'required'    => false,
	'logo'        => 'logo.jpg',
	'group'       => $heaven11_theme_required_plugins_group,
);
if ( ! HEAVEN11_THEME_FREE ) {
	$heaven11_theme_required_plugins['essential-grid']             = array(
		'title'       => esc_html__( 'Essential Grid', 'heaven11' ),
		'description' => '',
		'required'    => false,
		'logo'        => 'logo.png',
		'group'       => $heaven11_theme_required_plugins_group,
	);
	$heaven11_theme_required_plugins['revslider']                  = array(
		'title'       => esc_html__( 'Revolution Slider', 'heaven11' ),
		'description' => '',
		'required'    => false,
		'logo'        => 'logo.png',
		'group'       => $heaven11_theme_required_plugins_group,
	);
	$heaven11_theme_required_plugins['sitepress-multilingual-cms'] = array(
		'title'       => esc_html__( 'WPML - Sitepress Multilingual CMS', 'heaven11' ),
		'description' => esc_html__( "Allows you to make your website multilingual", 'heaven11' ),
		'required'    => false,
		'install'     => false,      // Do not offer installation of the plugin in the Theme Dashboard and TGMPA
		'logo'        => 'logo.png',
		'group'       => $heaven11_theme_required_plugins_group,
	);
}

// Section: "OTHER"
$heaven11_theme_required_plugins_group = esc_html__( 'Other', 'heaven11' );
$heaven11_theme_required_plugins['wp-gdpr-compliance'] = array(
	'title'       => esc_html__( 'Cookie Information', 'heaven11' ),
	'description' => esc_html__( "Allow visitors to decide for themselves what personal data they want to store on your site", 'heaven11' ),
	'required'    => false,
	'logo'        => 'logo.png',
	'group'       => $heaven11_theme_required_plugins_group,
);

// Add plugins list to the global storage
$GLOBALS['HEAVEN11_STORAGE']['required_plugins'] = $heaven11_theme_required_plugins;



// THEME-SPECIFIC BLOG LAYOUTS
//----------------------------------------------
$heaven11_theme_blog_styles = array(
	'excerpt' => array(
		'title'   => esc_html__( 'Standard', 'heaven11' ),
		'archive' => 'index-excerpt',
		'item'    => 'content-excerpt',
		'styles'  => 'excerpt',
	),
	'classic' => array(
		'title'   => esc_html__( 'Classic', 'heaven11' ),
		'archive' => 'index-classic',
		'item'    => 'content-classic',
		'columns' => array( 2, 3 ),
		'styles'  => 'classic',
	),
);
if ( ! HEAVEN11_THEME_FREE ) {
	$heaven11_theme_blog_styles['masonry']   = array(
		'title'   => esc_html__( 'Masonry', 'heaven11' ),
		'archive' => 'index-classic',
		'item'    => 'content-classic',
		'columns' => array( 2, 3 ),
		'styles'  => 'masonry',
	);
	$heaven11_theme_blog_styles['portfolio'] = array(
		'title'   => esc_html__( 'Portfolio', 'heaven11' ),
		'archive' => 'index-portfolio',
		'item'    => 'content-portfolio',
		'columns' => array( 2, 3, 4 ),
		'styles'  => 'portfolio',
	);
	$heaven11_theme_blog_styles['gallery']   = array(
		'title'   => esc_html__( 'Gallery', 'heaven11' ),
		'archive' => 'index-portfolio',
		'item'    => 'content-portfolio-gallery',
		'columns' => array( 2, 3, 4 ),
		'styles'  => array( 'portfolio', 'gallery' ),
	);
	$heaven11_theme_blog_styles['chess']     = array(
		'title'   => esc_html__( 'Chess', 'heaven11' ),
		'archive' => 'index-chess',
		'item'    => 'content-chess',
		'columns' => array( 1, 2, 3 ),
		'styles'  => 'chess',
	);
}

// Add list of blog styles to the global storage
$GLOBALS['HEAVEN11_STORAGE']['blog_styles'] = $heaven11_theme_blog_styles;


// Theme init priorities:
// Action 'after_setup_theme'
// 1 - register filters to add/remove lists items in the Theme Options
// 2 - create Theme Options
// 3 - add/remove Theme Options elements
// 5 - load Theme Options. Attention! After this step you can use only basic options (not overriden)
// 9 - register other filters (for installer, etc.)
//10 - standard Theme init procedures (not ordered)
// Action 'wp_loaded'
// 1 - detect override mode. Attention! Only after this step you can use overriden options (separate values for the shop, courses, etc.)

if ( ! function_exists( 'heaven11_customizer_theme_setup1' ) ) {
	add_action( 'after_setup_theme', 'heaven11_customizer_theme_setup1', 1 );
	function heaven11_customizer_theme_setup1() {

		// -----------------------------------------------------------------
		// -- ONLY FOR PROGRAMMERS, NOT FOR CUSTOMER
		// -- Internal theme settings
		// -----------------------------------------------------------------
		heaven11_storage_set(
			'settings', array(

				'duplicate_options'      => 'child',                    // none  - use separate options for the main and the child-theme
																		// child - duplicate theme options from the main theme to the child-theme only
																		// both  - sinchronize changes in the theme options between main and child themes

				'customize_refresh'      => 'auto',                     // Refresh method for preview area in the Appearance - Customize:
																		// auto - refresh preview area on change each field with Theme Options
																		// manual - refresh only obn press button 'Refresh' at the top of Customize frame

				'max_load_fonts'         => 5,                          // Max fonts number to load from Google fonts or from uploaded fonts

				'comment_after_name'     => true,                       // Place 'comment' field after the 'name' and 'email'

				'show_author_avatar'     => true,                       // Display author's avatar in the post meta

				'icons_selector'         => 'internal',                 // Icons selector in the shortcodes:
																		// vc (default) - standard VC (very slow) or Elementor's icons selector (not support images and svg)
																		// internal - internal popup with plugin's or theme's icons list (fast and support images and svg)

				'icons_type'             => 'icons',                    // Type of icons (if 'icons_selector' is 'internal'):
																		// icons  - use font icons to present icons
																		// images - use images from theme's folder trx_addons/css/icons.png
																		// svg    - use svg from theme's folder trx_addons/css/icons.svg

				'socials_type'           => 'icons',                    // Type of socials icons (if 'icons_selector' is 'internal'):
																		// icons  - use font icons to present social networks
																		// images - use images from theme's folder trx_addons/css/icons.png
																		// svg    - use svg from theme's folder trx_addons/css/icons.svg

				'check_min_version'      => true,                       // Check if exists a .min version of .css and .js and return path to it
																		// instead the path to the original file
																		// (if debug_mode is off and modification time of the original file < time of the .min file)

				'autoselect_menu'        => false,                      // Show any menu if no menu selected in the location 'main_menu'
																		// (for example, the theme is just activated)

				'disable_jquery_ui'      => false,                      // Prevent loading custom jQuery UI libraries in the third-party plugins

				'use_mediaelements'      => true,                       // Load script "Media Elements" to play video and audio

				'tgmpa_upload'           => false,                      // Allow upload not pre-packaged plugins via TGMPA

				'allow_no_image'         => false,                      // Allow to use theme-specific image placeholder if no image present in the blog, related posts, post navigation, etc.

				'separate_schemes'       => true,                       // Save color schemes to the separate files __color_xxx.css (true) or append its to the __custom.css (false)

				'allow_fullscreen'       => false,                      // Allow cases 'fullscreen' and 'fullwide' for the body style in the Theme Options
																		// In the Page Options this styles are present always
																		// (can be removed if filter 'heaven11_filter_allow_fullscreen' return false)

				'attachments_navigation' => false,                      // Add arrows on the single attachment page to navigate to the prev/next attachment

				'gutenberg_safe_mode'    => array(),                    // 'vc', 'elementor' - Prevent simultaneous editing of posts for Gutenberg and other PageBuilders (VC, Elementor)

				'gutenberg_add_context'  => false,                      // Add context to the Gutenberg editor styles with our method (if true - use if any problem with editor styles) or use native Gutenberg way via add_editor_style() (if false - used by default)

				'allow_gutenberg_blocks' => true,                       // Allow our shortcodes and widgets as blocks in the Gutenberg (not ready yet - in the development now)

				'subtitle_above_title'   => true,                       // Put subtitle above the title in the shortcodes

				'add_hide_on_xxx'        => 'replace',                  // Add our breakpoints to the Responsive section of each element
																		// 'add' - add our breakpoints after Elementor's
																		// 'replace' - add our breakpoints instead Elementor's
																		// 'none' - don't add our breakpoints (using only Elementor's)
			)
		);

		// -----------------------------------------------------------------
		// -- Theme fonts (Google and/or custom fonts)
		// -----------------------------------------------------------------

		// Fonts to load when theme start
		// It can be Google fonts or uploaded fonts, placed in the folder /css/font-face/font-name inside the theme folder
		// Attention! Font's folder must have name equal to the font's name, with spaces replaced on the dash '-'
		
		heaven11_storage_set(
			'load_fonts', array(
				// Google font
				array(
					'name'   => 'Roboto',
					'family' => 'sans-serif',
					'styles' => '300,300italic,400,400italic,700,700italic,900',     // Parameter 'style' used only for the Google fonts
				),
				array(
					'name'   => 'Maven Pro',
					'family' => 'sans-serif',
					'styles' => '400,500,700,900',     // Parameter 'style' used only for the Google fonts
				),
				array(
					'name'   => 'Roboto Condensed',
					'family' => 'sans-serif',
					'styles' => '300,400,700',     // Parameter 'style' used only for the Google fonts
				),
				// Font-face packed with theme
				array(
					'name'   => 'Montserrat',
					'family' => 'sans-serif',
				),
			)
		);

		// Characters subset for the Google fonts. Available values are: latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese
		heaven11_storage_set( 'load_fonts_subset', 'latin,latin-ext' );

		// Settings of the main tags
		// Attention! Font name in the parameter 'font-family' will be enclosed in the quotes and no spaces after comma!
		
		
		

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
					'font-family'     => '"Maven Pro",sans-serif',
					'font-size'       => '4.625rem',
					'font-weight'     => '500',
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
					'font-family'     => '"Maven Pro",sans-serif',
					'font-size'       => '4rem',
					'font-weight'     => '500',
					'font-style'      => 'normal',
					'line-height'     => '4.688rem',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '-2px',
					'margin-top'      => '0.9952em',
					'margin-bottom'   => '0.52em',
				),
				'h3'      => array(
					'title'           => esc_html__( 'Heading 3', 'heaven11' ),
					'font-family'     => '"Maven Pro",sans-serif',
					'font-size'       => '3.5rem',
					'font-weight'     => '500',
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
					'font-family'     => '"Maven Pro",sans-serif',
					'font-size'       => '2.813rem',
					'font-weight'     => '500',
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
					'font-family'     => '"Maven Pro",sans-serif',
					'font-size'       => '2.25rem',
					'font-weight'     => '500',
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
					'font-family'     => '"Maven Pro",sans-serif',
					'font-size'       => '1.625rem',
					'font-weight'     => '500',
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
					'font-family'     => '"Maven Pro",sans-serif',
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

		// -----------------------------------------------------------------
		// -- Theme colors for customizer
		// -- Attention! Inner scheme must be last in the array below
		// -----------------------------------------------------------------
		heaven11_storage_set(
			'scheme_color_groups', array(
				'main'    => array(
					'title'       => esc_html__( 'Main', 'heaven11' ),
					'description' => esc_html__( 'Colors of the main content area', 'heaven11' ),
				),
				'alter'   => array(
					'title'       => esc_html__( 'Alter', 'heaven11' ),
					'description' => esc_html__( 'Colors of the alternative blocks (sidebars, etc.)', 'heaven11' ),
				),
				'extra'   => array(
					'title'       => esc_html__( 'Extra', 'heaven11' ),
					'description' => esc_html__( 'Colors of the extra blocks (dropdowns, price blocks, table headers, etc.)', 'heaven11' ),
				),
				'inverse' => array(
					'title'       => esc_html__( 'Inverse', 'heaven11' ),
					'description' => esc_html__( 'Colors of the inverse blocks - when link color used as background of the block (dropdowns, blockquotes, etc.)', 'heaven11' ),
				),
				'input'   => array(
					'title'       => esc_html__( 'Input', 'heaven11' ),
					'description' => esc_html__( 'Colors of the form fields (text field, textarea, select, etc.)', 'heaven11' ),
				),
			)
		);
		heaven11_storage_set(
			'scheme_color_names', array(
				'bg_color'    => array(
					'title'       => esc_html__( 'Background color', 'heaven11' ),
					'description' => esc_html__( 'Background color of this block in the normal state', 'heaven11' ),
				),
				'bg_hover'    => array(
					'title'       => esc_html__( 'Background hover', 'heaven11' ),
					'description' => esc_html__( 'Background color of this block in the hovered state', 'heaven11' ),
				),
				'bd_color'    => array(
					'title'       => esc_html__( 'Border color', 'heaven11' ),
					'description' => esc_html__( 'Border color of this block in the normal state', 'heaven11' ),
				),
				'bd_hover'    => array(
					'title'       => esc_html__( 'Border hover', 'heaven11' ),
					'description' => esc_html__( 'Border color of this block in the hovered state', 'heaven11' ),
				),
				'text'        => array(
					'title'       => esc_html__( 'Text', 'heaven11' ),
					'description' => esc_html__( 'Color of the plain text inside this block', 'heaven11' ),
				),
				'text_dark'   => array(
					'title'       => esc_html__( 'Text dark', 'heaven11' ),
					'description' => esc_html__( 'Color of the dark text (bold, header, etc.) inside this block', 'heaven11' ),
				),
				'text_light'  => array(
					'title'       => esc_html__( 'Text light', 'heaven11' ),
					'description' => esc_html__( 'Color of the light text (post meta, etc.) inside this block', 'heaven11' ),
				),
				'text_link'   => array(
					'title'       => esc_html__( 'Link', 'heaven11' ),
					'description' => esc_html__( 'Color of the links inside this block', 'heaven11' ),
				),
				'text_hover'  => array(
					'title'       => esc_html__( 'Link hover', 'heaven11' ),
					'description' => esc_html__( 'Color of the hovered state of links inside this block', 'heaven11' ),
				),
				'text_link2'  => array(
					'title'       => esc_html__( 'Link 2', 'heaven11' ),
					'description' => esc_html__( 'Color of the accented texts (areas) inside this block', 'heaven11' ),
				),
				'text_hover2' => array(
					'title'       => esc_html__( 'Link 2 hover', 'heaven11' ),
					'description' => esc_html__( 'Color of the hovered state of accented texts (areas) inside this block', 'heaven11' ),
				),
				'text_link3'  => array(
					'title'       => esc_html__( 'Link 3', 'heaven11' ),
					'description' => esc_html__( 'Color of the other accented texts (buttons) inside this block', 'heaven11' ),
				),
				'text_hover3' => array(
					'title'       => esc_html__( 'Link 3 hover', 'heaven11' ),
					'description' => esc_html__( 'Color of the hovered state of other accented texts (buttons) inside this block', 'heaven11' ),
				),
			)
		);
		
		$schemes = array(

				// Color scheme: 'default'
				'default' => array(
					'title'    => esc_html__( 'Default', 'heaven11' ),
					'internal' => true,
					'colors'   => array(

						// Whole block border and background
						'bg_color'         => '#ffffff',
						'bd_color'         => '#dfdfdf',

						// Text and links colors
						'text'             => '#3f3e3e',  //+
						'text_light'       => '#bdbebe',  //+
						'text_dark'        => '#282525',  //+
						'text_link'        => '#879c49',  //+
						'text_hover'       => '#c2b28a',  //+
						'text_link2'       => '#c2b28a',
						'text_hover2'      => '#879c49',
						'text_link3'       => '#ddb837',
						'text_hover3'      => '#eec432',

						// Alternative blocks (sidebar, tabs, alternative blocks, etc.)
						'alter_bg_color'   => '#eff0f2',  //+
						'alter_bg_hover'   => '#eae9e8',  //+
						'alter_bd_color'   => '#dfdfdf',
						'alter_bd_hover'   => '#f0efee',  //+
						'alter_text'       => '#3f3e3e',  //+
						'alter_light'      => '#b7b7b7',
						'alter_dark'       => '#23262d',  //+
						'alter_link'       => '#c2b28a',
						'alter_hover'      => '#879c49',
						'alter_link2'      => '#8be77c',
						'alter_hover2'     => '#80d572',
						'alter_link3'      => '#eec432',
						'alter_hover3'     => '#eae9e8',  //+

						// Extra blocks (submenu, tabs, color blocks, etc.)
						'extra_bg_color'   => '#879c49',  //+
						'extra_bg_hover'   => '#ffffff',  //+
						'extra_bd_color'   => '#43474f',  //+
						'extra_bd_hover'   => '#e8e7e6',  //+
						'extra_text'       => '#bfbfbf',
						'extra_light'      => '#f1f2f2',  //+
						'extra_dark'       => '#ffffff',
						'extra_link'       => '#c2b28a',  //+
						'extra_hover'      => '#879c49',  //+
						'extra_link2'      => '#292c34',  //+
						'extra_hover2'     => '#373a43',  //+
						'extra_link3'      => '#879c49',  //+
						'extra_hover3'     => '#e8e7e6',  //+

						// Input fields (form's fields and textarea)
						'input_bg_color'   => '#eae9e8',  //+
						'input_bg_hover'   => '#ffffff',  //+
						'input_bd_color'   => '#879c49',  //+
						'input_bd_hover'   => '#c2b28a',  //+
						'input_text'       => '#3f3e3e',  //+
						'input_light'      => '#3f3e3e',  //+
						'input_dark'       => '#eae9e8',  //+

						// Inverse blocks (text and links on the 'text_link' background)
						'inverse_bd_color' => '#23262d',  //+
						'inverse_bd_hover' => '#5aa4a9',
						'inverse_text'     => '#282525',
						'inverse_light'    => '#3f3e3e',
						'inverse_dark'     => '#000000',
						'inverse_link'     => '#ffffff',
						'inverse_hover'    => '#282525',
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
						'text'             => '#eeeeee',  //+
						'text_light'       => '#bdbebe',
						'text_dark'        => '#ffffff',
						'text_link'        => '#c2b28a',  //+
						'text_hover'       => '#879c49',  //+
						'text_link2'       => '#879c49',
						'text_hover2'      => '#c2b28a',
						'text_link3'       => '#ddb837',
						'text_hover3'      => '#eec432',

						// Alternative blocks (sidebar, tabs, alternative blocks, etc.)
						'alter_bg_color'   => '#1e1d22',
						'alter_bg_hover'   => '#1e1d22',  //+
						'alter_bd_color'   => '#464646',
						'alter_bd_hover'   => '#282525',
						'alter_text'       => '#ffffff',  //+
						'alter_light'      => '#6f6f6f',
						'alter_dark'       => '#ffffff',  //+
						'alter_link'       => '#879c49',
						'alter_hover'      => '#c2b28a',
						'alter_link2'      => '#8be77c',
						'alter_hover2'     => '#80d572',
						'alter_link3'      => '#eec432',
						'alter_hover3'     => '#c2b28a',  //+

						// Extra blocks (submenu, tabs, color blocks, etc.)
						'extra_bg_color'   => '#1e1d22',
						'extra_bg_hover'   => '#879c49',  //+
						'extra_bd_color'   => '#464646',
						'extra_bd_hover'   => '#282525',  //+
						'extra_text'       => '#a6a6a6',
						'extra_light'      => '#6f6f6f',
						'extra_dark'       => '#ffffff',
						'extra_link'       => '#c2b28a',  //+
						'extra_hover'      => '#c2b28a',
						'extra_link2'      => '#f0efee',  //+
						'extra_hover2'     => '#eae9e8',  //+
						'extra_link3'      => '#ffffff',  //+
						'extra_hover3'     => '#e8e7e6',  //+

						// Input fields (form's fields and textarea)
						'input_bg_color'   => '#23262d',
						'input_bg_hover'   => '#23262d',
						'input_bd_color'   => '#c2b28a',
						'input_bd_hover'   => '#c2b28a',
						'input_text'       => '#ffffff',
						'input_light'      => '#ffffff',
						'input_dark'       => '#ffffff',

						// Inverse blocks (text and links on the 'text_link' background)
						'inverse_bd_color' => '#23262d',  //+
						'inverse_bd_hover' => '#cb5b47',
						'inverse_text'     => '#282525',
						'inverse_light'    => '#9f9f9f',
						'inverse_dark'     => '#000000',
						'inverse_link'     => '#ffffff',
						'inverse_hover'    => '#282525',
					),
				),

		);

		heaven11_storage_set('schemes', $schemes );
		heaven11_storage_set( 'schemes_original', $schemes );
		
		// Simple scheme editor: lists the colors to edit in the "Simple" mode.
		// For each color you can set the array of 'slave' colors and brightness factors that are used to generate new values,
		// when 'main' color is changed
		// Leave 'slave' arrays empty if your scheme does not have a color dependency
		heaven11_storage_set(
			'schemes_simple', array(
				'text_link'        => array(
					'alter_hover'      => 1,
					'extra_link'       => 1,
					'inverse_bd_color' => 0.85,
					'inverse_bd_hover' => 0.7,
				),
				'text_hover'       => array(
					'alter_link'  => 1,
					'extra_hover' => 1,
				),
				'text_link2'       => array(
					'alter_hover2' => 1,
					'extra_link2'  => 1,
				),
				'text_hover2'      => array(
					'alter_link2'  => 1,
					'extra_hover2' => 1,
				),
				'text_link3'       => array(
					'alter_hover3' => 1,
					'extra_link3'  => 1,
				),
				'text_hover3'      => array(
					'alter_link3'  => 1,
					'extra_hover3' => 1,
				),
				'alter_link'       => array(),
				'alter_hover'      => array(),
				'alter_link2'      => array(),
				'alter_hover2'     => array(),
				'alter_link3'      => array(),
				'alter_hover3'     => array(),
				'extra_link'       => array(),
				'extra_hover'      => array(),
				'extra_link2'      => array(),
				'extra_hover2'     => array(),
				'extra_link3'      => array(),
				'extra_hover3'     => array(),
				'inverse_bd_color' => array(),
				'inverse_bd_hover' => array(),
			)
		);

		// Additional colors for each scheme
		// Parameters:	'color' - name of the color from the scheme that should be used as source for the transformation
		//				'alpha' - to make color transparent (0.0 - 1.0)
		//				'hue', 'saturation', 'brightness' - inc/dec value for each color's component
		heaven11_storage_set(
			'scheme_colors_add', array(
				'bg_color_0'        => array(
					'color' => 'bg_color',
					'alpha' => 0,
				),
				'bg_color_02'       => array(
					'color' => 'bg_color',
					'alpha' => 0.2,
				),
				'bg_color_07'       => array(
					'color' => 'bg_color',
					'alpha' => 0.7,
				),
				'bg_color_08'       => array(
					'color' => 'bg_color',
					'alpha' => 0.8,
				),
				'bg_color_09'       => array(
					'color' => 'bg_color',
					'alpha' => 0.9,
				),
				'alter_dark_05' => array(
					'color' => 'alter_dark',
					'alpha' => 0.5,
				),
				'alter_bg_color_07' => array(
					'color' => 'alter_bg_color',
					'alpha' => 0.7,
				),
				'alter_bg_color_04' => array(
					'color' => 'alter_bg_color',
					'alpha' => 0.4,
				),
				'alter_bg_color_00' => array(
					'color' => 'alter_bg_color',
					'alpha' => 0,
				),
				'alter_bg_color_02' => array(
					'color' => 'alter_bg_color',
					'alpha' => 0.2,
				),
				'alter_bd_color_02' => array(
					'color' => 'alter_bd_color',
					'alpha' => 0.2,
				),
				'alter_link_02'     => array(
					'color' => 'alter_link',
					'alpha' => 0.2,
				),
				'alter_link_07'     => array(
					'color' => 'alter_link',
					'alpha' => 0.7,
				),
				'extra_bg_color_05' => array(
					'color' => 'extra_bg_color',
					'alpha' => 0.5,
				),
				'extra_bg_color_07' => array(
					'color' => 'extra_bg_color',
					'alpha' => 0.7,
				),
				'extra_link_02'     => array(
					'color' => 'extra_link',
					'alpha' => 0.2,
				),
				'extra_link_07'     => array(
					'color' => 'extra_link',
					'alpha' => 0.7,
				),
				'text_dark_07'      => array(
					'color' => 'text_dark',
					'alpha' => 0.7,
				),
				'text_link_02'      => array(
					'color' => 'text_link',
					'alpha' => 0.2,
				),
				'text_link_07'      => array(
					'color' => 'text_link',
					'alpha' => 0.7,
				),
				'text_link_blend'   => array(
					'color'      => 'text_link',
					'hue'        => 2,
					'saturation' => -5,
					'brightness' => 5,
				),
				'alter_link_blend'  => array(
					'color'      => 'alter_link',
					'hue'        => 2,
					'saturation' => -5,
					'brightness' => 5,
				),
			)
		);

		// Parameters to set order of schemes in the css
		heaven11_storage_set(
			'schemes_sorted', array(
				'color_scheme',
				'header_scheme',
				'menu_scheme',
				'sidebar_scheme',
				'footer_scheme',
			)
		);

		// -----------------------------------------------------------------
		// -- Theme specific thumb sizes
		// -----------------------------------------------------------------
		heaven11_storage_set(
			'theme_thumbs', apply_filters(
				'heaven11_filter_add_thumb_sizes', array(
					// Width of the image is equal to the content area width (without sidebar)
					// Height is fixed
					'heaven11-thumb-huge'        => array(
						'size'  => array( 1170, 658, true ),
						'title' => esc_html__( 'Huge image', 'heaven11' ),
						'subst' => 'trx_addons-thumb-huge',
					),
					// Width of the image is equal to the content area width (with sidebar)
					// Height is fixed
					'heaven11-thumb-big'         => array(
						'size'  => array( 1460, 780, true ),
						'title' => esc_html__( 'Large image', 'heaven11' ),
						'subst' => 'trx_addons-thumb-big',
					),

					// Width of the image is equal to the 1/3 of the content area width (without sidebar)
					// Height is fixed
					'heaven11-thumb-med'         => array(
						'size'  => array( 370, 208, true ),
						'title' => esc_html__( 'Medium image', 'heaven11' ),
						'subst' => 'trx_addons-thumb-medium',
					),

					// Small square image (for avatars in comments, etc.)
					'heaven11-thumb-tiny'        => array(
						'size'  => array( 220, 220, true ),
						'title' => esc_html__( 'Small square avatar', 'heaven11' ),
						'subst' => 'trx_addons-thumb-tiny',
					),

					// Team image
					'heaven11-thumb-team'        => array(
						'size'  => array( 596, 696, true ),
						'title' => esc_html__( 'Team image', 'heaven11' ),
						'subst' => 'trx_addons-thumb-team',
					),

					// Properties slider image
					'heaven11-thumb-propertslider'        => array(
						'size'  => array( 1024, 866, true ),
						'title' => esc_html__( 'Properties slider image', 'heaven11' ),
						'subst' => 'trx_addons-thumb-propertslider',
					),

					// Properties image
					'heaven11-thumb-propert'        => array(
						'size'  => array( 812, 580, true ),
						'title' => esc_html__( 'Properties image', 'heaven11' ),
						'subst' => 'trx_addons-thumb-propert',
					),

					// Events image
					'heaven11-thumb-event'        => array(
						'size'  => array( 812, 494, true ),
						'title' => esc_html__( 'Events image', 'heaven11' ),
						'subst' => 'trx_addons-thumb-event',
					),

					// Services Tab Simple image
					'heaven11-thumb-services-tab'        => array(
						'size'  => array( 602, 458, true ),
						'title' => esc_html__( 'Services Tab Simple image', 'heaven11' ),
						'subst' => 'trx_addons-thumb-services-tab',
					),

					// Recent Magazine image
					'heaven11-thumb-mag'        => array(
						'size'  => array( 570, 334, true ),
						'title' => esc_html__( 'Recent Magazine image', 'heaven11' ),
						'subst' => 'trx_addons-thumb-mag',
					),

					// Agent image
					'heaven11-thumb-agent'        => array(
						'size'  => array( 714, 920, true ),
						'title' => esc_html__( 'Agent image', 'heaven11' ),
						'subst' => 'trx_addons-thumb-agent',
					),

					// Width of the image is equal to the content area width (with sidebar)
					// Height is proportional (only downscale, not crop)
					'heaven11-thumb-masonry-big' => array(
						'size'  => array( 760, 0, false ),     // Only downscale, not crop
						'title' => esc_html__( 'Masonry Large (scaled)', 'heaven11' ),
						'subst' => 'trx_addons-thumb-masonry-big',
					),

					// Width of the image is equal to the 1/3 of the full content area width (without sidebar)
					// Height is proportional (only downscale, not crop)
					'heaven11-thumb-masonry'     => array(
						'size'  => array( 370, 0, false ),     // Only downscale, not crop
						'title' => esc_html__( 'Masonry (scaled)', 'heaven11' ),
						'subst' => 'trx_addons-thumb-masonry',
					),
				)
			)
		);
	}
}




//------------------------------------------------------------------------
// One-click import support
//------------------------------------------------------------------------

// Set theme specific importer options
if ( ! function_exists( 'heaven11_importer_set_options' ) ) {
	add_filter( 'trx_addons_filter_importer_options', 'heaven11_importer_set_options', 9 );
	function heaven11_importer_set_options( $options = array() ) {
		if ( is_array( $options ) ) {
			// Save or not installer's messages to the log-file
			$options['debug'] = false;
			// Allow import/export functionality
			$options['allow_import'] = true;
			$options['allow_export'] = false;
			// Prepare demo data
			$options['demo_url'] = esc_url( heaven11_get_protocol() . '://demofiles.axiomthemes.com/heaven11/' );
			// Required plugins
			$options['required_plugins'] = array_keys( heaven11_storage_get( 'required_plugins' ) );
			// Set number of thumbnails (usually 3 - 5) to regenerate at once when its imported (if demo data was zipped without cropped images)
			// Set 0 to prevent regenerate thumbnails (if demo data archive is already contain cropped images)
			$options['regenerate_thumbnails'] = 0;
			// Default demo
			$options['files']['default']['title']       = esc_html__( 'Heaven11 Demo', 'heaven11' );
			$options['files']['default']['domain_dev'] = esc_url( heaven11_get_protocol() . '://heaven11.axiomthemes.com'); // Developers domain
			$options['files']['default']['domain_demo']= esc_url( heaven11_get_protocol() . '://heaven11.axiomthemes.com'); // Demo-site domain
			// If theme need more demo - just copy 'default' and change required parameter
			
			
			
			
			// The array with theme-specific banners, displayed during demo-content import.
			// If array with banners is empty - the banners are uploaded directly from demo-content server.
			$options['banners'] = array();
		}
		return $options;
	}
}


//------------------------------------------------------------------------
// OCDI support
//------------------------------------------------------------------------

// Set theme specific OCDI options
if ( ! function_exists( 'heaven11_ocdi_set_options' ) ) {
	add_filter( 'trx_addons_filter_ocdi_options', 'heaven11_ocdi_set_options', 9 );
	function heaven11_ocdi_set_options( $options = array() ) {
		if ( is_array( $options ) ) {
			// Prepare demo data
			$options['demo_url'] = esc_url( heaven11_get_protocol() . '://demofiles.axiomthemes.com/heaven11/' );
			// Required plugins
			$options['required_plugins'] = array_keys( heaven11_storage_get( 'required_plugins' ) );
			// Demo-site domain
			$options['files']['ocdi']['title']       = esc_html__( 'Heaven11 OCDI Demo', 'heaven11' );
			$options['files']['ocdi']['domain_demo'] = esc_url( heaven11_get_protocol() . '://heaven11.axiomthemes.com'); 
			// If theme need more demo - just copy 'default' and change required parameter
			
			
			
		}
		return $options;
	}
}


// -----------------------------------------------------------------
// -- Theme options for customizer
// -----------------------------------------------------------------
if ( ! function_exists( 'heaven11_create_theme_options' ) ) {

	function heaven11_create_theme_options() {

		// Message about options override.
		// Attention! Not need esc_html() here, because this message put in wp_kses_data() below
		$msg_override = __( 'Attention! Some of these options can be overridden in the following sections (Blog, Plugins settings, etc.) or in the settings of individual pages. If you changed such parameter and nothing happened on the page, this option may be overridden in the corresponding section or in the Page Options of this page. These options are marked with an asterisk (*) in the title.', 'heaven11' );

		// Color schemes number: if < 2 - hide fields with selectors
		$hide_schemes = count( heaven11_storage_get( 'schemes' ) ) < 2;

		heaven11_storage_set(
			'options', array(

				// 'Logo & Site Identity'
				'title_tagline'                 => array(
					'title'    => esc_html__( 'Logo & Site Identity', 'heaven11' ),
					'desc'     => '',
					'priority' => 10,
					'type'     => 'section',
				),
				'logo_info'                     => array(
					'title'    => esc_html__( 'Logo Settings', 'heaven11' ),
					'desc'     => '',
					'priority' => 20,
					'qsetup'   => esc_html__( 'General', 'heaven11' ),
					'type'     => 'info',
				),
				'logo_text'                     => array(
					'title'    => esc_html__( 'Use Site Name as Logo', 'heaven11' ),
					'desc'     => wp_kses_data( __( 'Use the site title and tagline as a text logo if no image is selected', 'heaven11' ) ),
					'class'    => 'heaven11_column-1_2 heaven11_new_row',
					'priority' => 30,
					'std'      => 1,
					'qsetup'   => esc_html__( 'General', 'heaven11' ),
					'type'     => HEAVEN11_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'logo_retina_enabled'           => array(
					'title'    => esc_html__( 'Allow retina display logo', 'heaven11' ),
					'desc'     => wp_kses_data( __( 'Show fields to select logo images for Retina display', 'heaven11' ) ),
					'class'    => 'heaven11_column-1_2',
					'priority' => 40,
					'refresh'  => false,
					'std'      => 0,
					'type'     => HEAVEN11_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'logo_zoom'                     => array(
					'title'   => esc_html__( 'Logo zoom', 'heaven11' ),
					'desc'    => wp_kses((
									__( 'Zoom the logo (set 1 to leave original size).', 'heaven11' )
									. ' <br>'
									. __( 'Attention! For this parameter to affect images, their max-height should be specified in "em" instead of "px" when creating a header.', 'heaven11' )
									. ' <br>'
									. __( 'In this case maximum size of logo depends on the actual size of the picture.', 'heaven11' )
								),'heaven11_kses_content' ),
					'std'     => 1,
					'min'     => 0.2,
					'max'     => 2,
					'step'    => 0.1,
					'refresh' => false,
					'type'    => HEAVEN11_THEME_FREE ? 'hidden' : 'slider',
				),
				// Parameter 'logo' was replaced with standard WordPress 'custom_logo'
				'logo_retina'                   => array(
					'title'      => esc_html__( 'Logo for Retina', 'heaven11' ),
					'desc'       => wp_kses_data( __( 'Select or upload site logo used on Retina displays (if empty - use default logo from the field above)', 'heaven11' ) ),
					'class'      => 'heaven11_column-1_2',
					'priority'   => 70,
					'dependency' => array(
						'logo_retina_enabled' => array( 1 ),
					),
					'std'        => '',
					'type'       => HEAVEN11_THEME_FREE ? 'hidden' : 'image',
				),
				'logo_mobile_header'            => array(
					'title' => esc_html__( 'Logo for the mobile header', 'heaven11' ),
					'desc'  => wp_kses_data( __( 'Select or upload site logo to display it in the mobile header (if enabled in the section "Header - Header mobile"', 'heaven11' ) ),
					'class' => 'heaven11_column-1_2 heaven11_new_row',
					'std'   => '',
					'type'  => 'image',
				),
				'logo_mobile_header_retina'     => array(
					'title'      => esc_html__( 'Logo for the mobile header on Retina', 'heaven11' ),
					'desc'       => wp_kses_data( __( 'Select or upload site logo used on Retina displays (if empty - use default logo from the field above)', 'heaven11' ) ),
					'class'      => 'heaven11_column-1_2',
					'dependency' => array(
						'logo_retina_enabled' => array( 1 ),
					),
					'std'        => '',
					'type'       => HEAVEN11_THEME_FREE ? 'hidden' : 'image',
				),
				'logo_mobile'                   => array(
					'title' => esc_html__( 'Logo for the mobile menu', 'heaven11' ),
					'desc'  => wp_kses_data( __( 'Select or upload site logo to display it in the mobile menu', 'heaven11' ) ),
					'class' => 'heaven11_column-1_2 heaven11_new_row',
					'std'   => '',
					'type'  => 'image',
				),
				'logo_mobile_retina'            => array(
					'title'      => esc_html__( 'Logo mobile on Retina', 'heaven11' ),
					'desc'       => wp_kses_data( __( 'Select or upload site logo used on Retina displays (if empty - use default logo from the field above)', 'heaven11' ) ),
					'class'      => 'heaven11_column-1_2',
					'dependency' => array(
						'logo_retina_enabled' => array( 1 ),
					),
					'std'        => '',
					'type'       => HEAVEN11_THEME_FREE ? 'hidden' : 'image',
				),
				'logo_side'                     => array(
					'title' => esc_html__( 'Logo for the side menu', 'heaven11' ),
					'desc'  => wp_kses_data( __( 'Select or upload site logo (with vertical orientation) to display it in the side menu', 'heaven11' ) ),
					'class' => 'heaven11_column-1_2 heaven11_new_row',
					'std'   => '',
					'type'  => 'image',
				),
				'logo_side_retina'              => array(
					'title'      => esc_html__( 'Logo for the side menu on Retina', 'heaven11' ),
					'desc'       => wp_kses_data( __( 'Select or upload site logo (with vertical orientation) to display it in the side menu on Retina displays (if empty - use default logo from the field above)', 'heaven11' ) ),
					'class'      => 'heaven11_column-1_2',
					'dependency' => array(
						'logo_retina_enabled' => array( 1 ),
					),
					'std'        => '',
					'type'       => HEAVEN11_THEME_FREE ? 'hidden' : 'image',
				),

				// 'General settings'
				'general'                       => array(
					'title'    => esc_html__( 'General Settings', 'heaven11' ),
					'desc'     => wp_kses_data( $msg_override ),
					'priority' => 20,
					'type'     => 'section',
				),

				'general_layout_info'           => array(
					'title'  => esc_html__( 'Layout', 'heaven11' ),
					'desc'   => '',
					'qsetup' => esc_html__( 'General', 'heaven11' ),
					'type'   => 'info',
				),
				'body_style'                    => array(
					'title'    => esc_html__( 'Body style', 'heaven11' ),
					'desc'     => wp_kses_data( __( 'Select width of the body content', 'heaven11' ) ),
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Content', 'heaven11' ),
					),
					'qsetup'   => esc_html__( 'General', 'heaven11' ),
					'refresh'  => false,
					'std'      => 'wide',
					'options'  => heaven11_get_list_body_styles( false ),
					'type'     => 'select',
				),
				'page_width'                    => array(
					'title'      => esc_html__( 'Page width', 'heaven11' ),
					'desc'       => wp_kses_data( __( 'Total width of the site content and sidebar (in pixels). If empty - use default width', 'heaven11' ) ),
					'dependency' => array(
						'body_style' => array( 'boxed', 'wide' ),
					),
					'std'        => 1170,
					'min'        => 1000,
					'max'        => 1400,
					'step'       => 10,
					'refresh'    => false,
					'customizer' => 'page',         // SASS variable's name to preview changes 'on fly'
					'type'       => HEAVEN11_THEME_FREE ? 'hidden' : 'slider',
				),
				'boxed_bg_image'                => array(
					'title'      => esc_html__( 'Boxed bg image', 'heaven11' ),
					'desc'       => wp_kses_data( __( 'Select or upload image, used as background in the boxed body', 'heaven11' ) ),
					'dependency' => array(
						'body_style' => array( 'boxed' ),
					),
					'override'   => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Content', 'heaven11' ),
					),
					'std'        => '',
					'qsetup'     => esc_html__( 'General', 'heaven11' ),
					
					'type'       => 'image',
				),
				'remove_margins'                => array(
					'title'    => esc_html__( 'Remove margins', 'heaven11' ),
					'desc'     => wp_kses_data( __( 'Remove margins above and below the content area', 'heaven11' ) ),
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Content', 'heaven11' ),
					),
					'refresh'  => false,
					'std'      => 0,
					'type'     => 'checkbox',
				),

				'general_sidebar_info'          => array(
					'title' => esc_html__( 'Sidebar', 'heaven11' ),
					'desc'  => '',
					'type'  => 'info',
				),
				'sidebar_position'              => array(
					'title'    => esc_html__( 'Sidebar position', 'heaven11' ),
					'desc'     => wp_kses_data( __( 'Select position to show sidebar', 'heaven11' ) ),
					'override' => array(
						'mode'    => 'page',		// Override parameters for single posts moved to the 'sidebar_position_single'
						'section' => esc_html__( 'Widgets', 'heaven11' ),
					),
					'std'      => 'right',
					'qsetup'   => esc_html__( 'General', 'heaven11' ),
					'options'  => array(),
					'type'     => 'switch',
				),
				'sidebar_position_mobile'       => array(
					'title'    => esc_html__( 'Sidebar position on mobile', 'heaven11' ),
					'desc'     => wp_kses_data( __( 'Select position to show sidebar on mobile devices - above or below the content', 'heaven11' ) ),
					'override' => array(
						'mode'    => 'page',		// Override parameters for single posts moved to the 'sidebar_position_mobile_single'
						'section' => esc_html__( 'Widgets', 'heaven11' ),
					),
					'dependency' => array(
						'sidebar_position' => array( '^hide' ),
					),
					'std'      => 'below',
					'qsetup'   => esc_html__( 'General', 'heaven11' ),
					'options'  => array(),
					'type'     => 'switch',
				),
				'sidebar_widgets'               => array(
					'title'      => esc_html__( 'Sidebar widgets', 'heaven11' ),
					'desc'       => wp_kses_data( __( 'Select default widgets to show in the sidebar', 'heaven11' ) ),
					'override'   => array(
						'mode'    => 'page',		// Override parameters for single posts moved to the 'sidebar_widgets_single'
						'section' => esc_html__( 'Widgets', 'heaven11' ),
					),
					'dependency' => array(
						'sidebar_position' => array( 'left', 'right' ),
					),
					'std'        => 'sidebar_widgets',
					'options'    => array(),
					'qsetup'     => esc_html__( 'General', 'heaven11' ),
					'type'       => 'select',
				),
				'sidebar_width'                 => array(
					'title'      => esc_html__( 'Sidebar width', 'heaven11' ),
					'desc'       => wp_kses_data( __( 'Width of the sidebar (in pixels). If empty - use default width', 'heaven11' ) ),
					'std'        => 370,
					'min'        => 150,
					'max'        => 500,
					'step'       => 10,
					'refresh'    => false,
					'customizer' => 'sidebar',      // SASS variable's name to preview changes 'on fly'
					'type'       => HEAVEN11_THEME_FREE ? 'hidden' : 'slider',
				),
				'sidebar_gap'                   => array(
					'title'      => esc_html__( 'Sidebar gap', 'heaven11' ),
					'desc'       => wp_kses_data( __( 'Gap between content and sidebar (in pixels). If empty - use default gap', 'heaven11' ) ),
					'std'        => 40,
					'min'        => 0,
					'max'        => 100,
					'step'       => 1,
					'refresh'    => false,
					'customizer' => 'gap',          // SASS variable's name to preview changes 'on fly'
					'type'       => HEAVEN11_THEME_FREE ? 'hidden' : 'slider',
				),
				'expand_content'                => array(
					'title'   => esc_html__( 'Expand content', 'heaven11' ),
					'desc'    => wp_kses_data( __( 'Expand the content width if the sidebar is hidden', 'heaven11' ) ),
					'refresh' => false,
					'override'   => array(
						'mode'    => 'page,post,product,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Widgets', 'heaven11' ),
					),
					'std'     => 1,
					'type'    => 'checkbox',
				),

				'general_widgets_info'          => array(
					'title' => esc_html__( 'Additional widgets', 'heaven11' ),
					'desc'  => '',
					'type'  => HEAVEN11_THEME_FREE ? 'hidden' : 'info',
				),
				'widgets_above_page'            => array(
					'title'    => esc_html__( 'Widgets at the top of the page', 'heaven11' ),
					'desc'     => wp_kses_data( __( 'Select widgets to show at the top of the page (above content and sidebar)', 'heaven11' ) ),
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Widgets', 'heaven11' ),
					),
					'std'      => 'hide',
					'options'  => array(),
					'type'     => HEAVEN11_THEME_FREE ? 'hidden' : 'select',
				),
				'widgets_above_content'         => array(
					'title'    => esc_html__( 'Widgets above the content', 'heaven11' ),
					'desc'     => wp_kses_data( __( 'Select widgets to show at the beginning of the content area', 'heaven11' ) ),
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Widgets', 'heaven11' ),
					),
					'std'      => 'hide',
					'options'  => array(),
					'type'     => HEAVEN11_THEME_FREE ? 'hidden' : 'select',
				),
				'widgets_below_content'         => array(
					'title'    => esc_html__( 'Widgets below the content', 'heaven11' ),
					'desc'     => wp_kses_data( __( 'Select widgets to show at the ending of the content area', 'heaven11' ) ),
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Widgets', 'heaven11' ),
					),
					'std'      => 'hide',
					'options'  => array(),
					'type'     => HEAVEN11_THEME_FREE ? 'hidden' : 'select',
				),
				'widgets_below_page'            => array(
					'title'    => esc_html__( 'Widgets at the bottom of the page', 'heaven11' ),
					'desc'     => wp_kses_data( __( 'Select widgets to show at the bottom of the page (below content and sidebar)', 'heaven11' ) ),
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Widgets', 'heaven11' ),
					),
					'std'      => 'hide',
					'options'  => array(),
					'type'     => HEAVEN11_THEME_FREE ? 'hidden' : 'select',
				),

				'general_effects_info'          => array(
					'title' => esc_html__( 'Design & Effects', 'heaven11' ),
					'desc'  => '',
					'type'  => 'info',
				),
				'border_radius'                 => array(
					'title'      => esc_html__( 'Border radius', 'heaven11' ),
					'desc'       => wp_kses_data( __( 'Specify the border radius of the form fields and buttons in pixels', 'heaven11' ) ),
					'std'        => 0,
					'min'        => 0,
					'max'        => 20,
					'step'       => 1,
					'refresh'    => false,
					'customizer' => 'rad',      // SASS name to preview changes 'on fly'
					'type'       => HEAVEN11_THEME_FREE ? 'hidden' : 'slider',
				),

				'general_misc_info'             => array(
					'title' => esc_html__( 'Miscellaneous', 'heaven11' ),
					'desc'  => '',
					'type'  => HEAVEN11_THEME_FREE ? 'hidden' : 'info',
				),
				'seo_snippets'                  => array(
					'title' => esc_html__( 'SEO snippets', 'heaven11' ),
					'desc'  => wp_kses_data( __( 'Add structured data markup to the single posts and pages', 'heaven11' ) ),
					'std'   => 0,
					'type'  => HEAVEN11_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'privacy_text' => array(
					"title" => esc_html__("Text with Privacy Policy link", 'heaven11'),
					"desc"  => wp_kses_data( __("Specify text with Privacy Policy link for the checkbox 'I agree ...'", 'heaven11') ),
					"std"   => wp_kses( __( 'I agree that my submitted data is being collected and stored.', 'heaven11' ), 'heaven11_kses_content' ),
					"type"  => "text"
				),

				// 'Header'
				'header'                        => array(
					'title'    => esc_html__( 'Header', 'heaven11' ),
					'desc'     => wp_kses_data( $msg_override ),
					'priority' => 30,
					'type'     => 'section',
				),

				'header_style_info'             => array(
					'title' => esc_html__( 'Header style', 'heaven11' ),
					'desc'  => '',
					'type'  => 'info',
				),
				'header_type'                   => array(
					'title'    => esc_html__( 'Header style', 'heaven11' ),
					'desc'     => wp_kses_data( __( 'Choose whether to use the default header or header Layouts (available only if the ThemeREX Addons is activated)', 'heaven11' ) ),
					'override' => array(
						'mode'    => 'page,post,product,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'heaven11' ),
					),
					'std'      => 'default',
					'options'  => heaven11_get_list_header_footer_types(),
					'type'     => HEAVEN11_THEME_FREE || ! heaven11_exists_trx_addons() ? 'hidden' : 'switch',
				),
				'header_style'                  => array(
					'title'      => esc_html__( 'Select custom layout', 'heaven11' ),
					'desc'       => wp_kses( __( 'Select custom header from Layouts Builder', 'heaven11' ), 'heaven11_kses_content' ),
					'override'   => array(
						'mode'    => 'page,post,product,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'heaven11' ),
					),
					'dependency' => array(
						'header_type' => array( 'custom' ),
					),
					'std'        => HEAVEN11_THEME_FREE ? 'header-custom-elementor-header-default' : 'header-custom-header-default',
					'options'    => array(),
					'type'       => 'select',
				),
				'header_position'               => array(
					'title'    => esc_html__( 'Header position', 'heaven11' ),
					'desc'     => wp_kses_data( __( 'Select position to display the site header', 'heaven11' ) ),
					'override' => array(
						'mode'    => 'page,post,product,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'heaven11' ),
					),
					'std'      => 'default',
					'options'  => array(),
					'type'     => HEAVEN11_THEME_FREE ? 'hidden' : 'switch',
				),
				'header_fullheight'             => array(
					'title'    => esc_html__( 'Header fullheight', 'heaven11' ),
					'desc'     => wp_kses_data( __( 'Enlarge header area to fill whole screen. Used only if header have a background image', 'heaven11' ) ),
					'override' => array(
						'mode'    => 'page,post,product,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'heaven11' ),
					),
					'std'      => 0,
					'type'     => HEAVEN11_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'header_wide'                   => array(
					'title'      => esc_html__( 'Header fullwidth', 'heaven11' ),
					'desc'       => wp_kses_data( __( 'Do you want to stretch the header widgets area to the entire window width?', 'heaven11' ) ),
					'override'   => array(
						'mode'    => 'page,post,product,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'heaven11' ),
					),
					'dependency' => array(
						'header_type' => array( 'default' ),
					),
					'std'        => 1,
					'type'       => HEAVEN11_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'header_zoom'                   => array(
					'title'   => esc_html__( 'Header zoom', 'heaven11' ),
					'desc'    => wp_kses_data( __( 'Zoom the header title. 1 - original size', 'heaven11' ) ),
					'std'     => 1,
					'min'     => 0.3,
					'max'     => 2,
					'step'    => 0.1,
					'refresh' => false,
					'type'    => HEAVEN11_THEME_FREE ? 'hidden' : 'slider',
				),

				'header_widgets_info'           => array(
					'title' => esc_html__( 'Header widgets', 'heaven11' ),
					'desc'  => wp_kses_data( __( 'Here you can place a widget slider, advertising banners, etc.', 'heaven11' ) ),
					'type'  => 'info',
				),
				'header_widgets'                => array(
					'title'    => esc_html__( 'Header widgets', 'heaven11' ),
					'desc'     => wp_kses_data( __( 'Select set of widgets to show in the header on each page', 'heaven11' ) ),
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'heaven11' ),
						'desc'    => wp_kses_data( __( 'Select set of widgets to show in the header on this page', 'heaven11' ) ),
					),
					'std'      => 'hide',
					'options'  => array(),
					'type'     => 'select',
				),
				'header_columns'                => array(
					'title'      => esc_html__( 'Header columns', 'heaven11' ),
					'desc'       => wp_kses_data( __( 'Select number columns to show widgets in the Header. If 0 - autodetect by the widgets count', 'heaven11' ) ),
					'override'   => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'heaven11' ),
					),
					'dependency' => array(
						'header_widgets' => array( '^hide' ),
					),
					'std'        => 0,
					'options'    => heaven11_get_list_range( 0, 6 ),
					'type'       => 'select',
				),

				'menu_info'                     => array(
					'title' => esc_html__( 'Main menu', 'heaven11' ),
					'desc'  => wp_kses_data( __( 'Select main menu style, position and other parameters', 'heaven11' ) ),
					'type'  => HEAVEN11_THEME_FREE ? 'hidden' : 'info',
				),
				'menu_style'                    => array(
					'title'    => esc_html__( 'Menu position', 'heaven11' ),
					'desc'     => wp_kses_data( __( 'Select position of the main menu', 'heaven11' ) ),
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'heaven11' ),
					),
					'std'      => 'top',
					'options'  => array(
						'top'   => esc_html__( 'Top', 'heaven11' ),
						'left'  => esc_html__( 'Left', 'heaven11' ),
						'right' => esc_html__( 'Right', 'heaven11' ),
					),
					'type'     => HEAVEN11_THEME_FREE || ! heaven11_exists_trx_addons() ? 'hidden' : 'switch',
				),
				'menu_side_stretch'             => array(
					'title'      => esc_html__( 'Stretch sidemenu', 'heaven11' ),
					'desc'       => wp_kses_data( __( 'Stretch sidemenu to window height (if menu items number >= 5)', 'heaven11' ) ),
					'override'   => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'heaven11' ),
					),
					'dependency' => array(
						'menu_style' => array( 'left', 'right' ),
					),
					'std'        => 0,
					'type'       => HEAVEN11_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'menu_side_icons'               => array(
					'title'      => esc_html__( 'Iconed sidemenu', 'heaven11' ),
					'desc'       => wp_kses_data( __( 'Get icons from anchors and display it in the sidemenu or mark sidemenu items with simple dots', 'heaven11' ) ),
					'override'   => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'heaven11' ),
					),
					'dependency' => array(
						'menu_style' => array( 'left', 'right' ),
					),
					'std'        => 1,
					'type'       => HEAVEN11_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'menu_mobile_fullscreen'        => array(
					'title' => esc_html__( 'Mobile menu fullscreen', 'heaven11' ),
					'desc'  => wp_kses_data( __( 'Display mobile and side menus on full screen (if checked) or slide narrow menu from the left or from the right side (if not checked)', 'heaven11' ) ),
					'std'   => 1,
					'type'  => HEAVEN11_THEME_FREE ? 'hidden' : 'checkbox',
				),

				'header_image_info'             => array(
					'title' => esc_html__( 'Header image', 'heaven11' ),
					'desc'  => '',
					'type'  => HEAVEN11_THEME_FREE ? 'hidden' : 'info',
				),
				'header_image_override'         => array(
					'title'    => esc_html__( 'Header image override', 'heaven11' ),
					'desc'     => wp_kses_data( __( "Allow override the header image with the page's/post's/product's/etc. featured image", 'heaven11' ) ),
					'override' => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Header', 'heaven11' ),
					),
					'std'      => 0,
					'type'     => HEAVEN11_THEME_FREE ? 'hidden' : 'checkbox',
				),

				'header_mobile_info'            => array(
					'title'      => esc_html__( 'Mobile header', 'heaven11' ),
					'desc'       => wp_kses_data( __( 'Configure the mobile version of the header', 'heaven11' ) ),
					'priority'   => 500,
					'dependency' => array(
						'header_type' => array( 'default' ),
					),
					'type'       => HEAVEN11_THEME_FREE ? 'hidden' : 'info',
				),
				'header_mobile_enabled'         => array(
					'title'      => esc_html__( 'Enable the mobile header', 'heaven11' ),
					'desc'       => wp_kses_data( __( 'Use the mobile version of the header (if checked) or relayout the current header on mobile devices', 'heaven11' ) ),
					'dependency' => array(
						'header_type' => array( 'default' ),
					),
					'std'        => 0,
					'type'       => HEAVEN11_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'header_mobile_additional_info' => array(
					'title'      => esc_html__( 'Additional info', 'heaven11' ),
					'desc'       => wp_kses_data( __( 'Additional info to show at the top of the mobile header', 'heaven11' ) ),
					'std'        => '',
					'dependency' => array(
						'header_type'           => array( 'default' ),
						'header_mobile_enabled' => array( 1 ),
					),
					'refresh'    => false,
					'teeny'      => false,
					'rows'       => 20,
					'type'       => HEAVEN11_THEME_FREE ? 'hidden' : 'text_editor',
				),
				'header_mobile_hide_info'       => array(
					'title'      => esc_html__( 'Hide additional info', 'heaven11' ),
					'std'        => 0,
					'dependency' => array(
						'header_type'           => array( 'default' ),
						'header_mobile_enabled' => array( 1 ),
					),
					'type'       => HEAVEN11_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'header_mobile_hide_logo'       => array(
					'title'      => esc_html__( 'Hide logo', 'heaven11' ),
					'std'        => 0,
					'dependency' => array(
						'header_type'           => array( 'default' ),
						'header_mobile_enabled' => array( 1 ),
					),
					'type'       => HEAVEN11_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'header_mobile_hide_login'      => array(
					'title'      => esc_html__( 'Hide login/logout', 'heaven11' ),
					'std'        => 0,
					'dependency' => array(
						'header_type'           => array( 'default' ),
						'header_mobile_enabled' => array( 1 ),
					),
					'type'       => HEAVEN11_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'header_mobile_hide_search'     => array(
					'title'      => esc_html__( 'Hide search', 'heaven11' ),
					'std'        => 0,
					'dependency' => array(
						'header_type'           => array( 'default' ),
						'header_mobile_enabled' => array( 1 ),
					),
					'type'       => HEAVEN11_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'header_mobile_hide_cart'       => array(
					'title'      => esc_html__( 'Hide cart', 'heaven11' ),
					'std'        => 0,
					'dependency' => array(
						'header_type'           => array( 'default' ),
						'header_mobile_enabled' => array( 1 ),
					),
					'type'       => HEAVEN11_THEME_FREE ? 'hidden' : 'checkbox',
				),

				// 'Footer'
				'footer'                        => array(
					'title'    => esc_html__( 'Footer', 'heaven11' ),
					'desc'     => wp_kses_data( $msg_override ),
					'priority' => 50,
					'type'     => 'section',
				),
				'footer_type'                   => array(
					'title'    => esc_html__( 'Footer style', 'heaven11' ),
					'desc'     => wp_kses_data( __( 'Choose whether to use the default footer or footer Layouts (available only if the ThemeREX Addons is activated)', 'heaven11' ) ),
					'override' => array(
						'mode'    => 'page,post,product,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Footer', 'heaven11' ),
					),
					'std'      => 'default',
					'options'  => heaven11_get_list_header_footer_types(),
					'type'     => HEAVEN11_THEME_FREE || ! heaven11_exists_trx_addons() ? 'hidden' : 'switch',
				),
				'footer_style'                  => array(
					'title'      => esc_html__( 'Select custom layout', 'heaven11' ),
					'desc'       => wp_kses( __( 'Select custom footer from Layouts Builder', 'heaven11' ), 'heaven11_kses_content' ),
					'override'   => array(
						'mode'    => 'page,post,product,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Footer', 'heaven11' ),
					),
					'dependency' => array(
						'footer_type' => array( 'custom' ),
					),
					'std'        => HEAVEN11_THEME_FREE ? 'footer-custom-elementor-footer-default' : 'footer-custom-footer-default',
					'options'    => array(),
					'type'       => 'select',
				),
				'footer_widgets'                => array(
					'title'      => esc_html__( 'Footer widgets', 'heaven11' ),
					'desc'       => wp_kses_data( __( 'Select set of widgets to show in the footer', 'heaven11' ) ),
					'override'   => array(
						'mode'    => 'page,post,product,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Footer', 'heaven11' ),
					),
					'dependency' => array(
						'footer_type' => array( 'default' ),
					),
					'std'        => 'footer_widgets',
					'options'    => array(),
					'type'       => 'select',
				),
				'footer_columns'                => array(
					'title'      => esc_html__( 'Footer columns', 'heaven11' ),
					'desc'       => wp_kses_data( __( 'Select number columns to show widgets in the footer. If 0 - autodetect by the widgets count', 'heaven11' ) ),
					'override'   => array(
						'mode'    => 'page,post,product,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Footer', 'heaven11' ),
					),
					'dependency' => array(
						'footer_type'    => array( 'default' ),
						'footer_widgets' => array( '^hide' ),
					),
					'std'        => 0,
					'options'    => heaven11_get_list_range( 0, 6 ),
					'type'       => 'select',
				),
				'footer_wide'                   => array(
					'title'      => esc_html__( 'Footer fullwidth', 'heaven11' ),
					'desc'       => wp_kses_data( __( 'Do you want to stretch the footer to the entire window width?', 'heaven11' ) ),
					'override'   => array(
						'mode'    => 'page,post,product,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Footer', 'heaven11' ),
					),
					'dependency' => array(
						'footer_type' => array( 'default' ),
					),
					'std'        => 0,
					'type'       => 'checkbox',
				),
				'logo_in_footer'                => array(
					'title'      => esc_html__( 'Show logo', 'heaven11' ),
					'desc'       => wp_kses_data( __( 'Show logo in the footer', 'heaven11' ) ),
					'refresh'    => false,
					'dependency' => array(
						'footer_type' => array( 'default' ),
					),
					'std'        => 0,
					'type'       => 'checkbox',
				),
				'logo_footer'                   => array(
					'title'      => esc_html__( 'Logo for footer', 'heaven11' ),
					'desc'       => wp_kses_data( __( 'Select or upload site logo to display it in the footer', 'heaven11' ) ),
					'dependency' => array(
						'footer_type'    => array( 'default' ),
						'logo_in_footer' => array( 1 ),
					),
					'std'        => '',
					'type'       => 'image',
				),
				'logo_footer_retina'            => array(
					'title'      => esc_html__( 'Logo for footer (Retina)', 'heaven11' ),
					'desc'       => wp_kses_data( __( 'Select or upload logo for the footer area used on Retina displays (if empty - use default logo from the field above)', 'heaven11' ) ),
					'dependency' => array(
						'footer_type'         => array( 'default' ),
						'logo_in_footer'      => array( 1 ),
						'logo_retina_enabled' => array( 1 ),
					),
					'std'        => '',
					'type'       => HEAVEN11_THEME_FREE ? 'hidden' : 'image',
				),
				'socials_in_footer'             => array(
					'title'      => esc_html__( 'Show social icons', 'heaven11' ),
					'desc'       => wp_kses_data( __( 'Show social icons in the footer (under logo or footer widgets)', 'heaven11' ) ),
					'dependency' => array(
						'footer_type' => array( 'default' ),
					),
					'std'        => 0,
					'type'       => ! heaven11_exists_trx_addons() ? 'hidden' : 'checkbox',
				),
				'copyright'                     => array(
					'title'      => esc_html__( 'Copyright', 'heaven11' ),
					'desc'       => wp_kses_data( __( 'Copyright text in the footer. Use {Y} to insert current year and press "Enter" to create a new line', 'heaven11' ) ),
					'translate'  => true,
					'std'        => esc_html__( 'Copyright &copy; {Y} by AxiomThemes. All rights reserved.', 'heaven11' ),
					'dependency' => array(
						'footer_type' => array( 'default' ),
					),
					'refresh'    => false,
					'type'       => 'textarea',
				),

				// 'Blog'
				'blog'                          => array(
					'title'    => esc_html__( 'Blog', 'heaven11' ),
					'desc'     => wp_kses_data( __( 'Options of the the blog archive', 'heaven11' ) ),
					'priority' => 70,
					'type'     => 'panel',
				),

				// Blog - Posts page
				'blog_general'                  => array(
					'title' => esc_html__( 'Posts page', 'heaven11' ),
					'desc'  => wp_kses_data( __( 'Style and components of the blog archive', 'heaven11' ) ),
					'type'  => 'section',
				),
				'blog_general_info'             => array(
					'title'  => esc_html__( 'Posts page settings', 'heaven11' ),
					'desc'   => '',
					'qsetup' => esc_html__( 'General', 'heaven11' ),
					'type'   => 'info',
				),
				'blog_style'                    => array(
					'title'      => esc_html__( 'Blog style', 'heaven11' ),
					'desc'       => '',
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'heaven11' ),
					),
					'dependency' => array(
						'compare' => 'or',
						'#page_template' => array( 'blog.php' ),
						'.editor-page-attributes__template select' => array( 'blog.php' ),
					),
					'std'        => 'excerpt',
					'qsetup'     => esc_html__( 'General', 'heaven11' ),
					'options'    => array(),
					'type'       => 'select',
				),
				'first_post_large'              => array(
					'title'      => esc_html__( 'First post large', 'heaven11' ),
					'desc'       => wp_kses_data( __( 'Make your first post stand out by making it bigger', 'heaven11' ) ),
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'heaven11' ),
					),
					'dependency' => array(
						'compare' => 'or',
						'#page_template' => array( 'blog.php' ),
						'.editor-page-attributes__template select' => array( 'blog.php' ),
						'blog_style' => array( 'classic', 'masonry' ),
					),
					'std'        => 0,
					'type'       => 'checkbox',
				),
				'blog_content'                  => array(
					'title'      => esc_html__( 'Posts content', 'heaven11' ),
					'desc'       => wp_kses_data( __( 'Display either post excerpts or the full post content', 'heaven11' ) ),
					'std'        => 'excerpt',
					'dependency' => array(
						'blog_style' => array( 'excerpt' ),
					),
					'options'    => array(
						'excerpt'  => esc_html__( 'Excerpt', 'heaven11' ),
						'fullpost' => esc_html__( 'Full post', 'heaven11' ),
					),
					'type'       => 'switch',
				),
				'excerpt_length'                => array(
					'title'      => esc_html__( 'Excerpt length', 'heaven11' ),
					'desc'       => wp_kses_data( __( 'Length (in words) to generate excerpt from the post content. Attention! If the post excerpt is explicitly specified - it appears unchanged', 'heaven11' ) ),
					'dependency' => array(
						'blog_style'   => array( 'excerpt' ),
						'blog_content' => array( 'excerpt' ),
					),
					'std'        => 0,
					'type'       => 'text',
				),
				'blog_columns'                  => array(
					'title'   => esc_html__( 'Blog columns', 'heaven11' ),
					'desc'    => wp_kses_data( __( 'How many columns should be used in the blog archive (from 2 to 4)?', 'heaven11' ) ),
					'std'     => 2,
					'options' => heaven11_get_list_range( 2, 4 ),
					'type'    => 'hidden',      // This options is available and must be overriden only for some modes (for example, 'shop')
				),
				'post_type'                     => array(
					'title'      => esc_html__( 'Post type', 'heaven11' ),
					'desc'       => wp_kses_data( __( 'Select post type to show in the blog archive', 'heaven11' ) ),
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'heaven11' ),
					),
					'dependency' => array(
						'compare' => 'or',
						'#page_template' => array( 'blog.php' ),
						'.editor-page-attributes__template select' => array( 'blog.php' ),
					),
					'linked'     => 'parent_cat',
					'refresh'    => false,
					'hidden'     => true,
					'std'        => 'post',
					'options'    => array(),
					'type'       => 'select',
				),
				'parent_cat'                    => array(
					'title'      => esc_html__( 'Category to show', 'heaven11' ),
					'desc'       => wp_kses_data( __( 'Select category to show in the blog archive', 'heaven11' ) ),
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'heaven11' ),
					),
					'dependency' => array(
						'compare' => 'or',
						'#page_template' => array( 'blog.php' ),
						'.editor-page-attributes__template select' => array( 'blog.php' ),
					),
					'refresh'    => false,
					'hidden'     => true,
					'std'        => '0',
					'options'    => array(),
					'type'       => 'select',
				),
				'posts_per_page'                => array(
					'title'      => esc_html__( 'Posts per page', 'heaven11' ),
					'desc'       => wp_kses_data( __( 'How many posts will be displayed on this page', 'heaven11' ) ),
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'heaven11' ),
					),
					'dependency' => array(
						'compare' => 'or',
						'#page_template' => array( 'blog.php' ),
						'.editor-page-attributes__template select' => array( 'blog.php' ),
					),
					'hidden'     => true,
					'std'        => '',
					'type'       => 'text',
				),
				'blog_pagination'               => array(
					'title'      => esc_html__( 'Pagination style', 'heaven11' ),
					'desc'       => wp_kses_data( __( 'Show Older/Newest posts or Page numbers below the posts list', 'heaven11' ) ),
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'heaven11' ),
					),
					'std'        => 'pages',
					'qsetup'     => esc_html__( 'General', 'heaven11' ),
					'dependency' => array(
						'compare' => 'or',
						'#page_template' => array( 'blog.php' ),
						'.editor-page-attributes__template select' => array( 'blog.php' ),
					),
					'options'    => array(
						'pages'    => esc_html__( 'Page numbers', 'heaven11' ),
						'links'    => esc_html__( 'Older/Newest', 'heaven11' ),
						'more'     => esc_html__( 'Load more', 'heaven11' ),
						'infinite' => esc_html__( 'Infinite scroll', 'heaven11' ),
					),
					'type'       => 'select',
				),
				'blog_animation'                => array(
					'title'      => esc_html__( 'Animation for the posts', 'heaven11' ),
					'desc'       => wp_kses_data( __( 'Select animation to show posts in the blog. Attention! Do not use any animation on pages with the "wheel to the anchor" behaviour (like a "Chess 2 columns")!', 'heaven11' ) ),
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'heaven11' ),
					),
					'dependency' => array(
						'compare' => 'or',
						'#page_template' => array( 'blog.php' ),
						'.editor-page-attributes__template select' => array( 'blog.php' ),
					),
					'std'        => 'none',
					'options'    => array(),
					'type'       => HEAVEN11_THEME_FREE ? 'hidden' : 'select',
				),
				'show_filters'                  => array(
					'title'      => esc_html__( 'Show filters', 'heaven11' ),
					'desc'       => wp_kses_data( __( 'Show categories as tabs to filter posts', 'heaven11' ) ),
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'heaven11' ),
					),
					'dependency' => array(
						'compare' => 'or',
						'#page_template' => array( 'blog.php' ),
						'.editor-page-attributes__template select' => array( 'blog.php' ),
						'blog_style'     => array( 'portfolio', 'gallery' ),
					),
					'hidden'     => true,
					'std'        => 0,
					'type'       => HEAVEN11_THEME_FREE ? 'hidden' : 'checkbox',
				),

				'blog_header_info'              => array(
					'title' => esc_html__( 'Header', 'heaven11' ),
					'desc'  => '',
					'type'  => 'info',
				),
				'header_type_blog'              => array(
					'title'    => esc_html__( 'Header style', 'heaven11' ),
					'desc'     => wp_kses_data( __( 'Choose whether to use the default header or header Layouts (available only if the ThemeREX Addons is activated)', 'heaven11' ) ),
					'std'      => 'inherit',
					'options'  => heaven11_get_list_header_footer_types( true ),
					'type'     => HEAVEN11_THEME_FREE || ! heaven11_exists_trx_addons() ? 'hidden' : 'switch',
				),
				'header_style_blog'             => array(
					'title'      => esc_html__( 'Select custom layout', 'heaven11' ),
					'desc'       => wp_kses( __( 'Select custom header from Layouts Builder', 'heaven11' ), 'heaven11_kses_content' ),
					'dependency' => array(
						'header_type_blog' => array( 'custom' ),
					),
					'std'        => HEAVEN11_THEME_FREE ? 'header-custom-elementor-header-default' : 'header-custom-header-default',
					'options'    => array(),
					'type'       => 'select',
				),
				'header_position_blog'          => array(
					'title'    => esc_html__( 'Header position', 'heaven11' ),
					'desc'     => wp_kses_data( __( 'Select position to display the site header', 'heaven11' ) ),
					'std'      => 'inherit',
					'options'  => array(),
					'type'     => HEAVEN11_THEME_FREE ? 'hidden' : 'switch',
				),
				'header_fullheight_blog'        => array(
					'title'    => esc_html__( 'Header fullheight', 'heaven11' ),
					'desc'     => wp_kses_data( __( 'Enlarge header area to fill whole screen. Used only if header have a background image', 'heaven11' ) ),
					'std'      => 0,
					'type'     => HEAVEN11_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'header_wide_blog'              => array(
					'title'      => esc_html__( 'Header fullwidth', 'heaven11' ),
					'desc'       => wp_kses_data( __( 'Do you want to stretch the header widgets area to the entire window width?', 'heaven11' ) ),
					'dependency' => array(
						'header_type_blog' => array( 'default' ),
					),
					'std'        => 1,
					'type'       => HEAVEN11_THEME_FREE ? 'hidden' : 'checkbox',
				),

				'blog_sidebar_info'             => array(
					'title' => esc_html__( 'Sidebar', 'heaven11' ),
					'desc'  => '',
					'type'  => 'info',
				),
				'sidebar_position_blog'         => array(
					'title'   => esc_html__( 'Sidebar position', 'heaven11' ),
					'desc'    => wp_kses_data( __( 'Select position to show sidebar', 'heaven11' ) ),
					'std'     => 'inherit',
					'options' => array(),
					'qsetup'     => esc_html__( 'General', 'heaven11' ),
					'type'    => 'switch',
				),
				'sidebar_position_mobile_blog'  => array(
					'title'    => esc_html__( 'Sidebar position on mobile', 'heaven11' ),
					'desc'     => wp_kses_data( __( 'Select position to show sidebar on mobile devices - above or below the content', 'heaven11' ) ),
					'dependency' => array(
						'sidebar_position_blog' => array( '^hide' ),
					),
					'std'      => 'inherit',
					'qsetup'   => esc_html__( 'General', 'heaven11' ),
					'options'  => array(),
					'type'     => 'switch',
				),
				'sidebar_widgets_blog'          => array(
					'title'      => esc_html__( 'Sidebar widgets', 'heaven11' ),
					'desc'       => wp_kses_data( __( 'Select default widgets to show in the sidebar', 'heaven11' ) ),
					'dependency' => array(
						'sidebar_position_blog' => array( '^hide' ),
					),
					'std'        => 'sidebar_widgets',
					'options'    => array(),
					'qsetup'     => esc_html__( 'General', 'heaven11' ),
					'type'       => 'select',
				),
				'expand_content_blog'           => array(
					'title'   => esc_html__( 'Expand content', 'heaven11' ),
					'desc'    => wp_kses_data( __( 'Expand the content width if the sidebar is hidden', 'heaven11' ) ),
					'refresh' => false,
					'std'     => 1,
					'type'    => 'checkbox',
				),

				'blog_widgets_info'             => array(
					'title' => esc_html__( 'Additional widgets', 'heaven11' ),
					'desc'  => '',
					'type'  => HEAVEN11_THEME_FREE ? 'hidden' : 'info',
				),
				'widgets_above_page_blog'       => array(
					'title'   => esc_html__( 'Widgets at the top of the page', 'heaven11' ),
					'desc'    => wp_kses_data( __( 'Select widgets to show at the top of the page (above content and sidebar)', 'heaven11' ) ),
					'std'     => 'hide',
					'options' => array(),
					'type'    => HEAVEN11_THEME_FREE ? 'hidden' : 'select',
				),
				'widgets_above_content_blog'    => array(
					'title'   => esc_html__( 'Widgets above the content', 'heaven11' ),
					'desc'    => wp_kses_data( __( 'Select widgets to show at the beginning of the content area', 'heaven11' ) ),
					'std'     => 'hide',
					'options' => array(),
					'type'    => HEAVEN11_THEME_FREE ? 'hidden' : 'select',
				),
				'widgets_below_content_blog'    => array(
					'title'   => esc_html__( 'Widgets below the content', 'heaven11' ),
					'desc'    => wp_kses_data( __( 'Select widgets to show at the ending of the content area', 'heaven11' ) ),
					'std'     => 'hide',
					'options' => array(),
					'type'    => HEAVEN11_THEME_FREE ? 'hidden' : 'select',
				),
				'widgets_below_page_blog'       => array(
					'title'   => esc_html__( 'Widgets at the bottom of the page', 'heaven11' ),
					'desc'    => wp_kses_data( __( 'Select widgets to show at the bottom of the page (below content and sidebar)', 'heaven11' ) ),
					'std'     => 'hide',
					'options' => array(),
					'type'    => HEAVEN11_THEME_FREE ? 'hidden' : 'select',
				),

				'blog_advanced_info'            => array(
					'title' => esc_html__( 'Advanced settings', 'heaven11' ),
					'desc'  => '',
					'type'  => 'info',
				),
				'no_image'                      => array(
					'title' => esc_html__( 'Image placeholder', 'heaven11' ),
					'desc'  => wp_kses_data( __( 'Select or upload an image used as placeholder for posts without a featured image', 'heaven11' ) ),
					'std'   => '',
					'type'  => 'image',
				),
				'time_diff_before'              => array(
					'title' => esc_html__( 'Easy Readable Date Format', 'heaven11' ),
					'desc'  => wp_kses_data( __( "For how many days to show the easy-readable date format (e.g. '3 days ago') instead of the standard publication date", 'heaven11' ) ),
					'std'   => 5,
					'type'  => 'text',
				),
				'sticky_style'                  => array(
					'title'   => esc_html__( 'Sticky posts style', 'heaven11' ),
					'desc'    => wp_kses_data( __( 'Select style of the sticky posts output', 'heaven11' ) ),
					'std'     => 'inherit',
					'options' => array(
						'inherit' => esc_html__( 'Decorated posts', 'heaven11' ),
						'columns' => esc_html__( 'Mini-cards', 'heaven11' ),
					),
					'type'    => HEAVEN11_THEME_FREE ? 'hidden' : 'select',
				),
				'meta_parts'                    => array(
					'title'      => esc_html__( 'Post meta', 'heaven11' ),
					'desc'       => wp_kses_data( __( "If your blog page is created using the 'Blog archive' page template, set up the 'Post Meta' settings in the 'Theme Options' section of that page. Post counters and Share Links are available only if plugin ThemeREX Addons is active", 'heaven11' ) )
								. '<br>'
								. wp_kses_data( __( '<b>Tip:</b> Drag items to change their order.', 'heaven11' ) ),
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'heaven11' ),
					),
					'dependency' => array(
						'compare' => 'or',
						'#page_template' => array( 'blog.php' ),
						'.editor-page-attributes__template select' => array( 'blog.php' ),
					),
					'dir'        => 'vertical',
					'sortable'   => true,
					'std'        => 'categories=1|date=1|views=1|likes=1|comments=1|author=0|share=0|edit=1',
					'options'    => heaven11_get_list_meta_parts(),
					'type'       => HEAVEN11_THEME_FREE ? 'hidden' : 'checklist',
				),

				// Blog - Single posts
				'blog_single'                   => array(
					'title' => esc_html__( 'Single posts', 'heaven11' ),
					'desc'  => wp_kses_data( __( 'Settings of the single post', 'heaven11' ) ),
					'type'  => 'section',
				),

				'blog_single_header_info'       => array(
					'title' => esc_html__( 'Header', 'heaven11' ),
					'desc'  => '',
					'type'  => 'info',
				),
				'header_type_post'              => array(
					'title'    => esc_html__( 'Header style', 'heaven11' ),
					'desc'     => wp_kses_data( __( 'Choose whether to use the default header or header Layouts (available only if the ThemeREX Addons is activated)', 'heaven11' ) ),
					'std'      => 'inherit',
					'options'  => heaven11_get_list_header_footer_types( true ),
					'type'     => HEAVEN11_THEME_FREE || ! heaven11_exists_trx_addons() ? 'hidden' : 'switch',
				),
				'header_style_post'             => array(
					'title'      => esc_html__( 'Select custom layout', 'heaven11' ),
					'desc'       => wp_kses( __( 'Select custom header from Layouts Builder', 'heaven11' ), 'heaven11_kses_content' ),
					'dependency' => array(
						'header_type_post' => array( 'custom' ),
					),
					'std'        => HEAVEN11_THEME_FREE ? 'header-custom-elementor-header-default' : 'header-custom-header-default',
					'options'    => array(),
					'type'       => 'select',
				),
				'header_position_post'          => array(
					'title'    => esc_html__( 'Header position', 'heaven11' ),
					'desc'     => wp_kses_data( __( 'Select position to display the site header', 'heaven11' ) ),
					'std'      => 'inherit',
					'options'  => array(),
					'type'     => HEAVEN11_THEME_FREE ? 'hidden' : 'switch',
				),
				'header_fullheight_post'        => array(
					'title'    => esc_html__( 'Header fullheight', 'heaven11' ),
					'desc'     => wp_kses_data( __( 'Enlarge header area to fill whole screen. Used only if header have a background image', 'heaven11' ) ),
					'std'      => 0,
					'type'     => HEAVEN11_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'header_wide_post'              => array(
					'title'      => esc_html__( 'Header fullwidth', 'heaven11' ),
					'desc'       => wp_kses_data( __( 'Do you want to stretch the header widgets area to the entire window width?', 'heaven11' ) ),
					'dependency' => array(
						'header_type_post' => array( 'default' ),
					),
					'std'        => 1,
					'type'       => HEAVEN11_THEME_FREE ? 'hidden' : 'checkbox',
				),

				'blog_single_sidebar_info'      => array(
					'title' => esc_html__( 'Sidebar', 'heaven11' ),
					'desc'  => '',
					'type'  => 'info',
				),
				'sidebar_position_single'       => array(
					'title'   => esc_html__( 'Sidebar position', 'heaven11' ),
					'desc'    => wp_kses_data( __( 'Select position to show sidebar on the single posts', 'heaven11' ) ),
					'std'     => 'right',
					'override'   => array(
						'mode'    => 'post,product,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Widgets', 'heaven11' ),
					),
					'options' => array(),
					'type'    => 'switch',
				),
				'sidebar_position_mobile_single'=> array(
					'title'    => esc_html__( 'Sidebar position on mobile', 'heaven11' ),
					'desc'     => wp_kses_data( __( 'Select position to show sidebar on the single posts on mobile devices - above or below the content', 'heaven11' ) ),
					'override' => array(
						'mode'    => 'post,product,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Widgets', 'heaven11' ),
					),
					'dependency' => array(
						'sidebar_position_single' => array( '^hide' ),
					),
					'std'      => 'below',
					'options'  => array(),
					'type'     => 'switch',
				),
				'sidebar_widgets_single'        => array(
					'title'      => esc_html__( 'Sidebar widgets', 'heaven11' ),
					'desc'       => wp_kses_data( __( 'Select default widgets to show in the sidebar on the single posts', 'heaven11' ) ),
					'override'   => array(
						'mode'    => 'post,product,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Widgets', 'heaven11' ),
					),
					'dependency' => array(
						'sidebar_position_single' => array( '^hide' ),
					),
					'std'        => 'sidebar_widgets',
					'options'    => array(),
					'type'       => 'select',
				),
				'expand_content_post'           => array(
					'title'   => esc_html__( 'Expand content', 'heaven11' ),
					'desc'    => wp_kses_data( __( 'Expand the content width on the single posts if the sidebar is hidden', 'heaven11' ) ),
					'refresh' => false,
					'std'     => 1,
					'type'    => 'checkbox',
				),

				'blog_single_title_info'      => array(
					'title' => esc_html__( 'Featured image and title', 'heaven11' ),
					'desc'  => '',
					'type'  => 'info',
				),
				'hide_featured_on_single'       => array(
					'title'    => esc_html__( 'Hide featured image on the single post', 'heaven11' ),
					'desc'     => wp_kses_data( __( "Hide featured image on the single post's pages", 'heaven11' ) ),
					'override' => array(
						'mode'    => 'page,post',
						'section' => esc_html__( 'Content', 'heaven11' ),
					),
					'std'      => 0,
					'type'     => 'checkbox',
				),
				'post_thumbnail_type'      => array(
					'title'      => esc_html__( 'Type of post thumbnail', 'heaven11' ),
					'desc'       => wp_kses_data( __( "Select type of post thumbnail on the single post's pages", 'heaven11' ) ),
					'override'   => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Content', 'heaven11' ),
					),
					'dependency' => array(
						'hide_featured_on_single' => array( 'is_empty', 0 ),
					),
					'std'        => 'default',
					'options'    => array(
						'fullwidth'   => esc_html__( 'Fullwidth', 'heaven11' ),
						'boxed'       => esc_html__( 'Boxed', 'heaven11' ),
						'default'     => esc_html__( 'Default', 'heaven11' ),
					),
					'type'       => HEAVEN11_THEME_FREE ? 'hidden' : 'select',
				),
				'post_header_position'          => array(
					'title'      => esc_html__( 'Post header position', 'heaven11' ),
					'desc'       => wp_kses_data( __( "Select post header position on the single post's pages", 'heaven11' ) ),
					'override'   => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Content', 'heaven11' ),
					),
					'dependency' => array(
						'hide_featured_on_single' => array( 'is_empty', 0 )
					),
					'std'        => 'default',
					'options'    => array(
						'above'      => esc_html__( 'Above the post thumbnail', 'heaven11' ),
						'under'      => esc_html__( 'Under the post thumbnail', 'heaven11' ),
						'on_thumb'   => esc_html__( 'On the post thumbnail', 'heaven11' ),
						'default'    => esc_html__( 'Default', 'heaven11' ),
					),
					'type'       => HEAVEN11_THEME_FREE ? 'hidden' : 'select',
				),
				'post_header_align'             => array(
					'title'      => esc_html__( 'Align of the post header', 'heaven11' ),
					'override'   => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Content', 'heaven11' ),
					),
					'dependency' => array(
						'post_header_position' => array( 'on_thumb' ),
					),
					'std'        => 'mc',
					'options'    => array(
						'ts' => esc_html__('Top Stick Out', 'heaven11'),
						'tl' => esc_html__('Top Left', 'heaven11'),
						'tc' => esc_html__('Top Center', 'heaven11'),
						'tr' => esc_html__('Top Right', 'heaven11'),
						'ml' => esc_html__('Middle Left', 'heaven11'),
						'mc' => esc_html__('Middle Center', 'heaven11'),
						'mr' => esc_html__('Middle Right', 'heaven11'),
						'bl' => esc_html__('Bottom Left', 'heaven11'),
						'bc' => esc_html__('Bottom Center', 'heaven11'),
						'br' => esc_html__('Bottom Right', 'heaven11'),
						'bs' => esc_html__('Bottom Stick Out', 'heaven11'),
					),
					'type'       => HEAVEN11_THEME_FREE ? 'hidden' : 'select',
				),
				'post_subtitle'                 => array(
					'title' => esc_html__( 'Post subtitle', 'heaven11' ),
					'desc'  => wp_kses_data( __( "Specify post subtitle to display it under the post title.", 'heaven11' ) ),
					'override' => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Content', 'heaven11' ),
					),
					'std'   => '',
					'hidden' => true,
					'type'  => 'text',
				),
				'show_post_meta'                => array(
					'title' => esc_html__( 'Show post meta', 'heaven11' ),
					'desc'  => wp_kses_data( __( "Display block with post's meta: date, categories, counters, etc.", 'heaven11' ) ),
					'std'   => 1,
					'type'  => 'checkbox',
				),
				'meta_parts_post'               => array(
					'title'      => esc_html__( 'Post meta', 'heaven11' ),
					'desc'       => wp_kses_data( __( 'Meta parts for single posts. Post counters and Share Links are available only if plugin ThemeREX Addons is active', 'heaven11' ) )
								. '<br>'
								. wp_kses_data( __( '<b>Tip:</b> Drag items to change their order.', 'heaven11' ) ),
					'dependency' => array(
						'show_post_meta' => array( 1 ),
					),
					'dir'        => 'vertical',
					'sortable'   => true,
					'std'        => 'categories=1|date=1|views=1|likes=1|comments=1|author=0|share=0|edit=1',
					'options'    => heaven11_get_list_meta_parts(),
					'type'       => HEAVEN11_THEME_FREE ? 'hidden' : 'checklist',
				),
				'show_share_links'              => array(
					'title' => esc_html__( 'Show share links', 'heaven11' ),
					'desc'  => wp_kses_data( __( 'Display share links on the single post', 'heaven11' ) ),
					'std'   => 1,
					'type'  => ! heaven11_exists_trx_addons() ? 'hidden' : 'checkbox',
				),
				'show_author_info'              => array(
					'title' => esc_html__( 'Show author info', 'heaven11' ),
					'desc'  => wp_kses_data( __( "Display block with information about post's author", 'heaven11' ) ),
					'std'   => 1,
					'type'  => 'checkbox',
				),

				'blog_single_related_info'      => array(
					'title' => esc_html__( 'Related posts', 'heaven11' ),
					'desc'  => '',
					'type'  => 'info',
				),
				'show_related_posts'            => array(
					'title'    => esc_html__( 'Show related posts', 'heaven11' ),
					'desc'     => wp_kses_data( __( "Show section 'Related posts' on the single post's pages", 'heaven11' ) ),
					'override' => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Content', 'heaven11' ),
					),
					'std'      => 0,
					'type'     => 'checkbox',
				),
				'related_style'                 => array(
					'title'      => esc_html__( 'Related posts style', 'heaven11' ),
					'desc'       => wp_kses_data( __( 'Select style of the related posts output', 'heaven11' ) ),
					'override' => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Content', 'heaven11' ),
					),
					'dependency' => array(
						'show_related_posts' => array( 1 ),
					),
					'std'        => 'classic',
					'options'    => array(
						'modern'  => esc_html__( 'Modern', 'heaven11' ),
						'classic' => esc_html__( 'Classic', 'heaven11' ),
						'wide'    => esc_html__( 'Wide', 'heaven11' ),
						'list'    => esc_html__( 'List', 'heaven11' ),
						'short'   => esc_html__( 'Short', 'heaven11' ),
					),
					'type'       => HEAVEN11_THEME_FREE ? 'hidden' : 'switch',
				),
				'related_position'              => array(
					'title'      => esc_html__( 'Related posts position', 'heaven11' ),
					'desc'       => wp_kses_data( __( 'Select position to display the related posts', 'heaven11' ) ),
					'override' => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Content', 'heaven11' ),
					),
					'dependency' => array(
						'show_related_posts' => array( 1 ),
					),
					'std'        => 'below_content',
					'options'    => array (
						'inside'        => esc_html__( 'Inside the content (fullwidth)', 'heaven11' ),
						'inside_left'   => esc_html__( 'At left side of the content', 'heaven11' ),
						'inside_right'  => esc_html__( 'At right side of the content', 'heaven11' ),
						'below_content' => esc_html__( 'After the content', 'heaven11' ),
						'below_page'    => esc_html__( 'After the content & sidebar', 'heaven11' ),
					),
					'type'       => HEAVEN11_THEME_FREE ? 'hidden' : 'select',
				),
				'related_position_inside'       => array(
					'title'      => esc_html__( 'Before # paragraph', 'heaven11' ),
					'desc'       => wp_kses_data( __( 'Before what paragraph should related posts appear? If 0 - randomly.', 'heaven11' ) ),
					'override' => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Content', 'heaven11' ),
					),
					'dependency' => array(
						'show_related_posts' => array( 1 ),
						'related_position' => array( 'inside', 'inside_left', 'inside_right' ),
					),
					'std'        => 2,
					'options'    => heaven11_get_list_range( 0, 9 ),
					'type'       => HEAVEN11_THEME_FREE ? 'hidden' : 'select',
				),
				'related_posts'                 => array(
					'title'      => esc_html__( 'Related posts', 'heaven11' ),
					'desc'       => wp_kses_data( __( 'How many related posts should be displayed in the single post? If 0 - no related posts are shown.', 'heaven11' ) ),
					'override' => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Content', 'heaven11' ),
					),
					'dependency' => array(
						'show_related_posts' => array( 1 ),
					),
					'std'        => 2,
					'min'        => 1,
					'max'        => 9,
					'type'       => HEAVEN11_THEME_FREE ? 'hidden' : 'slider',
				),
				'related_columns'               => array(
					'title'      => esc_html__( 'Related columns', 'heaven11' ),
					'desc'       => wp_kses_data( __( 'How many columns should be used to output related posts in the single page?', 'heaven11' ) ),
					'override' => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Content', 'heaven11' ),
					),
					'dependency' => array(
						'show_related_posts' => array( 1 ),
						'related_position' => array( 'inside', 'below_content', 'below_page' ),
					),
					'std'        => 2,
					'options'    => heaven11_get_list_range( 1, 6 ),
					'type'       => HEAVEN11_THEME_FREE ? 'hidden' : 'switch',
				),
				'related_slider'                => array(
					'title'      => esc_html__( 'Use slider layout', 'heaven11' ),
					'desc'       => wp_kses_data( __( 'Use slider layout in case related posts count is more than columns count', 'heaven11' ) ),
					'override' => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Content', 'heaven11' ),
					),
					'dependency' => array(
						'show_related_posts' => array( 1 ),
					),
					'std'        => 0,
					'type'       => HEAVEN11_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'related_slider_controls'       => array(
					'title'      => esc_html__( 'Slider controls', 'heaven11' ),
					'desc'       => wp_kses_data( __( 'Show arrows in the slider', 'heaven11' ) ),
					'override' => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Content', 'heaven11' ),
					),
					'dependency' => array(
						'show_related_posts' => array( 1 ),
						'related_slider' => array( 1 ),
					),
					'std'        => 'none',
					'options'    => array(
						'none'    => esc_html__('None', 'heaven11'),
						'side'    => esc_html__('Side', 'heaven11'),
						'outside' => esc_html__('Outside', 'heaven11'),
						'top'     => esc_html__('Top', 'heaven11'),
						'bottom'  => esc_html__('Bottom', 'heaven11')
					),
					'type'       => HEAVEN11_THEME_FREE ? 'hidden' : 'select',
				),
				'related_slider_pagination'       => array(
					'title'      => esc_html__( 'Slider pagination', 'heaven11' ),
					'desc'       => wp_kses_data( __( 'Show bullets after the slider', 'heaven11' ) ),
					'override' => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Content', 'heaven11' ),
					),
					'dependency' => array(
						'show_related_posts' => array( 1 ),
						'related_slider' => array( 1 ),
					),
					'std'        => 'bottom',
					'options'    => array(
						'none'    => esc_html__('None', 'heaven11'),
						'bottom'  => esc_html__('Bottom', 'heaven11')
					),
					'type'       => HEAVEN11_THEME_FREE ? 'hidden' : 'switch',
				),
				'related_slider_space'          => array(
					'title'      => esc_html__( 'Space', 'heaven11' ),
					'desc'       => wp_kses_data( __( 'Space between slides', 'heaven11' ) ),
					'override' => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Content', 'heaven11' ),
					),
					'dependency' => array(
						'show_related_posts' => array( 1 ),
						'related_slider' => array( 1 ),
					),
					'std'        => 30,
					'type'       => HEAVEN11_THEME_FREE ? 'hidden' : 'text',
				),
				'posts_navigation_info'      => array(
					'title' => esc_html__( 'Posts navigation', 'heaven11' ),
					'desc'  => '',
					'type'  => 'info',
				),
				'show_posts_navigation'		=> array(
					'title'    => esc_html__( 'Show posts navigation', 'heaven11' ),
					'desc'     => wp_kses_data( __( "Show posts navigation on the single post's pages", 'heaven11' ) ),
					'std'      => 0,
					'type'     => 'checkbox',
				),
				'fixed_posts_navigation'		=> array(
					'title'    => esc_html__( 'Fixed posts navigation', 'heaven11' ),
					'desc'     => wp_kses_data( __( "Make posts navigation fixed position. Display it when the content of the article is inside the window.", 'heaven11' ) ),
					'dependency' => array(
						'show_posts_navigation' => array( 1 ),
					),
					'std'      => 0,
					'type'     => 'checkbox',
				),
				'posts_banners_info'      => array(
					'title' => esc_html__( 'Posts banners', 'heaven11' ),
					'desc'  => '',
					'type'  => 'info',
				),
				'header_banner_link'     => array(
					'title' => esc_html__( 'Header banner link', 'heaven11' ),
					'desc'  => wp_kses_data( __( 'Insert URL of the banner', 'heaven11' ) ),
					'override'   => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Banners', 'heaven11' ),
					),
					'std'   => '',
					'type'  => 'text',
				),
				'header_banner_img'     => array(
					'title' => esc_html__( 'Header banner image', 'heaven11' ),
					'desc'  => wp_kses_data( __( 'Select image to display at the backgound', 'heaven11' ) ),
					'override'   => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Banners', 'heaven11' ),
					),
					'std'        => '',
					'type'       => 'image',
				),
				'header_banner_height'  => array(
					'title' => esc_html__( 'Header banner height', 'heaven11' ),
					'desc'  => wp_kses_data( __( 'Specify minimal height of the banner (in "px" or "em"). For example: 15em', 'heaven11' ) ),
					'override'   => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Banners', 'heaven11' ),
					),
					'std'        => '',
					'type'       => 'text',
				),
				'header_banner_code'     => array(
					'title'      => esc_html__( 'Header banner code', 'heaven11' ),
					'desc'       => wp_kses_data( __( 'Embed html code', 'heaven11' ) ),
					'override'   => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Banners', 'heaven11' ),
					),
					'std'        => '',
					'allow_html' => true,
					'type'       => 'textarea',
				),
				'footer_banner_link'     => array(
					'title' => esc_html__( 'Footer banner link', 'heaven11' ),
					'desc'  => wp_kses_data( __( 'Insert URL of the banner', 'heaven11' ) ),
					'override'   => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Banners', 'heaven11' ),
					),
					'std'   => '',
					'type'  => 'text',
				),
				'footer_banner_img'     => array(
					'title' => esc_html__( 'Footer banner image', 'heaven11' ),
					'desc'  => wp_kses_data( __( 'Select image to display at the backgound', 'heaven11' ) ),
					'override'   => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Banners', 'heaven11' ),
					),
					'std'        => '',
					'type'       => 'image',
				),
				'footer_banner_height'  => array(
					'title' => esc_html__( 'Footer banner height', 'heaven11' ),
					'desc'  => wp_kses_data( __( 'Specify minimal height of the banner (in "px" or "em"). For example: 15em', 'heaven11' ) ),
					'override'   => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Banners', 'heaven11' ),
					),
					'std'        => '',
					'type'       => 'text',
				),
				'footer_banner_code'     => array(
					'title'      => esc_html__( 'Footer banner code', 'heaven11' ),
					'desc'       => wp_kses_data( __( 'Embed html code', 'heaven11' ) ),
					'override'   => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Banners', 'heaven11' ),
					),
					'std'        => '',
					'allow_html' => true,
					'type'       => 'textarea',
				),
				'sidebar_banner_link'     => array(
					'title' => esc_html__( 'Sidebar banner link', 'heaven11' ),
					'desc'  => wp_kses_data( __( 'Insert URL of the banner', 'heaven11' ) ),
					'override'   => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Banners', 'heaven11' ),
					),
					'std'   => '',
					'type'  => 'text',
				),
				'sidebar_banner_img'     => array(
					'title' => esc_html__( 'Sidebar banner image', 'heaven11' ),
					'desc'  => wp_kses_data( __( 'Select image to display at the backgound', 'heaven11' ) ),
					'override'   => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Banners', 'heaven11' ),
					),
					'std'        => '',
					'type'       => 'image',
				),
				'sidebar_banner_code'     => array(
					'title'      => esc_html__( 'Sidebar banner code', 'heaven11' ),
					'desc'       => wp_kses_data( __( 'Embed html code', 'heaven11' ) ),
					'override'   => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Banners', 'heaven11' ),
					),
					'std'        => '',
					'allow_html' => true,
					'type'       => 'textarea',
				),
				'background_banner_link'     => array(
					'title' => esc_html__( "Post's background banner link", 'heaven11' ),
					'desc'  => wp_kses_data( __( 'Insert URL of the banner', 'heaven11' ) ),
					'override'   => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Banners', 'heaven11' ),
					),
					'std'   => '',
					'type'  => 'text',
				),
				'background_banner_img'     => array(
					'title' => esc_html__( "Post's background banner image", 'heaven11' ),
					'desc'  => wp_kses_data( __( 'Select image to display at the backgound', 'heaven11' ) ),
					'override'   => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Banners', 'heaven11' ),
					),
					'std'        => '',
					'type'       => 'image',
				),
				'background_banner_code'     => array(
					'title'      => esc_html__( "Post's background banner code", 'heaven11' ),
					'desc'       => wp_kses_data( __( 'Embed html code', 'heaven11' ) ),
					'override'   => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Banners', 'heaven11' ),
					),
					'std'        => '',
					'allow_html' => true,
					'type'       => 'textarea',
				),
				'blog_end'                      => array(
					'type' => 'panel_end',
				),

				// 'Colors'
				'panel_colors'                  => array(
					'title'    => esc_html__( 'Colors', 'heaven11' ),
					'desc'     => '',
					'priority' => 300,
					'type'     => 'section',
				),

				'color_schemes_info'            => array(
					'title'  => esc_html__( 'Color schemes', 'heaven11' ),
					'desc'   => wp_kses_data( __( 'Color schemes for various parts of the site. "Inherit" means that this block is used the Site color scheme (the first parameter)', 'heaven11' ) ),
					'hidden' => $hide_schemes,
					'type'   => 'info',
				),
				'color_scheme'                  => array(
					'title'    => esc_html__( 'Site Color Scheme', 'heaven11' ),
					'desc'     => '',
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Colors', 'heaven11' ),
					),
					'std'      => 'default',
					'options'  => array(),
					'refresh'  => false,
					'type'     => $hide_schemes ? 'hidden' : 'switch',
				),
				'header_scheme'                 => array(
					'title'    => esc_html__( 'Header Color Scheme', 'heaven11' ),
					'desc'     => '',
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Colors', 'heaven11' ),
					),
					'std'      => 'inherit',
					'options'  => array(),
					'refresh'  => false,
					'type'     => $hide_schemes ? 'hidden' : 'switch',
				),
				'menu_scheme'                   => array(
					'title'    => esc_html__( 'Sidemenu Color Scheme', 'heaven11' ),
					'desc'     => '',
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Colors', 'heaven11' ),
					),
					'std'      => 'inherit',
					'options'  => array(),
					'refresh'  => false,
					'type'     => $hide_schemes || HEAVEN11_THEME_FREE ? 'hidden' : 'switch',
				),
				'sidebar_scheme'                => array(
					'title'    => esc_html__( 'Sidebar Color Scheme', 'heaven11' ),
					'desc'     => '',
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Colors', 'heaven11' ),
					),
					'std'      => 'inherit',
					'options'  => array(),
					'refresh'  => false,
					'type'     => $hide_schemes ? 'hidden' : 'switch',
				),
				'footer_scheme'                 => array(
					'title'    => esc_html__( 'Footer Color Scheme', 'heaven11' ),
					'desc'     => '',
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Colors', 'heaven11' ),
					),
					'std'      => 'inherit',
					'options'  => array(),
					'refresh'  => false,
					'type'     => $hide_schemes ? 'hidden' : 'switch',
				),

				'color_scheme_editor_info'      => array(
					'title' => esc_html__( 'Color scheme editor', 'heaven11' ),
					'desc'  => wp_kses_data( __( 'Select color scheme to modify. Attention! Only those sections in the site will be changed which this scheme was assigned to', 'heaven11' ) ),
					'type'  => 'info',
				),
				'scheme_storage'                => array(
					'title'       => esc_html__( 'Color scheme editor', 'heaven11' ),
					'desc'        => '',
					'std'         => '$heaven11_get_scheme_storage',
					'refresh'     => false,
					'colorpicker' => 'tiny',
					'type'        => 'scheme_editor',
				),

				// Internal options.
				// Attention! Don't change any options in the section below!
				// Use huge priority to call render this elements after all options!
				'reset_options'                 => array(
					'title'    => '',
					'desc'     => '',
					'std'      => '0',
					'priority' => 10000,
					'type'     => 'hidden',
				),

				'last_option'                   => array(     // Need to manually call action to include Tiny MCE scripts
					'title' => '',
					'desc'  => '',
					'std'   => 1,
					'type'  => 'hidden',
				),

			)
		);

		// Prepare panel 'Fonts'
		// -------------------------------------------------------------
		$fonts = array(

			// 'Fonts'
			'fonts'             => array(
				'title'    => esc_html__( 'Typography', 'heaven11' ),
				'desc'     => '',
				'priority' => 200,
				'type'     => 'panel',
			),

			// Fonts - Load_fonts
			'load_fonts'        => array(
				'title' => esc_html__( 'Load fonts', 'heaven11' ),
				'desc'  => wp_kses_data( __( 'Specify fonts to load when theme start. You can use them in the base theme elements: headers, text, menu, links, input fields, etc.', 'heaven11' ) )
						. '<br>'
						. wp_kses_data( __( 'Attention! Press "Refresh" button to reload preview area after the all fonts are changed', 'heaven11' ) ),
				'type'  => 'section',
			),
			'load_fonts_subset' => array(
				'title'   => esc_html__( 'Google fonts subsets', 'heaven11' ),
				'desc'    => wp_kses_data( __( 'Specify comma separated list of the subsets which will be load from Google fonts', 'heaven11' ) )
						. '<br>'
						. wp_kses_data( __( 'Available subsets are: latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese', 'heaven11' ) ),
				'class'   => 'heaven11_column-1_3 heaven11_new_row',
				'refresh' => false,
				'std'     => '$heaven11_get_load_fonts_subset',
				'type'    => 'text',
			),
		);

		for ( $i = 1; $i <= heaven11_get_theme_setting( 'max_load_fonts' ); $i++ ) {
			if ( heaven11_get_value_gp( 'page' ) != 'theme_options' ) {
				$fonts[ "load_fonts-{$i}-info" ] = array(
					// Translators: Add font's number - 'Font 1', 'Font 2', etc
					'title' => esc_html( sprintf( __( 'Font %s', 'heaven11' ), $i ) ),
					'desc'  => '',
					'type'  => 'info',
				);
			}
			$fonts[ "load_fonts-{$i}-name" ]   = array(
				'title'   => esc_html__( 'Font name', 'heaven11' ),
				'desc'    => '',
				'class'   => 'heaven11_column-1_3 heaven11_new_row',
				'refresh' => false,
				'std'     => '$heaven11_get_load_fonts_option',
				'type'    => 'text',
			);
			$fonts[ "load_fonts-{$i}-family" ] = array(
				'title'   => esc_html__( 'Font family', 'heaven11' ),
				'desc'    => 1 == $i
							? wp_kses_data( __( 'Select font family to use it if font above is not available', 'heaven11' ) )
							: '',
				'class'   => 'heaven11_column-1_3',
				'refresh' => false,
				'std'     => '$heaven11_get_load_fonts_option',
				'options' => array(
					'inherit'    => esc_html__( 'Inherit', 'heaven11' ),
					'serif'      => esc_html__( 'serif', 'heaven11' ),
					'sans-serif' => esc_html__( 'sans-serif', 'heaven11' ),
					'monospace'  => esc_html__( 'monospace', 'heaven11' ),
					'cursive'    => esc_html__( 'cursive', 'heaven11' ),
					'fantasy'    => esc_html__( 'fantasy', 'heaven11' ),
				),
				'type'    => 'select',
			);
			$fonts[ "load_fonts-{$i}-styles" ] = array(
				'title'   => esc_html__( 'Font styles', 'heaven11' ),
				'desc'    => 1 == $i
							? wp_kses_data( __( 'Font styles used only for the Google fonts. This is a comma separated list of the font weight and styles. For example: 400,400italic,700', 'heaven11' ) )
								. '<br>'
								. wp_kses_data( __( 'Attention! Each weight and style increase download size! Specify only used weights and styles.', 'heaven11' ) )
							: '',
				'class'   => 'heaven11_column-1_3',
				'refresh' => false,
				'std'     => '$heaven11_get_load_fonts_option',
				'type'    => 'text',
			);
		}
		$fonts['load_fonts_end'] = array(
			'type' => 'section_end',
		);

		// Fonts - H1..6, P, Info, Menu, etc.
		$theme_fonts = heaven11_get_theme_fonts();
		foreach ( $theme_fonts as $tag => $v ) {
			$fonts[ "{$tag}_section" ] = array(
				'title' => ! empty( $v['title'] )
								? $v['title']
								// Translators: Add tag's name to make title 'H1 settings', 'P settings', etc.
								: esc_html( sprintf( __( '%s settings', 'heaven11' ), $tag ) ),
				'desc'  => ! empty( $v['description'] )
								? $v['description']
								// Translators: Add tag's name to make description
								: wp_kses(( sprintf( __( 'Font settings of the "%s" tag.', 'heaven11' ), $tag ) ), 'heaven11_kses_content'),
				'type'  => 'section',
			);

			foreach ( $v as $css_prop => $css_value ) {
				if ( in_array( $css_prop, array( 'title', 'description' ) ) ) {
					continue;
				}
				$options    = '';
				$type       = 'text';
				$load_order = 1;
				$title      = ucfirst( str_replace( '-', ' ', $css_prop ) );
				if ( 'font-family' == $css_prop ) {
					$type       = 'select';
					$options    = array();
					$load_order = 2;        // Load this option's value after all options are loaded (use option 'load_fonts' to build fonts list)
				} elseif ( 'font-weight' == $css_prop ) {
					$type    = 'select';
					$options = array(
						'inherit' => esc_html__( 'Inherit', 'heaven11' ),
						'100'     => esc_html__( '100 (Light)', 'heaven11' ),
						'200'     => esc_html__( '200 (Light)', 'heaven11' ),
						'300'     => esc_html__( '300 (Thin)', 'heaven11' ),
						'400'     => esc_html__( '400 (Normal)', 'heaven11' ),
						'500'     => esc_html__( '500 (Semibold)', 'heaven11' ),
						'600'     => esc_html__( '600 (Semibold)', 'heaven11' ),
						'700'     => esc_html__( '700 (Bold)', 'heaven11' ),
						'800'     => esc_html__( '800 (Black)', 'heaven11' ),
						'900'     => esc_html__( '900 (Black)', 'heaven11' ),
					);
				} elseif ( 'font-style' == $css_prop ) {
					$type    = 'select';
					$options = array(
						'inherit' => esc_html__( 'Inherit', 'heaven11' ),
						'normal'  => esc_html__( 'Normal', 'heaven11' ),
						'italic'  => esc_html__( 'Italic', 'heaven11' ),
					);
				} elseif ( 'text-decoration' == $css_prop ) {
					$type    = 'select';
					$options = array(
						'inherit'      => esc_html__( 'Inherit', 'heaven11' ),
						'none'         => esc_html__( 'None', 'heaven11' ),
						'underline'    => esc_html__( 'Underline', 'heaven11' ),
						'overline'     => esc_html__( 'Overline', 'heaven11' ),
						'line-through' => esc_html__( 'Line-through', 'heaven11' ),
					);
				} elseif ( 'text-transform' == $css_prop ) {
					$type    = 'select';
					$options = array(
						'inherit'    => esc_html__( 'Inherit', 'heaven11' ),
						'none'       => esc_html__( 'None', 'heaven11' ),
						'uppercase'  => esc_html__( 'Uppercase', 'heaven11' ),
						'lowercase'  => esc_html__( 'Lowercase', 'heaven11' ),
						'capitalize' => esc_html__( 'Capitalize', 'heaven11' ),
					);
				}
				$fonts[ "{$tag}_{$css_prop}" ] = array(
					'title'      => $title,
					'desc'       => '',
					'class'      => 'heaven11_column-1_5',
					'refresh'    => false,
					'load_order' => $load_order,
					'std'        => '$heaven11_get_theme_fonts_option',
					'options'    => $options,
					'type'       => $type,
				);
			}

			$fonts[ "{$tag}_section_end" ] = array(
				'type' => 'section_end',
			);
		}

		$fonts['fonts_end'] = array(
			'type' => 'panel_end',
		);

		// Add fonts parameters to Theme Options
		heaven11_storage_set_array_before( 'options', 'panel_colors', $fonts );

		// Add Header Video if WP version < 4.7
		// -----------------------------------------------------
		if ( ! function_exists( 'get_header_video_url' ) ) {
			heaven11_storage_set_array_after(
				'options', 'header_image_override', 'header_video', array(
					'title'    => esc_html__( 'Header video', 'heaven11' ),
					'desc'     => wp_kses_data( __( 'Select video to use it as background for the header', 'heaven11' ) ),
					'override' => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Header', 'heaven11' ),
					),
					'std'      => '',
					'type'     => 'video',
				)
			);
		}

		// Add option 'logo' if WP version < 4.5
		// or 'custom_logo' if current page is not 'Customize'
		// ------------------------------------------------------
		if ( ! function_exists( 'the_custom_logo' ) || ! heaven11_check_current_url( 'customize.php' ) ) {
			heaven11_storage_set_array_before(
				'options', 'logo_retina', function_exists( 'the_custom_logo' ) ? 'custom_logo' : 'logo', array(
					'title'    => esc_html__( 'Logo', 'heaven11' ),
					'desc'     => wp_kses_data( __( 'Select or upload the site logo', 'heaven11' ) ),
					'class'    => 'heaven11_column-1_2 heaven11_new_row',
					'priority' => 60,
					'std'      => '',
					'qsetup'   => esc_html__( 'General', 'heaven11' ),
					'type'     => 'image',
				)
			);
		}

	}
}


// Returns a list of options that can be overridden for CPT
if ( ! function_exists( 'heaven11_options_get_list_cpt_options' ) ) {
	function heaven11_options_get_list_cpt_options( $cpt, $title = '' ) {
		if ( empty( $title ) ) {
			$title = ucfirst( $cpt );
		}
		return array(
			"content_info_{$cpt}"           => array(
				'title' => esc_html__( 'Content', 'heaven11' ),
				'desc'  => '',
				'type'  => 'info',
			),
			"body_style_{$cpt}"             => array(
				'title'    => esc_html__( 'Body style', 'heaven11' ),
				'desc'     => wp_kses_data( __( 'Select width of the body content', 'heaven11' ) ),
				'std'      => 'inherit',
				'options'  => heaven11_get_list_body_styles( true ),
				'type'     => 'select',
			),
			"boxed_bg_image_{$cpt}"         => array(
				'title'      => esc_html__( 'Boxed bg image', 'heaven11' ),
				'desc'       => wp_kses_data( __( 'Select or upload image, used as background in the boxed body', 'heaven11' ) ),
				'dependency' => array(
					"body_style_{$cpt}" => array( 'boxed' ),
				),
				'std'        => 'inherit',
				'type'       => 'image',
			),
			"header_info_{$cpt}"            => array(
				'title' => esc_html__( 'Header', 'heaven11' ),
				'desc'  => '',
				'type'  => 'info',
			),
			"header_type_{$cpt}"            => array(
				'title'   => esc_html__( 'Header style', 'heaven11' ),
				'desc'    => wp_kses_data( __( 'Choose whether to use the default header or header Layouts (available only if the ThemeREX Addons is activated)', 'heaven11' ) ),
				'std'     => 'inherit',
				'options' => heaven11_get_list_header_footer_types( true ),
				'type'    => HEAVEN11_THEME_FREE ? 'hidden' : 'switch',
			),
			"header_style_{$cpt}"           => array(
				'title'      => esc_html__( 'Select custom layout', 'heaven11' ),
				// Translators: Add CPT name to the description
				'desc'       => wp_kses_data( sprintf( __( 'Select custom layout to display the site header on the %s pages', 'heaven11' ), $title ) ),
				'dependency' => array(
					"header_type_{$cpt}" => array( 'custom' ),
				),
				'std'        => 'inherit',
				'options'    => array(),
				'type'       => HEAVEN11_THEME_FREE ? 'hidden' : 'select',
			),
			"header_position_{$cpt}"        => array(
				'title'   => esc_html__( 'Header position', 'heaven11' ),
				// Translators: Add CPT name to the description
				'desc'    => wp_kses_data( sprintf( __( 'Select position to display the site header on the %s pages', 'heaven11' ), $title ) ),
				'std'     => 'inherit',
				'options' => array(),
				'type'    => HEAVEN11_THEME_FREE ? 'hidden' : 'switch',
			),
			"header_image_override_{$cpt}"  => array(
				'title'   => esc_html__( 'Header image override', 'heaven11' ),
				'desc'    => wp_kses_data( __( "Allow override the header image with the post's featured image", 'heaven11' ) ),
				'std'     => 'inherit',
				'options' => array(
					'inherit' => esc_html__( 'Inherit', 'heaven11' ),
					1         => esc_html__( 'Yes', 'heaven11' ),
					0         => esc_html__( 'No', 'heaven11' ),
				),
				'type'    => HEAVEN11_THEME_FREE ? 'hidden' : 'switch',
			),
			"header_widgets_{$cpt}"         => array(
				'title'   => esc_html__( 'Header widgets', 'heaven11' ),
				// Translators: Add CPT name to the description
				'desc'    => wp_kses_data( sprintf( __( 'Select set of widgets to show in the header on the %s pages', 'heaven11' ), $title ) ),
				'std'     => 'hide',
				'options' => array(),
				'type'    => 'select',
			),

			"sidebar_info_{$cpt}"           => array(
				'title' => esc_html__( 'Sidebar', 'heaven11' ),
				'desc'  => '',
				'type'  => 'info',
			),
			"sidebar_position_{$cpt}"       => array(
				'title'   => sprintf( __( 'Sidebar position on the %s list', 'heaven11' ), $title ),
				// Translators: Add CPT name to the description
				'desc'    => wp_kses_data( sprintf( __( 'Select position to show sidebar on the %s list', 'heaven11' ), $title ) ),
				'std'     => 'left',
				'options' => array(),
				'type'    => 'switch',
			),
			"sidebar_position_mobile_{$cpt}"=> array(
				'title'    => sprintf( __( 'Sidebar position on the %s list on mobile', 'heaven11' ), $title ),
				'desc'     => wp_kses_data( __( 'Select position to show sidebar on mobile devices - above or below the content', 'heaven11' ) ),
				'std'      => 'below',
				'dependency' => array(
					"sidebar_position_{$cpt}" => array( '^hide' ),
				),
				'options'  => array(),
				'type'     => 'switch',
			),
			"sidebar_widgets_{$cpt}"        => array(
				'title'      => sprintf( __( 'Sidebar widgets on the %s list', 'heaven11' ), $title ),
				// Translators: Add CPT name to the description
				'desc'       => wp_kses_data( sprintf( __( 'Select sidebar to show on the %s list', 'heaven11' ), $title ) ),
				'dependency' => array(
					"sidebar_position_{$cpt}" => array( '^hide' ),
				),
				'std'        => 'hide',
				'options'    => array(),
				'type'       => 'select',
			),
			"sidebar_position_single_{$cpt}"       => array(
				'title'   => sprintf( __( 'Sidebar position on the single post', 'heaven11' ), $title ),
				// Translators: Add CPT name to the description
				'desc'    => wp_kses_data( sprintf( __( 'Select position to show sidebar on the single posts of the %s', 'heaven11' ), $title ) ),
				'std'     => 'left',
				'options' => array(),
				'type'    => 'switch',
			),
			"sidebar_position_mobile_single_{$cpt}"=> array(
				'title'    => esc_html__( 'Sidebar position on the single post on mobile', 'heaven11' ),
				'desc'     => wp_kses_data( __( 'Select position to show sidebar on mobile devices - above or below the content', 'heaven11' ) ),
				'dependency' => array(
					"sidebar_position_single_{$cpt}" => array( '^hide' ),
				),
				'std'      => 'below',
				'options'  => array(),
				'type'     => 'switch',
			),
			"sidebar_widgets_single_{$cpt}"        => array(
				'title'      => sprintf( __( 'Sidebar widgets on the single post', 'heaven11' ), $title ),
				// Translators: Add CPT name to the description
				'desc'       => wp_kses_data( sprintf( __( 'Select widgets to show in the sidebar on the single posts of the %s', 'heaven11' ), $title ) ),
				'dependency' => array(
					"sidebar_position_single_{$cpt}" => array( '^hide' ),
				),
				'std'        => 'hide',
				'options'    => array(),
				'type'       => 'select',
			),
			"expand_content_{$cpt}"         => array(
				'title'   => esc_html__( 'Expand content', 'heaven11' ),
				'desc'    => wp_kses_data( __( 'Expand the content width if the sidebar is hidden', 'heaven11' ) ),
				'refresh' => false,
				'std'     => 'inherit',
				'options' => array(
					'inherit' => esc_html__( 'Inherit', 'heaven11' ),
					1         => esc_html__( 'Expand', 'heaven11' ),
					0         => esc_html__( 'No', 'heaven11' ),
				),
				'type'    => 'switch',
			),

			"footer_info_{$cpt}"            => array(
				'title' => esc_html__( 'Footer', 'heaven11' ),
				'desc'  => '',
				'type'  => 'info',
			),
			"footer_type_{$cpt}"            => array(
				'title'   => esc_html__( 'Footer style', 'heaven11' ),
				'desc'    => wp_kses_data( __( 'Choose whether to use the default footer or footer Layouts (available only if the ThemeREX Addons is activated)', 'heaven11' ) ),
				'std'     => 'inherit',
				'options' => heaven11_get_list_header_footer_types( true ),
				'type'    => HEAVEN11_THEME_FREE ? 'hidden' : 'switch',
			),
			"footer_style_{$cpt}"           => array(
				'title'      => esc_html__( 'Select custom layout', 'heaven11' ),
				'desc'       => wp_kses_data( __( 'Select custom layout to display the site footer', 'heaven11' ) ),
				'std'        => 'inherit',
				'dependency' => array(
					"footer_type_{$cpt}" => array( 'custom' ),
				),
				'options'    => array(),
				'type'       => HEAVEN11_THEME_FREE ? 'hidden' : 'select',
			),
			"footer_widgets_{$cpt}"         => array(
				'title'      => esc_html__( 'Footer widgets', 'heaven11' ),
				'desc'       => wp_kses_data( __( 'Select set of widgets to show in the footer', 'heaven11' ) ),
				'dependency' => array(
					"footer_type_{$cpt}" => array( 'default' ),
				),
				'std'        => 'footer_widgets',
				'options'    => array(),
				'type'       => 'select',
			),
			"footer_columns_{$cpt}"         => array(
				'title'      => esc_html__( 'Footer columns', 'heaven11' ),
				'desc'       => wp_kses_data( __( 'Select number columns to show widgets in the footer. If 0 - autodetect by the widgets count', 'heaven11' ) ),
				'dependency' => array(
					"footer_type_{$cpt}"    => array( 'default' ),
					"footer_widgets_{$cpt}" => array( '^hide' ),
				),
				'std'        => 0,
				'options'    => heaven11_get_list_range( 0, 6 ),
				'type'       => 'select',
			),
			"footer_wide_{$cpt}"            => array(
				'title'      => esc_html__( 'Footer fullwidth', 'heaven11' ),
				'desc'       => wp_kses_data( __( 'Do you want to stretch the footer to the entire window width?', 'heaven11' ) ),
				'dependency' => array(
					"footer_type_{$cpt}" => array( 'default' ),
				),
				'std'        => 0,
				'type'       => 'checkbox',
			),
		);
	}
}


// Return lists with choises when its need in the admin mode
if ( ! function_exists( 'heaven11_options_get_list_choises' ) ) {
	add_filter( 'heaven11_filter_options_get_list_choises', 'heaven11_options_get_list_choises', 10, 2 );
	function heaven11_options_get_list_choises( $list, $id ) {
		if ( is_array( $list ) && count( $list ) == 0 ) {
			if ( strpos( $id, 'header_style' ) === 0 ) {
				$list = heaven11_get_list_header_styles( strpos( $id, 'header_style_' ) === 0 );
			} elseif ( strpos( $id, 'header_position' ) === 0 ) {
				$list = heaven11_get_list_header_positions( strpos( $id, 'header_position_' ) === 0 );
			} elseif ( strpos( $id, 'header_widgets' ) === 0 ) {
				$list = heaven11_get_list_sidebars( strpos( $id, 'header_widgets_' ) === 0, true );
			} elseif ( strpos( $id, '_scheme' ) > 0 ) {
				$list = heaven11_get_list_schemes( 'color_scheme' != $id );
			} elseif ( strpos( $id, 'sidebar_widgets' ) === 0 ) {
				$list = heaven11_get_list_sidebars( 'sidebar_widgets_single' != $id && ( strpos( $id, 'sidebar_widgets_' ) === 0 || strpos( $id, 'sidebar_widgets_single_' ) === 0 ), true );
			} elseif ( strpos( $id, 'sidebar_position_mobile' ) === 0 ) {
				$list = heaven11_get_list_sidebars_positions_mobile( strpos( $id, 'sidebar_position_mobile_' ) === 0 );
			} elseif ( strpos( $id, 'sidebar_position' ) === 0 ) {
				$list = heaven11_get_list_sidebars_positions( strpos( $id, 'sidebar_position_' ) === 0 );
			} elseif ( strpos( $id, 'widgets_above_page' ) === 0 ) {
				$list = heaven11_get_list_sidebars( strpos( $id, 'widgets_above_page_' ) === 0, true );
			} elseif ( strpos( $id, 'widgets_above_content' ) === 0 ) {
				$list = heaven11_get_list_sidebars( strpos( $id, 'widgets_above_content_' ) === 0, true );
			} elseif ( strpos( $id, 'widgets_below_page' ) === 0 ) {
				$list = heaven11_get_list_sidebars( strpos( $id, 'widgets_below_page_' ) === 0, true );
			} elseif ( strpos( $id, 'widgets_below_content' ) === 0 ) {
				$list = heaven11_get_list_sidebars( strpos( $id, 'widgets_below_content_' ) === 0, true );
			} elseif ( strpos( $id, 'footer_style' ) === 0 ) {
				$list = heaven11_get_list_footer_styles( strpos( $id, 'footer_style_' ) === 0 );
			} elseif ( strpos( $id, 'footer_widgets' ) === 0 ) {
				$list = heaven11_get_list_sidebars( strpos( $id, 'footer_widgets_' ) === 0, true );
			} elseif ( strpos( $id, 'blog_style' ) === 0 ) {
				$list = heaven11_get_list_blog_styles( strpos( $id, 'blog_style_' ) === 0 );
			} elseif ( strpos( $id, 'post_type' ) === 0 ) {
				$list = heaven11_get_list_posts_types();
			} elseif ( strpos( $id, 'parent_cat' ) === 0 ) {
				$list = heaven11_array_merge( array( 0 => esc_html__( '- Select category -', 'heaven11' ) ), heaven11_get_list_categories() );
			} elseif ( strpos( $id, 'blog_animation' ) === 0 ) {
				$list = heaven11_get_list_animations_in();
			} elseif ( 'color_scheme_editor' == $id ) {
				$list = heaven11_get_list_schemes();
			} elseif ( strpos( $id, '_font-family' ) > 0 ) {
				$list = heaven11_get_list_load_fonts( true );
			}
		}
		return $list;
	}
}