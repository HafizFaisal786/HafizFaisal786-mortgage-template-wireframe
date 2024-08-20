/* global jQuery:false */
/* global HEAVEN11_STORAGE:false */

jQuery( document ).ready(
	function() {
		setTimeout( function() {
			jQuery('.editor-block-list__layout [data-block]').addClass('scheme_' + HEAVEN11_STORAGE['color_scheme']);
		}, 100 );
	}
);

