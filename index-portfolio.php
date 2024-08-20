<?php
/**
 * The template for homepage posts with "Portfolio" style
 *
 * @package WordPress
 * @subpackage HEAVEN11
 * @since HEAVEN11 1.0
 */

heaven11_storage_set( 'blog_archive', true );

get_header();

if ( have_posts() ) {

	heaven11_blog_archive_start();

	$heaven11_stickies   = is_home() ? get_option( 'sticky_posts' ) : false;
	$heaven11_sticky_out = heaven11_get_theme_option( 'sticky_style' ) == 'columns'
							&& is_array( $heaven11_stickies ) && count( $heaven11_stickies ) > 0 && get_query_var( 'paged' ) < 1;

	// Show filters
	$heaven11_cat          = heaven11_get_theme_option( 'parent_cat' );
	$heaven11_post_type    = heaven11_get_theme_option( 'post_type' );
	$heaven11_taxonomy     = heaven11_get_post_type_taxonomy( $heaven11_post_type );
	$heaven11_show_filters = heaven11_get_theme_option( 'show_filters' );
	$heaven11_tabs         = array();
	if ( ! heaven11_is_off( $heaven11_show_filters ) ) {
		$heaven11_args           = array(
			'type'         => $heaven11_post_type,
			'child_of'     => $heaven11_cat,
			'orderby'      => 'name',
			'order'        => 'ASC',
			'hide_empty'   => 1,
			'hierarchical' => 0,
			'taxonomy'     => $heaven11_taxonomy,
			'pad_counts'   => false,
		);
		$heaven11_portfolio_list = get_terms( $heaven11_args );
		if ( is_array( $heaven11_portfolio_list ) && count( $heaven11_portfolio_list ) > 0 ) {
			$heaven11_tabs[ $heaven11_cat ] = esc_html__( 'All', 'heaven11' );
			foreach ( $heaven11_portfolio_list as $heaven11_term ) {
				if ( isset( $heaven11_term->term_id ) ) {
					$heaven11_tabs[ $heaven11_term->term_id ] = $heaven11_term->name;
				}
			}
		}
	}
	if ( count( $heaven11_tabs ) > 0 ) {
		$heaven11_portfolio_filters_ajax   = true;
		$heaven11_portfolio_filters_active = $heaven11_cat;
		$heaven11_portfolio_filters_id     = 'portfolio_filters';
		?>
		<div class="portfolio_filters heaven11_tabs heaven11_tabs_ajax">
			<ul class="portfolio_titles heaven11_tabs_titles">
				<?php
				foreach ( $heaven11_tabs as $heaven11_id => $heaven11_title ) {
					?>
					<li><a href="<?php echo esc_url( heaven11_get_hash_link( sprintf( '#%s_%s_content', $heaven11_portfolio_filters_id, $heaven11_id ) ) ); ?>" data-tab="<?php echo esc_attr( $heaven11_id ); ?>"><?php echo esc_html( $heaven11_title ); ?></a></li>
					<?php
				}
				?>
			</ul>
			<?php
			$heaven11_ppp = heaven11_get_theme_option( 'posts_per_page' );
			if ( heaven11_is_inherit( $heaven11_ppp ) ) {
				$heaven11_ppp = '';
			}
			foreach ( $heaven11_tabs as $heaven11_id => $heaven11_title ) {
				$heaven11_portfolio_need_content = $heaven11_id == $heaven11_portfolio_filters_active || ! $heaven11_portfolio_filters_ajax;
				?>
				<div id="<?php echo esc_attr( sprintf( '%s_%s_content', $heaven11_portfolio_filters_id, $heaven11_id ) ); ?>"
					class="portfolio_content heaven11_tabs_content"
					data-blog-template="<?php echo esc_attr( heaven11_storage_get( 'blog_template' ) ); ?>"
					data-blog-style="<?php echo esc_attr( heaven11_get_theme_option( 'blog_style' ) ); ?>"
					data-posts-per-page="<?php echo esc_attr( $heaven11_ppp ); ?>"
					data-post-type="<?php echo esc_attr( $heaven11_post_type ); ?>"
					data-taxonomy="<?php echo esc_attr( $heaven11_taxonomy ); ?>"
					data-cat="<?php echo esc_attr( $heaven11_id ); ?>"
					data-parent-cat="<?php echo esc_attr( $heaven11_cat ); ?>"
					data-need-content="<?php echo ( false === $heaven11_portfolio_need_content ? 'true' : 'false' ); ?>"
				>
					<?php
					if ( $heaven11_portfolio_need_content ) {
						heaven11_show_portfolio_posts(
							array(
								'cat'        => $heaven11_id,
								'parent_cat' => $heaven11_cat,
								'taxonomy'   => $heaven11_taxonomy,
								'post_type'  => $heaven11_post_type,
								'page'       => 1,
								'sticky'     => $heaven11_sticky_out,
							)
						);
					}
					?>
				</div>
				<?php
			}
			?>
		</div>
		<?php
	} else {
		heaven11_show_portfolio_posts(
			array(
				'cat'        => $heaven11_cat,
				'parent_cat' => $heaven11_cat,
				'taxonomy'   => $heaven11_taxonomy,
				'post_type'  => $heaven11_post_type,
				'page'       => 1,
				'sticky'     => $heaven11_sticky_out,
			)
		);
	}

	heaven11_blog_archive_end();

} else {

	if ( is_search() ) {
		get_template_part( apply_filters( 'heaven11_filter_get_template_part', 'content', 'none-search' ), 'none-search' );
	} else {
		get_template_part( apply_filters( 'heaven11_filter_get_template_part', 'content', 'none-archive' ), 'none-archive' );
	}
}

get_footer();
