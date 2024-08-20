<?php
/**
 * The Portfolio template to display the content
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
		. ( is_sticky() && ! is_paged() ? ' sticky' : '' )
	);
	echo ( ! heaven11_is_off( $heaven11_animation ) && empty( $heaven11_template_args['slider'] ) ? ' data-animation="' . esc_attr( heaven11_get_animation_classes( $heaven11_animation ) ) . '"' : '' );
	?>
>
<?php

// Sticky label
if ( is_sticky() && ! is_paged() ) {
	?>
		<span class="post_label label_sticky"></span>
		<?php
}

	$heaven11_image_hover = ! empty( $heaven11_template_args['hover'] ) && ! heaven11_is_inherit( $heaven11_template_args['hover'] )
								? $heaven11_template_args['hover']
								: heaven11_get_theme_option( 'image_hover' );
	// Featured image
	heaven11_show_post_featured(
		array(
			'hover'         => $heaven11_image_hover,
			'no_links'      => ! empty( $heaven11_template_args['no_links'] ),
			'thumb_size'    => heaven11_get_thumb_size(
				strpos( heaven11_get_theme_option( 'body_style' ), 'full' ) !== false || $heaven11_columns < 3
								? 'masonry-big'
				: 'masonry'
			),
			'show_no_image' => true,
			'class'         => 'icon' == $heaven11_image_hover ? 'hover_with_info' : '',
			'post_info'     => 'icon' == $heaven11_image_hover ? '<div class="post_info">' . esc_html( get_the_title() ) . '</div>' : '',
		)
	);
	?>
</article></div><?php
// Need opening PHP-tag above, because <article> is a inline-block element (used as column)!