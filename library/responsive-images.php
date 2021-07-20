<?php
/**
 * Configure responsive images sizes
 *
 * @package WordPress
 * @subpackage FoundationPress
 * @since FoundationPress 2.6.0
 */

// Add featured image sizes.
// Sizes are optimized and cropped for landscape aspect ratio/
// and optimized for HiDPI displays on 'small' and 'medium' screen sizes.
add_image_size( 'featured-small', 640, 200, true ); // name, width, height, crop.
add_image_size( 'featured-medium', 1280, 400, true );
add_image_size( 'featured-large', 1920, 400, true );
add_image_size( 'directory', 150, 217, true );


// Add custom image sizes attribute to enhance responsive image functionality for content images.
function ksasacademic_adjust_image_sizes_attr( $sizes, $size ) {

	// Actual width of image.
	$width = $size[0];

	// If its a page, use full-width image.
	if ( $width === 600 ) {
		return '(min-width: 768px) 322px, (min-width: 576px) 255px, calc( (100vw - 30px) / 2)';
	}
	// full width images - large size
	if ( $width === 1024 ) {
		return '(min-width: 768px) 642px, (min-width: 576px) 510px, calc(100vw - 30px)';
	}
	// default to return if condition is not met.
	return '(max-width: ' . $width . 'px) 100vw, ' . $width . 'px';
}

add_filter( 'wp_calculate_image_sizes', 'ksasacademic_adjust_image_sizes_attr', 10, 2 );

// Redirect Attachment Pages To The Parent Post URL.
add_action( 'template_redirect', 'wpsites_attachment_redirect' );
function wpsites_attachment_redirect() {
	global $post;
	if ( is_attachment() && isset( $post->post_parent ) && is_numeric( $post->post_parent ) && ( $post->post_parent != 0 ) ) :
		wp_safe_redirect( get_permalink( $post->post_parent ), 301 );
		exit();
		wp_reset_postdata();
		endif;
}


// Disable a few default image sizes that I don’t need
add_filter( 'intermediate_image_sizes', 'remove_default_img_sizes', 10, 1 );
function remove_default_img_sizes( $sizes ) {
	$targets = array( 'medium_large', '1536x1536', '2048x2048' );
	foreach ( $sizes as $size_index => $size ) {
		if ( in_array( $size, $targets ) ) {
			unset( $sizes[ $size_index ] );
		}
	}
	return $sizes;
}
