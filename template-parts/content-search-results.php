<?php
/**
 * The default template for displaying search results content
 *
 * Used for both single and index/archive/search.
 *
 * @package KSASAcademicDepartment
 * @since KSASAcademicDepartment 1.0.0
 */

?>

<article aria-labelledby="post-<?php the_ID(); ?>" <?php post_class( 'post-listing news-article single-search-result' ); ?>>
	<header>
		<h3>
			<a href="<?php the_permalink(); ?>" id="post-<?php the_ID(); ?>">
				<?php the_title(); ?>
			</a>
		</h3>
	</header>

	<div class="entry-content">
		<?php the_excerpt(); ?>
	</div>
</article>
