<?php
/**
 * The default template for displaying Testimonials content
 *
 * Used for both single and index/archive/search.
 *
 * @package KSASAcademicDepartment
 * @since KSASAcademicDepartment 1.0.0
 */

?>

<article aria-labelledby="post-<?php the_ID(); ?>" <?php post_class( 'post-singular' ); ?>>
		<header>
			<h2 id="post-<?php the_ID(); ?>"><?php the_title(); ?></h2>
		</header>
		<div class="entry-content">
			<?php
			if ( has_post_thumbnail() ) {
				the_post_thumbnail(
					'thumbnail',
					array( 'alt' => esc_html( get_the_title() ) )
				);  }
			?>
			<?php if ( get_post_meta( $post->ID, 'ecpt_class', true ) ) : ?>
				<p><strong>Class of: <?php echo get_post_meta( $post->ID, 'ecpt_class', true ); ?></strong></p>
			<?php endif; ?>
			<?php if ( get_post_meta( $post->ID, 'ecpt_internship', true ) ) : ?>
				<p><strong>Internship:</strong> <?php echo get_post_meta( $post->ID, 'ecpt_internship', true ); ?></p>
			<?php endif; ?>
			<?php if ( get_post_meta( $post->ID, 'ecpt_job', true ) ) : ?>
				<p><strong>Current Job:</strong> <?php echo get_post_meta( $post->ID, 'ecpt_job', true ); ?></p>
			<?php endif; ?>
			<?php the_content(); ?>
			<?php edit_post_link( __( '(Edit)', 'ksasacademic' ), '<span class="edit-link">', '</span>' ); ?>
		</div>
</article>
