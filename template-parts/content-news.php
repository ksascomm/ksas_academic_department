<?php
/**
 * The default template for displaying posts on News Archive Page (meta fields are below the permalink; contains external link class; categories are shown)
 *
 * Used for both single and index/archive/search.
 *
 * @package KSASAcademicDepartment
 * @since KSASAcademicDepartment 1.0.0
 */

?>



<article aria-labelledby="post-<?php the_ID(); ?>"
<?php if ( is_sticky() ) : ?>
	<?php post_class( 'post-listing news-article wp-sticky' ); ?>>
	<div class="ribbon"><span>FEATURED</span></div>
<?php else : ?>
	<?php post_class( 'post-listing news-article' ); ?>>
<?php endif; ?>
	<header>
		<h2>
			<small aria-hidden="true">
				<?php
				$categories = get_the_category();
				$separator  = ', ';
				$output     = '';
				if ( ! empty( $categories ) ) {
					foreach ( $categories as $category ) {
						$output .= $category->name . $separator;
					}
					echo trim( $output, $separator );
				}
				if ( has_tag( 'gallery' ) ) :
					?>
				, Image Gallery<?php endif; ?>
			</small>
			<br>
			<?php if ( get_post_meta( $post->ID, 'ecpt_external_link', true ) ) : ?>
				<a href="<?php echo get_post_meta( $post->ID, 'ecpt_external_link', true ); ?>" target="_blank" title="<?php the_title(); ?>" class="archive-post external-link" id="post-<?php the_ID(); ?>"><?php the_title(); ?> <span class="icon-new-tab2" aria-hidden="true"></span>
				</a>
			<?php else : ?>
				<a href="<?php the_permalink(); ?>" class="archive-post" id="post-<?php the_ID(); ?>"><?php the_title(); ?></a>
			<?php endif; ?>
		</h2>
		<?php ksasacademic_entry_meta(); ?>
	</header>

	<div class="entry-content">
		<div class="grid-x">
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="cell small-12 medium-5 large-3">
				<?php
				the_post_thumbnail(
					array( 200, 200 ),
					array(
						'class' => 'alignleft news-thumb',
						'alt'   => esc_html( get_the_title() ),
					)
				);
				?>
			</div>
			<div class="cell small-12 medium-7 large-9">
				<?php echo strip_tags( get_the_excerpt() ); ?>
			</div>
		<?php else : ?>
			<div class="cell small-12">
				<?php echo strip_tags( get_the_excerpt() ); ?>
			</div>
		<?php endif; ?>
		</div>
	</div>
</article>
