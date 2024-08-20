<?php
// Add plugin-specific colors and fonts to the custom CSS
if ( ! function_exists( 'heaven11_tribe_events_get_css' ) ) {
	add_filter( 'heaven11_filter_get_css', 'heaven11_tribe_events_get_css', 10, 2 );
	function heaven11_tribe_events_get_css( $css, $args ) {
		if ( isset( $css['fonts'] ) && isset( $args['fonts'] ) ) {
			$fonts         = $args['fonts'];
			$css['fonts'] .= <<<CSS

.tribe-events-content li,
.tribe-events-content p,
.tribe-events-content {
	{$fonts['p_font-size']}
	{$fonts['p_font-weight']}
}

.tribe-events-list .tribe-events-list-event-title {
	{$fonts['h3_font-family']}
}

.tribe-events-content li,
.tribe-events-content p,
.tribe-events-content,
.tribe-common.tribe-events .tribe-events-c-view-selector__list-item-text,
.tribe-common--breakpoint-medium.tribe-common.tribe-events .tribe-common-form-control-text__input,
.tribe-common.tribe-events .tribe-common-form-control-text__input,
.tribe-events .tribe-events-calendar-month__calendar-event-tooltip-datetime,
.tribe-events .tribe-events-calendar-list__event-date-tag-weekday,
.tribe-common .tribe-common-h1, .tribe-common .tribe-common-h2,
.tribe-common .tribe-common-h3, .tribe-common .tribe-common-h4,
.tribe-common .tribe-common-h5, .tribe-common .tribe-common-h6,
.tribe-common .tribe-common-h7, .tribe-common .tribe-common-h8,
.tribe-common .tribe-common-b1, .tribe-common .tribe-common-b2,
.tribe-common .tribe-common-b3, .tribe-common .tribe-common-b4,
.tribe-common .tribe-common-b5, .tribe-common .tribe-common-b6,
.tribe-common .tribe-common-b7, .tribe-common .tribe-common-b8,
.tribe-events .datepicker .month,
.tribe-events .datepicker .year,
.tribe-events .datepicker .datepicker-switch {
	{$fonts['p_font-family']}
}
.tribe-events .tribe-events-c-subscribe-dropdown .tribe-events-c-subscribe-dropdown__button .tribe-events-c-subscribe-dropdown__button-text,
.tribe-common--breakpoint-medium.tribe-common .tribe-common-c-btn-border-small,
.tribe-common--breakpoint-medium.tribe-common a.tribe-common-c-btn-border-small,
#tribe-events .tribe-events-button,
.tribe-common--breakpoint-medium.tribe-events .tribe-events-c-search__button,
.tribe-common--breakpoint-medium.tribe-common .tribe-common-h3, .tribe-events-header .tribe-common-h3.tribe-events-c-top-bar__datepicker-button,
.tribe-common--breakpoint-medium.tribe-common .tribe-common-c-btn-border-small, .tribe-common--breakpoint-medium.tribe-common a.tribe-common-c-btn-border-small,
.tribe-events-button,
.tribe-events-cal-links a,
.tribe-events-sub-nav li a,
.tribe-common--breakpoint-medium.tribe-common .tribe-common-b1--min-medium,
.tribe-events .tribe-events-c-nav__next,
.tribe-events .tribe-events-c-nav__prev,
.tribe-events .tribe-events-c-ical__link,
.tribe-events-cal-links .tribe-events-gcal.tribe-events-button,
.tribe-events-cal-links .tribe-events-ical.tribe-events-button {
	{$fonts['button_font-family']}
	{$fonts['button_font-size']}
	{$fonts['button_font-weight']}
	{$fonts['button_font-style']}
	{$fonts['button_line-height']}
	{$fonts['button_text-decoration']}
	{$fonts['button_text-transform']}
	{$fonts['button_letter-spacing']}
}
#tribe-bar-form button, #tribe-bar-form a,
.tribe-events-read-more {
	{$fonts['button_font-family']}
	{$fonts['button_letter-spacing']}
}
.tribe-events-list .tribe-events-list-separator-month,
.tribe-events-calendar thead th,
.tribe-events-schedule, .tribe-events-schedule h2,
.tribe-events-calendar td div[id*="tribe-events-daynum-"],
.tribe-events-calendar td div[id*="tribe-events-daynum-"] a {
	{$fonts['h5_font-family']}
}
#tribe-bar-form input, #tribe-events-content.tribe-events-month,
#tribe-events-content .tribe-events-calendar div[id*="tribe-events-event-"] h3.tribe-events-month-event-title,
#tribe-mobile-container .type-tribe_events,
.tribe-events-list-widget ol li .tribe-event-title {
	{$fonts['p_font-family']}
}
.tribe-events-loop .tribe-event-schedule-details,
.single-tribe_events #tribe-events-content .tribe-events-event-meta dt,
#tribe-mobile-container .type-tribe_events .tribe-event-date-start {
	{$fonts['p_font-family']};
}

CSS;
		}

		if ( isset( $css['vars'] ) && isset( $args['vars'] ) ) {
			$vars         = $args['vars'];
			$css['vars'] .= <<<CSS
#tribe-bar-form .tribe-bar-submit input[type="submit"],
#tribe-bar-form button,
#tribe-bar-form a,
#tribe-events .tribe-events-button,
#tribe-bar-views .tribe-bar-views-list,
.tribe-events-button,
.tribe-events-cal-links a,
#tribe-events-footer ~ a.tribe-events-ical.tribe-events-button,
.tribe-common--breakpoint-medium.tribe-events .tribe-events-c-search__button,
.tribe-events-sub-nav li a {
	-webkit-border-radius: {$vars['rad']};
	    -ms-border-radius: {$vars['rad']};
			border-radius: {$vars['rad']};
}

.tribe-common .tribe-common-c-btn,
.tribe-common .tribe-common-c-btn:focus,
.tribe-common .tribe-common-c-btn:hover,
.tribe-common a.tribe-common-c-btn,
.tribe-common a.tribe-common-c-btn:focus,
.tribe-common a.tribe-common-c-btn:hover,
.tribe-common button.tribe-common-c-btn,
.tribe-common button.tribe-common-c-btn:focus,
.tribe-common button.tribe-common-c-btn:hover {
	-webkit-border-radius: {$vars['rad']};
	    -ms-border-radius: {$vars['rad']};
			border-radius: {$vars['rad']};
}

CSS;
		}

		if ( isset( $css['colors'] ) && isset( $args['colors'] ) ) {
			$colors         = $args['colors'];
			$css['colors'] .= <<<CSS

.tribe-events-content li,
.tribe-events-content p,
.tribe-events-content {
	color: {$colors['text']};
}
/* Filters bar */
#tribe-bar-form {
	color: {$colors['text_dark']};
}
#tribe-bar-form input[type="text"],
#tribe-bar-form .tribe-bar-views-toggle {
	color: {$colors['input_text']};
	border-color: {$colors['input_bg_color']} !important;
	background: {$colors['input_bg_color']};
}
#tribe-bar-form input[type="text"]:hover,
#tribe-bar-form .tribe-bar-views-toggle:hover {
	color: {$colors['input_text']};
	border-color: {$colors['input_bd_hover']} !important;
	background: {$colors['input_bg_hover']};
}
#tribe-bar-views-toggle:after,
#tribe-bar-collapse-toggle span.tribe-bar-toggle-arrow:after {
    border-top-color: {$colors['text_hover']} !important;
}
.tribe-bar-views-open #tribe-bar-views-toggle:after {
    border-bottom-color: {$colors['text_hover']} !important;
    border-top-color: transparent !important;
}
#tribe-bar-views li.tribe-bar-views-option {
    color: {$colors['input_text']};
	background: {$colors['input_bg_hover']};
	border-color: {$colors['input_bg_color']} !important;
}
#tribe-bar-views li.tribe-bar-views-option:hover,
#tribe-bar-views .tribe-bar-views-list .tribe-bar-views-option.tribe-bar-active {
    color: {$colors['input_text']} !important;
	background: {$colors['alter_hover3']} !important;
}
.tribe-events-notices strong {
    color: {$colors['inverse_hover']};
}

