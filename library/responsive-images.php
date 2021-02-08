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

// Add additional image sizes.
add_image_size( 'fp-small', 640 );
add_image_size( 'fp-medium', 1024 );
add_image_size( 'fp-large', 1200 );
add_image_size( 'fp-xlarge', 1920 );

// Register the new image sizes for use in the add media modal in wp-admin.
function ksasacademic_custom_sizes( $sizes ) {
	return array_merge(
		$sizes,
		array(
			'fp-small'  => __( 'FP Small' ),
			'fp-medium' => __( 'FP Medium' ),
			'fp-large'  => __( 'FP Large' ),
			'fp-xlarge' => __( 'FP XLarge' ),
		)
	);
}
add_filter( 'image_size_names_choose', 'ksasacademic_custom_sizes' );

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

// Remove inline width and height attributes for post thumbnails & image insert.
//add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 );
//add_filter( 'image_send_to_editor', 'remove_thumbnail_dimensions', 10 );

/*function remove_thumbnail_dimensions( $html ) {
	$html = preg_replace( '/(width|height)=\"\d*\"\s/', '', $html );
	return $html;
}*/

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
