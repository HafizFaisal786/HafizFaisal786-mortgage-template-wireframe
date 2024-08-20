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
	$heaven11_columns    = empty( $heaven11_template_args['columns'] ) ? 1 : max( 1, min( 3, $heaven11_template_args['columns'] ) );
	$heaven11_blog_style = array( $heaven11_template_args['type'], $heaven11_columns );
} else {
	$heaven11_blog_style = explode( '_', heaven11_get_theme_option( 'blog_style' ) );
	$heaven11_columns    = empty( $heaven11_blog_style[1] ) ? 1 : max( 1, min( 3, $heaven11_blog_style[1] ) );
}
$heaven11_expanded    = ! heaven11_sidebar_present() && heaven11_is_on( heaven11_get_theme_option( 'expand_content' ) );
$heaven11_post_format = get_post_format();
$heaven11_post_format = empty( $heaven11_post_format ) ? 'standard' : str_replace( 'post-format-', '', $heaven11_post_format );
$heaven11_animation   = heaven11_get_theme_option( 'blog_animation' );

?><article id="post-<?php the_ID(); ?>" 
									<?php
									post_class(
										'post_item'
										. ' post_layout_chess'
										. ' post_layout_chess_' . esc_attr( $heaven11_columns )
										. ' post_format_' . esc_attr( $heaven11_post_format )
										. ( ! empty( $heaven11_template_args['slider'] ) ? ' slider-slide swiper-slide' : '' )
									);
									echo ( ! heaven11_is_off( $heaven11_animation ) && empty( $heaven11_template_args['slider'] ) ? ' data-animation="' . esc_attr( heaven11_get_animation_classes( $heaven11_animation ) ) . '"' : '' );
									?>
	>

	<?php
	// Add anchor
	if ( 1 == $heaven11_columns && ! is_array( $heaven11_template_args ) && shortcode_exists( 'trx_sc_anchor' ) ) {
		echo do_shortcode( '[trx_sc_anchor id="post_' . esc_attr( get_the_ID() ) . '" title="' . the_title_attribute(array( 'echo' => false )) . '" icon="' . esc_attr( heaven11_get_post_icon() ) . '"]' );
	}

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
			'class'         => 1 == $heaven11_columns && ! is_array( $heaven11_template_args ) ? 'heaven11-full-height' : '',
			'hover'         => $heaven11_hover,
			'no_links'      => ! empty( $heaven11_template_args['no_links'] ),
			'show_no_image' => true,
			'thumb_ratio'   => '1:1',
			'thumb_bg'      => true,
			'thumb_size'    => heaven11_get_thumb_size(
				strpos( heaven11_get_theme_option( 'body_style' ), 'full' ) !== false
										? ( 1 < $heaven11_columns ? 'huge' : 'original' )
										: ( 2 < $heaven11_columns ? 'big' : 'huge' )
			),
		)
	);

	?>
	<div class="post_inner"><div class="post_inner_content"><div class="post_header entry-header">
		<?php
			do_action( 'heaven11_action_before_post_title' );

			// Post title
			if ( empty( $heaven11_template_args['no_links'] ) ) {
				the_title( sprintf( '<h3 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );
			} else {
				the_title( '<h3 class="post_title entry-title">', '</h3>' );
			}

			do_action( 'heaven11_action_before_post_meta' );

			// Post meta
			$heaven11_components = heaven11_array_get_keys_by_value( heaven11_get_theme_option( 'meta_parts' ) );
			$heaven11_post_meta  = empty( $heaven11_components ) || in_array( $heaven11_hover, array( 'border', 'pull', 'slide', 'fade' ) )
										? ''
										: heaven11_show_post_meta(
											apply_filters(
												'heaven11_filter_post_meta_args', array(
													'components' => $heaven11_components,
													'seo'  => false,
													'echo' => false,
												), $heaven11_blog_style[0], $heaven11_columns
											)
										);
			heaven11_show_layout( $heaven11_post_meta );
			?>
		</div><!-- .entry-header -->

		<div class="post_content entry-content">
			<?php
			// Post content area
			if ( empty( $heaven11_template_args['hide_excerpt'] ) && heaven11_get_theme_option( 'excerpt_length' ) > 0 ) {
				heaven11_show_post_content( $heaven11_template_args, '<div class="post_content_inner">', '</div>' );
			}
			// Post meta
			if ( in_array( $heaven11_post_format, array( 'link', 'aside', 'status', 'quote' ) ) ) {
				heaven11_show_layout( $heaven11_post_meta );
			}
			// More button
			if ( empty( $heaven11_template_args['no_links'] ) && ! in_array( $heaven11_post_format, array( 'link', 'aside', 'status', 'quote' ) ) ) {
				heaven11_show_post_more_link( $heaven11_template_args, '<p>', '</p>' );
			}
			?>
		</div><!-- .entry-content -->

	</div></div><!-- .post_inner -->

</article><?php
// Need opening PHP-tag above, because <article> is a inline-block element (used as column)!
