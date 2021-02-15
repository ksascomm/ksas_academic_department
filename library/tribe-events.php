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

// from https://gist.github.com/cliffordp/0d5718a259c0cf09df6c07dd1b9607eb/
// as of version 4.3
// by Brook 2016-10-19
// for https://theeventscalendar.com/support/forums/topic/unlink-venue-and-organizer/
// does NOT use tribe_get_venue_website_link or tribe_get_organizer_website_link filters.

/**
 * Remove the frontend link to the venue page when Pro is active.
 */
function tribe_remove_venue_link() {
	remove_filter( 'tribe_get_venue', array( Tribe__Events__Pro__Main::instance()->single_event_meta, 'link_venue' ) );
}
add_action( 'tribe_events_single_meta_before', 'tribe_remove_venue_link', 100 );

/**
 * Remove the frontend link to the organizer page when Pro is active.
 */
function tribe_remove_org_link( $html, $id ) {
	return tribe_get_organizer( $id );
}
add_filter( 'tribe_get_organizer_link', 'tribe_remove_org_link', 10, 2 );
