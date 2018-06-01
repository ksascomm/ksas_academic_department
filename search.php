<?php
/**
 * The template for displaying search results pages.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header(); ?>

<div class="main-container" id="page">
	<div class="main-grid">
		<main id="search-results" class="main-content">

		<header>
		    <h1 class="entry-title"><?php _e( 'Search Results for', 'foundationpress' ); ?> "<?php echo get_search_query(); ?>"</h1>
		</header>

		<?php if ( have_posts() ) : ?>

			<?php
            while ( have_posts() ) :
the_post();
?>
				<?php get_template_part( 'template-parts/content', 'search-results' ); ?>
			<?php endwhile; ?>

			<?php else : ?>
				<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>

		<?php
		if ( function_exists( 'foundationpress_pagination' ) ) :
			foundationpress_pagination();
		elseif ( is_paged() ) :
		?>
			<nav id="post-nav">
				<div class="post-previous"><?php next_posts_link( __( '&larr; Older posts', 'foundationpress' ) ); ?></div>
				<div class="post-next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'foundationpress' ) ); ?></div>
			</nav>
		<?php endif; ?>

		</main>
		<aside class="sidebar">
			<div class="widget widget_text">
				<div class="widget_title">
					<h5 class="white">Search Krieger Network?</h5>
				</div>
				<div class="textwidget">
					<p>You are currently searching on <strong><?php echo bloginfo('name'); ?></strong>. Would you like to search the entire <a href="http://krieger.jhu.edu/search/?q=<?php echo esc_attr(get_search_query()); ?>">Krieger network?</a></p>
				</div>
			</div>
		</aside>

	</div>
</div>
<?php
get_footer();
