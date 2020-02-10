<?php
function delete_academic_transients($post_id) {
	global $post;
	if (isset($_GET['post_type'])) {		
		$post_type = $_GET['post_type'];
	}
	else {
		$post_type = $post->post_type;
	}
	switch($post_type) {
		case 'people' :
			$roles = get_terms('role', array(
						'orderby' 		=> 'id',
						'hide_empty'    => true,
						)); 
			foreach($roles as $role) {
			$role_slug = $role->slug;
				delete_transient('job_market_query');
				delete_transient('research_staff_query');
				delete_transient('graduate_student_query');
			}
		break;
		case 'course' :
			delete_transient('ksas_course_grad_query');
			delete_transient('ksas_course_undergrad_query');
	}
}
add_action('save_post','delete_academic_transients');

// from https://gist.github.com/cliffordp/0d5718a259c0cf09df6c07dd1b9607eb/
// as of version 4.3
// by Brook 2016-10-19
// for https://theeventscalendar.com/support/forums/topic/unlink-venue-and-organizer/
// does NOT use tribe_get_venue_website_link or tribe_get_organizer_website_link filters

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
function tribe_remove_org_link( $html, $id ){
	return tribe_get_organizer( $id );	
}
add_filter( 'tribe_get_organizer_link', 'tribe_remove_org_link', 10, 2  );

add_filter('tribe_get_event_website_link_label', 'tribe_get_event_website_link_label_default');

function tribe_get_event_website_link_label_default ($label) {
	if( $label == tribe_get_event_website_url() ) {
		$label = "Visit Event Website &raquo;";
		$class = "tribe-events-button";
	}

	return '<a class="' . $class . '" href="' . tribe_get_event_website_url() . '">' . $label . ' </a>';
}

// adds another button for agreement
remove_action( 'tribe_events_single_event_after_the_content', array( tribe( 'tec.iCal' ), 'single_event_links' ) );

add_action( 'tribe_events_single_event_after_the_content', 'customized_tribe_single_event_links' );

function customized_tribe_single_event_links()	{

	if ( is_single() && post_password_required() ) {
		return;
	}
	global $post;
  	$permalink = get_permalink($post->ID);
  	$title = get_the_title($post->ID);
	echo '<div class="tribe-events-cal-links">';
	echo '<a class="tribe-events-gcal tribe-events-button" href="' . tribe_get_gcal_link() . '" title="' . __( 'Add to Google Calendar', 'tribe-events-calendar-pro' ) . '">+ Google Calendar </a>';
    echo '<a class="tribe-events-ical tribe-events-button" href="' . tribe_get_single_ical_link() . '">+ iCal Export </a>';
    echo '<a class="tribe-events-button tribe-events-social" href="https://www.facebook.com/sharer/sharer.php?u='. urlencode( $permalink ). '">Share on Facebook</a>';
    echo '<a class="tribe-events-button tribe-events-social" href="https://twitter.com/intent/tweet?text='. urlencode( $title ). '&amp;url='. $permalink . '&amp;via=JHUArtsSciences">Share on Twitter</a>';
	echo '</div>';
}