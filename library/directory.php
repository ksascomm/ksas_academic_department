<?php function get_the_directory_filters( $post ) {
	$directory_filters = get_the_terms( $post->ID, 'filter' );
	if ( $directory_filters && ! is_wp_error( $directory_filters ) ) :
		$directory_filter_names = array();
		foreach ( $directory_filters as $directory_filter ) {
			$directory_filter_names[] = $directory_filter->slug;
		}
		$directory_filter_name = join( ' ', $directory_filter_names );

		endif;
		return $directory_filter_name;
}

function get_the_roles( $post ) {
	$roles = get_the_terms( $post->ID, 'role' );
	if ( $roles && ! is_wp_error( $roles ) ) :
		$role_names = array();
		foreach ( $roles as $role ) {
			$role_names[] = $role->slug;
		}
		$role_name = join( ' ', $role_names );

		endif;
		return $role_name;
}

add_action( 'template_redirect', 'redirect_empty_bios' );
// Redirect Empty bios to website.
function redirect_empty_bios() {
	if ( is_singular( 'people' ) ) {
		global $post;
		$bio = get_post_meta( $post->ID, 'ecpt_bio', true );
		$link = get_post_meta( $post->ID, 'ecpt_website', true );
		if ( has_term( array( 'faculty', 'tenured-and-tenure-track-faculty', 'joint-faculty', 'advisory-board', 'ab-joint-and-secondary-appointments' ), 'role' ) ) {
			if ( empty( $bio ) && isset( $link ) ) {
				wp_redirect( esc_url( $link ), 301 );
				exit;
			}
		}
	}
}

add_action( 'pre_get_posts', 'exhibits_tax_page' );
// Show all Exhibits on Exhibits Tax Archive Page.
function exhibits_tax_page( $query ) {
	if ( ! is_admin() && $query->is_main_query() && is_tax( 'exhibition_type' ) ) {
			$query->set( 'posts_per_page', '150' );
	}
}

function deactivate_on_people_page() {
	// Disable WordPress Lazy Load on People pages.
	if ( is_page_template( array( 'page-templates/people-directory.php', 'page-templates/people-directory-full-width.php', 'page-templates/people-directory-alphabetical', 'page-templates/program-people-directory.php' ) ) ) {
		add_filter( 'wp_lazy_loading_enabled', '__return_false' );
	}
}
add_filter( 'wp', __NAMESPACE__ . '\deactivate_on_people_page' );
