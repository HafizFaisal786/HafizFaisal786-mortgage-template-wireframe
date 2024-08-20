<?php
// Add skin-specific colors and fonts to the custom CSS
if ( ! function_exists( 'heaven11_skin_get_css' ) ) {
	add_filter( 'heaven11_filter_get_css', 'heaven11_skin_get_css', 10, 2 );
	function heaven11_skin_get_css( $css, $args ) {

		if ( isset( $css['fonts'] ) && isset( $args['fonts'] ) ) {
			$fonts         = $args['fonts'];
			$css['fonts'] .= <<<CSS

			/*General*/
			.sc_team_alter .sc_team_item_subtitle {
			    {$fonts['p_font-family']}
			}
			.figure figcaption, .wp-caption .wp-caption-text {
				{$fonts['h5_font-family']}
			}

CSS;
		}

		if ( isset( $css['vars'] ) && isset( $args['vars'] ) ) {
			$vars         = $args['vars'];
			$css['vars'] .= <<<CSS

CSS;
		}

		if ( isset( $css['colors'] ) && isset( $args['colors'] ) ) {
			$colors         = $args['colors'];
			$css['colors'] .= <<<CSS

			/*General*/
			dt, b, strong, em, mark, ins {
				color: {$colors['text']};
			}
			.sc_item_descr blockquote:before {
				color: {$colors['text_link']} !important;
			}
			li a {
				color: {$colors['alter_link3']};
			}
			li a:hover {
				color: {$colors['text_hover']};
			}
			table th, table th a {
				background-color: {$colors['text_link']};
			}

			/*Skills*/
			.sc_skills_counter .sc_skills_icon {
			    background-color: {$colors['inverse_light']};
			    color: {$colors['inverse_hover']};
			}

			/*Team*/
			.sc_team_alter .sc_team_item_socials .social_item .social_icon {
				color: {$colors['text_dark']};
				background-color: transparent;
				border-color: {$colors['text_dark']};
			}
			.sc_team_alter .sc_team_item_socials .social_item:hover .social_icon {
				color: {$colors['text_link']};
				background-color: transparent;
				border-color: {$colors['text_link']};
			}
			.sc_team_alter .sc_team_columns_wrap .sc_team_item {
	            background-color: {$colors['bg_color']};
			}

			/*Testimonials*/
			.sc_slider_controls.slider_pagination_style_bullets .slider_pagination_bullet,
			.slider_container .slider_pagination_wrap .swiper-pagination-bullet,
			.slider_outer .slider_pagination_wrap .swiper-pagination-bullet,
			.swiper-pagination-custom .swiper-pagination-button {
				border-color: {$colors['extra_bd_hover']};
			}

			/*Form*/
			.wpcf7-form-control-wrap.wpgdprc {
				color: {$colors['text']};
			}
			input[type="radio"] + label:before,
			input[type="checkbox"] + label:before,
			input[type="radio"] + .wpcf7-list-item-label:before,
			input[type="checkbox"] + .wpcf7-list-item-label:before,
			.wpcf7-list-item-label.wpcf7-list-item-right:before,
			.edd_price_options ul > li > label > input[type="radio"] + span:before,
			.edd_price_options ul > li > label > input[type="checkbox"] + span:before {
				border-color: {$colors['text_hover']};
			}

			/*table*/
			.sc_table_alter table>tbody>tr:nth-child(2n+1)>td {
				background-color: {$colors['alter_bg_hover']};
			}
			.sc_table_alter table>tbody>tr:nth-child(2n)>td {
				background-color: {$colors['alter_bd_hover']};
			}
			.sc_table_alter table td,
			.sc_table_alter table th + td,
			.sc_table_alter table td + td {
				color: {$colors['alter_dark']};
				border-color: {$colors['bg_color']};
			}

			/*Services*/
			.sc_services_tabs_simple .sc_services_tabs_content_item {
				background-color: {$colors['alter_dark']};
			}
			.sc_services_tabs_simple .sc_services_tabs_content_item_title {
				color: {$colors['bg_color']};
			}
			.sc_services_tabs_simple .sc_services_tabs_content_item_text {
				color: {$colors['input_bg_color']};
			}

			/*Booked*/
			body .booked-form .field label.field-label {
			    color: {$colors['inverse_hover']} !important;
			}
			body .booked-form .field input[type="text"],
			body .booked-form .field input[type="email"],
			body .booked-form .field input[type="password"] {
			    background-color: {$colors['bg_color']} !important;
			}

			/* Menu */
			.sc_layouts_menu_nav > li > a {
				color: {$colors['text_dark']};
			}
			.sc_layouts_menu_nav > li > a:hover,
			.sc_layouts_menu_nav > li.sfHover > a {
				color: {$colors['text_dark']} !important;
				border-color: {$colors['text_hover']} !important;
			}
			.sc_layouts_menu_nav > li.current-menu-item > a,
			.sc_layouts_menu_nav > li.current-menu-parent > a,
			.sc_layouts_menu_nav > li.current-menu-ancestor > a {
				color: {$colors['text_dark']} !important;
				border-color: {$colors['text_hover']} !important;
			}
			.sc_layouts_menu_nav .menu-collapse > a:before {
				color: {$colors['alter_text']};
			}
			.sc_layouts_menu_nav .menu-collapse > a:after {
				background-color: {$colors['alter_bg_color']};
			}
			.sc_layouts_menu_nav .menu-collapse > a:hover:before {
				color: {$colors['alter_link']};
			}
			.sc_layouts_menu_nav .menu-collapse > a:hover:after {
				background-color: {$colors['alter_bg_hover']};
			}

CSS;
		}

		return $css;
	}
}

