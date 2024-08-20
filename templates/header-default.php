<?php
/**
 * The template to display default site header
 *
 * @package WordPress
 * @subpackage HEAVEN11
 * @since HEAVEN11 1.0
 */

$heaven11_header_css   = '';
$heaven11_header_image = get_header_image();
$heaven11_header_video = heaven11_get_header_video();
if ( ! empty( $heaven11_header_image ) && heaven11_trx_addons_featured_image_override( is_singular() || heaven11_storage_isset( 'blog_archive' ) || is_category() ) ) {
	$heaven11_header_image = heaven11_get_current_mode_image( $heaven11_header_image );
}
?><header class="top_panel top_panel_default
	<?php
	
	echo ! empty( $heaven11_header_image ) || ! empty( $heaven11_header_video ) ? ' with_bg_image' : ' without_bg_image';
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

	// Main menu
	if ( heaven11_get_theme_option( 'menu_style' ) == 'top' ) {
		get_template_part( apply_filters( 'heaven11_filter_get_template_part', 'templates/header-navi' ) );
	}

	// Mobile header
	if ( heaven11_is_on( heaven11_get_theme_option( 'header_mobile_enabled' ) ) ) {
		get_template_part( apply_filters( 'heaven11_filter_get_template_part', 'templates/header-mobile' ) );
	}

	if ( !is_single() || ( heaven11_get_theme_option( 'post_header_position' ) == 'default' && heaven11_get_theme_option( 'post_thumbnail_type' ) == 'default' ) ) {
		// Page title and breadcrumbs area
		get_template_part( apply_filters( 'heaven11_filter_get_template_part', 'templates/header-title' ) );

		// Display featured image in the header on the single posts
		// Comment next line to prevent show featured image in the header area
		// and display it in the post's content
		get_template_part( apply_filters( 'heaven11_filter_get_template_part', 'templates/header-single' ) );
	}

	// Header widgets area
	get_template_part( apply_filters( 'heaven11_filter_get_template_part', 'templates/header-widgets' ) );
	?>
</header>
