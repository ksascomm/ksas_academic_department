<?php
/*
Template Name: Front (Buckets & News)
 * The template for displaying the a front page with 3 buckets via ACF
 * and 1 homepage widgets (if active).
 * Option for news or hub feed below buckets.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */
get_header(); ?>
	<?php if ( has_post_thumbnail( $post->ID ) ) : ?>
		<header class="featured-hero homepage hide-for-print" role="banner" data-interchange="[<?php the_post_thumbnail_url('featured-small'); ?>, small], [<?php the_post_thumbnail_url('featured-medium'); ?>, medium], [<?php the_post_thumbnail_url('featured-large'); ?>, large], [<?php the_post_thumbnail_url('featured-xlarge'); ?>, xlarge]" aria-label="Featured Image">
		</header>
	<?php endif; ?>
	<?php get_template_part( 'template-parts/homepage-slider' ); ?>
	<?php do_action( 'foundationpress_before_content' ); ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<main class="background-bluejaysblue" id="page" tabindex="0" aria-label="Website Introduction">
			<div class="intro">
				<div <?php post_class('seo-intro'); ?> id="post-<?php the_ID(); ?>">
					<?php do_action( 'foundationpress_page_before_entry_content' ); ?>
					<div class="entry-content">
						<?php the_content(); ?>
					</div>
				</div>
			</div>
		</main>
	<?php endwhile; ?>
	<?php do_action( 'foundationpress_after_content' ); ?>
	<?php if ( have_rows( 'explore_the_department' ) ) :
		$num_cols = count( get_field('explore_the_department') ); ?>

		<div class="buckets" aria-label="Explore the Department Section">
			<?php $heading = get_field_object('explore_the_department');?>
			<div class="grid-x grid-padding-x" aria-label="<?php echo $heading['label'] ?>">
				<div class="cell explore-title">
					<h2><?php echo $heading['label'] ?></h2>
				</div>
			</div>
			<div class="grid-x grid-padding-x">
			<?php while ( have_rows( 'explore_the_department' ) ) : the_row(); ?>
				<?php if ($num_cols == "4") : ?>
				<aside class="cell small-12 medium-6 large-3" aria-label="<?php the_sub_field( 'explore_bucket_heading' ); ?>">
				<?php else: ?>	
				<aside class="cell small-12 medium-6 large-4" aria-label="<?php the_sub_field( 'explore_bucket_heading' ); ?>">
				<?php endif;?>	
					<div class="widget widget_text">
						<div class="widget_title">
							<h4>
								<a href="<?php the_sub_field( 'explore_bucket_link' ); ?>"><?php the_sub_field( 'explore_bucket_heading' ); ?></a>
							</h4>
						</div>
						<div class="textwidget">
							<p><?php the_sub_field( 'explore_bucket_text' ); ?></p>
						</div>
					</div>
				</aside>
			<?php endwhile;?>
			</div>
		</div>
	<?php endif;?>

	<div class="main-container">
	    <div class="main-grid homepage">
	        <div class="main-content homepage-news">

				<?php
				$theme_option = flagship_sub_get_global_options();
                $news_query_cond = $theme_option['flagship_sub_news_query_cond'];
				$news_quantity = $theme_option['flagship_sub_news_quantity'];
					if ($news_query_cond === 1 ) {
						$news_query = new WP_Query(
                                array(
									'post_type' => 'post',
									'tax_query' => array(
										array(
											'taxonomy' => 'category',
											'field' => 'slug',
											'terms' => array( 'books' ),
											'operator' => 'NOT IN',
										),
									),
									'posts_per_page' => $news_quantity,
								)
                                );
					} else {
						$news_query = new WP_Query(
                                array(
									'post_type' => 'post',
									'posts_per_page' => $news_quantity,
								)
                                );
						}
					if ( $news_query->have_posts() ) :
                    ?>
                     

				<header class="news-title" aria-label="Site Feed">
					<h2><?php echo $theme_option['flagship_sub_feed_name']; ?></h2>
				</header>

				<?php
                while ($news_query->have_posts() ) :
$news_query->the_post();
?>
					
			
				<?php get_template_part( 'template-parts/content-news-homepage', get_post_format() ); ?>

				<?php endwhile; ?>
				<article class="homepage-news-archive" aria-label="<?php echo $theme_option['flagship_sub_feed_name']; ?>">
				
					<a class="button news-archive" href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?> " class="button" id="newsarchive">
						<?php echo $theme_option['flagship_sub_feed_name']; ?> Archive <span class="fa fa-chevron-circle-right" aria-hidden="true"></span>
					</a>        

				</article>   

					
			<?php endif; ?>

			<?php
            $hub_query_cond = $theme_option['flagship_sub_hub_cond'];
				if ($hub_query_cond === 1 ) :
                ?>
				<header class="hub-title" aria-label="Hub Feed">
					<h2>Related News from <a href="https://hub.jhu.edu/" aria-label="hub website">The Hub</a></h2>
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