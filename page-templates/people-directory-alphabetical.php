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
			<div class="study-fields callout lightgrey" role="region" aria-label="Filters
			">
				<?php //SEARCH BOX
					if ( $theme_option['flagship_sub_directory_search']  == '1' ) :?>					
					<label for="id_search">
						<h4>Search our Faculty:</h4>
					</label>
					<div class="input-group">
						<span class="input-group-label">
							<span class="fa fa-search"></span>
						</span>
						<input class="quicksearch input-group-field" type="text" name="search" id="id_search" aria-label="Search by name, title, and research interests" placeholder="Search by name, title, and research interests"  />
					</div>
				<?php endif;?>
			</div>
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
									'posts_per_page' => 250,
								)
							);
						if ($people_query_alpha->have_posts() ) : while ($people_query_alpha->have_posts() ) : $people_query_alpha->the_post(); ?>
					
							<?php if ( get_post_meta($post->ID, 'ecpt_bio', true) ) : ?>
								<li class="item person">
									<div class="media-object">
										<div class="media-object-section">
											<h3>
												<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
											</h3>
											<?php if ( get_post_meta($post->ID, 'ecpt_position', true) ) : ?>
												<h4><?php echo get_post_meta($post->ID, 'ecpt_position', true); ?></h4>
											<?php endif; ?>	
											<?php if ( get_post_meta($post->ID, 'ecpt_degrees', true) ) : ?>
												<h5><?php echo get_post_meta($post->ID, 'ecpt_degrees', true); ?></h5>
											<?php endif; ?>
											<ul class="contact">
												<?php if ( get_post_meta($post->ID, 'ecpt_phone', true) ) : ?>
													<li><span class="fa fa-phone-square"></span> <?php echo get_post_meta($post->ID, 'ecpt_phone', true); ?></li>
												<?php endif; ?>
												<?php if ( get_post_meta($post->ID, 'ecpt_fax', true) ) : ?>
													<li><span class="fa fa-fax"></span> <?php echo get_post_meta($post->ID, 'ecpt_fax', true); ?></li>
												<?php endif; ?>
												<?php if ( get_post_meta($post->ID, 'ecpt_email', true) ) : ?>
													<li><span class="fa fa-envelope"></span> <a href="mailto:<?php echo get_post_meta($post->ID, 'ecpt_email', true); ?>"> <?php echo get_post_meta($post->ID, 'ecpt_email', true); ?></a></li>
												<?php endif; ?>
												<?php if ( get_post_meta($post->ID, 'ecpt_office', true) ) : ?>
													<li><span class="fa fa-map-marker-alt"></span> <?php echo get_post_meta($post->ID, 'ecpt_office', true); ?></li>
												<?php endif; ?>
												<?php if ( get_post_meta($post->ID, 'ecpt_lab_website', true) ) : ?>
													<li><span class="fa fa-globe"></span> <a href="<?php echo get_post_meta($post->ID, 'ecpt_lab_website', true); ?>" onclick="ga('send', 'event', 'People Directory', 'Group/Lab Website', '<?php the_title(); ?> | <?php echo get_post_meta($post->ID, 'ecpt_lab_website', true); ?>')" target="_blank" aria-label="<?php the_title(); ?>'s Group/Lab Website">Group/Lab Website</a></li>
												<?php endif; ?>
												<?php if ( get_post_meta($post->ID, 'ecpt_expertise', true) ) : ?>
													<li><strong>Research Interests:&nbsp;</strong><?php echo get_post_meta($post->ID, 'ecpt_expertise', true); ?></li>
												<?php endif; ?>			
											</ul>
										</div>
									</div>
								</li>
							<?php else : ?>
								<li class="item person">
									<div class="media-object">
										<div class="media-object-section">
											<h3>
											<?php if ( get_post_meta($post->ID, 'ecpt_website', true) ) : ?>
												<a href="<?php echo get_post_meta($post->ID, 'ecpt_website', true); ?>" title="<?php the_title(); ?>'s webpage" target="_blank">
													<?php the_title(); ?>
												</a>
											<?php else : ?>
												<?php the_title(); ?>
											<?php endif; ?>
											</h3>
											<?php if ( get_post_meta($post->ID, 'ecpt_position', true) ) : ?>
												<h4><?php echo get_post_meta($post->ID, 'ecpt_position', true); ?></h4>
											<?php endif; ?>	
											<?php if ( get_post_meta($post->ID, 'ecpt_degrees', true) ) : ?>
												<h5><?php echo get_post_meta($post->ID, 'ecpt_degrees', true); ?></h5>
											<?php endif; ?>
											<ul class="contact">
												<?php if ( get_post_meta($post->ID, 'ecpt_phone', true) ) : ?>
													<li><span class="fa fa-phone-square"></span> <?php echo get_post_meta($post->ID, 'ecpt_phone', true); ?></li>
												<?php endif; ?>
												<?php if ( get_post_meta($post->ID, 'ecpt_fax', true) ) : ?>
													<li><span class="fa fa-fax"></span> <?php echo get_post_meta($post->ID, 'ecpt_fax', true); ?></li>
												<?php endif; ?>
												<?php if ( get_post_meta($post->ID, 'ecpt_email', true) ) : ?>
													<li><span class="fa fa-envelope"></span> <a href="mailto:<?php echo get_post_meta($post->ID, 'ecpt_email', true); ?>"> <?php echo get_post_meta($post->ID, 'ecpt_email', true); ?></a></li>
												<?php endif; ?>
												<?php if ( get_post_meta($post->ID, 'ecpt_office', true) ) : ?>
													<li><span class="fa fa-map-marker-alt"></span> <?php echo get_post_meta($post->ID, 'ecpt_office', true); ?></li>
												<?php endif; ?>
												<?php if ( get_post_meta($post->ID, 'ecpt_expertise', true) ) : ?>
													<li><strong>Research Interests:&nbsp;</strong><?php echo get_post_meta($post->ID, 'ecpt_expertise', true); ?></li>
												<?php endif; ?>				
											</ul>
										</div>
									</div>
								</li>
						<?php endif; ?>
						<?php endwhile; endif; 
					} 
					wp_reset_postdata(); ?>
					<div id="noResult">
						<div class="callout warning">
					  		<h5>Sorry, No Results Found</h5>
					 		<p>Try changing your search terms</a></p>
						</div>
					</div>
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