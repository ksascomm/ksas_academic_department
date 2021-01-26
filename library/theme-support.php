<?php
/**
 * Register theme support for languages, menus, post-thumbnails, post-formats etc.
 *
 * @package KSASAcademicDepartment
 * @since KSASAcademicDepartment 1.0.0
 */

if ( ! function_exists( 'ksasacademic_theme_support' ) ) :
function ksasacademic_theme_support() {
		// Add language support
		load_theme_textdomain( 'ksasacademic', get_template_directory() . '/languages' );

		// Switch default core markup for search form, comment form, and comments to output valid HTML5
		add_theme_support(
         'html5', array(
			 'search-form',
			 'comment-form',
			 'comment-list',
			 'gallery',
			 'caption',
		 )
			);

			// Add menu support
			add_theme_support( 'menus' );

			// Let WordPress manage the document title
			// add_theme_support( 'title-tag' );

			// Add post thumbnail support: http://codex.wordpress.org/Post_Thumbnails
			add_theme_support( 'post-thumbnails' );
			set_post_thumbnail_size( 250, 250, true );   // default thumb size
			add_image_size( 'directory', 150, 217, true );
			//add_image_size( 'article', 360, 240, true );

			// RSS thingy
			add_theme_support( 'automatic-feed-links' );

			// Add post formats support: http://codex.wordpress.org/Post_Formats
			add_theme_support( 'post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat') );

			// Additional theme support for woocommerce 3.0.+
			add_theme_support( 'wc-product-gallery-zoom' );
			add_theme_support( 'wc-product-gallery-lightbox' );
			add_theme_support( 'wc-product-gallery-slider' );

			// Add foundation.css as editor style https://codex.wordpress.org/Editor_Style
			//add_editor_style( 'dist/assets/css/' . ksasacademic_asset_path('app.css'));

			// Enable block styles on the front end
    		add_theme_support( 'wp-block-styles' );
}

add_action( 'after_setup_theme', 'ksasacademic_theme_support' );
endif;
