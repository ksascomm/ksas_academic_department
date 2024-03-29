<?php
/**
 * The template for displaying archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package KSASAcademicDepartment
 * @since KSASAcademicDepartment 1.0.0
 */

get_header();
	$theme_option = flagship_sub_get_global_options();
?>

<div class="main-container" id="page">
	<div class="main-grid">
		<main class="main-content-full-width">
		<?php if ( have_posts() ) : ?>
			<?php if ( is_category( 'highlights' ) ) : ?>
				<h1 class="page-title">Humanities Highlights</h1>
			<?php endif; ?>
			<?php /* Start the Loop */ ?>
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<?php
				if ( is_category( 'highlights' ) ) :
					get_template_part( 'template-parts/content', 'humanities-highlights' );
				elseif ( is_post_type_archive( 'faculty-books' ) ) :
					get_template_part( 'template-parts/content', 'faculty-books' );
				else :
					get_template_part( 'template-parts/content', get_post_format() );
				endif;
				?>
			<?php endwhile; ?>

			<?php else : ?>
				<?php get_template_part( 'template-parts/content', 'none' ); ?>

			<?php endif; // End have_posts() check. ?>

			<?php /* Display navigation to next/previous pages when applicable */ ?>
			<?php
			if ( function_exists( 'ksasacademic_pagination' ) ) :
				ksasacademic_pagination();
			elseif ( is_paged() ) :
				?>
				<nav id="post-nav">
					<div class="post-previous"><?php next_posts_link( __( '&larr; Older posts', 'ksasacademic' ) ); ?></div>
					<div class="post-next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'ksasacademic' ) ); ?></div>
				</nav>
			<?php endif; ?>

		</main>
	</div>
</div>

<?php
get_footer();
