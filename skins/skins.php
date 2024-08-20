<?php
/**
 * Skins support
 *
 * @package WordPress
 * @subpackage HEAVEN11
 * @since HEAVEN11 1.0.46
 */

if ( ! defined( 'HEAVEN11_SKIN_NAME' ) ) {
	define( 'HEAVEN11_SKIN_NAME', get_option( sprintf( 'theme_skin_%s', get_option( 'stylesheet' ) ), HEAVEN11_DEFAULT_SKIN ) );
}
if ( ! defined( 'HEAVEN11_SKIN_DIR' ) ) {
	define( 'HEAVEN11_SKIN_DIR', 'skins/' . trailingslashit( HEAVEN11_SKIN_NAME ) );
}

// Theme init priorities:
// Action 'after_setup_theme'
// 1 - register filters to add/remove lists items in the Theme Options
if ( ! function_exists( 'heaven11_skins_theme_setup1' ) ) {
	add_action( 'after_setup_theme', 'heaven11_skins_theme_setup1', 1 );
	function heaven11_skins_theme_setup1() {
		heaven11_storage_set(
			'skins', apply_filters(
				'heaven11_filter_skins_list', array(
					'default' => array(
						'title'       => esc_html__( 'Default', 'heaven11' ),
						'description' => '',
						'image'       => 'skin.jpg',
						'demo_url'    => '//heaven11.axiomthemes.com/',
					),
					'building' => array(
						'title'       => esc_html__( 'Building', 'heaven11' ),
						'description' => '',
						'image'       => 'skin.jpg',
						'demo_url'    => '//building.heaven11.axiomthemes.com/',
					),
					'properties' => array(
						'title'       => esc_html__( 'Properties', 'heaven11' ),
						'description' => '',
						'image'       => 'skin.jpg',
						'demo_url'    => '//properties.heaven11.axiomthemes.com/',
					),
				)
			)
		);
	}
}



// Add skins folder to the theme-specific file search
//------------------------------------------------------------

// Check if file exists in the skin folder and return its path or empty string if file is not found
if ( ! function_exists( 'heaven11_skins_get_file_dir' ) ) {
	function heaven11_skins_get_file_dir( $file, $skin = HEAVEN11_SKIN_NAME, $return_url = false ) {
		$dir      = '';
		if ( HEAVEN11_ALLOW_SKINS ) {
			$skin_dir = 'skins/' . trailingslashit( $skin );
			if ( HEAVEN11_CHILD_DIR != HEAVEN11_THEME_DIR && file_exists( HEAVEN11_CHILD_DIR . ( $skin_dir ) . ( $file ) ) ) {
				$dir = ( $return_url ? HEAVEN11_CHILD_URL : HEAVEN11_CHILD_DIR ) . ( $skin_dir ) . heaven11_check_min_file( $file, HEAVEN11_CHILD_DIR . ( $skin_dir ) );
			} elseif ( file_exists( HEAVEN11_THEME_DIR . ( $skin_dir ) . ( $file ) ) ) {
				$dir = ( $return_url ? HEAVEN11_THEME_URL : HEAVEN11_THEME_DIR ) . ( $skin_dir ) . heaven11_check_min_file( $file, HEAVEN11_THEME_DIR . ( $skin_dir ) );
			}
		}
		return $dir;
	}
}

// Check if file exists in the skin folder and return its url or empty string if file is not found
if ( ! function_exists( 'heaven11_skins_get_file_url' ) ) {
	function heaven11_skins_get_file_url( $file, $skin = HEAVEN11_SKIN_NAME ) {
		return heaven11_skins_get_file_dir( $file, $skin, true );
	}
}


// Add skins folder to the theme-specific files search
if ( ! function_exists( 'heaven11_skins_get_theme_file_dir' ) ) {
	add_filter( 'heaven11_filter_get_theme_file_dir', 'heaven11_skins_get_theme_file_dir', 10, 3 );
	function heaven11_skins_get_theme_file_dir( $dir, $file, $return_url = false ) {
		return heaven11_skins_get_file_dir( $file, HEAVEN11_SKIN_NAME, $return_url );
	}
}


