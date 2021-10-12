<?php
/**
 * Register theme support for languages, menus, post-thumbnails, post-formats etc.
 *
 * @package KSASAcademicDepartment
 * @since KSASAcademicDepartment 1.0.0
 */

if ( ! function_exists( 'ksasacademic_theme_support' ) ) :
	function ksasacademic_theme_support() {
		// Add language support.
		load_theme_textdomain( 'ksasacademic', get_template_directory() . '/languages' );

		// Switch default core markup for search form, comment form, and comments to output valid HTML5.
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		// Add post thumbnail support: http://codex.wordpress.org/Post_Thumbnails.
		add_theme_support( 'post-thumbnails' );

		// Add menu support.
		add_theme_support( 'menus' );

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// RSS thingy.
		add_theme_support( 'automatic-feed-links' );

		// Add post formats support: http://codex.wordpress.org/Post_Formats.
		add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' ) );

		// Enable block styles on the front end.
		add_theme_support( 'wp-block-styles' );
	}

	add_action( 'after_setup_theme', 'ksasacademic_theme_support' );
endif;

/**
 * Add custom text to <title> using pre_get_document_title hook
 */
function custom_ksasacademic_page_title( $title ) {
	if ( is_front_page() && is_home() ) {
		$title = get_bloginfo( 'name' ) . ' | Johns Hopkins University';
		return $title;
	} elseif ( is_front_page() ) {
				$title = get_bloginfo( 'name' ) . ' | Johns Hopkins University';
		return $title;
	} elseif ( is_home() ) {
		$title = get_the_title( get_option( 'page_for_posts', true ) ) . ' | ' . get_bloginfo( 'name' ) . ' | Johns Hopkins University';
		return $title;
	} elseif ( is_category() ) {
		$title = single_cat_title( '', false ) . ' | ' . get_bloginfo( 'name' ) . ' | Johns Hopkins University';
		return $title;
	} elseif ( is_author() ) {
		global $post;
		$title = get_the_author_meta( 'display_name', $post->post_author ) . ' Author Archives | ' . get_bloginfo( 'name' ) . ' | Johns Hopkins University';
		return $title;
	} elseif ( is_archive() ) {
		$title = single_cat_title( '', false ) . ' | ' . get_bloginfo( 'name' ) . ' | Johns Hopkins University';
		return $title;
	} elseif ( is_single() ) {
		$title = get_the_title() . ' | ' . get_bloginfo( 'name' ) . ' | Johns Hopkins University';
		return $title;
	} elseif ( is_page() ) {
		$title = get_the_title() . ' | ' . get_bloginfo( 'name' ) . ' | Johns Hopkins University';
		return $title;
	} elseif ( is_404() ) {
		$title = 'Page Not Found | ' . get_bloginfo( 'name' ) . ' | Johns Hopkins University';
		return $title;
	} elseif ( is_tax( 'bbtype' ) ) {
		$title = single_tag_title( '', false ) . ' | ' . get_bloginfo( 'name' ) . ' | Johns Hopkins University';
		return $title;
	} else {
		return $title;
	}
}

add_filter( 'pre_get_document_title', 'custom_ksasacademic_page_title', 9999 );
