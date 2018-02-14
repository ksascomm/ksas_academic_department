<?php
/*
Template Name: Exhibitions & Programs
*/
get_header(); ?>


<?php get_template_part( 'template-parts/featured-image' ); ?>
<div class="main-container" id="page">
    <div class="main-grid">
        <main class="main-content">
            <?php while ( have_posts() ) : the_post(); ?>
                <?php get_template_part( 'template-parts/content', 'page' ); ?>
            <?php endwhile;?>

			<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

				$flagship_exhibitions_query = new WP_Query(array(
					'post_type' => 'ksasexhibits',
					'orderby' => 'date',
					'order' => 'DESC',
					'posts_per_page' => '10',
					'paged' => $paged,
					));
			 ?>

			<?php if ($flagship_exhibitions_query->have_posts()) : while ($flagship_exhibitions_query->have_posts()) : $flagship_exhibitions_query->the_post();
						//Pull exhibition type array (off/on-campus, independent study, online, etc)
			$program_types = get_the_terms( $post->ID, 'exhibition_type' );
				if ( $program_types && ! is_wp_error( $program_types ) ) : 
					$program_type_names = array();
					$degree_types = array();
						foreach ( $program_types as $program_type ) {
							$program_type_names[] = $program_type->slug;
							$exhibition_types[] = $program_type->name;
						}
					$program_type_name = join( ", ", $program_type_names );
					$exhibition_type = join( ", ", $exhibition_types );

				endif; ?> 
			<article class="exhibition media-object" aria-labelledby="post-<?php the_ID(); ?>">
			<?php if ( has_post_thumbnail()) : ?> 
		  		<div class="media-object-section">
					<?php the_post_thumbnail('thumbnail'); ?>
		  		</div>
		  	<?php endif; ?>	
				<div class="media-object-section">
				    <h1><a href="<?php echo get_permalink() ?>" id="post-<?php the_ID(); ?>"><?php the_title(); ?></a></h1>
				   	<ul class="no-bullets">
						<?php if (get_post_meta($post->ID, 'ecpt_location', true)) : ?>
							<li><strong>Location:</strong> <?php echo get_post_meta($post->ID, 'ecpt_location', true); ?></li>
						<?php endif; ?>
						<?php if (get_post_meta($post->ID, 'ecpt_dates', true)) : ?>
							<li><strong>Dates:</strong> <?php echo get_post_meta($post->ID, 'ecpt_dates', true); ?></li>
						<?php endif; ?>			    	
				   	 		<li><strong>Exhibit Type:</strong> <span class="capitalize"><?php echo $program_type_name; ?></span></li>
					</ul>
					<?php if (get_post_meta($post->ID, 'ecpt_description_short', true)) : ?>
						<div class="exhibition-description">
				    		<?php echo get_post_meta($post->ID, 'ecpt_description_short', true); ?>
				    	</div>
					<?php endif; ?>	
				</div>
			</article>
			
			<?php endwhile; 
				
			$total_pages = $flagship_exhibitions_query->max_num_pages;

			if ($total_pages > 1){

        		$current_page = max(1, get_query_var('paged'));
        		echo '<div class="pagination text-center">';
		        echo paginate_links(array(
		            'base' => get_pagenum_link(1) . '%_%',
		            'format' => 'page/%#%',
		            'current' => $current_page,
		            'total' => $total_pages,
		            'prev_text'    => __('« prev'),
		            'next_text'    => __('next »'),
		            'type' => 'list'
		        ));
		        echo '</div>';
		    }
		    ?>    
			<?php else :?>
				<h2><?php _e('404 Error&#58; Not Found', ''); ?></h2>
			<?php endif;?>

        </main>
        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer();
