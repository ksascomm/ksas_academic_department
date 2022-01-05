<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package KSASAcademicDepartment
 * @since KSASAcademicDepartment 1.0.0
 */

get_header();

?>
<div class="main-container" id="page">
	<div class="main-grid">
		<main class="main-content-full-width">
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<?php get_template_part( 'template-parts/content', '' ); ?>
			<?php endwhile; ?>
		</main>
	</div>
</div>
<?php
get_footer();
