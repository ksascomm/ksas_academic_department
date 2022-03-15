<?php
/**
 * Template Name: Front
 * The template for displaying the a front page with no
 * buckets, slides, or video.
 * Option for news or hub feed below buckets.
 *
 * @package KSASAcademicDepartment
 * @since KSASAcademicDepartment 1.0.0
 */

get_header(); ?>
	<?php if ( has_post_thumbnail( $post->ID ) ) : ?>
		<header class="hero" role="banner" aria-label="Featured Image">
			<div class="full-screen-image show-for-large">
				<div class="front-hero static" role="banner">
				<?php
						the_post_thumbnail(
							'full',
							array(
								'class'   => 'featured-hero-image',
								'loading' => 'eager',
							)
						);
				?>
				</div>
			</div>
		</header>
	<?php endif; ?>
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
		<?php $featured_sidebar = is_active_sidebar( 'homepage-featured-sb' ); ?>
		<?php if ( $featured_sidebar ) : ?>
			<div class="grid-x grid-padding-x grid-container">
				<!--Show Featured Widget-->
				<div class="small-12 cell home-featured-widget-area">
					<?php dynamic_sidebar( 'homepage-featured-sb' ); ?>
				</div>
			</div>
			<?php endif; ?>
	<?php endwhile; ?>
	<?php do_action( 'ksasacademic_after_content' ); ?>

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

					<a class="button news-archive" href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?> " class="button" id="newsarchive">
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
