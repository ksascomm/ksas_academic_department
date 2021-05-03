<?php
/**
 * Clean up WordPress defaults
 *
 * @package KSASAcademicDepartment
 * @since KSASAcademicDepartment 1.0.0
 */

if ( ! function_exists( 'ksasacademic_start_cleanup' ) ) :
	function ksasacademic_start_cleanup() {

		// Launching operation cleanup.
		add_action( 'init', 'ksasacademic_cleanup_head' );

		// Remove WP version from RSS.
		add_filter( 'the_generator', 'ksasacademic_remove_rss_version' );

		// Remove pesky injected css for recent comments widget.
		add_filter( 'wp_head', 'ksasacademic_remove_wp_widget_recent_comments_style', 1 );

		// Clean up comment styles in the head.
		add_action( 'wp_head', 'ksasacademic_remove_recent_comments_style', 1 );

	}
	add_action( 'after_setup_theme', 'ksasacademic_start_cleanup' );
endif;
/**
 * Clean up head.+
 * ----------------------------------------------------------------------------
 */

if ( ! function_exists( 'ksasacademic_cleanup_head' ) ) :
	function ksasacademic_cleanup_head() {

		// EditURI link.
		remove_action( 'wp_head', 'rsd_link' );

		// Category feed links.
		remove_action( 'wp_head', 'feed_links_extra', 3 );

		// Post and comment feed links.
		remove_action( 'wp_head', 'feed_links', 2 );

		// Windows Live Writer.
		remove_action( 'wp_head', 'wlwmanifest_link' );

		// Index link.
		remove_action( 'wp_head', 'index_rel_link' );

		// Previous link.
		remove_action( 'wp_head', 'parent_post_rel_link', 10 );

		// Start link.
		remove_action( 'wp_head', 'start_post_rel_link', 10 );

		// Canonical.
		remove_action( 'wp_head', 'rel_canonical', 10 );

		// Shortlink.
		remove_action( 'wp_head', 'wp_shortlink_wp_head', 10 );

		// Links for adjacent posts.
		remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 );
		remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10 );

		// WP version.
		remove_action( 'wp_head', 'wp_generator' );

		// Emoji detection script.
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );

		// Emoji styles.
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
	}
endif;

// Remove WP version from RSS.
if ( ! function_exists( 'ksasacademic_remove_rss_version' ) ) :
	function ksasacademic_remove_rss_version() {
		return '';
	}
endif;

// Remove injected CSS for recent comments widget.
if ( ! function_exists( 'ksasacademic_remove_wp_widget_recent_comments_style' ) ) :
	function ksasacademic_remove_wp_widget_recent_comments_style() {
		if ( has_filter( 'wp_head', 'wp_widget_recent_comments_style' ) ) {
			remove_filter( 'wp_head', 'wp_widget_recent_comments_style' );
		}
	}
endif;

