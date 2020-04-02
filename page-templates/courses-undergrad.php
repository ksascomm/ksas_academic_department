<?php
/*
Template Name: SIS Courses
*/
get_header(); ?>
<?php get_template_part( 'template-parts/featured-image' ); ?>
<?php
// Load Zebra Curl
	require_once get_template_directory() . '/library/Zebra_cURL.php';
	// Set query string variables
		$theme_option = flagship_sub_get_global_options();
		$department_unclean = $theme_option['flagship_sub_isis_name'];
		$department = str_replace(' ', '%20', $department_unclean);
		$department = str_replace('&', '%26', $department);
		//$fall = 'fall%202020';
		$spring = 'spring%202020';
		$summer = 'summer%202020';
		$open = 'open';
		$approval = 'approval%20required';
		$closed = 'closed';
		$waitlist = 'waitlist%20only';
		$reserved_open = 'reserved%20open';
		$key = 'Qrf9MQse2cdpgaYdPF23dkMaqrVKE5dP';

	// Create first Zebra Curl class
		$course_curl = new Zebra_cURL();
		$course_curl->option(
            array(
				CURLOPT_TIMEOUT         => 60,
				CURLOPT_CONNECTTIMEOUT  => 60,
			)
        );
        //$cache_dir = get_template_directory() . "/sis-cache/";
		//$course_curl->cache($cache_dir, 1296000);

	// Create API Url calls
		//$courses_fall_url = 'https://sis.jhu.edu/api/classes?key=' . $key . '&School=Krieger%20School%20of%20Arts%20and%20Sciences&Term=' . $fall . '&Department=AS%20' . $department . '&status=' . $open . '&status=' . $approval . '&status=' . $waitlist . '&status=' . $reserved_open;
		$courses_spring_url = 'https://sis.jhu.edu/api/classes?key=' . $key . '&School=Krieger%20School%20of%20Arts%20and%20Sciences&Term=' . $spring . '&Department=AS%20' . $department . '&status=' . $open . '&status=' . $approval . '&status=' . $waitlist . '&status=' . $reserved_open;
		// $courses_intersession_url = 'https://sis.jhu.edu/api/classes?key=' . $key . '&School=Krieger%20School%20of%20Arts%20and%20Sciences&Term=' . $intersession . '&Department=AS%20' . $department;
		$courses_summer_url = 'https://sis.jhu.edu/api/classes?key=' . $key . '&School=Krieger%20School%20of%20Arts%20and%20Sciences&Term=' . $summer . '&Department=AS%20' . $department;
		$courses_call = array(
			//$courses_fall_url,
			$courses_spring_url,
			$courses_summer_url,
		);

		//$courses_call_fall = $courses_fall_url;
		$courses_call_spring = $courses_spring_url;
		$courses_call_summer = $courses_summer_url;
	// Course display callback function
		function display_courses( $result ) {
		  $result->body = json_decode(html_entity_decode($result->body));
			$title = $result->body[0]->{'Title'};
			$term = $result->body[0]->{'Term_IDR'};
			$clean_term = str_replace(' ', '-', $term);
			$meetings = $result->body[0]->{'Meetings'};
			$status = $result->body[0]->{'Status'};
			$seatsavailable = $result->body[0]->{'SeatsAvailable'};
			$course_number = $result->body[0]->{'OfferingName'};
			$clean_course_number = preg_replace('/[^A-Za-z0-9\-]/', '', $course_number);
			$credits = $result->body[0]->{'Credits'};
			$section_number = $result->body[0]->{'SectionName'};
			$instructor = $result->body[0]->{'InstructorsFullName'};
			$course_level = $result->body[0]->{'Level'};
			$description = $result->body[0]->{'SectionDetails'}[0]->{'Description'};
			$room = $result->body[0]->{'SectionDetails'}[0]->{'Meetings'}[0]->{'Building'};
			$roomnumber = $result->body[0]->{'SectionDetails'}[0]->{'Meetings'}[0]->{'Room'};
			$postag = ' ';
			$sectiondetails = $result->body[0]->{'SectionDetails'}[0];
			$tags = [];
			if (isset($sectiondetails->{'PosTags'}) ) {
				if ( ! empty($sectiondetails->{'PosTags'}) ) {
					$postag = $sectiondetails->{'PosTags'};
        			foreach ($postag as $tag ) {
						$tags[] = $tag->{'Tag'};
				    }
				}
			}
			$print_tags = empty($tags) ? 'n/a' : implode(', ', $tags);
			echo '<tr><td>' . $course_number . '&nbsp;(' . $section_number . ')</td><td>' . $title . '</td><td class="show-for-medium">' . $meetings . '</td><td class="show-for-medium">' . $instructor . '</td><td class="show-for-medium">' . $room . '&nbsp;' . $roomnumber . '</td><td class="show-for-large">' . implode(', ', $tags) . '</td>';
			echo '<td><button class="button" data-open="course-' . $clean_course_number . $section_number . $clean_term . '">More Info</button></td></tr>';
			echo '<div class="reveal course-description" id="course-' . $clean_course_number . $section_number . $clean_term.'" aria-labelledby="'. $clean_term . $course_number . '-' . $section_number . '" data-reveal><h1 id="' . $clean_term . $course_number . '-' . $section_number . '">' . $title . '<br><small>' . $course_number . '&nbsp;(' . $section_number . ')</small></h1><p>' . $description . '<ul><li><strong>Credits:</strong> ' . $credits . '</li><li><strong>Level:</strong> ' . $course_level . ' </li><li><strong>Days/Times:</strong> ' . $meetings . ' </li><li><strong>Instructor:</strong> '. $instructor . ' </li><li><strong>Room:</strong> ' . $room . '&nbsp;' . $roomnumber . '  </li><li><strong>Status:</strong> ' . $status . '</li><li><strong>Seats Available:</strong> ' . $seatsavailable . '</li><li><strong>PosTag(s):</strong> ' . $print_tags . '</li></ul></p><button class="close-button" data-close aria-label="Close reveal" type="button"><span aria-hidden="true">&times;</span></button></div>';
		}
	// SIS Call callback function
		function parse_courses( $result ) {
			//$cache_dir = get_template_directory() . "/sis-cache/";
			$key = 'DZkN4QOJGaDKVg6Du1911u45d4TJNp6I';
			$result->body = json_decode(html_entity_decode($result->body));
		    if (( ! is_array($result) && ! is_object($result)) ||
		        (is_array($result) || count((array)$result) == 0) ||
		        (json_last_error() != JSON_ERROR_NONE) ) {// only for PHP >= 5.3.0

			        // log the error or warning here ...
			        $input  = $result->body;
			        $output = print_r($result, true);

			        // Only for PHP >= 5.3.0
			        // json_last_error();
			        // json_last_error_msg();
			        return -1;
			    }

			$course_data = array();
				foreach ($result->body as $course ) {
				$section = $course->{'SectionName'};
				$level = $course->{'Level'};
				$parent = 'Undergraduate';
				if (strpos($level, $parent) !== false || ($level === '') !== false ) {
					$number = $course->{'OfferingName'};
					$clean_number = preg_replace('/[^A-Za-z0-9\-]/', '', $number);
					$dirty_term = $course->{'Term_IDR'};
					$clean_term = str_replace(' ', '%20', $dirty_term);
					$details_url = 'https://sis.jhu.edu/api/classes/' . $clean_number . $section . '/' . $clean_term . '?key=' . $key;
					$course_data[] = $details_url;
					}
				}
			$curl = new Zebra_cURL();
			$curl->option(
                array(
					CURLOPT_TIMEOUT         => 60,
					CURLOPT_CONNECTTIMEOUT  => 60,
				)
                );
			//$curl->cache($cache_dir, 1296000);
			$curl->get($course_data, 'display_courses');
		}
