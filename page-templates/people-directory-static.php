<?php
/*
Template Name: People Directory (No Search/Filter)
*/
get_header(); ?>
<?php
	$theme_option = flagship_sub_get_global_options();
	$roles = get_terms(
        'role', array(
			'orderby'       => 'ID',
			'order'         => 'ASC',
			'hide_empty'    => true,
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
								'posts_per_page' => '250',
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
		<?php do_action( 'foundationpress_after_content' ); ?>
		<?php get_sidebar(); ?>
	</div>
</div>
<?php
get_template_part( 'template-parts/script-initiators' );
get_footer();