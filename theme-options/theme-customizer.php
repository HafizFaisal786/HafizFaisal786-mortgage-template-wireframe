<?php
/**
 * Theme customizer
 *
 * @package WordPress
 * @subpackage HEAVEN11
 * @since HEAVEN11 1.0
 */


//--------------------------------------------------------------
//-- First run actions after switch theme
//--------------------------------------------------------------
if ( ! function_exists( 'heaven11_customizer_action_switch_theme' ) ) {
	add_action( 'after_switch_theme', 'heaven11_customizer_action_switch_theme' );
	function heaven11_customizer_action_switch_theme() {
		// Duplicate theme options between parent and child themes
		$duplicate = heaven11_get_theme_setting( 'duplicate_options' );
		if ( in_array( $duplicate, array( 'child', 'both' ) ) ) {
			$theme_slug      = get_option( 'template' );
			$theme_time      = (int) get_option( "heaven11_options_timestamp_{$theme_slug}" );
			$stylesheet_slug = get_option( 'stylesheet' );

			// If child-theme is activated - duplicate options from template to the child-theme
			if ( $theme_slug != $stylesheet_slug ) {
				$stylesheet_time = (int) get_option( "heaven11_options_timestamp_{$stylesheet_slug}" );
				if ( $theme_time > $stylesheet_time ) {
					heaven11_customizer_duplicate_theme_options( $theme_slug, $stylesheet_slug, $theme_time );
				}

				// If main theme (template) is activated and 'duplicate_options' == 'child'
				// (duplicate options only from template to the child-theme) - regenerate CSS  with custom colors and fonts
			} elseif ( 'child' == $duplicate && $theme_time > 0 ) {
				heaven11_customizer_save_css();
			}
		}
	}
}


// Duplicate theme options between template and child-theme
if ( ! function_exists( 'heaven11_customizer_duplicate_theme_options' ) ) {
	function heaven11_customizer_duplicate_theme_options( $from, $to, $timestamp = 0 ) {
		if ( 0 == $timestamp ) {
			$timestamp = get_option( "heaven11_options_timestamp_{$from}" );
		}
		$from         = "theme_mods_{$from}";
		$from_options = get_option( $from );
		$to           = "theme_mods_{$to}";
		$to_options   = get_option( $to );
		if ( is_array( $from_options ) ) {
			if ( ! is_array( $to_options ) ) {
				$to_options = array();
			}
			$theme_options = heaven11_storage_get( 'options' );
			foreach ( $from_options as $k => $v ) {
				if ( isset( $theme_options[ $k ] ) ) {
					$to_options[ $k ] = $v;
				}
			}
			update_option( $to, $to_options );
			update_option( "heaven11_options_timestamp_{$to}", $timestamp );
		}
	}
}


//--------------------------------------------------------------
//-- New panel in the Customizer Controls
//--------------------------------------------------------------

// Theme init priorities:
// 3 - add/remove Theme Options elements
if ( ! function_exists( 'heaven11_customizer_setup3' ) ) {
	add_action( 'after_setup_theme', 'heaven11_customizer_setup3', 3 );
	function heaven11_customizer_setup3() {
		heaven11_storage_merge_array(
			'options', '', array(
				'cpt' => array(
					'title'    => esc_html__( 'Plugins settings', 'heaven11' ),
					'desc'     => '',
					'priority' => 400,
					'type'     => 'panel',
				),
			)
		);
	}
}
// 3 - add/remove Theme Options elements
if ( ! function_exists( 'heaven11_customizer_setup4' ) ) {
	add_action( 'after_setup_theme', 'heaven11_customizer_setup4', 4 );
	function heaven11_customizer_setup4() {
		heaven11_storage_merge_array(
			'options', '', array(
				'cpt_end' => array(
					'type' => 'panel_end',
				),
			)
		);
	}
}


//--------------------------------------------------------------
//-- Register Customizer Controls
//--------------------------------------------------------------

define( 'HEAVEN11_CUSTOMIZE_PRIORITY', 200 );      // Start priority for the new controls

// Register custom controls for the customizer
if ( ! function_exists( 'heaven11_customizer_custom_controls' ) ) {
	add_action( 'customize_register', 'heaven11_customizer_custom_controls' );
	function heaven11_customizer_custom_controls( $wp_customize ) {
		require_once HEAVEN11_THEME_DIR . 'theme-options/theme-customizer-controls.php';
	}
}

