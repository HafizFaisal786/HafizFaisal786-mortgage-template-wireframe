<?php
// Add plugin-specific colors and fonts to the custom CSS
if ( ! function_exists( 'heaven11_quickcal_get_css' ) ) {
	add_filter( 'heaven11_filter_get_css', 'heaven11_quickcal_get_css', 10, 2 );
	function heaven11_quickcal_get_css( $css, $args ) {

		if ( isset( $css['fonts'] ) && isset( $args['fonts'] ) ) {
			$fonts         = $args['fonts'];
			$css['fonts'] .= <<<CSS


.booked-calendar-wrap .booked-appt-list .timeslot .timeslot-people button,
body #booked-profile-page input[type="submit"],
body #booked-profile-page button,
body .booked-list-view input[type="submit"],
body .booked-list-view button,
body table.booked-calendar input[type="submit"],
body table.booked-calendar button,
body .booked-modal input[type="submit"],
body .booked-modal button {
	{$fonts['button_font-family']}
	{$fonts['button_font-size']}
	{$fonts['button_font-weight']}
	{$fonts['button_font-style']}
	{$fonts['button_line-height']}
	{$fonts['button_text-decoration']}
	{$fonts['button_text-transform']}
	{$fonts['button_letter-spacing']}
}

CSS;
		}

		if ( isset( $css['colors'] ) && isset( $args['colors'] ) ) {
			$colors         = $args['colors'];
			$css['colors'] .= <<<CSS

/* Form fields */
#booked-page-form {
	color: {$colors['text']};
	border-color: {$colors['bd_color']};
}

#booked-profile-page .booked-profile-header {
	background-color: {$colors['bg_color']} !important;
	border-color: transparent !important;
	color: {$colors['text']};
}
#booked-profile-page .booked-user h3 {
	color: {$colors['text_dark']};
}
#booked-profile-page .booked-profile-header .booked-logout-button:hover {
	color: {$colors['text_link']};
}

#booked-profile-page .booked-tabs {
	border-color: {$colors['alter_bd_color']} !important;
}

.booked-modal .bm-window p.booked-title-bar {
	color: {$colors['extra_dark']} !important;
	background-color: {$colors['extra_bg_hover']} !important;
}
.booked-modal .bm-window .close i {
	color: {$colors['extra_dark']};
}
.booked-modal .bm-window .close i:hover {
	color: {$colors['inverse_hover']};
}
.booked-modal .bm-window .booked-scrollable {
	color: {$colors['inverse_hover']};
}
.booked-modal .bm-window .booked-scrollable em {
	color: {$colors['extra_link']};
}
.booked-modal .bm-window #customerChoices {
	background-color: {$colors['extra_bg_hover']};
	border-color: {$colors['extra_bd_hover']};
}
.booked-form .booked-appointments {
	color: {$colors['inverse_hover']} !important;
	background-color: {$colors['inverse_link']} !important;
}
.booked-modal .bm-window p.appointment-title {
	color: {$colors['alter_dark']};	
}
body .booked-modal .bm-window a {
    color: {$colors['text_link']} !important;
}
body .booked-modal .bm-window a:hover {
    color: {$colors['text_hover']} !important;
}

/* Profile page and tabs */
.booked-calendarSwitcher.calendar,
.booked-calendarSwitcher.calendar select,
#booked-profile-page .booked-tabs {
	background-color: {$colors['alter_bg_color']} !important;
}
#booked-profile-page .booked-tabs li a {
	background-color: {$colors['inverse_hover']};
	color: {$colors['extra_dark']};
}
#booked-profile-page .booked-tabs li a i {
	color: {$colors['extra_dark']};
}
#booked-profile-page .booked-tabs li.active a,
#booked-profile-page .booked-tabs li.active a:hover,
#booked-profile-page .booked-tabs li a:hover {
	color: {$colors['extra_dark']} !important;
	background-color: {$colors['extra_bg_color']} !important;
}
#booked-profile-page .booked-tab-content {
	background-color: {$colors['bg_color']};
	border-color: {$colors['alter_bd_color']};
}

