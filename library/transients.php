<?php
function delete_academic_transients($post_id) {
	global $post;
	if (isset($_GET['post_type'])) {		
		$post_type = $_GET['post_type'];
	}
	else {
		$post_type = $post->post_type;
	}
	switch($post_type) {
		case 'people' :
			$roles = get_terms('role', array(
						'orderby' 		=> 'id',
						'hide_empty'    => true,
						)); 
			foreach($roles as $role) {
			$role_slug = $role->slug;
				delete_transient('people_query_' . $role_slug);
				delete_transient('job_market_query');
				delete_transient('research_staff_query');
				delete_transient('graduate_student_query');
			}
		break;
		
		case 'post' :
			for ($i=1; $i < 5; $i++)
			    { delete_transient('faculty_books_query_' . $i);
			      delete_transient('news_archive_query_' . $i); }
			   
			delete_transient('news_query');
			delete_transient('news_mainpage_query');
		break;
		
		case 'slider' :
			delete_transient('slider_query');
		break;
		case 'course' :
			delete_transient('ksas_course_grad_query');
			delete_transient('ksas_course_undergrad_query');
		break;
		case 'bulletinboard' :
			delete_transient('ksas_bb_undergrad_query');
			delete_transient('ksas_bb_grad_query');
		break;
		case 'profile' :
			delete_transient('ksas_profile_undergrad_query');
			delete_transient('ksas_profile_grad_query');
			delete_transient('ksas_profile_spotlight_query');
	}
}
	add_action('save_post','delete_academic_transients');