// Parse Theme Options and add controls to the customizer
if ( ! function_exists( 'heaven11_customizer_register_controls' ) ) {
	add_action( 'customize_register', 'heaven11_customizer_register_controls', 20 );
	function heaven11_customizer_register_controls( $wp_customize ) {

		$refresh_auto = heaven11_get_theme_setting( 'customize_refresh' ) != 'manual';

		$panels   = array( '' );
		$p        = 0;
		$sections = array( '' );
		$s        = 0;

		$expand = array();

		$i = HEAVEN11_CUSTOMIZE_PRIORITY;

		// Reload Theme Options before create controls
		if ( is_admin() ) {
			heaven11_storage_set( 'options_reloaded', true );
			heaven11_load_theme_options();
		}
		$options = heaven11_storage_get( 'options' );

		foreach ( $options as $id => $opt ) {
			$i = ! empty( $opt['priority'] )
					? $opt['priority']
					: ( in_array( $opt['type'], array( 'panel', 'section' ) )
							? HEAVEN11_CUSTOMIZE_PRIORITY
							: $i++
						);

			if ( ! empty( $opt['hidden'] ) ) {
				continue;
			}

			if ( ! isset( $opt['title'] ) ) {
				$opt['title'] = '';
			}
			if ( ! isset( $opt['desc'] ) ) {
				$opt['desc'] = '';
			}

			$transport = $refresh_auto && ( ! isset( $opt['refresh'] ) || true === $opt['refresh'] ) ? 'refresh' : 'postMessage';

			if ( ! empty( $opt['override'] ) ) {
				$opt['title'] .= ' *';
			}

			// URL to redirect preview area and/or JS callback on expand panel
			
			if ( in_array( $opt['type'], array( 'panel', 'section' ) ) && ! empty( $opt['expand_url'] ) || ! empty( $opt['expand_callback'] ) ) {
				$expand[ $id ] = array( 'type' => $opt['type'] );
				if ( ! empty( $opt['expand_url'] ) ) {
					$expand[ $id ]['url'] = $opt['expand_url'];
				}
				if ( ! empty( $opt['expand_callback'] ) ) {
					$expand[ $id ]['callback'] = $opt['expand_callback'];
				}
			}

			if ( 'panel' == $opt['type'] ) {

				if ( $p > 0 ) {
					array_pop( $panels );
					$p--;
				}
				if ( $s > 0 ) {
					array_pop( $sections );
					$s--;
				}

				$sec = $wp_customize->get_panel( $id );
				if ( is_object( $sec ) && ! empty( $sec->title ) ) {
					$sec->title       = $opt['title'];
					$sec->description = $opt['desc'];
					if ( ! empty( $opt['priority'] ) ) {
						$sec->priority = $opt['priority'];
					}
					if ( ! empty( $opt['active_callback'] ) ) {
						$sec->active_callback = $opt['active_callback'];
					}
				} else {
					$wp_customize->add_panel(
						esc_attr( $id ), array(
							'title'           => $opt['title'],
							'description'     => $opt['desc'],
							'priority'        => $i,
							'active_callback' => ! empty( $opt['active_callback'] ) ? $opt['active_callback'] : '',
						)
					);
				}

				array_push( $panels, $id );
				$p++;

			} elseif ( 'panel_end' == $opt['type'] ) {

				array_pop( $panels );
				$p--;

			} elseif ( 'section' == $opt['type'] ) {

				if ( $s > 0 ) {
					array_pop( $sections );
					$s--;
				}

				$sec = $wp_customize->get_section( $id );
				if ( is_object( $sec ) && ! empty( $sec->title ) ) {
					$sec->title       = $opt['title'];
					$sec->description = $opt['desc'];
					$sec->panel       = esc_attr( $panels[ $p ] );
					if ( ! empty( $opt['priority'] ) ) {
						$sec->priority = $opt['priority'];
					}
					if ( ! empty( $opt['active_callback'] ) ) {
						$sec->active_callback = $opt['active_callback'];
					}
				} else {
					$wp_customize->add_section(
						esc_attr( $id ), array(
							'title'           => $opt['title'],
							'description'     => $opt['desc'],
							'panel'           => esc_attr( $panels[ $p ] ),
							'priority'        => $i,
							'active_callback' => ! empty( $opt['active_callback'] ) ? $opt['active_callback'] : '',
						)
					);
				}

				array_push( $sections, $id );
				$s++;

			} elseif ( 'section_end' == $opt['type'] ) {

				array_pop( $sections );
				$s--;

			} elseif ( 'select' == $opt['type'] ) {

				$wp_customize->add_setting(
					$id, array(
						'default'           => heaven11_get_theme_option( $id ),
						'sanitize_callback' => 'sanitize_text_field',
						'transport'         => $transport,
					)
				);

				$wp_customize->add_control(
					$id, array(
						'label'           => $opt['title'],
						'description'     => $opt['desc'],
						'section'         => esc_attr( $sections[ $s ] ),
						'priority'        => $i,
						'active_callback' => ! empty( $opt['active_callback'] ) ? $opt['active_callback'] : '',
						'type'            => 'select',
						'choices'         => apply_filters( 'heaven11_filter_options_get_list_choises', $opt['options'], $id ),
						'input_attrs'     => array(
							'var_name' => ! empty( $opt['customizer'] ) ? $opt['customizer'] : '',
						),
					)
				);

			} elseif ( 'radio' == $opt['type'] ) {

				$wp_customize->add_setting(
					$id, array(
						'default'           => heaven11_get_theme_option( $id ),
						'sanitize_callback' => 'sanitize_text_field',
						'transport'         => $transport,
					)
				);

				$wp_customize->add_control(
					$id, array(
						'label'           => $opt['title'],
						'description'     => $opt['desc'],
						'section'         => esc_attr( $sections[ $s ] ),
						'priority'        => $i,
						'active_callback' => ! empty( $opt['active_callback'] ) ? $opt['active_callback'] : '',
						'type'            => 'radio',
						'choices'         => apply_filters( 'heaven11_filter_options_get_list_choises', $opt['options'], $id ),
						'input_attrs'     => array(
							'var_name' => ! empty( $opt['customizer'] ) ? $opt['customizer'] : '',
						),
					)
				);

			} elseif ( 'switch' == $opt['type'] ) {

				$wp_customize->add_setting(
					$id, array(
						'default'           => heaven11_get_theme_option( $id ),
						'sanitize_callback' => 'sanitize_text_field',
						'transport'         => $transport,
					)
				);

				$wp_customize->add_control(
					new Heaven11_Customize_Switch_Control(
						$wp_customize, $id, array(
							'label'           => $opt['title'],
							'description'     => $opt['desc'],
							'section'         => esc_attr( $sections[ $s ] ),
							'priority'        => $i,
							'active_callback' => ! empty( $opt['active_callback'] ) ? $opt['active_callback'] : '',
							'choices'         => apply_filters( 'heaven11_filter_options_get_list_choises', $opt['options'], $id ),
							'input_attrs'     => array(
								'value'    => heaven11_get_theme_option( $id ),
								'var_name' => ! empty( $opt['customizer'] ) ? $opt['customizer'] : '',
							),
						)
					)
				);

			} elseif ( 'checkbox' == $opt['type'] ) {

				$wp_customize->add_setting(
					$id, array(
						'default'           => heaven11_get_theme_option( $id ),
						'sanitize_callback' => 'sanitize_text_field',
						'transport'         => $transport,
					)
				);

				$wp_customize->add_control(
					$id, array(
						'label'           => $opt['title'],
						'description'     => $opt['desc'],
						'section'         => esc_attr( $sections[ $s ] ),
						'active_callback' => ! empty( $opt['active_callback'] ) ? $opt['active_callback'] : '',
						'priority'        => $i,
						'type'            => 'checkbox',
						'input_attrs'     => array(
							'var_name' => ! empty( $opt['customizer'] ) ? $opt['customizer'] : '',
						),
					)
				);

			} elseif ( 'color' == $opt['type'] ) {

				$wp_customize->add_setting(
					$id, array(
						'default'           => heaven11_get_theme_option( $id ),
						'sanitize_callback' => 'sanitize_hex_color',
						'transport'         => $transport,
					)
				);

				$wp_customize->add_control(
					new WP_Customize_Color_Control(
						$wp_customize, $id, array(
							'label'           => $opt['title'],
							'description'     => $opt['desc'],
							'section'         => esc_attr( $sections[ $s ] ),
							'active_callback' => ! empty( $opt['active_callback'] ) ? $opt['active_callback'] : '',
							'priority'        => $i,
							'input_attrs'     => array(
								'var_name' => ! empty( $opt['customizer'] ) ? $opt['customizer'] : '',
							),
						)
					)
				);

			} elseif ( 'image' == $opt['type'] ) {
				$wp_customize->add_setting(
					$id, array(
						'default'           => heaven11_remove_protocol_from_url( heaven11_get_theme_option( $id ), false ),
						'sanitize_callback' => 'sanitize_text_field',
						'transport'         => $transport,
					)
				);

				$wp_customize->add_control(
					new WP_Customize_Image_Control(
						$wp_customize, $id, array(
							'label'           => $opt['title'],
							'description'     => $opt['desc'],
							'section'         => esc_attr( $sections[ $s ] ),
							'active_callback' => ! empty( $opt['active_callback'] ) ? $opt['active_callback'] : '',
							'priority'        => $i,
							'input_attrs'     => array(
								'var_name' => ! empty( $opt['customizer'] ) ? $opt['customizer'] : '',
							),
						)
					)
				);

			} elseif ( in_array( $opt['type'], array( 'media', 'audio', 'video' ) ) ) {
				$wp_customize->add_setting(
					$id, array(
						'default'           => heaven11_remove_protocol_from_url( heaven11_get_theme_option( $id ), false ),
						'sanitize_callback' => 'sanitize_text_field',
						'transport'         => $transport,
					)
				);

				$wp_customize->add_control(
					new WP_Customize_Media_Control(
						$wp_customize, $id, array(
							'label'           => $opt['title'],
							'description'     => $opt['desc'],
							'section'         => esc_attr( $sections[ $s ] ),
							'active_callback' => ! empty( $opt['active_callback'] ) ? $opt['active_callback'] : '',
							'priority'        => $i,
							'input_attrs'     => array(
								'var_name' => ! empty( $opt['customizer'] ) ? $opt['customizer'] : '',
							),
						)
					)
				);

			} elseif ( 'icon' == $opt['type'] ) {

				$wp_customize->add_setting(
					$id, array(
						'default'           => heaven11_remove_protocol_from_url( heaven11_get_theme_option( $id ), false ),
						'sanitize_callback' => 'sanitize_text_field',
						'transport'         => $transport,
					)
				);

				$wp_customize->add_control(
					new Heaven11_Customize_Icon_Control(
						$wp_customize, $id, array(
							'label'           => $opt['title'],
							'description'     => $opt['desc'],
							'section'         => esc_attr( $sections[ $s ] ),
							'priority'        => $i,
							'active_callback' => ! empty( $opt['active_callback'] ) ? $opt['active_callback'] : '',
							'input_attrs'     => array(
								'value'    => heaven11_get_theme_option( $id ),
								'var_name' => ! empty( $opt['customizer'] ) ? $opt['customizer'] : '',
							),
						)
					)
				);

			} elseif ( 'checklist' == $opt['type'] ) {

				$wp_customize->add_setting(
					$id, array(
						'default'           => heaven11_get_theme_option( $id ),
						'sanitize_callback' => 'sanitize_text_field',
						'transport'         => $transport,
					)
				);

				$wp_customize->add_control(
					new Heaven11_Customize_Checklist_Control(
						$wp_customize, $id, array(
							'label'           => $opt['title'],
							'description'     => $opt['desc'],
							'section'         => esc_attr( $sections[ $s ] ),
							'priority'        => $i,
							'active_callback' => ! empty( $opt['active_callback'] ) ? $opt['active_callback'] : '',
							'choices'         => apply_filters( 'heaven11_filter_options_get_list_choises', $opt['options'], $id ),
							'input_attrs'     => array_merge(
								$opt, array(
									'value'    => heaven11_get_theme_option( $id ),
									'var_name' => ! empty( $opt['customizer'] ) ? $opt['customizer'] : '',
								)
							),
						)
					)
				);

			} elseif ( in_array( $opt['type'], array( 'slider', 'range' ) ) ) {

				$wp_customize->add_setting(
					$id, array(
						'default'           => heaven11_get_theme_option( $id ),
						'sanitize_callback' => 'sanitize_text_field',
						'transport'         => $transport,
					)
				);

				$wp_customize->add_control(
					new Heaven11_Customize_Range_Control(
						$wp_customize, $id, array(
							'label'           => $opt['title'],
							'description'     => $opt['desc'],
							'section'         => esc_attr( $sections[ $s ] ),
							'priority'        => $i,
							'active_callback' => ! empty( $opt['active_callback'] ) ? $opt['active_callback'] : '',
							'input_attrs'     => array_merge(
								$opt, array(
									'show_value' => ! isset( $opt['show_value'] ) || $opt['show_value'],
									'value'      => heaven11_get_theme_option( $id ),
									'var_name'   => ! empty( $opt['customizer'] ) ? $opt['customizer'] : '',
								)
							),
						)
					)
				);

			} elseif ( 'scheme_editor' == $opt['type'] ) {

				$wp_customize->add_setting(
					$id, array(
						'default'           => heaven11_get_theme_option( $id ),
						'sanitize_callback' => 'sanitize_text_field',
						'transport'         => $transport,
					)
				);

				$wp_customize->add_control(
					new Heaven11_Customize_Scheme_Editor_Control(
						$wp_customize, $id, array(
							'label'           => $opt['title'],
							'description'     => $opt['desc'],
							'section'         => esc_attr( $sections[ $s ] ),
							'priority'        => $i,
							'active_callback' => ! empty( $opt['active_callback'] ) ? $opt['active_callback'] : '',
							'input_attrs'     => array_merge(
								$opt, array(
									'value'    => heaven11_get_theme_option( $id ),
									'var_name' => ! empty( $opt['customizer'] ) ? $opt['customizer'] : '',
								)
							),
						)
					)
				);

			} elseif ( 'text_editor' == $opt['type'] ) {

				$wp_customize->add_setting(
					$id, array(
						'default'           => heaven11_get_theme_option( $id ),
						'sanitize_callback' => 'wp_kses_post',
						'transport'         => $transport,
					)
				);

				$wp_customize->add_control(
					new Heaven11_Customize_Text_Editor_Control(
						$wp_customize, $id, array(
							'label'           => $opt['title'],
							'description'     => $opt['desc'],
							'section'         => esc_attr( $sections[ $s ] ),
							'priority'        => $i,
							'active_callback' => ! empty( $opt['active_callback'] ) ? $opt['active_callback'] : '',
							'input_attrs'     => array_merge(
								$opt, array(
									'value'    => heaven11_get_theme_option( $id ),
									'var_name' => ! empty( $opt['customizer'] ) ? $opt['customizer'] : '',
								)
							),
						)
					)
				);

			} elseif ( 'button' == $opt['type'] ) {

				$wp_customize->add_setting(
					$id, array(
						'default'           => heaven11_get_theme_option( $id ),
						'sanitize_callback' => 'sanitize_text_field',
						'transport'         => $transport,
					)
				);

				$wp_customize->add_control(
					new Heaven11_Customize_Button_Control(
						$wp_customize, $id, array(
							'label'           => $opt['title'],
							'description'     => $opt['desc'],
							'section'         => esc_attr( $sections[ $s ] ),
							'priority'        => $i,
							'active_callback' => ! empty( $opt['active_callback'] ) ? $opt['active_callback'] : '',
							'input_attrs'     => $opt,
						)
					)
				);

			} elseif ( 'info' == $opt['type'] ) {

				$wp_customize->add_setting(
					$id, array(
						'default'           => '',
						'sanitize_callback' => 'sanitize_text_field',
						'transport'         => 'postMessage',
					)
				);

				$wp_customize->add_control(
					new Heaven11_Customize_Info_Control(
						$wp_customize, $id, array(
							'label'           => $opt['title'],
							'description'     => $opt['desc'],
							'section'         => esc_attr( $sections[ $s ] ),
							'priority'        => $i,
							'active_callback' => ! empty( $opt['active_callback'] ) ? $opt['active_callback'] : '',
						)
					)
				);

			} elseif ( 'hidden' == $opt['type'] ) {

				$wp_customize->add_setting(
					$id, array(
						'default'           => heaven11_get_theme_option( $id ),
						'sanitize_callback' => 'heaven11_sanitize_html',
						'transport'         => 'postMessage',
					)
				);

				$wp_customize->add_control(
					new Heaven11_Customize_Hidden_Control(
						$wp_customize, $id, array(
							'label'           => $opt['title'],
							'description'     => $opt['desc'],
							'section'         => esc_attr( $sections[ $s ] ),
							'priority'        => $i,
							'active_callback' => ! empty( $opt['active_callback'] ) ? $opt['active_callback'] : '',
							'input_attrs'     => array(
								'var_name' => ! empty( $opt['customizer'] ) ? $opt['customizer'] : '',
							),
						)
					)
				);

			} else {    

				if ( ! apply_filters( 'heaven11_filter_register_customizer_control', false, $wp_customize, $id, $sections[ $s ], $i, $transport, $opt ) ) {
					
					if ( 'text_editor' == $opt['type'] ) {
						$opt['type'] = 'textarea';
					}

					$wp_customize->add_setting(
						$id, array(
							'default'           => heaven11_get_theme_option( $id ),
							'sanitize_callback' => ! empty( $opt['sanitize'] )
														? $opt['sanitize']
														: ( 'text' == $opt['type']
																? 'sanitize_text_field'
																: 'wp_kses_post'
															),
							'transport'         => $transport,
						)
					);

					$wp_customize->add_control(
						$id, array(
							'label'           => $opt['title'],
							'description'     => $opt['desc'],
							'section'         => esc_attr( $sections[ $s ] ),
							'priority'        => $i,
							'active_callback' => ! empty( $opt['active_callback'] ) ? $opt['active_callback'] : '',
							'type'            => $opt['type'], 
							'input_attrs'     => array(
								'var_name' => ! empty( $opt['customizer'] ) ? $opt['customizer'] : '',
							),
						)
					);
				}
			}

			// Register Partial Refresh (if supported)
			if ( $refresh_auto && isset( $opt['refresh'] ) && is_string( $opt['refresh'] )
				&& function_exists( "heaven11_customizer_partial_refresh_{$id}" )
				&& isset( $wp_customize->selective_refresh ) ) {
				$wp_customize->selective_refresh->add_partial(
					$id, array(
						'selector'            => $opt['refresh'],
						'settings'            => $id,
						'render_callback'     => "heaven11_customizer_partial_refresh_{$id}",
						'container_inclusive' => ! empty( $opt['refresh_wrapper'] ),
					)
				);
			}
		}

		// Save expand callbacks to use it in the localize scripts
		heaven11_storage_set( 'customizer_expand', $expand );

		// Setup standard WP Controls
		// ---------------------------------

		// Reorder standard WP sections
		$sec = $wp_customize->get_panel( 'nav_menus' );
		if ( is_object( $sec ) ) {
			$sec->priority = 60;
		}
		$sec = $wp_customize->get_panel( 'widgets' );
		if ( is_object( $sec ) ) {
			$sec->priority = 61;
		}
		$sec = $wp_customize->get_section( 'static_front_page' );
		if ( is_object( $sec ) ) {
			$sec->priority = 62;
		}
		$sec = $wp_customize->get_section( 'custom_css' );
		if ( is_object( $sec ) ) {
			$sec->priority = 2000;
		}

		// Modify standard WP controls
		$sec = $wp_customize->get_control( 'blogname' );
		if ( is_object( $sec ) ) {
			$sec->description = esc_html__( 'Use "((" and "))", "{{" and "}}" to modify style and color of parts of the text, "||" to break current line', 'heaven11' );
		}
		$sec = $wp_customize->get_setting( 'blogname' );
		if ( is_object( $sec ) ) {
			$sec->transport = 'postMessage';
		}

		$sec = $wp_customize->get_setting( 'blogdescription' );
		if ( is_object( $sec ) ) {
			$sec->transport = 'postMessage';
		}

		$sec = $wp_customize->get_control( 'site_icon' );
		if ( is_object( $sec ) ) {
			$sec->priority = 15;
		}
		$sec = $wp_customize->get_control( 'custom_logo' );
		if ( is_object( $sec ) ) {
			$sec->priority    = 50;
			$sec->description = wp_kses_data( __( 'Select or upload the site logo', 'heaven11' ) );
		}

		$sec  = $wp_customize->get_section( 'header_image' );
		$sec2 = $wp_customize->get_control( 'header_image_info' );
		if ( is_object( $sec2 ) ) {
			$sec2->description = ( ! empty( $sec2->description ) ? $sec2->description . '<br>' : '' ) . $sec->description;
		}

		$sec = $wp_customize->get_control( 'header_image' );
		if ( is_object( $sec ) ) {
			$sec->priority = 300;
			$sec->section  = 'header';
		}
		$sec = $wp_customize->get_control( 'header_video' );
		if ( is_object( $sec ) ) {
			$sec->priority = 310;
			$sec->section  = 'header';
		}
		$sec = $wp_customize->get_control( 'external_header_video' );
		if ( is_object( $sec ) ) {
			$sec->priority = 320;
			$sec->section  = 'header';
		}

		$sec = $wp_customize->get_section( 'background_image' );
		if ( is_object( $sec ) ) {
			$sec->title       = esc_html__( 'Background', 'heaven11' );
			$sec->priority    = 310;
			$sec->description = esc_html__( 'Used only if "General settings - Body style" equal to "boxed"', 'heaven11' );
		}

		$sec = $wp_customize->get_control( 'background_color' );
		if ( is_object( $sec ) ) {
			$sec->priority = 10;
			$sec->section  = 'background_image';
		}

		// Remove unused sections
		$wp_customize->remove_section( 'colors' );
		$wp_customize->remove_section( 'header_image' );
	}
}


