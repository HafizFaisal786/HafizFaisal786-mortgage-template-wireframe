<?php
/**
 * The template for homepage posts with custom style
 *
 * @package WordPress
 * @subpackage HEAVEN11
 * @since HEAVEN11 1.0.50
 */

heaven11_storage_set( 'blog_archive', true );

get_header();

if ( have_posts() ) {

	$heaven11_blog_style = heaven11_get_theme_option( 'blog_style' );
	$heaven11_parts      = explode( '_', $heaven11_blog_style );
	$heaven11_columns    = ! empty( $heaven11_parts[1] ) ? max( 1, min( 6, (int) $heaven11_parts[1] ) ) : 1;
	$heaven11_blog_id    = heaven11_get_custom_blog_id( $heaven11_blog_style );
	$heaven11_blog_meta  = heaven11_get_custom_layout_meta( $heaven11_blog_id );
	if ( ! empty( $heaven11_blog_meta['margin'] ) ) {
		heaven11_add_inline_css( sprintf( '.page_content_wrap{padding-top:%s}', esc_attr( heaven11_prepare_css_value( $heaven11_blog_meta['margin'] ) ) ) );
	}
	$heaven11_custom_style = ! empty( $heaven11_blog_meta['scripts_required'] ) ? $heaven11_blog_meta['scripts_required'] : 'none';

	heaven11_blog_archive_start();

	$heaven11_classes    = 'posts_container blog_custom_wrap' 
							. ( ! heaven11_is_off( $heaven11_custom_style )
								? sprintf( ' %s_wrap', $heaven11_custom_style )
								: ( $heaven11_columns > 1 
									? ' columns_wrap columns_padding_bottom' 
									: ''
									)
								);
	$heaven11_stickies   = is_home() ? get_option( 'sticky_posts' ) : false;
	$heaven11_sticky_out = heaven11_get_theme_option( 'sticky_style' ) == 'columns'
							&& is_array( $heaven11_stickies ) && count( $heaven11_stickies ) > 0 && get_query_var( 'paged' ) < 1;
	if ( $heaven11_sticky_out ) {
		?>
		<div class="sticky_wrap columns_wrap">
		<?php
	}
	if ( ! $heaven11_sticky_out ) {
		if ( heaven11_get_theme_option( 'first_post_large' ) && ! is_paged() && ! in_array( heaven11_get_theme_option( 'body_style' ), array( 'fullwide', 'fullscreen' ) ) ) {
			the_post();
			get_template_part( apply_filters( 'heaven11_filter_get_template_part', 'content', 'excerpt' ), 'excerpt' );
		}
		?>
		<div class="<?php echo esc_attr( $heaven11_classes ); ?>">
		<?php
	}
	while ( have_posts() ) {
		the_post();
		if ( $heaven11_sticky_out && ! is_sticky() ) {
			$heaven11_sticky_out = false;
			?>
			</div><div class="<?php echo esc_attr( $heaven11_classes ); ?>">
			<?php
		}
		$heaven11_part = $heaven11_sticky_out && is_sticky() ? 'sticky' : 'custom';
		get_template_part( apply_filters( 'heaven11_filter_get_template_part', 'content', $heaven11_part ), $heaven11_part );
	}
	?>
	</div>
	<?php

	heaven11_show_pagination();

	heaven11_blog_archive_end();

} else {

	if ( is_search() ) {
		get_template_part( apply_filters( 'heaven11_filter_get_template_part', 'content', 'none-search' ), 'none-search' );
	} else {
		get_template_part( apply_filters( 'heaven11_filter_get_template_part', 'content', 'none-archive' ), 'none-archive' );
	}
}

get_footer();
