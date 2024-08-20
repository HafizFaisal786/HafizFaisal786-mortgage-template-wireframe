<?php
/**
 * The template to display the site logo in the footer
 *
 * @package WordPress
 * @subpackage HEAVEN11
 * @since HEAVEN11 1.0.10
 */

// Logo
if ( heaven11_is_on( heaven11_get_theme_option( 'logo_in_footer' ) ) ) {
	$heaven11_logo_image = heaven11_get_logo_image( 'footer' );
	$heaven11_logo_text  = get_bloginfo( 'name' );
	if ( ! empty( $heaven11_logo_image['logo'] ) || ! empty( $heaven11_logo_text ) ) {
		?>
		<div class="footer_logo_wrap">
			<div class="footer_logo_inner">
				<?php
				if ( ! empty( $heaven11_logo_image['logo'] ) ) {
					$heaven11_attr = heaven11_getimagesize( $heaven11_logo_image['logo'] );
					echo '<a href="' . esc_url( home_url( '/' ) ) . '">'
							. '<img src="' . esc_url( $heaven11_logo_image['logo'] ) . '"'
								. ( ! empty( $heaven11_logo_image['logo_retina'] ) ? ' srcset="' . esc_url( $heaven11_logo_image['logo_retina'] ) . ' 2x"' : '' )
								. ' class="logo_footer_image"'
								. ' alt="' . esc_attr__( 'Site logo', 'heaven11' ) . '"'
								. ( ! empty( $heaven11_attr[3] ) ? ' ' . wp_kses_data( $heaven11_attr[3] ) : '' )
							. '>'
						. '</a>';
				} elseif ( ! empty( $heaven11_logo_text ) ) {
					echo '<h1 class="logo_footer_text">'
							. '<a href="' . esc_url( home_url( '/' ) ) . '">'
								. esc_html( $heaven11_logo_text )
							. '</a>'
						. '</h1>';
				}
				?>
			</div>
		</div>
		<?php
	}
}
