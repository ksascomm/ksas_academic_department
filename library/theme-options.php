<?php

// Add Theme Options Page
if ( ! function_exists( 'create_theme_options' ) ) {
	function create_theme_options() {
		require_once 'theme-options-init.php';
	}
	if ( is_admin() ) {
		create_theme_options();
	}
}
// Collect current theme option values
function flagship_sub_get_global_options() {
	$flagship_sub_option = array();
	$flagship_sub_option = get_option( 'flagship_sub_options' );
	return $flagship_sub_option;
}

// Function to call theme options in theme files
$flagship_sub_option = flagship_sub_get_global_options();

/**
 * Define our settings sections
 *
 * array key=$id, array value=$title in: add_settings_section( $id, $title, $callback, $page );
 *
 * @return array
 */
function flagship_sub_options_page_sections() {

	$sections = array();
	// $sections[$id]               = __($title, 'ksasacademic');
	$sections['homepage_section']  = __( 'Homepage Options', 'ksasacademic' );
	$sections['select_section']    = __( 'Content Options', 'ksasacademic' );
	$sections['footer_section']    = __( 'Footer Options', 'ksasacademic' );
	$sections['technical_section'] = __( 'Technical Options', 'ksasacademic' );
	$sections['directory_section'] = __( 'Directory Search Options', 'ksasacademic' );
	return $sections;
}

/**
 * Define our form fields (settings)
 *
 * @return array
 */
