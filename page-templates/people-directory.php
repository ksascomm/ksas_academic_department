<?php
/*
Template Name: People Directory
*/
get_header(); ?>
<?php
	$theme_option     = flagship_sub_get_global_options();
	$ids_to_exclude   = array();
	$roles_to_exclude = get_terms(
		'role',
		array(
			'fields' => 'ids',
			'slug'   => array( 'graduate', 'job-market-candidate', 'graduate-student', 'research' ),
		)
	);
	// convert the role slug to corresponding IDs
	if ( ! is_wp_error( $roles_to_exclude ) && count( $roles_to_exclude ) > 0 ) {
		$ids_to_exclude = $roles_to_exclude;
	}
	$roles        = get_terms(
		'role',
		array(
			'orderby'    => 'ID',
			'order'      => 'ASC',
			'hide_empty' => true,
			'exclude'    => $ids_to_exclude,
		)
	);
	$filters      = get_terms(
		'filter',
		array(
			'orderby'    => 'name',
			'order'      => 'ASC',
			'hide_empty' => true,
		)
	);
	$role_slugs   = array();
	$filter_slugs = array();
	foreach ( $roles as $role ) {
		$role_slugs[] = $role->slug;
	}
	$role_classes = implode( ' ', $role_slugs );
	foreach ( $filters as $filter ) {
		$filter_slugs[] = $filter->slug;
	}
	$filter_classes = implode( ' ', $filter_slugs );
	?>
<div class="main-container" id="page">
	<div class="main-grid">
		<main class="main-content">
			<?php do_action( 'ksasacademic_before_content' ); ?>
			<?php
			while ( have_posts() ) :
				the_post();
				?>
			<article <?php post_class(); ?> aria-label="<?php the_title(); ?>">
				<header>
					<h1 class="entry-title"><?php the_title(); ?></h1>
				</header>
				<?php do_action( 'ksasacademic_page_before_entry_content' ); ?>
				<div class="entry-content">
					<?php the_content(); ?>
				</div>
			</article>
			<?php endwhile; ?>
			<?php if ( $theme_option['flagship_sub_role_search'] == true || $theme_option['flagship_sub_research_search'] == true || $theme_option['flagship_sub_directory_search'] == '1' ) : ?>
				<div class="directory-search callout lightgrey" role="region" aria-label="Filters">
					<?php
					// ROLE FILTER BUTTONS
					if ( $theme_option['flagship_sub_role_search'] == true ) :
						?>
						<?php

						$count_roles = count( $roles );
						if ( $count_roles > 0 ) :
							?>
					<p>Filter by Title:</p>
					<ul class="filter-list menu role-group" data-filter-group="role">
							<?php foreach ( $roles as $role ) : ?>
						<li class="role-filter">
							<a class="button capitalize" href="javascript:void(0)" data-filter=".<?php echo $role->slug; ?>" class="selected" aria-label="<?php echo $role->name; ?> Research Area Filter"><?php echo $role->name; ?></a>
						</li>
						<?php endforeach; ?>
					</ul>
							<?php
					endif;
endif;
					?>
					<?php
					// SEARCH BOX
					if ( $theme_option['flagship_sub_directory_search'] == '1' ) :
						?>
					<div class="grid-x search-sort">
						<div class="large-8 cell">
							<label for="id_search">
								<p>Search by name, title, and research interests:</p>
							</label>
							<div class="input-group">
								<span class="input-group-label">
									<span class="fa fa-search"></span>
								</span>
								<input class="quicksearch input-group-field" type="text" name="search" id="id_search" aria-label="Search by name, title, and research interests"  />
							</div>
						</div>
					</div>
					<?php endif; ?>
					<?php
					// RESEARCH AREA/EXPERTISE FILTER BUTTONS
					if ( $theme_option['flagship_sub_research_search'] == true ) :
						?>
					<p>Filter all by Research Area:</p>
						<?php
						$count_filters = count( $filters );
						if ( $count_filters > 0 ) :
							?>
					<ul class="filter-list menu expertise-group" data-filter-group="expertise">
							<?php foreach ( $filters as $filter ) : ?>
						<li class="role-filter">
							<a class="button capitalize" href="javascript:void(0)" data-filter=".<?php echo $filter->slug; ?>"><?php echo $filter->name; ?></a>
						</li>
						<?php endforeach; ?>
					</ul>
							<?php
					endif;
endif;
					?>
				</div>
			<?php endif; ?>
			<div id="isotope-list" class="people-directory loading" role="region" aria-label="Results">
				<ul class="directory">
					<?php
					foreach ( $roles as $role ) {
						$role_slug = $role->slug;
						$role_name = $role->name;

						$people_query = new WP_Query(
							array(
								'post_type'      => 'people',
								'role'           => $role_slug,
								'meta_key'       => 'ecpt_people_alpha',
								'orderby'        => 'meta_value',
								'order'          => 'ASC',
								'posts_per_page' => 250,
							)
						);

						if ( $people_query->have_posts() ) :
							?>
							<li class="person sub-head quicksearch-match <?php echo $role->slug; ?>">
								<h2 class="black capitalize"><?php echo $role_name; ?> </h2>
							</li>
							<?php
							while ( $people_query->have_posts() ) :
								$people_query->the_post();
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
					} wp_reset_postdata();
					?>
					<li id="noResult">
						<div class="callout warning">
							<h5>Sorry, No Results Found</h5>
							<p>Try changing your search terms</a></p>
						</div>
					</li>
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
