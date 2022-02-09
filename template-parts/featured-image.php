<?php
/**
 * Template part for displaying featured images on PAGES.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package KSASAcademicDepartment
 */

// If a featured image is set, insert into layout.
if ( has_post_thumbnail( $post->ID ) ) : ?>
	<header class="featured-hero uploaded hide-for-print show-for-medium" role="banner" data-interchange="[<?php the_post_thumbnail_url( 'featured-small' ); ?>, small], [<?php the_post_thumbnail_url( 'featured-medium' ); ?>, medium], [<?php the_post_thumbnail_url( 'featured-large' ); ?>, large], [<?php the_post_thumbnail_url( 'full' ); ?>, x-large]" aria-label="Featured Image">
	</header>

	<?php
	// Check if photoshelter creds defined.
elseif ( defined( 'PHOTOSHELTER_USER' ) ) :
	$url           = 'https://www.photoshelter.com/psapi/v3/mem/authenticate?api_key=2yrk5yDYpec&email=' . PHOTOSHELTER_USER . '&password=' . PHOTOSHELTER_PASS . '&mode=token';
	$transient_key = 'photoshelter-api';
	$request       = get_transient( $transient_key );
	if ( false === $request ) {
		$request = wp_remote_get( $url );

		if ( is_wp_error( $request ) ) {
			// Cache failures for a 15 minutes, will speed up page rendering in the event of remote failure.
			set_transient( $transient_key, $request, MINUTE_IN_SECONDS * 15 );
			return false;
		}
		// Success, cache for 24 hours.
		set_transient( $transient_key, $request, DAY_IN_SECONDS * 1 );
	}

	if ( is_wp_error( $request ) ) {
		return false;
	}

	$body = wp_remote_retrieve_body( $request );
	$data = json_decode( $body );

	if ( ! empty( $data ) ) {
		$token = $data->data->token;
	}
	$saved_token = $token;

	$gallery_id            = 'G0000YaDdZUH7HgE';
	$photoshelter_response = wp_remote_get( 'https://www.photoshelter.com/psapi/v3/gallery/' . $gallery_id . '?api_key=2yrk5yDYpec&auth_token=' . $saved_token . '&extend={"GalleryImage":{"fields":"image_id","params":{}},"ImageLink":{"fields":"link,base","params":{"image_mode":"fit","image_size":"1920x400"}}}' );
	if ( is_wp_error( $photoshelter_response ) ) {
		$photoshelter_data = json_decode( wp_remote_retrieve_body( $photoshelter_response ) );
		echo esc_html( '<script>console.log("Error:' . $photoshelter_data . '")</script>' );
	} else {
		$photoshelter_data = json_decode( wp_remote_retrieve_body( $photoshelter_response ) );
		// No clear way to dynamically determine # of photos in gallery, so list them here.
		$random_image = array(
			$photoshelter_data->data->Gallery->GalleryImage[0]->ImageLink->link,
			$photoshelter_data->data->Gallery->GalleryImage[1]->ImageLink->link,
			$photoshelter_data->data->Gallery->GalleryImage[2]->ImageLink->link,
			$photoshelter_data->data->Gallery->GalleryImage[3]->ImageLink->link,
			$photoshelter_data->data->Gallery->GalleryImage[4]->ImageLink->link,
			$photoshelter_data->data->Gallery->GalleryImage[5]->ImageLink->link,
			$photoshelter_data->data->Gallery->GalleryImage[6]->ImageLink->link,
			$photoshelter_data->data->Gallery->GalleryImage[7]->ImageLink->link,
			$photoshelter_data->data->Gallery->GalleryImage[8]->ImageLink->link,
			$photoshelter_data->data->Gallery->GalleryImage[9]->ImageLink->link,
		);
		$i            = wp_rand( 0, count( $random_image ) - 1 );
		$image        = "$random_image[$i]";
	}
	?>

<header class="featured-hero default photoshelter hide-for-print show-for-medium" role="banner" style="background-image: url('<?php echo esc_url( $image ); ?>');" aria-label="Featured Image">
	</header>
	<?php
endif;
