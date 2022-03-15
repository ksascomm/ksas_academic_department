<?php
/**
 * Template Name: Front (Buckets)
 * The template for displaying the a front page with 3 buckets via ACF
 * and 1 homepage widgets (if active).
 * Option for news or hub feed below buckets.
 *
 * @package KSASAcademicDepartment
 * @since KSASAcademicDepartment 1.0.0
 */

get_header(); ?>

<?php
if ( WP_DEBUG || false === ( $hero_query = get_transient( 'hero_query' ) ) ) {
	$hero_query = new WP_Query(
		array(
			'post_type'      => 'slider',
			'posts_per_page' => 1,
			'orderby'        => 'rand',
			'post_status'    => 'publish',
		)
	);

	// set a 24 hour transient!
	set_transient( 'hero_query', $hero_query, 86400 );
}
?>


<header class="hero" role="banner" aria-label="Explore the Krieger School Slider">
	<div class="full-screen-image show-for-large">

		<?php
		// if slider, show those posts.
		if ( $hero_query->have_posts() ) :
			while ( $hero_query->have_posts() ) :
				$hero_query->the_post();
				$thumbnail_id  = get_post_thumbnail_id( $post->ID );
				$thumbnail_alt = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true );
				?>
			<div class="front-hero slide" role="banner" aria-label="Featured Image">
				<?php
						the_post_thumbnail(
							'full',
							array(
								'class'   => 'featured-hero-image',
								'loading' => 'eager',
							)
						);
				?>
					<?php
					endwhile;
			wp_reset_postdata();
			?>
			<?php
			if ( function_exists( 'get_field' ) && get_field( 'studyfield' ) ) :
				?>
					<?php get_template_part( 'template-parts/study-field-api' ); ?>
			<?php endif; ?>
			<?php
			// if slider query empty, show post thumbnail.
		else :
			?>
			<?php if ( has_post_thumbnail( $post->ID ) ) : ?>
				<div class="front-hero static" role="banner" aria-label="Featured Image">
				<?php
						the_post_thumbnail(
							'full',
							array(
								'class'   => 'featured-hero-image',
								'loading' => 'eager',
							)
						);
				?>
			<?php endif; ?>
			<?php
			if ( function_exists( 'get_field' ) && get_field( 'studyfield' ) ) :
				?>
					<?php get_template_part( 'template-parts/study-field-api' ); ?>
			<?php endif; ?>
		</div>
		<?php endif; ?>
	</div>
</header>

<?php do_action( 'ksasacademic_before_content' ); ?>
<?php
while ( have_posts() ) :
	the_post();
	?>
	<main class="background-bluejaysblue" id="page" tabindex="0" aria-label="Website Introduction">
		<div class="intro">
			<div <?php post_class( 'seo-intro' ); ?> id="post-<?php the_ID(); ?>">
				<?php do_action( 'ksasacademic_page_before_entry_content' ); ?>
				<div class="entry-content">
					<?php the_content(); ?>
				</div>
			</div>
		</div>
	</main>
<?php endwhile; ?>
<?php do_action( 'ksasacademic_after_content' ); ?>
<?php
if ( function_exists( 'get_field' ) && get_field( 'explore_the_department' ) ) :
	?>
	<?php
	if ( have_rows( 'explore_the_department' ) ) :
		$count            = count( get_field( 'explore_the_department' ) );
		$featured_sidebar = is_active_sidebar( 'homepage-featured-sb' );
		?>
