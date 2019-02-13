<?php
/*
 * Template Name: People Directory (Alphabetical)
 * This is the template that displays People CPT alphabetically.
 * Unlike other People Directory pages, this should not be a parent
 * but instead a child page.
*/
get_header(); ?>
<?php
	$theme_option = flagship_sub_get_global_options();
	$ids_to_exclude = array();
	$roles_to_exclude =  get_terms(
		'role', array(
	    'fields' => 'ids',
	    'slug' => array( 'graduate', 'job-market-candidate', 'graduate-student' ),
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
		<main class="main-content">
			<?php do_action( 'foundationpress_before_content' ); ?>
			<?php
            while ( have_posts() ) :
the_post();
?>
			<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
				<header aria-label="<?php the_title(); ?>">
					<h1 class="entry-title"><?php the_title(); ?></h1>
				</header>
				<?php do_action( 'foundationpress_page_before_entry_content' ); ?>
				<div class="entry-content">
					<?php the_content(); ?>
				</div>
			</article>
			<?php endwhile; ?>
			<div id="isotope-list" class="people-directory" role="region" aria-label="Results">
				<ul class="directory">
					<?php
					$role_slug = $role->slug;
					if ($role_slug !== 'graduate' && $role_slug !== 'job-market-candidate' && $role_slug !== 'graduate-student' ) {
							$people_query_alpha = new WP_Query(
	                            array(
									'post_type' => 'people',
									'meta_key' => 'ecpt_people_alpha',
									'orderby' => 'meta_value',
									'order' => 'ASC',
									'posts_per_page' => '250',
								)
							);
						if ($people_query_alpha->have_posts() ) : while ($people_query_alpha->have_posts() ) : $people_query_alpha->the_post(); ?>
					
							<?php if ( get_post_meta($post->ID, 'ecpt_bio', true) ) :
									get_template_part( 'template-parts/hasbio-loop' );
								else :
									get_template_part( 'template-parts/nobio-loop' );
							endif; ?>
						<?php endwhile; endif; 
					} 
					wp_reset_postdata(); ?>
				</ul>
			</div>
		</main>
		<?php do_action( 'foundationpress_after_content' ); ?>
	
		<?php get_sidebar(); ?>
		
	</div>
</div>
<?php
get_template_part( 'template-parts/script-initiators' );
get_footer();