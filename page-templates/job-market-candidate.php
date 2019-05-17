<?php
/*
Template Name: Job Market Candidate
*/
get_header(); ?>

<div class="main-container" id="page">
	<div class="main-grid">
		<main class="main-content">
	<?php do_action( 'foundationpress_before_content' ); ?>

	<?php
    while ( have_posts() ) :
the_post();
?>

	  <article <?php post_class(); ?> aria-label="<?php the_title(); ?>">
	      <header>
	          <h1 class="entry-title"><?php the_title(); ?></h1>
	      </header>
	      <?php do_action( 'foundationpress_page_before_entry_content' ); ?>
	      <div class="entry-content">
	          <?php the_content(); ?>
	      </div>
	  </article>

	<?php endwhile; ?>
	<?php
		if ( false === ( $job_market_query = get_transient( 'job_market_query' ) ) ) {
		       // It wasn't there, so regenerate the data and save the transient
			$job_market_query = new WP_Query(
                array(
					'post_type' => 'people',
					'role' => 'job-market-candidate',
					'meta_key' => 'ecpt_people_alpha',
					'orderby' => 'meta_value',
					'order' => 'ASC',
					'posts_per_page' => '100',
				)
                );
			set_transient( 'job_market_query', $job_market_query, 345600 );
		}
		if ($job_market_query->have_posts() ) :
				?>
				<ul class="directory">
				<?php
				while ($job_market_query->have_posts() ) :
	$job_market_query->the_post();
	?>
			<li class="callout person <?php echo get_the_roles($post); ?>">
				<div class="media-object">
					<?php if ( has_post_thumbnail() ) : ?> 
						<div class="media-object-section">
							<?php $title=get_the_title();
								the_post_thumbnail('directory', array( 'alt' => $title ) ); 
							?>					
						</div>
					<?php endif; ?>
					<div class="media-object-section">	
						<?php if ( get_post_meta($post->ID, 'ecpt_bio', true) ) : ?> 
							<h3>
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h3>
						<?php else : ?>	    
							<h3><?php the_title(); ?></h3>
						<?php endif; ?>
						<?php if ( get_post_meta($post->ID, 'ecpt_position', true) ) : ?>
							<h4>
								<?php echo get_post_meta($post->ID, 'ecpt_position', true); ?>
							</h4>
						<?php endif; ?>
						<?php if ( get_post_meta($post->ID, 'ecpt_degrees', true) ) : ?>
							<h4>
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
									<li><span class="fas fa-map-marker-alt"></span> <?php echo get_post_meta($post->ID, 'ecpt_office', true); ?></li>
								<?php endif; ?>
								<?php if ( get_post_meta($post->ID, 'ecpt_website', true) ) : ?>
	    						<li><span class="fa fa-globe"></span>
									<a href="<?php echo get_post_meta($post->ID, 'ecpt_website', true); ?>" target="_blank">Personal Website</a>
								<?php endif; ?>
							</ul>
						<?php if ( get_post_meta($post->ID, 'ecpt_expertise', true) ) : ?>
							<p><strong>Research Interests:&nbsp;</strong>
								<?php echo get_post_meta($post->ID, 'ecpt_expertise', true); ?>
							</p>
						<?php endif; ?>
						<?php if ( get_post_meta($post->ID, 'ecpt_thesis', true) ) : ?>
							<p><strong>Thesis Title:</strong> "<?php echo get_post_meta($post->ID, 'ecpt_thesis', true); ?>"
	                        <?php if ( get_post_meta($post->ID, 'ecpt_job_abstract', true) ) : ?>
								&nbsp;- <a href="<?php echo get_post_meta($post->ID, 'ecpt_job_abstract', true); ?>">Download Abstract  <span class="fas fa-file-pdf" aria-hidden="true"></span></a>
							<?php endif; ?>
							</p>
						<?php endif; ?>
							
						<?php if ( get_post_meta($post->ID, 'ecpt_advisor', true) ) : ?>
							<p><strong>Main Adviser: </strong><?php echo get_post_meta($post->ID, 'ecpt_advisor', true); ?></p>
						<?php endif; ?>
						<?php if ( get_post_meta($post->ID, 'ecpt_fields', true) ) : ?>
							<p><strong>Fields: </strong><?php echo get_post_meta($post->ID, 'ecpt_fields', true); ?></p>
						<?php endif; ?>
					</div>
				</div>		
			</li>
		<?php endwhile; ?>
			</ul>
		<?php endif; ?>	 
	</main>		
	<?php do_action( 'foundationpress_after_content' ); ?>
	<?php get_sidebar(); ?>
</div>
</div>

<?php
get_footer();
