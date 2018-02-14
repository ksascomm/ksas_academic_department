<?php
/**
Template Name: Testimonial Listing (Alumni)
 * The template for displaying the Testimonial custom post type's alumni taxonomy
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
            <?php endwhile;?>
            <?php $ksas_alumni_testimonial_query = new WP_Query(array(
                    'post-type' => 'testimonial',
                    'testimonialtype' => 'alumni-testimonial',
                    'meta_key' => 'ecpt_testimonial_alpha',
                    'orderby' => 'meta_value',
                    'order' => 'ASC', 
                    'posts_per_page' => -1));
            ?>
            <?php if($ksas_alumni_testimonial_query->have_posts()) : ?>

            <div class="grid-x grid-padding-x small-up-2 large-up-3">
                <?php while ($ksas_alumni_testimonial_query->have_posts()) : $ksas_alumni_testimonial_query->the_post(); ?>
                <div class="cell testimonial-container">
                    <div class="testimonial-avatar">
                        <?php if ( has_post_thumbnail()) {  the_post_thumbnail('thumbnail', array('class'   => "testimonial-image"));  } ?>
                    </div>
                    <div class="testimonial-bio">
                        <h2><?php the_title(); ?></h2>
                        <?php if ( get_post_meta($post->ID, 'ecpt_job', true) ) : ?>
                            <h3><?php echo get_post_meta($post->ID, 'ecpt_job', true); ?></h3>
                        <?php endif; ?>
                        <?php if ( get_post_meta($post->ID, 'ecpt_class', true) ) : ?>
                            <h3>Class of: <span class="light"><?php echo get_post_meta($post->ID, 'ecpt_class', true); ?></span></h3>
                        <?php endif; ?>
                    </div>
                    <p class="center">
                        <button class="button testimonial-button float-center" data-open="post-<?php the_ID(); ?>">
                        Read Bio
                      </button>
                    </p>
                    <div class="reveal testimonial-content" id="post-<?php the_ID(); ?>" aria-labelledby="Modal-<?php the_ID(); ?>" data-reveal>
                        <h1 id="Modal-<?php the_ID(); ?>"><?php the_title(); ?></h1>
                        <div aria-label="<?php the_title(); ?>'s Full Testimonial"><?php the_content()?></div>
                        <button class="close-button" data-close aria-label="Close reveal" type="button">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>               
                </div>
                <?php endwhile; ?>
            </div>
        <?php endif;?>
        </main>
        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer();
