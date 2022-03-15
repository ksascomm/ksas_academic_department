<?php
/*
Template Name: Job Market Candidate
*/
get_header(); ?>

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
	<?php
	if ( false === ( $job_market_query = get_transient( 'job_market_query' ) ) ) {
		   // It wasn't there, so regenerate the data and save the transient
		$job_market_query = new WP_Query(
			array(
				'post_type'      => 'people',
				'role'           => 'job-market-candidate',
				'meta_key'       => 'ecpt_people_alpha',
				'orderby'        => 'meta_value',
				'order'          => 'ASC',
				'posts_per_page' => 100,
			)
		);
		set_transient( 'job_market_query', $job_market_query, 345600 );
	}
	if ( $job_market_query->have_posts() ) :
		?>
				<ul class="directory">
			<?php
			while ( $job_market_query->have_posts() ) :
				$job_market_query->the_post();
				?>
			<li class="callout person <?php echo esc_html( get_the_roles( $post ) ); ?>">
				<div class="media-object">
				<?php if ( has_post_thumbnail() ) : ?>
						<div class="media-object-section">
							<?php
							$alttitle = get_the_title();
								the_post_thumbnail( 'directory', array( 'alt' => $alttitle ) );
							?>
						</div>
					<?php endif; ?>
					<div class="media-object-section">
						<?php if ( get_post_meta( $post->ID, 'ecpt_bio', true ) || get_post_meta( $post->ID, 'ecpt_thesis', true ) ) : ?>
							<h3>
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h3>
						<?php else : ?>
							<h3><?php the_title(); ?></h3>
						<?php endif; ?>
						<?php if ( get_post_meta( $post->ID, 'ecpt_position', true ) ) : ?>
							<h4>
								<?php echo get_post_meta( $post->ID, 'ecpt_position', true ); ?>
							</h4>
						<?php endif; ?>
						<?php if ( get_post_meta( $post->ID, 'ecpt_degrees', true ) ) : ?>
							<h4>
								<?php echo get_post_meta( $post->ID, 'ecpt_degrees', true ); ?>
							</h4>
						<?php endif; ?>
							<ul class="contact">
							<?php if ( get_post_meta( $post->ID, 'ecpt_phone', true ) ) : ?>
									<li><span class="fa-solid fa-phone-office"></span> <?php echo get_post_meta( $post->ID, 'ecpt_phone', true ); ?></li>
								<?php endif; ?>
								<?php
								if ( get_post_meta( $post->ID, 'ecpt_email', true ) ) :
									$email = get_post_meta( $post->ID, 'ecpt_email', true );
									?>
									<li><span class="fa-solid fa-envelope"></span>
									<?php if ( function_exists( 'email_munge' ) ) : ?>
									<a class="munge" href="&#109;&#97;&#105;&#108;&#116;&#111;&#58;<?php echo email_munge( $email ); ?>">
										<?php echo email_munge( $email ); ?>
									</a>
									<?php else : ?>
									<a href="<?php echo esc_url( 'mailto:' . $email ); ?>"><?php echo esc_html( $email ); ?></a>
									<?php endif; ?>
									</li>
							<?php endif; ?>
							<?php if ( get_post_meta( $post->ID, 'ecpt_office', true ) ) : ?>
									<li><span class="fa-solid fa-location-dot"></span> <?php echo get_post_meta( $post->ID, 'ecpt_office', true ); ?></li>
								<?php endif; ?>
							<?php if ( get_post_meta( $post->ID, 'ecpt_website', true ) ) : ?>
								<li><span class="fa-solid fa-earth-americas"></span>
									<a href="<?php echo esc_url( get_post_meta( $post->ID, 'ecpt_website', true ) ); ?>" target="_blank" aria-label="<?php the_title(); ?>'s Personal Website">Personal Website</a>
								<?php endif; ?>
							</ul>
						<?php if ( get_post_meta( $post->ID, 'ecpt_expertise', true ) ) : ?>
							<p><strong>Research Interests:&nbsp;</strong>
								<?php echo wp_kses_post( get_post_meta( $post->ID, 'ecpt_expertise', true ) ); ?>
							</p>
						<?php endif; ?>
						<?php if ( get_post_meta( $post->ID, 'ecpt_thesis', true ) ) : ?>
							<p><strong>Thesis Title:</strong> "<?php echo esc_html( get_post_meta( $post->ID, 'ecpt_thesis', true ) ); ?>"
							<?php if ( get_post_meta( $post->ID, 'ecpt_job_abstract', true ) ) : ?>
								&nbsp;- <a href="<?php echo esc_url( get_post_meta( $post->ID, 'ecpt_job_abstract', true ) ); ?>">Download Abstract  <span class="fa-solid fa-file-pdf" aria-hidden="true"></span></a>
							<?php endif; ?>
							</p>
						<?php endif; ?>

						<?php if ( get_post_meta( $post->ID, 'ecpt_advisor', true ) ) : ?>
							<p><strong>Main Adviser: </strong><?php echo esc_html( get_post_meta( $post->ID, 'ecpt_advisor', true ) ); ?></p>
						<?php endif; ?>
						<?php if ( get_post_meta( $post->ID, 'ecpt_fields', true ) ) : ?>
							<p><strong>Fields: </strong><?php echo esc_html( get_post_meta( $post->ID, 'ecpt_fields', true ) ); ?></p>
						<?php endif; ?>
					</div>
				</div>
			</li>
		<?php endwhile; ?>
			</ul>
		<?php endif; ?>
	</main>
	<?php do_action( 'ksasacademic_after_content' ); ?>
	<?php get_sidebar(); ?>
</div>
</div>

<?php
get_footer();
