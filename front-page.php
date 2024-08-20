<?php
/**
 * The Front Page template file.
 *
 * @package WordPress
 * @subpackage HEAVEN11
 * @since HEAVEN11 1.0.31
 */

get_header();

// If front-page is a static page
if ( get_option( 'show_on_front' ) == 'page' ) {

	// If Front Page Builder is enabled - display sections
	if ( heaven11_is_on( heaven11_get_theme_option( 'front_page_enabled' ) ) ) {

		if ( have_posts() ) {
			the_post();
		}

		$heaven11_sections = heaven11_array_get_keys_by_value( heaven11_get_theme_option( 'front_page_sections' ), 1, false );
		if ( is_array( $heaven11_sections ) ) {
			foreach ( $heaven11_sections as $heaven11_section ) {
				get_template_part( apply_filters( 'heaven11_filter_get_template_part', 'front-page/section', $heaven11_section ), $heaven11_section );
			}
		}

		// Else if this page is blog archive
	} elseif ( is_page_template( 'blog.php' ) ) {
		get_template_part( apply_filters( 'heaven11_filter_get_template_part', 'blog' ) );

		// Else - display native page content
	} else {
		get_template_part( apply_filters( 'heaven11_filter_get_template_part', 'page' ) );
	}

	// Else get index template to show posts
} else {
	get_template_part( apply_filters( 'heaven11_filter_get_template_part', 'index' ) );
}

get_footer();
