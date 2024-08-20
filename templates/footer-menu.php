<?php
/**
 * The template to display menu in the footer
 *
 * @package WordPress
 * @subpackage HEAVEN11
 * @since HEAVEN11 1.0.10
 */

// Footer menu
$heaven11_menu_footer = heaven11_get_nav_menu( 'menu_footer' );
if ( ! empty( $heaven11_menu_footer ) ) {
	?>
	<div class="footer_menu_wrap">
		<div class="footer_menu_inner">
			<?php
			heaven11_show_layout(
				$heaven11_menu_footer,
				'<nav class="menu_footer_nav_area sc_layouts_menu sc_layouts_menu_default"'
					. ' itemscope itemtype="//schema.org/SiteNavigationElement"'
					. '>',
				'</nav>'
			);
			?>
		</div>
	</div>
	<?php
}
