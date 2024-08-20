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
<div class="heaven11_admin_notice heaven11_rate_notice update-nag">
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
	<h3 class="heaven11_notice_title"><a href="<?php echo esc_url( heaven11_storage_get( 'theme_rate_url' ) ); ?>" target="_blank">
		<?php
		echo esc_html(
			sprintf(
				// Translators: Add theme name and version to the 'Welcome' message
				__( 'Rate our theme "%s", please', 'heaven11' ),
				$heaven11_theme_obj->name . ( HEAVEN11_THEME_FREE ? ' ' . __( 'Free', 'heaven11' ) : '' )
			)
		);
		?>
	</a></h3>
	<?php

	// Description
	?>
	<div class="heaven11_notice_text">
		<p><?php echo wp_kses_data( __( 'We are glad you chose our WP theme for your website. You’ve done well customizing your website and we hope that you’ve enjoyed working with our theme.', 'heaven11' ) ); ?></p>
		<p><?php echo wp_kses_data( __( 'It would be just awesome if you spend just a minute of your time to rate our theme or the customer service you’ve received from us.', 'heaven11' ) ); ?></p>
		<p class="heaven11_notice_text_info"><?php echo wp_kses_data( __( '* We love receiving 5-star ratings, because our CEO Henry Rise gives $5 to homeless dog shelter for every 5-star rating we get! Save the planet with us!', 'heaven11' ) ); ?></p>
	</div>
	<?php

	// Buttons
	?>
	<div class="heaven11_notice_buttons">
		<?php
		// Link to the theme download page
		?>
		<a href="<?php echo esc_url( heaven11_storage_get( 'theme_rate_url' ) ); ?>" class="button button-primary" target="_blank"><i class="dashicons dashicons-star-filled"></i> 
			<?php
			// Translators: Add theme name
			echo esc_html( sprintf( __( 'Rate theme %s', 'heaven11' ), $heaven11_theme_obj->name ) );
			?>
		</a>
		<?php
		// Link to the theme support
		?>
		<a href="<?php echo esc_url( heaven11_storage_get( 'theme_support_url' ) ); ?>" class="button" target="_blank"><i class="dashicons dashicons-sos"></i> 
			<?php
			esc_html_e( 'Support', 'heaven11' );
			?>
		</a>
		<?php
		// Link to the theme documentation
		?>
		<a href="<?php echo esc_url( heaven11_storage_get( 'theme_doc_url' ) ); ?>" class="button" target="_blank"><i class="dashicons dashicons-book"></i> 
			<?php
			esc_html_e( 'Documentation', 'heaven11' );
			?>
		</a>
		<?php
		// Dismiss
		?>
		<a href="#" class="heaven11_hide_notice"><i class="dashicons dashicons-dismiss"></i> <span class="heaven11_hide_notice_text"><?php esc_html_e( 'Dismiss', 'heaven11' ); ?></span></a>
	</div>
</div>