// Check if folder exists in the current skin folder and return its path or empty string if the folder is not found
if ( ! function_exists( 'heaven11_skins_get_folder_dir' ) ) {
	function heaven11_skins_get_theme_folder_dir( $folder, $skin = HEAVEN11_SKIN_NAME, $return_url = false ) {
		$dir      = '';
		if ( HEAVEN11_ALLOW_SKINS ) {
			$skin_dir = 'skins/' . trailingslashit( $skin );
			if ( HEAVEN11_CHILD_DIR != HEAVEN11_THEME_DIR && is_dir( HEAVEN11_CHILD_DIR . ( $skin_dir ) . ( $folder ) ) ) {
				$dir = ( $return_url ? HEAVEN11_CHILD_URL : HEAVEN11_CHILD_DIR ) . ( $skin_dir ) . ( $folder );
			} elseif ( is_dir( HEAVEN11_THEME_DIR . ( $skin_dir ) . ( $folder ) ) ) {
				$dir = ( $return_url ? HEAVEN11_THEME_URL : HEAVEN11_THEME_DIR ) . ( $skin_dir ) . ( $folder );
			}
		}
		return $dir;
	}
}

// Check if folder exists in the skin folder and return its url or empty string if folder is not found
if ( ! function_exists( 'heaven11_skins_get_folder_url' ) ) {
	function heaven11_skins_get_folder_url( $folder, $skin = HEAVEN11_SKIN_NAME ) {
		return heaven11_skins_get_folder_dir( $folder, $skin, true );
	}
}

// Add skins folder to the theme-specific folders search
if ( ! function_exists( 'heaven11_skins_get_theme_folder_dir' ) ) {
	add_filter( 'heaven11_filter_get_theme_folder_dir', 'heaven11_skins_get_theme_folder_dir', 10, 3 );
	function heaven11_skins_get_theme_folder_dir( $dir, $folder, $return_url = false ) {
		return heaven11_skins_get_folder_dir( $folder, HEAVEN11_SKIN_NAME, $return_url );
	}
}


// Add skins folder to the get_template_part
if ( ! function_exists( 'heaven11_skins_get_template_part' ) ) {
	add_filter( 'heaven11_filter_get_template_part', 'heaven11_skins_get_template_part', 10, 2 );
	function heaven11_skins_get_template_part( $slug, $part = '' ) {
		if ( ! empty( $part ) ) {
			$part = "-{$part}";
		}
		if ( heaven11_skins_get_file_dir( "{$slug}{$part}.php" ) != '' ) {
			$slug = sprintf( 'skins/%s/%s', HEAVEN11_SKIN_NAME, $slug );
		}
		return $slug;
	}
}



// Add tab with skins to the 'Theme Panel'
//------------------------------------------------------

// Add step 'Skins'
if ( ! function_exists( 'heaven11_skins_theme_panel_steps' ) ) {
	add_filter( 'trx_addons_filter_theme_panel_steps', 'heaven11_skins_theme_panel_steps' );
	function heaven11_skins_theme_panel_steps( $steps ) {
		if ( HEAVEN11_ALLOW_SKINS ) {
			$steps = heaven11_array_merge( array( 'skins' => wp_kses_data( __( 'Select a skin for your website.', 'heaven11' ) ) ), $steps );
		}
		return $steps;
	}
}

// Add tab link 'Skins'
if ( ! function_exists( 'heaven11_skins_theme_panel_tabs' ) ) {
	add_filter( 'trx_addons_filter_theme_panel_tabs', 'heaven11_skins_theme_panel_tabs' );
	function heaven11_skins_theme_panel_tabs( $tabs ) {
		if ( HEAVEN11_ALLOW_SKINS ) {
			heaven11_array_insert_after( $tabs, 'general', array( 'skins' => esc_html__( 'Skins', 'heaven11' ) ) );
		}
		return $tabs;
	}
}


