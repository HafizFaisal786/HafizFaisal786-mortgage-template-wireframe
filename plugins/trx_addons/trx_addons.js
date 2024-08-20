/* global jQuery:false */
/* global HEAVEN11_STORAGE:false */
/* global TRX_ADDONS_STORAGE:false */

(function() {
	"use strict";
	
	jQuery(document).on('action.add_googlemap_styles', heaven11_trx_addons_add_googlemap_styles);
	jQuery(document).on('action.init_hidden_elements', heaven11_trx_addons_init);
	
	// Add theme specific styles to the Google map
	function heaven11_trx_addons_add_googlemap_styles(e) {
		if (typeof TRX_ADDONS_STORAGE == 'undefined') return;
		TRX_ADDONS_STORAGE['googlemap_styles']['dark'] = [
			{
				"featureType": "landscape",
				"stylers": [
					{
						"hue": "#FFBB00"
					},
					{
						"saturation": 43.400000000000006
					},
					{
						"lightness": 37.599999999999994
					},
					{
						"gamma": 1
					}
				]
			},
			{
				"featureType": "road.highway",
				"stylers": [
					{
						"hue": "#FFC200"
					},
					{
						"saturation": -61.8
					},
					{
						"lightness": 45.599999999999994
					},
					{
						"gamma": 1
					}
				]
			},
			{
				"featureType": "road.arterial",
				"stylers": [
					{
						"hue": "#FF0300"
					},
					{
						"saturation": -100
					},
					{
						"lightness": 51.19999999999999
					},
					{
						"gamma": 1
					}
				]
			},
			{
				"featureType": "road.local",
				"stylers": [
					{
						"hue": "#FF0300"
					},
					{
						"saturation": -100
					},
					{
						"lightness": 52
					},
					{
						"gamma": 1
					}
				]
			},
			{
				"featureType": "water",
				"stylers": [
					{
						"hue": "#0078FF"
					},
					{
						"saturation": -13.200000000000003
					},
					{
						"lightness": 2.4000000000000057
					},
					{
						"gamma": 1
					}
				]
			},
			{
				"featureType": "poi",
				"stylers": [
					{
						"hue": "#00FF6A"
					},
					{
						"saturation": -1.0989010989011234
					},
					{
						"lightness": 11.200000000000017
					},
					{
						"gamma": 1
					}
				]
			}
		];
	}
	
	
	function heaven11_trx_addons_init(e, container) {
		if (arguments.length < 2) var container = jQuery('body');
		if (container===undefined || container.length === undefined || container.length == 0) return;
		container.find('.sc_countdown_item canvas:not(.inited)').addClass('inited').attr('data-color', HEAVEN11_STORAGE['alter_link_color']);
	}

})();