function flagship_sub_options_page_fields() {
	// Text Form Fields section
	// Select Form Fields section
	$options[0]  =
	array(
		'section' => 'homepage_section',
		'id'      => FLAGSHIP_SUB_SHORTNAME . '_feed_name',
		'title'   => __( 'Homepage Sub-head', 'ksasacademic' ),
		'desc'    => __( 'Enter the headline for the news feed on the homepage', 'ksasacademic' ),
		'type'    => 'text',
		'class'   => 'nohtml',
		'std'     => '',
	);
	$options[1]  =
	array(
		'section' => 'homepage_section',
		'id'      => FLAGSHIP_SUB_SHORTNAME . '_news_quantity',
		'title'   => __( 'Homepage Posts', 'ksasacademic' ),
		'desc'    => __( 'Enter the number of posts you would like displayed on the homepage', 'ksasacademic' ),
		'type'    => 'text',
		'class'   => 'numeric',
		'std'     => '',
	);
	$options[4]  =
	array(
		'section' => 'directory_section',
		'id'      => FLAGSHIP_SUB_SHORTNAME . '_directory_search',
		'title'   => __( 'Directory Search', 'ksasacademic' ),
		'desc'    => __( 'Do you want a search box for your people directory?', 'ksasacademic' ),
		'type'    => 'checkbox',
		'std'     => '1',
	);
	$options[6]  =
	array(
		'section' => 'technical_section',
		'id'      => FLAGSHIP_SUB_SHORTNAME . '_google_analytics',
		'title'   => __( 'Google Analytics ID', 'ksasacademic' ),
		'desc'    => __( 'Enter your Google Analytics ID ie. UA-2497774-9', 'ksasacademic' ),
		'type'    => 'text',
		'class'   => 'nohtml',
		'std'     => 'UA-40512757-1',
	);
	$options[9]  =
	array(
		'section' => 'footer_section',
		'id'      => FLAGSHIP_SUB_SHORTNAME . '_quicklinks',
		'title'   => __( 'Quicklinks', 'ksasacademic' ),
		'desc'    => __( 'Do you want to use quicklinks from another site?', 'ksasacademic' ),
		'type'    => 'checkbox',
		'std'     => '1',
	);
	$options[10] =
	array(
		'section' => 'footer_section',
		'id'      => FLAGSHIP_SUB_SHORTNAME . '_quicklinks_id',
		'title'   => __( 'Quicklinks Site ID', 'ksasacademic' ),
		'desc'    => __( 'Enter the site ID for the quicklinks you would like to use. krieger.jhu.edu is 1', 'ksasacademic' ),
		'type'    => 'text',
		'class'   => 'numeric',
		'std'     => '1',
	);
	$options[11] =
	array(
		'section' => 'footer_section',
		'id'      => FLAGSHIP_SUB_SHORTNAME . '_copyright',
		'title'   => __( 'Department Address', 'ksasacademic' ),
		'desc'    => __( 'Enter the department address', 'ksasacademic' ),
		'type'    => 'textarea',
		'std'     => 'Zanvyl Krieger School of Arts & Sciences',
	);
	$options[12] =
	array(
		'section' => 'directory_section',
		'id'      => FLAGSHIP_SUB_SHORTNAME . '_role_search',
		'title'   => __( 'Filter by Role', 'ksasacademic' ),
		'desc'    => __( 'Do you want to be able to filter by role (faculty, research staff, emertiti)?', 'ksasacademic' ),
		'type'    => 'checkbox',
		'std'     => '0',
	);
	$options[13] =
	array(
		'section' => 'directory_section',
		'id'      => FLAGSHIP_SUB_SHORTNAME . '_research_search',
		'title'   => __( 'Filter by Expertise', 'ksasacademic' ),
		'desc'    => __( 'Do you want to be able to filter by expertise/research area?', 'ksasacademic' ),
		'type'    => 'checkbox',
		'std'     => '0',
	);
	$options[14] =
	array(
		'section' => 'homepage_section',
		'id'      => FLAGSHIP_SUB_SHORTNAME . '_news_query_cond',
		'title'   => __( 'News Feed Option', 'ksasacademic' ),
		'desc'    => __( 'Do you want to exclude faculty books from your news feeds?', 'ksasacademic' ),
		'type'    => 'checkbox',
		'std'     => '0',
	);
	$options[15] =
	array(
		'section' => 'technical_section',
		'id'      => FLAGSHIP_SUB_SHORTNAME . '_isis_name',
		'title'   => __( 'SIS Department Name', 'ksasacademic' ),
		'desc'    => __( 'Enter the SIS department name', 'ksasacademic' ),
		'type'    => 'text',
		'class'   => 'nohtml',
		'std'     => '',
	);
	$options[17] =
	array(
		'section' => 'homepage_section',
		'id'      => FLAGSHIP_SUB_SHORTNAME . '_hub_cond',
		'title'   => __( 'Hub Feed Option', 'ksasacademic' ),
		'desc'    => __( 'Do you want to display articles from The Hub?', 'ksasacademic' ),
		'type'    => 'checkbox',
		'std'     => '0',
	);
	$options[18] =
	array(
		'section' => 'homepage_section',
		'id'      => FLAGSHIP_SUB_SHORTNAME . '_hub_topic_keyword',
		'title'   => __( 'Hub Topic or Keywords?', 'ksasacademic' ),
		'desc'    => __( 'Do you want to display Hub articles via topic or keyword? You may only select one.', 'ksasacademic' ),
		'type'    => 'select',
		'choices' => array( ' ', 'topic', 'keyword' ),
		'std'     => ' ',
	);
	$options[19] =
	array(
		'section' => 'homepage_section',
		'id'      => FLAGSHIP_SUB_SHORTNAME . '_hub_keywords',
		'title'   => __( 'Hub Keywords', 'ksasacademic' ),
		'desc'    => __( 'Enter keywords. Use hyphens instead of spaces (comma separated, no spaces) ie. physics,arts-and-sciences.', 'ksasacademic' ),
		'type'    => 'text',
		'class'   => 'nohtml',
		'std'     => '',
	);
	$options[20] =
	array(
		'section' => 'homepage_section',
		'id'      => FLAGSHIP_SUB_SHORTNAME . '_hub_topic',
		'title'   => __( 'Hub Topics', 'ksasacademic' ),
		'desc'    => __( 'Choose a relevant Hub Topic from the list above', 'ksasacademic' ),
		'type'    => 'select',
		'choices' => array( ' ', 'arts-culture', 'at-work', 'health', 'politics-society', 'science-technology', 'student-life', 'university-news', 'voices-opinion' ),
		'std'     => ' ',
	);
	$options[21] =
	array(
		'section' => 'select_section',
		'id'      => FLAGSHIP_SUB_SHORTNAME . '_shield',
		'title'   => __( 'Shield', 'ksasacademic' ),
		'desc'    => __( 'Which shield should appear in the header?', 'ksasacademic' ),
		'type'    => 'select',
		'choices' => array( 'ksas', 'jhu', 'custom' ),
		'std'     => 'ksas',
	);
	$options[22] =
	array(
		'section' => 'select_section',
		'id'      => FLAGSHIP_SUB_SHORTNAME . '_shield_location',
		'title'   => __( 'Custom Shield Location', 'ksasacademic' ),
		'desc'    => __( 'Paste the media url for custom JHU shields', 'ksasacademic' ),
		'type'    => 'text',
		'std'     => '',
	);
	$options[23] =
	array(
		'section' => 'technical_section',
		'id'      => FLAGSHIP_SUB_SHORTNAME . '_siteimprove_analytics',
		'title'   => __( 'Siteimprove Analytics', 'ksasacademic' ),
		'desc'    => __( 'Do you want to display the Siteimprove Analytics script?', 'ksasacademic' ),
		'type'    => 'checkbox',
		'std'     => '0',
	);
	$options[24] =
	array(
		'section' => 'technical_section',
		'id'      => FLAGSHIP_SUB_SHORTNAME . '_ga4_analytics',
		'title'   => __( 'Google Analytics 4 ID', 'ksasacademic' ),
		'desc'    => __( 'Enter your Google Analytics 4 ID eg. G-BXWF6LM8V4', 'ksasacademic' ),
		'type'    => 'text',
		'class'   => 'nohtml',
		'std'     => '',
	);
	return $options;
}
