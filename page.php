<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header(); ?>
<?php get_template_part( 'template-parts/featured-image' ); ?>
<div class="main-container" id="page">
    <div class="main-grid">
        <main class="main-content">
            <?php while ( have_posts() ) : the_post(); ?>
                <?php get_template_part( 'template-parts/content', 'page' ); ?>
            <?php endwhile; ?>
            <?php if (is_page('Sitemap') ) : ?>
            	<?php
                wp_nav_menu(
                     array(
						 'theme_location' => 'top-bar-r',
						 'menu_class' => 'vertical',
                         'items_wrap' => '<ul class="%2$s" role="navigation" aria-label="Sitemap Menu">%3$s</ul>',
					 )
                    );
                ?>
            <?php endif; ?>
        </main>
        <?php get_sidebar(); ?>
    </div>
</div>
<?php
get_footer();