.tribe-events .tribe-events-c-nav__next.sc_button_hover_slide_left[disabled],
.tribe-events .tribe-events-c-nav__prev.sc_button_hover_slide_left[disabled],
.tribe-events .tribe-events-c-nav__next.sc_button_hover_slide_left[disabled]:hover,
.tribe-events .tribe-events-c-nav__prev.sc_button_hover_slide_left[disabled]:hover {
    background: {$colors['text_light']} !important;
}


.datepicker thead tr:first-child th:hover, .datepicker tfoot tr th:hover {
	color: {$colors['text_link']};
	background: {$colors['text_dark']};
}

/* Content */
.tribe-events .datepicker .day.active, 
.tribe-events .datepicker .day.active.focused, 
.tribe-events .datepicker .day.active:focus, 
.tribe-events .datepicker .day.active:hover, 
.tribe-events .datepicker th:hover, 
.tribe-events .datepicker th a:hover,
.tribe-events .datepicker .day.focused,
.tribe-events .datepicker .day:focus, 
.tribe-events .datepicker .day:hover {
	background-color: {$colors['text_hover']};
}
.tribe-events .datepicker .month.focused, 
.tribe-events .datepicker .month:focus, 
.tribe-events .datepicker .month:hover, 
.tribe-events .datepicker .year.focused, 
.tribe-events .datepicker .year:focus, 
.tribe-events .datepicker .year:hover,
.tribe-events .datepicker .month.active, 
.tribe-events .datepicker .month.active.focused, 
.tribe-events .datepicker .month.active:focus, 
.tribe-events .datepicker .month.active:hover, 
.tribe-events .datepicker .year.active, 
.tribe-events .datepicker .year.active.focused, 
.tribe-events .datepicker .year.active:focus, 
.tribe-events .datepicker .year.active:hover {
	color: {$colors['extra_dark']} !important;
	background-color: {$colors['text_hover']};
}

