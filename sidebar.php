<?php
/**
 * The sidebar containing the main widget area
 *
 * @package KSASAcademicDepartment
 * @since KSASAcademicDepartment 1.0.0
 */

?>
<div class="sidebar">

<!-- Sidebar Menu -->
<?php
wp_reset_postdata();
if ( is_page() ) {
	?>
	<aside class="sidebar-menu-area" aria-labelledby="sidebar-navigation">
		<?php
		global $post;
		$ancestors = get_post_ancestors( $post->ID ); // Get the array of ancestors.
			// Get the top-level page slug for sidebar/widget content conditionals.
			$ancestor_id   = ( $ancestors ) ? $ancestors[ count( $ancestors ) - 1 ] : $post->ID;
			$the_ancestor  = get_page( $ancestor_id );
			$ancestor_slug = $the_ancestor->post_name;
			$children      = get_pages(
				array(
					'child_of' => $post->ID,
				)
			);

		// If there are no ancestors display a menu of children. If no children, hide menu.
		if ( count( $ancestors ) == 0 && is_front_page() == false ) {
			?>
			<div role="navigation" aria-label="sidebar navigation" class="sidebar-menu
					<?php
					if ( count( $children ) < 1 ) :
						echo 'widow';
						endif;
					?>
			">
				<h1 class="sidebar-menu-title" id="sidebar-navigation">In This Section</h1>

					<?php
					$page_name = $post->post_title;
					$test_menu = wp_nav_menu(
						array(
							'theme_location' => 'top-bar-r',
							'menu_class'     => 'nav',
							'submenu'        => $page_name,
							'depth'          => 1,
							'items_wrap'     => '<ul class="%2$s" aria-label="Sidebar Menu">%3$s</ul>',
						)
					);
					?>
			</div>

			<?php
			// If there are one or more display a menu of siblings.
		} elseif ( count( $ancestors ) == 1 ) {
			$parent_page = get_post( $post->post_parent );
			$parent_url  = get_permalink( $post->post_parent );
			$parent_name = $parent_page->post_title;
			?>
		<!--Below is displayed when on a child page -->
			<div class="sidebar-menu" role="navigation" aria-label="sidebar navigation">
				<h1 class="sidebar-menu-title" id="sidebar-navigation">Also in <a href="<?php echo esc_url( $parent_url ); ?>" aria-label="Sidebar Menu: <?php echo esc_html( $parent_name ); ?>"><?php echo esc_html( $parent_name ); ?></a></h1>
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'top-bar-r',
								'menu_class'     => 'nav',
								'submenu'        => $parent_name,
								'depth'          => 2,
								'items_wrap'     => '<ul class="%2$s" aria-label="Sidebar Menu">%3$s</ul>',
							)
						);
						?>

			</div>
			<?php
		} elseif ( count( $ancestors ) >= 2 ) {
			$current               = $post->ID;
			$parent                = $post->post_parent;
			$parent_link           = get_permalink( $parent );
			$get_grandparent       = get_post( $parent );
			$grandparent           = $get_grandparent->post_parent;
			$grandparent_name      = get_the_title( $grandparent );
			$grandparent_link      = get_permalink( $grandparent );
			$get_greatgrandparent  = get_post( $grandparent );
			$greatgrandparent      = $get_greatgrandparent->post_parent;
			$greatgrandparent_name = get_the_title( $greatgrandparent );
			?>
		<!--Below is displayed when on a grandchild page -->
		<div class="sidebar-menu" role="navigation" aria-label="sidebar navigation">
			<h1 class="sidebar-menu-title" id="sidebar-navigation">Inside
			<?php if ( $root_parent = get_the_title( $grandparent ) !== $root_parent = get_the_title( $current ) ) : ?>
				<a href="<?php echo esc_url( $grandparent_link ); ?>" aria-label="Sidebar Menu: <?php echo esc_html( $grandparent_name ); ?>"><?php echo esc_html( get_the_title( $grandparent ) ); ?></a>
			<?php else : ?>
				<a href="<?php echo esc_url( $parent_link ); ?>" aria-label="Sidebar Menu: <?php echo esc_html( $parent_name ); ?>"><?php echo esc_html( get_the_title( $parent ) ); ?></a>
			<?php endif; ?>
			</h1>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'top-bar-r',
					'menu_class'     => 'nav',
					'submenu'        => $grandparent_name,
					'depth'          => 3,
					'items_wrap'     => '<ul class="%2$s" aria-label="Sidebar Menu">%3$s</ul>',
				)
			);
			?>
		</div>
		<?php } ?>
		</aside>
	<?php } ?>

	<?php if ( is_home() || is_single() && ! is_singular( array( 'studyfields', 'ai1ec_event', 'people', 'testimonial' ) ) ) : ?>
	<aside class="sidebar-menu-area" aria-labelledby="sidebar-navigation">
		<div class="sidebar-menu" role="navigation" aria-label="sidebar navigation">
			<h1 class="sidebar-menu-title" id="sidebar-navigation">Also in <a href="<?php echo esc_url( get_home_url() ); ?>/about/" aria-label="Sidebar Menu: About">About</a></h1>
		<?php
			wp_nav_menu(
				array(
					'theme_location' => 'top-bar-r',
					'menu_class'     => 'nav',
					'submenu'        => 'About',
					'depth'          => 2,
					'items_wrap'     => '<ul class="%2$s" aria-label="Sidebar Menu">%3$s</ul>',
				)
			);
		?>
		</div>
	</aside>
	<?php endif; ?>

	<?php if ( is_singular( 'people' ) ) : ?>
		<aside class="sidebar-menu-area" aria-labelledby="sidebar-navigation">
			<div class="sidebar-menu" role="navigation" aria-label="sidebar navigation">
				<h1 class="sidebar-menu-title" id="sidebar-navigation">Also in <a href="<?php echo esc_url( get_home_url() ); ?>/people/" aria-label="Sidebar Menu: People">People</a></h1>
				<?php
					wp_nav_menu(
						array(
							'theme_location' => 'top-bar-r',
							'menu_class'     => 'nav',
							'submenu'        => 'People',
							'depth'          => 2,
							'items_wrap'     => '<ul class="%2$s" aria-label="Sidebar Menu">%3$s</ul>',
						)
					);
				?>
			</div>
			<?php if ( has_term( 'faculty', 'role' ) ) : ?>
				<div class="sidebar-menu faculty-bio-jump" aria-labelledby="jump-menu">
					<label for="jump">
						<h1 id="jump-menu">Jump to Faculty Member</h1>
					</label>
					<select name="jump" id="jump" onchange="window.open(this.options[this.selectedIndex].value,'_top')">
						<?php
						if ( have_posts() ) :
							while ( have_posts() ) :
								the_post();
								?>
							<option>---<?php the_title(); ?></option>
								<?php
						endwhile;
