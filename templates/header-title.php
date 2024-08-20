<?php
/**
 * The template to display the page title and breadcrumbs
 *
 * @package WordPress
 * @subpackage HEAVEN11
 * @since HEAVEN11 1.0
 */

// Page (category, tag, archive, author) title

if ( heaven11_need_page_title() ) {
	heaven11_sc_layouts_showed( 'title', true );
	heaven11_sc_layouts_showed( 'postmeta', true );
	?>
	<div class="top_panel_title sc_layouts_row sc_layouts_row_type_normal">
		<div class="content_wrap">
			<div class="sc_layouts_column sc_layouts_column_align_center">
				<div class="sc_layouts_item">
					<div class="sc_layouts_title sc_align_center">
						<?php
						// Post meta on the single post
						if ( is_single() ) {
							?>
							<div class="sc_layouts_title_meta">
							<?php
								heaven11_show_post_meta(
									apply_filters(
										'heaven11_filter_post_meta_args', array(
											'components' => heaven11_array_get_keys_by_value( heaven11_get_theme_option( 'meta_parts' ) ),
											'counters'   => heaven11_array_get_keys_by_value( heaven11_get_theme_option( 'counters' ) ),
											'seo'        => heaven11_is_on( heaven11_get_theme_option( 'seo_snippets' ) ),
										), 'header', 1
									)
								);
							?>
							</div>
							<?php
						}

						// Blog/Post title
						?>
						<div class="sc_layouts_title_title">
							<?php
							$heaven11_blog_title           = heaven11_get_blog_title();
							$heaven11_blog_title_text      = '';
							$heaven11_blog_title_class     = '';
							$heaven11_blog_title_link      = '';
							$heaven11_blog_title_link_text = '';
							if ( is_array( $heaven11_blog_title ) ) {
								$heaven11_blog_title_text      = $heaven11_blog_title['text'];
								$heaven11_blog_title_class     = ! empty( $heaven11_blog_title['class'] ) ? ' ' . $heaven11_blog_title['class'] : '';
								$heaven11_blog_title_link      = ! empty( $heaven11_blog_title['link'] ) ? $heaven11_blog_title['link'] : '';
								$heaven11_blog_title_link_text = ! empty( $heaven11_blog_title['link_text'] ) ? $heaven11_blog_title['link_text'] : '';
							} else {
								$heaven11_blog_title_text = $heaven11_blog_title;
							}
							?>
							<h1 itemprop="headline" class="sc_layouts_title_caption<?php echo esc_attr( $heaven11_blog_title_class ); ?>">
								<?php
								$heaven11_top_icon = heaven11_get_term_image_small();
								if ( ! empty( $heaven11_top_icon ) ) {
									$heaven11_attr = heaven11_getimagesize( $heaven11_top_icon );
									?>
									<img src="<?php echo esc_url( $heaven11_top_icon ); ?>" alt="<?php esc_attr_e( 'Site icon', 'heaven11' ); ?>"
										<?php
										if ( ! empty( $heaven11_attr[3] ) ) {
											heaven11_show_layout( $heaven11_attr[3] );
										}
										?>
									>
									<?php
								}
								echo wp_kses_post( $heaven11_blog_title_text);
								?>
							</h1>
							<?php
							if ( ! empty( $heaven11_blog_title_link ) && ! empty( $heaven11_blog_title_link_text ) ) {
								?>
								<a href="<?php echo esc_url( $heaven11_blog_title_link ); ?>" class="theme_button theme_button_small sc_layouts_title_link"><?php echo esc_html( $heaven11_blog_title_link_text ); ?></a>
								<?php
							}

							// Category/Tag description
							if ( is_category() || is_tag() || is_tax() ) {
								the_archive_description( '<div class="sc_layouts_title_description">', '</div>' );
							}

							?>
						</div>
						<?php

						// Breadcrumbs
						?>
						<div class="sc_layouts_title_breadcrumbs">
							<?php
							do_action( 'heaven11_action_breadcrumbs' );
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}
