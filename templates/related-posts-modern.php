<?php
/**
 * The template 'Style 1' to displaying related posts
 *
 * @package WordPress
 * @subpackage HEAVEN11
 * @since HEAVEN11 1.0
 */

$heaven11_link        = get_permalink();
$heaven11_post_format = get_post_format();
$heaven11_post_format = empty( $heaven11_post_format ) ? 'standard' : str_replace( 'post-format-', '', $heaven11_post_format );
?><div id="post-<?php the_ID(); ?>" <?php post_class( 'related_item post_format_' . esc_attr( $heaven11_post_format ) ); ?>>
	<?php
	heaven11_show_post_featured(
		array(
			'thumb_size'    => apply_filters( 'heaven11_filter_related_thumb_size', heaven11_get_thumb_size( (int) heaven11_get_theme_option( 'related_posts' ) == 1 ? 'huge' : 'big' ) ),
			'show_no_image' => heaven11_get_no_image() != '',
			'post_info'     => '<div class="post_header entry-header">'
									. '<div class="post_categories">' . wp_kses(( heaven11_get_post_categories( '' ) ),'heaven11_kses_content') . '</div>'
									. '<h6 class="post_title entry-title"><a href="' . esc_url( $heaven11_link ) . '">' . wp_kses_data( get_the_title() ) . '</a></h6>'
									. ( in_array( get_post_type(), array( 'post', 'attachment' ) )
											? '<div class="post_meta"><a href="' . esc_url( $heaven11_link ) . '" class="post_meta_item post_date">' . wp_kses_data( heaven11_get_date() ) . '</a></div>'
											: '' )
								. '</div>',
		)
	);
	?>
</div>
