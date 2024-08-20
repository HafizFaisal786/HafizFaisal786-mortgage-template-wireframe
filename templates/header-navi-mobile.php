<?php
/**
 * The template to show mobile menu
 *
 * @package WordPress
 * @subpackage HEAVEN11
 * @since HEAVEN11 1.0
 */
?>
<div class="menu_mobile_overlay"></div>
<div class="menu_mobile menu_mobile_<?php echo esc_attr( heaven11_get_theme_option( 'menu_mobile_fullscreen' ) > 0 ? 'fullscreen' : 'narrow' ); ?> scheme_dark">
	<div class="menu_mobile_inner">
		<a class="menu_mobile_close icon-cancel"></a>
		<?php

		// Logo
		set_query_var( 'heaven11_logo_args', array( 'type' => 'mobile' ) );
		get_template_part( apply_filters( 'heaven11_filter_get_template_part', 'templates/header-logo' ) );
		set_query_var( 'heaven11_logo_args', array() );

		// Mobile menu
		$heaven11_menu_mobile = heaven11_get_nav_menu( 'menu_mobile' );
		if ( empty( $heaven11_menu_mobile ) ) {
			$heaven11_menu_mobile = apply_filters( 'heaven11_filter_get_mobile_menu', '' );
			if ( empty( $heaven11_menu_mobile ) ) {
				$heaven11_menu_mobile = heaven11_get_nav_menu( 'menu_main' );
			}
			if ( empty( $heaven11_menu_mobile ) ) {
				$heaven11_menu_mobile = heaven11_get_nav_menu();
			}
		}
		if ( ! empty( $heaven11_menu_mobile ) ) {
			$heaven11_menu_mobile = str_replace(
				array( 'menu_main',   'id="menu-',        'sc_layouts_menu_nav', 'sc_layouts_menu ', 'sc_layouts_hide_on_mobile', 'hide_on_mobile' ),
				array( 'menu_mobile', 'id="menu_mobile-', '',                    ' ',                '',                          '' ),
				$heaven11_menu_mobile
			);
			if ( strpos( $heaven11_menu_mobile, '<nav ' ) === false ) {
				$heaven11_menu_mobile = sprintf( '<nav class="menu_mobile_nav_area">%s</nav>', $heaven11_menu_mobile );
			}
			heaven11_show_layout(
				apply_filters( 'heaven11_filter_menu_mobile_layout', $heaven11_menu_mobile ),
				'<nav class="menu_mobile_nav_area"'
					. ' itemscope itemtype="//schema.org/SiteNavigationElement"'
					. '>',
				'</nav>'
			);
		}

		// Search field
		do_action(
			'heaven11_action_search',
			array(
				'style' => 'normal',
				'class' => 'search_mobile',
				'ajax'  => false
			)
		);

		// Social icons
		heaven11_show_layout( heaven11_get_socials_links(), '<div class="socials_mobile">', '</div>' );
		?>
	</div>
</div>
