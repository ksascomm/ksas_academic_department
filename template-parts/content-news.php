<?php
/**
 * The default template for displaying posts on News Archive Page (meta fields are below the permalink; contains external link class; categories are shown)
 *
 * Used for both single and index/archive/search.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

?>

<article aria-labelledby="post-<?php the_ID(); ?>" <?php post_class('post-listing news-article'); ?>>
	<header>
		<h2 itemprop="headline">
			<small aria-hidden="true">
				<?php
                $categories = get_the_category();
				$separator = ', ';
				$output = '';
					if ( ! empty( $categories ) ) {
					foreach ( $categories as $category ) {
						$output .= $category->name . $separator;
					    }
					echo trim( $output, $separator );
					}
				if (has_tag('gallery') ) :
                ?>
                , Image Gallery<?php endif; ?>
			</small>
			<br>
			<?php if ( get_post_meta($post->ID, 'ecpt_external_link', true) ) : ?>
				<a href="<?php echo get_post_meta($post->ID, 'ecpt_external_link', true); ?>" target="_blank" title="<?php the_title(); ?>" id="post-<?php the_ID(); ?>"><?php the_title(); ?> <span class="icon-new-tab2" aria-hidden="true"></span>
				</a>
			<?php else : ?>
				<a href="<?php the_permalink(); ?>" id="post-<?php the_ID(); ?>"><?php the_title(); ?></a>
			<?php endif; ?>
		</h2>
		<?php foundationpress_entry_meta(); ?>
	</header>

	<div class="entry-content" itemprop="text">
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
