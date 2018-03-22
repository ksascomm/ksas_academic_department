<?php
/**
 * The default template for displaying search results content
 *
 * Used for both single and index/archive/search.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

?>

<article aria-labelledby="post-<?php the_ID(); ?>" <?php post_class('post-listing news-article single-search-result'); ?>>
	<header>
		<h3>
			<a href="<?php the_permalink(); ?>" id="post-<?php the_ID(); ?>">	
				<?php the_title(); ?>
			</a>
		</h3>
	</header>

	<div class="entry-content">
		<?php
        $content = get_the_content();
  		$trimmed_content = wp_trim_words( $content, 60, '[...]' );
        ?>
  		<p><?php echo $trimmed_content; ?></p>
	</div>	
</article>
