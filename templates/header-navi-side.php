<?php
/**
 * The template to display the side menu
 *
 * @package WordPress
 * @subpackage HEAVEN11
 * @since HEAVEN11 1.0
 */
?>
<div class="menu_side_wrap
<?php
				echo ' menu_side_' . esc_attr( heaven11_get_theme_option( 'menu_side_icons' ) > 0 ? 'icons' : 'dots' );
if ( ! heaven11_is_inherit( heaven11_get_theme_option( 'menu_scheme' ) ) ) {
	echo ' scheme_' . esc_attr( heaven11_get_theme_option( 'menu_scheme' ) );
} elseif ( ! heaven11_is_inherit( heaven11_get_theme_option( 'header_scheme' ) ) ) {
					echo ' scheme_' . esc_attr( heaven11_get_theme_option( 'header_scheme' ) );
}
?>
				">
	<span class="menu_side_button icon-menu3"></span>

	<div class="menu_side_inner">
		<?php
		// Logo
		set_query_var( 'heaven11_logo_args', array( 'type' => 'side' ) );
		get_template_part( apply_filters( 'heaven11_filter_get_template_part', 'templates/header-logo' ) );
		set_query_var( 'heaven11_logo_args', array() );
		// Main menu button
		?>
		<div class="toc_menu_item">
			<a href="#" class="toc_menu_description menu_mobile_description"><span class="toc_menu_description_title"><?php esc_html_e( 'Main menu', 'heaven11' ); ?></span></a>
			<a class="menu_mobile_button toc_menu_icon icon-menu3" href="#"></a>
		</div>
		<div class="toc_social_block">
			<div class="toc_soc_title_before"></div>
			<div class="toc_soc_title"><?php esc_html_e( 'Follow us', 'heaven11' ); ?></div>
			<div class="toc_socials">
				<?php echo do_shortcode( '[trx_widget_socials]' ); ?>
			</div>
		</div>
	</div>

</div><!-- /.menu_side_wrap -->
