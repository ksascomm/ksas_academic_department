<div class="tabs-panel" id="booksTab">
	<?php
		$author_id = get_the_ID();
		$single_books_query = new WP_Query(
		array(
				'post_type' => 'post',
				'category_name' => 'books',
				'posts_per_page' => 50,
				'meta_query' => array(
					'relation' => 'OR',
					array(
						'key' => 'ecpt_pub_author',
						'value' => $author_id,
						'type' => 'NUMERIC',
						'compare' => '=',
					),
					array(
						'key' => 'ecpt_pub_author2',
						'value' => $author_id,
						'type' => 'NUMERIC',
						'compare' => '=',
					),
				),
			)
	);
		if ( $single_books_query->have_posts() ) :
	while ($single_books_query->have_posts() ) :
	$single_books_query->the_post(); ?>
	<article class="book-entry" aria-labelledby="post-<?php the_ID(); ?>">
		<?php
		if ( has_post_thumbnail() ) {
			the_post_thumbnail(
				'directory', array(
					'class'   => 'float-left',
					'alt' => esc_html ( get_the_title() ),
				)
			); 
		}
		?>
		<ul class="no-bullet">
			<li>
				<h5>
					<a href="<?php the_permalink(); ?>" id="post-<?php the_ID(); ?>">
						<?php the_title(); ?>
					</a>
				</h5>
			</li>
			<li>
				<?php if ( get_post_meta($post->ID, 'ecpt_pub_date', true) ) : ?> 
					<?php echo get_post_meta($post->ID, 'ecpt_pub_date', true); ?>,
				<?php endif; ?>
				<?php if ( get_post_meta($post->ID, 'ecpt_publisher', true) ) : ?>
					<?php echo get_post_meta($post->ID, 'ecpt_publisher', true); ?> 
				<?php endif; ?>	
			</li>
			<li>
				<strong>Role:</strong> <span class="capitalize"><?php echo get_post_meta($post->ID, 'ecpt_pub_role', true); ?></span>
			</li>
			<li>
				<?php
				if (get_post_meta($post->ID, 'ecpt_author_cond', true) == 'on' ) {
					$faculty_post_id2 = get_post_meta($post->ID, 'ecpt_pub_author2', true); ?>
					<br>
					<?php echo get_the_title($faculty_post_id2); ?>,&nbsp;<?php echo get_post_meta($post->ID, 'ecpt_pub_role2', true); ?>
				<?php } ?>
			</li>
			<li>
				<?php if ( get_post_meta($post->ID, 'ecpt_pub_link', true) ) : ?>
					<a href="http://<?php echo get_post_meta($post->ID, 'ecpt_pub_link', true); ?>" aria-label="Link to purchase <?php the_title(); ?>">
						Purchase Online <span class="fas fa-external-link-square-alt"></span>
					</a>
				<?php endif; ?>
			</li>
		</ul>
		<hr>
	</article>
	<?php endwhile; endif; wp_reset_query(); ?>
</div>