.tribe-events-calendar thead th {
	color: {$colors['text_dark']};
	background: {$colors['bg_color']} !important;
}
.tribe-events-calendar thead th + th:before {
	background: {$colors['extra_dark']};
}
#tribe-events-content .tribe-events-calendar td,
#tribe-events-content .tribe-events-calendar th {
	border-color: {$colors['bg_color']} !important;
}
#tribe-events-content .tribe-events-calendar td {
	background: {$colors['alter_bg_hover']} !important;
}
.tribe-events-calendar td div[id*="tribe-events-daynum-"],
.tribe-events-calendar td div[id*="tribe-events-daynum-"] > a {
	color: {$colors['text_link']};
}
.tribe-events-calendar td.tribe-events-othermonth {
	color: {$colors['alter_light']};
	background: {$colors['alter_bg_hover']} !important;
}
.tribe-events-calendar td.tribe-events-othermonth div[id*="tribe-events-daynum-"],
.tribe-events-calendar td.tribe-events-othermonth div[id*="tribe-events-daynum-"] > a {
	color: {$colors['alter_light']};
}
.tribe-events-calendar td.tribe-events-past div[id*="tribe-events-daynum-"], .tribe-events-calendar td.tribe-events-past div[id*="tribe-events-daynum-"] > a {
	color: {$colors['text_light']};
}
.tribe-events-calendar td.tribe-events-present {
    background-color: {$colors['bg_color']};
}
.tribe-events-calendar td.tribe-events-present div[id*="tribe-events-daynum-"],
.tribe-events-calendar td.tribe-events-present div[id*="tribe-events-daynum-"] > a {
	color: {$colors['text_hover']};
}
.tribe-events-calendar td.tribe-events-present:before {
	border-color: {$colors['text_hover']};
}
.tribe-events-calendar .tribe-events-has-events:after {
	background-color: {$colors['text']};
}
.tribe-common .tribe-events-calendar-day__event-details .tribe-common-b2,
.tribe-common .tribe-common-anchor-thin,
.tribe-common .tribe-common-h7,
.tribe-common .tribe-common-b2,
.tribe-events .tribe-events-calendar-list__event-date-tag-weekday,
.tribe-common .tribe-common-h4,
.tribe-common .tribe-common-h4 a,
.tribe-events .tribe-events-calendar-month__header-column-title {
	color: {$colors['text_dark']};
}
.tribe-common .tooltipster-content .tribe-common-anchor-thin {
	color: {$colors['inverse_dark']};
}
.tribe-common .tribe-events-calendar-list__event-date-tag .tribe-events-calendar-list__event-date-tag-daynum {
	color: {$colors['text_link']};
}
.tribe-common .tribe-common-anchor-thin:hover {
	color: {$colors['text_hover']};
}
.tribe-events-calendar .mobile-active.tribe-events-has-events:after {
	background-color: {$colors['bg_color']};
}
#tribe-events-content .tribe-events-calendar td,
#tribe-events-content .tribe-events-calendar div[id*="tribe-events-event-"] h3.tribe-events-month-event-title a {
	color: {$colors['text_dark']};
}
#tribe-events-content .tribe-events-calendar div[id*="tribe-events-event-"] h3.tribe-events-month-event-title a:hover {
	color: {$colors['text_link']};
}
#tribe-events-content .tribe-events-calendar td.mobile-active,
#tribe-events-content .tribe-events-calendar td.mobile-active:hover {
	color: {$colors['text_hover']};
	background-color: {$colors['bg_color']};
}
#tribe-events-content .tribe-events-calendar td.mobile-active div[id*="tribe-events-daynum-"] {
	color: {$colors['text_hover']};
	background-color: {$colors['bg_color']};
}
#tribe-events-content .tribe-events-calendar td.tribe-events-othermonth.mobile-active div[id*="tribe-events-daynum-"] a,
.tribe-events-calendar .mobile-active div[id*="tribe-events-daynum-"] a {
	background-color: transparent;
	color: {$colors['bg_color']};
}
.events-archive.events-gridview #tribe-events-content table .type-tribe_events {
	border-color: {$colors['bd_color']};
}

