<?php 
// Pull exhibition type array (off/on-campus, independent study, online, etc)
$program_types = get_the_terms( $post->ID, 'exhibition_type' );
if ( $program_types && ! is_wp_error( $program_types ) ) :
	$program_type_names = array();
	$degree_types = array();
	foreach ( $program_types as $program_type ) {
		$program_type_names[] = $program_type->slug;
		$exhibition_types[] = $program_type->name;
	}
	$program_type_name = join( ', ', $program_type_names );
	$exhibition_type = join( ', ', $exhibition_types );
endif; ?>

<div class="cell">
	<article class="exhibition card" aria-labelledby="post-<?php the_ID(); ?>">
		<div class="exhibition-image">
			<?php if ( has_post_thumbnail() ) : ?> 
					<?php the_post_thumbnail('large'); ?>
		  	<?php endif; ?>	
		  	</div>
		 <div class="card-section">
			<h1><a href="<?php echo get_permalink(); ?>" id="post-<?php the_ID(); ?>"><?php the_title(); ?></a></h1>
			<ul class="no-bullets">
				<?php if (get_post_meta($post->ID, 'ecpt_location', true) ) : ?>
					<li><strong>Location:</strong> <?php echo get_post_meta($post->ID, 'ecpt_location', true); ?></li>
				<?php endif; ?>
								<?php if (get_post_meta($post->ID, 'ecpt_dates', true) ) : ?>
					<li><strong>Dates:</strong> <?php echo get_post_meta($post->ID, 'ecpt_dates', true); ?></li>
				<?php endif; ?>			    	
					<li><strong>Exhibit Type:</strong> <span class="capitalize"><?php echo $program_type_name; ?></span></li>
			</ul>
		</div>
	</article>			
</div>