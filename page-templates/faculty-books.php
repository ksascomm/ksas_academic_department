<?php
/**
 * Template Name: Faculty Books
 * The template for Faculty Books custom post type
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
						'post_type'      => 'faculty-books',
						'posts_per_page' => 100,
						'meta_key'       => 'ecpt_pub_date',
						'orderby'        => 'meta_value',
						'order'          => 'DESC',
					)
				);
				if ( $faculty_book_query->have_posts() ) :
					while ( $faculty_book_query->have_posts() ) :
						$faculty_book_query->the_post();
						?>
						<?php get_template_part( 'template-parts/content', 'faculty-books' ); ?>
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
