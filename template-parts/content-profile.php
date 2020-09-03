<?php
/**
 * The default template for displaying profiles content
 *
 * Used for both single and index/archive/search.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

?>

<article aria-labelledby="post-<?php the_ID(); ?>" <?php post_class('post-singular'); ?>>
		<header>
			<h2 id="post-<?php the_ID(); ?>"><?php the_title(); ?></h2>
		</header>
		<div class="entry-content">
			<?php if ( has_post_thumbnail()) {  the_post_thumbnail('thumbnail',
				array('alt' => esc_html ( get_the_title() ))
				);  } ?>
			<?php the_content(); ?>
			<?php edit_post_link( __( '(Edit)', 'ksasacademic' ), '<span class="edit-link">', '</span>' ); ?>
		</div>
</article>
<hr>