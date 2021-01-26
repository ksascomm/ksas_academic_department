<?php
/*
Template Name: Research Staff Directory
*/
get_header(); ?>

<?php
if ( false === ( $research_staff_query = get_transient( 'research_staff_query' ) ) ) :
       // It wasn't there, so regenerate the data and save the transient
	$research_staff_query = new WP_Query(
        array(
			'post_type' => 'people',
			'role' => 'research',
			'meta_key' => 'ecpt_people_alpha',
			'orderby' => 'meta_value',
			'order' => 'ASC',
			'posts_per_page' => 250,
		)
        );
	set_transient( 'research_staff_query', $research_staff_query, 345600 );
endif;
?>

<div class="main-container" id="page">
	<div class="main-grid">
		<main class="main-content">
		<?php do_action( 'ksasacademic_before_content' ); ?>

		<?php while ( have_posts() ) : the_post(); ?>

		  <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
		      <header aria-label="<?php the_title(); ?>">
		          <h1 class="entry-title"><?php the_title(); ?></h1>
		      </header>
		      <?php do_action( 'ksasacademic_page_before_entry_content' ); ?>
		      <div class="entry-content">
		          <?php the_content(); ?>
		         <div class="study-fields callout lightgrey" role="region" aria-label="Filters">
					<label for="id_search">
						<h4>Search our Research Staff:</h4>
					</label>
					<div class="input-group">
						<span class="input-group-label">
							<span class="fa fa-search"></span>
						</span>
							<input class="quicksearch input-group-field" type="text" name="search" id="id_search" aria-label="Search Research Staff" placeholder="Search by name, title, and research interests"  />
					</div>
		          </div>
		      </div>
		  </article>

			<?php endwhile; ?>
			<div id="isotope-list" class="people-directory loading" role="region" aria-label="Results">
				<ul class="directory">

				<?php if ($research_staff_query->have_posts() ) : while ($research_staff_query->have_posts() ) : $research_staff_query->the_post(); ?>

					<li class="item person <?php echo get_the_directory_filters($post); ?> <?php echo get_the_roles($post); ?>">
						<div class="media-object">
							<?php if ( has_post_thumbnail() ) { ?>
							<div class="media-object-section">
								<?php $title=get_the_title();
									the_post_thumbnail('directory', array( 'alt' => $title ) );
								?>
							</div>
							<?php } ?>
							<div class="media-object-section">
							<?php if ( get_post_meta($post->ID, 'ecpt_bio', true) ) : ?>
								<h3>
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h3>
							<?php else : ?>
								<h3><?php the_title(); ?></h3>
							<?php endif; ?>
							<?php if ( array(get_post_meta($post->ID, 'ecpt_position', true) || get_post_meta($post->ID, 'ecpt_degrees', true )) ) : ?>
								<h4>
									<?php echo get_post_meta($post->ID, 'ecpt_position', true); ?>

										<br>

									<?php echo get_post_meta($post->ID, 'ecpt_degrees', true); ?>
								</h4>
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
									<?php if ( get_post_meta($post->ID, 'ecpt_website', true) ) : ?>
											<li><span class="fa fa-globe"></span>
												<a href="<?php echo get_post_meta($post->ID, 'ecpt_website', true); ?>" target="_blank" aria-label="<?php the_title(); ?>'s Personal Website">Personal Website</a>
											</li>
										<?php endif; ?>
										<?php if ( get_post_meta($post->ID, 'ecpt_lab_website', true) ) : ?>
							    		<li><span class="fa fa-globe"></span>
							    			<a href="<?php echo get_post_meta($post->ID, 'ecpt_lab_website', true); ?>" onclick="ga('send', 'event', 'People Directory', 'Group/Lab Website', '<?php the_title(); ?> | <?php echo get_post_meta($post->ID, 'ecpt_lab_website', true); ?>')" target="_blank" aria-label="<?php the_title(); ?>'s Group/Lab Website">Group/Lab Website</a>
							    		</li>
									<?php endif; ?>
									<?php if ( get_post_meta($post->ID, 'ecpt_expertise', true) ) : ?>
										<p class="expertise">
											<strong>Research Interests:&nbsp;</strong><?php echo get_post_meta($post->ID, 'ecpt_expertise', true); ?>
										</p>
									<?php endif; ?>
								</ul>

							</div>
						</div>
					</li>
					<?php endwhile; endif; wp_reset_postdata(); ?>
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
