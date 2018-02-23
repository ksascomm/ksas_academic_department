<?php
/**
 * The default template for displaying news content on homepage (meta fields are above the permalink; contains external link class; categories NOT shown)
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

?>

<article aria-labelledby="post-<?php the_ID(); ?>" <?php post_class('post-listing homepage-article'); ?>>
	<header>
		<?php foundationpress_entry_meta(); ?>
		<h2 itemprop="headline">
			<?php if ( get_post_meta($post->ID, 'ecpt_location', true) ) : ?>
				<a href="<?php echo get_post_meta($post->ID, 'ecpt_location', true); ?>" target="_blank" title="<?php the_title(); ?>" id="post-<?php the_ID(); ?>"><?php the_title(); ?> <span class="icon-new-tab2" aria-hidden="true"></span>
				</a>
			<?php else : ?>
				<a href="<?php the_permalink(); ?>" id="post-<?php the_ID(); ?>"><?php the_title(); ?></a>
			<?php endif; ?>
		</h2>
	</header>
	<div class="entry-content" itemprop="text">
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="grid-x">
  				<div class="medium-4 large-3 cell">
					<?php
                    the_post_thumbnail(
                        'medium', array(
							'class'    => 'news-thumb',
							'itemprop' => 'image',
						)
                        );
?>
				</div>
				<div class="medium-8 large-9 cell">
					<?php the_excerpt(); ?>
				</div>
			</div>
		<?php else : ?>
			<?php the_excerpt(); ?>	
		<?php endif; ?>	 
	</div>	
</article>
