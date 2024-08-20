<?php
/**
 * The template's part to display the agent's or author's contact form
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.6.22
 */

$trx_addons_args = get_query_var('trx_addons_args_properties_form');
$trx_addons_meta = $trx_addons_args['meta'];
$trx_addons_agent = $trx_addons_args['agent'];

$form_style = $trx_addons_args['style'] = empty($trx_addons_args['style']) || trx_addons_is_inherit($trx_addons_args['style']) 
					? trx_addons_get_option('input_hover') 
					: $trx_addons_args['style'];

?><div class="sc_form properties_page_agent_form">
	<h6 class="properties_page_agent_form_title"><?php printf(esc_html__('Contact %s', 'heaven11'), $trx_addons_agent['name']); ?></h6><?php
	if ( (int) ($form_id = trx_addons_get_option('agents_form')) > 0 ) {
		// Add filter 'wpcf7_form_elements' before Contact Form 7 show form to add text

		
		// Store property and agent's data for the form for 4 hours
		set_transient(sprintf('trx_addons_cf7_%d_data', $form_id), array(
													'item'  => is_single() && get_post_type()==TRX_ADDONS_CPT_PROPERTIES_PT ? get_the_ID() : '',
													'agent' => $trx_addons_meta['agent_type']=='author' ? -get_the_author_meta('ID') : $trx_addons_meta['agent']
													), 4 * 60 * 60);

		// Display Contact Form 7
		trx_addons_show_layout(do_shortcode('[contact-form-7 id="'.esc_attr($form_id).'"]'));



	} else {
		// Default form
		?><form class="sc_form_form <?php
					if ($form_style != 'default') echo 'sc_input_hover_'.esc_attr($form_style);
					?>" method="post" action="<?php echo admin_url('admin-ajax.php'); ?>">
			<input type="hidden" name="property_agent" value="<?php
					echo esc_attr($trx_addons_meta['agent_type']=='author' ? -get_the_author_meta('ID') : $trx_addons_meta['agent']); ?>">
			<input type="hidden" name="property_id" value="<?php
					echo esc_attr(is_single() && get_post_type()==TRX_ADDONS_CPT_PROPERTIES_PT ? get_the_ID() : ''); ?>">
			<?php
			// Field 'Name'
			trx_addons_get_template_part(TRX_ADDONS_PLUGIN_SHORTCODES . 'form/tpl.form-field.php',
											'trx_addons_args_sc_form_field',
											array_merge($trx_addons_args, array(
														'field_name'  => 'name',
														'field_type'  => 'text',
														'field_req'   => true,
														'field_icon'  => 'trx_addons_icon-user-alt',
														'field_title' => esc_html__('Name', 'heaven11'),
														'field_placeholder' => esc_attr__('Enter your name', 'heaven11')
														))
										);
			// Field 'E-mail'
			trx_addons_get_template_part(TRX_ADDONS_PLUGIN_SHORTCODES . 'form/tpl.form-field.php',
											'trx_addons_args_sc_form_field',
											array_merge($trx_addons_args, array(
														'field_name'  => 'email',
														'field_type'  => 'text',
														'field_req'   => true,
														'field_icon'  => 'trx_addons_icon-mail',
														'field_title' => esc_html__('E-mail', 'heaven11'),
														'field_placeholder' => esc_attr__('Enter your email', 'heaven11')
														))
										);
			// Field 'Phone'
			trx_addons_get_template_part(TRX_ADDONS_PLUGIN_SHORTCODES . 'form/tpl.form-field.php',
											'trx_addons_args_sc_form_field',
											array_merge($trx_addons_args, array(
														'field_name'  => 'phone',
														'field_type'  => 'text',
														'field_req'   => true,
														'field_icon'  => 'trx_addons_icon-phone',
														'field_title' => esc_html__('Phone', 'heaven11'),
														'field_placeholder' => esc_attr__('Enter your phone', 'heaven11')
														))
										);
			// Field 'Message'
			trx_addons_get_template_part(TRX_ADDONS_PLUGIN_SHORTCODES . 'form/tpl.form-field.php',
											'trx_addons_args_sc_form_field',
											array_merge($trx_addons_args, array(
														'field_name'  => 'message',
														'field_type'  => 'textarea',
														'field_req'   => true,
														'field_icon'  => 'trx_addons_icon-feather',
														'field_title' => esc_html__('Message', 'heaven11'),
														'field_placeholder' => esc_attr__('Enter your message', 'heaven11')
														))
										);
			?>
			<div class="sc_form_field sc_form_field_button"><button><?php esc_html_e('Send Message', 'heaven11'); ?></button></div>
			<div class="trx_addons_message_box sc_form_result"></div>
		</form><?php
	}
?></div><!-- /.sc_form -->