/* Tooltip */
.recurring-info-tooltip,
.tribe-events-calendar .tribe-events-tooltip,
.tribe-events-week .tribe-events-tooltip,
.tribe-events-shortcode.view-week .tribe-events-tooltip,
.tribe-events-tooltip .tribe-events-arrow {
	color: {$colors['alter_text']};
	background: {$colors['alter_bg_color']};
	border-color: {$colors['alter_bd_color']};
}
#tribe-events-content .tribe-events-tooltip .summary { 
	color: {$colors['extra_dark']};
	background: {$colors['extra_bg_color']};
}
.tribe-events-tooltip .tribe-event-duration {
	color: {$colors['extra_dark']};
}

.tribe-events .datepicker .month,
.tribe-events .datepicker .year,
.tribe-events .datepicker .month.active,
.tribe-events .datepicker .month.active.focused {
	color: {$colors['text_dark']};
}

/* Events list */
.tribe-events-list-separator-month {
	color: {$colors['text_dark']};
}
.tribe-events-list-separator-month:after {
	border-color: {$colors['bd_color']};
}
.tribe-events-list .type-tribe_events + .type-tribe_events,
.tribe-events-day .tribe-events-day-time-slot + .tribe-events-day-time-slot + .tribe-events-day-time-slot {
	border-color: {$colors['bd_color']};
}
.tribe-events-list-separator-month span {
	background-color: {$colors['bg_color']};	
}
.tribe-events-list .tribe-events-event-cost span {
	color: {$colors['extra_dark']};
	border-color: {$colors['extra_bg_color']};
	background: {$colors['extra_bg_color']};
}
.tribe-mobile .tribe-events-loop .tribe-events-event-meta {
	color: {$colors['alter_text']};
	border-color: {$colors['alter_bd_color']};
	background-color: {$colors['alter_bg_color']};
}
.tribe-mobile .tribe-events-loop .tribe-events-event-meta a {
	color: {$colors['alter_link']};
}
.tribe-mobile .tribe-events-loop .tribe-events-event-meta a:hover {
	color: {$colors['alter_hover']};
}
.tribe-events .tribe-events-c-top-bar__nav-link[disabled] {
	background-color: {$colors['alter_light']}!important;
}

.tribe-events-c-top-bar__nav-list .tribe-events-c-top-bar__nav-list-item .tribe-common-c-btn-icon[disabled] {
	background-color: transparent !important;
	background: transparent !important;
}
.tribe-events-c-top-bar__nav-list .tribe-events-c-top-bar__nav-list-item .tribe-common-c-btn-icon {
	color: {$colors['text_dark']};
}
.tribe-events-c-top-bar__nav-list .tribe-events-c-top-bar__nav-list-item .tribe-common-c-btn-icon:hover {
	color: {$colors['text_link']};
}
.tribe-mobile .tribe-events-list .tribe-events-venue-details {
	border-color: {$colors['alter_bd_color']};
}

