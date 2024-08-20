<?php
/**
 * Override Theme Options on a posts and pages
 *
 * @package WordPress
 * @subpackage HEAVEN11
 * @since HEAVEN11 1.0.29
 */


// -----------------------------------------------------------------
// -- Override Theme Options
// -----------------------------------------------------------------

if ( ! function_exists( 'heaven11_options_override_init' ) ) {
	add_action( 'after_setup_theme', 'heaven11_options_override_init' );
	function heaven11_options_override_init() {
		if ( is_admin() ) {
			add_action( 'admin_enqueue_scripts', 'heaven11_options_override_add_scripts' );
			add_action( 'save_post', 'heaven11_options_override_save_options' );
			add_filter( 'heaven11_filter_override_options', 'heaven11_options_override_add_options' );
		}
	}
}


// Check if override options is allowed for specified post type
if ( ! function_exists( 'heaven11_options_allow_override' ) ) {
	function heaven11_options_allow_override( $post_type ) {
		return apply_filters( 'heaven11_filter_allow_override_options', in_array( $post_type, array( 'page', 'post' ) ), $post_type );
	}
}

// Load required styles and scripts for admin mode
if ( ! function_exists( 'heaven11_options_override_add_scripts' ) ) {
	
	function heaven11_options_override_add_scripts() {
		// If current screen is 'Edit Page' - load font icons
		$screen = function_exists( 'get_current_screen' ) ? get_current_screen() : false;
		if ( is_object( $screen ) && heaven11_options_allow_override( ! empty( $screen->post_type ) ? $screen->post_type : $screen->id ) ) {
			wp_enqueue_style( 'heaven11-icons', heaven11_get_file_url( 'css/font-icons/css/fontello-embedded.css' ), array(), null );
			wp_enqueue_script( 'jquery-ui-tabs', false, array( 'jquery', 'jquery-ui-core' ), null, true );
			wp_enqueue_script( 'jquery-ui-accordion', false, array( 'jquery', 'jquery-ui-core' ), null, true );
			wp_enqueue_script( 'heaven11-options', heaven11_get_file_url( 'theme-options/theme-options.js' ), array( 'jquery' ), null, true );
			wp_localize_script( 'heaven11-options', 'heaven11_dependencies', heaven11_get_theme_dependencies() );
		}
	}
}

// Add overriden options
if ( ! function_exists( 'heaven11_options_override_add_options' ) ) {
	
	function heaven11_options_override_add_options( $list ) {
		global $post_type;
		if ( heaven11_options_allow_override( $post_type ) ) {
			$list[] = array(
				sprintf( 'heaven11_override_options_%s', $post_type ),
				esc_html__( 'Theme Options', 'heaven11' ),
				'heaven11_options_override_show',
				$post_type,
				'post' == $post_type ? 'side' : 'advanced',
				'default',
			);
		}
		return $list;
	}
}

