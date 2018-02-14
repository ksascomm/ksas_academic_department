<?php
/*
Template Name: Bulletin Board - Undergrad
*/
get_header(); ?>


<?php get_template_part( 'template-parts/featured-image' ); ?>
<div class="main-container" id="page">
    <div class="main-grid">
        <main class="main-content">
            <?php while ( have_posts() ) : the_post(); ?>
                <?php get_template_part( 'template-parts/content', 'page' ); ?>
            <?php endwhile;?>
			<?php $bulletin_types = get_object_taxonomies( 'bulletinboard' );
            	foreach( $bulletin_types as $bulletin_type ) : 
			    	$terms = get_terms( $bulletin_type );
			    	foreach( $terms as $term ) : 

			    	$bulletins = new WP_Query( array(
			    	'taxonomy' => $bulletin_type,
			    	'term' => $term->slug,
					));

					if( $bulletins->have_posts() ): ?>
					<h2 class="bulletin-category-title" id="<?php echo $term->slug ;?>"><?php echo $term->name ;?></h2> 
    				<?php while( $bulletins->have_posts() ) : $bulletins->the_post();?>
					<ul class="accordion bulletins" data-accordion data-allow-all-closed="true">
				    	<li class="accordion-item bulletin" data-accordion-item>
							<a href="#" class="accordion-title"><?php the_title();?></a>
							<div class="accordion-content" data-tab-content >
								<h3>Posted: <?php the_time('F j, Y'); ?></h3>
								<h4><a href="<?php the_permalink(); ?>" aria-label="Link to <?php the_title();?>">(View as individual posting)</a></h4>
								<?php the_content(); ?>
							</div>
						</li>
					</ul>
				
				<?php endwhile; endif; endforeach; endforeach; ?>	
        </main>
        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer();
