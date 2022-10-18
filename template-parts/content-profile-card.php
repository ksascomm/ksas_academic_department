<?php
/**
 * The default template for displaying profiles content as cards
 *
 * @package KSASAcademicDepartment
 * @since KSASAcademicDepartment 1.0.0
 */

?>

<div class="cell profile testimonial-container">

	<div class="profile-headshot" style="background-image: url(<?php the_post_thumbnail_url( 'large' ); ?>)">
	</div>
	<div class="testimonial-bio">
		<h2><a href="<?php echo esc_url( get_permalink() ); ?>" id="post-<?php the_ID(); ?>"><?php the_title(); ?></a></h2>
		<?php if ( have_rows( 'custom_profile_fields' ) ) : ?>
			<?php
			while ( have_rows( 'custom_profile_fields' ) ) :
				the_row();
				?>
			<h3><span class="custom-title"><?php the_sub_field( 'custom_title' ); ?></span>&nbsp;<span class="custom-content"><?php the_sub_field( 'custom_content' ); ?></span></h3>
			<?php endwhile; ?>
		<?php else : ?>
			<?php // No rows found! ?>
		<?php endif; ?>
		<?php the_excerpt(); ?>
	</div>
</div>