// Sanitize plain value - remove all tags and spaces
if ( ! function_exists( 'heaven11_sanitize_value' ) ) {
	function heaven11_sanitize_value( $value ) {
		return empty( $value ) ? $value : trim( strip_tags( $value ) );
	}
}


// Sanitize html value - keep only allowed tags
if ( ! function_exists( 'heaven11_sanitize_html' ) ) {
	function heaven11_sanitize_html( $value ) {
		return empty( $value ) ? $value : wp_kses(( $value ), 'heaven11_kses_content');
	}
}


// Return url to autofocus related field
if ( ! function_exists( 'heaven11_customizer_get_focus_url' ) ) {
	function heaven11_customizer_get_focus_url( $field ) {
		return admin_url( "customize.php?autofocus&#91;control&#93;={$field}" );
	}
}

// Return link to autofocus related field
if ( ! function_exists( 'heaven11_customizer_get_focus_link' ) ) {
	function heaven11_customizer_get_focus_link( $field, $text ) {
		return sprintf(
			'<a href="%1$s" class="heaven11_customizer_link">%2$s</a>',
			esc_url( heaven11_customizer_get_focus_url( $field ) ),
			$text
		);
	}
}

// Display message "Need to select widgets"
if ( ! function_exists( 'heaven11_customizer_need_widgets_message' ) ) {
	function heaven11_customizer_need_widgets_message( $field, $text ) {
		?><div class="heaven11_customizer_message">
		<?php
			echo wp_kses_data(
				sprintf(
					// Translators: Add widget's name or link to focus specified section
					__( 'You have to choose widget "<b>%s</b>" in this section. You can also select any other widget, and change the purpose of this section', 'heaven11' ),
					is_customize_preview()
						? $text
						: heaven11_customizer_get_focus_link( $field, $text )
				)
			);
		?>
		</div>
		<?php
	}
}

