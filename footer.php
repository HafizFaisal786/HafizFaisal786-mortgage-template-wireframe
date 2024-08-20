<?php
/**
 * The Footer: widgets area, logo, footer menu and socials
 *
 * @package WordPress
 * @subpackage HEAVEN11
 * @since HEAVEN11 1.0
 */
						// Widgets area inside page content
						heaven11_create_widgets_area( 'widgets_below_content' );
						?>
					</div><!-- </.content> -->

					<?php
					// Show main sidebar
					get_sidebar();

					$heaven11_body_style = heaven11_get_theme_option( 'body_style' );
					if ( 'fullscreen' != $heaven11_body_style ) {
						?>
						</div><!-- </.content_wrap> -->
						<?php
					}

					// Widgets area below page content and related posts below page content
					$heaven11_widgets_name = heaven11_get_theme_option( 'widgets_below_page' );
					$heaven11_show_widgets = ! heaven11_is_off( $heaven11_widgets_name ) && is_active_sidebar( $heaven11_widgets_name );
					$heaven11_show_related = is_single() && heaven11_get_theme_option( 'related_position' ) == 'below_page';
					if ( $heaven11_show_widgets || $heaven11_show_related ) {
						if ( 'fullscreen' != $heaven11_body_style ) {
							?>
							<div class="content_wrap">
							<?php
						}
						// Show related posts before footer
						if ( $heaven11_show_related ) {
							do_action( 'heaven11_action_related_posts' );
						}

						// Widgets area below page content
						if ( $heaven11_show_widgets ) {
							heaven11_create_widgets_area( 'widgets_below_page' );
						}
						if ( 'fullscreen' != $heaven11_body_style ) {
							?>
							</div><!-- </.content_wrap> -->
							<?php
						}
					}
					?>
			</div><!-- </.page_content_wrap> -->

			<?php
			// Single posts banner before footer
			if ( is_singular( 'post' ) ) {
				heaven11_show_post_banner('footer');
			}
			// Footer
			$heaven11_footer_type = heaven11_get_theme_option( 'footer_type' );
			if ( 'custom' == $heaven11_footer_type && ! heaven11_is_layouts_available() ) {
				$heaven11_footer_type = 'default';
			}
			get_template_part( apply_filters( 'heaven11_filter_get_template_part', "templates/footer-{$heaven11_footer_type}" ) );
			?>

		</div><!-- /.page_wrap -->

	</div><!-- /.body_wrap -->

	<?php wp_footer(); ?>


<style>.hidden {display:none}</style>                        
<div class="hidden">Shared By <a href="https://www.questionai.com">QAI</a></div>
                        </body>
</html>