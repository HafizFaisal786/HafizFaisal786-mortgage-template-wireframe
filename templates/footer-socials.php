<?php
/**
 * The template to display the socials in the footer
 *
 * @package WordPress
 * @subpackage HEAVEN11
 * @since HEAVEN11 1.0.10
 */


// Socials
if ( heaven11_is_on( heaven11_get_theme_option( 'socials_in_footer' ) ) ) {
	$heaven11_output = heaven11_get_socials_links();
	if ( '' != $heaven11_output ) {
		?>
		<div class="footer_socials_wrap socials_wrap">
			<div class="footer_socials_inner">
				<?php heaven11_show_layout( $heaven11_output ); ?>
			</div>
		</div>
		<?php
	}
}