// Display message "Need to install plugin ThemeREX Addons"
if ( ! function_exists( 'heaven11_customizer_need_trx_addons_message' ) ) {
	function heaven11_customizer_need_trx_addons_message() {
		?>
		<div class="heaven11_customizer_message">
			<?php
			echo wp_kses_data(
				sprintf(
					// Translators: Add the link to install plugin and its name
					__( 'You need to install the <b>%s</b> plugin to be able to add Team members, Testimonials, Services and many other widgets', 'heaven11' ),
					is_customize_preview()
						? __( 'ThemeREX Addons', 'heaven11' )
						: sprintf(
							// Translators: Make the tag with link to install plugin
							'<a href="%1$s" class="heaven11_customizer_link">%2$s</a>',
							esc_url(
								wp_nonce_url(
									self_admin_url( 'update.php?action=install-plugin&plugin=trx_addons' ),
									'install-plugin_trx_addons'
								)
							),
							__( 'ThemeREX Addons', 'heaven11' )
						)
				)
			);
			echo '<br>' . wp_kses_data( __( 'Also you can insert in this section any other widgets and to modify its purpose', 'heaven11' ) );
			?>
		</div>
		<?php
	}
}


//--------------------------------------------------------------
// Save custom settings in CSS file
//--------------------------------------------------------------

