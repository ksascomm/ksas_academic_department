<?php
/**
 * Custom functions for the block editor
 *
 * @package KSASAcademicDepartment
 * @since KSASAcademicDepartment 1.0.0
 */

/**
 * Custom Gutenberg styles
 *
 * @link https://www.billerickson.net/block-styles-in-gutenberg/
 */
function custom_gutenberg_css() {
	add_theme_support( 'editor-styles' ); // if you don't add this line, your stylesheet won't be added!
	add_editor_style( 'gutenberg-editor/editor-style.css' ); // tries to include editor-style.css directly from your theme folder..
}
add_action( 'after_setup_theme', 'custom_gutenberg_css' );

/**
 * Setting Default Blocks in the Block Editor
 *
 * @link https://theeventscalendar.com/knowledgebase/k/change-the-default-event-template-in-block-editor
 */
add_filter(
	'tribe_events_editor_default_template',
	function( $template ) {
		$template = array(
			array( 'tribe/event-datetime' ),
			array(
				'core/paragraph',
				array(
					'placeholder' => __( 'Add Event Description...', 'the-events-calendar' ),
				),
			),
			array( 'tribe/featured-image' ),
			array( 'tribe/event-venue' ),
			array(
				'tribe/event-links',
				array(
					'placeholder' => __( 'Click Me to Add Link', 'the-events-calendar' ),
				),
			),
		);
		return $template;
	},
	11,
	1
);
