<?php
/**
 * The template to display default site footer
 *
 * @package WordPress
 * @subpackage HEAVEN11
 * @since HEAVEN11 1.0.10
 */

$heaven11_footer_id = heaven11_get_custom_footer_id();
$heaven11_footer_meta = get_post_meta( $heaven11_footer_id, 'trx_addons_options', true );
if ( ! empty( $heaven11_footer_meta['margin'] ) ) {
	heaven11_add_inline_css( sprintf( '.page_content_wrap{padding-bottom:%s}', esc_attr( heaven11_prepare_css_value( $heaven11_footer_meta['margin'] ) ) ) );
}
?>
<footer class="footer_wrap footer_custom footer_custom_<?php echo esc_attr( $heaven11_footer_id ); ?> footer_custom_<?php echo esc_attr( sanitize_title( get_the_title( $heaven11_footer_id ) ) ); ?>
						<?php
						if ( ! heaven11_is_inherit( heaven11_get_theme_option( 'footer_scheme' ) ) ) {
							echo ' scheme_' . esc_attr( heaven11_get_theme_option( 'footer_scheme' ) );
						}
						?>
						">
	<?php
	// Custom footer's layout
	do_action( 'heaven11_action_show_layout', $heaven11_footer_id );
	?>
</footer><!-- /.footer_wrap -->