// Remove injected CSS from recent comments widget.
if ( ! function_exists( 'ksasacademic_remove_recent_comments_style' ) ) :
	function ksasacademic_remove_recent_comments_style() {
		global $wp_widget_factory;
		if ( isset( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'] ) ) {
			remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
		}
	}
endif;

/** Remove jQuery Migrate */
function remove_jquery_migrate( &$scripts ) {
	if ( ! is_admin() ) {
		$scripts->remove( 'jquery' );
		$scripts->add( 'jquery', false, array( 'jquery-core' ), '1.12.4' );
	}
}
add_action( 'wp_default_scripts', 'remove_jquery_migrate' );

/** Autodirect gallery shortcode to file, not attachment page */
function my_gallery_default_type_set_link( $settings ) {
	$settings['galleryDefaults']['link'] = 'file';
	return $settings;
}
add_filter( 'media_view_settings', 'my_gallery_default_type_set_link' );


/** Remove plugin CSS on specific page types */
function dequeue_css() {
	if ( is_home() || is_front_page() ) {
		wp_dequeue_style( 'tablepress-default' );
		wp_dequeue_style( 'tablepress-responsive-tables' );
		wp_dequeue_style( 'slb_core' );
	}
	if ( is_singular( array( 'people', 'profile', 'testimonial', 'bulletinboard', 'ksasexhibits' ) ) ) {
		wp_dequeue_style( 'tablepress-default' );
		wp_dequeue_style( 'tablepress-responsive-tables' );
		wp_dequeue_style( 'widget-calendar-pro-style' );
		wp_dequeue_style( 'slb_core' );
	}
	if ( is_page_template( array( 'page-templates/people-research-staff.php', 'page-templates/graduate-student.php', 'page-templates/people-job-market-candidate' ) ) ) {
		wp_dequeue_style( 'widget-calendar-pro-style' );
		wp_dequeue_style( 'slb_core' );
	}
	if ( is_page( 'people' ) ) {
		wp_dequeue_style( 'tablepress-default' );
		wp_dequeue_style( 'tablepress-responsive-tables' );
		wp_dequeue_style( 'widget-calendar-pro-style' );
		wp_dequeue_style( 'slb_core' );
	}
}
add_action( 'wp_print_styles', 'dequeue_css', 100 );

/** Deregister Modern Tribe Styles */
add_action( 'wp_enqueue_scripts', 'deregister_tribe_styles' );

function deregister_tribe_styles() {
	if ( is_singular( array( 'people', 'profile', 'testimonial', 'bulletinboard', 'ksasexhibits' ) ) ) {
		wp_deregister_style( 'tribe-events-pro-views-v2-skeleton' );
		wp_deregister_style( 'tribe-events-pro-views-v2-full' );
		wp_deregister_style( 'tribe-events-views-v2-skeleton' );
		wp_deregister_style( 'tribe-events-views-v2-full' );
		wp_deregister_style( 'tribe-common-skeleton-style' );
		wp_deregister_style( 'tribe-common-full-style' );
		wp_deregister_style( 'tribe-common-skeleton-style' );
		wp_deregister_style( 'tribe-tooltip' );
	}
	if ( is_page_template( array( 'page-templates/people-research-staff.php', 'page-templates/graduate-student.php', 'page-templates/job-market-candidate' ) ) ) {
		wp_deregister_style( 'tribe-events-pro-views-v2-skeleton' );
		wp_deregister_style( 'tribe-events-pro-views-v2-full' );
		wp_deregister_style( 'tribe-events-views-v2-skeleton' );
		wp_deregister_style( 'tribe-events-views-v2-full' );
		wp_deregister_style( 'tribe-common-skeleton-style' );
		wp_deregister_style( 'tribe-common-full-style' );
		wp_deregister_style( 'tribe-common-skeleton-style' );
		wp_deregister_style( 'tribe-tooltip' );
	}
	if ( is_page( 'people' ) ) {
		wp_deregister_style( 'tribe-events-pro-views-v2-skeleton' );
		wp_deregister_style( 'tribe-events-pro-views-v2-full' );
		wp_deregister_style( 'tribe-events-views-v2-skeleton' );
		wp_deregister_style( 'tribe-events-views-v2-full' );
		wp_deregister_style( 'tribe-common-skeleton-style' );
		wp_deregister_style( 'tribe-common-full-style' );
		wp_deregister_style( 'tribe-common-skeleton-style' );
		wp_deregister_style( 'tribe-tooltip' );
	}
}

/** Disable/Clean Inline Styles */
function clean_post_content( $content ) {
	// Remove inline styling.
	// $content = preg_replace( '/(<[^>]+) style=".*?"/i', '$1', $content );.
	$content = preg_replace( '/(<[span>]+) style=".*?"/i', '$1', $content );
	$content = preg_replace( '/font-family\:.+?;/i', '', $content );
	$content = preg_replace( '/color\:.+?;/i', '', $content );

	// Remove font tag.
	$content = preg_replace( '/<font[^>]+>/', '', $content );

	// Remove empty tags.
	$post_cleaners = array(
		'<p></p>'             => '',
		'<p> </p>'            => '',
		'<p>&nbsp;</p>'       => '',
		'<span></span>'       => '',
		'<span> </span>'      => '',
		'<span>&nbsp;</span>' => '',
		'<span>'              => '',
		'</span>'             => '',
		'<font>'              => '',
		'</font>'             => '',
	);
	$content       = strtr( $content, $post_cleaners );

	return $content;
}
add_filter( 'the_content', 'clean_post_content' );
