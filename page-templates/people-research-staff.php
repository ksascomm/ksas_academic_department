<?php
/**
 * Template Name: Research Staff Directory
 * The template for displaying the People CPT
 * categorized as Research Staff.
 *
 * @package KSASAcademicDepartment
 * @since KSASAcademicDepartment 1.0.0
 */

get_header(); ?>

<?php
if ( WP_DEBUG || false === ( $research_staff_query = get_transient( 'research_staff_query' ) ) ) :
	// It wasn't there, so regenerate the data and save the transient.
	$research_staff_query = new WP_Query(
		array(
			'post_type'      => 'people',
			'role'           => 'research',
			'meta_key'       => 'ecpt_people_alpha',
			'orderby'        => 'meta_value',
			'order'          => 'ASC',
			'posts_per_page' => 100,
		)
	);
	set_transient( 'research_staff_query', $research_staff_query, 345600 );
endif;
?>

<div class="main-container" id="page">
	<div class="main-grid">
		<main class="main-content">
		<?php do_action( 'ksasacademic_before_content' ); ?>

		<?php
		while ( have_posts() ) :
			the_post();
			?>

		<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
			<header>
				<h1 class="entry-title"><?php the_title(); ?></h1>
			</header>
			<?php do_action( 'ksasacademic_page_before_entry_content' ); ?>
			<div class="entry-content">
				<?php the_content(); ?>
				<div class="study-fields callout lightgrey" role="region" aria-label="Filters">
					<label for="id_search">
						<h4>Search our Research Scientists:</h4>
					</label>
					<div class="input-group">
						<span class="input-group-label">
							<span class="fa-solid fa-magnifying-glass"></span>
						</span>
							<input class="quicksearch input-group-field" type="text" name="search" id="id_search" aria-label="Search Research Scientists" placeholder="Search by name, title, and research interests"  />
					</div>
				</div>
			</div>
		</article>

			<?php endwhile; ?>
			<div id="isotope-list" class="people-directory loading" role="region" aria-label="Results">
				<ul class="directory">

				<?php
				if ( $research_staff_query->have_posts() ) :
					while ( $research_staff_query->have_posts() ) :
						$research_staff_query->the_post();
						?>
						<?php
						if ( get_post_meta( $post->ID, 'ecpt_bio', true ) ) :
							get_template_part( 'template-parts/hasbio-loop' );
						else :
							get_template_part( 'template-parts/nobio-loop' );
						endif;
						?>
						<?php
					endwhile;
				endif;
				wp_reset_postdata();
				?>
					<div id="noResult">
						<div class="callout warning">
							<h5>Sorry, No Results Found</h5>
							<p>Try changing your search terms</a></p>
						</div>
					</div>
				</ul>
			</div>
		</main>
		<?php do_action( 'ksasacademic_after_content' ); ?>
		<?php get_sidebar(); ?>
	</div>
</div>

<?php
get_template_part( 'template-parts/script-initiators' );
get_footer();
