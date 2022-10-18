<?php
/**
 * Spotlight Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during backend preview render.
 * @param   int $post_id The post ID the block is rendering content against.
 *          This is either the post ID currently being displayed inside a query loop,
 *          or the post ID of the post hosting this block.
 * @param   array $context The context provided to the block by the post or it's parent block.
 */

$arg_type         = get_field( 'loop_argument_type' );
$testimonial_type = get_field( 'testimonial_type' );
if ( $arg_type == 'random' ) :
	$args = array(
		'orderby'        => 'rand',
		'post_type'      => array( 'testimonial', 'profile' ),
		'posts_per_page' => 1,
	);
else :
	$testimonials = get_field( 'select_testimonials' );
	$args         = array(
		'orderby'   => 'title',
		'post_type' => array( 'testimonial', 'profile' ),
		'post__in'  => $testimonials,
	);
endif;

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'spotlight-block';
if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
	$class_name .= ' align' . $block['align'];
}

if ( $is_preview ) {
	$class_name .= ' is-admin';
}

$spotlight_block_query = new WP_Query( $args );

if ( $spotlight_block_query->have_posts() ) :
	while ( $spotlight_block_query->have_posts() ) :
		$spotlight_block_query->the_post();
		?>
<div class="<?php echo esc_attr( $class_name ); ?>">
	<blockquote class="spotlight-blockquote">
		<div class="spotlight-text">
		<?php
		global $post;
		if ( get_post_meta( $post->ID, 'ecpt_pull_quote', true ) ) :
			?>
				<p><?php echo wp_kses_post( get_post_meta( $post->ID, 'ecpt_pull_quote', true ) ); ?></p>
			<?php elseif ( get_post_meta( $post->ID, 'ecpt_quote', true ) ) : ?>
				<p><?php echo wp_kses_post( get_post_meta( $post->ID, 'ecpt_quote', true ) ); ?></p>
			<?php else : ?>
				<?php the_excerpt(); ?>
			<?php endif; ?>
		</div>
		<div class="spotlight-author">
			<a href="<?php echo esc_url( get_permalink() ); ?>">
				<?php the_title(); ?>
			</a>
		</div>
		<?php
		global $post;
		if ( have_rows( 'custom_profile_fields', $post->ID ) ) :
			?>
			<div class="spotlight-role">
				<ul class="no-bullets">
				<?php
				while ( have_rows( 'custom_profile_fields', $post->ID ) ) :
					the_row();
					?>
					<li><span class="custom-title"><?php the_sub_field( 'custom_title', $post->ID ); ?></span>&nbsp;<span class="custom-content"><?php the_sub_field( 'custom_content', $post->ID ); ?></span>
					</li>
				<?php endwhile; ?>
				</ul>
			</div>
		<?php else : ?>
			<?php // No rows found! ?>
		<?php endif; ?>
	</blockquote>
	<div class="spotlight-image">
			<?php
			if ( has_post_thumbnail() ) {
				the_post_thumbnail(
					'full',
					array(
						'alt' => esc_html( get_the_title() ),
					)
				);
			}
			?>
	</div>
</div>
	<?php endwhile;
endif;
?>
