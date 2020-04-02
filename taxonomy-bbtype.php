<?php
/**
 * The template for displaying Spotlight archives
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header();
	$home_url = home_url();
	if (is_tax('bbtype', 'jobs-bb') ) {
	$bbname = 'Job Opportunities';
	$bblink = 'jobs-bb';
	}
	elseif (is_tax('bbtype', 'research-bb') ) {
	$bbname = 'Research Opportunities';
	$bblink = 'research-bb';
	}
	elseif (is_tax('bbtype', 'internships-bb') ) {
	$bbname = 'Internship Opportunities';
	$bblink = 'internships-bb';
	}
	elseif (is_tax('bbtype', 'volunteering-bb') ) {
	$bbname = 'Volunteering Opportunities';
	$bblink = 'volunteering-bb';
	}
	elseif (is_tax('bbtype', 'research-internships') ) {
	$bbname = 'Research & Internships';
	$bblink = 'research-internships';
	}
	elseif (is_tax('bbtype', 'international-programs') ) {
	$bbname = 'International Travel Grants';
	$bblink = 'international-programs';
	}
	elseif (is_tax('bbtype', 'language-grants') ) {
	$bbname = 'Language Learning Grants';
	$bblink = 'language-grants';
	} else {
	$bbname = 'Bulletin Board';
	}
	?>	

<div class="main-container" id="page">
    <div class="main-grid sidebar-right">
        <main class="main-content">
			
			<h1 class="page-title"><?php echo $bbname; ?></h1>

		<?php if ( have_posts() ) : ?>
			<?php /* Start the Loop */ ?>

			<?php
            while ( have_posts() ) :
the_post();
?>
				<h2><?php the_title(); ?></h2>
				<h3>Posted: <?php the_time('F j, Y'); ?></h3>
				<?php the_content(); ?>
				<hr>
			<?php endwhile; ?>

			<?php else : ?>
				<?php get_template_part( 'template-parts/content', 'none' ); ?>

			<?php endif; // End have_posts() check. ?>

			<?php /* Display navigation to next/previous pages when applicable */ ?>
			<?php
			if ( function_exists( 'foundationpress_pagination' ) ) :
				foundationpress_pagination();
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
