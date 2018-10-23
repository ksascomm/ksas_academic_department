<?php
/*
Template Name: Front (Research Highlights)
*/
get_header(); ?>
	<?php if ( has_post_thumbnail( $post->ID ) ) : ?>
		<header class="featured-hero homepage hide-for-print" role="banner" data-interchange="[<?php the_post_thumbnail_url('featured-small'); ?>, small], [<?php the_post_thumbnail_url('featured-medium'); ?>, medium], [<?php the_post_thumbnail_url('featured-large'); ?>, large], [<?php the_post_thumbnail_url('featured-xlarge'); ?>, xlarge]" aria-label="Featured Image">
		</header>
	<?php endif; ?>
	
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

<?php $slider_query = new WP_Query(
        array(
			'post_type' => 'slider',
			'posts_per_page' => '5',
			'orderby' => 'rand',
		)
        );
			if ( $slider_query->have_posts() ) : ?>
			<div class="highlighted-research" role="region" aria-label="Faculty Research Highlights">
				<div class="intro">
					<div class="media-object">
						<div class="media-object-section">			
							<span class="fa-stack fa-2x hide-for-small-only">
								<span class="fa fa-circle fa-stack-2x"></span>
								<span class="fa fa-flask fa-stack-1x fa-inverse" aria-hidden="true"></span>
							</span>
						</div>
						<div class="media-object-section">
							<h1>Faculty Research Highlights <br>
								<small>Explore the department’s most current findings</small>
							</h1>
					 	</div>
					</div>
				</div>
				<div class="orbit" role="region" aria-label="Highlighted Research by our Faculty" data-orbit data-options="animInFromLeft:fade-in; animInFromRight:fade-in; animOutToLeft:fade-out; animOutToRight:fade-out;">
					<ul class="orbit-container">

					<?php if ($slider_query->post_count > 1 ) : ?>
					
					<div class="hide-for-small-only">
						<button class="orbit-previous show-for-large"><span class="show-for-sr">Previous Slide</span>&#9664;&#xFE0E;</button>
		   				<button class="orbit-next show-for-large"><span class="show-for-sr">Next Slide</span>&#9654;&#xFE0E;</button>
		   			</div>	
					<?php endif;?>
					
					<?php while ($slider_query->have_posts() ) : $slider_query->the_post(); ?>
						<li class="orbit-slide">
							<div class="grid-x">
								<div class="cell small-12 medium-6 large-5 large-offset-1">
									<img class="card" src="<?php echo get_post_meta($post->ID, 'ecpt_slideimage', true); ?>" alt="slider <?php the_title(); ?>" />
								</div>
								<div class="cell small-12 medium-6 large-4">
									<div class="slide-caption">
									<?php if ( ! the_title( ' ', ' ', false ) == '' ) : ?>
										<h3><?php the_title(); ?></h3>
									<?php endif;?>
										<p><?php echo get_the_content(); ?></p>
									   	<?php if ( get_post_meta($post->ID, 'ecpt_button', true) ) : ?>				
												<p><a class="button" href="<?php echo get_post_meta($post->ID, 'ecpt_urldestination', true); ?>" onclick="ga('send', 'event', 'Homepage Slider', 'Click', '<?php echo get_post_meta($post->ID, 'ecpt_urldestination', true); ?>')" aria-label="<?php the_title(); ?>" target="_blank" rel="noopener noreferrer">Find Out More <span class="far fa-arrow-alt-circle-right"></span></a></p>
										<?php endif;?>
									</div>
								</div>	
							</div>						
						</li>
					<?php endwhile;?>
		  			</ul>
			  		<nav class="orbit-bullets" aria-label="Slider Buttons">
						<?php $bullet_counter = 0; while ($slider_query->have_posts() ) : $slider_query->the_post(); ?>
							<button<?php if( $bullet_counter === 0 ) : echo ' class="is-active"'; endif; ?> data-slide="<?php echo $bullet_counter; ?>">
								<span class="show-for-sr">Slide of <?php echo the_title(); ?></span>
								<?php if( $bullet_counter === 0 ) :?><span class="show-for-sr">Current Slide</span><?php endif; ?>
							</button>
						<?php $bullet_counter++; endwhile; ?>
					</nav>	
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
			<div class="homepage-news-archive" role="complementary" aria-labelledby="newsarchive">         
				<h4 id="newsarchive">
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
