<?php
/**
 * The template to display Admin notices
 *
 * @package WordPress
 * @subpackage HEAVEN11
 * @since HEAVEN11 1.0.1
 */

$heaven11_theme_obj = wp_get_theme();
?>
<div class="heaven11_admin_notice heaven11_welcome_notice update-nag">
	<?php
	// Theme image
	$heaven11_theme_img = heaven11_get_file_url( 'screenshot.jpg' );
	if ( '' != $heaven11_theme_img ) {
		?>
		<div class="heaven11_notice_image"><img src="<?php echo esc_url( $heaven11_theme_img ); ?>" alt="<?php esc_attr_e( 'Theme screenshot', 'heaven11' ); ?>"></div>
		<?php
	}

	// Title
	?>
	<h3 class="heaven11_notice_title">
		<?php
		echo esc_html(
			sprintf(
				// Translators: Add theme name and version to the 'Welcome' message
				__( 'Welcome to %1$s v.%2$s', 'heaven11' ),
				$heaven11_theme_obj->name . ( HEAVEN11_THEME_FREE ? ' ' . __( 'Free', 'heaven11' ) : '' ),
				$heaven11_theme_obj->version
			)
		);
		?>
	</h3>
	<?php

	// Description
	?>
	<div class="heaven11_notice_text">
		<p class="heaven11_notice_text_description">
			<?php
			echo str_replace( '. ', '.<br>', wp_kses_data( $heaven11_theme_obj->description ) );
			?>
		</p>
		<p class="heaven11_notice_text_info">
			<?php
			echo wp_kses_data( __( 'Attention! Plugin "ThemeREX Addons" is required! Please, install and activate it!', 'heaven11' ) );
			?>
		</p>
	</div>
	<?php

	// Buttons
	?>
	<div class="heaven11_notice_buttons">
		<?php
		// Link to the page 'About Theme'
		?>
		<a href="<?php echo esc_url( admin_url() . 'themes.php?page=heaven11_about' ); ?>" class="button button-primary"><i class="dashicons dashicons-nametag"></i> 
			<?php
			echo esc_html__( 'Install plugin "ThemeREX Addons"', 'heaven11' );
			?>
		</a>
		<?php		
		// Dismiss this notice
		?>
		<a href="#" class="heaven11_hide_notice"><i class="dashicons dashicons-dismiss"></i> <span class="heaven11_hide_notice_text"><?php esc_html_e( 'Dismiss', 'heaven11' ); ?></span></a>
	</div>
</div>
