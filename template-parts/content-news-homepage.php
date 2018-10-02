<?php
/**
 * The default template for displaying news content on homepage (meta fields are above the permalink; contains external link class; categories NOT shown)
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

?>

<article aria-labelledby="post-<?php the_ID(); ?>" 
	<?php if( is_sticky() ) :?>
		<?php post_class('post-listing homepage-article wp-sticky'); ?>>
		<div class="ribbon"><span>FEATURED</span></div>
	<?php else:?>
		<?php post_class('post-listing homepage-article'); ?>>
	<?php endif;?>
	<header>
		<?php if( !is_sticky() ) :?>
			<?php foundationpress_entry_meta(); ?>
		<?php endif;?>
		<h2>
			<?php if ( get_post_meta($post->ID, 'ecpt_external_link', true) ) : ?>
				<a href="<?php echo get_post_meta($post->ID, 'ecpt_external_link', true); ?>" target="_blank" rel="noopener" title="<?php the_title(); ?>" id="post-<?php the_ID(); ?>"><?php the_title(); ?> <span class="icon-new-tab2" aria-hidden="true"></span>
				</a>
			<?php else : ?>
				<a href="<?php the_permalink(); ?>" id="post-<?php the_ID(); ?>"><?php the_title(); ?></a>
			<?php endif; ?>
		</h2>
	</header>
	<div class="entry-content">
		<div class="grid-x">
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="cell small-12 medium-6 large-3">
				<?php the_post_thumbnail(array(200,200), array('class' => 'alignleft news-thumb')); ?>
			</div>
			<div class="cell small-12 medium-6 large-9">
				<?php the_excerpt(); ?>	
			</div>
		<?php else: ?>
			<div class="cell small-12">
				<?php the_excerpt(); ?>	
			</div>
		<?php endif;?>
		</div>
	</div>	
</article>