<?php
/**
 * The template to display the widgets area in the footer
 *
 * @package WordPress
 * @subpackage HEAVEN11
 * @since HEAVEN11 1.0.10
 */

// Footer sidebar
$heaven11_footer_name    = heaven11_get_theme_option( 'footer_widgets' );
$heaven11_footer_present = ! heaven11_is_off( $heaven11_footer_name ) && is_active_sidebar( $heaven11_footer_name );
if ( $heaven11_footer_present ) {
	heaven11_storage_set( 'current_sidebar', 'footer' );
	$heaven11_footer_wide = heaven11_get_theme_option( 'footer_wide' );
	ob_start();
	if ( is_active_sidebar( $heaven11_footer_name ) ) {
		dynamic_sidebar( $heaven11_footer_name );
	}
	$heaven11_out = trim( ob_get_contents() );
	ob_end_clean();
	if ( ! empty( $heaven11_out ) ) {
		$heaven11_out          = preg_replace( "/<\\/aside>[\r\n\s]*<aside/", '</aside><aside', $heaven11_out );
		$heaven11_need_columns = true;   //or check: strpos($heaven11_out, 'columns_wrap')===false;
		if ( $heaven11_need_columns ) {
			$heaven11_columns = max( 0, (int) heaven11_get_theme_option( 'footer_columns' ) );			
			if ( 0 == $heaven11_columns ) {
				$heaven11_columns = min( 4, max( 1, heaven11_tags_count( $heaven11_out, 'aside' ) ) );
			}
			if ( $heaven11_columns > 1 ) {
				$heaven11_out = preg_replace( '/<aside([^>]*)class="widget/', '<aside$1class="column-1_' . esc_attr( $heaven11_columns ) . ' widget', $heaven11_out );
			} else {
				$heaven11_need_columns = false;
			}
		}
		?>
		<div class="footer_widgets_wrap widget_area<?php echo ! empty( $heaven11_footer_wide ) ? ' footer_fullwidth' : ''; ?> sc_layouts_row sc_layouts_row_type_normal">
			<div class="footer_widgets_inner widget_area_inner">
				<?php
				if ( ! $heaven11_footer_wide ) {
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
				heaven11_show_layout( $heaven11_out );
				do_action( 'heaven11_action_after_sidebar' );
				if ( $heaven11_need_columns ) {
					?>
					</div><!-- /.columns_wrap -->
					<?php
				}
				if ( ! $heaven11_footer_wide ) {
					?>
					</div><!-- /.content_wrap -->
					<?php
				}
				?>
			</div><!-- /.footer_widgets_inner -->
		</div><!-- /.footer_widgets_wrap -->
		<?php
	}
}
