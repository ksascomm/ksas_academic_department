<?php
/**
 * The default template for displaying exhibits content
 *
 * Used for both single exhibits.
 *
 * @package KSASAcademicDepartment
 * @since KSASAcademicDepartment 1.0.0
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-listing exhibit' ); ?>>
	<header>
		<h1>
		<?php the_title(); ?>
		</h1>
	</header>
	<div class="entry-content">
		<div class="exhibit-body">
			<h3>
			<?php if ( get_post_meta( $post->ID, 'ecpt_location', true ) ) : ?>
				Location: <small><?php echo get_post_meta( $post->ID, 'ecpt_location', true ); ?></small><br>
			<?php endif; ?>
			<?php if ( get_post_meta( $post->ID, 'ecpt_dates', true ) ) : ?>
				Dates: <small><?php echo get_post_meta( $post->ID, 'ecpt_dates', true ); ?></small>
			<?php endif; ?>
			</h3>
			<?php
			$images      = array(
				'post_type'      => 'attachment',
				'orderby'        => 'menu_order',
				'post_mime_type' => 'image',
				'post_status'    => null,
				'posts_per_page' => 10,
				'post_parent'    => $post->ID,
			);
			$attachments = get_posts( $images );
			if ( ! empty( $attachments ) ) :
				?>

			<h3>Images</h3>
				<div class="grid-container">
					<div class="grid-x grid-padding-x small-up-1 large-up-3">
						<?php
						foreach ( $attachments as $attachment ) :
							$alt         = $attachment->post_title;
							$image_title = $attachment->post_title;
							$caption     = $attachment->post_excerpt;
							$description = $attachment->post_content;
							?>
						<div class="cell">
							<div class="card exhibit-image">
								<a data-open="modal-image-<?php echo $attachment->ID; ?>">
									<?php echo wp_get_attachment_image( $attachment->ID, 'featured-small' ); ?>
								</a>
							</div>
						</div>
						<div id="modal-image-<?php echo $attachment->ID; ?>" class="small reveal" data-reveal data-animation-in="scale-in-up" data-animation-out="scale-out-down">
							<?php echo wp_get_attachment_image( $attachment->ID, 'full' ); ?>
							<p><?php echo $image_title; ?></p>
							<button class="close-button" data-close aria-label="Close modal" type="button">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<?php endforeach; ?>
					</div>
				</div>
						<?php else : ?>
				<h3>Images</h3>
				<a data-open="modal-post-thumb">
							<?php
							if ( has_post_thumbnail() ) {
								the_post_thumbnail(
									'medium',
									array( 'alt' => esc_html( get_the_title() ) )
								);  }
							?>
				</a>
				<div id="modal-post-thumb" class="small reveal" data-reveal data-animation-in="scale-in-up" data-animation-out="scale-out-down">
							<?php
							if ( has_post_thumbnail() ) {
								the_post_thumbnail(
									'full',
									array( 'alt' => esc_html( get_the_title() ) )
								);  }
							?>
					<button class="close-button" data-close aria-label="Close modal" type="button">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			<?php endif; ?>
				<h3>Description</h3>
				<?php the_content(); ?>
		</div>
	</div>
</article>
