<?php
/*
Template Name: Front (AGHI Only)
*/
get_header(); ?>

<?php
	$theme_option = flagship_sub_get_global_options();
	$slider_query = new WP_Query(
        array(
			'post_type' => 'slider',
			'posts_per_page' => '5',
			'orderby' => 'rand',
		)
        );
	if ( $slider_query->have_posts() ) :
    ?>
     
	<div class="fullscreen-image-slider hide-for-small-only">
		<div class="orbit" role="region" aria-label="Homepage Slider" data-orbit data-options="animInFromLeft:fade-in; animInFromRight:fade-in; animOutToLeft:fade-out; animOutToRight:fade-out;">
			<div class="orbit-wrapper">	
				<?php if ($slider_query->post_count > 1 ) : ?>
				<div class="orbit-controls">
					<button class="orbit-previous"><span class="show-for-sr">Previous Slide</span>&#9664;&#xFE0E;</button>
					<button class="orbit-next"><span class="show-for-sr">Next Slide</span>&#9654;&#xFE0E;</button>
				</div>
				<?php endif; ?>

				<ul class="orbit-container">
				<?php
                while ($slider_query->have_posts() ) :
$slider_query->the_post();
?>
					<li class="orbit-slide">	
						<img class="orbit-image hide-for-print" src="<?php echo get_post_meta($post->ID, 'ecpt_slideimage', true); ?>" alt="<?php the_title(); ?>">
						<?php if (get_the_title() || !empty( get_the_content() )) :?>
					    <figcaption class="orbit-caption" aria-hidden="true">
					    	<?php if (get_the_title()) :?>
					      		<h1><?php the_title(); ?></h1>
					  		<?php endif;?>
					  	<?php if ( !empty( get_the_content() ) ):?>
					      <p><?php echo get_the_content(); ?></p>
						   <?php if (get_post_meta($post->ID, 'ecpt_button', true) ) : ?>
								<a href="<?php echo get_post_meta($post->ID, 'ecpt_urldestination', true); ?>" onclick="ga('send', 'event', 'Homepage Slider', 'Click', '<?php echo get_post_meta($post->ID, 'ecpt_urldestination', true); ?>')" aria-label="post-<?php the_ID(); ?>" class="button">Find Out More <span class="far fa-arrow-alt-circle-right"></span></a>
							<?php endif; ?>
						<?php endif;?>
					    </figcaption>
					<?php endif;?>
			   		</li>
				<?php endwhile; ?>
				</ul>	
			</div>		
		</div>
	</div>
	<?php endif; ?>
	<?php
    $slider_mobile_query = new WP_Query(
        array(
			'post_type' => 'slider',
			'posts_per_page' => '1',
			'orderby' => 'rand',
		)
        );
		if ( $slider_mobile_query->have_posts() ) :
while ($slider_mobile_query->have_posts() ) :
				$slider_mobile_query->the_post();
				?>
					<div class="front-hero-featured-image show-for-small-only hide-for-print" role="banner" aria-label="Mobile Hero Image">
				<img class="featured-small" src="<?php echo get_post_meta($post->ID, 'ecpt_slideimage', true); ?>" alt="<?php the_title(); ?>">
					</div>
					<?php endwhile; endif; ?>

	<?php do_action( 'foundationpress_before_content' ); ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<section class="background-bluejaysblue" id="page" role="main" tabindex="0" aria-label="Website Introduction">
			<div class="intro">
				<div <?php post_class('seo-intro'); ?> id="post-<?php the_ID(); ?>">
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
						<p>A complete calendar of all humanities-related events, including all AGHI-sponsored events, happening at Johns Hopkins is available on our <a href="<?php echo site_url();?>/events/">events page</a>.</p>	
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
					<?php $highlights_query = new WP_Query(array(
								'post_type' => 'post',
								'category_name' => 'highlights',
								'posts_per_page' => 1,
							)); 
					if ( $highlights_query->have_posts() ) : while ($highlights_query->have_posts()) : $highlights_query->the_post(); ?>

						
						<?php get_template_part( 'template-parts/content', 'humanities-highlights' ); ?>
					

						<?php endwhile; endif; ?>			
					<h2 class="archive-link">
						<a href="<?php echo site_url();?>/category/highlights/">See all Humanities Highlights <span class="fa fa-chevron-circle-right" aria-hidden="true"></span>
							</a>
					</h2>
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
