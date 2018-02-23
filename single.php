<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header();

?>
<div class="main-container" id="page">
	<div class="main-grid">
		<main class="main-content-full-width">
			<?php
            while ( have_posts() ) :
the_post();
?>
				<?php if ( in_category('books') ) : ?>
					<?php get_template_part( 'template-parts/content', 'books' ); ?>
			<?php else : ?>
				<?php get_template_part( 'template-parts/content', '' ); ?>
			<?php endif; ?>
			<?php endwhile; ?>
		</main>
	</div>
</div>
<?php
get_footer();