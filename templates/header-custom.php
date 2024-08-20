<?php
/**
 * The template to display custom header from the ThemeREX Addons Layouts
 *
 * @package WordPress
 * @subpackage HEAVEN11
 * @since HEAVEN11 1.0.06
 */

$heaven11_header_css   = '';
$heaven11_header_image = get_header_image();
$heaven11_header_video = heaven11_get_header_video();
if ( ! empty( $heaven11_header_image ) && heaven11_trx_addons_featured_image_override( is_singular() || heaven11_storage_isset( 'blog_archive' ) || is_category() ) ) {
	$heaven11_header_image = heaven11_get_current_mode_image( $heaven11_header_image );
}

$heaven11_header_id = heaven11_get_custom_header_id();
$heaven11_header_meta = get_post_meta( $heaven11_header_id, 'trx_addons_options', true );
if ( ! empty( $heaven11_header_meta['margin'] ) ) {
	heaven11_add_inline_css( sprintf( '.page_content_wrap{padding-top:%s}', esc_attr( heaven11_prepare_css_value( $heaven11_header_meta['margin'] ) ) ) );
}

?><header class="top_panel top_panel_custom top_panel_custom_<?php echo esc_attr( $heaven11_header_id ); ?> top_panel_custom_<?php echo esc_attr( sanitize_title( get_the_title( $heaven11_header_id ) ) ); ?>
				<?php
				echo ! empty( $heaven11_header_image ) || ! empty( $heaven11_header_video )
					? ' with_bg_image'
					: ' without_bg_image';
				if ( '' != $heaven11_header_video ) {
					echo ' with_bg_video';
				}
				if ( '' != $heaven11_header_image ) {
					echo ' ' . esc_attr( heaven11_add_inline_css_class( 'background-image: url(' . esc_url( $heaven11_header_image ) . ');' ) );
				}
				if ( is_single() && has_post_thumbnail() ) {
					echo ' with_featured_image';
				}
				if ( heaven11_is_on( heaven11_get_theme_option( 'header_fullheight' ) ) ) {
					echo ' header_fullheight heaven11-full-height';
				}
				if ( ! heaven11_is_inherit( heaven11_get_theme_option( 'header_scheme' ) ) ) {
					echo ' scheme_' . esc_attr( heaven11_get_theme_option( 'header_scheme' ) );
				}
				?>
">
	<?php

	// Background video
	if ( ! empty( $heaven11_header_video ) ) {
		get_template_part( apply_filters( 'heaven11_filter_get_template_part', 'templates/header-video' ) );
	}

	// Custom header's layout
	do_action( 'heaven11_action_show_layout', $heaven11_header_id );

	// Header widgets area
	get_template_part( apply_filters( 'heaven11_filter_get_template_part', 'templates/header-widgets' ) );

	?>
</header>
