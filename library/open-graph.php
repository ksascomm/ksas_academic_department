<?php
/**
 * Add Description Meta Tag and Open Graph Meta Info from the actual article data,
 * or customize as necessary
 *
 * @package WordPress
 * @package KSASAcademicDepartment
 * @since KSASAcademicDepartment 1.0.0
 */
function meta_open_graph() {
	global $post;
	if ( ! is_singular() ) { // if it is not a post or a page...
		return;
	}
	if ( $excerpt = $post->post_content ) {
			$uglyexcerpt = wp_strip_all_tags( $post->post_content );
			$uglyexcerpt = str_replace( '', "'", $uglyexcerpt );
			$excerpt     = wp_trim_words( $uglyexcerpt, 35, '...' );
	} elseif ( is_singular( 'people' ) ) {
		$longexcerpt = wp_strip_all_tags( get_post_meta( $post->ID, 'ecpt_bio', true ) );
		$longexcerpt = str_replace( '', "'", $longexcerpt );
		$excerpt     = wp_trim_words( $longexcerpt, 15, '...' );
	} else {
		$excerpt = get_bloginfo( 'title' );
	}
		echo '<meta name="description" content="' . esc_html( $excerpt ) . '"/>';
		echo '<meta property="og:title" content="' . esc_html( get_the_title() ) . ' | ' . esc_html( get_bloginfo( 'title' ) ) . '"/>';
		echo '<meta property="og:description" content="' . esc_html( $excerpt ) . '"/>';
		echo '<meta property="og:type" content="article"/>';
		echo '<meta property="og:url" content="' . esc_url( get_permalink() ) . '"/>';
		echo '<meta property="article:published_time" content="' . get_the_date( 'c' ) . '"/>';
		echo '<meta property="article:modified_time" content="' . get_the_modified_date( 'c' ) . '"/>';
		echo '<meta name="twitter:card" content="summary" />';
		echo '<meta name="twitter:site" content="@JHUArtsSciences" />';

		// Customize the below with the name of your site.
		echo '<meta property="og:site_name" content="' . esc_html( get_bloginfo( 'title' ) ) . '"/>';
	if ( ! has_post_thumbnail( $post->ID ) ) { // the post does not have featured image, use a default image
		// Create a default image on your server or an image in your media library, and insert it's URL here.
		$default_image = get_template_directory_uri() . '/dist/assets/images/homepage-slider-hero.jpg';
		echo '<meta property="og:image" content="' . esc_url( $default_image ) . '"/>';
	} else {
		$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
		echo '<meta property="og:image" content="' . esc_attr( $thumbnail_src[0] ) . '"/>';
	}

		echo '';
}
add_action( 'wp_head', 'meta_open_graph', 5 );

/**
 * Same Function as above, but for blog page.
 */
function meta_open_graph_archive() {
	global $post;
	$theme_option = flagship_sub_get_global_options();
	if ( is_home() ) {
		echo '<meta name="description" content="Read the latest posts from the ' . esc_html( get_bloginfo( 'description' ) ) . ' ' . esc_html( get_bloginfo( 'title' ) ) . '"/>';
		echo '<meta property="og:title" content="' . $theme_option['flagship_sub_feed_name'] . ' | ' . get_bloginfo( 'title' ) . '"/>';
		echo '<meta property="og:description" content="Read the latest posts from the ' . esc_html( get_bloginfo( 'description' ) ) . ' ' . esc_html( get_bloginfo( 'title' ) ) . '"/>';
		echo '<meta property="og:type" content="article"/>';
		echo '<meta property="og:url" content="' . esc_url( get_permalink() )  . '"/>';
		echo '<meta property="og:image" content="' . esc_url( get_template_directory_uri() ) . '/dist/assets/images/homepage-slider-hero.jpg' . '"/>';
	}
}
add_action( 'wp_head', 'meta_open_graph_archive', 5 );
