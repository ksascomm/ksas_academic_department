<?php
/**
 * Create simple function to delete our People CPT transients
 */

add_action( 'save_post_people', 'delete_academic_transients_save' );
	/**
	 * Check status here or check if post has been created.
	 */
function delete_academic_transients_save() {
	delete_transient( 'job_market_query' );
	delete_transient( 'research_staff_query' );
	delete_transient( 'graduate_student_query' );
}

add_action( 'edit_post_people', 'delete_academic_transients_edit' );
	/**
	 * Check status here or check if post data has been edited.
	 */
function delete_academic_transients_edit() {
	delete_transient( 'job_market_query' );
	delete_transient( 'research_staff_query' );
	delete_transient( 'graduate_student_query' );
}