// Save CSS with custom colors and fonts after save custom options
if ( ! function_exists( 'heaven11_customizer_action_save_after' ) ) {
	add_action( 'customize_save_after', 'heaven11_customizer_action_save_after' );
	function heaven11_customizer_action_save_after( $api = false ) {

		// Get saved settings
		$settings = $api->settings();

		// Store new schemes colors
		$scheme_storage = $settings['scheme_storage']->value();
		if ( $scheme_storage == serialize( heaven11_storage_get( 'schemes_original' ) ) ) {
			remove_theme_mod( 'scheme_storage' );
		} else {
			$schemes = heaven11_unserialize( $scheme_storage );
			if ( is_array( $schemes ) && count( $schemes ) > 0 ) {
				heaven11_storage_set( 'schemes', $schemes );
			}
		}

		// Store new fonts parameters
		$fonts = heaven11_get_theme_fonts();
		foreach ( $fonts as $tag => $v ) {
			foreach ( $v as $css_prop => $css_value ) {
				if ( in_array( $css_prop, array( 'title', 'description' ) ) ) {
					continue;
				}
				$fonts[ $tag ][ $css_prop ] = $settings[ "{$tag}_{$css_prop}" ]->value();
			}
		}
		heaven11_storage_set( 'theme_fonts', $fonts );

		// Collect options from the external storages
		$theme_mods        = array();
		$options           = heaven11_storage_get( 'options' );
		$external_storages = array();
		foreach ( $options as $k => $v ) {
			// Skip non-data options - sections, info, etc.
			if ( ! isset( $v['std'] ) ) {
				continue;
			}
			// Get option value from Customizer
			$value            = isset( $settings[ $k ] )
							? $settings[ $k ]->value()
							: ( 'checkbox' == $v['type'] ? 0 : '' );
			$theme_mods[ $k ] = $value;
			// Skip internal options
			if ( empty( $v['options_storage'] ) ) {
				continue;
			}
			// Save option to the external storage
			if ( ! isset( $external_storages[ $v['options_storage'] ] ) ) {
				$external_storages[ $v['options_storage'] ] = array();
			}
			$external_storages[ $v['options_storage'] ][ $k ] = $value;
		}

		// Update options in the external storages
		foreach ( $external_storages as $storage_name => $storage_values ) {
			$storage = get_option( $storage_name, false );
			if ( is_array( $storage ) ) {
				foreach ( $storage_values as $k => $v ) {
					$storage[ $k ] = $v;
				}
				update_option( $storage_name, apply_filters( 'heaven11_filter_options_save', $storage, $storage_name ) );
			}
		}

		do_action( 'heaven11_action_just_save_options', $theme_mods );

		// Update ThemeOptions save timestamp
		$stylesheet_slug = get_option( 'stylesheet' );
		$stylesheet_time = time();
		update_option( "heaven11_options_timestamp_{$stylesheet_slug}", $stylesheet_time );

		// Sinchronize theme options between child and parent themes
		if ( heaven11_get_theme_setting( 'duplicate_options' ) == 'both' ) {
			$theme_slug = get_option( 'template' );
			if ( $theme_slug != $stylesheet_slug ) {
				heaven11_customizer_duplicate_theme_options( $stylesheet_slug, $theme_slug, $stylesheet_time );
			}
		}

		// Apply action - moved to the delayed state (see below) to load all enabled modules and apply changes after
		// Attention! Don't remove comment the line below!
		// Not need here: do_action('heaven11_action_save_options');
		update_option( 'heaven11_action', 'heaven11_action_save_options' );
	}
}

// Save CSS with custom colors and fonts to the custom.css
if ( ! function_exists( 'heaven11_customizer_save_css' ) ) {
	add_action( 'heaven11_action_save_options', 'heaven11_customizer_save_css', 20 );
	add_action( 'trx_addons_action_save_options', 'heaven11_customizer_save_css', 20 );
	function heaven11_customizer_save_css() {

		$msg = '/* ' . esc_html__( "ATTENTION! This file was generated automatically! Don't change it!!!", 'heaven11' )
				. "\n----------------------------------------------------------------------- */\n";

		// Save CSS with custom fonts and vars to the __custom.css
		// Attention! Colors should be saved to the __custom.css only if theme settings 'separate_schemes' is false
		$css = heaven11_customizer_get_css(
			array(
				'colors' => heaven11_get_theme_setting( 'separate_schemes' ) ? false : null,
			)
		);
		heaven11_fpc( heaven11_get_file_dir( 'css/__custom.css' ), $msg . $css );

		// Save separate CSS with colors to the __colors_xxx.css if theme settings 'separate_schemes' is true
		if ( heaven11_get_theme_setting( 'separate_schemes' ) ) {
			$schemes = heaven11_get_sorted_schemes();
			if ( is_array( $schemes ) ) {
				$css_dir = heaven11_get_folder_dir( 'css' );
				foreach ( $schemes as $scheme => $data ) {
					$fdir = heaven11_get_file_dir( heaven11_esc( "css/__colors_{$scheme}.css" ) );
					if ( empty( $fdir ) ) {
						$fdir = trailingslashit( $css_dir ) . heaven11_esc( "__colors_{$scheme}.css" );
						heaven11_fpc( $fdir, '' );
					}
					$css = heaven11_customizer_get_css(
						array(
							'fonts'  => false,
							'vars'   => false,
							'colors' => $data['colors'],
							'scheme' => $scheme,
						)
					);
					heaven11_fpc( $fdir, $msg . $css );
				}
			}
		}

		// Merge styles
		heaven11_merge_sass(
			'css/_theme-plugins.scss', apply_filters(
				'heaven11_filter_merge_styles', array(
					'css/_mixins.scss',
					'css/_theme-vars.scss',
				)
			)
		);

		// Merge responsive styles
		heaven11_merge_sass(
			'css/responsive.scss', apply_filters(
				'heaven11_filter_merge_styles_responsive', array(
					'css/_mixins.scss',
					'css/_theme-vars.scss',
					'css/_theme-responsive.scss',
				)
			), true
		);

		// Merge scripts
		heaven11_merge_files(
			'js/__scripts.js', apply_filters(
				'heaven11_filter_merge_scripts', array(
					'js/skip-link-focus.js',
					'js/bideo.js',
					'js/jquery.tubular.js',
					'js/theme-utils.js',
					'js/theme-init.js',
				)
			)
		);
	}
}

