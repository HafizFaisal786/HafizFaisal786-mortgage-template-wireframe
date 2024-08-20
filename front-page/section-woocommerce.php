<div class="front_page_section front_page_section_woocommerce<?php
	$heaven11_scheme = heaven11_get_theme_option( 'front_page_woocommerce_scheme' );
	if ( ! heaven11_is_inherit( $heaven11_scheme ) ) {
		echo ' scheme_' . esc_attr( $heaven11_scheme );
	}
	echo ' front_page_section_paddings_' . esc_attr( heaven11_get_theme_option( 'front_page_woocommerce_paddings' ) );
?>"
		<?php
		$heaven11_css      = '';
		$heaven11_bg_image = heaven11_get_theme_option( 'front_page_woocommerce_bg_image' );
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
	$heaven11_anchor_icon = heaven11_get_theme_option( 'front_page_woocommerce_anchor_icon' );
	$heaven11_anchor_text = heaven11_get_theme_option( 'front_page_woocommerce_anchor_text' );
if ( ( ! empty( $heaven11_anchor_icon ) || ! empty( $heaven11_anchor_text ) ) && shortcode_exists( 'trx_sc_anchor' ) ) {
	echo do_shortcode(
		'[trx_sc_anchor id="front_page_section_woocommerce"'
									. ( ! empty( $heaven11_anchor_icon ) ? ' icon="' . esc_attr( $heaven11_anchor_icon ) . '"' : '' )
									. ( ! empty( $heaven11_anchor_text ) ? ' title="' . esc_attr( $heaven11_anchor_text ) . '"' : '' )
									. ']'
	);
}
?>
	<div class="front_page_section_inner front_page_section_woocommerce_inner
	<?php
	if ( heaven11_get_theme_option( 'front_page_woocommerce_fullheight' ) ) {
		echo ' heaven11-full-height sc_layouts_flex sc_layouts_columns_middle';
	}
	?>
			"
			<?php
			$heaven11_css      = '';
			$heaven11_bg_mask  = heaven11_get_theme_option( 'front_page_woocommerce_bg_mask' );
			$heaven11_bg_color_type = heaven11_get_theme_option( 'front_page_woocommerce_bg_color_type' );
			if ( 'custom' == $heaven11_bg_color_type ) {
				$heaven11_bg_color = heaven11_get_theme_option( 'front_page_woocommerce_bg_color' );
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
		<div class="front_page_section_content_wrap front_page_section_woocommerce_content_wrap content_wrap woocommerce">
			<?php
			// Content wrap with title and description
			$heaven11_caption     = heaven11_get_theme_option( 'front_page_woocommerce_caption' );
			$heaven11_description = heaven11_get_theme_option( 'front_page_woocommerce_description' );
			if ( ! empty( $heaven11_caption ) || ! empty( $heaven11_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				// Caption
				if ( ! empty( $heaven11_caption ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
					?>
					<h2 class="front_page_section_caption front_page_section_woocommerce_caption front_page_block_<?php echo ! empty( $heaven11_caption ) ? 'filled' : 'empty'; ?>">
					<?php
						echo wp_kses(( $heaven11_caption ), 'heaven11_kses_content');
					?>
					</h2>
					<?php
				}

				// Description (text)
				if ( ! empty( $heaven11_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
					?>
					<div class="front_page_section_description front_page_section_woocommerce_description front_page_block_<?php echo ! empty( $heaven11_description ) ? 'filled' : 'empty'; ?>">
					<?php
						echo wp_kses( wpautop( $heaven11_description ), 'heaven11_kses_content' )
					?>
					</div>
					<?php
				}
			}

			// Content (widgets)
			?>
			<div class="front_page_section_output front_page_section_woocommerce_output list_products shop_mode_thumbs">
			<?php
				$heaven11_woocommerce_sc = heaven11_get_theme_option( 'front_page_woocommerce_products' );
			if ( 'products' == $heaven11_woocommerce_sc ) {
				$heaven11_woocommerce_sc_ids      = heaven11_get_theme_option( 'front_page_woocommerce_products_per_page' );
				$heaven11_woocommerce_sc_per_page = count( explode( ',', $heaven11_woocommerce_sc_ids ) );
			} else {
				$heaven11_woocommerce_sc_per_page = max( 1, (int) heaven11_get_theme_option( 'front_page_woocommerce_products_per_page' ) );
			}
				$heaven11_woocommerce_sc_columns = max( 1, min( $heaven11_woocommerce_sc_per_page, (int) heaven11_get_theme_option( 'front_page_woocommerce_products_columns' ) ) );
				echo do_shortcode(
					"[{$heaven11_woocommerce_sc}"
									. ( 'products' == $heaven11_woocommerce_sc
											? ' ids="' . esc_attr( $heaven11_woocommerce_sc_ids ) . '"'
											: '' )
									. ( 'product_category' == $heaven11_woocommerce_sc
											? ' category="' . esc_attr( heaven11_get_theme_option( 'front_page_woocommerce_products_categories' ) ) . '"'
											: '' )
									. ( 'best_selling_products' != $heaven11_woocommerce_sc
											? ' orderby="' . esc_attr( heaven11_get_theme_option( 'front_page_woocommerce_products_orderby' ) ) . '"'
												. ' order="' . esc_attr( heaven11_get_theme_option( 'front_page_woocommerce_products_order' ) ) . '"'
											: '' )
									. ' per_page="' . esc_attr( $heaven11_woocommerce_sc_per_page ) . '"'
									. ' columns="' . esc_attr( $heaven11_woocommerce_sc_columns ) . '"'
					. ']'
				);
				?>
			</div>
		</div>
	</div>
</div>
