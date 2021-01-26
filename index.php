<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * e.g., it puts together the home page when no home.php file exists.
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package KSASAcademicDepartment
 * @since KSASAcademicDepartment 1.0.0
 */

get_header();
	$theme_option = flagship_sub_get_global_options();
	$collection_name = $theme_option['flagship_sub_search_collection'];
	$news_query_cond = $theme_option['flagship_sub_news_query_cond']; ?>
	<div class="main-container" id="page">
		<div class="main-grid">
			<main class="main-content">
				<h1 class="page-title"><?php echo $theme_option['flagship_sub_feed_name']; ?> Archive</h1>

			<?php $paged = (get_query_var('paged')) ? (int) get_query_var('paged') : 1;

				if ($news_query_cond === 1) {
					$news_archive_query = new WP_Query(array(
						'post_type' => array('post'),
						'tax_query' => array(
							array(
								'taxonomy' => 'category',
								'field' => 'slug',
								'terms' => array( 'books' ),
								'operator' => 'NOT IN'
							)
						),
						'posts_per_page' => 10,
						'paged' => $paged));
				} else {
					$news_archive_query = new WP_Query(array(
						'post_type' => array('post'),
						'posts_per_page' => 10,
						'paged' => $paged
						));
				}

			while ($news_archive_query->have_posts()) : $news_archive_query->the_post(); ?>

					<?php get_template_part( 'template-parts/content-news', get_post_format() ); ?>
				<?php endwhile; ?>


				<?php /* Display navigation to next/previous pages when applicable */ ?>
			<?php
			if ( function_exists( 'ksasacademic_pagination' ) ) :
				ksasacademic_pagination();
			elseif ( is_paged() ) :
			?>
				<nav id="post-nav">
					<div class="post-previous"><?php next_posts_link( __( '&larr; Older posts', 'ksasacademic' ) ); ?></div>
					<div class="post-next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'ksasacademic' ) ); ?></div>
				</nav>
			<?php endif; ?>
			</main>
			<?php get_sidebar(); ?>
		</div>
	</div>
<?php
get_footer();