// Callback function to show override options
if ( ! function_exists( 'heaven11_options_override_show' ) ) {
	function heaven11_options_override_show( $post = false, $args = false ) {
		if ( empty( $post ) || ! is_object( $post ) || empty( $post->ID ) ) {
			global $post, $post_type;
			$mb_post_id   = $post->ID;
			$mb_post_type = $post_type;
		} else {
			$mb_post_id   = $post->ID;
			$mb_post_type = $post->post_type;
		}
		if ( heaven11_options_allow_override( $mb_post_type ) ) {
			// Load saved options
			$meta         = get_post_meta( $mb_post_id, 'heaven11_options', true );
			$tabs_titles  = array();
			$tabs_content = array();
			global $HEAVEN11_STORAGE;
			// Refresh linked data if this field is controller for the another (linked) field
			// Do this before show fields to refresh data in the $HEAVEN11_STORAGE
			foreach ( $HEAVEN11_STORAGE['options'] as $k => $v ) {
				if ( ! isset( $v['override'] ) || strpos( $v['override']['mode'], $mb_post_type ) === false ) {
					continue;
				}
				if ( ! empty( $v['linked'] ) ) {
					$v['val'] = isset( $meta[ $k ] ) ? $meta[ $k ] : 'inherit';
					if ( ! empty( $v['val'] ) && ! heaven11_is_inherit( $v['val'] ) ) {
						heaven11_refresh_linked_data( $v['val'], $v['linked'] );
					}
				}
			}
			// Show fields
			foreach ( $HEAVEN11_STORAGE['options'] as $k => $v ) {
				if ( ! isset( $v['override'] ) || strpos( $v['override']['mode'], $mb_post_type ) === false || 'hidden' == $v['type'] ) {
					continue;
				}
				if ( empty( $v['override']['section'] ) ) {
					$v['override']['section'] = esc_html__( 'General', 'heaven11' );
				}
				if ( ! isset( $tabs_titles[ $v['override']['section'] ] ) ) {
					$tabs_titles[ $v['override']['section'] ]  = $v['override']['section'];
					$tabs_content[ $v['override']['section'] ] = '';
				}
				$v['val']                                   = isset( $meta[ $k ] ) ? $meta[ $k ] : 'inherit';
				$tabs_content[ $v['override']['section'] ] .= heaven11_options_show_field( $k, $v, $mb_post_type );
			}
			if ( count( $tabs_titles ) > 0 ) {
				?>
				<div class="heaven11_options heaven11_options_override">
					<input type="hidden" name="override_options_nonce" value="<?php echo esc_attr( wp_create_nonce( admin_url() ) ); ?>" />
					<input type="hidden" name="override_options_post_type" value="<?php echo esc_attr( $mb_post_type ); ?>" />
					<div id="heaven11_options_tabs" class="heaven11_tabs">
						<ul>
							<?php
							$cnt = 0;
							foreach ( $tabs_titles as $k => $v ) {
								$cnt++;
								?>
								<li><a href="#heaven11_options_<?php echo esc_attr( $cnt ); ?>"><?php echo esc_html( $v ); ?></a></li>
								<?php
							}
							?>
						</ul>
						<?php
						$cnt = 0;
						foreach ( $tabs_content as $k => $v ) {
							$cnt++;
							?>
							<div id="heaven11_options_<?php echo esc_attr( $cnt ); ?>" class="heaven11_tabs_section heaven11_options_section">
								<?php heaven11_show_layout( $v ); ?>
							</div>
							<?php
						}
						?>
					</div>
				</div>
				<?php
			}
		}
	}
}


// Save overriden options
if ( ! function_exists( 'heaven11_options_override_save_options' ) ) {
	
	function heaven11_options_override_save_options( $post_id ) {
		// verify nonce
		if ( ! wp_verify_nonce( heaven11_get_value_gp( 'override_options_nonce' ), admin_url() ) ) {
			return $post_id;
		}

		// check autosave
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $post_id;
		}

		$post_type = wp_kses_data( wp_unslash( isset( $_POST['override_options_post_type'] ) ? $_POST['override_options_post_type'] : $_POST['post_type'] ) );

		// check permissions
		$capability = 'page';
		$post_types = get_post_types( array( 'name' => $post_type ), 'objects' );
		if ( ! empty( $post_types ) && is_array( $post_types ) ) {
			foreach ( $post_types  as $type ) {
				$capability = $type->capability_type;
				break;
			}
		}
		if ( ! current_user_can( 'edit_' . ( $capability ), $post_id ) ) {
			return $post_id;
		}

		// Save options
		$meta    = array();
		$options = heaven11_storage_get( 'options' );
		foreach ( $options as $k => $v ) {
			// Skip not overriden options
			if ( ! isset( $v['override'] ) || strpos( $v['override']['mode'], $post_type ) === false ) {
				continue;
			}
			// Skip inherited options
			if ( ! empty( $_POST[ "heaven11_options_inherit_{$k}" ] ) ) {
				continue;
			}
			// Skip hidden options
			if ( ! isset( $_POST[ "heaven11_options_field_{$k}" ] ) && 'hidden' == $v['type'] ) {
				continue;
			}
			// Get option value from POST
			$meta[ $k ] = isset( $_POST[ "heaven11_options_field_{$k}" ] )
							? heaven11_get_value_gp( "heaven11_options_field_{$k}" )
							: ( 'checkbox' == $v['type'] ? 0 : '' );
		}
		$meta = apply_filters( 'heaven11_filter_update_post_options', $meta, $post_id );

		update_post_meta( $post_id, 'heaven11_options', $meta );

		// Save separate meta options to search template pages
		if ( 'page' == $post_type && ! empty( $_POST['page_template'] ) && 'blog.php' == $_POST['page_template'] ) {
			update_post_meta( $post_id, 'heaven11_options_post_type', isset( $meta['post_type'] ) ? $meta['post_type'] : 'post' );
			update_post_meta( $post_id, 'heaven11_options_parent_cat', isset( $meta['parent_cat'] ) ? $meta['parent_cat'] : 0 );
		}
	}
}