/* Calendar */
table.booked-calendar thead tr {
	background-color: {$colors['extra_bg_color']} !important;
}

table.booked-calendar thead th i {
	color: {$colors['extra_dark']} !important;
}
table.booked-calendar thead th .monthName a {
	color: {$colors['extra_dark']};
}
table.booked-calendar thead th .monthName a:hover {
	color: {$colors['inverse_hover']};
}
body table.booked-calendar td .date {
    background: transparent;
}

table.booked-calendar tbody tr {
	background-color: {$colors['alter_bg_color']} !important;
}
body div.booked-calendar-wrap div.booked-calendar .bc-body .bc-row.week .bc-col,
table.booked-calendar tbody tr td {
	color: {$colors['alter_text']} !important;
	border-color: {$colors['alter_bd_color']} !important;
}
table.booked-calendar tbody tr td:hover {
	color: {$colors['alter_dark']} !important;
}
table.booked-calendar tbody tr td.today .date {
	color: {$colors['inverse_hover']} !important;
	background-color: {$colors['alter_bg_hover']} !important;
}

table.booked-calendar tbody td.today .date span {
	border-color: {$colors['alter_hover']};
	color: {$colors['alter_hover']} !important;
}

.booked-calendar-wrap .booked-appt-list h2 {
	color: {$colors['text_dark']};
}
.booked-calendar-wrap .booked-appt-list .timeslot {
	border-color: {$colors['alter_bd_color']};	
}
.booked-calendar-wrap .booked-appt-list .timeslot .timeslot-title {
	color: {$colors['text_link']};
}
.booked-calendar-wrap .booked-appt-list .timeslot .timeslot-time {
	color: {$colors['text_dark']};
}
.booked-calendar-wrap .booked-appt-list .timeslot .spots-available {
	color: {$colors['text']};
}
body .booked-modal button.cancel,
body .booked-forgot-goback.button {
	color: {$colors['inverse_link']} !important;
	background-color: {$colors['text_hover']} !important;
}

body div.booked-calendar .bc-col:hover .date span,
#ui-datepicker-div.booked_custom_date_picker table.ui-datepicker-calendar tbody td.ui-datepicker-today a,
#ui-datepicker-div.booked_custom_date_picker table.ui-datepicker-calendar tbody td.ui-datepicker-today a:hover,
body #booked-profile-page input[type=submit].button-primary, body table.booked-calendar input[type=submit].button-primary,
body .booked-list-view button.button, body .booked-list-view input[type=submit].button-primary, body .booked-list-view button.button,
body .booked-list-view input[type=submit].button-primary, body .booked-modal input[type=submit].button-primary,
body table.booked-calendar .booked-appt-list .timeslot .timeslot-people button,
body #booked-profile-page .booked-profile-appt-list .appt-block.approved .status-block,
body #booked-profile-page .appt-block .google-cal-button > a, body .booked-modal p.booked-title-bar, body .booked-modal .bm-window p.booked-title-bar,
body table.booked-calendar td:hover .date span, body .booked-list-view a.booked_list_date_picker_trigger.booked-dp-active,
body .booked-list-view a.booked_list_date_picker_trigger.booked-dp-active:hover, .booked-ms-modal .booked-book-appt,
body .booked-modal button {
	background-color: {$colors['text_link']} !important;
}
body .booked-modal input[type=submit].button-primary:hover,
body .booked-modal button:hover,
.booked-calendar-wrap .booked-appt-list .timeslot .timeslot-people button:hover,
body table.booked-calendar button:hover {
    background-color: {$colors['text_hover']} !important;
}
body .booked-modal button.cancel:hover,
body .booked-forgot-goback.button:hover {
	color: {$colors['inverse_link']} !important;
	background-color: {$colors['text_link']} !important;
}

body div.booked-calendar-wrap .booked-appt-list .timeslot .timeslot-people button[disabled],
body div.booked-calendar-wrap .booked-appt-list .timeslot .timeslot-people button[disabled]:hover {
	color: {$colors['inverse_link']} !important;
	background-color: {$colors['text_light']} !important;	
}

