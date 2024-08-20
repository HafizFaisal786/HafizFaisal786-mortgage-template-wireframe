<?php
/**
 * The style "classic" of the Events
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.6.51
 */

$args = get_query_var('trx_addons_args_sc_events');

$meta = get_post_meta(get_the_ID(), 'trx_addons_options', true);

if (!empty($args['slider'])) {
	?><div class="slider-slide swiper-slide"><?php
} else if ((int)$args['columns'] > 1) {
	?><div class="<?php echo esc_attr(trx_addons_get_column_class(1, $args['columns'])); ?>"><?php
}
?>
<div class="sc_events_item trx_addons_hover trx_addons_hover_style_links">
	<?php
	if (has_post_thumbnail()) {
		do_action( 'trx_addons_action_sc_events_item_before_featured', $args );
		trx_addons_get_template_part('templates/tpl.featured.php',
									'trx_addons_args_featured',
									apply_filters('trx_addons_filter_args_featured', array(
														
														'class' => 'sc_events_item_thumb',
														'post_info' => '<span class="sc_events_item_categories">'
																		. trx_addons_get_post_terms(' ', get_the_ID(), Tribe__Events__Main::TAXONOMY)
																		. '</span>',
														'thumb_size' => apply_filters('trx_addons_filter_thumb_size',
																			trx_addons_get_thumb_size(
																				(int)$args['columns'] > 2 
																					? 'event'
																					: 'big'
																			),
																			'events-'.$args['type']
																		),
														), 'events-'.$args['type'])
								);
		do_action( 'trx_addons_action_sc_events_item_after_featured', $args );
	}
	?>
	<div class="sc_events_item_info">
		<div class="sc_events_item_header">
			<div class="sc_events_item_meta">
				<span class="sc_events_item_meta_item sc_events_item_meta_date"><?php
					// Event's date
					$date = tribe_get_start_date(null, true, 'F d, Y');
					if (empty($date)) $date = get_the_date('F d, Y');
					$time = tribe_get_start_time(null, 'g:i A');
					// Event's date
					?><div class="ev-info"><span class="sc_events_item_date_wrap"><span class="sc_events_item_date"><?php echo esc_html($date); ?></span></span><?php
						// Event's time
						?><span class="sc_events_item_time_wrap"><span class="sc_events_item_time"><?php esc_html_e($time ? esc_html($time) : esc_html__('Whole day', 'heaven11')); ?></span></span></div>
					</span>
			</div>
			<h6 class="sc_events_item_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
			<?php
			if (($excerpt = get_the_excerpt()) != '') {
				?><div class="trx_addons_event_text"><?php echo esc_html($excerpt); ?></div><?php
			}
			if (!empty($args['more_text'])) {
				?><div class="trx_addons_event_links">
				<a href="<?php the_permalink(); ?>" class="sc_button sc_button_default sc_button_size_normal"><?php esc_html_e( 'get details', 'heaven11' ); ?></a>
				</div><?php
			}
			?>
		</div>
		<div class="sc_events_item_price"><?php echo tribe_get_formatted_cost(); ?></div>
	</div>
	</div>
	<?php
if (!empty($args['slider']) || (int)$args['columns'] > 1) {
	?></div><?php
}
