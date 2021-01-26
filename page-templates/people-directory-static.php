<?php
/*
Template Name: People Directory (No Search/Filter)
*/
get_header(); ?>
<?php
	$theme_option = flagship_sub_get_global_options();
	$ids_to_exclude = array();
	$roles_to_exclude =  get_terms(
		'role', array(
	    'fields' => 'ids',
	    'slug' => array( 'graduate', 'job-market-candidate', 'graduate-student','research' ),
	));
	//convert the role slug to corresponding IDs
	if( !is_wp_error( $roles_to_exclude ) && count($roles_to_exclude) > 0){
	    $ids_to_exclude = $roles_to_exclude;
	}
	$roles = get_terms(
        'role', array(
			'orderby'       => 'ID',
			'order'         => 'ASC',
			'hide_empty'    => true,
			'exclude'       => $ids_to_exclude,
		)
    );
	$filters = get_terms(
        'filter', array(
			'orderby'       => 'name',
			'order'         => 'ASC',
			'hide_empty'    => true,
		)
    );
	$role_slugs = array();
	$filter_slugs = array();
	foreach ($roles as $role ) {
		$role_slugs[] = $role->slug;
	}
	$role_classes = implode(' ', $role_slugs);
	foreach ($filters as $filter ) {
		$filter_slugs[] = $filter->slug;
	}
	$filter_classes = implode(' ', $filter_slugs);
	$children = get_pages( array(
		'child_of' => $post->ID,
	) );
?>
<div class="main-container" id="page">
	<div class="main-grid">
		<?php if ( count( $children ) >= 1 ) : ?>
			<main class="main-content">
		<?php else : ?>
			<main class="main-content-full-width">
		<?php endif; ?>
			<?php do_action( 'ksasacademic_before_content' ); ?>
			<?php
            while ( have_posts() ) :
the_post();
?>
			<article <?php post_class(); ?> aria-label="<?php the_title(); ?>">
				<header aria-label="<?php the_title(); ?>">
					<h1 class="entry-title"><?php the_title(); ?></h1>
				</header>
				<?php do_action( 'ksasacademic_page_before_entry_content' ); ?>
				<div class="entry-content">
					<?php the_content(); ?>
				</div>
			</article>
			<?php endwhile; ?>
			<div id="isotope-list" class="people-directory" role="region" aria-label="Results">
				<ul class="directory">
					<?php
                    foreach ($roles as $role ) {
					$role_slug = $role->slug;
					$role_name = $role->name;
					if ($role_slug !== 'graduate' && $role_slug !== 'job-market-candidate' && $role_slug !== 'graduate-student' && $role_slug !== 'research' ) {
							$people_query = new WP_Query(
                            array(
								'post_type' => 'people',
								'role' => $role_slug,
								'meta_key' => 'ecpt_people_alpha',
								'orderby' => 'meta_value',
								'order' => 'ASC',
								'posts_per_page' => 250,
							)
								);
											}
					if ($people_query->have_posts() ) :
							?>
							<li class="person sub-head quicksearch-match <?php echo $role->slug; ?>">
							<h2 class="black capitalize"><?php echo $role_name; ?>
							</h2>
							</li>
							<?php
							while ($people_query->have_posts() ) :
	$people_query->the_post();
	?>

					<?php
                    if ( get_post_meta($post->ID, 'ecpt_bio', true) ) :
							get_template_part( 'template-parts/hasbio-loop' );
						else :
							get_template_part( 'template-parts/nobio-loop' );
						endif;
						?>
						<?php endwhile; endif; } wp_reset_postdata(); ?>
				</ul>
			</div>
		</main>
		<?php do_action( 'ksasacademic_after_content' ); ?>
		<?php if ( count( $children ) >= 1 ) : ?>
			<?php get_sidebar(); ?>
		<?php endif;?>
	</div>
</div>
<?php
get_template_part( 'template-parts/script-initiators' );
get_footer();
