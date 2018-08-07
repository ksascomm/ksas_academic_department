<?php
/*
Template Name: Full Width & No Featured Image 
*/
get_header(); ?>

<div class="main-container" id="page">
	<div class="main-grid">
		<main class="main-content-full-width">
			<?php
            while ( have_posts() ) :
the_post();
?>
				<?php get_template_part( 'template-parts/content', 'page' ); ?>
			<?php endwhile; ?>
		</main>
	</div>
</div>
<?php
get_footer();
