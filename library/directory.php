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