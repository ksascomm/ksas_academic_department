<?php
/**
 * Template part for displaying featured images on PAGES.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package KSASAcademicDepartment
 */

// If a featured image is set, insert into layout.
if ( has_post_thumbnail( $post->ID ) ) :
	$thumbnail_id  = get_post_thumbnail_id( $post->ID );
	$thumbnail_alt = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true );
	?>
	<header class="featured-hero uploaded hide-for-print show-for-medium" role="banner" data-interchange="[<?php the_post_thumbnail_url( 'featured-small' ); ?>, small], [<?php the_post_thumbnail_url( 'featured-medium' ); ?>, medium], [<?php the_post_thumbnail_url( 'featured-large' ); ?>, large], [<?php the_post_thumbnail_url( 'full' ); ?>, x-large]" aria-label="<?php echo esc_html( $thumbnail_alt ); ?>">
</header>

	<?php
else :
	// Otherwise, randomly display one of the following images.
	$theme = get_template_directory_uri();
	$bg    = array(
		$theme . '/dist/assets/images/header-images/deptThemeStandard01.jpg',
		$theme . '/dist/assets/images/header-images/deptThemeStandard02.jpg',
		$theme . '/dist/assets/images/header-images/deptThemeStandard04.jpg',
		$theme . '/dist/assets/images/header-images/deptThemeStandard05.jpg',
		$theme . '/dist/assets/images/header-images/deptThemeStandard06.jpg',
		$theme . '/dist/assets/images/header-images/deptThemeStandard07.jpg',
		$theme . '/dist/assets/images/header-images/deptThemeStandard08.jpg',
		$theme . '/dist/assets/images/header-images/deptThemeStandard09.jpg',
		$theme . '/dist/assets/images/header-images/deptThemeStandard10.jpg',
	);

	$i              = wp_rand( 0, count( $bg ) - 1 ); // Generate random number size of the array.
	$selected_image = "$bg[$i]"; // Set variable equal to which random filename was chosen.

	?>

<header class="featured-hero default hide-for-print show-for-medium" role="banner" style="background-image: url('<?php echo esc_url( $selected_image ); ?>');">
</header>
	<?php
endif;
