<?php
/**
 * The template to display the copyright info in the footer
 *
 * @package WordPress
 * @subpackage HEAVEN11
 * @since HEAVEN11 1.0.10
 */

// Copyright area
?> 
<div class="footer_copyright_wrap
<?php
if ( ! heaven11_is_inherit( heaven11_get_theme_option( 'copyright_scheme' ) ) ) {
	echo ' scheme_' . esc_attr( heaven11_get_theme_option( 'copyright_scheme' ) );
}
?>
				">
	<div class="footer_copyright_inner">
		<div class="content_wrap">
			<div class="copyright_text">
			<?php
				$heaven11_copyright = heaven11_get_theme_option( 'copyright' );
			if ( ! empty( $heaven11_copyright ) ) {
				// Replace {{Y}} or {Y} with the current year
				$heaven11_copyright = str_replace( array( '{{Y}}', '{Y}' ), date( 'Y' ), $heaven11_copyright );
				// Replace {{...}} and ((...)) on the <i>...</i> and <b>...</b>
				$heaven11_copyright = heaven11_prepare_macros( $heaven11_copyright );
				// Display copyright
				echo wp_kses(( nl2br( $heaven11_copyright ) ), 'heaven11_kses_content');
			}
			?>
			</div>
		</div>
	</div>
</div>
