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
		<h1>
		<?php the_title(); ?>
		</h1>
	</header>
	<div class="entry-content">
		<div class="exhibit-body">
			<a data-open="modal">
			<?php the_post_thumbnail( 'featured-medium',
				array(
					'class' => 'thumbnail',
					'alt' => trim(strip_tags( $post->post_title )),
					'aria-label' => 'Click on the featured image to expand it',
					)
				);
				?>
			</a>
			<h3>
			<?php if (get_post_meta($post->ID, 'ecpt_location', true) ) : ?>
			Location: <small><?php echo get_post_meta($post->ID, 'ecpt_location', true); ?></small><br>
			<?php endif; ?>
			<?php if (get_post_meta($post->ID, 'ecpt_dates', true) ) : ?>
			Dates: <small><?php echo get_post_meta($post->ID, 'ecpt_dates', true); ?></small>
			<?php endif; ?>
			</h3>
			<?php if (get_post_meta($post->ID, 'ecpt_description_full', true) ) : ?>
			<h3>Description</h3>
			<?php echo get_post_meta($post->ID, 'ecpt_description_full', true); ?>
			<?php endif; ?>
		</div>
	</div>
</article>
<div id="modal" class="small reveal" data-reveal data-animation-in="scale-in-up" data-animation-out="scale-out-down">
	<?php the_post_thumbnail( 'full');?>
	<p><?php the_post_thumbnail_caption();?></p>
	<button class="close-button" data-close aria-label="Close modal" type="button">
		<span aria-hidden="true">&times;</span>
	</button>
 </div>