// Display 'Skins' section in the Theme Panel
if ( ! function_exists( 'heaven11_skins_theme_panel_section' ) ) {
	add_action( 'trx_addons_action_theme_panel_section', 'heaven11_skins_theme_panel_section', 10, 2);
	function heaven11_skins_theme_panel_section( $tab_id, $theme_info ) {
		if ( 'skins' !== $tab_id ) return;
		?>
		<div id="trx_addons_theme_panel_section_<?php echo esc_attr($tab_id); ?>" class="trx_addons_tabs_section">

			<?php
			do_action('trx_addons_action_theme_panel_section_start', $tab_id, $theme_info);

			if ( trx_addons_is_theme_activated() ) {
				?>
				<div class="trx_addons_theme_panel_skins_selector">

					<?php do_action('trx_addons_action_theme_panel_before_section_title', $tab_id, $theme_info); ?>
		
					<h1 class="trx_addons_theme_panel_section_title">
						<?php esc_html_e( 'Skins', 'heaven11' ); ?>
					</h1>

					<?php do_action('trx_addons_action_theme_panel_after_section_title', $tab_id, $theme_info); ?>

					<div class="trx_addons_theme_panel_section_info">
						<p><?php echo wp_kses_data( __( 'Choose a skin for your website. Depending on which skin is selected, the list of plugins and demo data may change.', 'heaven11' ) ); ?></p>
						<p><?php echo wp_kses_data( __( '<b>Attention!</b> Each skin is customized individually and has its own options. You will be able to change the skin later, but you will have to re-configure it.', 'heaven11' ) ); ?></p>
					</div>

					<?php do_action('trx_addons_action_theme_panel_before_list_items', $tab_id, $theme_info); ?>
					
					<div class="trx_addons_theme_panel_skins_list">
						<?php
						$skins = heaven11_storage_get( 'skins' );
						foreach ( $skins as $skin => $data ) {
							
							?><div class="trx_addons_image_block">
								<div class="trx_addons_image_block_inner
								 	<?php 
									// Skin image
									$img = heaven11_skins_get_file_url( $data['image'], $skin );
									if ( '' != $img ) {
										echo heaven11_add_inline_css_class( 'background-image: url(' . esc_url( $img ) . ');' );
									}				 	
								 	?>">
								 	<?php
									// Link to choose skin
									if ( HEAVEN11_SKIN_NAME == $skin ) {
										?>
										<span class="trx_addons_image_block_link button button-action trx_addons_image_block_link_active">
											<?php
											esc_html_e( 'Active skin', 'heaven11' );
											?>
										</span>
										<?php
									} else {
										?>
										<a href="#"
											class="trx_addons_image_block_link trx_addons_image_block_link_choose_skin button button-primary"
											data-skin="<?php echo esc_attr( $skin ); ?>">
												<?php
												esc_html_e( 'Choose skin', 'heaven11' );
												?>
										</a>
										<?php
									}
									// Link to demo site
									if ( ! empty( $data['demo_url'] ) ) {
										?>
										<a href="<?php echo esc_url( $data['demo_url'] ); ?>" class="trx_addons_image_block_link trx_addons_image_block_link_view_demo button" target="_blank">
											<?php
											esc_html_e( 'View demo', 'heaven11' );
											?>
										</a>
										<?php
									}
									?>
							 	</div>
								<?php
								// Skin title
								if ( ! empty( $data['title'] ) ) {
									?>
									<h3 class="trx_addons_image_block_title">
										<i class="dashicons dashicons-admin-appearance"></i>
										<?php echo esc_html( $data['title'] ); ?>
									</h3>
									<?php
								}
								// Skin description
								if ( ! empty( $data['description'] ) ) {
									?>
									<div class="trx_addons_image_block_description">
										<?php
										echo wp_kses(( $data['description'] ), 'heaven11_kses_content');
										?>
									</div>
									<?php
								}
								?>
							</div><?php // No spaces allowed after this <div>, because it is an inline-block element
						}
						?>
					</div>

					<?php do_action('trx_addons_action_theme_panel_after_list_items', $tab_id, $theme_info); ?>

				</div>
				<?php
				do_action('trx_addons_action_theme_panel_after_section_data', $tab_id, $theme_info);
			} else {
				?>
				<div class="error"><p>
					<?php esc_html_e( 'Activate your theme in order to be able to change skins.', 'heaven11' ); ?>
				</p></div>
				<?php
			}

			do_action('trx_addons_action_theme_panel_section_end', $tab_id, $theme_info);
			?>
		</div>
		<?php
	}
}