endif;
						?>
						<?php
						$jump_menu_query = new WP_Query(
							array(
								'post-type'      => 'people',
								'role'           => 'faculty',
								'meta_key'       => 'ecpt_people_alpha',
								'orderby'        => 'meta_value',
								'order'          => 'ASC',
								'posts_per_page' => 100,
							)
						);
						?>
						<?php
						while ( $jump_menu_query->have_posts() ) :
							$jump_menu_query->the_post();
							?>
								<?php if ( get_post_meta( $post->ID, 'ecpt_bio', true ) ) : ?>
									<option value="<?php the_permalink(); ?>"><?php the_title(); ?></option>
								<?php endif; ?>
						<?php endwhile; ?>
					</select>
				</div>
			<?php endif; ?>
		</aside>
	<?php endif; ?>
	<?php if ( is_singular( 'testimonial' ) ) : ?>
		<div class="sidebar-menu faculty-bio-jump" aria-labelledby="jump-menu">
			<label for="jump">
				<h1 id="jump-menu">View Other Testimonials</h1>
			</label>
			<select name="jump" id="jump" onchange="window.open(this.options[this.selectedIndex].value,'_top')">
				<?php
				if ( have_posts() ) :
					while ( have_posts() ) :
						the_post();
						?>
					<option>---<?php the_title(); ?></option>
						<?php
				endwhile;
endif;
				?>
				<?php
				$jump_menu_query = new WP_Query(
					array(
						'post-type'       => 'testimonial',
						'testimonialtype' => array( 'internship-testimonial', 'alumni-testimonial' ),
						'orderby'         => 'title',
						'order'           => 'ASC',
						'posts_per_page'  => 100,
					)
				);
				?>
				<?php
				while ( $jump_menu_query->have_posts() ) :
					$jump_menu_query->the_post();
					?>
					<option value="<?php the_permalink(); ?>"><?php the_title(); ?></option>
				<?php endwhile; ?>
			</select>
		</div>
	<?php endif; ?>

<?php /** Widgetized Sidebars  */ ?>

	<?php

	if ( function_exists( 'get_field' ) && get_field( 'ecpt_page_sidebar' ) ) :
		?>

	<aside class="custom page-widgets" aria-labelledby="custom-sidebar-content">
		<!-- ACF Page Specific Sidebar -->
		<div class="widget ecpt-page-sidebar" id="custom-sidebar-content">
			<?php
			$content = get_field( 'ecpt_page_sidebar', false, false );
			echo apply_filters( 'acf_the_content', wp_kses_post( $content ) );
			?>
		</div>
	</aside>
		<?php
	endif;
	?>
	<?php
	// Get the array of ancestors!
		$ancestors     = get_post_ancestors( $post->ID );
		$ancestor_id   = ( $ancestors ) ? $ancestors[ count( $ancestors ) - 1 ] : $post->ID;
		$the_ancestor  = get_page( $ancestor_id );
		$ancestor_slug = $the_ancestor->post_name;
	if ( is_home() ) :
		?>

		<?php dynamic_sidebar( 'archive-sb' ); ?>
		<?php elseif ( is_page( 'graduate' ) || 'graduate' == $ancestor_slug ) : ?>
			<!-- Graduate Sidebar -->
			<?php dynamic_sidebar( 'graduate-sb' ); ?>
		<?php elseif ( is_page( 'research' ) || 'research' == $ancestor_slug ) : ?>
			<!-- Research Sidebar -->
			<?php dynamic_sidebar( 'research-sb' ); ?>
		<?php elseif ( is_page( 'undergraduate' ) || 'undergraduate' == $ancestor_slug ) : ?>
			<!-- Undergraduate Sidebar -->
			<?php dynamic_sidebar( 'undergrad-sb' ); ?>
		<?php elseif ( is_page() && ! is_page( 'faculty-books' ) ) : ?>
			<!-- Default Page Sidebar -->
			<?php dynamic_sidebar( 'page-sb' ); ?>
	<?php endif; ?>

	<?php
	if ( function_exists( 'get_field' ) && get_field( 'custom_sidebar' ) ) :
		?>
		<!-- ACF Custom Widget Sidebar -->
		<?php
		$custom_sidebar_widget = get_field( 'custom_sidebar', false, false );
		if ( is_active_sidebar( $custom_sidebar_widget ) ) {
			dynamic_sidebar( $custom_sidebar_widget );
		}
		?>
		<?php
	endif;
	?>
</div>
