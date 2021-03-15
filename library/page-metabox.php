<?php
/**
 * Adds Widget Title Shortcode
 *
 * @package KSASAcademicDepartment
 * @since KSASAcademicDepartment 1.0.0
 */

/**  Add Widget Title shortcode */
function sidebar_title_shortcode( $attr, $content = null ) {
	return '<div class="widget_title"><h5>' . $content . '</h5></div>';
}
add_shortcode( 'sidebar-title', 'sidebar_title_shortcode' );