// Load page-specific scripts and styles
if ( ! function_exists( 'heaven11_skins_about_enqueue_scripts' ) ) {
	add_action( 'admin_enqueue_scripts', 'heaven11_skins_about_enqueue_scripts' );
	function heaven11_skins_about_enqueue_scripts() {
		$screen = function_exists( 'get_current_screen' ) ? get_current_screen() : false;
		if ( ! empty( $screen->id ) && false !== strpos($screen->id, '_page_trx_addons_theme_panel') ) {
			wp_enqueue_script( 'heaven11-skins-admin', heaven11_get_file_url( 'skins/skins-admin.js' ), array( 'jquery' ), null, true );
		}
	}
}

// Add page-specific vars to the localize array
if ( ! function_exists( 'heaven11_skins_localize_script' ) ) {
	add_filter( 'heaven11_filter_localize_script_admin', 'heaven11_skins_localize_script' );
	function heaven11_skins_localize_script( $arr ) {
		$arr['msg_switch_skin_caption'] = esc_html__( "Attention!", 'heaven11' );
		$arr['msg_switch_skin']         = apply_filters( 'heaven11_filter_msg_switch_skin',
			'<p>'
			. esc_html__( "Some skins require installation of additional plugins.", 'heaven11' )
			. '</p><p>'
			. esc_html__( "Also, after selecting a new skin, your theme settings will be changed.", 'heaven11' )
			. '</p>'
		);
		$arr['msg_switch_skin_success'] = esc_html__( 'A new skin is selected. The page will be reloaded.', 'heaven11' );
		$arr['msg_switch_skin_success_caption'] = esc_html__( 'Skin is changed!', 'heaven11' );
		return $arr;
	}
}

// AJAX handler for the 'heaven11_switch_skin' action
if ( ! function_exists( 'heaven11_skins_ajax_switch_skin' ) ) {
	add_action( 'wp_ajax_heaven11_switch_skin', 'heaven11_skins_ajax_switch_skin' );
	function heaven11_skins_ajax_switch_skin() {

		if ( ! wp_verify_nonce( heaven11_get_value_gp( 'nonce' ), admin_url( 'admin-ajax.php' ) ) ) {
			wp_die();
		}

		$response = array( 'error' => '' );

		$skin  = heaven11_get_value_gp( 'skin' );
		$skins = heaven11_storage_get( 'skins' );

		if ( empty( $skin ) || ! isset( $skins[ $skin ] ) ) {
			// Translators: Add the skin's name to the message
			$response['error'] = sprintf( __( 'Can not switch to the skin %s', 'heaven11' ), $skin );
		} elseif ( HEAVEN11_SKIN_NAME == $skin ) {
			// Translators: Add the skin's name to the message
			$response['error'] = sprintf( __( 'Skin %s is already active', 'heaven11' ), $skin );
		} else {
			// Get current theme slug
			$theme_slug = get_option( 'stylesheet' );
			// Get options from new skin
			$skin_mods = get_option( sprintf( 'theme_mods_%1$s_skin_%2$s', $theme_slug, $skin ), false );
			if ( ! $skin_mods ) {
				if ( file_exists( HEAVEN11_THEME_DIR . 'skins/skins-options.php' ) ) {
					require_once HEAVEN11_THEME_DIR . 'skins/skins-options.php';
					if ( isset( $skins_options[ $skin ] ) ) {
						$skin_mods = apply_filters('heaven11_filter_skin_options_restore_from_file',
							heaven11_unserialize( $skins_options[ $skin ]['options'] )
						);
					}
				}
			}
			if ( false !== $skin_mods ) {
				// Save current options
				update_option( sprintf( 'theme_mods_%1$s_skin_%2$s', $theme_slug, HEAVEN11_SKIN_NAME ), get_theme_mods() );
				// Replace theme mods with options from new skin
				heaven11_options_update( $skin_mods );
				// Replace current skin
				update_option( sprintf( 'theme_skin_%s', $theme_slug ), $skin );
			} else {
				$response['error'] = esc_html__( 'Options of the new skin are not found!', 'heaven11' );
			}
		}

		echo json_encode( $response );
		wp_die();
	}
}

