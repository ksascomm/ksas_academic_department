<?php
/*
Template Name: Front (Video Hero)
*/
get_header(); ?>
	<?php if ( has_post_thumbnail( $post->ID ) ) : ?>
		<header class="featured-hero homepage hide-for-small-only hide-for-print" role="banner" data-interchange="[<?php the_post_thumbnail_url('featured-small'); ?>, small], [<?php the_post_thumbnail_url('featured-medium'); ?>, medium], [<?php the_post_thumbnail_url('featured-large'); ?>, large], [<?php the_post_thumbnail_url('featured-xlarge'); ?>, xlarge]" aria-label="Featured Image">
		</header>
	<?php endif; ?>
	<?php get_template_part( 'template-parts/homepage-video' ); ?>
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
	<?php if ( have_rows( 'explore_the_department' ) ):
	$count = count(get_field('explore_the_department'));
	$featuredSidebar = is_active_sidebar('homepage-featured-sb');?>
	<div class="bucket-area">
		<div class="buckets">
			<?php $heading = get_field_object('explore_the_department');?>
			<div class="grid-x grid-padding-x">
				<header class="cell explore-title" aria-label="<?php the_field( 'buckets_heading' ); ?>">
					<h2><?php the_field( 'buckets_heading' ); ?></h2>
				</header>
			</div>
			<?php if ($count == 2 && $featuredSidebar):?>
				<div class="grid-x grid-padding-x small-up-1 medium-up-2 large-up-3" data-equalizer data-equalize-on="large">
			<?php elseif($count == 3 && $featuredSidebar):?>
				<div class="grid-x grid-padding-x small-up-1 medium-up-2 large-up-4" data-equalizer data-equalize-on="large">
			<?php elseif($count == 3 && !$featuredSidebar):?>
				<div class="grid-x grid-padding-x small-up-1 medium-up-2 large-up-3" data-equalizer data-equalize-on="large">
			<?php elseif ($count == 2 && !$featuredSidebar):?>
				<div class="grid-x grid-padding-x small-up-1 medium-up-2 large-up-2" data-equalizer data-equalize-on="large">
			<?php endif;?>
			<?php while ( have_rows( 'explore_the_department' ) ) : the_row(); ?>
				<div class="cell " aria-label="<?php the_sub_field( 'explore_bucket_heading' ); ?>">
					<article class="bucket"  data-equalizer-watch aria-label="<?php the_sub_field( 'explore_bucket_heading' ); ?>">
						<a href="<?php the_sub_field( 'explore_bucket_link' ); ?>">
							<?php $image = get_sub_field('explore_bucket_image');
							if(get_sub_field('explore_bucket_image')):?>
							<div class="bucket-image">
								<?php echo wp_get_attachment_image( $image['ID'], 'full',false, array( 'class' => '' ) ); ?>
							</div>
							<?php endif;?>
							<div class="bucket-title">
								<h3><?php the_sub_field( 'explore_bucket_heading' ); ?></h3>
							</div>
							<div class="bucket-text">
								<p><?php the_sub_field( 'explore_bucket_text' ); ?></p>
							</div>	
						</a>
					</article>
				</div>
			<?php endwhile;?>
				<?php if ( $featuredSidebar):?>
					<div class="cell">
						<?php dynamic_sidebar( 'homepage-featured-sb' ); ?>
					</div>
				<?php endif;?>
				</div>
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
			if ( $news_query->have_posts() ) : ?>

				<header class="news-title" aria-label="Site Feed">
					<h2><?php echo $theme_option['flagship_sub_feed_name']; ?></h2>
				</header>

				<?php while ($news_query->have_posts() ) : $news_query->the_post(); ?>
					
			
					<?php get_template_part( 'template-parts/content-news-homepage', get_post_format() ); ?>

				<?php endwhile; ?>
				<article class="homepage-news-archive" aria-label="<?php echo $theme_option['flagship_sub_feed_name']; ?>">
				
					<a class="button news-archive" href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?> " class="button" id="newsarchive">
						<?php echo $theme_option['flagship_sub_feed_name']; ?> Archive <span class="fa fa-chevron-circle-right" aria-hidden="true"></span>
					</a>        

				</article>
				
			<?php endif; ?>

			<?php $hub_query_cond = $theme_option['flagship_sub_hub_cond']; if ($hub_query_cond === 1 ) : ?>
				<header class="hub-title" aria-label="Hub Feed">
					<h2>Related News from <a href="https://hub.jhu.edu/" aria-label="hub website">The Hub</a></h2>
				</header>
				<?php get_template_part( 'template-parts/hub-news' ); endif; ?>

			</div>
			<div class="homepage sidebar">
				<?php dynamic_sidebar( 'homepage-sb' ); ?>
			</div>
		</div>
	</div>
<?php
get_footer();
