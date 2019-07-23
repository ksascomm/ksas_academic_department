<?php
/**
 * The template for displaying Exhibition category archives
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
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */
get_header(); ?>	

<div class="main-container" id="page">
	<div class="main-grid">
		<main class="main-content-full-width">
		
		<?php $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); ?>

			<h1 class="page-title"><?php echo $term->name;?> Exhibits</h1>
			<p>Explore all of our <?php echo $term->name;?> Exhibits</p>
			
			<?php if ( have_posts() ) : ?>
				<div class="grid-x grid-padding-x small-up-2 medium-up-3">

				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'template-parts/content-exhibits', 'card' ); ?>
				<?php endwhile; ?>

				</div>
			<?php endif; // End have_posts() check. ?>

		</main>

	</div>
</div>

<?php
get_footer();
