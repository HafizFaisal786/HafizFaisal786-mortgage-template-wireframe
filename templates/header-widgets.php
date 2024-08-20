<?php
/**
 * The template to display the widgets area in the header
 *
 * @package WordPress
 * @subpackage HEAVEN11
 * @since HEAVEN11 1.0
 */

// Header sidebar
$heaven11_header_name    = heaven11_get_theme_option( 'header_widgets' );
$heaven11_header_present = ! heaven11_is_off( $heaven11_header_name ) && is_active_sidebar( $heaven11_header_name );
if ( $heaven11_header_present ) {
	heaven11_storage_set( 'current_sidebar', 'header' );
	$heaven11_header_wide = heaven11_get_theme_option( 'header_wide' );
	ob_start();
	if ( is_active_sidebar( $heaven11_header_name ) ) {
		dynamic_sidebar( $heaven11_header_name );
	}
	$heaven11_widgets_output = ob_get_contents();
	ob_end_clean();
	if ( ! empty( $heaven11_widgets_output ) ) {
		$heaven11_widgets_output = preg_replace( "/<\/aside>[\r\n\s]*<aside/", '</aside><aside', $heaven11_widgets_output );
		$heaven11_need_columns   = strpos( $heaven11_widgets_output, 'columns_wrap' ) === false;
		if ( $heaven11_need_columns ) {
			$heaven11_columns = max( 0, (int) heaven11_get_theme_option( 'header_columns' ) );
			if ( 0 == $heaven11_columns ) {
				$heaven11_columns = min( 6, max( 1, heaven11_tags_count( $heaven11_widgets_output, 'aside' ) ) );
			}
			if ( $heaven11_columns > 1 ) {
				$heaven11_widgets_output = preg_replace( '/<aside([^>]*)class="widget/', '<aside$1class="column-1_' . esc_attr( $heaven11_columns ) . ' widget', $heaven11_widgets_output );
			} else {
				$heaven11_need_columns = false;
			}
		}
		?>
		<div class="header_widgets_wrap widget_area<?php echo ! empty( $heaven11_header_wide ) ? ' header_fullwidth' : ' header_boxed'; ?>">
			<div class="header_widgets_inner widget_area_inner">
				<?php
				if ( ! $heaven11_header_wide ) {
					?>
					<div class="content_wrap">
					<?php
				}
				if ( $heaven11_need_columns ) {
					?>
					<div class="columns_wrap">
					<?php
				}
				do_action( 'heaven11_action_before_sidebar' );
				heaven11_show_layout( $heaven11_widgets_output );
				do_action( 'heaven11_action_after_sidebar' );
				if ( $heaven11_need_columns ) {
					?>
					</div>	<!-- /.columns_wrap -->
					<?php
				}
				if ( ! $heaven11_header_wide ) {
					?>
					</div>	<!-- /.content_wrap -->
					<?php
				}
				?>
			</div>	<!-- /.header_widgets_inner -->
		</div>	<!-- /.header_widgets_wrap -->
		<?php
	}
}
