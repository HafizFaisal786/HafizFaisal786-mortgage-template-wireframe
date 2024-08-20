<?php
/**
 * The template for homepage posts with "Excerpt" style
 *
 * @package WordPress
 * @subpackage HEAVEN11
 * @since HEAVEN11 1.0
 */

heaven11_storage_set( 'blog_archive', true );

get_header();

if ( have_posts() ) {

	heaven11_blog_archive_start();

	?><div class="posts_container">
		<?php

		$heaven11_stickies   = is_home() ? get_option( 'sticky_posts' ) : false;
		$heaven11_sticky_out = heaven11_get_theme_option( 'sticky_style' ) == 'columns'
								&& is_array( $heaven11_stickies ) && count( $heaven11_stickies ) > 0 && get_query_var( 'paged' ) < 1;
		if ( $heaven11_sticky_out ) {
			?>
			<div class="sticky_wrap columns_wrap">
			<?php
		}
		while ( have_posts() ) {
			the_post();
			if ( $heaven11_sticky_out && ! is_sticky() ) {
				$heaven11_sticky_out = false;
				?>
				</div>
				<?php
			}
			$heaven11_part = $heaven11_sticky_out && is_sticky() ? 'sticky' : 'excerpt';
			get_template_part( apply_filters( 'heaven11_filter_get_template_part', 'content', $heaven11_part ), $heaven11_part );
		}
		if ( $heaven11_sticky_out ) {
			$heaven11_sticky_out = false;
			?>
			</div>
			<?php
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
