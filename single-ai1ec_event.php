<?php
/**
 * The template for displaying all single events
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header();
?>

<div class="main-container" id="page">
	<div class="main-grid">
		<main class="main-content">
			<?php
            while ( have_posts() ) :
the_post();
?>
				<?php get_template_part( 'template-parts/content-events', '' ); ?>
			<?php endwhile; ?>
		</main>
	<?php get_sidebar(); ?>
	</div>
</div>
<?php
get_footer();