<?php
/**
 * The template for displaying all single People CPT
 *
 * @package KSASAcademicDepartment
 * @since   KSASAcademicDepartment 1.0.0
 */

get_header(); ?>


<div class="main-container" id="page">
	<div class="main-grid">
		<main class="main-content">
			<?php do_action( 'ksasacademic_before_content' ); ?>
			<?php
			if ( have_posts() ) :
				while ( have_posts() ) :
					the_post();
					?>
			<article aria-labelledby="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="article-header">
					<h1 class="entry-title single-title" itemprop="headline" id="post-<?php the_ID(); ?>"><?php the_title(); ?>	<?php if ( get_post_meta( $post->ID, 'ecpt_pronoun', true ) ) : ?>
							<small>(<?php echo wp_kses_post( get_post_meta( $post->ID, 'ecpt_pronoun', true ) ); ?>)</small>
					<?php endif; ?> </h1>
				</header>
				<div class="grid-x grid-margin-x bio">
					<?php if ( has_post_thumbnail() ) : ?>
						<div class="small-12 medium-4 cell">
							<?php
							the_post_thumbnail(
								'full',
								array(
									'class' => 'headshot',
									'alt'   => esc_html( get_the_title() ),
								)
							);
							?>
						</div>
						<div class="small-12 medium-8 cell">
					<?php else : ?>
						<div class="small-12 medium-10 cell">
					<?php endif; ?>
					<?php if ( get_post_meta( $post->ID, 'ecpt_position', true ) ) : ?>
							<h2><?php echo wp_kses_post( get_post_meta( $post->ID, 'ecpt_position', true ) ); ?></h2>
					<?php endif; ?>
							<p class="listing">
								<?php
								if ( get_post_meta( $post->ID, 'ecpt_email', true ) ) :
									$email = get_post_meta( $post->ID, 'ecpt_email', true );
									?>
									<?php if ( get_post_meta( $post->ID, 'ecpt_leave', true ) ) : ?>
									<span class="fa-solid fa-calendar-circle-exclamation" aria-hidden="true"></span> <strong>On Leave: <?php echo esc_html( get_post_meta( $post->ID, 'ecpt_leave', true ) ); ?></strong><br>
								<?php endif; ?>
								<span class="fa-solid fa-envelope" aria-hidden="true"></span>
									<?php if ( function_exists( 'email_munge' ) ) : ?>
									<a class="munge" href="&#109;&#97;&#105;&#108;&#116;&#111;&#58;<?php echo email_munge( $email ); ?>">
										<?php echo email_munge( $email ); ?>
									</a>
									<?php else : ?>
									<a href="<?php echo esc_url( 'mailto:' . $email ); ?>"><?php echo esc_html( $email ); ?></a>
									<?php endif; ?>
									<br>
								<?php endif; ?>
								<?php if ( get_field( 'ecpt_cv' ) ) : ?>
								<span class="fa-solid fa-file-pdf" aria-hidden="true"></span> <a href="<?php the_field( 'ecpt_cv' ); ?>">Curriculum Vitae</a><br>
								<?php endif; ?>
								<?php
								$file = get_field( 'cv_file' );
								if ( $file ) :
									?>
								<span class="fa-solid fa-file-pdf" aria-hidden="true"></span> <a href="<?php echo esc_url( $file['url'] ); ?>">Curriculum Vitae</a><br>
								<?php endif; ?>
								<?php if ( get_post_meta( $post->ID, 'ecpt_office', true ) ) : ?>
								<span class="fa-solid fa-location-dot" aria-hidden="true"></span> <?php echo esc_html( get_post_meta( $post->ID, 'ecpt_office', true ) ); ?><br>
								<?php endif; ?>
								<!-- Do not display Office Hours if Person is On Leave -->
								<?php
								if ( empty( get_post_meta( $post->ID, 'ecpt_leave', true ) ) ) :
									?>
									<?php if ( get_post_meta( $post->ID, 'ecpt_hours', true ) ) : ?>
									<span class="fa-solid fa-door-open" aria-hidden="true"></span> 
										<?php if ( get_post_meta( $post->ID, 'ecpt_hours_link', true ) ) : ?>
											<a href="<?php echo esc_html( get_post_meta( $post->ID, 'ecpt_hours_link', true ) ); ?>">
												<?php echo esc_html( get_post_meta( $post->ID, 'ecpt_hours', true ) ); ?>
											</a>
										<?php else : ?>
											<?php echo esc_html( get_post_meta( $post->ID, 'ecpt_hours', true ) ); ?>
										<?php endif; ?>
										<br>
									<?php endif; ?>
								<?php endif; ?>
								<!-- End On Leave Conditional -->
								<?php if ( get_post_meta( $post->ID, 'ecpt_phone', true ) ) : ?>
								<span class="fa-solid fa-phone-office" aria-hidden="true"></span> <?php echo esc_html( get_post_meta( $post->ID, 'ecpt_phone', true ) ); ?><br>
								<?php endif; ?>
								<?php if ( get_post_meta( $post->ID, 'ecpt_website', true ) ) : ?>
								<span class="fa-solid fa-earth-americas" aria-hidden="true"></span> <a href="<?php echo esc_url( get_post_meta( $post->ID, 'ecpt_website', true ) ); ?>" target="_blank">Personal Website</a><br>
								<?php endif; ?>
								<?php if ( get_post_meta( $post->ID, 'ecpt_lab_website', true ) ) : ?>
								<span class="fa-solid fa-earth-americas" aria-hidden="true"></span> <a href="<?php echo esc_url( get_post_meta( $post->ID, 'ecpt_lab_website', true ) ); ?>" target="_blank">Group/Lab Website</a><br>
								<?php endif; ?>
								<?php if ( get_post_meta( $post->ID, 'ecpt_google_id', true ) ) : ?>
								<span class="fa-brands fa-google"></span> <a href="http://scholar.google.com/citations?user=<?php echo esc_html( get_post_meta( $post->ID, 'ecpt_google_id', true ) ); ?>" target="_blank">Google Scholar Profile</a><br>
								<?php endif; ?>
								<?php if ( get_post_meta( $post->ID, 'ecpt_orcid_id', true ) ) : ?>
								<span class="fa-brands fa-orcid"></span> <a href="http://orcid.org/<?php echo esc_html( get_post_meta( $post->ID, 'ecpt_orcid_id', true ) ); ?>" target="_blank">ORCID Profile</a><br>
								<?php endif; ?>
								<?php if ( get_post_meta( $post->ID, 'ecpt_twitter', true ) ) : ?>
								<span class="fa-brands fa-twitter"></span> <a href="https://twitter.com/<?php echo esc_html( get_post_meta( $post->ID, 'ecpt_twitter', true ) ); ?>" target="_blank"> @<?php echo esc_html( get_post_meta( $post->ID, 'ecpt_twitter', true ) ); ?></a>
								<?php endif; ?>
							</p>
							<?php if ( get_post_meta( $post->ID, 'ecpt_expertise', true ) ) : ?>
								<p><strong>Research Interests:&nbsp;</strong><?php echo esc_html( get_post_meta( $post->ID, 'ecpt_expertise', true ) ); ?></p>
							<?php endif; ?>
								<?php if ( get_post_meta( $post->ID, 'ecpt_degrees', true ) ) : ?>
									<p><strong>Education:</strong> <?php echo wp_kses_post( get_post_meta( $post->ID, 'ecpt_degrees', true ) ); ?></p>
								<?php endif; ?>
					</div>
				</div>
					<?php
					if ( ! empty( get_post_meta( $post->ID, 'ecpt_bio', true ) ) ) :
						?>
				<ul class="tabs margin10" data-tabs id="profile-tabs">
						<?php if ( get_post_meta( $post->ID, 'ecpt_bio', true ) ) : ?>
					<li class="tabs-title is-active"><a href="#bioTab">Biography</a></li>
					<?php endif; ?>
						<?php if ( get_post_meta( $post->ID, 'ecpt_research', true ) ) : ?>
					<li class="tabs-title"><a href="#researchTab">Research</a></li>
					<?php endif; ?>

						<?php if ( get_post_meta( $post->ID, 'ecpt_teaching', true ) ) : ?>
					<li class="tabs-title"><a href="#teachingTab">Teaching</a></li>
					<?php endif; ?>

						<?php if ( get_post_meta( $post->ID, 'ecpt_publications', true ) ) : ?>
					<li class="tabs-title"><a href="#publicationsTab">Publications</a></li>
					<?php endif; ?>
						<?php if ( get_post_meta( $post->ID, 'ecpt_books_cond', true ) == 'on' ) : ?>
					<li class="tabs-title"><a href="#booksTab">Books</a></li>
					<?php endif; ?>
						<?php if ( get_post_meta( $post->ID, 'ecpt_extra_tab_title', true ) ) : ?>
					<li class="tabs-title"><a href="#extraTab"><?php echo wp_kses_post( get_post_meta( $post->ID, 'ecpt_extra_tab_title', true ) ); ?></a></li>
					<?php endif; ?>
						<?php if ( get_post_meta( $post->ID, 'ecpt_extra_tab_title2', true ) ) : ?>
					<li class="tabs-title"><a href="#extra2Tab"><?php echo wp_kses_post( get_post_meta( $post->ID, 'ecpt_extra_tab_title2', true ) ); ?></a></li>
					<?php endif; ?>
				</ul>

				<div class="tabs-content people-content" data-tabs-content="profile-tabs">
						<?php if ( get_post_meta( $post->ID, 'ecpt_bio', true ) ) : ?>
					<div class="tabs-panel is-active" id="bioTab" itemprop="articleBody">
							<?php echo wp_kses_post( get_post_meta( $post->ID, 'ecpt_bio', true ) ); ?>
						<!--Graduate Student Content Start -->
							<?php if ( get_post_meta( $post->ID, 'ecpt_advisor', true ) ) : ?>
								<p><strong>Main Advisor:</strong>&nbsp;<?php echo esc_html( get_post_meta( $post->ID, 'ecpt_advisor', true ) ); ?></p>
							<?php endif; ?>
							<!-- If there's 'ecpt_thesis', echo 'ecpt_job_abstract' or '' immediately adjacent -->
							<?php if ( get_post_meta( $post->ID, 'ecpt_thesis', true ) ) : ?>
							<p>
							<strong>Thesis Title:</strong> "<?php echo esc_html( get_post_meta( $post->ID, 'ecpt_thesis', true ) ); ?>"
								<!-- This is original file, or plain text link  -->
								<?php if ( get_field( 'ecpt_job_abstract' ) ) : ?>
								<a href="<?php the_field( 'ecpt_job_abstract' ); ?>">(Download Abstract)</a> <span class="fa-solid fa-file-pdf" aria-hidden="true"></span>
								<?php endif; ?>
								<!-- ACF File Upload Here  -->
								<?php
								$abstract_file = get_field( 'abstract_file' );
								if ( $abstract_file ) :
									?>
								<a href="<?php echo esc_url( $abstract_file['url'] ); ?>">(Download Abstract)</a> <span class="fa-solid fa-file-pdf" aria-hidden="true"></span>
								<?php endif; ?>
							</p>
							<?php endif; ?>
							<!-- If there's no 'ecpt_thesis', just echo file  -->
							<?php if ( ! get_post_meta( $post->ID, 'ecpt_thesis', true ) ) : ?>
								<!-- This is original file, or plain text link  -->
								<?php if ( get_field( 'ecpt_job_abstract' ) ) : ?>
								<p><a href="<?php the_field( 'ecpt_job_abstract' ); ?>">Download Thesis Abstract</a> <span class="fa-solid fa-file-pdf" aria-hidden="true"></span></p>
								<?php endif; ?>
								<!-- ACF File Upload Here  -->
								<?php
								$abstract_file = get_field( 'abstract_file' );
								if ( $abstract_file ) :
									?>
								<p><a href="<?php echo esc_url( $abstract_file['url'] ); ?>">Download Thesis Abstract</a> <span class="fa-solid fa-file-pdf" aria-hidden="true"></span></p>
								<?php endif; ?>
							<?php endif; ?>
							<?php if ( get_post_meta( $post->ID, 'ecpt_fields', true ) ) : ?>
								<p><strong>Fields:</strong>&nbsp;<?php echo esc_html( get_post_meta( $post->ID, 'ecpt_fields', true ) ); ?></p>
							<?php endif; ?>
					<?php endif; ?>
					<!--Graduate Student Content End -->
					</div>
					<?php endif; ?>

						<?php if ( get_post_meta( $post->ID, 'ecpt_research', true ) ) : ?>
					<div class="tabs-panel" id="researchTab"><?php echo wp_kses_post( get_post_meta( $post->ID, 'ecpt_research', true ) ); ?></div>
					<?php endif; ?>

						<?php if ( get_post_meta( $post->ID, 'ecpt_teaching', true ) ) : ?>
					<div class="tabs-panel" id="teachingTab"><?php echo wp_kses_post( get_post_meta( $post->ID, 'ecpt_teaching', true ) ); ?></div>
					<?php endif; ?>

						<?php if ( get_post_meta( $post->ID, 'ecpt_publications', true ) ) : ?>
					<div class="tabs-panel" id="publicationsTab">
							<?php echo wp_kses_post( get_post_meta( $post->ID, 'ecpt_publications', true ) ); ?>
					</div>
					<?php endif; ?>
						<?php
						if ( get_post_meta( $post->ID, 'ecpt_books_cond', true ) == 'on' ) :
							locate_template( 'template-parts/faculty-books-tabbed.php', true, false );
					endif;
						?>
						<?php if ( get_post_meta( $post->ID, 'ecpt_extra_tab', true ) ) : ?>
						<div class="tabs-panel"  id="extraTab"><?php echo apply_filters( 'the_content', wp_kses_post( get_post_meta( $post->ID, 'ecpt_extra_tab', true ) ) ); ?></div>
						<?php endif; ?>

						<?php if ( get_post_meta( $post->ID, 'ecpt_extra_tab2', true ) ) : ?>
						<div class="tabs-panel" id="extra2Tab"><?php echo apply_filters( 'the_content', wp_kses_post( get_post_meta( $post->ID, 'ecpt_extra_tab2', true ) ) ); ?></div>
						<?php endif; ?>
				</div>

				</article>
					<?php
		endwhile;
endif;
			?>
	</main>
	<?php do_action( 'ksasacademic_after_content' ); ?>
	<?php get_sidebar(); ?>
</div>
</div>
<?php
get_footer();