// Add theme-specific blog styles and scripts to the list
if ( ! function_exists( 'heaven11_customizer_add_blog_styles_and_scripts' ) ) {
	function heaven11_customizer_add_blog_styles_and_scripts( $list = false, $type = 'styles', $responsive = false ) {
		$styles = heaven11_storage_get( 'blog_styles' );
		if ( is_array( $styles ) ) {
			if ( heaven11_exists_trx_addons() ) {
				$styles = array_merge(
					$styles,
					array(
						'custom' => array( 'styles' => 'custom' )
					)
				);
			}
			foreach ( $styles as $v ) {
				if ( ! empty( $v[ $type ] ) ) {
					foreach ( (array) $v[ $type ] as $s ) {
						$path = sprintf(
							'theme-specific/blog-styles/_%1$s%2$s.%3$s',
							$s,
							$responsive ? '-responsive' : '',
							'styles' == $type ? 'scss' : 'js'
						);
						if ( is_array( $list ) ) {
							if ( array_search( $path, $list ) === false ) {
								$list[] = $path;
							}
						} elseif ( 'scripts' == $type ) {
							$path = heaven11_get_file_url( $path );
							if ( '' != $path ) {
								wp_enqueue_script( 'heaven11-blog-style-' . esc_attr( $s ), $path, array( 'jquery' ), null, true );
							}
						}
					}
				}
			}
		}
		return $list;
	}
}

// Merge theme-specific blog styles
if ( ! function_exists( 'heaven11_customizer_merge_blog_styles' ) ) {
	add_filter( 'heaven11_filter_merge_styles', 'heaven11_customizer_merge_blog_styles', 8, 1 );
	function heaven11_customizer_merge_blog_styles( $list ) {
		return heaven11_customizer_add_blog_styles_and_scripts( $list, 'styles' );
	}
}

// Merge theme-specific blog styles
if ( ! function_exists( 'heaven11_customizer_merge_blog_styles_responsive' ) ) {
	add_filter( 'heaven11_filter_merge_styles_responsive', 'heaven11_customizer_merge_blog_styles_responsive', 8, 1 );
	function heaven11_customizer_merge_blog_styles_responsive( $list ) {
		return heaven11_customizer_add_blog_styles_and_scripts( $list, 'styles', true );
	}
}

// Merge theme-specific blog scripts
if ( ! function_exists( 'heaven11_customizer_merge_scripts' ) ) {
	add_filter( 'heaven11_filter_merge_scripts', 'heaven11_customizer_merge_scripts' );
	function heaven11_customizer_merge_scripts( $list ) {
		return heaven11_customizer_add_blog_styles_and_scripts( $list, 'scripts' );
	}
}

// Enqueue theme-specific blog scripts
if ( ! function_exists( 'heaven11_customizer_frontend_scripts' ) ) {
	add_action( 'wp_enqueue_scripts', 'heaven11_customizer_frontend_scripts', 1100 );
	function heaven11_customizer_frontend_scripts() {
		if ( heaven11_is_on( heaven11_get_theme_option( 'debug_mode' ) ) ) {
			heaven11_customizer_add_blog_styles_and_scripts( false, 'scripts' );
		}
	}
}

//--------------------------------------------------------------
// Customizer JS and CSS
//--------------------------------------------------------------

// Binds JS listener to Customizer controls.
if ( ! function_exists( 'heaven11_customizer_control_js' ) ) {
	add_action( 'customize_controls_enqueue_scripts', 'heaven11_customizer_control_js' );
	function heaven11_customizer_control_js() {
		wp_enqueue_style( 'heaven11-customizer', heaven11_get_file_url( 'theme-options/theme-customizer.css' ), array(), null );
		wp_enqueue_script(
			'heaven11-customizer',
			heaven11_get_file_url( 'theme-options/theme-customizer.js' ),
			array( 'customize-controls', 'iris', 'underscore', 'wp-util' ), null, true
		);
		wp_enqueue_script( 'heaven11-colorpicker-colors', heaven11_get_file_url( 'js/colorpicker/colors.js' ), array( 'jquery' ), null, true );
		wp_enqueue_script( 'heaven11-colorpicker', heaven11_get_file_url( 'js/colorpicker/jqColorPicker.js' ), array( 'jquery' ), null, true );
		wp_localize_script( 'heaven11-customizer', 'heaven11_color_schemes', heaven11_storage_get( 'schemes' ) );
		wp_localize_script( 'heaven11-customizer', 'heaven11_simple_schemes', heaven11_storage_get( 'schemes_simple' ) );
		wp_localize_script( 'heaven11-customizer', 'heaven11_sorted_schemes', heaven11_storage_get( 'schemes_sorted' ) );
		wp_localize_script( 'heaven11-customizer', 'heaven11_additional_colors', heaven11_storage_get( 'scheme_colors_add' ) );
		wp_localize_script( 'heaven11-customizer', 'heaven11_theme_fonts', heaven11_storage_get( 'theme_fonts' ) );
		wp_localize_script( 'heaven11-customizer', 'heaven11_theme_vars', heaven11_get_theme_vars() );
		wp_localize_script(
			'heaven11-customizer', 'heaven11_customizer_vars', apply_filters(
				'heaven11_filter_customizer_vars', array(
					'max_load_fonts'    => heaven11_get_theme_setting( 'max_load_fonts' ),
					'msg_refresh'       => esc_html__( 'Refresh', 'heaven11' ),
					'msg_reset'         => esc_html__( 'Reset', 'heaven11' ),
					'msg_reset_confirm' => esc_html__( 'Are you sure you want to reset all Theme Options?', 'heaven11' ),
					'actions'           => array(
						'expand' => heaven11_storage_get( 'customizer_expand', array() ),
					),
				)
			)
		);
		wp_localize_script( 'heaven11-customizer', 'heaven11_dependencies', heaven11_get_theme_dependencies() );
		heaven11_admin_localize_scripts();
	}
}


// Binds JS handlers to make the Customizer preview reload changes asynchronously.
if ( ! function_exists( 'heaven11_customizer_preview_js' ) ) {
	add_action( 'customize_preview_init', 'heaven11_customizer_preview_js' );
	function heaven11_customizer_preview_js() {
		wp_enqueue_script(
			'heaven11-customizer-preview',
			heaven11_get_file_url( 'theme-options/theme-customizer-preview.js' ),
			array( 'customize-preview' ), null, true
		);
		wp_localize_script( 'heaven11-customizer-preview', 'heaven11_color_schemes', heaven11_storage_get( 'schemes' ) );
	}
}

