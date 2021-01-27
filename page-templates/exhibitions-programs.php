<?php
/**
 * Template Name: Exhibitions & Programs
 *
 * @package KSASAcademicDepartment
 * @since KSASAcademicDepartment 1.0.0
 */

get_header(); ?>

<div class="main-container" id="page">
	<div class="main-grid">
		<main class="main-content-full-width">
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<?php get_template_part( 'template-parts/content', 'page' ); ?>
			<?php endwhile; ?>

			<?php
			$args = array(
				'orderby'    => 'ID',
				'order'      => 'ASC',
				'hide_empty' => true,
			);

			$exhibits = get_terms( 'exhibition_type', $args );
			if ( ! empty( $exhibits ) && ! is_wp_error( $exhibits ) ) {
				$count        = count( $exhibits );
				$i            = 0;
				$exhibit_list = '<div class="exhibit-categories button-group">';
				foreach ( $exhibits as $exhibit ) {
					$i++;
					$exhibit_list .= '<a class="exhibit-category button" href="' . esc_url( get_term_link( $exhibit ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts filed under %s', 'ksasacademic' ), $exhibit->name ) ) . '">' . $exhibit->name . '</a>';
					if ( $count != $i ) {
						$exhibit_list .= '';
					} else {
						$exhibit_list .= '</div>';
					}
				}
				echo $exhibit_list;
			}
			?>

			<?php
			$paged                          = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
				$flagship_exhibitions_query = new WP_Query(
					array(
						'post_type'      => 'ksasexhibits',
						'orderby'        => 'date',
						'order'          => 'DESC',
						'posts_per_page' => 30,
						'paged'          => $paged,
					)
				);
				?>

			<?php if ( $flagship_exhibitions_query->have_posts() ) : ?>

			<div class="grid-x grid-padding-x small-up-1 medium-up-2 large-up-3">

				<?php
				while ( $flagship_exhibitions_query->have_posts() ) :
					$flagship_exhibitions_query->the_post();

					get_template_part( 'template-parts/content-exhibits', 'card' );
					?>

				<?php endwhile; ?>

			</div>

				<?php
				$total_pages = $flagship_exhibitions_query->max_num_pages;

				if ( $total_pages > 1 ) {
					$current_page = max( 1, get_query_var( 'paged' ) );
					echo '<div class="pagination text-center">';
					echo paginate_links(
						array(
							'base'      => get_pagenum_link( 1 ) . '%_%',
							'format'    => 'page/%#%',
							'current'   => $current_page,
							'total'     => $total_pages,
							'prev_text' => __( '« prev' ),
							'next_text' => __( 'next »' ),
							'type'      => 'list',
						)
					);
					echo '</div>';
				}
				?>
			<?php else : ?>
				<h2><?php _e( '404 Error&#58; Not Found', '' ); ?></h2>
			<?php endif; ?>

		</main>
	</div>
</div>
<?php
get_footer();