.sc_events_classic .sc_events_item_date:before,
.sc_events_classic .sc_events_item_time:before {
    color: {$colors['text_hover']};
}

.single-tribe_events #tribe-events-footer,
.tribe-events-day #tribe-events-footer,
.events-list #tribe-events-footer,
.tribe-events-map #tribe-events-footer,
.tribe-events-photo #tribe-events-footer {
	border-color: {$colors['bd_color']};	
}

/* Events day */
.tribe-events-day .tribe-events-day-time-slot h5,
.tribe-events-day .tribe-events-day-time-slot .tribe-events-day-time-slot-heading {
	color: {$colors['extra_dark']};
	background: {$colors['extra_bg_color']};
}
.tribe-events-header .tribe-common-h3.tribe-events-c-top-bar__datepicker-button svg path {
	fill: {$colors['inverse_link']};
}
.tribe-events .tribe-events-c-view-selector__button svg path, 
.tribe-events .tribe-events-c-events-bar__search-button svg path {
	fill: {$colors['text_dark']};
}
.tribe-events .tribe-events-c-view-selector__button:hover svg path, 
.tribe-events .tribe-events-c-events-bar__search-button:hover svg path {
	fill: {$colors['text_hover']};
}

/* Single Event */
.single-tribe_events .tribe-events-venue-map {
	color: {$colors['alter_text']};
	border-color: {$colors['alter_bd_hover']};
	background: {$colors['alter_bg_hover']};
}
.single-tribe_events .tribe-events-schedule .tribe-events-cost {
	color: {$colors['text_dark']};
}
.single-tribe_events .type-tribe_events {
	border-color: {$colors['bd_color']};
}

.tribe-common .tribe-common-c-loader .tribe-common-c-loader__dot {
    background-color: {$colors['text_link']};
}

.tribe-events .datepicker th,
.tribe-events .datepicker th a {
    color: {$colors['extra_dark']};
    background-color: {$colors['extra_bg_color']};
}

.tribe-events .datepicker table>tbody>tr:nth-child(2n+1)>td {
    background-color: {$colors['alter_bd_hover']};
}

.tribe-events .datepicker table>tbody>tr:nth-child(2n)>td {
    background-color: {$colors['alter_bg_hover']};
}

.tribe-events .datepicker .day {
    color: {$colors['alter_dark']};
}

.tribe-events .datepicker .past {
	color: {$colors['alter_dark_05']};
}

.tribe-events .datepicker .day.active {
	background-color: {$colors['alter_bg_hover']};
}

.tribe-events .datepicker .day.active {
	color: {$colors['inverse_hover']}!important;
}

.tribe-events .datepicker table .day:hover {
	background-color: {$colors['extra_dark']};
	color: {$colors['inverse_hover']};
}

.tribe-events .tribe-events-c-search__input-control--keyword .tribe-events-c-search__input {
	color: {$colors['inverse_text']};
	border-color: {$colors['input_bd_color']};
	background-color: {$colors['extra_dark']};
}

.tribe-events input[placeholder]::placeholder {
	color: {$colors['inverse_light']};
}

.tribe-events .tribe-events-c-messages__message {
	background-color: {$colors['extra_light']};
}
.tribe-common .tribe-events-c-messages__message .tribe-common-c-svgicon,
.tribe-common .tribe-events-c-messages__message-list-item {
	color: {$colors['inverse_dark']};
}

