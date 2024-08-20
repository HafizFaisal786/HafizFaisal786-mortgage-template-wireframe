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
			.trx_addons_accent_bg {
				color: {$colors['text']};
			}
			dt, b, strong, em, mark, ins {
				color: {$colors['text']};
			}
			table th, table th a {
				background-color: {$colors['text_hover']};
			}
			table td, table th + td, table td + td {
			    color: {$colors['text']};
			}
			.sc_item_descr blockquote:before {
				color: {$colors['text_link']} !important;
			}
			.sc_table_alter table>tbody>tr:nth-child(2n+1)>td {
				background-color: {$colors['alter_bd_hover']};
			}
			.sc_table_alter table>tbody>tr:nth-child(2n)>td {
				background-color: {$colors['alter_bg_hover']};
			}
			.sc_table_alter table td,
			.sc_table_alter table th + td,
			.sc_table_alter table td + td {
				color: {$colors['alter_dark']};
				border-color: {$colors['bg_color']};
			}
			.extra-row .elementor-container.elementor-column-gap-extended:before,
			.extra-row .elementor-container.elementor-column-gap-extended .elementor-row:before {
				background-color: {$colors['inverse_bd_color']};
			}

			/*Form*/
			form div:not(.sc_form_field_checkbox) label {
			    color: {$colors['text_dark']};
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

			/*Skills*/
			.sc_skills_counter .sc_skills_icon {
			    background-color: {$colors['alter_bg_hover']};
			}

			/* Price */
			.sc_price_item {
				background-color: {$colors['inverse_bd_color']};
				border-color: {$colors['inverse_bd_color']};
			}

			/*Icons*/
			.sc_icons .sc_icons_icon {
				background-color: transparent;
				color: {$colors['text_hover']};
				border-color: {$colors['text_hover']};
			}
			.sc_icons .sc_icons_item_title {
				color: {$colors['text_link']};
			}

			/*Icons alter*/
			.sc_icons_alter.sc_icons .sc_icons_char.sc_icons_icon {
			    color: {$colors['text_dark']};
			}

			/*Blog*/
			.trx_addons_audio_player.without_cover .audio_author,
			.format-audio .post_featured.without_thumb .post_audio_author {
				color: {$colors['text_hover']};
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
	            background-color: {$colors['alter_bg_hover']};
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

