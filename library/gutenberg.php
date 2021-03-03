<?php
/**
 * Custom functions for the block editor
 *
 * @package KSASAcademicDepartment
 * @since KSASAcademicDepartment 1.0.0
 */

/** Disable custom colors & font sizes. Allow align-wide */
function ksas_disable_gutenberg_colour_settings() {
	// Disable custom colors.
	add_theme_support( 'disable-custom-colors' );
	// Add foundation color palette to the editor.
	add_theme_support( 'editor-color-palette' );

	// Set normal font size.
	add_theme_support(
		'editor-font-sizes',
		array(
			array(
				'name'      => __( 'Normal', 'ksasacademic' ),
				'shortName' => __( 'N', 'ksasacademic' ),
				'size'      => 18,
				'slug'      => 'normal',
			),
		)
	);

	// Disable custom font sizing.
	add_theme_support( 'disable-custom-font-sizes' );

	// Enable widge alignments.
	add_theme_support( 'align-wide' );

}
add_action( 'after_setup_theme', 'ksas_disable_gutenberg_colour_settings' );

/**
 * Custom Gutenberg scripts
 *
 * @link https://www.billerickson.net/block-styles-in-gutenberg/
 */
function custom_gutenberg_scripts() {
	wp_enqueue_script(
		'custom-editor',
		get_stylesheet_directory_uri() . '/gutenberg-editor/editor.js',
		array( 'wp-blocks', 'wp-dom' ),
		filemtime( get_stylesheet_directory() . '/gutenberg-editor/editor.js' ),
		true
	);
}
add_action( 'enqueue_block_editor_assets', 'custom_gutenberg_scripts' );

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
			array( 'tribe/event-organizer' ),
			array( 'tribe/event-category' ),
			array( 'tribe/event-links',
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
