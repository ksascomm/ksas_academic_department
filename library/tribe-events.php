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

/** Inject the list of categories after the title */
add_action(
	'tribe_template_before_include:events/v2/list/event/venue',
	function() {
		global $post;
		$event_categories = tribe_get_event_taxonomy( $post->ID );
		?>
		<?php if ( ! empty( $event_categories ) ) : ?>
			<ul class='tribe-event-categories'>
				<?php echo tribe_get_event_taxonomy( $post->ID ); ?>
			</ul>
		<?php endif; ?>
		<?php
	}
);
