<?php
/**
 * The default template for displaying content
 *
 * Used for single.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

?>
<?php
$faculty_post_id = get_post_meta($post->ID, 'ecpt_pub_author', true);
		  $faculty_post_id2 = get_post_meta($post->ID, 'ecpt_pub_author2', true);
          ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post-singular'); ?>>
		<header>
			<h1 class="entry-title"><?php the_title(); ?></h1>
		</header>
		<div class="entry-content single-book">
				<?php $title=get_the_title();
					the_post_thumbnail('medium', array( 'alt' => $title ) ); 
				?>	
				<ul class="no-bullet">
					<li>
					<?php if ( get_post_meta($post->ID, 'ecpt_pub_date', true) ) : ?> 
						<?php echo get_post_meta($post->ID, 'ecpt_pub_date', true); ?>,
					<?php endif; ?>
					<?php if ( get_post_meta($post->ID, 'ecpt_publisher', true) ) : ?>
						<?php echo get_post_meta($post->ID, 'ecpt_publisher', true); ?> 
					<?php endif; ?>	
					</li>
					<li>
						<a href="<?php echo get_permalink($faculty_post_id); ?>">
							<?php echo get_the_title($faculty_post_id); ?>, 
							<?php if ( get_post_meta($post->ID, 'ecpt_pub_role', true) ) : ?> 
								<?php echo get_post_meta($post->ID, 'ecpt_pub_role', true); ?>
							<?php endif; ?>
						</a>
					</li>
					<?php if (get_post_meta($post->ID, 'ecpt_author_cond', true) == 'on' ) { ?>
					<li>
						<a href="<?php echo get_permalink($faculty_post_id2); ?>"><?php echo get_the_title($faculty_post_id2); ?>,&nbsp;<?php echo get_post_meta($post->ID, 'ecpt_pub_role2', true); ?>
						</a>
					</li>
					<?php } ?>
					<li><?php if ( get_post_meta($post->ID, 'ecpt_pub_link', true) ) : ?> 
							<a href="http://<?php echo get_post_meta($post->ID, 'ecpt_pub_link', true); ?>" aria-label="Link to purchase <?php the_title(); ?>">
								Purchase Online <span class="fas fa-external-link-square-alt"></span>
							</a>
						<?php endif; ?>
					</li>
				</ul>
			<?php the_content(); ?>
			<?php edit_post_link( __( '(Edit)', 'foundationpress' ), '<span class="edit-link">', '</span>' ); ?>
		</div>
</article>
