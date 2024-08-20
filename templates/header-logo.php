<?php
/**
 * The template to display the logo or the site name and the slogan in the Header
 *
 * @package WordPress
 * @subpackage HEAVEN11
 * @since HEAVEN11 1.0
 */

$heaven11_args = get_query_var( 'heaven11_logo_args' );

// Site logo
$heaven11_logo_type   = isset( $heaven11_args['type'] ) ? $heaven11_args['type'] : '';
$heaven11_logo_image  = heaven11_get_logo_image( $heaven11_logo_type );
$heaven11_logo_text   = heaven11_is_on( heaven11_get_theme_option( 'logo_text' ) ) ? get_bloginfo( 'name' ) : '';
$heaven11_logo_slogan = get_bloginfo( 'description', 'display' );
if ( ! empty( $heaven11_logo_image['logo'] ) || ! empty( $heaven11_logo_text ) ) {
	?><a class="sc_layouts_logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
		<?php
		if ( ! empty( $heaven11_logo_image['logo'] ) ) {
			if ( empty( $heaven11_logo_type ) && function_exists( 'the_custom_logo' ) && is_numeric( $heaven11_logo_image['logo'] ) && (int)$heaven11_logo_image['logo'] > 0 ) {
				the_custom_logo();
			} else {
				$heaven11_attr = heaven11_getimagesize( $heaven11_logo_image['logo'] );
				echo '<img src="' . esc_url( $heaven11_logo_image['logo'] ) . '"'
						. ( ! empty( $heaven11_logo_image['logo_retina'] ) ? ' srcset="' . esc_url( $heaven11_logo_image['logo_retina'] ) . ' 2x"' : '' )
						. ' alt="' . esc_attr( $heaven11_logo_text ) . '"'
						. ( ! empty( $heaven11_attr[3] ) ? ' ' . wp_kses_data( $heaven11_attr[3] ) : '' )
						. '>';
			}
		} else {
			heaven11_show_layout( heaven11_prepare_macros( $heaven11_logo_text ), '<span class="logo_text">', '</span>' );
			heaven11_show_layout( heaven11_prepare_macros( $heaven11_logo_slogan ), '<span class="logo_slogan">', '</span>' );
		}
		?>
	</a>
	<?php
}
