<?php
/*
Template Name: Courses - Graduate CPT
*/
?>	

<?php get_header(); ?>
<?php get_template_part( 'template-parts/featured-image' ); ?>
<div class="main-container" id="page">
    <div class="main-grid">
        <main class="main-content">
            <?php
            while ( have_posts() ) :
the_post();
?>
                <?php get_template_part( 'template-parts/content', 'page' ); ?>
            <?php endwhile; ?>

			<?php
			// Get any existing copy of our transient data
			if ( false === ( $ksas_course_grad_query = get_transient( 'ksas_course_grad_query' ) ) ) {
			// It wasn't there, so regenerate the data and save the transient
				$ksas_course_grad_query = new WP_Query(
                    array(
						'post-type' => 'course',
						'coursetype' => 'graduate-course',
						'orderby' => 'title',
						'order' => 'ASC',
						'posts_per_page' => '100',
					)
                    );
				set_transient( 'ksas_course_grad_query', $ksas_course_grad_query, 86400 );
			}
			?>
			<?php if ($ksas_course_grad_query->have_posts() ) : ?>
				<ul class="accordion courses-cpt" data-accordion data-multi-expand="true" data-allow-all-closed="true">
			<?php
            while ($ksas_course_grad_query->have_posts() ) :
$ksas_course_grad_query->the_post();
?>
				<li class="accordion-item course-cpt" data-accordion-item>
					<a href="#post<?php the_ID(); ?>" class="accordion-title"><?php the_title(); ?>
					<?php if ( get_post_meta($post->ID, 'ecpt_credit', true) ) : ?>
						&nbsp;(<?php echo get_post_meta($post->ID, 'ecpt_credit', true); ?> Credits)
					<?php endif; ?>
					</a>
				<div id="post<?php the_ID(); ?>" class="accordion-content" data-tab-content>
					<?php the_content(); ?>
					<?php if ( get_post_meta($post->ID, 'ecpt_prereqs', true) ) : ?>
						<p><strong>Prerequisites:</strong> 
						<?php echo get_post_meta($post->ID, 'ecpt_prereqs', true); ?></p>
					<?php endif; ?>
					<p>
					<?php if ( get_post_meta($post->ID, 'ecpt_instructor', true) ) : ?>
						<strong>Instructor:</strong> 
						<?php echo get_post_meta($post->ID, 'ecpt_instructor', true); ?><br>
					<?php endif; ?>
					
					<?php if ( get_post_meta($post->ID, 'ecpt_course_times', true) ) : ?>
						<strong>Course Times:</strong> 
						<?php echo get_post_meta($post->ID, 'ecpt_course_times', true); ?><br>
					<?php endif; ?>
					
					<?php if ( get_post_meta($post->ID, 'ecpt_course_limit', true) ) : ?>
						<strong>Course Limit:</strong> 
						<?php echo get_post_meta($post->ID, 'ecpt_course_limit', true); ?><br>
					<?php endif; ?>
					
					<?php if ( get_post_meta($post->ID, 'ecpt_course_website', true) ) : ?>
						<a href="<?php echo get_post_meta($post->ID, 'ecpt_course_website', true); ?>" target="_blank" aria-label="Link to <?php the_title(); ?>'s website">View course website/syllabus</a>
					<?php endif; ?>
					</p>
				</div>
				</li>
			<?php endwhile; ?>
				</ul>
			<?php endif; ?>            
        </main>
        <?php get_sidebar(); ?>
    </div>
</div>
<?php
get_footer();
