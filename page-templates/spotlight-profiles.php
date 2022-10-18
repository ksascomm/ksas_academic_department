<?php
/**
 * Template Name: Profiles
 * The template for displaying the Profiles custom post type's internship taxonomy
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package KSASAcademicDepartment
 * @since KSASAcademicDepartment 1.0.0
 */

	get_header(); ?>

<?php get_template_part( 'template-parts/featured-image' ); ?>
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
					$profile_type          = get_field( 'profile_type' );
					$ksas_spotlights_query = new WP_Query(
						array(
							'post_type'      => 'profile',
							'orderby'        => 'title',
							'order'          => 'ASC',
							'posts_per_page' => 100,
							'tax_query'      => array (
								array(
									'taxonomy' => 'profiletype',
									'field'    => 'term_id',
									'terms'    => $profile_type,
								),
							)
						)
					);
						?>
					<?php if ( $ksas_spotlights_query->have_posts() ) : ?>

					<div class="grid-x grid-padding-x small-up-2 large-up-3">
							<?php
							while ( $ksas_spotlights_query->have_posts() ) :
								$ksas_spotlights_query->the_post();
								?>
								<?php get_template_part( 'template-parts/content', 'profile-card' ); ?>
							<?php endwhile; ?>
					</div>
			<?php endif; ?>
			</main>
			<?php get_sidebar(); ?>
	</div>
</div>
	<?php
	get_footer();