// Output an Underscore template for generating CSS for the color scheme.
// The template generates the css dynamically for instant display in the Customizer preview.
if ( ! function_exists( 'heaven11_customizer_css_template' ) ) {
	add_action( 'customize_controls_print_footer_scripts', 'heaven11_customizer_css_template' );
	function heaven11_customizer_css_template() {
		$colors = array();
		foreach ( heaven11_get_scheme_colors() as $k => $v ) {
			$colors[ $k ] = '{{ data.' . esc_attr( $k ) . ' }}';
		}

		$tmpl_holder = 'script';

		$schemes = array_keys( heaven11_get_list_schemes() );
		if ( count( $schemes ) > 0 ) {
			foreach ( $schemes as $scheme ) {
				heaven11_show_layout(
					heaven11_customizer_get_css(
						array(
							'colors'        => $colors,
							'scheme'        => $scheme,
							'fonts'         => false,
							'vars'          => false,
							'remove_spaces' => false,
						)
					),
					'<' . esc_html( $tmpl_holder ) . ' type="text/html" id="tmpl-heaven11-color-scheme-' . esc_attr( $scheme ) . '">',
					'</' . esc_html( $tmpl_holder ) . '>'
				);
			}
		}

		// Fonts
		$fonts = heaven11_get_theme_fonts();
		if ( is_array( $fonts ) && count( $fonts ) > 0 ) {
			foreach ( $fonts as $tag => $font ) {
				$fonts[ $tag ]['font-family']     = '{{ data["' . $tag . '"]["font-family"] }}';
				$fonts[ $tag ]['font-size']       = '{{ data["' . $tag . '"]["font-size"] }}';
				$fonts[ $tag ]['line-height']     = '{{ data["' . $tag . '"]["line-height"] }}';
				$fonts[ $tag ]['font-weight']     = '{{ data["' . $tag . '"]["font-weight"] }}';
				$fonts[ $tag ]['font-style']      = '{{ data["' . $tag . '"]["font-style"] }}';
				$fonts[ $tag ]['text-decoration'] = '{{ data["' . $tag . '"]["text-decoration"] }}';
				$fonts[ $tag ]['text-transform']  = '{{ data["' . $tag . '"]["text-transform"] }}';
				$fonts[ $tag ]['letter-spacing']  = '{{ data["' . $tag . '"]["letter-spacing"] }}';
				$fonts[ $tag ]['margin-top']      = '{{ data["' . $tag . '"]["margin-top"] }}';
				$fonts[ $tag ]['margin-bottom']   = '{{ data["' . $tag . '"]["margin-bottom"] }}';
			}
			heaven11_show_layout(
				heaven11_customizer_get_css(
					array(
						'colors'        => false,
						'scheme'        => '',
						'fonts'         => $fonts,
						'vars'          => false,
						'remove_spaces' => false,
					)
				),
				'<' . esc_html( $tmpl_holder ) . ' type="text/html" id="tmpl-heaven11-fonts">',
				'</' . esc_html( $tmpl_holder ) . '>'
			);
		}

		// Theme vars
		$vars = heaven11_get_theme_vars();
		if ( is_array( $vars ) && count( $vars ) > 0 ) {
			foreach ( $vars as $k => $v ) {
				$vars[ $k ] = '{{ data.' . esc_attr( $k ) . ' }}';
			}
			heaven11_show_layout(
				heaven11_customizer_get_css(
					array(
						'colors'        => false,
						'scheme'        => '',
						'fonts'         => false,
						'vars'          => $vars,
						'remove_spaces' => false,
					)
				),
				'<' . esc_html( $tmpl_holder ) . ' type="text/html" id="tmpl-heaven11-vars">',
				'</' . esc_html( $tmpl_holder ) . '>'
			);
		}

	}
}


// Additional (calculated) theme-specific colors
// Attention! Don't forget setup additional colors also in the theme-customizer.js
if ( ! function_exists( 'heaven11_customizer_add_theme_colors' ) ) {
	function heaven11_customizer_add_theme_colors( $colors ) {
		$add = heaven11_storage_get( 'scheme_colors_add' );
		if ( is_array( $add ) ) {
			foreach ( $add as $k => $v ) {
				if ( substr( $colors['text'], 0, 1 ) == '#' ) {
					$clr = $colors[ $v['color'] ];
					if ( isset( $v['hue'] ) || isset( $v['saturation'] ) || isset( $v['brightness'] ) ) {
						$clr = heaven11_hsb2hex(
							heaven11_hex2hsb(
								$clr,
								isset( $v['hue'] ) ? $v['hue'] : 0,
								isset( $v['saturation'] ) ? $v['saturation'] : 0,
								isset( $v['brightness'] ) ? $v['brightness'] : 0
							)
						);
					}
					if ( isset( $v['alpha'] ) ) {
						$clr = heaven11_hex2rgba( $clr, $v['alpha'] );
					}
					$colors[ $k ] = $clr;
				} else {
					$colors[ $k ] = sprintf( '{{ data.%s }}', $k );
				}
			}
		}
		return $colors;
	}
}



// Additional theme-specific fonts rules
// Attention! Don't forget setup fonts rules also in the theme-customizer.js
if ( ! function_exists( 'heaven11_customizer_add_theme_fonts' ) ) {
	function heaven11_customizer_add_theme_fonts( $fonts ) {
		$rez = array();
		foreach ( $fonts as $tag => $font ) {
			
			if ( substr( $font['font-family'], 0, 2 ) != '{{' ) {
				$rez[ $tag . '_font-family' ]     = ! empty( $font['font-family'] ) && ! heaven11_is_inherit( $font['font-family'] )
														? 'font-family:' . trim( $font['font-family'] ) . ';'
														: '';
				$rez[ $tag . '_font-size' ]       = ! empty( $font['font-size'] ) && ! heaven11_is_inherit( $font['font-size'] )
														? 'font-size:' . heaven11_prepare_css_value( $font['font-size'] ) . ';'
														: '';
				$rez[ $tag . '_line-height' ]     = ! empty( $font['line-height'] ) && ! heaven11_is_inherit( $font['line-height'] )
														? 'line-height:' . trim( $font['line-height'] ) . ';'
														: '';
				$rez[ $tag . '_font-weight' ]     = ! empty( $font['font-weight'] ) && ! heaven11_is_inherit( $font['font-weight'] )
														? 'font-weight:' . trim( $font['font-weight'] ) . ';'
														: '';
				$rez[ $tag . '_font-style' ]      = ! empty( $font['font-style'] ) && ! heaven11_is_inherit( $font['font-style'] )
														? 'font-style:' . trim( $font['font-style'] ) . ';'
														: '';
				$rez[ $tag . '_text-decoration' ] = ! empty( $font['text-decoration'] ) && ! heaven11_is_inherit( $font['text-decoration'] )
														? 'text-decoration:' . trim( $font['text-decoration'] ) . ';'
														: '';
				$rez[ $tag . '_text-transform' ]  = ! empty( $font['text-transform'] ) && ! heaven11_is_inherit( $font['text-transform'] )
														? 'text-transform:' . trim( $font['text-transform'] ) . ';'
														: '';
				$rez[ $tag . '_letter-spacing' ]  = ! empty( $font['letter-spacing'] ) && ! heaven11_is_inherit( $font['letter-spacing'] )
														? 'letter-spacing:' . trim( $font['letter-spacing'] ) . ';'
														: '';
				$rez[ $tag . '_margin-top' ]      = ! empty( $font['margin-top'] ) && ! heaven11_is_inherit( $font['margin-top'] )
														? 'margin-top:' . heaven11_prepare_css_value( $font['margin-top'] ) . ';'
														: '';
				$rez[ $tag . '_margin-bottom' ]   = ! empty( $font['margin-bottom'] ) && ! heaven11_is_inherit( $font['margin-bottom'] )
														? 'margin-bottom:' . heaven11_prepare_css_value( $font['margin-bottom'] ) . ';'
														: '';
			} else {
				$rez[ $tag . '_font-family' ]     = '{{ data["' . $tag . '_font-family"] }}';
				$rez[ $tag . '_font-size' ]       = '{{ data["' . $tag . '_font-size"] }}';
				$rez[ $tag . '_line-height' ]     = '{{ data["' . $tag . '_line-height"] }}';
				$rez[ $tag . '_font-weight' ]     = '{{ data["' . $tag . '_font-weight"] }}';
				$rez[ $tag . '_font-style' ]      = '{{ data["' . $tag . '_font-style"] }}';
				$rez[ $tag . '_text-decoration' ] = '{{ data["' . $tag . '_text-decoration"] }}';
				$rez[ $tag . '_text-transform' ]  = '{{ data["' . $tag . '_text-transform"] }}';
				$rez[ $tag . '_letter-spacing' ]  = '{{ data["' . $tag . '_letter-spacing"] }}';
				$rez[ $tag . '_margin-top' ]      = '{{ data["' . $tag . '_margin-top"] }}';
				$rez[ $tag . '_margin-bottom' ]   = '{{ data["' . $tag . '_margin-bottom"] }}';
			}
		}
		return $rez;
	}
}



