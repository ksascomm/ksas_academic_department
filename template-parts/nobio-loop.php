<?php
/**
 * Template part for displaying People CPT *without* ecpt_bio in various
 * people-direcory page templates
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package KSASAcademicDepartment
 */

?>
<li class="item person <?php echo esc_html( get_the_directory_filters( $post ) ); ?> <?php echo esc_html( get_the_roles( $post ) ); ?>">
	<div class="media-object">
		<?php if ( has_post_thumbnail() ) : ?>
			<?php if ( get_post_meta( $post->ID, 'ecpt_website', true ) ) : ?>
				<div class="media-object-section hide-for-print">
					<a href="<?php echo esc_url( get_post_meta( $post->ID, 'ecpt_website', true ) ); ?>" aria-label="<?php the_title(); ?> 's webpage">
						<?php
						$alt_title = get_the_title();
						the_post_thumbnail(
							'directory',
							array(
								'class' => 'hide-for-small-only',
								'alt'   => $alt_title,
							)
						);
						?>
					</a>
				</div>
			<?php else : ?>
				<div class="media-object-section hide-for-print">
					<?php
					$alt_title = get_the_title();
					the_post_thumbnail(
						'directory',
						array(
							'class' => 'hide-for-small-only',
							'alt'   => $alt_title,
						)
					);
					?>
				</div>
			<?php endif; ?>
		<?php endif; ?>
		<div class="media-object-section">
			<h3>
			<?php if ( get_post_meta( $post->ID, 'ecpt_website', true ) ) : ?>
				<a href="<?php echo esc_url( get_post_meta( $post->ID, 'ecpt_website', true ) ); ?>" aria-label="<?php the_title(); ?>'s website" target="_blank">
					<?php the_title(); ?>
				</a>
			<?php else : ?>
				<?php the_title(); ?>
			<?php endif; ?>
			</h3>
			<?php if ( get_post_meta( $post->ID, 'ecpt_position', true ) ) : ?>
				<h4><?php echo wp_kses_post( get_post_meta( $post->ID, 'ecpt_position', true ) ); ?></h4>
			<?php endif; ?>
			<?php if ( get_post_meta( $post->ID, 'ecpt_degrees', true ) ) : ?>
				<h5><?php echo wp_kses_post( get_post_meta( $post->ID, 'ecpt_degrees', true ) ); ?></h5>
			<?php endif; ?>
			<ul class="contact">
				<?php if ( get_post_meta( $post->ID, 'ecpt_email', true ) ) : ?>
					<li><span class="fa-solid fa-envelope"></span> <a href="<?php echo esc_url( 'mailto:' . get_post_meta( $post->ID, 'ecpt_email', true ) ); ?>"> <?php echo esc_html( get_post_meta( $post->ID, 'ecpt_email', true ) ); ?></a></li>
				<?php endif; ?>
				<?php if ( get_post_meta( $post->ID, 'ecpt_office', true ) ) : ?>
					<li><span class="fa-solid fa-location-dot"></span> <?php echo esc_html( get_post_meta( $post->ID, 'ecpt_office', true ) ); ?></li>
				<?php endif; ?>
				<?php if ( get_post_meta( $post->ID, 'ecpt_phone', true ) ) : ?>
					<li><span class="fa-solid fa-phone-office"></span> <?php echo esc_html( get_post_meta( $post->ID, 'ecpt_phone', true ) ); ?></li>
				<?php endif; ?>
				<?php if ( get_post_meta( $post->ID, 'ecpt_lab_website', true ) ) : ?>
					<li><span class="fa-solid fa-earth-americas"></span> <a href="<?php echo esc_url( get_post_meta( $post->ID, 'ecpt_lab_website', true ) ); ?>" onclick="ga('send', 'event', 'People Directory', 'Group/Lab Website', '<?php the_title(); ?> | <?php echo esc_url( get_post_meta( $post->ID, 'ecpt_lab_website', true ) ); ?>')" target="_blank" aria-label="<?php the_title(); ?>'s Group/Lab Website">Group/Lab Website</a></li>
				<?php endif; ?>
				<?php if ( get_post_meta( $post->ID, 'ecpt_expertise', true ) ) : ?>
					<li><strong>Research Interests:&nbsp;</strong><?php echo esc_html( get_post_meta( $post->ID, 'ecpt_expertise', true ) ); ?></li>
				<?php endif; ?>
			</ul>
		</div>
	</div>
</li>
