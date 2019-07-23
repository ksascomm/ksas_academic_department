<?php
/*
Template Name: Exhibitions & Programs
*/
get_header(); ?>

<div class="main-container" id="page">
	<div class="main-grid">
		<main class="main-content-full-width">
            <?php while ( have_posts() ) : the_post(); ?>
                <?php get_template_part( 'template-parts/content', 'page' ); ?>
            <?php endwhile; ?>

            <?php $exhibits = get_terms('exhibition_type', array(
							'orderby' 		=> 'ID',
							'order'			=> 'ASC',
							'hide_empty'	=> true,
							));
						
						$count_exhibits = count($exhibits);
						if ($count_exhibits > 0) { ?>
						<div class="row">
							<h3>Exhibit Types:</h3>
						</div>
						<div class="button-group">
							<?php foreach ( $exhibits as $exhibit ) { ?>
								<a class="button" href="<?php echo $exhibit->slug; ?>"><?php echo $exhibit->name; ?></a>
							<?php } ?>
						</div>
					<?php } ?>

			<?php
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				$flagship_exhibitions_query = new WP_Query(
                    array(
						'post_type' => 'ksasexhibits',
						'orderby' => 'date',
						'order' => 'DESC',
						'posts_per_page' => 30,
						'paged' => $paged,
					)
                );
			 ?>

			<?php if ($flagship_exhibitions_query->have_posts() ) : ?>

			<div class="grid-x grid-padding-x small-up-2 medium-up-3">

			<?php while ($flagship_exhibitions_query->have_posts() ) : $flagship_exhibitions_query->the_post();

					get_template_part( 'template-parts/content-exhibits', 'card' ); ?>

			<?php endwhile;?>

			</div>

		<?php $total_pages = $flagship_exhibitions_query->max_num_pages;

			if ($total_pages > 1 ) {
				$current_page = max(1, get_query_var('paged'));
				echo '<div class="pagination text-center">';
				echo paginate_links(
                    array(
						'base' => get_pagenum_link(1) . '%_%',
						'format' => 'page/%#%',
						'current' => $current_page,
						'total' => $total_pages,
						'prev_text'    => __('« prev'),
						'next_text'    => __('next »'),
						'type' => 'list',
					)
				);
				echo '</div>';
		    } ?>
                
			<?php else : ?>
				<h2><?php _e('404 Error&#58; Not Found', ''); ?></h2>
			<?php endif; ?>

        </main>
    </div>
</div>
<?php
get_footer();
