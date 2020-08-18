<?php
/*
Template Name: Front (AGHI Only)
*/
get_header(); ?>
<?php $theme_option = flagship_sub_get_global_options();?>
<?php if ( has_post_thumbnail( $post->ID ) ) : 
	$thumbnail_id  = get_post_thumbnail_id( $post->ID );
  	$thumbnail_alt = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true );?>
		<header class="featured-hero homepage hide-for-print" role="banner" data-interchange="[<?php the_post_thumbnail_url('featured-small'); ?>, small], [<?php the_post_thumbnail_url('featured-medium'); ?>, medium], [<?php the_post_thumbnail_url('featured-large'); ?>, large], [<?php the_post_thumbnail_url('featured-xlarge'); ?>, xlarge]" aria-label="Featured Image" alt="<?php echo $thumbnail_alt ?>"/>
		</header>
	<?php endif; ?>
	<?php get_template_part( 'template-parts/homepage-slider' ); ?>
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
	<div class="aghi-events">
		<div class="events-feed" role="region" aria-label="Events">
			<div class="aghi-events-intro">
			   <h1>Upcoming AGHI-sponsored Events</h1>
				<p>A complete calendar of all humanities-related events, including all AGHI-sponsored events, happening at Johns Hopkins is available on our <a href="<?php echo site_url();?>/events/">events page</a>.</p>	
			</div>
			<?php $featuredSidebar = is_active_sidebar('homepage-featured-sb');
			if ( $featuredSidebar):?>
				<!--Show Featured Widget-->
				<div class="aghi-events-home-widget">
					<?php dynamic_sidebar( 'homepage-featured-sb' ); ?>
				</div>
			<?php endif;?>
			</div>
		</div>
	</div>
	<?php do_action( 'foundationpress_after_content' ); ?>

	<div class="main-container">
	    <div class="main-grid homepage">
	    	<div class="humanities-highlights" role="region" aria-label="Humanities Highlights">
				<div class="homepage-news">
					<h1>Humanities Highlights <br>
						<small>Humanities Stories from Across Hopkins</small>
					</h1>
					<?php $highlights_query = new WP_Query(array(
								'post_type' => 'post',
								'category_name' => 'highlights',
								'posts_per_page' => 1,
								'orderby' => 'rand',
							)); 
					if ( $highlights_query->have_posts() ) : while ($highlights_query->have_posts()) : $highlights_query->the_post(); ?>

						
						<?php get_template_part( 'template-parts/content', 'humanities-highlights' ); ?>
					

						<?php endwhile; endif; ?>			
					<article class="archive-link" aria-label="Humanities Highlights Archive Link">
						<a class="button news-archive" href="<?php echo site_url();?>/category/highlights/">See all Humanities Highlights <span class="fa fa-chevron-circle-right" aria-hidden="true"></span>
							</a>
					</article>
				</div>
			</div>
	        <div class="main-content homepage-news">

				<?php
                $news_query_cond = $theme_option['flagship_sub_news_query_cond'];
				$news_quantity = $theme_option['flagship_sub_news_quantity'];
						$news_query = new WP_Query(
                                array(
									'post_type' => 'post',
									'tax_query' => array(
										array(
											'taxonomy' => 'category',
											'field' => 'slug',
											'terms' => 'highlights',
											'operator' => 'NOT IN',
										),
									),
									'posts_per_page' => $news_quantity,
								)
                                );
					if ( $news_query->have_posts() ) :
                    ?>
                     

				<header class="news-title" aria-label="Site Feed">
					<h2><?php echo $theme_option['flagship_sub_feed_name']; ?></h2>
				</header>

				<?php
                while ($news_query->have_posts() ) : $news_query->the_post(); ?>
					
			
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
