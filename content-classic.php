<?php
/**
 * The Classic template to display the content
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
$heaven11_expanded   = ! heaven11_sidebar_present() && heaven11_is_on( heaven11_get_theme_option( 'expand_content' ) );
$heaven11_animation  = heaven11_get_theme_option( 'blog_animation' );
$heaven11_components = heaven11_array_get_keys_by_value( heaven11_get_theme_option( 'meta_parts' ) );

$heaven11_post_format = get_post_format();
$heaven11_post_format = empty( $heaven11_post_format ) ? 'standard' : str_replace( 'post-format-', '', $heaven11_post_format );

?><div class="
<?php
if ( ! empty( $heaven11_template_args['slider'] ) ) {
	echo ' slider-slide swiper-slide';
} else {
	echo ( 'classic' == $heaven11_blog_style[0] ? 'column' : 'masonry_item masonry_item' ) . '-1_' . esc_attr( $heaven11_columns );
}
?>
"><article id="post-<?php the_ID(); ?>" 
	<?php
		post_class(
			'post_item post_format_' . esc_attr( $heaven11_post_format )
					. ' post_layout_classic post_layout_classic_' . esc_attr( $heaven11_columns )
					. ' post_layout_' . esc_attr( $heaven11_blog_style[0] )
					. ' post_layout_' . esc_attr( $heaven11_blog_style[0] ) . '_' . esc_attr( $heaven11_columns )
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

	// Featured image
	$heaven11_hover = ! empty( $heaven11_template_args['hover'] ) && ! heaven11_is_inherit( $heaven11_template_args['hover'] )
						? $heaven11_template_args['hover']
						: heaven11_get_theme_option( 'image_hover' );
	heaven11_show_post_featured(
		array(
			'thumb_size' => heaven11_get_thumb_size(
				'classic' == $heaven11_blog_style[0]
						? ( strpos( heaven11_get_theme_option( 'body_style' ), 'full' ) !== false
								? ( $heaven11_columns > 2 ? 'big' : 'huge' )
								: ( $heaven11_columns > 2
									? ( $heaven11_expanded ? 'med' : 'small' )
									: ( $heaven11_expanded ? 'big' : 'med' )
									)
							)
						: ( strpos( heaven11_get_theme_option( 'body_style' ), 'full' ) !== false
								? ( $heaven11_columns > 2 ? 'masonry-big' : 'full' )
								: ( $heaven11_columns <= 2 && $heaven11_expanded ? 'masonry-big' : 'masonry' )
							)
			),
			'hover'      => $heaven11_hover,
			'no_links'   => ! empty( $heaven11_template_args['no_links'] ),
		)
	);

	if ( ! in_array( $heaven11_post_format, array( 'link', 'aside', 'status', 'quote' ) ) ) {
		?>
		<div class="post_header entry-header">
			<?php
			do_action( 'heaven11_action_before_post_title' );

			// Post title
			if ( empty( $heaven11_template_args['no_links'] ) ) {
				the_title( sprintf( '<h4 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' );
			} else {
				the_title( '<h4 class="post_title entry-title">', '</h4>' );
			}

			do_action( 'heaven11_action_before_post_meta' );

			// Post meta
			if ( ! empty( $heaven11_components ) && ! in_array( $heaven11_hover, array( 'border', 'pull', 'slide', 'fade' ) ) ) {
				heaven11_show_post_meta(
					apply_filters(
						'heaven11_filter_post_meta_args', array(
							'components' => $heaven11_components,
							'seo'        => false,
						), $heaven11_blog_style[0], $heaven11_columns
					)
				);
			}

			do_action( 'heaven11_action_after_post_meta' );
			?>
		</div><!-- .entry-header -->
		<?php
	}
	?>

	<div class="post_content entry-content">
		<?php
		if ( empty( $heaven11_template_args['hide_excerpt'] ) && heaven11_get_theme_option( 'excerpt_length' ) > 0 ) {
			// Post content area
			heaven11_show_post_content( $heaven11_template_args, '<div class="post_content_inner">', '</div>' );
		}
		
		// Post meta
		if ( in_array( $heaven11_post_format, array( 'link', 'aside', 'status', 'quote' ) ) ) {
			if ( ! empty( $heaven11_components ) ) {
				heaven11_show_post_meta(
					apply_filters(
						'heaven11_filter_post_meta_args', array(
							'components' => $heaven11_components,
						), $heaven11_blog_style[0], $heaven11_columns
					)
				);
			}
		}
		
		// More button
		if ( empty( $heaven11_template_args['no_links'] ) && ! empty( $heaven11_template_args['more_text'] ) && ! in_array( $heaven11_post_format, array( 'link', 'aside', 'status', 'quote' ) ) ) {
			heaven11_show_post_more_link( $heaven11_template_args, '<p>', '</p>' );
		}
		?>
	</div><!-- .entry-content -->

</article></div><?php
// Need opening PHP-tag above, because <div> is a inline-block element (used as column)!
