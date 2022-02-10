<?php
/**
 * The default template for displaying content (usualy single news posts)
 *
 * Used for both single and index/archive/search.
 *
 * @package KSASAcademicDepartment
 * @since KSASAcademicDepartment 1.0.0
 */

?>

<article aria-labelledby="post-<?php the_ID(); ?>" <?php post_class( 'post-singular single-post' ); ?>>
		<header>
		<?php if ( is_single() ) : ?>
			<h1 class="entry-title" id="post-<?php the_ID(); ?>"><?php the_title(); ?></h1>
			<?php else : ?>
			<h2 class="entry-title" id="post-<?php the_ID(); ?>"><a href="<?php esc_url( get_permalink() ); ?>" rel="bookmark"></a><?php the_title(); ?></h2>
		<?php endif; ?>
			<ul class="no-bullet meta">
				<li>Posted on: <?php ksasacademic_entry_meta(); ?></li>
				<li>Posted in: <strong><span class="capitalize">
				<?php
				$categories        = get_the_category();
						$separator = ', ';
						$output    = '';
				if ( ! empty( $categories ) ) {
					foreach ( $categories as $category ) {
						$output .= $category->name . $separator;
					}
					echo trim( $output, $separator );
				}
				if ( has_tag( 'gallery' ) ) :
					?>
				, Image Gallery<?php endif; ?>
						</span></strong>
				</li>
			</ul>
		</header>
		<div class="entry-content">
			<?php if ( ! has_tag( 'gallery' ) ) : ?>
				<?php
				the_post_thumbnail(
					'medium',
					array(
						'class' => 'image-left',
						'alt'   => 'Featured image',
					)
				);
				?>
			<?php endif; ?>
			<?php the_content(); ?>
			<?php edit_post_link( __( '(Edit)', 'ksasacademic' ), '<span class="edit-link">', '</span>' ); ?>
		</div>
</article>
