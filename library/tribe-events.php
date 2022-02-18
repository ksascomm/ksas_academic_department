<?php
/**
 * Custom function for events calendar plugin
 *
 * @package KSASAcademicDepartment
 * @since KSASAcademicDepartment 1.0.0
 */

add_filter( 'tribe_get_event_website_link_label', 'tribe_get_event_website_link_label_default' );

/** Modern Tribe Events change the text from the URL to a “Visit Website” */
function tribe_get_event_website_link_label_default( $label ) {

	if ( $label === tribe_get_event_website_url() ) {
		$label = 'Visit Website';
		return $label;
	}

	return $label;
}