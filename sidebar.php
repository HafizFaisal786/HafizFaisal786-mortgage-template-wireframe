<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package WordPress
 * @subpackage HEAVEN11
 * @since HEAVEN11 1.0
 */

if ( heaven11_sidebar_present() ) {
	ob_start();
	$heaven11_sidebar_name = heaven11_get_theme_option( 'sidebar_widgets' . ( is_single() ? '_single' : '' ) );
	heaven11_storage_set( 'current_sidebar', 'sidebar' );
	if ( is_active_sidebar( $heaven11_sidebar_name ) ) {
		dynamic_sidebar( $heaven11_sidebar_name );
	}
	$heaven11_out = trim( ob_get_contents() );
	ob_end_clean();
	if ( ! empty( $heaven11_out ) ) {
		$heaven11_sidebar_position = heaven11_get_theme_option( 'sidebar_position' . ( is_single() ? '_single' : '' ) );
		$heaven11_sidebar_mobile   = heaven11_get_theme_option( 'sidebar_position_mobile' . ( is_single() ? '_single' : '' ) );
		?>
		<div class="sidebar widget_area
			<?php
			echo ' ' . esc_attr( $heaven11_sidebar_position );
			echo ' sidebar_' . esc_attr( $heaven11_sidebar_mobile );

			if ( 'above' == $heaven11_sidebar_mobile ) {
			} else if ( 'float' == $heaven11_sidebar_mobile ) {
				echo ' sidebar_float';
			}
			if ( ! heaven11_is_inherit( heaven11_get_theme_option( 'sidebar_scheme' ) ) ) {
				echo ' scheme_' . esc_attr( heaven11_get_theme_option( 'sidebar_scheme' ) );
			}
			?>
		" role="complementary">
			<?php
			// Single posts banner before sidebar
			heaven11_show_post_banner( 'sidebar' );
			// Button to show/hide sidebar on mobile
			if ( in_array( $heaven11_sidebar_mobile, array( 'above', 'float' ) ) ) {
				$heaven11_title = apply_filters( 'heaven11_filter_sidebar_control_title', 'float' == $heaven11_sidebar_mobile ? __( 'Show Sidebar', 'heaven11' ) : '' );
				$heaven11_text  = apply_filters( 'heaven11_filter_sidebar_control_text', 'above' == $heaven11_sidebar_mobile ? __( 'Show Sidebar', 'heaven11' ) : '' );
				?>
				<a href="#" class="sidebar_control" title="<?php echo esc_attr( $heaven11_title ); ?>"><?php echo esc_html( $heaven11_text ); ?></a>
				<?php
			}
			?>
			<div class="sidebar_inner">
				<?php
				do_action( 'heaven11_action_before_sidebar' );
				heaven11_show_layout( preg_replace( "/<\/aside>[\r\n\s]*<aside/", '</aside><aside', $heaven11_out ) );
				do_action( 'heaven11_action_after_sidebar' );
				?>
			</div><!-- /.sidebar_inner -->
		</div><!-- /.sidebar -->
		<div class="clearfix"></div>
		<?php
	}
}
