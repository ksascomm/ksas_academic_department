<?php
/**
 * Template Name: People Directory (Alphabetical)
 * This is the template that displays People CPT alphabetically.
 * Unlike other People Directory pages, this should not be a parent
 * but instead a child page.
 *
 * @package KSASAcademicDepartment
 * @since KSASAcademicDepartment 1.0.0
 */

get_header(); ?>
<?php
	$theme_option         = flagship_sub_get_global_options();
	$ids_to_exclude       = array();
	$positions_to_exclude = get_terms(
		'role',
		array(
			'fields' => 'ids',
			'slug'   => array( 'graduate', 'job-market-candidate', 'graduate-student' ),
		)
	);
	// convert the role slug to corresponding IDs.
	if ( ! is_wp_error( $positions_to_exclude ) && count( $positions_to_exclude ) > 0 ) {
		$ids_to_exclude = $positions_to_exclude;
	}
	$positions      = get_terms(
		'role',
		array(
			'orderby'    => 'ID',
			'order'      => 'ASC',
			'hide_empty' => true,
			'exclude'    => $ids_to_exclude,
		)
	);
	$filters        = get_terms(
		'filter',
		array(
			'orderby'    => 'name',
			'order'      => 'ASC',
			'hide_empty' => true,
		)
	);
	$position_slugs = array();
	$filter_slugs   = array();
	foreach ( $positions as $position ) {
		$position_slugs[] = $position->slug;
	}
	$position_classes = implode( ' ', $position_slugs );
	foreach ( $filters as $filter ) {
		$filter_slugs[] = $filter->slug;
	}
	$filter_classes = implode( ' ', $filter_slugs );
	$children       = get_pages(
		array(
			'child_of' => $post->ID,
		)
	);
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
				</div>
			</article>
			<?php endwhile; ?>
			<div class="study-fields callout lightgrey" role="region" aria-label="Filters
			">
				<?php
				// SEARCH BOX.
				if ( $theme_option['flagship_sub_directory_search'] == '1' ) :
					?>
					<label for="id_search">
						<h4>Search our Faculty:</h4>
					</label>
					<div class="input-group">
						<span class="input-group-label">
							<span class="fa-solid fa-magnifying-glass"></span>
						</span>
						<input class="quicksearch input-group-field" type="text" name="search" id="id_search" aria-label="Search by name, title, and research interests" placeholder="Search by name, title, and research interests"  />
					</div>
				<?php endif; ?>
			</div>
			<div id="isotope-list" class="people-directory" role="region" aria-label="Results">
				<ul class="directory">
					<?php
					$position_slug = $position->slug;
					if ( $position_slug !== 'graduate' && $position_slug !== 'job-market-candidate' && $position_slug !== 'graduate-student' ) {
							$people_query_alpha = new WP_Query(
								array(
									'post_type'      => 'people',
									'meta_key'       => 'ecpt_people_alpha',
									'orderby'        => 'meta_value',
									'order'          => 'ASC',
									'posts_per_page' => 100,
								)
							);
						if ( $people_query_alpha->have_posts() ) :
							while ( $people_query_alpha->have_posts() ) :
								$people_query_alpha->the_post();

								if ( get_post_meta( $post->ID, 'ecpt_bio', true ) ) :
									get_template_part( 'template-parts/hasbio-loop' );
								else :
									get_template_part( 'template-parts/nobio-loop' );
								endif;

							endwhile;
						endif;
					}
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
