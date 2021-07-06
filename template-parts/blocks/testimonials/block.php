<?php
/**
 * Block Name: Testimonials
 *
 * This is the template that displays the testimonials loop block.
 */

$argType = get_field( 'loop_argument_type' );
if ( $argType == 'count' ) :
	$args = array(
		'orderby'        => 'title',
		'post_type'      => 'testimonial',
		'posts_per_page' => get_field( 'testimonial_count' ),
	);
else :
	$testimonials = get_field( 'select_testimonials' );
	$args         = array(
		'orderby'   => 'title',
		'post_type' => 'testimonial',
		'post__in'  => $testimonials,
	);
endif;

$the_query = new WP_Query( $args );

if ( $the_query->have_posts() ) :
	while ( $the_query->have_posts() ) :
		$the_query->the_post(); ?>
	<div class="testimonials block card">
		<?php
		if ( has_post_thumbnail() ) {
				the_post_thumbnail(
					'large',
					array(
						'class' => 'testimonial-image',
						'alt'   => esc_html( get_the_title() ),
					)
				);
		}
		?>
		<div class="card-section">
		<h3><?php the_title(); ?></h3>
		<?php if ( get_post_meta( get_the_ID(), 'ecpt_job', true ) ) : ?>
			<h4><?php echo esc_html( get_post_meta( get_the_ID(), 'ecpt_job', true ) ); ?></h4>
		<?php endif; ?>
		<?php the_content(); ?>
		<?php if ( get_post_meta( get_the_ID(), 'ecpt_internship', true ) ) : ?>
			<p><?php echo esc_html( get_post_meta( get_the_ID(), 'ecpt_internship', true ) ); ?></p>
		<?php endif; ?>
		<?php if ( get_post_meta( get_the_ID(), 'ecpt_class', true ) ) : ?>
				<p>Class of <?php echo esc_html( get_post_meta( get_the_ID(), 'ecpt_class', true ) ); ?></p>
		<?php endif; ?>
		</div>
	</div>

	<?php endwhile; ?>
<?php endif; ?>
