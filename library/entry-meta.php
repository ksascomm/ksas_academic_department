<?php
/**
 * Entry meta information for posts
 *
 * @package KSASAcademicDepartment
 * @since KSASAcademicDepartment 1.0.0
 */

if ( ! function_exists( 'ksasacademic_entry_meta' ) ) :
	function ksasacademic_entry_meta() {
		/* translators: %1$s: current date, %2$s: current time */
		echo '<time class="updated" datetime="' . get_the_time( 'c' ) . '">' . sprintf(get_the_time('F j, Y') ) . '</time>';
	}
endif;
