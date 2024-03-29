<?php
/**
 * The default template for displaying humanities highlights
 *
 * Used for both single exhibits.
 *
 * @package KSASAcademicDepartment
 * @since KSASAcademicDepartment 1.0.0
 */

?>

<article aria-labelledby="post-<?php the_ID(); ?>" <?php post_class( 'post-listing news-article grid-x grid-margin-x' ); ?>>

<?php if ( has_tag( 'video' ) ) : ?>
	<div class="large-6 cell">
		<?php the_content(); ?>
	</div>
	<div class="large-6 cell">
		<header>
			<h1 id="post-<?php the_ID(); ?>">
			<a href="
				<?php
				if ( get_post_meta( $post->ID, 'ecpt_highlight_location', true ) ) :
					?>
					<?php echo get_post_meta( $post->ID, 'ecpt_highlight_location', true ); ?>
					<?php
				elseif ( get_post_meta( $post->ID, 'ecpt_external_link', true ) ) :
						echo get_post_meta( $post->ID, 'ecpt_external_link', true );
				else :
						the_permalink();
				endif;
				?>
				">
					<?php the_title(); ?>
				</a>
			</h1>
		</header>
		<div class="entry-content">
			<?php the_excerpt(); ?>
		</div>
	</div>
<?php else : ?>
	<div class="large-4 cell">
		<?php
		the_post_thumbnail(
			'large',
			array(
				'class' => 'front-humanities-highlight',
				'alt'   => esc_html( get_the_title() ),
			)
		);
		?>
	</div>
	<div class="large-8 cell">
		<header>
			<h1 id="post-<?php the_ID(); ?>">
			<a href="
				<?php
				if ( get_post_meta( $post->ID, 'ecpt_highlight_location', true ) ) :
					?>
					<?php echo get_post_meta( $post->ID, 'ecpt_highlight_location', true ); ?>
					<?php
				elseif ( get_post_meta( $post->ID, 'ecpt_external_link', true ) ) :
						echo get_post_meta( $post->ID, 'ecpt_external_link', true );
				else :
						the_permalink();
				endif;
				?>
				">
					<?php the_title(); ?>
				</a>
			</h1>
		</header>
		<div class="entry-content">
			<?php the_content(); ?>
		</div>
	</div>
<?php endif; ?>
</article>
