<?php
/**
 * The Sticky template to display the sticky posts
 *
 * Used for index/archive
 *
 * @package WordPress
 * @subpackage HEAVEN11
 * @since HEAVEN11 1.0
 */

$heaven11_columns     = max( 1, min( 3, count( get_option( 'sticky_posts' ) ) ) );
$heaven11_post_format = get_post_format();
$heaven11_post_format = empty( $heaven11_post_format ) ? 'standard' : str_replace( 'post-format-', '', $heaven11_post_format );
$heaven11_animation   = heaven11_get_theme_option( 'blog_animation' );

?><div class="column-1_<?php echo esc_attr( $heaven11_columns ); ?>"><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_sticky post_format_' . esc_attr( $heaven11_post_format ) ); ?>
	<?php echo ( ! heaven11_is_off( $heaven11_animation ) ? ' data-animation="' . esc_attr( heaven11_get_animation_classes( $heaven11_animation ) ) . '"' : '' ); ?>
	>

	<?php
	if ( is_sticky() && is_home() && ! is_paged() ) {
		?>
		<span class="post_label label_sticky"></span>
		<?php
	}

	// Featured image
	heaven11_show_post_featured(
		array(
			'thumb_size' => heaven11_get_thumb_size( 1 == $heaven11_columns ? 'big' : ( 2 == $heaven11_columns ? 'med' : 'avatar' ) ),
		)
	);

	if ( ! in_array( $heaven11_post_format, array( 'link', 'aside', 'status', 'quote' ) ) ) {
		?>
		<div class="post_header entry-header">
			<?php
			// Post title
			the_title( sprintf( '<h6 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h6>' );
			// Post meta
			heaven11_show_post_meta( apply_filters( 'heaven11_filter_post_meta_args', array(), 'sticky', $heaven11_columns ) );
			?>
		</div><!-- .entry-header -->
		<?php
	}
	?>
</article></div><?php

// div.column-1_X is a inline-block and new lines and spaces after it are forbidden
