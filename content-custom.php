<?php
/**
 * The custom template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage HEAVEN11
 * @since HEAVEN11 1.0.50
 */

$heaven11_template_args = get_query_var( 'heaven11_template_args' );
if ( is_array( $heaven11_template_args ) ) {
	$heaven11_columns    = empty( $heaven11_template_args['columns'] ) ? 2 : max( 1, $heaven11_template_args['columns'] );
	$heaven11_blog_style = array( $heaven11_template_args['type'], $heaven11_columns );
} else {
	$heaven11_blog_style = explode( '_', heaven11_get_theme_option( 'blog_style' ) );
	$heaven11_columns    = empty( $heaven11_blog_style[1] ) ? 2 : max( 1, $heaven11_blog_style[1] );
}
$heaven11_blog_id       = heaven11_get_custom_blog_id( join( '_', $heaven11_blog_style ) );
$heaven11_blog_style[0] = str_replace( 'blog-custom-', '', $heaven11_blog_style[0] );
$heaven11_expanded      = ! heaven11_sidebar_present() && heaven11_is_on( heaven11_get_theme_option( 'expand_content' ) );
$heaven11_animation     = heaven11_get_theme_option( 'blog_animation' );
$heaven11_components    = heaven11_array_get_keys_by_value( heaven11_get_theme_option( 'meta_parts' ) );

$heaven11_post_format   = get_post_format();
$heaven11_post_format   = empty( $heaven11_post_format ) ? 'standard' : str_replace( 'post-format-', '', $heaven11_post_format );

$heaven11_blog_meta     = heaven11_get_custom_layout_meta( $heaven11_blog_id );
$heaven11_custom_style  = ! empty( $heaven11_blog_meta['scripts_required'] ) ? $heaven11_blog_meta['scripts_required'] : 'none';

if ( ! empty( $heaven11_template_args['slider'] ) || $heaven11_columns > 1 || ! heaven11_is_off( $heaven11_custom_style ) ) {
	?><div class="
		<?php
		if ( ! empty( $heaven11_template_args['slider'] ) ) {
			echo 'slider-slide swiper-slide';
		} else {
			echo ( heaven11_is_off( $heaven11_custom_style ) ? 'column' : sprintf( '%1$s_item %1$s_item', $heaven11_custom_style ) ) . '-1_' . esc_attr( $heaven11_columns );
		}
		?>
	">
	<?php
}
?>
<article id="post-<?php the_ID(); ?>" 
<?php
	post_class(
			'post_item post_format_' . esc_attr( $heaven11_post_format )
					. ' post_layout_custom post_layout_custom_' . esc_attr( $heaven11_columns )
					. ' post_layout_' . esc_attr( $heaven11_blog_style[0] )
					. ' post_layout_' . esc_attr( $heaven11_blog_style[0] ) . '_' . esc_attr( $heaven11_columns )
					. ( ! heaven11_is_off( $heaven11_custom_style )
						? ' post_layout_' . esc_attr( $heaven11_custom_style )
							. ' post_layout_' . esc_attr( $heaven11_custom_style ) . '_' . esc_attr( $heaven11_columns )
						: ''
						)
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
	// Custom layout
	do_action( 'heaven11_action_show_layout', $heaven11_blog_id );
	?>
</article><?php
if ( ! empty( $heaven11_template_args['slider'] ) || $heaven11_columns > 1 || ! heaven11_is_off( $heaven11_custom_style ) ) {
	?></div><?php
	// Need opening PHP-tag above just after </div>, because <div> is a inline-block element (used as column)!
}
