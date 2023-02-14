<?php
/**
 * Adapted for Foundation from http://thewebtaylor.com/articles/wordpress-creating-breadcrumbs-without-a-plugin
 *
 * @param bool $showhome should the breadcrumb be shown when on homepage (only one deactivated entry for home).
 * @param bool $separatorclass should a separator class be added (in case :before is not an option).
 */

if ( ! function_exists( 'ksasacademic_breadcrumb' ) ) {
	function ksasacademic_breadcrumb( $showhome = true, $separatorclass = false ) {

		// Settings
		$separator  = '&gt;';
		$id         = 'breadcrumbs';
		$class      = 'breadcrumbs';
		$home_title = get_bloginfo( 'title' );
		$home_url   = home_url();

		// Get the query & post information
		global $post,$wp_query;
		$category = get_the_category();

		// Build the breadcrums
		echo '<p class="screen-reader-text" id="breadcrumblabel">You are here:</p>';
		echo '<ul id="' . $id . '" class="' . $class . '" aria-labelledby="breadcrumblabel">';

		// Do not display on the homepage
		if ( ! is_front_page() ) {

			// Home page
			echo '<li class="item-home"><a class="bread-link bread-home" href="' . get_home_url() . '">Home</a></li>';
			if ( $separatorclass ) {
				echo '<li class="separator separator-home"> ' . $separator . ' </li>';
			}

			if ( is_single() && ! is_attachment() ) {

				// Single post (Only display the first category)
				if ( $separatorclass ) {
					echo '<li class="separator separator-' . $category[0]->term_id . '"> ' . $separator . ' </li>';
				}
				if ( is_singular( 'bulletinboard' ) ) {
					echo '<li><a href="' . $home_url . '/undergraduate/">Undergraduate</a></li>';
					echo '<li><a href="' . $home_url . '/bbtype/">Bulletins</a></li>';
				} elseif ( is_singular( 'tribe_events' ) ) {
					echo '<li><a href="' . $home_url . '/events/">Events</a></li>';
				} elseif ( is_singular( 'ksasexhibits' ) ) {
					echo '<li><a href="' . $home_url . '/exhibitions">Exhibitions</a></li>';
				} elseif ( is_singular( 'ksasresearchprojects' ) ) {
					echo '<li><a href="' . $home_url . '/writing-toolkit">Writing Toolkit</a></li>';
				} elseif ( is_singular( 'profile' ) ) {
					if ( has_term( 'spotlight', 'profiletype' ) ) {
						echo '<li><a href="' . $home_url . '/profiletype/spotlight">Spotlights</a></li>';
					} elseif ( has_term( 'undergraduate-profile', 'profiletype' ) ) {
						echo '<li><a href="' . $home_url . '/profiletype/undergraduate-profile/">Undergraduate Profiles</a></li>';
					} elseif ( has_term( 'graduate-profile', 'profiletype' ) ) {
						echo '<li><a href="' . $home_url . '/profiletype/graduate-profile/">Graduate Profiles</a></li>';
					} elseif ( has_term( 'alumni', 'profiletype' ) ) {
						echo '<li><a href="' . $home_url . '/profiletype/alumni/">Alumni Profiles</a></li>';
					} elseif ( has_term( 'internship', 'profiletype' ) ) {
						echo '<li><a href="' . $home_url . '/profiletype/internship/">Internship Experiences</a></li>';
					}
				} elseif ( is_singular( 'testimonial' ) ) {
					if ( has_term( 'alumni', 'testimonialtype' ) ) {
						echo '<li><a href="' . $home_url . '/testimonialtype/alumni-testimonial/">Alumni Testimonials</a></li>';
					} elseif ( has_term( 'current-students', 'testimonialtype' ) ) {
						echo '<li><a href="' . $home_url . '/testimonialtype/current-students/">Undergraduate Testimonials</a></li>';
					} elseif ( has_term( 'internship', 'testimonialtype' ) ) {
						echo '<li><a href="' . $home_url . '/testimonialtype/internship-testimonial/">Undergraduate Testimonials</a></li>';
					}
				} elseif ( is_singular( 'people' ) ) {
					echo '<li><a href="' . $home_url . '/people/">People</a></li>';
				} else {
					echo '<li><a href="' . $home_url . '/about/">About</a></li>';
					echo '<li><a href="' . $home_url . '/about/archive/">News Archive</a></li>';
				}
				echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '">' . get_the_title() . '</strong></li>';
			} elseif ( is_category() ) {

				// Category page
				// Get the current category
				$current_category = $wp_query->queried_object;
				echo '<li class="item-current item-cat-' . $current_category->term_id . ' item-cat-' . $current_category->category_nicename . '"><strong class="bread-current bread-cat-' . $current_category->term_id . ' bread-cat-' . $current_category->category_nicename . '">' . $current_category->cat_name . '</strong></li>';

			} elseif ( is_tax() ) {
				// Tax archive page
				$queried_object = get_queried_object();
				$name           = $queried_object->name;
				$slug           = $queried_object->slug;
				$tax            = $queried_object->taxonomy;
				$term_id        = $queried_object->term_id;
				$parent         = $queried_object->parent;
				if ( $parent ) {
					$parents = array();
					// Loop through all term ancestors
					while ( $parent ) {
						$parent_term = get_term( $parent, $tax );
						// The output will be reversed, so separator goes first
						if ( $separatorclass ) {
							$parents[] = '<li class="separator separator-' . $parent . '"> ' . $separator . ' </li>';
						}
						$parents[] = '<li class="item-parent item-parent-' . $parent . '"><a class="bread-parent bread-parent-' . $parent . '" href="' . get_term_link( $parent ) . '" title="' . $parent_term->name . '">' . $parent_term->name . '</a></li>';
						$parent    = $parent_term->parent;
					}
					echo implode( array_reverse( $parents ) );
				}
				echo '<li class="item-current item-tax-' . $term_id . ' item-tax-' . $slug . '">' . $name . '</li>';

			} elseif ( is_page() ) {

				// Standard page
				if ( $post->post_parent ) {

					// If child page, get parents
					$anc = get_post_ancestors( $post->ID );

					// Get parents in the right order
					$anc = array_reverse( $anc );

					// Parent page loop
					$parents = '';
					foreach ( $anc as $ancestor ) {
						$parents .= '<li class="item-parent item-parent-' . $ancestor . '"><a class="bread-parent bread-parent-' . $ancestor . '" href="' . get_permalink( $ancestor ) . '">' . get_the_title( $ancestor ) . '</a></li>';
						if ( $separatorclass ) {
							$parents .= '<li class="separator separator-' . $ancestor . '"> ' . $separator . ' </li>';
						}
					}

					// Display parent pages
					echo $parents;

					// Current page
					echo '<li class="current item-' . $post->ID . '">' . get_the_title() . '</li>';

				} else {

					// Just display current page if not parents
					echo '<li class="current item-' . $post->ID . '"> ' . get_the_title() . '</li>';

				}
			} elseif ( is_tag() ) {

				// Tag page
				// Get tag information
				$term_id  = get_query_var( 'tag_id' );
				$taxonomy = 'post_tag';
				$args     = 'include=' . $term_id;
				$terms    = get_terms( $taxonomy, $args );

				// Display the tag name
				echo '<li class="current item-tag-' . $terms[0]->term_id . ' item-tag-' . $terms[0]->slug . '">' . $terms[0]->name . '</li>';

			} elseif ( is_day() ) {

				// Day archive
				// Year link
				echo '<li class="item-year item-year-' . get_the_time( 'Y' ) . '"><a class="bread-year bread-year-' . get_the_time( 'Y' ) . '" href="' . get_year_link( get_the_time( 'Y' ) ) . '" title="' . get_the_time( 'Y' ) . '">' . get_the_time( 'Y' ) . ' Archives</a></li>';
				if ( $separatorclass ) {
					echo '<li class="separator separator-' . get_the_time( 'Y' ) . '"> ' . $separator . ' </li>';
				}

				// Month link
				echo '<li class="item-month item-month-' . get_the_time( 'm' ) . '"><a class="bread-month bread-month-' . get_the_time( 'm' ) . '" href="' . get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) . '" title="' . get_the_time( 'M' ) . '">' . get_the_time( 'M' ) . ' Archives</a></li>';
				if ( $separatorclass ) {
					echo '<li class="separator separator-' . get_the_time( 'm' ) . '"> ' . $separator . ' </li>';
				}

				// Day display
				echo '<li class="current item-' . get_the_time( 'j' ) . '">' . get_the_time( 'jS' ) . ' ' . get_the_time( 'M' ) . ' Archives</li>';

			} elseif ( is_month() ) {

				// Month Archive
				// Year link
				echo '<li class="item-year item-year-' . get_the_time( 'Y' ) . '"><a class="bread-year bread-year-' . get_the_time( 'Y' ) . '" href="' . get_year_link( get_the_time( 'Y' ) ) . '" title="' . get_the_time( 'Y' ) . '">' . get_the_time( 'Y' ) . ' Archives</a></li>';
				if ( $separatorclass ) {
					echo '<li class="separator separator-' . get_the_time( 'Y' ) . '"> ' . $separator . ' </li>';
				}

				// Month display
				echo '<li class="item-month item-month-' . get_the_time( 'm' ) . '">' . get_the_time( 'M' ) . ' Archives</li>';

			} elseif ( is_year() ) {

				// Display year archive
				echo '<li class="current item-current-' . get_the_time( 'Y' ) . '">' . get_the_time( 'Y' ) . ' Archives</li>';

			} elseif ( is_author() ) {

				// Auhor archive
				// Get the author information
				global $author;
				$userdata = get_userdata( $author );

				// Display author name
				echo '<li class="current item-current-' . $userdata->user_nicename . '">Author: ' . $userdata->display_name . '</li>';

			} elseif ( get_query_var( 'paged' ) ) {

				// Paginated archives
				echo '<li class="current item-current-' . get_query_var( 'paged' ) . '">' . __( 'Page', 'ksasacademic' ) . ' ' . get_query_var( 'paged' ) . '</li>';

			} elseif ( is_search() ) {

				// Search results page
				echo '<li class="current item-current-search">Search results for: ' . get_search_query() . '</li>';

			} elseif ( is_home() ) {
				echo '<li class="item-parent item-parent-747"><a class="bread-parent bread-parent-747" href="' . site_url() . '/about/" title="About">About</a></li><li class="current item-' . $post->ID . '">' . 'News Archive' . '</li>';

			} elseif ( is_404() ) {

				// 404 page
				echo '<li>Error 404</li>';
			} // End if().
		} else {
			if ( $showhome ) {
				echo '<li class="item-home current">' . $home_title . '</li>';
			}
		} // End if().
		echo '</ul>';
	}
} // End if().
