<?php
/**
 * Block Name: Testimonials
 *
 * This is the template that displays the testimonials loop block.
 *
 * @package KSASAcademicDepartment
 * @since KSASAcademicDepartment 7.0.0
 */

$arg_type         = get_field( 'loop_argument_type' );
$testimonial_type = get_field( 'testimonial_type' );
if ( $arg_type == 'count' ) :
	$args = array(
		'orderby'        => 'rand',
		'post_type'      => 'testimonial',
		'posts_per_page' => get_field( 'testimonial_count' ),
		'tax_query'      => array(
			array(
				'taxonomy' => 'testimonialtype',
				'terms'    => $testimonial_type,
			),
		),
	);
else :
	$testimonials = get_field( 'select_testimonials' );
	$args         = array(
		'orderby'   => 'title',
		'post_type' => 'testimonial',
		'post__in'  => $testimonials,
	);
endif;

$class_name = 'testimonial';

if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
	$class_name .= ' align' . $block['align'];
}
if ( $is_preview ) {
	$class_name .= ' is-admin';
}

$the_query = new WP_Query( $args );

if ( $the_query->have_posts() ) : ?>
<div class="container">
	<?php
	while ( $the_query->have_posts() ) :
		$the_query->the_post();
		?>
	<div class="testimonials block">
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
		<div class="content-section">
			<h3><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h3>
			<h4>
			<?php if ( get_post_meta( get_the_ID(), 'ecpt_job', true ) ) : ?>
				<?php echo esc_html( get_post_meta( get_the_ID(), 'ecpt_job', true ) ); ?><br>
			<?php endif; ?>
			<?php if ( get_post_meta( get_the_ID(), 'ecpt_internship', true ) ) : ?>
				<?php echo esc_html( get_post_meta( get_the_ID(), 'ecpt_internship', true ) ); ?><br>
			<?php endif; ?>
			<?php if ( get_post_meta( get_the_ID(), 'ecpt_class', true ) ) : ?>
				Class of <?php echo esc_html( get_post_meta( get_the_ID(), 'ecpt_class', true ) ); ?>
			<?php endif; ?>
			</h4>
			<p>
			<?php
			global $post;
			if ( get_post_meta( $post->ID, 'ecpt_pull_quote', true ) ) :
				?>
				<?php echo esc_html( get_post_meta( $post->ID, 'ecpt_pull_quote', true ) ); ?>
			<?php elseif ( get_post_meta( $post->ID, 'ecpt_quote', true ) ) : ?>
				<?php echo esc_html( get_post_meta( $post->ID, 'ecpt_quote', true ) ); ?>
			<?php else : ?>
				<?php the_excerpt(); ?>
			<?php endif; ?>
			</p>
		</div>
	</div>

	<?php endwhile; ?>
	</div>
<?php endif; ?>
