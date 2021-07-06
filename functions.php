<?php
/**
 *
 * KSASAcademicDepartment functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @package KSASAcademicDepartment
 * @since KSASAcademicDepartment 1.0.0
 */

/** Various clean up functions */
require_once 'library/cleanup.php';

/** Required for Foundation to work properly */
require_once 'library/foundation.php';

/** Format comments */
// require_once( 'library/class-foundationpress-comments.php' );

/** Block comments & trackbacks */
require_once 'library/block-comments.php';

/** Register all navigation menus */
require_once 'library/navigation.php';

/** Custom Breadcrumb menus */
require_once 'library/breadcrumbs.php';

/** Add menu walkers for top-bar and off-canvas */
require_once 'library/class-foundationpress-top-bar-walker.php';
require_once 'library/class-foundationpress-mobile-walker.php';

/** Add menu walk for subnavigation */
require_once 'library/multi-level-sub-nav-walker.php';

/** Create widget areas in sidebar and footer */
require_once 'library/widget-areas.php';

/** Return entry meta information for posts */
require_once 'library/entry-meta.php';

/** Enqueue scripts */
require_once 'library/enqueue-scripts.php';

/** Add theme support */
require_once 'library/theme-support.php';

/** Add Nav Options to Customer */
require_once 'library/custom-nav.php';

/** Change WP's sticky post class */
require_once 'library/sticky-posts.php';

/** Configure responsive image sizes */
require_once 'library/responsive-images.php';

/** Theme support options */
require_once 'library/directory.php';
require_once 'library/transients.php';
require_once 'library/theme-options.php';
require_once 'library/theme-options-init.php';
require_once 'library/page-metabox.php';
require_once 'library/open-graph.php';
require_once 'library/tribe-events.php';

/** Gutenberg editor support */
require_once 'library/gutenberg.php';

/** Block Patterns */
require_once 'library/block-patterns.php';

/** Set favicons */
require_once 'library/favicons.php';

/** If your site requires protocol relative url's for theme assets, uncomment the line below */
// require_once( 'library/class-foundationpress-protocol-relative-theme-assets.php' );


// Register Custom Blocks
add_action( 'acf/init', 'my_register_blocks' );
function my_register_blocks() {

	// check function exists.
	if ( function_exists( 'acf_register_block_type' ) ) {

		// register a testimonial block.
		acf_register_block_type(
			array(
				'name'            => 'testimonials',
				'title'           => __( 'Testimonials' ),
				'description'     => __( 'A custom testimonial block.' ),
				'render_template' => 'template-parts/blocks/testimonials/block.php',
				'category'        => 'formatting',
				'icon'            => 'admin-comments',
				'keywords'        => array( 'testimonials' ),
				'enqueue_style'   => get_template_directory_uri() . '/template-parts/blocks/testimonials/testimonials.css',
			)
		);
	}
}