.tribe-events .datepicker .next .tribe-events-c-top-bar__datepicker-nav-icon-svg path, 
.tribe-events .datepicker .prev .tribe-events-c-top-bar__datepicker-nav-icon-svg path {
	fill: {$colors['extra_dark']};
}
.tribe-events .datepicker th.datepicker-switch:hover {
	color: {$colors['extra_dark']} !important;
	background-color: {$colors['text_hover']};
}
.tribe-events .datepicker .next:active,
.tribe-events .datepicker .next:focus,
.tribe-events .datepicker .next:hover,
.tribe-events .datepicker .prev:active,
.tribe-events .datepicker .prev:focus,
.tribe-events .datepicker .prev:hover {
	background-color: {$colors['text_hover']};
}
.tribe-events .datepicker .next:active .tribe-events-c-top-bar__datepicker-nav-icon-svg path,
.tribe-events .datepicker .next:focus .tribe-events-c-top-bar__datepicker-nav-icon-svg path,
.tribe-events .datepicker .next:hover .tribe-events-c-top-bar__datepicker-nav-icon-svg path,
.tribe-events .datepicker .prev:active .tribe-events-c-top-bar__datepicker-nav-icon-svg path,
.tribe-events .datepicker .prev:focus .tribe-events-c-top-bar__datepicker-nav-icon-svg path,
.tribe-events .datepicker .prev:hover .tribe-events-c-top-bar__datepicker-nav-icon-svg path {
	fill: {$colors['extra_dark']};
}
.tribe-events .tribe-events-calendar-month__multiday-event-bar-inner {
	background-color: {$colors['text_hover']};
}
.tribe-events .tribe-events-calendar-month__multiday-event-bar-inner .tribe-events-calendar-month__multiday-event-bar-title {
	color: {$colors['extra_dark']} !important;
}
.tribe-events-event-meta a:focus, .tribe-events-event-meta a:hover {
	color: {$colors['text_hover']};
}

.tribe-events .tribe-events-calendar-month__day-cell--mobile.sc_button_hover_slide_left:not([class^="xdsoft_"]) {
	color: {$colors['alter_dark']} !important;
	background-color: {$colors['alter_bg_color']} !important;
	background: {$colors['alter_bg_color']} !important;
}
.tribe-events .tribe-events-calendar-month__day-cell--mobile.sc_button_hover_slide_left:not([class^="xdsoft_"]):hover {
	color: {$colors['inverse_link']} !important;
	background-color: {$colors['text_hover']} !important;
	background: {$colors['text_hover']} !important;
}

.tribe-events .tribe-events-calendar-month__day-cell--mobile {
	color: {$colors['alter_dark']} !important;
	background-color: {$colors['alter_bg_color']} !important;
	background: {$colors['alter_bg_color']} !important;
}
.tribe-events .tribe-events-calendar-month__day-cell--mobile:hover {
	color: {$colors['inverse_link']} !important;
	background-color: {$colors['text_hover']} !important;
	background: {$colors['text_hover']} !important;
}
.tribe-events .tribe-events-calendar-month__day-cell--mobile:hover .tribe-events-calendar-month__mobile-events-icon--event {
	background-color: {$colors['inverse_link']} !important;
}
.tribe-events .tribe-events-calendar-month__day-cell--mobile:hover .tribe-events-calendar-month__day-date-daynum {
	color: {$colors['inverse_link']} !important;
}
.tribe-events .tribe-events-calendar-month__mobile-events-icon--event {
	background-color: {$colors['text_link']} !important;
}

.tribe-common .tribe-common-anchor-thin-alt {
	border-color: {$colors['text_link']} !important;
}
.tribe-common .tribe-common-anchor-thin-alt:hover {
	border-color: {$colors['text_hover']} !important;
}

.tribe-events .tribe-events-c-messages__message-list-item-link {
	color: {$colors['text_link']} !important;
}
.tribe-events .tribe-events-c-messages__message-list-item-link:hover {
	color: {$colors['text_hover']} !important;
}

.tribe-events-meta-group a {
	color: {$colors['text_link']};
}
.tribe-events-meta-group a:hover {
	color: {$colors['text_hover']};
}

.tribe-events .tribe-events-calendar-month-mobile-events__mobile-event-title-link,
.tribe-events .tribe-events-calendar-month-mobile-events__mobile-event-title-link,
.tribe-events .tribe-events-calendar-month-mobile-events__mobile-event-title-link {
	color: {$colors['text_dark']};
}

.tribe-events .tribe-events-calendar-month-mobile-events__mobile-event-title-link:active,
.tribe-events .tribe-events-calendar-month-mobile-events__mobile-event-title-link:focus,
.tribe-events .tribe-events-calendar-month-mobile-events__mobile-event-title-link:hover {
	color: {$colors['text_link']};
}

CSS;
		}

		return $css;
	}
}