// Remove all entries with media from restored options
if ( ! function_exists( 'heaven11_skins_options_restore_from_file' ) ) {
	add_filter( 'heaven11_filter_skin_options_restore_from_file', 'heaven11_skins_options_restore_from_file' );
	function heaven11_skins_options_restore_from_file( $mods ) {
		$options = heaven11_storage_get( 'options' );
		if ( is_array( $options ) ) {
			foreach( $options as $k => $v ) {
				if ( ! empty( $v['type'] ) && in_array( $v['type'], array( 'image', 'video', 'audio' ) ) && isset( $mods[ $k ] ) ) {
					unset( $mods[ $k ] );
				}
			}
		}
		return $mods;
	}
}


// One-click import support
//------------------------------------------------------------------------

// Export custom layouts
if ( ! function_exists( 'heaven11_skins_importer_export' ) ) {
	if ( is_admin() ) {
		add_action( 'trx_addons_action_importer_export', 'heaven11_skins_importer_export', 10, 1 );
	}
	function heaven11_skins_importer_export( $importer ) {
		$skins  = heaven11_storage_get( 'skins' );
		$output = '';
		if ( is_array( $skins ) && count( $skins ) > 0 ) {
			$output     = '<?php'
						. "\n//" . esc_html__( 'Skins', 'heaven11' )
						. "\n\$skins_options = array(";
			$counter    = 0;
			$theme_mods = get_theme_mods();
			$theme_slug = get_option( 'stylesheet' );
			foreach ( $skins as $skin => $skin_data ) {
				$options = get_option( sprintf( 'theme_mods_%1$s_skin_%2$s', $theme_slug, $skin ), false );
				if ( false === $options ) {
					$options = $theme_mods;
				}
				$output .= ( $counter++ ? ',' : '' )
						. "\n\t\t'{$skin}' => array("
						. "\n\t\t\t\t'options' => " . '"' . str_replace( array( "\r", "\n" ), array( '\r', '\n' ), addslashes( serialize( apply_filters( 'heaven11_filter_export_skin_options', $options, $skin ) ) ) ) . '"'
						. "\n\t\t\t\t)";
			}
			$output .= "\n\t\t);"
					. "\n?>";
		}
		heaven11_fpc( $importer->export_file_dir( 'skins.txt' ), $output );
	}
}

// Display exported data in the fields
if ( ! function_exists( 'heaven11_skins_importer_export_fields' ) ) {
	if ( is_admin() ) {
		add_action( 'trx_addons_action_importer_export_fields', 'heaven11_skins_importer_export_fields', 12, 1 );
	}
	function heaven11_skins_importer_export_fields( $importer ) {
		$importer->show_exporter_fields(
			array(
				'slug'     => 'skins',
				'title'    => esc_html__( 'Skins', 'heaven11' ),
				'download' => 'skins-options.php',
			)
		);
	}
}


// Load file with current skin
$heaven11_skin_file = heaven11_skins_get_file_dir( 'skin.php' );
if ( '' != $heaven11_skin_file ) {
	require_once $heaven11_skin_file;
}
