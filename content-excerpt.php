<?php
/**
 * The default template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage HEAVEN11
 * @since HEAVEN11 1.0
 */

$heaven11_template_args = get_query_var( 'heaven11_template_args' );
if ( is_array( $heaven11_template_args ) ) {
	$heaven11_columns    = empty( $heaven11_template_args['columns'] ) ? 1 : max( 1, $heaven11_template_args['columns'] );
	$heaven11_blog_style = array( $heaven11_template_args['type'], $heaven11_columns );
	if ( ! empty( $heaven11_template_args['slider'] ) ) {
		?><div class="slider-slide swiper-slide">
		<?php
	} elseif ( $heaven11_columns > 1 ) {
		?>
		<div class="column-1_<?php echo esc_attr( $heaven11_columns ); ?>">
		<?php
	}
}
$heaven11_expanded    = ! heaven11_sidebar_present() && heaven11_is_on( heaven11_get_theme_option( 'expand_content' ) );
$heaven11_post_format = get_post_format();
$heaven11_post_format = empty( $heaven11_post_format ) ? 'standard' : str_replace( 'post-format-', '', $heaven11_post_format );
$heaven11_animation   = heaven11_get_theme_option( 'blog_animation' );
?>
<article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_excerpt post_format_' . esc_attr( $heaven11_post_format ) ); ?>
	<?php echo ( ! heaven11_is_off( $heaven11_animation ) && empty( $heaven11_template_args['slider'] ) ? ' data-animation="' . esc_attr( heaven11_get_animation_classes( $heaven11_animation ) ) . '"' : '' ); ?>
>
	<?php

	// Sticky label
	if ( is_sticky() && ! is_paged() ) {
		?>
		<span class="post_label label_sticky"><?php esc_html_e( 'sticky post', 'heaven11' ); ?></span>
		<?php
	}
	// Featured image
	$heaven11_hover = ! empty( $heaven11_template_args['hover'] ) && ! heaven11_is_inherit( $heaven11_template_args['hover'] )
						? $heaven11_template_args['hover']
						: heaven11_get_theme_option( 'image_hover' );

	// Title and post meta

		?>
		<div class="post_header entry-header">
			<?php
			do_action( 'heaven11_action_before_post_meta' );

			// Post meta
			$heaven11_components = heaven11_array_get_keys_by_value( heaven11_get_theme_option( 'meta_parts' ) );

			if ( ! empty( $heaven11_components ) && ! in_array( $heaven11_hover, array( 'border', 'pull', 'slide', 'fade' ) ) ) {
				heaven11_show_post_meta(
					apply_filters(
						'heaven11_filter_post_meta_args', array(
							'components' => $heaven11_components,
							'seo'        => false,
						), 'excerpt', 1
					)
				);
			}
			?><div class="post_header_content">
			<?php

			if ( get_the_title() != '' ) {
			do_action( 'heaven11_action_before_post_title' );

			// Post title
			if ( empty( $heaven11_template_args['no_links'] ) ) {
				the_title( sprintf( '<h2 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
			} else {
				the_title( '<h5 class="post_title entry-title">', '</h5>' );
			}
			}

			?></div>
		</div><!-- .post_header -->
		<?php

		// Featured image
	heaven11_show_post_featured(
		array(
			'no_links'   => ! empty( $heaven11_template_args['no_links'] ),
			'hover'      => $heaven11_hover,
			'thumb_size' => heaven11_get_thumb_size( strpos( heaven11_get_theme_option( 'body_style' ), 'full' ) !== false ? 'full' : ( $heaven11_expanded ? 'huge' : 'big' ) ),
		)
	);

	// More button

					heaven11_show_post_more_link( $heaven11_template_args, '<p>', '</p>' );


	// Post content
	if ( empty( $heaven11_template_args['hide_excerpt'] ) && heaven11_get_theme_option( 'excerpt_length' ) > 0 && in_array( $heaven11_post_format, array( 'standard', 'link', 'aside', 'status', 'audio', 'video', 'gallery' ) )) {
		?>
		<div class="post_content entry-content">
			<?php
			if ( heaven11_get_theme_option( 'blog_content' ) == 'fullpost' ) {
				// Post content area
				?>
				<div class="post_content_inner">
					<?php
					do_action( 'heaven11_action_before_full_post_content' );
					the_content( '' );
					do_action( 'heaven11_action_after_full_post_content' );
					?>
				</div>
				<?php
				// Inner pages
				wp_link_pages(
					array(
						'before'      => '<div class="page_links"><span class="page_links_title">' . esc_html__( 'Pages:', 'heaven11' ) . '</span>',
						'after'       => '</div>',
						'link_before' => '<span>',
						'link_after'  => '</span>',
						'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'heaven11' ) . ' </span>%',
						'separator'   => '<span class="screen-reader-text">, </span>',
					)
				);
			} else {
				// Post content area
				heaven11_show_post_content( $heaven11_template_args, '<div class="post_content_inner">', '</div>' );

			}
			?>
		</div><!-- .entry-content -->
		<?php
	}
	if ( 'quote' == $heaven11_post_format ) {
	?>
	<div class="post_content_inner post_content_quote">
				<?php

					$quote = heaven11_get_tag( get_the_content(), '<blockquote>', '</blockquote>' );
					if ( ! empty( $quote ) ) {
						heaven11_show_layout( wpautop( $quote ) );
					} else {
						the_excerpt();
					}

				?>
				</div><?php } ?>
</article>
<?php

if ( is_array( $heaven11_template_args ) ) {
	if ( ! empty( $heaven11_template_args['slider'] ) || $heaven11_columns > 1 ) {
		?>
		</div>
		<?php
	}
}
