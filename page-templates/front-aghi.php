<?php
/*
Template Name: Front (AGHI Only)
*/
get_header(); ?>

<?php $theme_option = flagship_sub_get_global_options();
do_action( 'foundationpress_before_content' ); ?>
<?php while ( have_posts() ) : the_post(); ?>
<?php
// If a featured image is set, insert into layout and use Interchange
// to select the optimal image size per named media query.
if ( has_post_thumbnail( $post->ID ) ) : ?>
<header class="featured-hero parent front-page" role="banner" data-interchange="[<?php echo the_post_thumbnail_url('featured-small'); ?>, small], [<?php echo the_post_thumbnail_url('featured-medium'); ?>, medium], [<?php echo the_post_thumbnail_url('featured-large'); ?>, large], [<?php echo the_post_thumbnail_url('featured-xlarge'); ?>, xlarge]">							
</header>
<?php endif;?>
		<section class="background-bluejaysblue" id="page" role="main" tabindex="0" aria-label="Website Introduction">
			<div class="intro">
				<div class="seo-intro">
					<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
						<?php do_action( 'foundationpress_page_before_entry_content' ); ?>
						<div class="entry-content">
							<?php the_content(); ?>
						</div>
				</div>
			</div>
		</section>
	<?php endwhile; ?>
	<div class="grid-x aghi-events" aria-label="Upcoming Events">
		<div class="small-12 large-10 large-offset-1 cell events-feed" role="region" aria-label="Events">
			<div class="aghi-events-intro">
			   <h1>Upcoming AGHI-sponsored Events</h1>
				<div class="grid-x">
					<div class="small-12 columns">
						<p>A complete calendar of all humanities-related events, including all AGHI-sponsored events, happening at Johns Hopkins are available on our <a href="<?php echo site_url();?>/events/">events page</a>.</p>	
					</div>
				</div>
				<?php echo do_shortcode('[ai1ec view="agenda" cat_name="AGHI" events_limit="4"]');	?>
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
					<?php  if ( false === ( $highlights_query = get_transient( 'highlights_mainpage_query' ) ) ) {	
						$highlights_query = new WP_Query(array(
								'post_type' => 'post',
								'tax_query' => array(
									array(
										'taxonomy' => 'category',
										'field' => 'slug',
										'terms' => array( 'highlights' ),
									)
								),
								'posts_per_page' => 1,
							)); 
					set_transient( 'highlights_mainpage_query', $highlights_query, 604800 );
						} 	
					if ( $highlights_query->have_posts() ) : while ($highlights_query->have_posts()) : $highlights_query->the_post(); ?>

						
						<?php get_template_part( 'template-parts/content', 'humanities-highlights' ); ?>
					

						<?php endwhile; endif; ?>			
					<h2 class="archive-link">
						<a href="<?php echo site_url();?>/category/highlights/">See all Humanities Highlights
							</a>
					</h2>
				</div>
			</div>
	        <div class="main-content homepage-news">

				<?php
                $news_query_cond = $theme_option['flagship_sub_news_query_cond'];
				$news_quantity = $theme_option['flagship_sub_news_quantity'];
					if ( false === ( $news_query = get_transient( 'news_mainpage_query' ) ) ) {
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
					set_transient( 'news_mainpage_query', $news_query, 2592000 );
					}
					if ( $news_query->have_posts() ) :
                    ?>
                     

				<header class="news-title" aria-label="Site Feed">
					<h2><?php echo $theme_option['flagship_sub_feed_name']; ?></h2>
				</header>

				<?php
                while ($news_query->have_posts() ) : $news_query->the_post(); ?>
					
			
				<?php get_template_part( 'template-parts/content-news-homepage', get_post_format() ); ?>

				<?php endwhile; ?>
				<div class="homepage-news-archive" role="region" aria-labelledby="region1">
					<h4 id="region1">
					<a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>">
						View <?php echo $theme_option['flagship_sub_feed_name']; ?> Archive <span class="fa fa-chevron-circle-right" aria-hidden="true"></span>
					</a>
					</h4>
				</div>

		
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
