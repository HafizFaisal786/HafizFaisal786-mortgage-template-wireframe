<?php
/* Elementor Builder support functions
------------------------------------------------------------------------------- */

if ( ! defined( 'HEAVEN11_ELEMENTOR_PADDINGS' ) ) {
	define( 'HEAVEN11_ELEMENTOR_PADDINGS', 15 );
}

// Theme init priorities:
// 1 - register filters to add/remove lists items in the Theme Options
if ( ! function_exists( 'heaven11_elm_theme_setup1' ) ) {
	add_action( 'after_setup_theme', 'heaven11_elm_theme_setup1', 1 );
	function heaven11_elm_theme_setup1() {
		if ( heaven11_exists_elementor() ) {
			add_filter( 'heaven11_filter_update_post_options', 'heaven11_elm_update_post_options', 10, 2 );
			add_action( 'heaven11_action_just_save_options', 'heaven11_elm_just_save_options', 10, 1 );
		}
	}
}

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'heaven11_elm_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'heaven11_elm_theme_setup9', 9 );
	function heaven11_elm_theme_setup9() {

		add_filter( 'heaven11_filter_merge_styles', 'heaven11_elm_merge_styles' );
		add_filter( 'heaven11_filter_merge_styles_responsive', 'heaven11_elm_merge_styles_responsive' );

		add_filter( 'trx_addons_filter_force_load_elementor_styles', 'heaven11_elm_force_load_elementor_styles' );

		if ( heaven11_exists_elementor() ) {
			add_action( 'init', 'heaven11_elm_init_once', 3 );
			add_action( 'elementor/editor/before_enqueue_scripts', 'heaven11_elm_editor_scripts' );

			// before Elementor 2.0.0
			add_filter( 'elementor/page/settings/success_response_data', 'heaven11_elm_page_options_save', 10, 3 );
			add_filter( 'elementor/general/settings/success_response_data', 'heaven11_elm_general_options_save', 10, 3 );
			// after Elementor 2.0.0
			add_filter( 'elementor/settings/page/success_response_data', 'heaven11_elm_page_options_save', 10, 3 );
			add_filter( 'elementor/settings/post/success_response_data', 'heaven11_elm_page_options_save', 10, 3 );
			add_filter( 'elementor/settings/general/success_response_data', 'heaven11_elm_general_options_save', 10, 3 );
			add_filter( 'elementor/documents/ajax_save/return_data', 'heaven11_elm_page_options_save_document', 10, 2 );

			add_filter( 'heaven11_filter_post_edit_link', 'heaven11_elm_post_edit_link', 10, 2 );
			
			add_action( 'elementor/element/before_section_end', 'heaven11_elm_add_color_scheme_control', 10, 3 );
			add_action( 'elementor/element/before_section_end', 'heaven11_elm_move_paddings_to_column_wrap', 10, 3 );
			// Add theme-specific page options.
			// Remove check is_admin() if have any problem with page-specific options!!!
			if ( is_admin() ) {
				add_action( 'elementor/element/after_section_end', 'heaven11_elm_add_page_options', 10, 3 );
			}
		}
		if ( is_admin() ) {
			add_filter( 'heaven11_filter_tgmpa_required_plugins', 'heaven11_elm_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'heaven11_elm_tgmpa_required_plugins' ) ) {
	
	function heaven11_elm_tgmpa_required_plugins( $list = array() ) {
		if ( heaven11_storage_isset( 'required_plugins', 'elementor' ) && heaven11_storage_get_array( 'required_plugins', 'elementor', 'install' ) !== false ) {
			$list[] = array(
				'name'     => heaven11_storage_get_array( 'required_plugins', 'elementor', 'title' ),
				'slug'     => 'elementor',
				'required' => false,
			);
		}
		return $list;
	}
}

// Check if Elementor is installed and activated
if ( ! function_exists( 'heaven11_exists_elementor' ) ) {
	function heaven11_exists_elementor() {
		return class_exists( 'Elementor\Plugin' );
	}
}

// Return true if Elementor exists and current mode is preview
if ( ! function_exists( 'heaven11_elementor_is_preview' ) ) {
	function heaven11_elementor_is_preview() {
		return heaven11_exists_elementor()
				&& ( \Elementor\Plugin::$instance->preview->is_preview_mode()
					|| ( heaven11_get_value_gp( 'post' ) > 0
						&& heaven11_get_value_gp( 'action' ) == 'elementor'
						)
					);
	}
}

// Merge custom styles
if ( ! function_exists( 'heaven11_elm_merge_styles' ) ) {
	
	function heaven11_elm_merge_styles( $list ) {
		if ( heaven11_exists_elementor() ) {
			$list[] = 'plugins/elementor/_elementor.scss';
		}
		return $list;
	}
}

// Merge responsive styles
if ( ! function_exists( 'heaven11_elm_merge_styles_responsive' ) ) {
	
	function heaven11_elm_merge_styles_responsive( $list ) {
		if ( heaven11_exists_elementor() ) {
			$list[] = 'plugins/elementor/_elementor-responsive.scss';
		}
		return $list;
	}
}


// Load required styles and scripts for Elementor Editor mode
if ( ! function_exists( 'heaven11_elm_editor_scripts' ) ) {
	
	function heaven11_elm_editor_scripts() {
		// Load font icons
		wp_enqueue_style( 'heaven11-icons', heaven11_get_file_url( 'css/font-icons/css/fontello-embedded.css' ), array(), null );
		wp_enqueue_script( 'heaven11-elementor-editor', heaven11_get_file_url( 'plugins/elementor/elementor-editor.js' ), array( 'jquery' ), null, true );
		heaven11_admin_scripts();
		heaven11_admin_localize_scripts();
	}
}

// Return true if specified post/page is built with Elementor
if ( !function_exists( 'heaven11_is_built_with_elementor' ) ) {
	function heaven11_is_built_with_elementor( $post_id ) {
		// Elementor\DB::is_built_with_elementor` is soft deprecated since 3.2.0
		// Use `Plugin::$instance->documents->get( $post_id )->is_built_with_elementor()` instead
		$rez = false;
		if ( heaven11_exists_elementor() && ! empty( $post_id ) ) {
			$document = \Elementor\Plugin::instance()->documents->get( $post_id );
			if ( is_object( $document ) ) {
				$rez = $document->is_built_with_elementor();
			}
		}
		return $rez;
	}
}

// Return true if current page use header or footer from Elementor and need to load Elementor styles
if ( ! function_exists( 'heaven11_elm_force_load_elementor_styles' ) ) {
	
	function heaven11_elm_force_load_elementor_styles($need) {
		if ( $need ) {
			$need = false;
			$header_id = heaven11_get_custom_header_id();
			$need = 0 < $header_id && heaven11_is_built_with_elementor( $header_id );
			if ( ! $need ) {
				$footer_id = heaven11_get_custom_footer_id();
				$need = 0 < $footer_id && heaven11_is_built_with_elementor( $footer_id );
			}
		}
		return $need;
	}
}


// Set Elementor's options at once
if ( ! function_exists( 'heaven11_elm_init_once' ) ) {
	
	function heaven11_elm_init_once() {
		if ( heaven11_exists_elementor() && ! get_option( 'heaven11_setup_elementor_options', false ) ) {
			// Set theme-specific values to the Elementor's options
			update_option( 'elementor_disable_color_schemes', 'yes' );
			update_option( 'elementor_disable_typography_schemes', 'yes' );
			update_option( 'elementor_container_width', heaven11_get_theme_option( 'page_width' ) + 2 * HEAVEN11_ELEMENTOR_PADDINGS );    // Theme-specific width + paddings of the columns
			update_option( 'elementor_space_between_widgets', 0 );
			update_option( 'elementor_stretched_section_container', '.page_wrap' );
			update_option( 'elementor_page_title_selector', '.sc_layouts_title_caption' );
			// Set flag to prevent change Elementor's options again
			update_option( 'heaven11_setup_elementor_options', 1 );
		}
	}
}


// Modify Elementor's options after the Theme Options saved
if ( ! function_exists( 'heaven11_elm_just_save_options' ) ) {
	
	function heaven11_elm_just_save_options( $values ) {
		$w = ! empty( $values['page_width'] )
			? $values['page_width']
			: heaven11_get_theme_option_std( 'page_width', heaven11_storage_get_array( 'options', 'page_width', 'std' ) );
		if ( ! empty( $w ) ) {
			// Theme-specific width + 2 * paddings of the columns
			update_option( 'elementor_container_width', $w + 2 * HEAVEN11_ELEMENTOR_PADDINGS );
		}
	}
}


// Save General Options via AJAX from Elementor Editor
// (called when any option is changed)
if ( ! function_exists( 'heaven11_elm_general_options_save' ) ) {
	
	
	function heaven11_elm_general_options_save( $response_data, $post_id, $data ) {
		if ( ! empty( $data['elementor_container_width'] ) && heaven11_get_theme_option( 'page_width' ) + 2 * HEAVEN11_ELEMENTOR_PADDINGS != $data['elementor_container_width'] ) {
			set_theme_mod( 'page_width', $data['elementor_container_width'] - 2 * HEAVEN11_ELEMENTOR_PADDINGS );   // Elementor width - paddings of the columns
		}
		return $response_data;
	}
}


// Add theme-specific controls to sections and columns
if ( ! function_exists( 'heaven11_elm_add_color_scheme_control' ) ) {
	
	function heaven11_elm_add_color_scheme_control( $element, $section_id, $args ) {
		if ( is_object( $element ) ) {
			$el_name = $element->get_name();
			// Add color scheme selector
			if ( apply_filters(
				'heaven11_filter_add_scheme_in_elements',
				( in_array( $el_name, array( 'section', 'column' ) ) && 'section_advanced' === $section_id )
							|| ( 'common' === $el_name && '_section_style' === $section_id ),
				$element, $section_id, $args
			) ) {
				$element->add_control(
					'scheme_heading',
					array(
						'label' => __( 'Theme-specific params', 'heaven11' ),
						'type' => \Elementor\Controls_Manager::HEADING,
						'separator' => 'before',
					)
				);
				$element->add_control(
					'scheme', array(
						'type'         => \Elementor\Controls_Manager::SELECT,
						'label'        => esc_html__( 'Color scheme', 'heaven11' ),
						'label_block'  => false,
						'options'      => heaven11_array_merge( array( '' => esc_html__( 'Inherit', 'heaven11' ) ), heaven11_get_list_schemes() ),
						'default'      => '',
						'prefix_class' => 'scheme_',
					)
				);
			}
			// Add 'Override section width'
			if ( 'section' == $el_name && 'section_advanced' === $section_id ) {
				$element->add_control(
					'justify_columns', array(
						'type'         => \Elementor\Controls_Manager::SWITCHER,
						'label'        => esc_html__( 'Justify columns', 'heaven11' ),
						'label_block'  => false,
						'description'  => wp_kses_data( __( 'Stretch columns to align the left and right edges to the site content area', 'heaven11' ) ),
						'label_off'    => esc_html__( 'Off', 'heaven11' ),
						'label_on'     => esc_html__( 'On', 'heaven11' ),
						'return_value' => 'justified',
						'prefix_class' => 'elementor-section-',
					)
				);
			}
			// Add 'Color style'
			if ( in_array($el_name, array(
										'trx_sc_action',
										'trx_sc_blogger',
										'trx_sc_button',
										'trx_sc_cars',
										'trx_sc_courses',
										'trx_sc_content',
										'trx_sc_dishes',
										'trx_sc_events',
										'trx_sc_form',
										'trx_sc_icons',
										'trx_sc_googlemap',
										'trx_sc_yandexmap',
										'trx_sc_portfolio',
										'trx_sc_price',
										'trx_sc_promo',
										'trx_sc_properties',
										'trx_sc_services',
										'trx_sc_team',
										'trx_sc_testimonials',
										'trx_sc_title',
										'trx_widget_audio',
										'trx_widget_twitter'))
				&& in_array( $section_id, array( 'section_sc_button', 'section_sc_title', 'section_title_params' ) )
			) {
				$element->add_control(
					'color_style', array(
						'type'         => \Elementor\Controls_Manager::SELECT,
						'label'        => esc_html__( 'Color style', 'heaven11' ),
						'label_block'  => false,
						'options'      => heaven11_get_list_sc_color_styles(),
						'default'      => 'default',
					)
				);
			}
			// Set default gap between columns to 'Extended'
			if ( 'section' == $el_name && 'section_layout' === $section_id ) {
				$element->update_control(
					'gap', array(
						'default' => 'extended',
					)
				);
			}
		}
	}
}

// Move paddings from the .elementor-element-wrap to the .elementor-column-wrap to compatibility with the theme
if ( ! function_exists( 'heaven11_elm_move_paddings_to_column_wrap' ) ) {
	function heaven11_elm_move_paddings_to_column_wrap( $element, $section_id, $args ) {
		if ( is_object( $element ) ) {
			$el_name = $element->get_name();
			if ( 'column' == $el_name && 'section_advanced' == $section_id ) {
				$element->update_responsive_control( 'padding', array(
											'selectors' => array(
												'{{WRAPPER}} > .elementor-element-populated.elementor-column-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',	// Elm 2.9- (or DOM Optimization == Inactive)
												'{{WRAPPER}} > .elementor-element-populated.elementor-widget-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',	// Elm 3.0+
											)
										) );
			}
		}
	}
}


// Return url with post edit link
if ( ! function_exists( 'heaven11_elm_post_edit_link' ) ) {
	
	function heaven11_elm_post_edit_link( $link, $post_id ) {
		if ( heaven11_is_built_with_elementor( $post_id ) ) {
			$link = str_replace( 'action=edit', 'action=elementor', $link );
		}
		return $link;
	}
}



// Add tab with theme-specific Page Options to the Page Settings
//---------------------------------------------------------------
if ( ! function_exists( 'heaven11_elm_add_page_options' ) ) {
	
	function heaven11_elm_add_page_options( $element, $section_id, $args ) {
		if ( is_object( $element ) ) {
			$el_name = $element->get_name();
			if ( in_array( $el_name, array( 'page-settings', 'post', 'wp-post', 'wp-page' ) ) && 'section_page_style' == $section_id ) {
				$post_id   = get_the_ID();
				$post_type = get_post_type( $post_id );
				if ( $post_id > 0 && heaven11_options_allow_override( $post_type ) ) {
					// Load saved options
					$meta     = get_post_meta( $post_id, 'heaven11_options', true );
					$sections = array();
					global $HEAVEN11_STORAGE;
					// Refresh linked data if this field is controller for the another (linked) field
					// Do this before show fields to refresh data in the $HEAVEN11_STORAGE
					foreach ( $HEAVEN11_STORAGE['options'] as $k => $v ) {
						if ( ! isset( $v['override'] ) || strpos( $v['override']['mode'], $post_type ) === false ) {
							continue;
						}
						if ( ! empty( $v['linked'] ) ) {
							$v['val'] = isset( $meta[ $k ] ) ? $meta[ $k ] : 'inherit';
							if ( ! empty( $v['val'] ) && ! heaven11_is_inherit( $v['val'] ) ) {
								heaven11_refresh_linked_data( $v['val'], $v['linked'] );
							}
						}
					}
					// Collect fields to the tabs
					foreach ( $HEAVEN11_STORAGE['options'] as $k => $v ) {
						if ( ! isset( $v['override'] ) || strpos( $v['override']['mode'], $post_type ) === false || 'hidden' == $v['type'] ) {
							continue;
						}
						$sec = empty( $v['override']['section'] ) ? esc_html__( 'General', 'heaven11' ) : $v['override']['section'];
						if ( ! isset( $sections[ $sec ] ) ) {
							$sections[ $sec ] = array();
						}
						$v['val']               = isset( $meta[ $k ] ) ? $meta[ $k ] : 'inherit';
						$sections[ $sec ][ $k ] = $v;
					}
					if ( count( $sections ) > 0 ) {
						$cnt = 0;
						foreach ( $sections as $sec => $v ) {
							$cnt++;
							$element->start_controls_section(
								"section_theme_options_{$cnt}",
								array(
									'label' => $sec,
									'tab'   => \Elementor\Controls_Manager::TAB_ADVANCED,
								)
							);
							foreach ( $v as $field_id => $params ) {
								heaven11_elm_add_page_options_field( $element, $field_id, $params );
							}
							$element->end_controls_section();
						}
					}
				}
			}
		}
	}
}


// Add control for the specified field
if ( ! function_exists( 'heaven11_elm_add_page_options_field' ) ) {
	function heaven11_elm_add_page_options_field( $element, $id, $field ) {
		$id_field    = "heaven11_options_field_{$id}";
		$id_override = "heaven11_options_override_{$id}";
		// If fields is inherit
		$inherit_state = isset( $field['val'] ) && heaven11_is_inherit( $field['val'] );
		// Condition
		$condition = array();
		if ( ! empty( $field['dependency'] ) ) {
			foreach ( $field['dependency'] as $k => $v ) {
				$key = substr( $k, 0, 1 ) == '#'
							? str_replace( array( '#page_template', '#' ), array( 'template', '' ), $k )
							: "heaven11_options_field_{$k}";
				if ( is_array( $v ) ) {
					if ( is_string($v[0]) && '^' == $v[0][0] ) {
						$v[0] = substr( $v[0], 1);
						$key .= '!';
					}					
				} else {
					if ( is_string($v) && '^' == $v[0] ) {
						$v = substr( $v, 1);
						$key .= '!';
					}
				}
				$condition[ $key ] = $v;
			}
		}
		// Inherit param
		$element->add_control(
			$id_override, array(
				'label'        => $field['title'],
				'label_block'  => in_array( $field['type'], array( 'media' ) ),
				'description'  => ! empty( $field['override']['desc'] ) ? $field['override']['desc'] : '', //( ! empty( $field['desc'] ) ? $field['desc'] : '' ),
				'separator'    => 'before',
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_off'    => esc_html__( 'Inherit', 'heaven11' ),
				'label_on'     => esc_html__( 'Override', 'heaven11' ),
				'return_value' => '1',
				'condition'    => $condition,
			)
		);

		// Field params
		$params = array(
			'label'       => esc_html__( 'New value', 'heaven11' ),
			'label_block' => in_array( $field['type'], array( 'media', 'info' ) ),
			'description' => ! empty( $field['desc'] ) ? $field['desc'] : '',
		);
		// Add dependency to params
		$condition[ $id_override ] = '1';
		$params['condition']       = $condition;
		// Type 'checkbox'
		if ( 'checkbox' == $field['type'] ) {
			$params = array_merge(
				$params, array(
					'type'         => \Elementor\Controls_Manager::SWITCHER,
					'label_off'    => esc_html__( 'Off', 'heaven11' ),
					'label_on'     => esc_html__( 'On', 'heaven11' ),
					'return_value' => '1',
				)
			);
			$element->add_control( $id_field, $params );

			// Type 'switch' (2 choises) or 'radio' (3+ choises) or 'select'
		} elseif ( in_array( $field['type'], array( 'switch', 'radio', 'select' ) ) ) {
			$field['options'] = apply_filters( 'heaven11_filter_options_get_list_choises', $field['options'], $id );
			$params           = array_merge(
				$params, array(
					'type'    => \Elementor\Controls_Manager::SELECT,
					'options' => $field['options'],
				)
			);
			$element->add_control( $id_field, $params );

			// Type 'checklist', 'select2' and 'icon'
		} elseif ( in_array( $field['type'], array( 'checklist', 'select2', 'icon' ) ) ) {
			$field['options'] = apply_filters( 'heaven11_filter_options_get_list_choises', $field['options'], $id );
			$params           = array_merge(
				$params, array(
					'type'     => \Elementor\Controls_Manager::SELECT2,
					'options'  => $field['options'],
					'multiple' => 'checklist' == $field['type'] || ! empty( $field['multiple'] ),
				)
			);
			$element->add_control( $id_field, $params );

			// Type 'text' or 'time'
		} elseif ( in_array( $field['type'], array( 'text', 'time' ) ) ) {
			$params = array_merge(
				$params, array(
					'type' => \Elementor\Controls_Manager::TEXT,
				)
			);
			$element->add_control( $id_field, $params );

			// Type 'date'
		} elseif ( 'date' == $field['type'] ) {
			$params = array_merge(
				$params, array(
					'type' => \Elementor\Controls_Manager::DATE_TIME,
				)
			);
			$element->add_control( $id_field, $params );

			// Type 'textarea'
		} elseif ( 'textarea' == $field['type'] ) {
			$params = array_merge(
				$params, array(
					'type' => \Elementor\Controls_Manager::TEXTAREA,
					'rows' => ! empty( $field['rows'] ) ? max( 1, $field['rows'] ) : 5,
				)
			);
			$element->add_control( $id_field, $params );

			// Type 'text_editor'
		} elseif ( 'text_editor' == $field['type'] ) {
			$params = array_merge(
				$params, array(
					'type' => \Elementor\Controls_Manager::WYSIWYG,
				)
			);
			$element->add_control( $id_field, $params );

			// Type 'media'
		} elseif ( in_array( $field['type'], array( 'image', 'media', 'video', 'audio' ) ) ) {
			$params = array_merge(
				$params, array(
					'type'    => \Elementor\Controls_Manager::MEDIA,
					'default' => array(
						'id'  => ! empty( $field['val'] ) && ! heaven11_is_inherit( $field['val'] ) ? attachment_url_to_postid( heaven11_clear_thumb_size( $field['val'] ) ) : 0,
						'url' => ! empty( $field['val'] ) && ! heaven11_is_inherit( $field['val'] ) ? $field['val'] : '',
					),
				)
			);
			$element->add_control( $id_field, $params );

			// Type 'color'
		} elseif ( 'color' == $field['type'] ) {
			$params = array_merge(
				$params, array(
					'type'   => \Elementor\Controls_Manager::COLOR,
					'scheme' => array(
						'type'  => \Elementor\Core\Schemes\Color::get_type(),
						'value' => \Elementor\Core\Schemes\Color::COLOR_1,
					),
				)
			);
			$element->add_control( $id_field, $params );

			// Type 'slider' or 'range'
		} elseif ( in_array( $field['type'], array( 'slider', 'range' ) ) ) {
			$params = array_merge(
				$params, array(
					'type'    => \Elementor\Controls_Manager::SLIDER,
					'default' => array(
						'size' => ! empty( $field['val'] ) && ! heaven11_is_inherit( $field['val'] ) ? $field['val'] : '',
						'unit' => 'px',
					),
					'range'   => array(
						'px' => array(
							'min' => ! empty( $field['min'] ) ? $field['min'] : 0,
							'max' => ! empty( $field['max'] ) ? $field['max'] : 1000,
						),
					),
				)
			);
			$element->add_control( $id_field, $params );

		}
	}
}


// Save Page Options via AJAX from Elementor Editor
// (called when any option is changed)
if ( ! function_exists( 'heaven11_elm_page_options_save' ) ) {
	
	
	function heaven11_elm_page_options_save( $response_data, $post_id, $data ) {
		if ( $post_id > 0 && is_array( $data ) ) {
			$options = heaven11_storage_get( 'options' );
			$meta    = get_post_meta( $post_id, 'heaven11_options', true );
			if ( empty( $meta ) ) {
				$meta = array();
			}
			foreach ( $options as $k => $v ) {
				$id_field    = "heaven11_options_field_{$k}";
				$id_override = "heaven11_options_override_{$k}";
				if ( isset( $data[ $id_override ] ) ) {
					$meta[ $k ] = isset( $data[ $id_field ] )
									? ( is_array( $data[ $id_field ] ) && isset( $data[ $id_field ]['url'] )
											? $data[ $id_field ]['url']
											: $data[ $id_field ]
											)
									: ( ! empty( $meta[ $k ] ) && ! heaven11_is_inherit( $meta[ $k ] )
											? $meta[ $k ]
											: $v['std']
											);
				} elseif ( isset( $meta[ $k ] ) ) {
					unset( $meta[ $k ] );
				}
			}
			update_post_meta( $post_id, 'heaven11_options', apply_filters( 'heaven11_filter_update_post_options', $meta, $post_id ) );

			// Save separate meta options to search template pages
			if ( 'page' == get_post_type( $post_id ) && ! empty( $data['template'] ) && 'blog.php' == $data['template'] ) {
				update_post_meta( $post_id, 'heaven11_options_post_type', isset( $meta['post_type'] ) ? $meta['post_type'] : 'post' );
				update_post_meta( $post_id, 'heaven11_options_parent_cat', isset( $meta['parent_cat'] ) ? $meta['parent_cat'] : 0 );
			}
		}
		return $response_data;
	}
}


// Save Page Options via AJAX from Elementor Editor
// (called when any option is changed)
if ( ! function_exists( 'heaven11_elm_page_options_save_document' ) ) {
	
	function heaven11_elm_page_options_save_document( $response_data, $document ) {
		$post_id = $document->get_main_id();
		if ( $post_id > 0 ) {
			$actions = json_decode( heaven11_get_value_gp( 'actions' ), true );
			if ( is_array( $actions ) && isset( $actions['save_builder']['data']['settings'] ) && is_array( $actions['save_builder']['data']['settings'] ) ) {
				$settings = $actions['save_builder']['data']['settings'];
				if ( is_array( $settings ) ) {
					heaven11_elm_page_options_save( '', $post_id, $actions['save_builder']['data']['settings'] );
				}
			}
		}
		return $response_data;
	}
}


// Save Page Options when page is updated (saved) from WordPress Editor
if ( ! function_exists( 'heaven11_elm_update_post_options' ) ) {
	
	function heaven11_elm_update_post_options( $meta, $post_id ) {
		if ( doing_filter( 'save_post' ) ) {
			$elm_meta = get_post_meta( $post_id, '_elementor_page_settings', true );
			if ( is_array( $elm_meta ) ) {
				foreach ( $elm_meta as $k => $v ) {
					if ( strpos( $k, 'heaven11_options_' ) !== false ) {
						unset( $elm_meta[ $k ] );
					}
				}
			} else {
				$elm_meta = array();
			}
			$options = heaven11_storage_get( 'options' );
			foreach ( $meta as $k => $v ) {
				$elm_meta[ "heaven11_options_field_{$k}" ]    = in_array( $options[ $k ]['type'], array( 'image', 'video', 'audio', 'media' ) )
																? array(
																	'id' => attachment_url_to_postid( heaven11_clear_thumb_size( $v ) ),
																	'url' => $v,
																)
																: $v;
				$elm_meta[ "heaven11_options_override_{$k}" ] = '1';
			}
			update_post_meta( $post_id, '_elementor_page_settings', apply_filters( 'heaven11_filter_elementor_update_page_settings', $elm_meta, $post_id ) );
		}
		return $meta;
	}
}


// Add plugin-specific colors and fonts to the custom CSS
if ( heaven11_exists_elementor() ) {
	require_once HEAVEN11_THEME_DIR . 'plugins/elementor/elementor-styles.php';
}
