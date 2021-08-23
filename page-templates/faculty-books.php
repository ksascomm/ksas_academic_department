<?php
/**
 * Template Name: Faculty Books
 * The template for Faculty Books taxonomy
 *
 * @package KSASAcademicDepartment
 * @since KSASAcademicDepartment 1.0.0
 */

get_header(); ?>

<div class="main-container" id="page">
	<div class="main-grid">
		<main class="main-content">
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<?php get_template_part( 'template-parts/content', 'page' ); ?>
			<?php endwhile; ?>
			<?php
				$faculty_book_query = new WP_Query(
					array(
						'post_type'      => 'post',
						'category_name'  => 'books',
						'posts_per_page' => 100,
					)
				);
				if ( $faculty_book_query->have_posts() ) :
					while ( $faculty_book_query->have_posts() ) :
						$faculty_book_query->the_post();
						?>
						<article class="faculty-book" aria-labelledby="post-<?php the_ID(); ?>">
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
						<?php
							$faculty_post_id  = get_post_meta( $post->ID, 'ecpt_pub_author', true );
							$faculty_post_id2 = get_post_meta( $post->ID, 'ecpt_pub_author2', true );
						?>
					<ul class="no-bullet">
						<li>
							<h2 itemprop="headline" id="post-<?php the_ID(); ?>">
							<?php the_title(); ?>
							</h2>
						</li>
						<li>
						<?php if ( get_post_meta( $post->ID, 'ecpt_pub_date', true ) ) : ?>
								<?php echo get_post_meta( $post->ID, 'ecpt_pub_date', true ); ?>,
					<?php endif; ?>
						<?php if ( get_post_meta( $post->ID, 'ecpt_publisher', true ) ) : ?>
								<?php echo get_post_meta( $post->ID, 'ecpt_publisher', true ); ?>
					<?php endif; ?>
						</li>
						<li>
							<a href="<?php echo get_permalink( $faculty_post_id ); ?>">
							<?php echo get_the_title( $faculty_post_id ); ?>,
							<?php if ( get_post_meta( $post->ID, 'ecpt_pub_role', true ) ) : ?>
								<?php echo get_post_meta( $post->ID, 'ecpt_pub_role', true ); ?>
							<?php endif; ?>
							</a>
						</li>
						<li>
						<?php
						if ( get_post_meta( $post->ID, 'ecpt_author_cond', true ) == 'on' ) {
							?>
							<br>
							<a href="<?php echo get_permalink( $faculty_post_id2 ); ?>">
								<?php echo get_the_title( $faculty_post_id2 ); ?>,&nbsp;
								<?php echo get_post_meta( $post->ID, 'ecpt_pub_role2', true ); ?>
							</a>
						<?php } ?>
						</li>
						<li><?php if ( get_post_meta( $post->ID, 'ecpt_pub_link', true ) ) : ?>
							<a href="http://<?php echo get_post_meta( $post->ID, 'ecpt_pub_link', true ); ?>" aria-label="Purchase Online">
								Purchase Online <span class="fas fa-external-link-square-alt"></span>
							</a>
							<?php endif; ?>
						</li>
					</ul>
						<?php the_content(); ?>
						<hr>
						</article>
						<?php
						endwhile;
endif;
				?>
		</main>
		<?php get_sidebar(); ?>
	</div>
</div>
<?php
get_footer();
