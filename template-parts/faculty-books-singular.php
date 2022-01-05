<?php
/**
 * Template partial for displaying Faculty Books CPT in single-faculty-books.php
 *
 * @package KSASAcademicDepartment
 * @since KSASAcademicDepartment 1.0.0
 */

?>
<?php
$faculty_post_id  = get_post_meta( $post->ID, 'ecpt_pub_author', true );
$faculty_post_id2 = get_post_meta( $post->ID, 'ecpt_pub_author2', true );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-singular faculty-book' ); ?>>
		<header>
			<h1 class="entry-title"><?php the_title(); ?></h1>
		</header>
		<div class="entry-content single-book">
				<?php
				$title = get_the_title();
					the_post_thumbnail(
						'medium',
						array(
							'class' => 'float-left',
							'alt'   => esc_html( get_the_title() ),
						)
					);
					?>
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
							<a href="<?php echo esc_url( get_permalink( $faculty_post_id2 ) ); ?>">
								<?php echo esc_html( get_the_title( $faculty_post_id2 ) ); ?>,
								<?php echo esc_html( get_post_meta( $post->ID, 'ecpt_pub_role2', true ) ); ?>
							</a>
						<?php } ?>
						</li>
						<li>
							<?php if ( get_post_meta( $post->ID, 'ecpt_pub_link', true ) ) : ?>
							<a href="<?php echo esc_url( get_post_meta( $post->ID, 'ecpt_pub_link', true ) ); ?>" aria-label="Purchase Online">
								Purchase Online <span class="fas fa-external-link-square-alt"></span>
							</a>
							<?php endif; ?>
						</li>
					</ul>
			<?php the_content(); ?>
			<?php edit_post_link( __( '(Edit)', 'ksasacademic' ), '<span class="edit-link">', '</span>' ); ?>
		</div>
</article>