/* New */

body div.booked-calendar-wrap div.booked-calendar .bc-body .bc-row.week div.bc-col {
	color: {$colors['text_dark']};
	border-color: {$colors['bd_color']};
}

body div.booked-calendar-wrap div.booked-calendar .bc-body .bc-row.week div.bc-col.next-month .date,
body div.booked-calendar-wrap div.booked-calendar .bc-body .bc-row.week div.bc-col.prev-month .date,
body div.booked-calendar-wrap div.booked-calendar .bc-body .bc-row.week div.bc-col.prev-date:hover .date,
body div.booked-calendar-wrap div.booked-calendar .bc-body .bc-row.week div.bc-col.prev-date .date {
	color: {$colors['alter_light']}!important;
}

body div.booked-calendar-wrap div.booked-calendar .bc-body .bc-row.week div.bc-col.today.active span.date,
body div.booked-calendar-wrap div.booked-calendar .bc-body .bc-row.week div.bc-col.active span.date {
	background-color: {$colors['alter_bg_hover']}!important;
}
body div.booked-calendar-wrap div.booked-calendar .bc-body .bc-row.week div.bc-col:not(.prev-date):hover span.date {
	background-color: {$colors['alter_bg_hover']}!important;
    color: {$colors['text_dark']}!important;
}

body div.booked-calendar-wrap div.booked-calendar .bc-body .bc-row.week div.bc-col.today.prev-date .date,
body div.booked-calendar-wrap div.booked-calendar .bc-body .bc-row.week div.bc-col.today .date {
	background-color: {$colors['extra_bg_color']}!important;
}

body div.booked-calendar-wrap div.booked-calendar .bc-body .bc-row.week div.bc-col.today.prev-date .date span {
    color: {$colors['extra_dark']}!important;
}
body div.booked-calendar-wrap div.booked-calendar .bc-body .bc-row.week div.bc-col.today:not(.active):not(:hover):not(.prev-date) .date span {
    color: {$colors['extra_dark']}!important;
}
body div.booked-calendar-wrap div.booked-calendar .bc-body .bc-row.entryBlock .bc-col {
	border: 20px solid {$colors['alter_bg_hover']};
}

body div.booked-calendar-wrap .booked-appt-list h2 {
	color: {$colors['text_dark']}!important;
}

body div.booked-calendar-wrap .booked-appt-list .timeslot .timeslot-time, body div.booked-calendar-wrap .booked-appt-list .timeslot .timeslot-people {
	color: {$colors['text_dark']};
}

body div.booked-calendar-wrap .booked-appt-list .timeslot .spots-available {
	color: {$colors['text_dark']};
}

body .booked-modal .bm-window p.booked-title-bar {
	background-color: {$colors['text_link']}!important;
}

body div.booked-calendar-wrap div.booked-calendar .bc-body {
	border: 1px solid {$colors['bd_color']}!important;
    margin-top: -1px;
}

body div.booked-calendar-wrap div.booked-calendar .bc-body .bc-row.week + .bc-row.week .bc-col {
	border-top: 1px solid {$colors['bd_color']};
}

body div.booked-calendar-wrap div.booked-calendar .bc-body .bc-row.week .bc-col.active .date,
body div.booked-calendar-wrap div.booked-calendar .bc-body .bc-row.week .bc-col.today:hover .date span {
	color: {$colors['text_dark']}!important;
}

body div.booked-calendar-wrap div.booked-calendar .bc-head .bc-row.top .bc-col {
	background-color: {$colors['text_link']}!important;
	border-color: {$colors['text_link']}!important;
}

body div.booked-calendar-wrap div.booked-calendar .bc-head .bc-row.days {
	color: {$colors['alter_dark']}!important;
	background: {$colors['alter_bg_color']}!important;
	border: 1px solid {$colors['bd_color']};
}

body div.booked-calendar-wrap div.booked-calendar .bc-head .bc-row.days .bc-col {
	border-color: {$colors['bd_color']}!important;
}

CSS;
		}

		return $css;
	}
}