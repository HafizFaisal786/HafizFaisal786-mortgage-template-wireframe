<div class="front_page_section front_page_section_about<?php
	$heaven11_scheme = heaven11_get_theme_option( 'front_page_about_scheme' );
	if ( ! heaven11_is_inherit( $heaven11_scheme ) ) {
		echo ' scheme_' . esc_attr( $heaven11_scheme );
	}
	echo ' front_page_section_paddings_' . esc_attr( heaven11_get_theme_option( 'front_page_about_paddings' ) );
?>"
		<?php
		$heaven11_css      = '';
		$heaven11_bg_image = heaven11_get_theme_option( 'front_page_about_bg_image' );
		if ( ! empty( $heaven11_bg_image ) ) {
			$heaven11_css .= 'background-image: url(' . esc_url( heaven11_get_attachment_url( $heaven11_bg_image ) ) . ');';
		}
		if ( ! empty( $heaven11_css ) ) {
			echo ' style="' . esc_attr( $heaven11_css ) . '"';
		}
		?>
>
<?php
	// Add anchor
	$heaven11_anchor_icon = heaven11_get_theme_option( 'front_page_about_anchor_icon' );
	$heaven11_anchor_text = heaven11_get_theme_option( 'front_page_about_anchor_text' );
if ( ( ! empty( $heaven11_anchor_icon ) || ! empty( $heaven11_anchor_text ) ) && shortcode_exists( 'trx_sc_anchor' ) ) {
	echo do_shortcode(
		'[trx_sc_anchor id="front_page_section_about"'
									. ( ! empty( $heaven11_anchor_icon ) ? ' icon="' . esc_attr( $heaven11_anchor_icon ) . '"' : '' )
									. ( ! empty( $heaven11_anchor_text ) ? ' title="' . esc_attr( $heaven11_anchor_text ) . '"' : '' )
									. ']'
	);
}
?>
	<div class="front_page_section_inner front_page_section_about_inner
	<?php
	if ( heaven11_get_theme_option( 'front_page_about_fullheight' ) ) {
		echo ' heaven11-full-height sc_layouts_flex sc_layouts_columns_middle';
	}
	?>
			"
			<?php
			$heaven11_css           = '';
			$heaven11_bg_mask       = heaven11_get_theme_option( 'front_page_about_bg_mask' );
			$heaven11_bg_color_type = heaven11_get_theme_option( 'front_page_about_bg_color_type' );
			if ( 'custom' == $heaven11_bg_color_type ) {
				$heaven11_bg_color = heaven11_get_theme_option( 'front_page_about_bg_color' );
			} elseif ( 'scheme_bg_color' == $heaven11_bg_color_type ) {
				$heaven11_bg_color = heaven11_get_scheme_color( 'bg_color', $heaven11_scheme );
			} else {
				$heaven11_bg_color = '';
			}
			if ( ! empty( $heaven11_bg_color ) && $heaven11_bg_mask > 0 ) {
				$heaven11_css .= 'background-color: ' . esc_attr(
					1 == $heaven11_bg_mask ? $heaven11_bg_color : heaven11_hex2rgba( $heaven11_bg_color, $heaven11_bg_mask )
				) . ';';
			}
			if ( ! empty( $heaven11_css ) ) {
				echo ' style="' . esc_attr( $heaven11_css ) . '"';
			}
			?>
	>
		<div class="front_page_section_content_wrap front_page_section_about_content_wrap content_wrap">
			<?php
			// Caption
			$heaven11_caption = heaven11_get_theme_option( 'front_page_about_caption' );
			if ( ! empty( $heaven11_caption ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				?>
				<h2 class="front_page_section_caption front_page_section_about_caption front_page_block_<?php echo ! empty( $heaven11_caption ) ? 'filled' : 'empty'; ?>"><?php echo wp_kses(( $heaven11_caption ), 'heaven11_kses_content'); ?></h2>
				<?php
			}

			// Description (text)
			$heaven11_description = heaven11_get_theme_option( 'front_page_about_description' );
			if ( ! empty( $heaven11_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				?>
				<div class="front_page_section_description front_page_section_about_description front_page_block_<?php echo ! empty( $heaven11_description ) ? 'filled' : 'empty'; ?>"><?php echo wp_kses( wpautop( $heaven11_description ), 'heaven11_kses_content' ) ?></div>
				<?php
			}

			// Content
			$heaven11_content = heaven11_get_theme_option( 'front_page_about_content' );
			if ( ! empty( $heaven11_content ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				?>
				<div class="front_page_section_content front_page_section_about_content front_page_block_<?php echo ! empty( $heaven11_content ) ? 'filled' : 'empty'; ?>">
				<?php
					$heaven11_page_content_mask = '%%CONTENT%%';
				if ( strpos( $heaven11_content, $heaven11_page_content_mask ) !== false ) {
					$heaven11_content = preg_replace(
						'/(\<p\>\s*)?' . $heaven11_page_content_mask . '(\s*\<\/p\>)/i',
						sprintf(
							'<div class="front_page_section_about_source">%s</div>',
							apply_filters( 'the_content', get_the_content() )
						),
						$heaven11_content
					);
				}
					heaven11_show_layout( $heaven11_content );
				?>
				</div>
				<?php
			}
			?>
		</div>
	</div>
</div>