?>

<div class="main-container" id="page">
    <div class="main-grid">
        <main class="main-content">
            <?php while ( have_posts() ) : the_post(); ?>
                <?php get_template_part( 'template-parts/content', 'page' ); ?>
            <?php endwhile; ?>
			<ul class="tabs" data-tabs id="courses-tabs">
			 	<li class="tabs-title is-active"><a href="#Spring">Spring 2020</a></li>
				<li class="tabs-title"><a href="#Summer">Summer 2020</a></li>
			</ul>
			<div class="tabs-content course-listings" data-tabs-content="courses-tabs">
				<div class="tabs-panel is-active" id="Spring">
				 	<p class="show-for-sr" id="tblDescSpring">Column one has the course number and section. Other columns show the course title, days offered, instructor's name, room number, if the course is cross-referenced with another program, and a option to view additional course information in a pop-up window.</p>
				 	<table aria-describedby="tblDescSpring" class="course-table">
						<thead>
							<tr>
								<th>Course # (Section)</th>
								<th>Title</th>
								<th class="show-for-medium">Day/Times</th>
								<th class="show-for-medium">Instructor</th>
								<th class="show-for-medium">Room</th>
								<th class="show-for-large">PosTag(s)</th>
								<th>Info</th>
							</tr>
						</thead>
						<tbody>
							<?php $course_curl->get($courses_call_spring, 'parse_courses'); ?>
						</tbody>
					</table>
				</div>
				<div class="tabs-panel" id="Summer">
				 	<p class="show-for-sr" id="tblDescSummer">Column one has the course number and section. Other columns show the course title, days offered, instructor's name, room number, if the course is cross-referenced with another program, and a option to view additional course information in a pop-up window.</p>
				 	<table aria-describedby="tblDescSummer" class="course-table">
						<thead>
							<tr>
								<th>Course # (Section)</th>
								<th>Title</th>
								<th class="show-for-medium">Day/Times</th>
								<th class="show-for-medium">Instructor</th>
								<th class="show-for-medium">Room</th>
								<th class="show-for-large">PosTag(s)</th>
								<th>Info</th>
							</tr>
						</thead>
						<tbody>
							<?php $course_curl->get($courses_call_summer, 'parse_courses'); ?>
						</tbody>
					</table>
				</div>
			</div>
        </main>
        <?php get_sidebar(); ?>
    </div>
</div>

<?php
get_footer();
