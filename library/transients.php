<?php
function delete_academic_transients( $post_id ) {
	global $post;
	if ( isset( $_GET['post_type'] ) ) {
		$post_type = $_GET['post_type'];
	} else {
		$post_type = $post->post_type;
	}
	switch ( $post_type ) {
		case 'people':
			$roles = get_terms(
				'role',
				array(
					'orderby'    => 'id',
					'hide_empty' => true,
				)
			);
			foreach ( $roles as $role ) {
				$role_slug = $role->slug;
				delete_transient( 'job_market_query' );
				delete_transient( 'research_staff_query' );
				delete_transient( 'graduate_student_query' );
			}
			break;
	}
}
add_action( 'save_post', 'delete_academic_transients' );