<div class="bucket-area" id="explore-bucket" role="complementary">
	<div class="buckets">
		<?php $heading = get_field( 'buckets_heading' ); ?>
		<!--Print Heading if there-->
		<?php if ( $heading ) : ?>
		<div class="grid-x grid-padding-x">
			<header class="cell explore-title" aria-label="<?php the_field( 'buckets_heading' ); ?>">
				<h2><?php echo esc_html( $heading ); ?></h2>
			</header>
		</div>
		<?php endif; ?>
		<!--Show Columns Dynamically-->
		<?php if ( $count == 2 && $featured_sidebar ) : ?>
			<div class="grid-x grid-padding-x small-up-1 medium-up-2 large-up-3" data-equalizer data-equalize-on="large">
		<?php elseif ( $count == 3 && $featured_sidebar ) : ?>
			<div class="grid-x grid-padding-x small-up-1 medium-up-2 large-up-4" data-equalizer data-equalize-on="large">
		<?php elseif ( $count == 3 && ! $featured_sidebar ) : ?>
			<div class="grid-x grid-padding-x small-up-1 medium-up-2 large-up-3" data-equalizer data-equalize-on="large">
		<?php elseif ( $count == 2 && ! $featured_sidebar ) : ?>
			<div class="grid-x grid-padding-x small-up-1 medium-up-2 large-up-2" data-equalizer data-equalize-on="large">
		<?php endif; ?>
		<?php
		while ( have_rows( 'explore_the_department' ) ) :
			the_row();
			?>
			<!--Loop through each repeater field-->
			<div class="cell " aria-label="<?php the_sub_field( 'explore_bucket_heading' ); ?>">
				<article class="bucket"  data-equalizer-watch aria-label="<?php the_sub_field( 'explore_bucket_heading' ); ?>">
					<a href="<?php the_sub_field( 'explore_bucket_link' ); ?>">
						<?php
						$image = get_sub_field( 'explore_bucket_image' );
						if ( get_sub_field( 'explore_bucket_image' ) ) :
							?>
						<div class="bucket-image">
							<?php echo wp_get_attachment_image( $image['ID'], 'full', false ); ?>
						</div>
						<?php endif; ?>
						<div class="bucket-title">
							<h3><?php the_sub_field( 'explore_bucket_heading' ); ?></h3>
						</div>
						<div class="bucket-text">
							<p><?php the_sub_field( 'explore_bucket_text' ); ?></p>
						</div>
					</a>
				</article>
			</div>
		<?php endwhile; ?>
				<?php if ( $featured_sidebar ) : ?>
				<!--Show Featured Widget-->
				<div class="cell">
					<?php dynamic_sidebar( 'homepage-featured-sb' ); ?>
				</div>
			<?php endif; ?>
			</div>
	</div>
</div>
	<?php endif; ?>
<?php endif; ?>
<div class="main-container" role="complementary">
	<div class="main-grid homepage">
		<div class="main-content homepage-news">

			<?php
			$theme_option    = flagship_sub_get_global_options();
			$news_query_cond = $theme_option['flagship_sub_news_query_cond'];
			$news_quantity   = $theme_option['flagship_sub_news_quantity'];
			if ( $news_query_cond === 1 ) {
				$news_query = new WP_Query(
					array(
						'post_type'      => 'post',
						'tax_query'      => array(
							array(
								'taxonomy' => 'category',
								'field'    => 'slug',
								'terms'    => array( 'books' ),
								'operator' => 'NOT IN',
							),
						),
						'posts_per_page' => $news_quantity,
					)
				);
			} else {
				$news_query = new WP_Query(
					array(
						'post_type'      => 'post',
						'posts_per_page' => $news_quantity,
					)
				);
			}
			if ( $news_query->have_posts() ) :
				?>


			<header class="news-title" aria-label="Site Feed">
				<h2><?php echo esc_html( $theme_option['flagship_sub_feed_name'] ); ?></h2>
			</header>

				<?php
				while ( $news_query->have_posts() ) :
					$news_query->the_post();
					?>


					<?php get_template_part( 'template-parts/content-news-homepage', get_post_format() ); ?>

				<?php endwhile; ?>
			<article class="homepage-news-archive" aria-label="<?php echo esc_html( $theme_option['flagship_sub_feed_name'] ); ?>">

				<a class="button news-archive" href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>" class="button" id="newsarchive">
					<?php echo esc_html( $theme_option['flagship_sub_feed_name'] ); ?> Archive <span class="fa-solid fa-circle-chevron-right" aria-hidden="true"></span>
				</a>

			</article>


		<?php endif; ?>

		<?php
		$hub_query_cond = $theme_option['flagship_sub_hub_cond'];
		if ( $hub_query_cond === 1 ) :
			?>
			<header class="hub-title" aria-label="Hub Feed">
				<h2>Related News from <a href="https://hub.jhu.edu/" aria-label="The Hub">The Hub</a></h2>
			</header>
			<?php
			get_template_part( 'template-parts/hub-news' );
			endif;
		?>
		</div>
		<div class="homepage sidebar">
			<?php dynamic_sidebar( 'homepage-sb' ); ?>
		</div>
	</div>
</div>
<?php
get_footer();