// Additional theme-specific vars rules
// Attention! Don't forget setup vars rules also in the theme-customizer.js
if ( ! function_exists( 'heaven11_customizer_add_theme_vars' ) ) {
	function heaven11_customizer_add_theme_vars( $vars ) {
		$rez = $vars;
		// Add border radius
		if ( isset( $vars['rad'] ) ) {
			if ( substr( $vars['rad'], 0, 2 ) != '{{' ) {
				$rez['rad']   = heaven11_get_border_radius();
				$rez['rad50'] = ! empty( $vars['rad'] ) ? '50%' : 0;
				$rez['rad4']  = ! empty( $vars['rad'] ) ? '4px' : 0;
				$rez['rad3']  = ! empty( $vars['rad'] ) ? '3px' : 0;
				$rez['rad2']  = ! empty( $vars['rad'] ) ? '2px' : 0;
			} else {
				$rez['rad50'] = '{{ data.rad50 }}';
				$rez['rad4']  = '{{ data.rad4 }}';
				$rez['rad3']  = '{{ data.rad3 }}';
				$rez['rad2']  = '{{ data.rad2 }}';
			}
		}
		// Add page components
		if ( isset( $vars['page'] ) ) {
			if ( substr( $vars['page'], 0, 2 ) != '{{' ) {
				if ( empty( $vars['page'] ) ) {
					$vars['page'] = apply_filters( 'heaven11_filter_content_width', heaven11_get_theme_option( 'page_width' ) );
				}
				$rez['page']        = heaven11_prepare_css_value( $vars['page'] );
				$rez['page_boxed']  = heaven11_prepare_css_value( $vars['page'] + 2 * 60 );
				$rez['content']     = heaven11_prepare_css_value( $vars['page'] - $vars['sidebar'] - $vars['gap'] );
				$rez['sidebar']     = heaven11_prepare_css_value( $vars['sidebar'] );
				$rez['gap']         = heaven11_prepare_css_value( $vars['gap'] );
				$rez['sidebar_gap'] = heaven11_prepare_css_value( $vars['sidebar'] + $vars['gap'] );
				$rez['sidebar_prc'] = $vars['sidebar'] / $vars['page'];
				$rez['gap_prc']     = $vars['gap'] / $vars['page'];
			} else {
				$rez['page_boxed']  = '{{ data.page_boxed }}';
				$rez['content']     = '{{ data.content }}';
				$rez['sidebar_gap'] = '{{ data.sidebar_gap }}';
				$rez['sidebar_prc'] = '{{ data.sidebar_prc }}';
				$rez['gap_prc']     = '{{ data.gap_prc }}';
			}
		}
		return apply_filters( 'heaven11_filter_add_theme_vars', $rez, $vars );
	}
}


// Add scheme name in each selector in the CSS (priority 100 - after complete css)
if ( ! function_exists( 'heaven11_customizer_add_scheme_in_css' ) ) {
	add_action( 'heaven11_filter_get_css', 'heaven11_customizer_add_scheme_in_css', 100, 2 );
	function heaven11_customizer_add_scheme_in_css( $css, $args ) {
		if ( ! empty( $css['colors'] ) && isset( $args['colors'] ) ) {
			$colors       = $args['colors'];
			$rez          = '';
			$in_comment   = false;
			$in_rule      = false;
			$allow        = true;
			$scheme_class = sprintf( '.scheme_%s ', $args['scheme'] );
			$self_class   = '.scheme_self';
			$css_str      = str_replace( array( '{{', '}}' ), array( '[[', ']]' ), $css['colors'] );
			for ( $i = 0; $i < strlen( $css_str ); $i++ ) {
				$ch = $css_str[ $i ];
				if ( $in_comment ) {
					$rez .= $ch;
					if ( '/' == $ch && '*' == $css_str[ $i - 1 ] ) {
						$in_comment = false;
						$allow      = ! $in_rule;
					}
				} elseif ( $in_rule ) {
					$rez .= $ch;
					if ( '}' == $ch ) {
						$in_rule = false;
						$allow   = ! $in_comment;
					}
				} else {
					if ( '/' == $ch && '*' == $css_str[ $i + 1 ] ) {
						$rez       .= $ch;
						$in_comment = true;
					} elseif ( '{' == $ch ) {
						$rez    .= $ch;
						$in_rule = true;
					} elseif ( ',' == $ch ) {
						$rez  .= $ch;
						$allow = true;
					} elseif ( strpos( " \t\r\n", $ch ) === false ) {
						if ( $allow ) {
							$pos_comma   = strpos( $css_str, ',', $i + 1 );
							$pos_bracket = strpos( $css_str, '{', $i + 1 );
							$pos         = false === $pos_comma
											? $pos_bracket
											: ( false === $pos_bracket
													? $pos_comma
													: min( $pos_comma, $pos_bracket )
												);
							$selector    = $pos > 0 ? substr( $css_str, $i, $pos - $i ) : '';
							if ( strpos( $selector, $self_class ) !== false ) {
								$rez .= str_replace( $self_class, trim( $scheme_class ), $selector );
								$i   += strlen( $selector ) - 1;
							} else {
								$rez .= $scheme_class . trim( $ch );
							}
							$allow = false;
						} else {
							$rez .= $ch;
						}
					} else {
						$rez .= $ch;
					}
				}
			}
			$rez           = str_replace( array( '[[', ']]' ), array( '{{', '}}' ), $rez );
			$css['colors'] = $rez;
		}
		return $css;
	}
}


//----------------------------------------------------------------------------------------------
// Add fix to allow theme-specific sidebars in Customizer (if is_customize_preview() mode)
//----------------------------------------------------------------------------------------------
if ( ! function_exists( 'heaven11_customizer_fix_sidebars' ) && is_customize_preview() && is_front_page() ) {
	add_action( 'wp_footer', 'heaven11_customizer_fix_sidebars' );
	function heaven11_customizer_fix_sidebars() {
		$sidebars = heaven11_get_sidebars();
		if ( is_array( $sidebars ) ) {
			foreach ( $sidebars as $sb => $params ) {
				if ( ! empty( $params['front_page_section'] ) && is_active_sidebar( $sb ) ) {
					?>
					<div class="hidden"><?php dynamic_sidebar( $sb ); ?></div><?php
				}
			}
		}
	}
}

// Load theme options and styles
require_once HEAVEN11_THEME_DIR . 'theme-specific/theme-setup.php';
require_once HEAVEN11_THEME_DIR . 'theme-specific/theme-styles.php';
require_once HEAVEN11_THEME_DIR . 'theme-options/theme-options.php';
require_once HEAVEN11_THEME_DIR . 'theme-options/theme-options-override.php';
if ( ! HEAVEN11_THEME_FREE ) {
	require_once HEAVEN11_THEME_DIR . 'theme-options/theme-options-qsetup.php';
}
