<?php
/**
 * The default template for displaying page content
 *
 * @package KSASAcademicDepartment
 * @since KSASAcademicDepartment 1.0.0
 */

?>

<article aria-labelledby="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header>
		<h1 class="entry-title" id="post-<?php the_ID(); ?>"><?php the_title(); ?></h1>
	</header>
	<div class="entry-content">
		<?php the_content(); ?>
		<?php edit_post_link( __( '(Edit)', 'ksasacademic' ), '<span class="edit-link">', '</span>' ); ?>
	</div>
</article>
