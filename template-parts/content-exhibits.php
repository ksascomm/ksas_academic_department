<?php
/**
 * The default template for displaying exhibits content
 *
 * Used for both single exhibits.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post-listing exhibit'); ?>>
	<header>
		<h1 itemprop="headline">
			<?php the_title(); ?>
		</h1>
	</header>

	<div class="entry-content" itemprop="text">
		<div class="exhibit-body" itemprop="articleBody">						
				<?php
                the_post_thumbnail(
                    'medium',
					array(
						'itemprop' => 'image',
						'alt' => trim(strip_tags( $post->post_title )),
						'aria-label' => 'Click on the featured image to expand it',
					)
                    );
                    ?>
				<?php if (get_post_meta($post->ID, 'ecpt_location', true) ) : ?>
					<p><strong>Location:</strong>&nbsp;<?php echo get_post_meta($post->ID, 'ecpt_location', true); ?></p>
				<?php endif; ?>
				<?php if (get_post_meta($post->ID, 'ecpt_dates', true) ) : ?>
					<p><strong>Dates:</strong>&nbsp;<?php echo get_post_meta($post->ID, 'ecpt_dates', true); ?></p>
				<?php endif; ?>
				<?php if (get_post_meta($post->ID, 'ecpt_description_full', true) ) : ?>
					<p><strong>Description:</strong>&nbsp;<?php echo get_post_meta($post->ID, 'ecpt_description_full', true); ?></p>
				<?php endif; ?>
		</div>
	</div>	
	<hr />
</article>
