<?php
/**
 * The default template for displaying profiles content
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
					'large',
					array( 'alt' => esc_html( get_the_title() ) )
				);
			}
			?>

			<?php if ( have_rows( 'custom_profile_fields' ) ) : ?>
				<?php
				while ( have_rows( 'custom_profile_fields' ) ) :
					the_row();
					?>
				<h4><span class="custom-title"><?php the_sub_field( 'custom_title' ); ?></span>&nbsp;<span class="custom-content"><?php the_sub_field( 'custom_content' ); ?></span></h4>
				<?php endwhile; ?>
			<?php else : ?>
				<?php // No rows found! ?>
			<?php endif; ?>
			<?php the_content(); ?>
			<?php edit_post_link( __( '(Edit)', 'ksasacademic' ), '<span class="edit-link">', '</span>' ); ?>
		</div>
</article>
