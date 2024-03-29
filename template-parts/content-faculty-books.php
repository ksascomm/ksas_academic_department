<?php
/**
 * The default template for displaying faculty books content
 *
 * Used for both singlular and archive faculty books.
 *
 * @package KSASAcademicDepartment
 * @since KSASAcademicDepartment 1.0.0
 */

?>

<article <?php post_class( 'faculty-book' ); ?>" aria-labelledby="post-<?php the_ID(); ?>">
	<?php if ( has_post_thumbnail() ) { ?>
		<?php
		the_post_thumbnail(
			'medium',
			array(
				'class' => 'float-left',
				'alt'   => esc_html( get_the_title() ),
			)
		);
		?>
	<?php } ?>
	<h2 itemprop="headline" id="post-<?php the_ID(); ?>">
		<?php the_title(); ?>
	</h2>
	<ul class="no-bullet">
		<?php
			$faculty_post_id  = get_post_meta( $post->ID, 'ecpt_pub_author', true );
			$faculty_post_id2 = get_post_meta( $post->ID, 'ecpt_pub_author2', true );
		?>
		<li>
		<?php if ( get_post_meta( $post->ID, 'ecpt_pub_date', true ) ) : ?>
				<?php echo esc_html( get_post_meta( $post->ID, 'ecpt_pub_date', true ) ); ?>
		<?php endif; ?>
		<?php if ( get_post_meta( $post->ID, 'ecpt_publisher', true ) && get_post_meta( $post->ID, 'ecpt_pub_date', true ) ) : ?>
			<span class="comma">,</span>
		<?php endif; ?>
		<?php if ( get_post_meta( $post->ID, 'ecpt_publisher', true ) ) : ?>
			<?php echo esc_html( get_post_meta( $post->ID, 'ecpt_publisher', true ) ); ?>
		<?php endif; ?>
		</li>
		<li>
			<a href="<?php echo esc_url( get_permalink( $faculty_post_id ) ); ?>">
			<?php echo esc_html( get_the_title( $faculty_post_id ) ); ?>,
			<?php if ( get_post_meta( $post->ID, 'ecpt_pub_role', true ) ) : ?>
				<?php echo esc_html( get_post_meta( $post->ID, 'ecpt_pub_role', true ) ); ?>
			<?php endif; ?>
			</a>
		</li>
		<li>
		<?php
		if ( get_post_meta( $post->ID, 'ecpt_author_cond', true ) == 'on' ) {
			?>
			<span class="second-author"><a href="<?php echo esc_url( get_permalink( $faculty_post_id2 ) ); ?>">
				<?php echo esc_html( get_the_title( $faculty_post_id2 ) ); ?>,
				<?php echo esc_html( get_post_meta( $post->ID, 'ecpt_pub_role2', true ) ); ?>
			</a></span>
		<?php } ?>
		</li>
		<li>
			<?php if ( get_post_meta( $post->ID, 'ecpt_pub_link', true ) ) : ?>
			<a href="<?php echo esc_url( get_post_meta( $post->ID, 'ecpt_pub_link', true ) ); ?>" aria-label="Purchase Online">
				Purchase Online <span class="fa-solid fa-square-arrow-up-right"></span>
			</a>
			<?php endif; ?>
		</li>
	</ul>
		<?php the_content(); ?>
		<?php edit_post_link( __( '(Edit)', 'ksasacademic' ), '<span class="edit-link">', '</span>' ); ?>
		<hr>
</article>
