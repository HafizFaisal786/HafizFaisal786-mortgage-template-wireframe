<?php
/**
 * The Gallery template to display posts
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage HEAVEN11
 * @since HEAVEN11 1.0
 */

$heaven11_template_args = get_query_var( 'heaven11_template_args' );
if ( is_array( $heaven11_template_args ) ) {
	$heaven11_columns    = empty( $heaven11_template_args['columns'] ) ? 2 : max( 1, $heaven11_template_args['columns'] );
	$heaven11_blog_style = array( $heaven11_template_args['type'], $heaven11_columns );
} else {
	$heaven11_blog_style = explode( '_', heaven11_get_theme_option( 'blog_style' ) );
	$heaven11_columns    = empty( $heaven11_blog_style[1] ) ? 2 : max( 1, $heaven11_blog_style[1] );
}
$heaven11_post_format = get_post_format();
$heaven11_post_format = empty( $heaven11_post_format ) ? 'standard' : str_replace( 'post-format-', '', $heaven11_post_format );
$heaven11_animation   = heaven11_get_theme_option( 'blog_animation' );
$heaven11_image       = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );

?><div class="
<?php
if ( ! empty( $heaven11_template_args['slider'] ) ) {
	echo ' slider-slide swiper-slide';
} else {
	echo 'masonry_item masonry_item-1_' . esc_attr( $heaven11_columns );
}
?>
"><article id="post-<?php the_ID(); ?>" 
	<?php
	post_class(
		'post_item post_format_' . esc_attr( $heaven11_post_format )
		. ' post_layout_portfolio'
		. ' post_layout_portfolio_' . esc_attr( $heaven11_columns )
		. ' post_layout_gallery'
		. ' post_layout_gallery_' . esc_attr( $heaven11_columns )
	);
	echo ( ! heaven11_is_off( $heaven11_animation ) && empty( $heaven11_template_args['slider'] ) ? ' data-animation="' . esc_attr( heaven11_get_animation_classes( $heaven11_animation ) ) . '"' : '' );
	?>
	data-size="
		<?php
		if ( ! empty( $heaven11_image[1] ) && ! empty( $heaven11_image[2] ) ) {
			echo intval( $heaven11_image[1] ) . 'x' . intval( $heaven11_image[2] );}
		?>
	"
	data-src="
		<?php
		if ( ! empty( $heaven11_image[0] ) ) {
			echo esc_url( $heaven11_image[0] );}
		?>
	"
>
<?php

	// Sticky label
if ( is_sticky() && ! is_paged() ) {
	?>
		<span class="post_label label_sticky"></span>
		<?php
}

	// Featured image
	$heaven11_image_hover = 'icon';  
if ( in_array( $heaven11_image_hover, array( 'icons', 'zoom' ) ) ) {
	$heaven11_image_hover = 'dots';
}
$heaven11_components = heaven11_array_get_keys_by_value( heaven11_get_theme_option( 'meta_parts' ) );
heaven11_show_post_featured(
	array(
		'hover'         => $heaven11_image_hover,
		'no_links'      => ! empty( $heaven11_template_args['no_links'] ),
		'thumb_size'    => heaven11_get_thumb_size( strpos( heaven11_get_theme_option( 'body_style' ), 'full' ) !== false || $heaven11_columns < 3 ? 'masonry-big' : 'masonry' ),
		'thumb_only'    => true,
		'show_no_image' => true,
		'post_info'     => '<div class="post_details">'
						. '<h2 class="post_title">'
							. ( empty( $heaven11_template_args['no_links'] )
								? '<a href="' . esc_url( get_permalink() ) . '">' . esc_html( get_the_title() ) . '</a>'
								: esc_html( get_the_title() )
								)
						. '</h2>'
						. '<div class="post_description">'
							. ( ! empty( $heaven11_components )
								? heaven11_show_post_meta(
									apply_filters(
										'heaven11_filter_post_meta_args', array(
											'components' => $heaven11_components,
											'seo'      => false,
											'echo'     => false,
										), $heaven11_blog_style[0], $heaven11_columns
									)
								)
								: ''
								)
							. ( empty( $heaven11_template_args['hide_excerpt'] )
								? '<div class="post_description_content">' . get_the_excerpt() . '</div>'
								: ''
								)
							. ( empty( $heaven11_template_args['no_links'] )
								? '<a href="' . esc_url( get_permalink() ) . '" class="theme_button post_readmore"><span class="post_readmore_label">' . esc_html__( 'Learn more', 'heaven11' ) . '</span></a>'
								: ''
								)
						. '</div>'
					. '</div>',
	)
);
?>
</article></div><?php
// Need opening PHP-tag above, because <article> is a inline-block element (used as column)!
