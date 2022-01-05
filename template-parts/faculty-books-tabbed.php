<?php
/**
 * The default template for faculty books tab in Single-People.php
 *
 * Used for single.
 *
 * @package KSASAcademicDepartment
 * @since KSASAcademicDepartment 1.0.0
 */

?>

<div class="tabs-panel" id="booksTab">
	<?php
		$author_id          = get_the_ID();
		$single_books_query = new WP_Query(
			array(
				'post_type'      => 'faculty-books',
				'category_name'  => 'books',
				'posts_per_page' => 50,
				'orderby'        => 'date',
				'meta_query'     => array(
					'relation' => 'OR',
					array(
						'key'     => 'ecpt_pub_author',
						'value'   => $author_id,
						'type'    => 'NUMERIC',
						'compare' => '=',
					),
					array(
						'key'     => 'ecpt_pub_author2',
						'value'   => $author_id,
						'type'    => 'NUMERIC',
						'compare' => '=',
					),
				),
			)
		);
		if ( $single_books_query->have_posts() ) :
			while ( $single_books_query->have_posts() ) :
				$single_books_query->the_post();
				?>
	<article class="book-entry" aria-labelledby="post-<?php the_ID(); ?>">
				<?php
				if ( has_post_thumbnail() ) {
					the_post_thumbnail(
						'directory',
						array(
							'class' => 'float-left',
							'alt'   => esc_html( get_the_title() ),
						)
					);
				}
				?>
		<h5>
			<a href="<?php the_permalink(); ?>" id="post-<?php the_ID(); ?>">
				<?php the_title(); ?>
			</a>
		</h5>
		<ul class="no-bullet">
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
				<strong>Role:</strong> <span class="capitalize"><?php echo esc_html( get_post_meta( $post->ID, 'ecpt_pub_role', true ) ); ?></span>
			</li>
			<li>
				<?php
				if ( get_post_meta( $post->ID, 'ecpt_author_cond', true ) == 'on' ) {
					$faculty_post_id2 = get_post_meta( $post->ID, 'ecpt_pub_author2', true );
					?>
					<?php echo esc_html( get_the_title( $faculty_post_id2 ) ); ?>,&nbsp;<?php echo esc_html( get_post_meta( $post->ID, 'ecpt_pub_role2', true ) ); ?>
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
		<hr>
	</article>
				<?php
			endwhile;
endif;
		wp_reset_postdata()
		?>
</div>
