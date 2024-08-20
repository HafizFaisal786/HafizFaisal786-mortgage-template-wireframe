<?php
/**
 * The template to display the background video in the header
 *
 * @package WordPress
 * @subpackage HEAVEN11
 * @since HEAVEN11 1.0.14
 */
$heaven11_header_video = heaven11_get_header_video();
$heaven11_embed_video  = '';
if ( ! empty( $heaven11_header_video ) && ! heaven11_is_from_uploads( $heaven11_header_video ) ) {
	if ( heaven11_is_youtube_url( $heaven11_header_video ) && preg_match( '/[=\/]([^=\/]*)$/', $heaven11_header_video, $matches ) && ! empty( $matches[1] ) ) {
		?><div id="background_video" data-youtube-code="<?php echo esc_attr( $matches[1] ); ?>"></div>
		<?php
	} else {
		?>
		<div id="background_video"><?php heaven11_show_layout( heaven11_get_embed_video( $heaven11_header_video ) ); ?></div>
		<?php
	}
}
